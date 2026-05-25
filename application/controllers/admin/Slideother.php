<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');
require_once(APPPATH . 'helpers/upload_file_helper.php');

class Slideother extends Core_Controller
{
    private $upload_path;

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('_auth'))) {
            redirect(auth_url());
        }
        $this->load->model('admin/SlideotherModel', 'slide_other');
        $this->load->model('admin/HotelModel', 'hotel_model');

        $this->upload_path = FCPATH . 'uploads/slide_other/';
        if (!is_dir($this->upload_path)) mkdir($this->upload_path, 0755, true);
    }

    public function index($hotel_id = null)
    {
        $auth          = $this->session->userdata('_auth');
        $my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
        $admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

        $hotels = [];

        if ($my_permission === 1) {
            $hotels   = $this->hotel_model->getHotels();
            $hotel_id = $hotel_id ?: $this->input->get('hotel_id') ?: (!empty($hotels) ? $hotels[0]['hotel_id'] : null);
        } else {
            $permitted = $this->hotel_model->getPermittedHotelIds($admin_id);
            if (!$hotel_id || !in_array($hotel_id, $permitted)) {
                $hotel_id = !empty($permitted) ? $permitted[0] : null;
            }
        }

        $SlideotherData = $hotel_id ? $this->slide_other->getByHotelId($hotel_id) : [];

        // POST — บันทึกรูป
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $hotel_id) {
            $_form = ['hotel_id' => $hotel_id];

            foreach (['img_room', 'img_facilities', 'img_gallery', 'img_contact'] as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $filename = upload_fileFix($field, '1920', '600', $this->upload_path);
                    if ($filename) {
                        if (!empty($SlideotherData[$field])) {
                            $this->_deleteOldFile($SlideotherData[$field]);
                        }
                        $_form[$field] = $filename;
                    } else {
                        $this->session->set_flashdata('result', 'false');
                        $this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ กรุณาลองใหม่');
                        redirect(admin_url('slideother/index/' . $hotel_id));
                        return;
                    }
                } else {
                    if (!empty($SlideotherData[$field])) {
                        $_form[$field] = $SlideotherData[$field];
                    }
                }
            }

            if (empty($SlideotherData)) {
                $result = $this->slide_other->insert($_form);
            } else {
                $result = $this->slide_other->update($_form, $SlideotherData['other_slide_id']);
            }

            $this->session->set_flashdata('result',  $result === 'true' ? 'true' : 'false');
            $this->session->set_flashdata('message', $result === 'true' ? 'บันทึกข้อมูลเรียบร้อยแล้ว' : 'ไม่สามารถบันทึกข้อมูลได้');
            redirect(admin_url('slideother/index/' . $hotel_id));
            return;
        }

        $this->_data = [
            'title'          => 'สไลด์อื่น ๆ',
            'menu_slug'      => 'slide_other_' . $hotel_id,
            'content'        => 'page_slide_other',
            'SlideotherData' => $SlideotherData,
            'hotels'         => $hotels,
            'hotel_id'       => $hotel_id,
            'my_permission'  => $my_permission,
        ];
        $this->load->view('admin/index', $this->_data);
    }

    // ==========================================
    // Private Helpers
    // ==========================================

    private function _deleteOldFile($filename)
    {
        if (empty($filename)) return;

        $filename = basename($filename);

        $possible_paths = [
            FCPATH . 'uploads/slide_other/'  . $filename,  
            FCPATH . 'uploads/other_slides/' . $filename,  
        ];

        foreach ($possible_paths as $path) {
            if (file_exists($path) && is_file($path)) {
                @unlink($path);
            }
        }
    }
}
