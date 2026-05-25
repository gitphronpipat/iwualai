<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TitleModel extends CI_Model
{
    private $table_title = 'big_title';
    private $table_sub   = 'sub_title';

    public function getBigTitle()
    {
        $query = $this->db->get($this->table_title);
        return $query->row_array();
    }

	    public function getBigTitlefront()
    {
        $query = $this->db->get($this->table_title);
        return $query->row_array();
    }


    public function getSubTitle()
    {
        $query = $this->db->get($this->table_sub);
        return $query->row_array();
    }

	    public function getSubTitlefront()
    {
        $query = $this->db->get($this->table_sub);
        return $query->row_array();
    }


    public function saveBigTitle($data)
    {
        $exists = $this->db->get($this->table_title)->row();
        if ($exists) {
            $this->db->where('title_id', $exists->title_id);
            $this->db->update($this->table_title, $data);
            return $exists->title_id; 
        } else {
            $this->db->insert($this->table_title, $data);
            return $this->db->insert_id(); 
        }
    }

   public function saveSubTitle($data)
{
    $exists = $this->db->get($this->table_sub)->row();

    if ($exists) {
        if (isset($data['image']) && !empty($exists->image)) {
            @unlink('./uploads/title/' . $exists->image);
        }
        $this->db->where('sub_id', $exists->sub_id); 
        $result = $this->db->update($this->table_sub, $data);
    } else {
        $result = $this->db->insert($this->table_sub, $data);
    }
    
    return $result ? 'true' : 'false';
}

public function getTitles()
{
    // $this->db->order_by('sort_order', 'ASC'); 
    $query = $this->db->get('big_title');
    return $query->result_array(); 
}

public function getSubTitles()
{
    // $this->db->order_by('sort_order', 'ASC'); 
    $query = $this->db->get('sub_title');
    return $query->result_array(); 
}
}
