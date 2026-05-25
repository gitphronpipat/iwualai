<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');
require_once(APPPATH . 'helpers/upload_file_helper.php');

class Hotelhomerooms extends Core_Controller
{
    private string $upload_path = '';

    private array $image_columns = [
        'rooms_bg_img',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/HotelHomeRoomsModel', 'home_rooms');
        $this->load->library('session');

        $this->upload_path = FCPATH . 'uploads/hotel_home/';

    }

    // ─────────────────────────────────────────────
    //  Index — แสดงฟอร์ม
    // ─────────────────────────────────────────────

    public function index(int $hotel_id = 0): void
    {
        $hotel_id = $hotel_id ?: (int) $this->uri->segment(4);
        if (!$hotel_id) show_404();

        $hotelData = $this->home_rooms->get_hotel($hotel_id);
        $roomsData = $this->home_rooms->get_rooms($hotel_id);

        $this->_data = [
            'title'     => 'จัดการ Rooms Section — ' . ($hotelData['title_th'] ?? ''),
            'menu_slug' => 'hotelhomerooms_' . $hotel_id,
            'content'   => 'page_home_rooms',
            'hotelData' => $hotelData,
            'roomsData' => $roomsData,
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
            'rooms_title_th'    => $this->input->post('rooms_title_th'),
            'rooms_title_en'    => $this->input->post('rooms_title_en'),
            'rooms_subtitle_th' => $this->input->post('rooms_subtitle_th'),
            'rooms_subtitle_en' => $this->input->post('rooms_subtitle_en'),
            'rooms_desc_th'     => $this->input->post('rooms_desc_th'),
            'rooms_desc_en'     => $this->input->post('rooms_desc_en'),
        ];

        if (!empty($_FILES['rooms_bg_img']['name'])) {
            $this->_deleteOldImage($hotel_id, 'rooms_bg_img');
            $filename = upload_fileFix('rooms_bg_img', '600', '600', $this->upload_path);
            if ($filename) $save['rooms_bg_img'] = $filename;
        }
        $result = $this->home_rooms->save_rooms($hotel_id, $save);

        if ($result) {
            $this->session->set_flashdata('result',  'true');
            $this->session->set_flashdata('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        } else {
            $this->session->set_flashdata('result',  'false');
            $this->session->set_flashdata('message', 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง');
        }

        redirect(admin_url('hotelhomerooms/index/' . $hotel_id));
    }

    // ─────────────────────────────────────────────
    //  Clear Image — ลบรูปทีละ field
    // ─────────────────────────────────────────────

    public function clear_image(int $hotel_id = 0, string $column = ''): void
    {
        if (!$hotel_id || !in_array($column, $this->image_columns, true)) {
            show_404();
        }

        $rooms = $this->home_rooms->get_rooms($hotel_id);

        if (!empty($rooms[$column])) {
            $file_path = $this->upload_path . $rooms[$column];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $this->home_rooms->clear_image($hotel_id, $column);

        $this->session->set_flashdata('result',  'true');
        $this->session->set_flashdata('message', 'ลบรูปภาพเรียบร้อยแล้ว');
        redirect(admin_url('hotelhomerooms/index/' . $hotel_id));
    }

    // ─────────────────────────────────────────────
    //  Private Helper
    // ─────────────────────────────────────────────

    private function _deleteOldImage(int $hotel_id, string $column): void
    {
        $rooms = $this->home_rooms->get_rooms($hotel_id);

        if (!empty($rooms[$column])) {
            $old_file = $this->upload_path . $rooms[$column];
            if (file_exists($old_file)) {
                unlink($old_file);
            }
        }
    }
}
