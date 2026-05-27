<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Room extends Core_Controller
{
	private $upload_path;
	private $gallery_path;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/RoomModel', 'room');
		$this->load->library('session');

		$this->upload_path  = FCPATH . 'uploads/room/';
		$this->gallery_path = FCPATH . 'uploads/room_gallery/';

		if (!is_dir($this->upload_path)) mkdir($this->upload_path, 0755, true);
		if (!is_dir($this->gallery_path)) mkdir($this->gallery_path, 0755, true);
	}

	// ==========================================
	// หน้ารายการห้องพัก
	// ==========================================

	public function index($hotel_id = null)
	{
		if ($this->input->post('order') == 'submit-order') {
			$ids    = $this->input->post('id');
			$orders = $this->input->post('order_data');
			if (!empty($ids)) {
				for ($i = 0; $i < count($ids); $i++) {
					$this->room->updateRoom($ids[$i], ['sort_order' => $orders[$i]]);
				}
				$this->session->set_flashdata('result', 'true');
				$this->session->set_flashdata('message', 'อัพเดทลำดับเรียบร้อยแล้ว');
				redirect($hotel_id ? admin_url('room/index/' . $hotel_id) : admin_url('room'));
				return;
			}
		}
		$auth          = $this->session->userdata('_auth');
		$my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
		$admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

		$this->load->model('admin/HotelModel', 'hotel_model');

		if ($my_permission === 1) {
			$rooms = $hotel_id
				? $this->room->getRoomsByHotelId($hotel_id)
				: $this->room->getRooms();
		} else {
			$permitted = $this->hotel_model->getPermittedHotelIds($admin_id);

			if (empty($hotel_id)) {
				$hotel_id = !empty($permitted) ? $permitted[0] : null;
			}

			if (empty($hotel_id) || !in_array((string)$hotel_id, array_map('strval', $permitted))) {
				redirect(admin_url());
				return;
			}

			$rooms = $this->room->getRoomsByHotelId($hotel_id);
		}

		$this->_data = [
			'title'         => 'จัดการห้องพัก',
			'menu_slug' => 'room_' . $hotel_id,
			'script'          => 'script_room',
			'content'       => 'page_room',
			'rooms'         => $rooms,
			'hotel_id'      => $hotel_id,
			'amenities_map' => $this->_buildAmenitiesMap($rooms),
		];
		$this->load->view('admin/index', $this->_data);
	}

	private function _buildAmenitiesMap($rooms)
	{
		$map = [];
		foreach ($rooms as $room) {
			$map[$room['room_id']] = $this->room->getAmenitiesByRoomId($room['room_id']);
		}
		return $map;
	}


	// ==========================================
	// เพิ่มห้องพัก
	// ==========================================

	public function add()
	{
		$auth          = $this->session->userdata('_auth');
		$my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
		$admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

		$hotel_id = null;
		$hotels   = [];

		if ($my_permission === 1) {
			$this->load->model('admin/HotelModel', 'hotel_model');
			$hotels = $this->hotel_model->getHotels();
		} else {
			$this->load->model('admin/HotelModel', 'hotel_model');
			$permitted = $this->hotel_model->getPermittedHotelIds($admin_id);
			$hotel_id  = !empty($permitted) ? $permitted[0] : null;
		}

		$this->_data = [
			'title'     => 'เพิ่มห้องพัก',
			'menu_slug' => 'room',
			'script'      => 'script_room',
			'content'   => 'page_room_add',
			'hotel_id'  => $hotel_id,
			'hotels'    => $hotels,
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('room'));
			return;
		}
		$hotel_id       = $this->input->post('hotel_id') ?: null;
		$new_sort_order = $this->room->getMaxOrderByHotelId($hotel_id) + 1;

		$data = [
			'hotel_id'    => $this->input->post('hotel_id') ?: null,
			'title_th'    => $this->input->post('title_th'),
			'subtitle_th' => $this->input->post('subtitle_th'),
			'title_en'    => $this->input->post('title_en'),
			'subtitle_en' => $this->input->post('subtitle_en'),
			'name_th'     => $this->input->post('name_th'),
			'name_en'     => $this->input->post('name_en'),
			'sort_order'  => $new_sort_order,
			'status'      => 1,
		];

		foreach (['image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '660', '370', $this->upload_path);
				if ($filename) $data[$field] = $filename;
			}
		}

		foreach (['banner_image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '600', '600', $this->upload_path);
				if ($filename) $data[$field] = $filename;
			}
		}

		foreach (['amenity_bg_image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '600', '600', $this->upload_path);
				if ($filename) $data[$field] = $filename;
			}
		}

		$insert_id = $this->room->insertRoom($data);

		if ($insert_id) {
			$this->_handleGalleryUpload($insert_id);

			$amenity_names = $this->input->post('amenity_name') ?: [];
			$this->room->syncAmenities($insert_id, $amenity_names);

			$this->session->set_flashdata('result', 'true');
			$this->session->set_flashdata('message', 'เพิ่มข้อมูลห้องพักเรียบร้อยแล้ว');
		} else {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'เกิดข้อผิดพลาด ไม่สามารถบันทึกข้อมูลได้');
		}

		redirect(admin_url('room'));
	}


	// ==========================================
	// แก้ไขห้องพัก (ข้อมูลพื้นฐาน + รูปหน้า list)
	// ==========================================

	public function edit($room_id = null)
	{
		if (empty($room_id)) {
			redirect(admin_url('room'));
			return;
		}

		$room = $this->room->getRoomById($room_id);
		if (empty($room)) {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'ไม่พบข้อมูลห้องพักที่ต้องการ');
			redirect(admin_url('room'));
			return;
		}

		$this->_data = [
			'title'       => 'แก้ไขห้องพัก',
			'menu_slug'   => 'room',
			'script'      => 'script_room',
			'content'     => 'page_room_edit',
			'roomData'    => $room,
			'roomGallery' => $this->room->getGalleryByRoomId($room_id),
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function update($room_id = null)
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST' || empty($room_id)) {
			redirect(admin_url('room'));
			return;
		}

		$room = $this->room->getRoomById($room_id);
		if (empty($room)) {
			redirect(admin_url('room'));
			return;
		}

		$data = [
			'title_th'    => $this->input->post('title_th'),
			'subtitle_th' => $this->input->post('subtitle_th'),
			'title_en'    => $this->input->post('title_en'),
			'subtitle_en' => $this->input->post('subtitle_en'),
			'name_th'     => $this->input->post('name_th'),  
			'name_en'     => $this->input->post('name_en'),
		];

		foreach (['detail_bg_image', 'detail_banner_image', 'detail_image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '1920', '600', $this->upload_path);
				if ($filename) {
					$this->_deleteOldFile($this->upload_path . ($room[$field] ?? ''));
					$data[$field] = $filename;
				}
			}
		}

		foreach (['image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '660', '370', $this->upload_path);
				if ($filename) {
					$this->_deleteOldFile($this->upload_path . ($room[$field] ?? ''));
					$data[$field] = $filename;
				}
			}
		}

		foreach (['banner_image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '600', '600', $this->upload_path);
				if ($filename) {
					$this->_deleteOldFile($this->upload_path . ($room[$field] ?? ''));
					$data[$field] = $filename;
				}
			}
		}

		foreach (['amenity_bg_image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '600', '600', $this->upload_path);
				if ($filename) {
					$this->_deleteOldFile($this->upload_path . ($room[$field] ?? ''));
					$data[$field] = $filename;
				}
			}
		}

		$result = $this->room->updateRoom($room_id, $data);

		if ($result) {
			$this->_handleGalleryUpload($room_id);

			$amenity_names = $this->input->post('amenity_name') ?: [];
			$this->room->syncAmenities($room_id, $amenity_names);

			$this->session->set_flashdata('result', 'true');
			$this->session->set_flashdata('message', 'อัปเดตข้อมูลห้องพักเรียบร้อยแล้ว');
		} else {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'เกิดข้อผิดพลาดในการอัปเดต');
		}

		redirect(admin_url('room'));
	}
	// ==========================================
	// หน้า Detail ของห้องพัก
	// ==========================================

	public function detail($room_id = null)
	{
		if (empty($room_id)) {
			redirect(admin_url('room'));
			return;
		}

		$room = $this->room->getRoomById($room_id);
		if (empty($room)) {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'ไม่พบข้อมูลห้องพักที่ต้องการ');
			redirect(admin_url('room'));
			return;
		}

		$this->_data = [
			'title'       => 'รายละเอียดห้องพัก - ' . ($room['title_th'] ?: 'ห้อง #' . $room_id),
			'menu_slug'   => 'roomdetail',
			'script'      => 'script_room',
			'content'     => 'page_room_detail',
			'roomData'    => $room,
			'roomGallery' => $this->room->getGalleryByRoomId($room_id),
			'amenities'   => $this->room->getAmenitiesByRoomId($room_id),
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function update_detail($room_id = null)
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST' || empty($room_id)) {
			redirect(admin_url('room'));
			return;
		}

		$room = $this->room->getRoomById($room_id);
		if (empty($room)) {
			redirect(admin_url('room'));
			return;
		}

		$data = [
			'title_th'    => $this->input->post('title_th'),
			'subtitle_th' => $this->input->post('subtitle_th'),
			'title_en'    => $this->input->post('title_en'),
			'subtitle_en' => $this->input->post('subtitle_en'),
			'name_th'     => $this->input->post('name_th'), 
			'name_en'     => $this->input->post('name_en'),
		];

		foreach (['detail_banner_image', 'detail_bg_image', 'detail_image'] as $field) {
			if (!empty($_FILES[$field]['name'])) {
				$filename = upload_fileFix($field, '1920', '600', $this->upload_path);
				if ($filename) {
					$this->_deleteOldFile($this->upload_path . ($room[$field] ?? ''));
					$data[$field] = $filename;
				}
			}
		}

		$this->room->updateRoom($room_id, $data);

		$amenity_names = $this->input->post('amenity_name') ?: [];
		$this->room->syncAmenities($room_id, $amenity_names);

		$this->_handleGalleryUpload($room_id);

		$this->session->set_flashdata('result', 'true');
		$this->session->set_flashdata('message', 'บันทึกข้อมูลรายละเอียดห้องพักเรียบร้อยแล้ว');
		redirect(admin_url('room/detail/' . $room_id));
	}

	// ==========================================
	// ลบห้องพัก
	// ==========================================

	public function delete($room_id = null)
	{
		if (empty($room_id)) {
			redirect(admin_url('room'));
			return;
		}

		$room = $this->room->getRoomById($room_id);
		if ($room) {
			foreach (['image', 'banner_image', 'amenity_bg_image'] as $f) {
				$this->_deleteOldFile($this->upload_path . ($room[$f] ?? ''));
			}
			foreach (['detail_banner_image', 'detail_bg_image', 'detail_image'] as $f) {
				$this->_deleteOldFile($this->upload_path . ($room[$f] ?? ''));
			}
			foreach ($this->room->getGalleryByRoomId($room_id) as $gal) {
				$this->_deleteOldFile($this->gallery_path . $gal['image']);
			}
			$this->room->syncFacilities($room_id, []);
		}

		$result = $this->room->deleteRoom($room_id);
		$this->session->set_flashdata('result', $result ? 'true' : 'false');
		$this->session->set_flashdata('message', $result ? 'ลบข้อมูลห้องพักเรียบร้อยแล้ว' : 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
		redirect(admin_url('room'));
	}

	// ==========================================
	// ลบรูปภาพแกลลอรี่ (AJAX)
	// ==========================================

	public function delete_gallery($gallery_id = null, $room_id = null)
	{
		if (ob_get_level()) ob_end_clean();
		header('Content-Type: application/json');

		if (!empty($gallery_id)) {
			$gallery = $this->room->getGalleryById($gallery_id);
			if (!empty($gallery['image'])) {
				$this->_deleteOldFile($this->gallery_path . $gallery['image']);
			}
			$delete = $this->room->deleteGallery($gallery_id);
			echo json_encode(
				$delete
					? ['success' => 1, 'msg' => 'ลบรูปภาพสำเร็จ']
					: ['success' => 0, 'msg' => 'ลบรูปภาพในฐานข้อมูลไม่สำเร็จ']
			);
		} else {
			echo json_encode(['success' => 1, 'msg' => 'ไม่พบรหัสรูปภาพที่ต้องการลบ']);
		}
		exit;
	}

	// ==========================================
	// อัปเดตสถานะ
	// ==========================================

	public function status($id = false, $active = false)
	{
		$result = $this->room->updateStatus($id, $active);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'อัพเดทสถานะสำเร็จ.' : 'อัพเดทสถานะไม่สำเร็จ.');
		redirect(admin_url('room'));
	}

	// ==========================================
	// อัปเดตลำดับ (AJAX)
	// ==========================================

	public function update_order_ajax()
	{
		$roomId    = $this->input->post('room_id');
		$sortOrder = $this->input->post('sort_order');

		if ($roomId && isset($sortOrder)) {
			$result = $this->room->updateRoom($roomId, ['sort_order' => $sortOrder]);
			echo json_encode($result ? ['status' => 'success'] : ['status' => 'error']);
		} else {
			echo json_encode(['status' => 'invalid_data']);
		}
		exit;
	}

	// ==========================================
	// Private Helpers
	// ==========================================

	private function _handleGalleryUpload($room_id)
	{
		if (empty($_FILES['gallery_pic']['name'][0])) return;

		$filesCount = count($_FILES['gallery_pic']['name']);
		$filenames  = upload_fileFix_array('gallery_pic', $filesCount, '800', '533', $this->gallery_path);

		foreach ($filenames as $filename) {
			if (empty($filename)) continue;
			$this->room->insertGallery([
				'room_id'    => $room_id,
				'image'      => $filename,
				'sort_order' => 0,
				'status'     => 1,
			]);
		}
	}

	private function _deleteOldFile($file_path)
	{
		if (!empty($file_path) && file_exists($file_path) && is_file($file_path)) {
			@unlink($file_path);
		}
	}
}
