<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');
require_once(APPPATH . 'helpers/upload_file_helper.php');

class Hotel extends Core_Controller
{
	private $upload_path = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/HotelModel', 'hotel');
		$this->load->library('session');

		$this->upload_path = FCPATH . 'uploads/hotel/';
		// if (!is_dir($this->upload_path)) mkdir($this->upload_path, 0777, true);
	}

	public function index()
	{
		if ($this->input->post('order') == 'submit-order') {
			$id = $this->input->post('id');
			if ($id) {
				$order = $this->input->post('order_data');
				for ($i = 0; $i < count($id); $i++) {
					$result = $this->hotel->updateOrder($order[$i], $id[$i]);
				}
				if ($result == 'true') {
					$this->session->set_flashdata('result', 'true');
					$this->session->set_flashdata('message', 'อัพเดทข้อมูลลำดับสำเร็จ.');
				} else {
					$this->session->set_flashdata('result', 'false');
					$this->session->set_flashdata('message', 'อัพเดทข้อมูลลำดับไม่สำเร็จ.');
				}
				redirect(admin_url('hotel'));
			} else {
				redirect(admin_url('hotel'));
			}
			return;
		}

		$auth          = $this->session->userdata('_auth');
		$my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
		$admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

		if ($my_permission == 1) {
			$hotels = $this->hotel->getHotelsWithAdminList();
		} else {

			$hotels = $this->hotel->getHotelsByAdminId($admin_id);
		}

		$this->_data = [
			'title'     => 'จัดการข้อมูลโรงแรม',
			'menu_slug' => 'hotel',
			'script'    => 'script_hotel',
			'content'   => 'page_hotel',
			'hotels'    => $hotels,
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function add()
	{
		$this->load->model('admin/AdminModel', 'admin_model');

		$this->_data = [
			'title'      => 'เพิ่มข้อมูลโรงแรม',
			'menu_slug'  => 'hotel',
			'script'     => 'script_hotel',
			'content'    => 'page_hotel_add',
			'all_admins' => $this->admin_model->getAdminsByPermission(2),
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('hotel'));
			return;
		}
		$this->hotel->resetAutoIncrement();
		$max_order = $this->hotel->getMaxOrder();
		$new_order = $max_order + 1;

		$data = [
			'title_th'       => $this->input->post('hotel_name_th'),
			'title_en'       => $this->input->post('hotel_name_en'),
			'description_th' => $this->input->post('hotel_desc_th'),
			'description_en' => $this->input->post('hotel_desc_en'),
			'color' 		 => $this->input->post('hotel_color') ?: null,
			'sort_order'     => $this->input->post('sort_order') ?: $new_order,
			'status'         => 1,
		];

		if (!empty($_FILES['hotel_img']['name'])) {
			$filename = upload_fileFix('hotel_img', '1370', '400', $this->upload_path);
			if ($filename) {
				$data['image'] = $filename;
			} else {
				$this->session->set_flashdata('result', 'false');
				$this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ กรุณาลองใหม่');
				redirect(admin_url('hotel/add'));
				return;
			}
		}

		$result = $this->hotel->insertHotel($data);

		if ($result == 'true') {
			$new_hotel_id = $this->db->insert_id();

			$admin_ids = $this->input->post('admin_ids') ?: [];
			if (!empty($admin_ids)) {
				$this->hotel->assignAdminsToHotel($new_hotel_id, $admin_ids);
			}

			$this->session->set_flashdata('result', 'true');
			$this->session->set_flashdata('message', 'เพิ่มข้อมูลโรงแรมเรียบร้อยแล้ว');
		} else {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'เกิดข้อผิดพลาด กรุณาลองใหม่');
		}
		redirect(admin_url('hotel'));
	}

	public function edit($id)
	{
		$hotelData = $this->hotel->getHotelById($id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$data = [
				'title_th'       => $this->input->post('hotel_name_th'),
				'description_th' => $this->input->post('hotel_desc_th'),
				'title_en'       => $this->input->post('hotel_name_en'),
				'description_en' => $this->input->post('hotel_desc_en'),
				'color' 		 => $this->input->post('hotel_color') ?: null,
			];

			if (!empty($_FILES['hotel_img']['name'])) {
				$filename = upload_fileFix('hotel_img', '1370', '400', $this->upload_path);
				if ($filename) {
					$data['image'] = $filename;
					if (!empty($hotelData['image'])) {
						$old_path = FCPATH . $hotelData['image'];
						if (file_exists($old_path)) @unlink($old_path);
					}
				}
			}

			$result = $this->hotel->updateHotel($id, $data);

			if ($result == 'true') {
				$admin_ids = $this->input->post('admin_ids') ?: [];
				$this->hotel->assignAdminsToHotel($id, $admin_ids);
				$this->session->set_flashdata('result', 'true');
				$this->session->set_flashdata('message', 'อัปเดตข้อมูลสำเร็จ');
			} else {
				$this->session->set_flashdata('result', 'false');
				$this->session->set_flashdata('message', 'ไม่สามารถอัปเดตข้อมูลได้');
			}
			redirect(admin_url('hotel'));
			return;
		}

		$this->load->model('admin/AdminModel', 'admin_model');

		$this->_data = [
			'title'           => 'แก้ไขข้อมูลโรงแรม',
			'menu_slug'       => 'hotel',
			'script'          => 'script_hotel',
			'content'         => 'page_hotel_edit',
			'hotelData'       => $hotelData,
			'all_admins'      => $this->admin_model->getAdminsByPermission(2),
			'assigned_admins' => $this->hotel->getAssignedAdminIds($id),
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function del($id = false)
	{
		if ($id == null) {
			redirect(admin_url('hotel'));
			return;
		}

		// ─────────────────────────────────────────────
		// 1. ลบรูปภาพหลักของโรงแรม (uploads/hotel/)
		// ─────────────────────────────────────────────
		$hotelData = $this->hotel->getHotelById($id);
		if ($hotelData && !empty($hotelData['image'])) {
			$path = FCPATH . 'uploads/hotel/' . $hotelData['image'];
			if (file_exists($path)) @unlink($path);
		}

		// ─────────────────────────────────────────────
		// 2. ลบรูป hotel_banner_image (uploads/banner_image/)
		// ─────────────────────────────────────────────
		$bannerImages = $this->db->get_where('hotel_banner_image', ['hotel_id' => $id])->result_array();
		foreach ($bannerImages as $row) {
			if (!empty($row['banner_image'])) {
				$path = FCPATH . 'uploads/banner_image/' . $row['banner_image'];
				if (file_exists($path)) @unlink($path);
			}
		}
		$this->db->delete('hotel_banner_image', ['hotel_id' => $id]);

		// ─────────────────────────────────────────────
		// 3. ลบรูป hotel_banner (uploads/banner/)
		// ─────────────────────────────────────────────
		$banners = $this->db->get_where('hotel_banner', ['hotel_id' => $id])->result_array();
		foreach ($banners as $row) {
			if (!empty($row['image'])) {
				$path = FCPATH . 'uploads/banner/' . $row['image'];
				if (file_exists($path)) @unlink($path);
			}
		}
		$this->db->delete('hotel_banner', ['hotel_id' => $id]);

		// ─────────────────────────────────────────────
		// 4. ลบรูป hotel_home_banner (มี FK CASCADE แต่ลบไฟล์เอง)
		// ─────────────────────────────────────────────
		$homeBanner = $this->db->get_where('hotel_home_banner', ['hotel_id' => $id])->row_array();
		if ($homeBanner) {
			foreach (['banner_backgroud_1', 'banner_hotel_image'] as $col) {
				if (!empty($homeBanner[$col])) {
					$path = FCPATH . 'uploads/home_banner/' . $homeBanner[$col];
					if (file_exists($path)) @unlink($path);
				}
			}
		}

		// ─────────────────────────────────────────────
		// 5. ลบรูป hotel_home_facilities (มี FK CASCADE แต่ลบไฟล์เอง)
		// ─────────────────────────────────────────────
		$homeFacilities = $this->db->get_where('hotel_home_facilities', ['hotel_id' => $id])->row_array();
		if ($homeFacilities) {
			foreach (['gallery_bg_img', 'facilities_bg_img'] as $col) {
				if (!empty($homeFacilities[$col])) {
					$path = FCPATH . 'uploads/home_facilities/' . $homeFacilities[$col];
					if (file_exists($path)) @unlink($path);
				}
			}
		}

		// ─────────────────────────────────────────────
		// 6. ลบรูป hotel_home_rooms (มี FK CASCADE แต่ลบไฟล์เอง)
		// ─────────────────────────────────────────────
		$homeRooms = $this->db->get_where('hotel_home_rooms', ['hotel_id' => $id])->row_array();
		if ($homeRooms && !empty($homeRooms['rooms_bg_img'])) {
			$path = FCPATH . 'uploads/home_rooms/' . $homeRooms['rooms_bg_img'];
			if (file_exists($path)) @unlink($path);
		}

		// ─────────────────────────────────────────────
		// 7. ลบรูป footer (มี FK CASCADE แต่ลบไฟล์เอง)
		// ─────────────────────────────────────────────
		$footer = $this->db->get_where('footer', ['hotel_id' => $id])->row_array();
		if ($footer && !empty($footer['logo'])) {
			$path = FCPATH . 'uploads/footer/' . $footer['logo'];
			if (file_exists($path)) @unlink($path);
		}

		// ─────────────────────────────────────────────
		// 8. ลบรูป facility (uploads/facility/)
		// ─────────────────────────────────────────────
		$facilities = $this->db->get_where('facility', ['hotel_id' => $id])->result_array();
		foreach ($facilities as $row) {
			if (!empty($row['image'])) {
				$path = FCPATH . 'uploads/facility/' . $row['image'];
				if (file_exists($path)) @unlink($path);
			}
		}
		$this->db->delete('facility', ['hotel_id' => $id]);

		// ─────────────────────────────────────────────
		// 9. ลบรูป other_slides (uploads/other_slides/)
		// ─────────────────────────────────────────────
		$otherSlides = $this->db->get_where('other_slides', ['hotel_id' => $id])->row_array();
		if ($otherSlides) {
			foreach (['img_room', 'img_facilities', 'img_gallery', 'img_contact'] as $col) {
				if (!empty($otherSlides[$col])) {
					$path = FCPATH . 'uploads/other_slides/' . $otherSlides[$col];
					if (file_exists($path)) @unlink($path);
				}
			}
			$this->db->delete('other_slides', ['hotel_id' => $id]);
		}

		// ─────────────────────────────────────────────
		// 10. ลบรูป gallery_category + gallery (uploads/gallery/)
		// ─────────────────────────────────────────────
		$galleryCategories = $this->db->get_where('gallery_category', ['hotel_id' => $id])->result_array();
		foreach ($galleryCategories as $cat) {
			if (!empty($cat['banner_image'])) {
				$path = FCPATH . 'uploads/gallery/' . $cat['banner_image'];
				if (file_exists($path)) @unlink($path);
			}
			$galleries = $this->db->get_where('gallery', ['category_id' => $cat['category_id']])->result_array();
			foreach ($galleries as $g) {
				if (!empty($g['image'])) {
					$path = FCPATH . 'uploads/gallery/' . $g['image'];
					if (file_exists($path)) @unlink($path);
				}
			}
			$this->db->delete('gallery', ['category_id' => $cat['category_id']]);
		}
		$this->db->delete('gallery_category', ['hotel_id' => $id]);

		$galleriesDirect = $this->db->get_where('gallery', ['hotel_id' => $id])->result_array();
		foreach ($galleriesDirect as $g) {
			if (!empty($g['image'])) {
				$path = FCPATH . 'uploads/gallery/' . $g['image'];
				if (file_exists($path)) @unlink($path);
			}
		}
		$this->db->delete('gallery', ['hotel_id' => $id]);

		// ─────────────────────────────────────────────
		// 11. ลบรูป room + room_gallery (room_facility CASCADE อัตโนมัติ)
		// ─────────────────────────────────────────────
		$rooms = $this->db->get_where('room', ['hotel_id' => $id])->result_array();
		foreach ($rooms as $room) {
			$roomImgCols = ['image', 'banner_image', 'amenity_bg_image', 'detail_banner_image', 'detail_bg_image', 'detail_image'];
			foreach ($roomImgCols as $col) {
				if (!empty($room[$col])) {
					$path = FCPATH . 'uploads/room/' . $room[$col];
					if (file_exists($path)) @unlink($path);
				}
			}

			$roomGalleries = $this->db->get_where('room_gallery', ['room_id' => $room['room_id']])->result_array();
			foreach ($roomGalleries as $rg) {
				if (!empty($rg['image'])) {
					$path = FCPATH . 'uploads/room/' . $rg['image'];
					if (file_exists($path)) @unlink($path);
				}
			}
		}
		$this->db->delete('room', ['hotel_id' => $id]);

		// ─────────────────────────────────────────────
		// 12. ยกเลิกการ assign admin และลบ hotel หลัก
		// ─────────────────────────────────────────────
		$this->hotel->unassignAdminsFromHotel($id);
		$result = $this->hotel->deleteHotel($id);

		$msg = ($result == 'true') ? 'ลบข้อมูลโรงแรมและข้อมูลที่เกี่ยวข้องทั้งหมดสำเร็จ.' : 'ลบข้อมูลไม่สำเร็จ.';
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $msg);
		redirect(admin_url('hotel'));
	}

	public function status($id = false, $active = false)
	{
		$result = $this->hotel->updateStatus($id, $active);
		if ($result == 'true') {
			$this->session->set_flashdata('result', 'true');
			$this->session->set_flashdata('message', 'อัพเดทสถานะสำเร็จ.');
		} else {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'อัพเดทสถานะไม่สำเร็จ.');
		}
		redirect(admin_url('hotel'));
	}
}
