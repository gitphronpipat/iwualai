<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    private $_table = 'admin';
    private $_pk = 'admin_id';
    private $_order = 'admin_sort';
    private $_active = 'admin_status';

    public function __construct()
    {
        parent::__construct();
    }

    // ============================================================
    // ส่วนที่ 1: ฟังก์ชันเดิมสำหรับ Controller จัดการ Admin ของคุณ
    // ============================================================

    public function _getAdmin()
    {
        return $this->db->order_by($this->_order, 'asc')
                        ->where($this->_pk . ' !=', 1)
                        ->get($this->_table)
                        ->result_array();
    }

    public function _getMember()
    {
        return $this->db->where('admin_permission', '2')
                        ->where($this->_pk . ' !=', 1)
                        ->join('company', 'company.com_id = admin.com_id', 'left')
                        ->get($this->_table)
                        ->result_array();
    }

    public function _getMemberID($id = false)
    {
        return $this->db->where('admin.' . $this->_pk, $id)
                        ->join('company', 'company.com_id = admin.com_id', 'left')
                        ->get($this->_table)
                        ->row_array();
    }

    public function _getAdminID($id = false)
    {
        return $this->db->where($this->_pk, $id)
                        ->get($this->_table)
                        ->row_array();
    }

    public function _getMaxOrder()
    {
        return $this->db->select('MAX(' . $this->_order . ') as max_row')
                        ->get($this->_table)
                        ->row_array();
    }

    public function insert($_form = false)
    {
        $result = $this->db->insert($this->_table, $_form);
        return $result ? 'true' : 'false';
    }

    public function update($_form = false, $id = false)
    {
        $result = $this->db->where($this->_pk, $id)->update($this->_table, $_form);
        return $result ? 'true' : 'false';
    }

    public function updateOrder($order = false, $id = false)
    {
        $order_data = [$this->_order => $order];
        $result = $this->db->where($this->_pk, $id)->update($this->_table, $order_data);
        return $result ? 'true' : 'false';
    }

    public function updateStatus($id = false, $status = false)
    {
        $status_data = [$this->_active => $status];
        $result = $this->db->where($this->_pk, $id)->update($this->_table, $status_data);
        return $result ? 'true' : 'false';
    }

    public function delete($id = null)
    {
        $result = $this->db->where($this->_pk, $id)->delete($this->_table);
        return $result ? 'true' : 'false';
    }

    // ============================================================
    // ส่วนที่ 2: ฟังก์ชันเพิ่มเติมจากแบบฟอร์ม SuperAdmin (สำหรับดึงข้อมูลเป็น Object)
    // ============================================================

    public function get_all()
    {
        return $this->db->order_by($this->_order, 'ASC')
                        ->get($this->_table)
                        ->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->_table, [$this->_pk => $id])->row();
    }

    public function get_by_user($username)
    {
        return $this->db->get_where($this->_table, ['admin_user' => $username])->row();
    }

    public function create_admin($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    // ============================================================
    // ส่วนที่ 3: สำหรับระบบสิทธิ์โรงแรม
    // ============================================================

    /**
     * ดึง Admin ทั่วไป (permission=2) ทั้งหมด
     * ใช้ในหน้า hotel/permission เพื่อแสดงรายชื่อ Admin ที่กำหนดสิทธิ์ได้
     */
    public function getAdminsByPermission($permission = 2)
    {
        return $this->db->where('admin_permission', $permission)
                        ->where('admin_status', 1)
                        ->where($this->_pk . ' !=', 1)
                        ->order_by($this->_order, 'ASC')
                        ->get($this->_table)
                        ->result_array();
    }
}	
