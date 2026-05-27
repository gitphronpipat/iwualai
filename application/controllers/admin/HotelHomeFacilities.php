<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');
require_once(APPPATH . 'helpers/upload_file_helper.php');

class HotelHomeFacilities extends Core_Controller
{
	private $upload_path = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/HotelHomeFacilitiesModel', 'facilities_model');
		$this->load->library('session');

		$this->upload_path = FCPATH . 'uploads/hotel_home/';
		// if (!is_dir($this->upload_path)) {
		// 	mkdir($this->upload_path, 0777, true);
		// }
	}

	// ----------------------------------------------------------------
	// แสดงหน้าจัดการ
	// ----------------------------------------------------------------
	public function index($hotel_id = null)
	{
		$hotel_id = $hotel_id ?? $this->uri->segment(4);
		if (empty($hotel_id)) show_404();

		$this->_data = [
			'title'          => 'จัดการ Facilities',
			'menu_slug'      => 'hotelhomefacilities_' . $hotel_id,
			'content'        => 'page_home_facilities',
			'hotelData'      => $this->facilities_model->get_hotel($hotel_id),
			'facilitiesData' => $this->facilities_model->get_home($hotel_id),
		];
		$this->load->view('admin/index', $this->_data);
	}

	// ----------------------------------------------------------------
	// บันทึกข้อมูลทั้งหมด (Section 3 Gallery + Section 4 Facilities)
	// ----------------------------------------------------------------
	public function create($hotel_id = null)
	{
		if (empty($hotel_id)) show_404();

		// --- Section 3 : Our Gallery ---
		$save = [
			'gallery_desc_th'        => $this->input->post('gallery_desc_th'),
			'gallery_desc_en'        => $this->input->post('gallery_desc_en'),
			'gallery_title_th'       => $this->input->post('gallery_title_th'),
			'gallery_title_en'       => $this->input->post('gallery_title_en'),
			'gallery_sub_title_th'    => $this->input->post('gallery_sub_title_th'),
			'gallery_sub_title_en'    => $this->input->post('gallery_sub_title_en'),

			// --- Section 4 : Our Facilities ---
			'facilities_title_th'    => $this->input->post('facilities_title_th'),
			'facilities_subtitle_th' => $this->input->post('facilities_subtitle_th'),
			'facilities_title_en'    => $this->input->post('facilities_title_en'),
			'facilities_subtitle_en' => $this->input->post('facilities_subtitle_en'),
		];

		// อัปโหลดรูป Background Gallery (Section 3)
		if (!empty($_FILES['gallery_bg_img']['name'])) {
			$this->_deleteOldImage($hotel_id, 'gallery_bg_img');
			$filename = upload_fileFix('gallery_bg_img', '1920', '750', $this->upload_path);
			if ($filename) {
				$save['gallery_bg_img'] = $filename;
			} else {
				$this->_flashError('อัปโหลดรูป Background Gallery ไม่สำเร็จ');
				redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
				return;
			}
		}

				// อัปโหลดรูป Background Gallery (Section 3)
		if (!empty($_FILES['pre_gal_one_img']['name'])) {
			$this->_deleteOldImage($hotel_id, 'pre_gal_one_img');
			$filename = upload_fileFix('pre_gal_one_img', '400', '300', $this->upload_path);
			if ($filename) {
				$save['pre_gal_one_img'] = $filename;
			} else {
				$this->_flashError('อัปโหลดรูป Preview Gallery ไม่สำเร็จ');
				redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
				return;
			}
		}

				// อัปโหลดรูป Background Gallery (Section 3)
		if (!empty($_FILES['pre_gal_two_img']['name'])) {
			$this->_deleteOldImage($hotel_id, 'pre_gal_two_img');
			$filename = upload_fileFix('pre_gal_two_img', '300', '200', $this->upload_path);
			if ($filename) {
				$save['pre_gal_two_img'] = $filename;
			} else {
				$this->_flashError('อัปโหลดรูป Preview Gallery ไม่สำเร็จ');
				redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
				return;
			}
		}

				// อัปโหลดรูป Background Gallery (Section 3)
		if (!empty($_FILES['pre_gal_three_img']['name'])) {
			$this->_deleteOldImage($hotel_id, 'pre_gal_three_img');
			$filename = upload_fileFix('pre_gal_three_img', '400', '300', $this->upload_path);
			if ($filename) {
				$save['pre_gal_three_img'] = $filename;
			} else {
				$this->_flashError('อัปโหลดรูป Preview Gallery ไม่สำเร็จ');
				redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
				return;
			}
		}

				// อัปโหลดรูป Background Gallery (Section 3)
		if (!empty($_FILES['pre_gal_four_img']['name'])) {
			$this->_deleteOldImage($hotel_id, 'pre_gal_four_img');
			$filename = upload_fileFix('pre_gal_four_img', '300', '200', $this->upload_path);
			if ($filename) {
				$save['pre_gal_four_img'] = $filename;
			} else {
				$this->_flashError('อัปโหลดรูป Preview Gallery ไม่สำเร็จ');
				redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
				return;
			}
		}

		

		// อัปโหลดรูป Background Facilities (Section 4)
		if (!empty($_FILES['facilities_bg_img']['name'])) {
			$this->_deleteOldImage($hotel_id, 'facilities_bg_img');
			$filename = upload_fileFix('facilities_bg_img', '600', '600', $this->upload_path);
			if ($filename) {
				$save['facilities_bg_img'] = $filename;
			} else {
				$this->_flashError('อัปโหลดรูป Background Facilities ไม่สำเร็จ');
				redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
				return;
			}
		}

		$this->facilities_model->save_home($hotel_id, $save);

		$this->session->set_flashdata('result', 'true');
		$this->session->set_flashdata('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
		redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
	}

	// ----------------------------------------------------------------
	// ลบรูป Background Gallery (Section 3)
	// ----------------------------------------------------------------
	public function clear_gallery_bg($hotel_id = null)
	{
		if (empty($hotel_id)) show_404();
		$this->_clearImageField($hotel_id, 'gallery_bg_img');
		redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
	}

	// ----------------------------------------------------------------
	// ลบรูป Background Facilities (Section 4)
	// ----------------------------------------------------------------
	public function clear_facilities_bg($hotel_id = null)
	{
		if (empty($hotel_id)) show_404();
		$this->_clearImageField($hotel_id, 'facilities_bg_img');
		redirect(admin_url('hotelhomefacilities/index/' . $hotel_id));
	}

	// ----------------------------------------------------------------
	// Private Helpers
	// ----------------------------------------------------------------

	private function _deleteOldImage($hotel_id, $field)
	{
		$home = $this->facilities_model->get_home($hotel_id);
		if (!empty($home[$field])) {
			$file = $this->upload_path . $home[$field];
			if (file_exists($file)) unlink($file);
		}
	}

	private function _clearImageField($hotel_id, $field)
	{
		$home = $this->facilities_model->get_home($hotel_id);
		if (!empty($home[$field])) {
			$file = $this->upload_path . $home[$field];
			if (file_exists($file)) unlink($file);
		}

		$this->facilities_model->clear_image_field($hotel_id, $field);

		$this->session->set_flashdata('result', 'true');
		$this->session->set_flashdata('message', 'ลบรูป Background เรียบร้อยแล้ว');
	}


	private function _flashError($message)
	{
		$this->session->set_flashdata('result', 'false');
		$this->session->set_flashdata('message', $message);
	}
}
