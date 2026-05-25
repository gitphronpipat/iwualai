<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoomModel extends CI_Model
{
	private $table = 'room';
	private $upload_path = './uploads/room/';

	// ==========================================
	// ส่วนจัดการข้อมูลห้องพักหลัก (Room)
	// ==========================================

	public function getRooms()
	{
		$this->db->order_by('sort_order', 'ASC');
		return $this->db->get($this->table)->result_array();
	}

	public function getRoomById($room_id)
	{
		$this->db->where('room_id', (int)$room_id);
		return $this->db->get($this->table)->row_array();
	}

	public function getRoomByIdfront($hotel_id)
    {
        return $this->db
            ->where('hotel_id', $hotel_id)
			->where('status',1)
            ->get($this->table)
            ->result_array() ?? [];
    }

	public function insertRoom($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function updateRoom($room_id, $data)
	{
		$this->db->where('room_id', (int)$room_id);
		return $this->db->update($this->table, $data);
	}

	public function deleteRoom($room_id)
	{
		$room = $this->getRoomById($room_id);

		if (!empty($room['image'])) {
			$file_path = $this->upload_path . $room['image'];
			if (file_exists($file_path)) @unlink($file_path);
		}

		$hotel_id = $room['hotel_id'] ?? null;


		$this->db->where('room_id', (int)$room_id)->delete('room_gallery');

		$this->db->where('room_id', (int)$room_id);
		$result = $this->db->delete($this->table);

		if ($result && $hotel_id) {
			$this->_resetSortOrder($hotel_id);
		}

		$count = $this->db->count_all('room_gallery');
		if ($count == 0) {
			$this->db->query('ALTER TABLE room_gallery AUTO_INCREMENT = 1');
		}

		return $result;
	}

	private function _resetSortOrder($hotel_id)
	{
		$rooms = $this->db
			->where('hotel_id', (int)$hotel_id)
			->order_by('sort_order', 'ASC')
			->get($this->table)
			->result_array();

		foreach ($rooms as $i => $room) {
			$this->db->where('room_id', $room['room_id'])
				->update($this->table, ['sort_order' => $i + 1]);
		}
	}

	public function updateStatus($id, $status)
	{
		$this->db->where('room_id', $id);
		return $this->db->update($this->table, ['status' => $status]) ? 'true' : 'false';
	}

	public function updateOrder($id, $order)
	{
		$this->db->where('room_id', $id);
		return $this->db->update($this->table, ['sort_order' => $order]);
	}

	public function getMaxOrder()
	{
		$this->db->select_max('sort_order');
		$query = $this->db->get($this->table)->row_array();
		return !empty($query['sort_order']) ? (int)$query['sort_order'] : 0;
	}


	// ==========================================
	// ส่วนจัดการแกลลอรี่ห้องพัก (Room Gallery)
	// ==========================================

	public function insertGallery($data)
	{
		return $this->db->insert('room_gallery', $data);
	}

	public function getGalleryByRoomId($room_id)
	{
		$this->db->where('room_id', (int)$room_id);
		$this->db->order_by('sort_order', 'ASC');
		return $this->db->get('room_gallery')->result_array();
	}

	public function getGalleryById($gallery_id)
	{
		$this->db->where('gallery_id', (int)$gallery_id);
		return $this->db->get('room_gallery')->row_array();
	}

	public function deleteGallery($gallery_id)
	{
		$this->db->where('gallery_id', (int)$gallery_id);
		$result = $this->db->delete('room_gallery');

		if ($result) {
			$count = $this->db->count_all('room_gallery');
			if ($count == 0) {
				$this->db->query('ALTER TABLE room_gallery AUTO_INCREMENT = 1');
			}
		}

		return $result;
	}


	// ==========================================
	// ส่วนจัดการ Facility ของห้องพัก (Room Facility)
	// ==========================================

	public function getFacilityIdsByRoomId($room_id)
	{
		$this->db->select('facility_id');
		$this->db->where('room_id', (int)$room_id);
		$rows = $this->db->get('room_facility')->result_array();
		return array_column($rows, 'facility_id');
	}

	public function getAllFacilities()
	{
		$this->db->where('status', 1);
		$this->db->order_by('sort_order', 'ASC');
		return $this->db->get('facility')->result_array();
	}


	public function getRoomsByHotelId($hotel_id)
	{
		return $this->db
			->where('hotel_id', $hotel_id)
			->order_by('sort_order', 'ASC')
			->get($this->table)
			->result_array();
	}
	public function syncAmenities($room_id, $amenity_names = [])
	{
		$this->db->where('room_id', (int)$room_id)->delete('room_facility');

		$count = $this->db->count_all('room_facility');
		if ($count == 0) {
			$this->db->query('ALTER TABLE room_facility AUTO_INCREMENT = 1');
		}

		if (!empty($amenity_names)) {
			$insert_data = [];
			foreach ($amenity_names as $name) {
				$name = trim($name);
				if (empty($name)) continue;
				$insert_data[] = [
					'room_id' => (int)$room_id,
					'name'    => $name,
				];
			}
			if (!empty($insert_data)) {
				$this->db->insert_batch('room_facility', $insert_data);
			}
		}
		return true;
	}

	public function syncFacilities($room_id, $facility_ids = [])
	{
		$this->db->where('room_id', (int)$room_id)->delete('room_facility');
		return true;
	}

	public function getAmenitiesByRoomId($room_id)
	{
		$this->db->where('room_id', (int)$room_id);
		return $this->db->get('room_facility')->result_array();
	}

	public function getMaxOrderByHotelId($hotel_id)
	{
		$this->db->select_max('sort_order');
		$this->db->where('hotel_id', (int)$hotel_id);
		$row = $this->db->get($this->table)->row_array();
		return !empty($row['sort_order']) ? (int)$row['sort_order'] : 0;
	}
}
