<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FooterModel extends CI_Model
{
    protected $_table = 'footer';
    protected $_pk    = 'footer_id';

    public function __construct()
    {
        parent::__construct();
    }

	    public function _getFooterfront($hotel_id = null)
    {
        if ($hotel_id) {
            $this->db->where('hotel_id', $hotel_id);
        }
        $result = $this->db->get($this->_table)->row_array();
        return $result ?: [];
    }

    public function _getFooter($hotel_id = null)
    {
        if ($hotel_id) {
            $this->db->where('hotel_id', $hotel_id);
        }
        $result = $this->db->get($this->_table)->row_array();
        return $result ?: [];
    }

    public function insert($_form = [])
    {
        return $this->db->insert($this->_table, $_form) ? 'true' : 'false';
    }

    public function update($_form = [], $id = null)
    {
        return $this->db->where($this->_pk, $id)->update($this->_table, $_form) ? 'true' : 'false';
    }
}
