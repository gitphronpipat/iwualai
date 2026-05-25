<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');
require_once(APPPATH . 'helpers/upload_file_helper.php');

class HotelHome extends Core_Controller
{
    private $upload_path = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/HotelHomeModel', 'home_model');
        $this->load->library('session');

        $this->upload_path = FCPATH . 'uploads/hotel_home/';
    }

    public function index()
    {
        $auth          = $this->session->userdata('_auth');
        $my_permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;
        $admin_id      = isset($auth['admin_id']) ? $auth['admin_id'] : null;

        if ($my_permission == 1) {
            $hotels = $this->home_model->getHotelsWithAdminList();
        } else {
            $hotels = $this->home_model->getHotelsByAdminId($admin_id);
        }

        $this->_data = [
            'title'     => 'ตั้งค่าหน้าหลัก (Home)',
            'menu_slug' => 'hotel_home',
            'script'    => 'script_hotel_home',
            'content'   => 'page_home',
            'hotels'    => $hotels,
        ];
        $this->load->view('admin/index', $this->_data);
    }

    public function edit($hotel_id)
    {
        $hotelData = $this->home_model->getHotelById($hotel_id);
        if (empty($hotelData)) {
            redirect(admin_url('hotel_home'));
            return;
        }

        $homeData = $this->home_model->getHomeByHotelId($hotel_id);

        $this->_data = [
            'title'     => 'ตั้งค่าหน้าหลัก — ' . ($hotelData['title_th'] ?? ''),
            'menu_slug' => 'hotel_home',
            'script'    => 'script_hotel_home',
            'content'   => 'page_home_edit',
            'hotelData' => $hotelData,
            'homeData'  => $homeData ?: [],
        ];
        $this->load->view('admin/index', $this->_data);
    }

    public function update($hotel_id)
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect(admin_url('hotel_home'));
            return;
        }

        $hotelData = $this->home_model->getHotelById($hotel_id);
        if (empty($hotelData)) {
            redirect(admin_url('hotel_home'));
            return;
        }

        $data = $this->_buildFormData();

        if (!empty($_FILES['banner_img']['name'])) {
            $filename = upload_fileFix('banner_img', '1920', '920', $this->upload_path);
            if ($filename) {
                $oldHome = $this->home_model->getHomeByHotelId($hotel_id);
                if (!empty($oldHome['banner_image'])) {
                    @unlink($this->upload_path . $oldHome['banner_image']);
                }
                $data['banner_image'] = $filename;
            } else {
                $this->session->set_flashdata('result', 'false');
                $this->session->set_flashdata('message', 'อัปโหลดรูปภาพไม่สำเร็จ');
                redirect(admin_url('hotel_home/edit/' . $hotel_id));
                return;
            }
        }

        $result = $this->home_model->saveHome($hotel_id, $data);

        if ($result == 'true') {
            $this->session->set_flashdata('result', 'true');
            $this->session->set_flashdata('message', 'อัปเดตข้อมูลหน้าหลักสำเร็จ');
        } else {
            $this->session->set_flashdata('result', 'false');
            $this->session->set_flashdata('message', 'ไม่สามารถอัปเดตข้อมูลได้');
        }
        redirect(admin_url('hotel_home'));
    }

    // ============================================================
    // Private helpers
    // ============================================================
    private function _buildFormData()
    {
        return [
            // Box 1: Banner
            'banner_title_th'        => $this->input->post('banner_title_th'),
            'banner_title_en'        => $this->input->post('banner_title_en'),
            'banner_desc_th'         => $this->input->post('banner_desc_th'),
            'banner_desc_en'         => $this->input->post('banner_desc_en'),
            // Box 2: About Us
            'about_title_th'         => $this->input->post('about_title_th'),
            'about_subtitle_th'      => $this->input->post('about_subtitle_th'),
            'about_desc_th'          => $this->input->post('about_desc_th'),
            'about_title_en'         => $this->input->post('about_title_en'),
            'about_subtitle_en'      => $this->input->post('about_subtitle_en'),
            'about_desc_en'          => $this->input->post('about_desc_en'),
            // Box 3: Rooms
            'rooms_desc_th'          => $this->input->post('rooms_desc_th'),
            'rooms_desc_en'          => $this->input->post('rooms_desc_en'),
            'rooms_gallery_count'    => (int)($this->input->post('rooms_gallery_count') ?: 2),
            // Box 4: Facilities
            'facilities_title_th'    => $this->input->post('facilities_title_th'),
            'facilities_subtitle_th' => $this->input->post('facilities_subtitle_th'),
            'facilities_desc_th'     => $this->input->post('facilities_desc_th'),
            'facilities_title_en'    => $this->input->post('facilities_title_en'),
            'facilities_subtitle_en' => $this->input->post('facilities_subtitle_en'),
            'facilities_desc_en'     => $this->input->post('facilities_desc_en'),
        ];
    }
}
