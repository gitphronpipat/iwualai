<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HotelModel extends CI_Model
{
	private $table_hotel = 'hotel';

	public function getHotels()
	{
		$this->db->order_by('sort_order', 'ASC');
		$result = $this->db->get($this->table_hotel)->result_array();

		foreach ($result as &$row) {
			if (!empty($row['image'])) {
				$row['image'] = 'uploads/hotel/' . $row['image'];
			}
		}
		return $result;
	}

		public function getHotelsfront()
	{
		$this->db->order_by('sort_order', 'ASC');
		$result = $this->db->get($this->table_hotel)->result_array();

		return $result;
	}

		public function getHotelByName($name)
	{
		return $this->db->get_where('hotel', ['title_en' => $name])->row_array();
	}

	public function getHotelById($id)
	{
		$this->db->where('hotel_id', $id);
		$result = $this->db->get($this->table_hotel)->row_array();

		if ($result && !empty($result['image'])) {
			$result['image'] = 'uploads/hotel/' . $result['image'];
		}
		return $result;
	}

	public function getNextId()
	{
		$this->db->select_max('hotel_id');
		$query = $this->db->get($this->table_hotel)->row_array();
		return !empty($query['hotel_id']) ? (int)$query['hotel_id'] + 1 : 1;
	}

	public function resetAutoIncrement()
	{
		$next = $this->getNextId();
		$this->db->query('ALTER TABLE `' . $this->table_hotel . '` AUTO_INCREMENT = ' . $next);
	}
	
	public function insertHotel($data)
	{
		return $this->db->insert($this->table_hotel, $data) ? 'true' : 'false';
	}

	public function updateHotel($id, $data)
	{
		$this->db->where('hotel_id', $id);
		return $this->db->update($this->table_hotel, $data) ? 'true' : 'false';
	}

	public function deleteHotel($id)
	{
		$this->db->where('hotel_id', $id);
		return $this->db->delete($this->table_hotel) ? 'true' : 'false';
	}

	public function updateOrder($sort_order, $id)
	{
		$this->db->where('hotel_id', $id);
		return $this->db->update($this->table_hotel, ['sort_order' => $sort_order]) ? 'true' : 'false';
	}

	public function updateStatus($id, $val)
	{
		$this->db->where('hotel_id', $id);
		return $this->db->update($this->table_hotel, ['status' => $val]) ? 'true' : 'false';
	}

	public function getMaxOrder()
	{
		$this->db->select_max('sort_order');
		$query = $this->db->get($this->table_hotel)->row_array();
		return !empty($query['sort_order']) ? $query['sort_order'] : 0;
	}

	public function getHotelsByIds($ids = [])
	{
		if (empty($ids)) return [];
		return $this->db->where_in('hotel_id', $ids)
			->order_by('sort_order', 'ASC')
			->get($this->table_hotel)
			->result_array();
	}

    // ====================================================
    // many-to-many โดยเก็บ hotel_id เป็น "1,2,3" ใน column hotel_id ของ table admin
    // ต้อง ALTER TABLE admin MODIFY COLUMN hotel_id VARCHAR(255) NULL DEFAULT NULL;
    // ====================================================

	/**
	 * ดึง hotel_id[] จาก string "1,2,3"
	 */
	public function getPermittedHotelIds($admin_id)
	{
		$row = $this->db->select('hotel_id')
			->where('admin_id', $admin_id)
			->get('admin')
			->row_array();

		if (empty($row['hotel_id'])) return [];
		return array_values(array_filter(explode(',', $row['hotel_id'])));
	}

	/**
	 * ดึงโรงแรมที่ admin คนนี้ดูแล
	 */
	public function getHotelsByAdminId($admin_id)
	{
		$ids = $this->getPermittedHotelIds($admin_id);
		if (empty($ids)) return [];
		return $this->getHotelsByIds($ids);
	}

	/**
	 * ดึง admin_id ทั้งหมดที่ผูกกับโรงแรมนี้
	 */
	public function getAssignedAdminIds($hotel_id)
	{
		$rows = $this->db->select('admin_id')
			->where('admin_permission', 2)
			->where("FIND_IN_SET('{$hotel_id}', hotel_id) > 0")
			->get('admin')
			->result_array();
		return array_column($rows, 'admin_id');
	}

	/**
	 * ผูก admin หลายคนเข้ากับโรงแรมนี้
	 * — ถอด hotel_id ออกจาก admin ที่ไม่ได้เลือก
	 * — เพิ่ม hotel_id เข้าไปใน admin ที่เลือก
	 */
	public function assignAdminsToHotel($hotel_id, $admin_ids = [])
	{
		// admin เดิมที่ผูกโรงแรมนี้อยู่
		$old_admins = $this->getAssignedAdminIds($hotel_id);

		// admin ที่ถูกถอดออก → ลบ hotel_id ออกจาก string
		$removed = array_diff($old_admins, $admin_ids);
		foreach ($removed as $aid) {
			$row = $this->db->select('hotel_id')
				->where('admin_id', $aid)
				->get('admin')->row_array();

			$ids = array_filter(explode(',', $row['hotel_id'] ?? ''));
			$ids = array_values(array_diff($ids, [(string)$hotel_id]));
			$this->db->where('admin_id', $aid)
				->update('admin', ['hotel_id' => !empty($ids) ? implode(',', $ids) : null]);
		}

		// admin ที่เพิ่มใหม่ → เพิ่ม hotel_id เข้าไปใน string
		foreach ($admin_ids as $aid) {
			$row = $this->db->select('hotel_id')
				->where('admin_id', $aid)
				->get('admin')->row_array();

			$ids = array_filter(explode(',', $row['hotel_id'] ?? ''));
			if (!in_array((string)$hotel_id, $ids)) {
				$ids[] = (string)$hotel_id;
			}
			$this->db->where('admin_id', $aid)
				->update('admin', ['hotel_id' => implode(',', $ids)]);
		}

		return 'true';
	}

	/**
	 * ถอด admin ทุกคนออกจากโรงแรมนี้ (ใช้ตอนลบโรงแรม)
	 */
	public function unassignAdminsFromHotel($hotel_id)
	{
		$admins = $this->getAssignedAdminIds($hotel_id);
		foreach ($admins as $aid) {
			$row = $this->db->select('hotel_id')
				->where('admin_id', $aid)
				->get('admin')->row_array();

			$ids = array_filter(explode(',', $row['hotel_id'] ?? ''));
			$ids = array_values(array_diff($ids, [(string)$hotel_id]));
			$this->db->where('admin_id', $aid)
				->update('admin', ['hotel_id' => !empty($ids) ? implode(',', $ids) : null]);
		}
	}

	/**
		 * ดึงโรงแรมพร้อม admin_list (ใช้หน้า index แสดงรายชื่อ admin)
	 */
	public function getHotelsWithAdminList()
	{
		$hotels = $this->getHotels();
		foreach ($hotels as &$hotel) {
			$hid = $hotel['hotel_id'];
			$hotel['admin_list'] = $this->db
				->select('admin_name')
				->where('admin_permission', 2)
				->where("FIND_IN_SET('{$hid}', hotel_id) > 0")
				->get('admin')
				->result_array();
		}
		return $hotels;
	}
}

