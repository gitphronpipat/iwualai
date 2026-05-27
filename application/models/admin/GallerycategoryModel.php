<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GalleryCategoryModel extends CI_Model
{
    private $_table = 'gallery_category';
    private $_pk    = 'category_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function _getData($hotel_id = null)
    {
        if ($hotel_id) {
            $this->db->where('hotel_id', $hotel_id);
        }
        return $this->db->order_by('sort_order', 'asc')
                        ->get($this->_table)
                        ->result_array();
    }

	
    public function _getDatagalleryfront($hotel_id = null)
    {
        if ($hotel_id) {
            $this->db->where('hotel_id', $hotel_id);
        }
        return $this->db->order_by('sort_order', 'asc')
                        ->get($this->_table)
                        ->result_array();
    }

    public function _getDataID($id = false)
    {
        return $this->db->where($this->_pk, $id)
                        ->get($this->_table)
                        ->row_array();
    }

    public function save_all($rows = [])
    {
        foreach ($rows as $row) {
            if (!empty($row['category_id'])) {
                $id = $row['category_id'];
                unset($row['category_id']);
                $this->db->where($this->_pk, $id)->update($this->_table, $row);
            } else {
                unset($row['category_id']);
                $this->db->insert($this->_table, $row);
            }
        }
        return 'true';
    }

    public function insert($data = [])
    {
        return $this->db->insert($this->_table, $data) ? 'true' : 'false';
    }

    public function update($data = [], $id = false)
    {
        return $this->db->where($this->_pk, $id)
                        ->update($this->_table, $data) ? 'true' : 'false';
    }

    public function delete($id = null)
    {
        return $this->db->where($this->_pk, $id)
                        ->delete($this->_table) ? 'true' : 'false';
    }
}
