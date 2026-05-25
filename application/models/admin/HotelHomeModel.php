<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HotelHomeModel extends CI_Model
{
    private $table_home  = 'hotel_home';
    private $table_hotel = 'hotel';

    public function getHomeByHotelId($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get($this->table_home)->row_array();
    }

    public function getHotelById($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->get($this->table_hotel)->row_array();
    }

    public function insertHome($data)
    {
        return $this->db->insert($this->table_home, $data) ? 'true' : 'false';
    }


    public function updateHome($hotel_id, $data)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->update($this->table_home, $data) ? 'true' : 'false';
    }


    public function saveHome($hotel_id, $data)
    {
        $existing = $this->getHomeByHotelId($hotel_id);
        if (!empty($existing)) {
            return $this->updateHome($hotel_id, $data);
        } else {
            $data['hotel_id'] = $hotel_id;
            return $this->insertHome($data);
        }
	}
    public function deleteHomeByHotelId($hotel_id)
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->delete($this->table_home) ? 'true' : 'false';
    }


    public function getHotelsWithAdminList()
    {
        $hotels = $this->db->order_by('sort_order', 'ASC')->get($this->table_hotel)->result_array();
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


    public function getPermittedHotelIds($admin_id)
    {
        $row = $this->db->select('hotel_id')
            ->where('admin_id', $admin_id)
            ->get('admin')
            ->row_array();

        if (empty($row['hotel_id'])) return [];
        return array_values(array_filter(explode(',', $row['hotel_id'])));
    }

    public function getHotelsByAdminId($admin_id)
    {
        $ids = $this->getPermittedHotelIds($admin_id);
        if (empty($ids)) return [];

        $hotels = $this->db
            ->where_in('hotel_id', $ids)
            ->order_by('sort_order', 'ASC')
            ->get($this->table_hotel)
            ->result_array();

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
