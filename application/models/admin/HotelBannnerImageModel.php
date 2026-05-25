<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotelbannnerimagemodel extends CI_Model
{
	private $table = 'hotel_banner_image';

	private function _mapImage(&$row)
	{
		if (!empty($row['banner_image']))
			$row['banner_image'] = 'uploads/hotel_home/' . $row['banner_image'];
	}

	public function getBannersByHotelId($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->order_by('sort_order', 'ASC');
		$result = $this->db->get($this->table)->result_array();

		foreach ($result as &$row) $this->_mapImage($row);
		return $result;
	}

	public function getBannersByHotelIdfront($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->where('status', 1); // เฉพาะที่ active
		$this->db->order_by('sort_order', 'ASC');
		$result = $this->db->get($this->table)->result_array();

		foreach ($result as &$row) $this->_mapImage($row);
		return $result;
	}

	public function getBannerById($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get($this->table)->row_array();

		if ($result) $this->_mapImage($result);
		return $result;
	}

	public function insertBanner($data)
	{
		return $this->db->insert($this->table, $data) ? 'true' : 'false';
	}

	public function updateBanner($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data) ? 'true' : 'false';
	}

	public function deleteBanner($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete($this->table);

		if ($result) {
			$count = $this->db->count_all($this->table);
			if ($count === 0) {
				$this->db->query('ALTER TABLE `' . $this->table . '` AUTO_INCREMENT = 1');
			}
		}

		return $result ? 'true' : 'false';
	}

	public function updateStatus($id, $val)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, ['status' => $val]) ? 'true' : 'false';
	}

	public function updateOrder($sort_order, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, ['sort_order' => $sort_order]) ? 'true' : 'false';
	}

	public function getMaxOrder($hotel_id)
	{
		$this->db->select_max('sort_order');
		$this->db->where('hotel_id', $hotel_id);
		$row = $this->db->get($this->table)->row_array();
		return !empty($row['sort_order']) ? (int)$row['sort_order'] : 0;
	}

	public function getUrlCheckinByHotelId($hotel_id)
	{
		$this->db->select('url_check_in');
		$this->db->where('hotel_id', $hotel_id);
		$this->db->limit(1);
		$row = $this->db->get($this->table)->row_array();
		return $row['url_check_in'] ?? null;
	}

	public function updateUrlCheckinByHotelId($hotel_id, $url)
	{
		$this->db->where('hotel_id', $hotel_id);
		return $this->db->update($this->table, ['url_check_in' => $url]) ? 'true' : 'false';
	}
}
