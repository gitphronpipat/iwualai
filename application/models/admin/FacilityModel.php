<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FacilityModel extends CI_Model
{
	private $_table  = 'facility';
	private $_pk     = 'facility_id';
	private $_order  = 'sort_order';
	private $_active = 'status';

	public function __construct()
	{
		parent::__construct();
	}

	public function _getData($hotel_id = null)
	{
		if ($hotel_id) {
			$this->db->where('hotel_id', $hotel_id);
		}
		return $this->db->order_by($this->_order, 'asc')
			->get($this->_table)
			->result_array();
	}

	public function _getDatafront($hotel_id = null)
	{
		if ($hotel_id) {
			$this->db->where('hotel_id', $hotel_id);
			$this->db->where('status', 1);
		}
		return $this->db->order_by($this->_order, 'asc')
			->get($this->_table)
			->result_array();
	}

	public function _getDataID($id = false)
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
		$result = $this->db->where($this->_pk, $id)
			->update($this->_table, [$this->_order => $order]);
		return $result ? 'true' : 'false';
	}

	public function updateStatus($id = false, $status = false)
	{
		$result = $this->db->where($this->_pk, $id)
			->update($this->_table, [$this->_active => $status]);
		return $result ? 'true' : 'false';
	}

	public function delete($id = null)
	{
		$result = $this->db->where($this->_pk, $id)->delete($this->_table);

		if ($result) {
			$count = $this->db->count_all($this->_table);
			if ($count === 0) {
				$this->db->query('ALTER TABLE `' . $this->_table . '` AUTO_INCREMENT = 1');
			}
		}

		return $result ? 'true' : 'false';
	}

	public function _getMaxOrderByHotelId($hotel_id)
	{
		$this->db->where('hotel_id', (int)$hotel_id);
		$row = $this->db->select('MAX(' . $this->_order . ') as max_row')
			->get($this->_table)
			->row_array();
		return !empty($row['max_row']) ? (int)$row['max_row'] : 0;
	}
}
