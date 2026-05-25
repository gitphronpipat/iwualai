<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class HotelBannnerImage extends Core_Controller
{
	private $upload_path = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/HotelBannnerImageModel', 'banner_img');
		$this->load->model('admin/HotelModel', 'hotel');
		$this->load->library('session');

		$this->upload_path = FCPATH . 'uploads/hotel_home/';
		// if (!is_dir($this->upload_path)) mkdir($this->upload_path, 0777, true);
	}

	public function index($hotel_id = 0)
	{
		$hotelData = $this->hotel->getHotelById($hotel_id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$this->_data = [
			'title'        => 'จัดการรูปภาพ Banner — ' . ($hotelData['title_th'] ?? ''),
			'menu_slug'    => 'hotelhomeimage_' . $hotel_id,
			'script'       => 'script_hotelhomeimage',
			'content'      => 'page_hotel_banner_image',
			'hotelData'    => $hotelData,
			'banners'      => $this->banner_img->getBannersByHotelId($hotel_id),
			'url_check_in' => $this->banner_img->getUrlCheckinByHotelId($hotel_id), 
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function create($hotel_id = 0)
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
			return;
		}

		$hotelData = $this->hotel->getHotelById($hotel_id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$data = [
			'hotel_id'   => $hotel_id,
			'sort_order' => $this->banner_img->getMaxOrder($hotel_id) + 1,
			'status'     => 1,
		];

		if (!empty($_FILES['banner_image']['name'])) {
			$filename = upload_fileFix('banner_image', '1920', '720', $this->upload_path);
			if ($filename) {
				$data['banner_image'] = $filename;
			} else {
				$this->session->set_flashdata('result', 'false');
				$this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ');
				redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
				return;
			}
		}

		$result = $this->banner_img->insertBanner($data);

		if ($result == 'true') {
			$existingUrl = $this->banner_img->getUrlCheckinByHotelId($hotel_id);
			if ($existingUrl) {
				$newId = $this->db->insert_id();
				$this->banner_img->updateBanner($newId, ['url_check_in' => $existingUrl]);
			}
		}

		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'เพิ่มรูปภาพ Banner สำเร็จ' : 'เกิดข้อผิดพลาด กรุณาลองใหม่');
		redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
	}

	public function edit($id = 0)
	{
		$bannerData = $this->banner_img->getBannerById($id);
		if (empty($bannerData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$hotel_id = $bannerData['hotel_id'];
		$data     = [
			'url_check_in' => $this->input->post('url_check_in') ?: null,
		];

		if (!empty($_FILES['banner_image']['name'])) {
			$filename = upload_fileFix('banner_image', '1920', '720', $this->upload_path);
			if ($filename) {
				if (!empty($bannerData['banner_image'])) {
					$old_path = FCPATH . 'uploads/hotel_home/' . basename($bannerData['banner_image']);
					if (file_exists($old_path)) @unlink($old_path);
				}
				$data['banner_image'] = $filename;
			} else {
				$this->session->set_flashdata('result', 'false');
				$this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ');
				redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
				return;
			}
		}

		$result = $this->banner_img->updateBanner($id, $data);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'อัปเดตรูปภาพสำเร็จ' : 'เกิดข้อผิดพลาด กรุณาลองใหม่');
		redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
	}

	public function delete($id = 0)
	{
		$bannerData = $this->banner_img->getBannerById($id);
		if (empty($bannerData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$hotel_id = $bannerData['hotel_id'];

		if (!empty($bannerData['banner_image'])) {
			$old_path = FCPATH . 'uploads/hotel_home/' . basename($bannerData['banner_image']);
			if (file_exists($old_path)) @unlink($old_path);
		}

		$result = $this->banner_img->deleteBanner($id);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'ลบรูปภาพสำเร็จ' : 'ลบรูปภาพไม่สำเร็จ');
		redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
	}

	public function status($id = 0, $active = 0)
	{
		$bannerData = $this->banner_img->getBannerById($id);
		if (empty($bannerData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$result = $this->banner_img->updateStatus($id, $active);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'อัพเดทสถานะสำเร็จ' : 'อัพเดทสถานะไม่สำเร็จ');
		redirect(admin_url('hotelbannnerimage/index/' . $bannerData['hotel_id']));
	}

	public function order($hotel_id = 0)
	{
		if ($this->input->post('do_action') == 'submit-order') {
			$ids   = $this->input->post('id');
			$order = $this->input->post('order_data');
			if ($ids) {
				for ($i = 0; $i < count($ids); $i++) {
					$this->banner_img->updateOrder($order[$i], $ids[$i]);
				}
				$this->session->set_flashdata('result', 'true');
				$this->session->set_flashdata('message', 'อัพเดทลำดับสำเร็จ');
			}
		}
		redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
	}

	public function update_url($hotel_id = 0)
	{
		$hotelData = $this->hotel->getHotelById($hotel_id);
		if (empty($hotelData)) {
			redirect(admin_url('hotel'));
			return;
		}

		$url     = $this->input->post('url_check_in') ?: null;
		$banners = $this->banner_img->getBannersByHotelId($hotel_id);

		if (!empty($banners)) {
			foreach ($banners as $banner) {
				$this->banner_img->updateBanner($banner['id'], ['url_check_in' => $url]);
			}
			$result = 'true';
		} else {
			$result = 'false';
		}

		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'อัปเดตลิงก์สำเร็จ' : 'ไม่พบ Banner กรุณาเพิ่ม Banner ก่อน');
		redirect(admin_url('hotelbannnerimage/index/' . $hotel_id));
	}
}
