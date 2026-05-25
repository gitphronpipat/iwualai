<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Banner extends Core_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/BannerModel', 'banner');
		$this->load->library('session');

		// if (!is_dir('./uploads/banner/')) mkdir('./uploads/banner/', 0777, true);
	}

	public function index()
	{
		if ($this->input->post('order') == 'submit-order') {
			$id = $this->input->post('id');
			if ($id) {
				$order = $this->input->post('order_data');
				for ($i = 0; $i < count($id); $i++) {
					$result = $this->banner->updateOrder($order[$i], $id[$i]);
				}
				$msg = ($result == 'true') ? 'อัพเดทข้อมูลลำดับสำเร็จ.' : 'อัพเดทข้อมูลลำดับไม่สำเร็จ.';
				$this->session->set_flashdata('result', $result);
				$this->session->set_flashdata('message', $msg);
				redirect(admin_url('banner'));
			} else {
				redirect(admin_url('banner'));
			}
		}

		$this->_data = [
			'title'     => 'จัดการ Banner',
			'menu_slug' => 'banner',
			'script'    => 'script_banner',
			'content'   => 'page_banner',
			'banners'   => $this->banner->getBanners(),
		];
		$this->load->view('admin/index', $this->_data);
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('banner'));
			return;
		}

		if (empty($_FILES['banner_img']['name'])) {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'กรุณาเลือกรูปภาพ Banner');
			redirect(admin_url('banner/add'));
			return;
		}

		$banner_img = null;
		$filename   = upload_fileFix('banner_img', '1920', '920', './uploads/banner/');
		if ($filename) {
			$this->banner->resetAutoIncrement();
			$banner_img = 'uploads/banner/' . $filename;
		}

		if ($banner_img) {
			$this->banner->resetAutoIncrement();

			$max_order = $this->banner->getMaxOrder();
			$new_order = $max_order + 1;

			$data = [
				'image'      => $filename,
				'sort_order' => $new_order,
				'status'     => 1,
			];

			$result = $this->banner->insertBanner($data);
			$msg    = ($result == 'true')
				? 'บันทึก Banner ลำดับที่ ' . $new_order . ' เรียบร้อยแล้ว'
				: 'บันทึก Banner ไม่สำเร็จ กรุณาลองใหม่อีกครั้ง';
			$this->session->set_flashdata('result', $result);
			$this->session->set_flashdata('message', $msg);
		} else {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
		}

		redirect(admin_url('banner'));
	}
	public function edit($id)
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('banner'));
			return;
		}

		$current    = $this->banner->getBannerById($id);
		$old_img    = $current['image'] ?? null;
		$banner_img = basename($old_img);

		if (!empty($_FILES['banner_img']['name'])) {
			$filename = upload_fileFix('banner_img', '1920', '920', './uploads/banner/');
			if ($filename) {
				if (!empty($old_img) && file_exists('./' . $old_img)) {
					@unlink('./' . $old_img);
				}
				$banner_img = $filename;
			}
		}
		$data = [
			'image'      => $banner_img,
			'sort_order' => $current['sort_order'],
			'status'     => $current['status'],
		];

		$result = $this->banner->updateBanner($id, $data);
		$msg    = ($result == 'true') ? 'แก้ไข Banner เรียบร้อยแล้ว' : 'แก้ไข Banner ไม่สำเร็จ';
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $msg);
		redirect(admin_url('banner'));
	}

	public function del($id = false)
	{
		if ($id != null) {
			$banner = $this->banner->getBannerById($id);
			if ($banner && !empty($banner['image'])) {
				$full_path = './' . $banner['image'];
				if (file_exists($full_path)) {
					@unlink($full_path);
				}
			}

			$result = $this->banner->deleteBanner($id);
			$msg    = ($result == 'true') ? 'ลบข้อมูลสำเร็จ.' : 'ลบข้อมูลไม่สำเร็จ.';
			$this->session->set_flashdata('result', $result);
			$this->session->set_flashdata('message', $msg);
			redirect(admin_url('banner'));
		} else {
			redirect(admin_url('banner'));
		}
	}

	public function status($id = false, $active = false)
	{
		$result = $this->banner->updateStatus($id, $active);
		$msg    = ($result == 'true') ? 'อัพเดทสถานะสำเร็จ.' : 'อัพเดทสถานะไม่สำเร็จ.';
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $msg);
		redirect(admin_url('banner'));
	}
}
