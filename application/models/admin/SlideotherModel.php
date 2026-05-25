<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SlideotherModel extends CI_Model
{
    protected $_table = 'other_slides';
    protected $_pk    = 'other_slide_id';

    public function __construct()
    {
        parent::__construct();
    }

	public function getHotelsslideother($hotel_id = null)
	{
		if ($hotel_id) {
			$this->db->where('hotel_id', $hotel_id);
		}
		return $this->db->get($this->_table)->row_array();
	}

    public function getByHotelId($hotel_id)
    {
        return $this->db->where('hotel_id', $hotel_id)->get($this->_table)->row_array();
    }

    public function insert($_form = false)
    {
        return $this->db->insert($this->_table, $_form) ? 'true' : 'false';
    }

    public function update($_form = false, $id = false)
    {
        return $this->db->where($this->_pk, $id)->update($this->_table, $_form) ? 'true' : 'false';
    }
}
