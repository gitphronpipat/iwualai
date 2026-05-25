<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Facility extends Core_Controller
{
	private $upload_path = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/FacilityModel', 'facility');
		$this->load->library('form_validation');

		$this->upload_path = FCPATH . 'uploads/facility/';
		// if (!is_dir($this->upload_path)) {
		// 	mkdir($this->upload_path, 0777, true);
		// }
	}
	private function _getAdminHotelId()
	{
		$auth          = $this->session->userdata('_auth');
		$my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
		$admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

		if ($my_permission === 1) {
			return null;
		}

		$this->load->model('admin/HotelModel', 'hotel_model');
		$permitted = $this->hotel_model->getPermittedHotelIds($admin_id);
		return !empty($permitted) ? $permitted[0] : null;
	}

	private function _getHotels()
	{
		$auth          = $this->session->userdata('_auth');
		$my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
		$admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

		$this->load->model('admin/HotelModel', 'hotel_model');

		if ($my_permission === 1) {
			return $this->hotel_model->getHotels();
		}

		$permitted = $this->hotel_model->getPermittedHotelIds($admin_id);
		return !empty($permitted) ? $this->hotel_model->getHotelsByIds($permitted) : [];
	}

	public function index($hotel_id = null)
	{
		if ($this->input->post('order') == 'submit-order') {
			$ids    = $this->input->post('id');
			$orders = $this->input->post('order_data');
			if ($ids) {
				foreach ($ids as $key => $id) {
					$this->facility->updateOrder($orders[$key], $id);
				}
				$this->session->set_flashdata('result', 'true');
				$this->session->set_flashdata('message', 'อัพเดทลำดับสำเร็จ');
			}
			redirect(admin_url('facility/index/' . $hotel_id));
			return;
		}

		if ($hotel_id) {
			$hotel_id = (int)$hotel_id;
		} else {
			$hotel_id = $this->_getAdminHotelId();
		}

		$this->setPageData([
			'title'     => 'จัดการสิ่งอำนวยความสะดวก',
			'menu_slug' => 'facility_' . $hotel_id,
			'script'    => 'script_facility',
			'content'   => 'page_facility'
		]);

		$this->_data['facilities'] = $this->facility->_getData($hotel_id);
		$this->_data['hotels']     = $this->_getHotels();
		$this->_data['hotel_id']   = $hotel_id;
		$this->load->view('admin/index', $this->_data);
	}
	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('facility'));
			return;
		}

		$hotel_id       = (int)($this->input->post('hotel_id') ?: $this->_getAdminHotelId());
		$new_sort_order = $this->facility->_getMaxOrderByHotelId($hotel_id) + 1;

		$insert_data = [
			'hotel_id'      => $hotel_id,
			'facility_name' => $this->input->post('facility_name'),
			'sort_order'    => $new_sort_order,
			'status'        => 1,
		];

		if (!empty($_FILES['image']['name'])) {
			$filename = upload_fileFix('image', '380', '400', $this->upload_path);
			if ($filename) {
				$insert_data['image'] = $filename;
			} else {
				$this->session->set_flashdata('result', 'false');
				$this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ');
				redirect(admin_url('facility/index/' . $hotel_id));
				return;
			}
		}

		$result = $this->facility->insert($insert_data);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'บันทึกข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาด กรุณาลองใหม่');
		redirect(admin_url('facility/index/' . $hotel_id)); 
	}

	public function edit($id = null)
	{
		if (!$id) redirect(admin_url('facility'));

		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect(admin_url('facility'));
			return;
		}

		$hotel_id     = $this->_getAdminHotelId();
		$facilityData = $this->facility->_getDataID($id);

		if (empty($facilityData)) {
			redirect(admin_url('facility'));
			return;
		}

		if ($hotel_id !== null && $facilityData['hotel_id'] != $hotel_id) {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'คุณไม่มีสิทธิ์แก้ไขข้อมูลนี้');
			redirect(admin_url('facility'));
			return;
		}

		$update_data = [
			'facility_name' => $this->input->post('facility_name'),
		];

		if ($hotel_id === null && $this->input->post('hotel_id')) {
			$update_data['hotel_id'] = $this->input->post('hotel_id');
		}

		if (!empty($_FILES['image']['name'])) {
			$filename = upload_fileFix('image', '380', '400', $this->upload_path);
			if ($filename) {
				if (!empty($facilityData['image'])) {
					$old_path = $this->upload_path . basename($facilityData['image']);
					if (file_exists($old_path)) @unlink($old_path);
				}
				$update_data['image'] = $filename;
			} else {
				$this->session->set_flashdata('result', 'false');
				$this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ');
				redirect(admin_url('facility'));
				return;
			}
		}

		$result = $this->facility->update($update_data, $id);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'แก้ไขข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาด กรุณาลองใหม่');
		redirect(admin_url('facility/index/' . $facilityData['hotel_id']));
	}

	public function status($id, $status)
	{
		$hotel_id     = $this->_getAdminHotelId();
		$facilityData = $this->facility->_getDataID($id);

		if ($hotel_id !== null && (!$facilityData || $facilityData['hotel_id'] != $hotel_id)) {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'คุณไม่มีสิทธิ์เปลี่ยนสถานะข้อมูลนี้');
			redirect(admin_url('facility/index/' . $facilityData['hotel_id']));
			return;
		}

		$result = $this->facility->updateStatus($id, $status);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'เปลี่ยนสถานะสำเร็จ' : 'เปลี่ยนสถานะไม่สำเร็จ');
		redirect(admin_url('facility/index/' . $facilityData['hotel_id']));
	}


	public function update_inline()
	{
		$id    = $this->input->post('id');
		$field = $this->input->post('field');
		$value = $this->input->post('value');

		if ($id && $field) {
			$result = $this->facility->updateOrder($value, $id);
			echo json_encode(
				$result == 'true'
					? ['result' => 'true']
					: ['result' => 'false', 'message' => 'Update failed']
			);
		} else {
			echo json_encode(['result' => 'false', 'message' => 'Invalid data']);
		}
		exit;
	}

	public function del($id)
	{
		$hotel_id     = $this->_getAdminHotelId();
		$facilityData = $this->facility->_getDataID($id);

		if ($hotel_id !== null && (!$facilityData || $facilityData['hotel_id'] != $hotel_id)) {
			$this->session->set_flashdata('result', 'false');
			$this->session->set_flashdata('message', 'คุณไม่มีสิทธิ์ลบข้อมูลนี้');
			redirect(admin_url('facility'));
			return;
		}

		if (!empty($facilityData['image'])) {
			$old_path = $this->upload_path . basename($facilityData['image']);
			if (file_exists($old_path)) @unlink($old_path);
		}

		$result = $this->facility->delete($id);
		$this->session->set_flashdata('result', $result);
		$this->session->set_flashdata('message', $result == 'true' ? 'ลบข้อมูลสำเร็จ' : 'ลบข้อมูลไม่สำเร็จ');
		redirect(admin_url('facility/index/' . $facilityData['hotel_id']));
	}
}
