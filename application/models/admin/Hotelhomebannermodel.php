<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Hotelhomebannermodel extends CI_Model
{
    private $table       = 'hotel_home_banner';
    private $table_hotel = 'hotel';

    // ─────────────────────────────────────────────
    //  Hotel
    // ─────────────────────────────────────────────

    public function get_hotel(int $hotel_id): array
    {
        return $this->db
            ->where('hotel_id', $hotel_id)
            ->get($this->table_hotel)
            ->row_array() ?? [];
    }

    // ─────────────────────────────────────────────
    //  Banner — Read
    // ─────────────────────────────────────────────

    public function get_banner(int $hotel_id): array
    {
        return $this->db
            ->where('hotel_id', $hotel_id)
            ->get($this->table)
            ->row_array() ?? [];
    }

	    public function get_bannerfront(int $hotel_id): array
    {
        return $this->db
            ->where('hotel_id', $hotel_id)
            ->get($this->table)
            ->row_array() ?? [];
    }

    // ─────────────────────────────────────────────
    //  Banner — Create / Update (upsert)
    // ─────────────────────────────────────────────


    public function save_banner(int $hotel_id, array $data): bool
    {
        $exists = $this->get_banner($hotel_id);

        if ($exists) {
            $this->db->where('hotel_id', $hotel_id);
            return $this->db->update($this->table, $data);
        }

        $data['hotel_id'] = $hotel_id;
        return $this->db->insert($this->table, $data);
    }

    // ─────────────────────────────────────────────
    //  Banner — Partial Update (เฉพาะบางคอลัมน์)
    // ─────────────────────────────────────────────

    
    public function update_banner(int $hotel_id, array $data): bool
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->update($this->table, $data);
    }

    // ─────────────────────────────────────────────
    //  Banner — Delete (ลบทั้ง row)
    // ─────────────────────────────────────────────

    
    public function delete_banner(int $hotel_id): bool
    {
        $this->db->where('hotel_id', $hotel_id);
        return $this->db->delete($this->table);
    }

    // ─────────────────────────────────────────────
    //  Helper — ล้างเฉพาะรูปภาพ field เดียว
    // ─────────────────────────────────────────────


    public function clear_image(int $hotel_id, string $column): bool
    {
        $allowed = ['banner_image', 'banner_backgroud_1', 'banner_hotel_image'];

        if (!in_array($column, $allowed, true)) {
            return false;
        }

        return $this->update_banner($hotel_id, [$column => null]);
    }
}
