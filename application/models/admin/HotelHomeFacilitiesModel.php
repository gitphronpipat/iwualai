<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotelhomefacilitiesmodel extends CI_Model
{
    private $table       = 'hotel_home_facilities';
    private $table_hotel = 'hotel';

  
    public function get_hotel($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get($this->table_hotel)->row_array();
    }

    public function get_home($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $row = $this->db->get($this->table)->row_array();
        return $row ?: [];
    }

	    public function get_facilitiesfront($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        $row = $this->db->get($this->table)->row_array();
        return $row ?: [];
    }

    public function save_home($hotel_id, array $data)
    {
        $exists = $this->get_home($hotel_id);

        if ($exists) {
            $this->db->where('hotel_id', $hotel_id);
            return $this->db->update($this->table, $data) ? 'true' : 'false';
        }

        $data['hotel_id'] = $hotel_id;
        return $this->db->insert($this->table, $data) ? 'true' : 'false';
    }

    public function clear_image_field($hotel_id, $field)
    {
        $allowed = ['gallery_bg_img', 'facilities_bg_img'];
        if (!in_array($field, $allowed, true)) return 'false';

        $this->db->where('hotel_id', $hotel_id);
        return $this->db->update($this->table, [$field => null]) ? 'true' : 'false';
    }
}
