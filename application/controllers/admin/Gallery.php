<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Gallery extends Core_Controller
{
	private $upload_path = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/GalleryModel', 'gallery');
		$this->load->model('admin/HotelModel', 'hotel');
		$this->load->library('session');

		$this->upload_path = FCPATH . 'uploads/gallery/';
		if (!is_dir($this->upload_path)) mkdir($this->upload_path, 0777, true);
	}

	// ── หน้าหลัก ───────────────────────────────────────────
	// ── หน้าหลัก (แสดงทุก category) ───────────────────────────────────────────
	public function index($hotel_id = 0)
	{
		$hotelData = $this->hotel->getHotelById($hotel_id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$this->_data = [
			'title'       => 'จัดการ Gallery — ' . ($hotelData['title_th'] ?? ''),
			'menu_slug'   => 'gallery_' . $hotel_id,
			'script'      => 'script_gallery',
			'content'     => 'page_gallery',
			'hotelData'   => $hotelData,
			'categories'  => $this->gallery->getCategoriesByHotel($hotel_id),
			'images'      => $this->gallery->getImagesByHotel($hotel_id),
			'active_cat'  => null,   // ไม่ได้กรอง
		];
		$this->load->view('admin/index', $this->_data);
	}

	// ── หน้า gallery กรองตาม category ─────────────────────────────────────────
	public function category($hotel_id = 0, $category_id = 0)
	{
		$hotelData = $this->hotel->getHotelById($hotel_id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$catData = $this->gallery->getCategoryById($category_id);
		if (empty($catData)) {
			redirect(admin_url('gallery/index/' . $hotel_id));
			return;
		}

		$catLabel = $catData['name_th'] ?? '';
		if (!empty($catData['name_en'])) $catLabel .= ' (' . $catData['name_en'] . ')';

		$this->_data = [
			'title'      => 'Gallery — ' . $catLabel,
			'menu_slug'  => 'gallery_cat_' . $category_id,
			'script'     => 'script_gallery',
			'content'    => 'page_gallery',
			'hotelData'  => $hotelData,
			'categories' => $this->gallery->getCategoriesByHotel($hotel_id),
			'images'     => $this->gallery->getImagesByCategory($hotel_id, $category_id),
			'active_cat' => (int)$category_id,
		];
		$this->load->view('admin/index', $this->_data);
	}
	// ── บันทึกหมวดหมู่ ─────────────────────────────────────
	public function save_categories($hotel_id = 0)
	{
		$hotelData = $this->hotel->getHotelById($hotel_id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$ids      = $this->input->post('category_id') ?: [];
		$names_th = $this->input->post('name_th')      ?: [];
		$names_en = $this->input->post('name_en')      ?: [];

		// ลบ categories ที่ถูกเอาออกจาก form
		// หา category_id ที่กำลังจะถูกลบ (เพื่อลบรูปใน gallery ด้วย)
		$existing_ids    = array_column($this->gallery->getCategoriesByHotel($hotel_id), 'category_id');
		$submitted_ids   = array_values(array_filter($ids, fn($id) => !empty($id)));
		$to_delete_ids   = array_diff($existing_ids, $submitted_ids);

		if (!empty($to_delete_ids)) {
			// ลบไฟล์รูปจาก disk และ record ใน gallery ก่อน
			$this->_deleteImagesByCategoryIds($to_delete_ids);
		}

		if (!empty($submitted_ids)) {
			$this->gallery->deleteCategoriesNotIn($hotel_id, $submitted_ids);
		} else {
			// ลบทุก category → ลบรูปทั้งหมดของ hotel นี้ด้วย
			$this->_deleteImagesByCategoryIds($existing_ids);
			$this->gallery->deleteAllCategories($hotel_id);
		}

		$result = $this->gallery->saveCategories($hotel_id, $ids, $names_th, $names_en);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'บันทึกหมวดหมู่สำเร็จ' : 'เกิดข้อผิดพลาด');

		$active_cat = (int)$this->input->post('active_cat');
		if ($active_cat > 0 && in_array($active_cat, $submitted_ids)) {
			redirect(admin_url('gallery/category/' . $hotel_id . '/' . $active_cat));
		} else {
			redirect(admin_url('gallery/index/' . $hotel_id));
		}
	}

	private function _deleteImagesByCategoryIds(array $category_ids)
	{
		if (empty($category_ids)) return;

		foreach ($category_ids as $cat_id) {
			$images = $this->gallery->getImagesByCategory(0, $cat_id, true);
			foreach ($images as $img) {
				if (!empty($img['image'])) {
					$old = FCPATH . 'uploads/gallery/' . basename($img['image']);
					if (file_exists($old)) @unlink($old);
				}
			}
			$this->gallery->deleteImagesByCategoryId($cat_id);
		}
	}

	public function create($hotel_id = 0)
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('gallery/index/' . $hotel_id));
			return;
		}

		$hotelData = $this->hotel->getHotelById($hotel_id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$category_id = $this->input->post('category_id');
		$files       = $_FILES['gallery_images'] ?? [];
		$uploaded    = 0;

		if (!empty($files['name'][0])) {
			$count     = count($files['name']);
			$filenames = upload_fileFix_array('gallery_images', $count, '', '', $this->upload_path);

			if (!empty($filenames)) {
				foreach ($filenames as $filename) {
					if (empty($filename)) continue;

					$this->gallery->insertImage([
						'hotel_id'    => $hotel_id,
						'category_id' => $category_id,
						'image'       => $filename,
						'sort_order'  => $this->gallery->getMaxOrder($hotel_id, $category_id) + 1,
						'status'      => 1,
					]);
					$uploaded++;
				}
			}
		}

		$this->session->set_flashdata('result', $uploaded > 0 ? 'true' : 'false');
		$this->session->set_flashdata('message', $uploaded > 0 ? "เพิ่มรูปภาพสำเร็จ {$uploaded} รูป" : 'อัปโหลดไม่สำเร็จ');

		if (!empty($category_id)) {
			redirect(admin_url('gallery/category/' . $hotel_id . '/' . $category_id));
		} else {
			redirect(admin_url('gallery/index/' . $hotel_id));
		}
	}

	// ── แก้ไขรูปภาพ ────────────────────────────────────────
	public function edit($gallery_id = 0)
	{
		$img = $this->gallery->getImageById($gallery_id);
		if (empty($img)) {
			redirect(admin_url('hotel'));
			return;
		}

		$hotel_id = $img['hotel_id'];
		$data     = ['category_id' => $this->input->post('category_id') ?: $img['category_id']];

		if (!empty($_FILES['gallery_image']['name'])) {
			$filename = upload_fileFix('gallery_image', '', '', $this->upload_path);
			if ($filename) {
				if (!empty($img['image'])) {
					$old = FCPATH . 'uploads/gallery/' . basename($img['image']);
					if (file_exists($old)) @unlink($old);
				}
				$data['image'] = $filename;
			}
		}

		$result = $this->gallery->updateImage($gallery_id, $data);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'แก้ไขรูปภาพสำเร็จ' : 'เกิดข้อผิดพลาด');

		$cat_id = $data['category_id'] ?? $img['category_id'];
		if (!empty($cat_id)) {
			redirect(admin_url('gallery/category/' . $hotel_id . '/' . $cat_id));
		} else {
			redirect(admin_url('gallery/index/' . $hotel_id));
		}
	}

	// ── ลบรูปภาพ ───────────────────────────────────────────
	public function delete($gallery_id = 0)
	{
		$img = $this->gallery->getImageById($gallery_id);
		if (empty($img)) {
			redirect(admin_url('hotel'));
			return;
		}

		// เก็บไว้ก่อน เพราะหลังลบแล้วดึงไม่ได้
		$hotel_id    = $img['hotel_id'];
		$category_id = $img['category_id'];

		// image จาก model มี 'uploads/gallery/xxx.jpg' อยู่แล้ว ต้องใช้ FCPATH
		if (!empty($img['image'])) {
			$old = FCPATH . $img['image'];
			if (file_exists($old)) @unlink($old);
		}

		$result = $this->gallery->deleteImage($gallery_id);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'ลบรูปภาพสำเร็จ' : 'ลบรูปภาพไม่สำเร็จ');

		if (!empty($category_id)) {
			redirect(admin_url('gallery/category/' . $hotel_id . '/' . $category_id));
		} else {
			redirect(admin_url('gallery/index/' . $hotel_id));
		}
	}

	// ── สถานะ ───────────────────────────────────────────────
	public function status($gallery_id = 0, $active = 0)
	{
		$img = $this->gallery->getImageById($gallery_id);
		if (empty($img)) {
			redirect(admin_url('hotel'));
			return;
		}

		$result = $this->gallery->updateStatus($gallery_id, $active);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'อัพเดทสถานะสำเร็จ' : 'อัพเดทสถานะไม่สำเร็จ');

		if (!empty($img['category_id'])) {
			redirect(admin_url('gallery/category/' . $img['hotel_id'] . '/' . $img['category_id']));
		} else {
			redirect(admin_url('gallery/index/' . $img['hotel_id']));
		}
	}

	// ── เรียงลำดับ ──────────────────────────────────────────
	public function order($hotel_id = 0)
	{
		if ($this->input->post('do_action') == 'submit-order') {
			$ids   = $this->input->post('id')         ?: [];
			$order = $this->input->post('order_data') ?: [];
			foreach ($ids as $i => $id) {
				$this->gallery->updateOrder($order[$i], $id);
			}
			$this->session->set_flashdata('result', 'true');
			$this->session->set_flashdata('message', 'อัพเดทลำดับสำเร็จ');
		}

		$active_cat = (int)$this->input->post('active_cat');
		if ($active_cat > 0) {
			redirect(admin_url('gallery/category/' . $hotel_id . '/' . $active_cat));
		} else {
			redirect(admin_url('gallery/index/' . $hotel_id));
		}
	}
}
