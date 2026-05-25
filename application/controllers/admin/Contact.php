<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Contact extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($hotel_id = null)
    {
        $hotel_id = (int)$hotel_id ?: $this->_getCleanHotelId(
            $this->session->userdata('_auth')['hotel_id'] ?? null
        );

        $this->_data = [
            'title'     => 'จัดการ Contact',
            'menu_slug' => 'contact' . $hotel_id,
            'content'   => 'page_contact',
            'contact'   => $this->db->where('hotel_id', $hotel_id)->get('contact')->row_array(), 
            'hotel_id'  => $hotel_id,
        ];
        $this->load->view('admin/index', $this->_data);
    }

    public function create($hotel_id = null)
    {
        $hotel_id = (int)$hotel_id ?: $this->_getCleanHotelId(
            $this->session->userdata('_auth')['hotel_id'] ?? null
        );

        $existing = $this->db->where('hotel_id', $hotel_id)->get('contact')->row_array(); 

        $data = [
            'hotel_id'       => $hotel_id, 
            'mail_des_th'    => $this->input->post('mail_des_th'),
            'mail_des_en'    => $this->input->post('mail_des_en'),
            'contact_des_th' => $this->input->post('contact_des_th'),
            'contact_des_en' => $this->input->post('contact_des_en'),
        ];

        if (!empty($existing)) {
            $result = $this->db->where('contact_id', $existing['contact_id'])->update('contact', $data);
        } else {
            $result = $this->db->insert('contact', $data);
        }

        $this->session->set_flashdata('result', $result ? 'true' : 'false');
        $this->session->set_flashdata('message', $result ? 'บันทึกข้อมูลสำเร็จ' : 'บันทึกข้อมูลไม่สำเร็จ');
        redirect(admin_url('contact/index/' . $hotel_id));
    }
}
