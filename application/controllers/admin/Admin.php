<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Admin extends Core_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/AdminModel', 'admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->input->post('order') == 'submit-order') {
			$ids = $this->input->post('id');
			$orders = $this->input->post('order_data');
			if ($ids) {
				foreach ($ids as $key => $id) {
					$this->admin->updateOrder($orders[$key], $id);
				}
				$this->session->set_flashdata(['result' => 'true', 'message' => 'อัพเดทลำดับสำเร็จ']);
			}
			redirect(admin_url('admin'));
		}
		$this->setPageData([
			'title'     => 'จัดการแอดมิน',
			'menu_slug' => 'admin',
			'content'   => 'page_admin'
		]);

		$this->_data['admins'] = $this->admin->_getAdmin();
		$this->load->view('admin/index', $this->_data);
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'ชื่อ-นามสกุล', 'required');
		$this->form_validation->set_rules('username', 'ชื่อผู้ใช้งาน', 'required|is_unique[admin.admin_user]');
		$this->form_validation->set_rules('password', 'รหัสผ่าน', 'required|min_length[6]');
		$this->form_validation->set_rules('password_cf', 'ยืนยันรหัสผ่าน', 'required|matches[password]');
		$this->form_validation->set_rules('permission', 'สิทธิ์การใช้งาน', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->model('admin/HotelModel', 'hotel');
			$this->_data['all_hotels'] = $this->hotel->getHotels();

			$this->setPageData([
				'title' => 'เพิ่มแอดมินใหม่',
				'menu_slug' => 'admin',
				'content' => 'page_admin_add'
			]);
			$this->load->view('admin/index', $this->_data);
		} else {
			$max_order = $this->admin->_getMaxOrder();
			$insert_data = [
				'admin_name'       => $this->input->post('name'),
				'admin_user'       => $this->input->post('username'),
				'admin_pass'       => md5($this->input->post('password')),
				'admin_realpass'   => $this->input->post('password'),
				'admin_permission' => $this->input->post('permission'),
				'admin_status'     => 1,
				'admin_sort'       => ($max_order['max_row'] + 1)
			];

			if ($this->admin->insert($insert_data) == 'true') {
				$this->session->set_flashdata(['result' => 'true', 'message' => 'บันทึกข้อมูลสำเร็จ']);
				redirect(admin_url('admin'));
			} else {
				$this->session->set_flashdata(['result' => 'false', 'message' => 'เกิดข้อผิดพลาด']);
				redirect(current_url());
			}
		}
	}

	public function edit($id = null)
	{
		if (!$id) redirect(admin_url('admin'));

		$this->form_validation->set_rules('name', 'ชื่อ-นามสกุล', 'required');
		$this->form_validation->set_rules('permission', 'สิทธิ์การใช้งาน', 'required');

		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'รหัสผ่าน', 'min_length[6]');
			$this->form_validation->set_rules('password_cf', 'ยืนยันรหัสผ่าน', 'matches[password]');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->setPageData([
				'title' => 'แก้ไขแอดมิน',
				'menu_slug' => 'admin',
				'content' => 'page_admin_edit'
			]);
			$this->_data['adminID'] = $this->admin->_getAdminID($id);
			$this->load->view('admin/index', $this->_data);
		} else {
			$update_data = [
				'admin_name'       => $this->input->post('name'),
				'admin_permission' => $this->input->post('permission')
			];

			if ($this->input->post('password')) {
				$update_data['admin_pass'] = md5($this->input->post('password'));
				$update_data['admin_realpass'] = $this->input->post('password');
			}

			if ($this->admin->update($update_data, $id) == 'true') {
				$this->session->set_flashdata(['result' => 'true', 'message' => 'แก้ไขข้อมูลสำเร็จ']);
				redirect(admin_url('admin'));
			} else {
				$this->session->set_flashdata(['result' => 'false', 'message' => 'เกิดข้อผิดพลาด']);
				redirect(current_url());
			}
		}
	}

	public function status($id, $status)
	{
		$this->admin->updateStatus($id, $status);
		$this->session->set_flashdata(['result' => 'true', 'message' => 'เปลี่ยนสถานะสำเร็จ']);
		redirect(admin_url('admin'));
	}

	public function update_inline()
	{
		$id    = $this->input->post('id');
		$field = $this->input->post('field');
		$value = $this->input->post('value');

		if ($id && $field) {
			$result = $this->admin->updateOrder($value, $id);

			if ($result == 'true') {
				echo json_encode(['result' => 'true']);
			} else {
				echo json_encode(['result' => 'false', 'message' => 'Update failed']);
			}
		} else {
			echo json_encode(['result' => 'false', 'message' => 'Invalid data']);
		}
		exit;
	}

	public function del($id)
	{
		$this->admin->delete($id);
		$this->session->set_flashdata(['result' => 'true', 'message' => 'ลบข้อมูลสำเร็จ']);
		redirect(admin_url('admin'));
	}
}
