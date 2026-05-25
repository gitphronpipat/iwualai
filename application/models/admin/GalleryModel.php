<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GalleryModel extends CI_Model
{
	private $table          = 'gallery';
	private $table_category = 'gallery_category';

	// ── Category ──────────────────────────────────────────
	public function getCategoriesByHotel($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->order_by('sort_order', 'ASC');
		return $this->db->get($this->table_category)->result_array();
	}

public function getGalleryByHotelfront($hotel_id)
{
    $this->db->where('hotel_id', $hotel_id);
    $this->db->where('status', 1);
    $this->db->order_by('sort_order', 'ASC');
    $this->db->limit(4);
    return $this->db->get($this->table)->result_array(); // table gallery
}

	public function getCategoryById($category_id)
	{
		$this->db->where('category_id', $category_id);
		return $this->db->get($this->table_category)->row_array();
	}

	public function saveCategories($hotel_id, $ids, $names_th, $names_en)
	{
		$result = 'true';
		foreach ($ids as $i => $id) {
			$name_th = $names_th[$i] ?? '';
			$name_en = $names_en[$i] ?? '';
			if (empty($name_th) && empty($name_en)) continue;

			if (!empty($id)) {
				$this->db->where('category_id', $id);
				if (!$this->db->update($this->table_category, [
					'name_th' => $name_th,
					'name_en' => $name_en,
				])) $result = 'false';
			} else {
				if (!$this->db->insert($this->table_category, [
					'hotel_id' => $hotel_id,
					'name_th'  => $name_th,
					'name_en'  => $name_en,
					'status'   => 1,
				])) $result = 'false';
			}
		}
		return $result;
	}

	public function deleteCategoriesNotIn($hotel_id, $submitted_ids)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->where_not_in('category_id', $submitted_ids);
		$this->db->delete($this->table_category);
		$this->_resetAutoIncrement($this->table_category, 'category_id');
		return 'true';
	}

	public function deleteAllCategories($hotel_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete($this->table_category);
		$this->_resetAutoIncrement($this->table_category, 'category_id');
		return 'true';
	}

	// ── Gallery Images ─────────────────────────────────────
	public function getImagesByHotel($hotel_id)
	{
		$this->db->where('g.hotel_id', $hotel_id);
		$this->db->order_by('g.category_id', 'ASC');
		$this->db->order_by('g.sort_order', 'ASC');
		$this->db->select('g.*, gc.name_th, gc.name_en');
		$this->db->from($this->table . ' g');
		$this->db->join($this->table_category . ' gc', 'gc.category_id = g.category_id', 'left');
		$rows = $this->db->get()->result_array();

		foreach ($rows as &$row) {
			if (!empty($row['image']))
				$row['image'] = 'uploads/gallery/' . $row['image'];
		}
		return $rows;
	}

	public function getImageById($gallery_id)
	{
		$this->db->where('gallery_id', $gallery_id);
		$row = $this->db->get($this->table)->row_array();
		if ($row && !empty($row['image']))
			$row['image'] = 'uploads/gallery/' . $row['image'];
		return $row;
	}

	public function getImagesByCategory($hotel_id, $category_id, $skip_hotel = false)
	{
		if (!$skip_hotel && $hotel_id > 0) {
			$this->db->where('g.hotel_id', $hotel_id);
		}
		$this->db->where('g.category_id', $category_id);
		$this->db->order_by('g.sort_order', 'ASC');
		$this->db->select('g.*, gc.name_th, gc.name_en');
		$this->db->from($this->table . ' g');
		$this->db->join($this->table_category . ' gc', 'gc.category_id = g.category_id', 'left');
		$rows = $this->db->get()->result_array();

		foreach ($rows as &$row) {
			if (!empty($row['image']))
				$row['image'] = 'uploads/gallery/' . $row['image'];
		}
		return $rows;
	}
	public function getMaxOrder($hotel_id, $category_id)
	{
		$this->db->where('hotel_id', $hotel_id);
		$this->db->where('category_id', $category_id);
		$this->db->select_max('sort_order');
		$row = $this->db->get($this->table)->row_array();
		return !empty($row['sort_order']) ? (int)$row['sort_order'] : 0;
	}

	public function insertImage($data)
	{
		return $this->db->insert($this->table, $data) ? 'true' : 'false';
	}

	public function updateImage($gallery_id, $data)
	{
		$this->db->where('gallery_id', $gallery_id);
		return $this->db->update($this->table, $data) ? 'true' : 'false';
	}

	public function deleteImage($gallery_id)
	{
		$this->db->where('gallery_id', $gallery_id);
		$this->db->delete($this->table);
		$this->_resetAutoIncrement($this->table, 'gallery_id');
		return 'true';
	}

	public function updateStatus($gallery_id, $status)
	{
		$this->db->where('gallery_id', $gallery_id);
		return $this->db->update($this->table, ['status' => $status]) ? 'true' : 'false';
	}

	public function deleteImagesByCategoryId($category_id)
	{
		$this->db->where('category_id', $category_id);
		$this->db->delete($this->table);
		$this->_resetAutoIncrement($this->table, 'gallery_id');
		return 'true';
	}

	public function updateOrder($sort_order, $gallery_id)
	{
		$this->db->where('gallery_id', $gallery_id);
		return $this->db->update($this->table, ['sort_order' => $sort_order]) ? 'true' : 'false';
	}

	private function _resetAutoIncrement($table, $pk)
	{
		$row     = $this->db->query("SELECT MAX(`{$pk}`) AS max_id FROM `{$table}`")->row_array();
		$next_id = !empty($row['max_id']) ? (int)$row['max_id'] + 1 : 1;
		$this->db->query("ALTER TABLE `{$table}` AUTO_INCREMENT = {$next_id}");
	}
}
