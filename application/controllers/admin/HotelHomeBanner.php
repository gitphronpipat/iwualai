<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');
require_once(APPPATH . 'helpers/upload_file_helper.php');

class HotelHomeBanner extends Core_Controller
{
    private string $upload_path = '';

    private array $image_columns = [
        'banner_image',
        'banner_backgroud_1',
        'banner_hotel_image',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/HotelHomeBannerModel', 'home_banner');
        $this->load->library('session');

        $this->upload_path = FCPATH . 'uploads/hotel_home/';
        // if (!is_dir($this->upload_path)) {
        //     mkdir($this->upload_path, 0777, true);
        // }
    }

    // ─────────────────────────────────────────────
    //  Index — แสดงฟอร์ม
    // ─────────────────────────────────────────────

    public function index(int $hotel_id = 0): void
    {
        $hotel_id = $hotel_id ?: (int) $this->uri->segment(4);
        if (!$hotel_id) show_404();

        $hotelData  = $this->home_banner->get_hotel($hotel_id);
        $bannerData = $this->home_banner->get_banner($hotel_id);

        $this->_data = [
            'title'      => 'จัดการ Banner — ' . ($hotelData['title_th'] ?? ''),
            'menu_slug'  => 'hotelhomebanner_' . $hotel_id,
            'content'    => 'page_home_banner',
            'hotelData'  => $hotelData,
            'bannerData' => $bannerData,
        ];

        $this->load->view('admin/index', $this->_data);
    }

    // ─────────────────────────────────────────────
    //  create — บันทึก (upsert)
    // ─────────────────────────────────────────────

    public function create(int $hotel_id = 0): void
    {
        if (!$hotel_id) show_404();

        $save = [
            'banner_title_th'    => $this->input->post('banner_title_th'),
            'banner_title_en'    => $this->input->post('banner_title_en'),
            'banner_subtitle_th' => $this->input->post('banner_subtitle_th'),
            'banner_subtitle_en' => $this->input->post('banner_subtitle_en'),
            'banner_desc_th'     => $this->input->post('banner_desc_th'),
            'banner_desc_en'     => $this->input->post('banner_desc_en'),
        ];

        if (!empty($_FILES['banner_backgroud_1']['name'])) {
            $this->_deleteOldImage($hotel_id, 'banner_backgroud_1');
            $filename = upload_fileFix('banner_backgroud_1', '1920', '600', $this->upload_path);
            if ($filename) $save['banner_backgroud_1'] = $filename;
        }

        if (!empty($_FILES['banner_hotel_image']['name'])) {
            $this->_deleteOldImage($hotel_id, 'banner_hotel_image');
            $filename = upload_fileFix('banner_hotel_image', '650', '600', $this->upload_path);
            if ($filename) $save['banner_hotel_image'] = $filename;
        }
        $result = $this->home_banner->save_banner($hotel_id, $save);

        if ($result) {
            $this->session->set_flashdata('result',  'true');
            $this->session->set_flashdata('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        } else {
            $this->session->set_flashdata('result',  'false');
            $this->session->set_flashdata('message', 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง');
        }

        redirect(admin_url('hotelhomebanner/index/' . $hotel_id));
    }

    // ─────────────────────────────────────────────
    //  Clear Image — ลบรูปทีละ field
    // ─────────────────────────────────────────────


    public function clear_image(int $hotel_id = 0, string $column = ''): void
    {
        if (!$hotel_id || !in_array($column, $this->image_columns, true)) {
            show_404();
        }

        $banner = $this->home_banner->get_banner($hotel_id);

        if (!empty($banner[$column])) {
            $file_path = $this->upload_path . $banner[$column];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->home_banner->clear_image($hotel_id, $column);

        $this->session->set_flashdata('result',  'true');
        $this->session->set_flashdata('message', 'ลบรูปภาพเรียบร้อยแล้ว');
        redirect(admin_url('hotelhomebanner/index/' . $hotel_id));
    }

    // ─────────────────────────────────────────────
    //  Private Helper
    // ─────────────────────────────────────────────
    private function _deleteOldImage(int $hotel_id, string $column): void
    {
        $banner = $this->home_banner->get_banner($hotel_id);

        if (!empty($banner[$column])) {
            $old_file = $this->upload_path . $banner[$column];
            if (file_exists($old_file)) {
                unlink($old_file);
            }
        }
    }
}
