<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Footer extends Core_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/FooterModel', 'footer');
		$this->load->helper('upload_file');
	}

	public function index($hotel_id = null)
	{
		$auth     = $this->session->userdata('_auth');
		$hotel_id = $hotel_id ?: ($auth['hotel_id'] ?? null);
		$hotel_id = $this->_getCleanHotelId($hotel_id);

		$footerData = $this->footer->_getFooter($hotel_id);

		if (empty($footerData)) {
			$footerData = ['phone' => '[]', 'email' => '[]', 'hotel_id' => $hotel_id,];
		}

		$footerData['phone'] = json_decode($footerData['phone'] ?? '[]', true);
		$footerData['email'] = json_decode($footerData['email'] ?? '[]', true);

		if ($this->input->post()) {
			$_form = [
				'hotel_id'       => $hotel_id,
				'description_th' => $this->input->post('description_th'),
				'description_en' => $this->input->post('description_en'),
				'address_th'     => $this->input->post('address_th'),
				'address_en'     => $this->input->post('address_en'),
				'phone'          => json_encode($this->input->post('phone')),
				'email'          => json_encode($this->input->post('email')),
				'facebook_url'   => $this->input->post('facebook_url'),
				'instagram_url'  => $this->input->post('instagram_url'),
				'line_url'       => $this->input->post('line_url'),
				'map_url'        => $this->input->post('map_url'),
			];

			if (!empty($_FILES['logo']['name'])) {
				if (!empty($footerData['logo']) && file_exists('./uploads/footer/' . $footerData['logo'])) {
					unlink('./uploads/footer/' . $footerData['logo']);
				}
				$_form['logo'] = upload_file('logo', 135, 55, './uploads/footer/');
			}

			if (empty($footerData['footer_id'])) {
				$result = $this->footer->insert($_form);
			} else {
				$result = $this->footer->update($_form, $footerData['footer_id']);
			}

			$this->session->set_flashdata('result', $result ? 'true' : 'false');
			$this->session->set_flashdata('message', $result ? 'บันทึกข้อมูลเรียบร้อยแล้ว' : 'ไม่สามารถบันทึกข้อมูลได้');
			redirect(admin_url('footer/index/' . $hotel_id));
		}

		$this->_data = [
			'title'      => 'ส่วนท้าย',
			'menu_slug'  => 'footer' . $hotel_id,
			'script'     => 'script_footer',
			'content'    => 'page_footer',
			'footerData' => $footerData,
			'hotel_id'   => $hotel_id, 
		];
		$this->load->view('admin/index', $this->_data);
	}
}
