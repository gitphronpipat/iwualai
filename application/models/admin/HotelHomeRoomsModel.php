<?php
defined('BASEPATH') or exit('No direct script access allowed');
class HotelHomeRoomsModel extends CI_Model
{
    private $table       = 'hotel_home_rooms';
    private $table_hotel = 'hotel';

    public function get_hotel(int $hotel_id): array
    {
        return $this->db
            ->where('hotel_id', $hotel_id)
            ->get($this->table_hotel)
            ->row_array() ?? [];
    }

    public function get_rooms(int $hotel_id): array
    {
        return $this->db
            ->where('hotel_id', $hotel_id)
            ->get($this->table)
            ->row_array() ?? [];
    }

	
    public function get_roomsfront(int $hotel_id): array
    {
        return $this->db
            ->where('hotel_id', $hotel_id)
            ->get($this->table)
            ->row_array() ?? [];
    }

    public function save_rooms(int $hotel_id, array $data): bool
    {
        $exists = $this->get_rooms($hotel_id);

        if ($exists) {
            $this->db->where('hotel_id', $hotel_id);
            return $this->db->update($this->table, $data);
        }

        $data['hotel_id'] = $hotel_id;
        return $this->db->insert($this->table, $data);
    }

    public function update_rooms(int $hotel_id, array $data): bool
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->update($this->table, $data);
    }

    public function delete_rooms(int $hotel_id): bool
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->delete($this->table);
    }

    public function clear_image(int $hotel_id, string $column): bool
    {
        $allowed = ['rooms_bg_img'];

        if (!in_array($column, $allowed, true)) {
            return false;
        }

        return $this->update_rooms($hotel_id, [$column => null]);
    }
}
