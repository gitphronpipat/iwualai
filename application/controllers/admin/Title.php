<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Title extends Core_Controller
{
    private $upload_path_big = '';
    private $upload_path_sub = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/TitleModel', 'title_model');
        $this->load->library('session');

        $this->upload_path_big = FCPATH . 'uploads/big_image/';
        $this->upload_path_sub = FCPATH . 'uploads/title/';

        // if (!is_dir($this->upload_path_big)) mkdir($this->upload_path_big, 0777, true);
        // if (!is_dir($this->upload_path_sub)) mkdir($this->upload_path_sub, 0777, true);
    }


    public function index()
    {
        $this->_data = [
            'title'     => 'จัดการข้อมูล Title',
            'menu_slug' => 'title_big',
            'content'   => 'page_title',
            'script'    => '',
            'bigTitle'  => $this->title_model->getBigTitle(),
        ];
        $this->load->view('admin/index', $this->_data);
    }


    public function subtitle()
    {
        $this->_data = [
            'title'     => 'จัดการคำอธิบาย',
            'menu_slug' => 'title_sub',
            'content'   => 'page_subtitle',
            'script'    => '',
            'subTitle'  => $this->title_model->getSubTitle(),
        ];
        $this->load->view('admin/index', $this->_data);
    }

    // บันทึก Big Title
    public function create()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect(admin_url('title'));
            return;
        }

        $data_big = [
            'title_th'       => $this->input->post('title_th'),
            'subtitle_th'    => $this->input->post('subtitle_th'),
            'description_th' => $this->input->post('big_desc_th'),
            'title_en'       => $this->input->post('title_en'),
            'subtitle_en'    => $this->input->post('subtitle_en'),
            'description_en' => $this->input->post('big_desc_en'),
        ];

        if (!empty($_FILES['big_image']['name'])) {
            $filename = upload_fileFix('big_image', '1920', '600', $this->upload_path_big);
            if ($filename) {
                $old_data_big = $this->title_model->getBigTitle();
                if (!empty($old_data_big['image'])) {
                    $old_path = $this->upload_path_big . $old_data_big['image'];
                    if (file_exists($old_path)) @unlink($old_path);
                }
                $data_big['image'] = $filename;
            } else {
                $this->session->set_flashdata('result', 'false');
                $this->session->set_flashdata('message', 'อัปโหลดรูปภาพหัวข้อหลักไม่สำเร็จ');
                redirect(admin_url('title'));
                return;
            }
        }

        $result = $this->title_model->saveBigTitle($data_big);

        $this->session->set_flashdata('result', $result ? 'true' : 'false');
        $this->session->set_flashdata('message', $result ? 'อัพเดทข้อมูลสำเร็จ.' : 'อัพเดทข้อมูลไม่สำเร็จ.');
        redirect(admin_url('title'));
    }

    // บันทึก Sub Title
    public function save()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect(admin_url('title/subtitle'));
            return;
        }

        $data_sub = [
            'sub_desc_th' => $this->input->post('sub_desc_th'),
            'sub_desc_en' => $this->input->post('sub_desc_en'),
        ];

        if (!empty($_FILES['sub_image']['name'])) {
            $filename = upload_fileFix('sub_image', '1080', '720', $this->upload_path_sub);
            if ($filename) {
                $old_data_sub = $this->title_model->getSubTitle();
                if (!empty($old_data_sub['image'])) {
                    $old_path = $this->upload_path_sub . $old_data_sub['image'];
                    if (file_exists($old_path)) @unlink($old_path);
                }
                $data_sub['image'] = $filename;
            } else {
                $this->session->set_flashdata('result', 'false');
                $this->session->set_flashdata('message', 'อัปโหลดรูปภาพคำอธิบายไม่สำเร็จ');
                redirect(admin_url('title/subtitle'));
                return;
            }
        }

        $result = $this->title_model->saveSubTitle($data_sub);

        $this->session->set_flashdata('result', $result == 'true' ? 'true' : 'false');
        $this->session->set_flashdata('message', $result == 'true' ? 'อัพเดทข้อมูลสำเร็จ.' : 'อัพเดทข้อมูลไม่สำเร็จ.');
        redirect(admin_url('title/subtitle'));
    }
}
