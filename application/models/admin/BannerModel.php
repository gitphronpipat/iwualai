<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BannerModel extends CI_Model
{
	private $table = 'hotel_banner';

	public function getBanners()
	{
		$this->db->order_by('sort_order', 'ASC');
		$result = $this->db->get($this->table)->result_array();

		foreach ($result as &$row) {
			if (!empty($row['image'])) {
				$row['image'] = 'uploads/banner/' . $row['image'];
			}
		}
		return $result;
	}

		public function getBannersfront()
	{
		$this->db->order_by('sort_order', 'ASC');
		$this->db->where('status', '1');
		$result = $this->db->get($this->table)->result_array();

		foreach ($result as &$row) {
			if (!empty($row['image'])) {
				$row['image'] = 'uploads/banner/' . $row['image'];
			}
		}
		return $result;
	}

	public function getBannerById($id)
	{
		$this->db->where('banner_id', $id);
		$result = $this->db->get($this->table)->row_array();

		if ($result && !empty($result['image'])) {
			$result['image'] = 'uploads/banner/' . $result['image'];
		}
		return $result;
	}

	public function getNextId()
	{
		$this->db->select_max('banner_id');
		$query = $this->db->get($this->table)->row_array();
		return !empty($query['banner_id']) ? (int)$query['banner_id'] + 1 : 1;
	}

	public function resetAutoIncrement()
	{
		$next = $this->getNextId();
		$this->db->query('ALTER TABLE `' . $this->table . '` AUTO_INCREMENT = ' . $next);
	}
	
	public function insertBanner($data)
	{
		return $this->db->insert($this->table, $data) ? 'true' : 'false';
	}


	public function updateBanner($id, $data)
	{
		$this->db->where('banner_id', $id);
		return $this->db->update($this->table, $data) ? 'true' : 'false';
	}

	public function updateOrder($sort_order, $id)
	{
		$this->db->where('banner_id', $id);
		return $this->db->update($this->table, ['sort_order' => $sort_order]) ? 'true' : 'false';
	}

	public function updateStatus($id, $status)
	{
		$this->db->where('banner_id', $id);
		return $this->db->update($this->table, ['status' => $status]) ? 'true' : 'false';
	}

	public function deleteBanner($id)
	{
		$this->db->where('banner_id', $id);
		return $this->db->delete($this->table) ? 'true' : 'false';
	}
	public function getMaxOrder()
	{
		$this->db->select_max('sort_order');
		$query = $this->db->get($this->table)->row_array();

		return !empty($query['sort_order']) ? $query['sort_order'] : 0;
	}
}
