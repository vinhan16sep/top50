<?php

class Team_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function fetch_all_team(){
        $this->db->select('*')
            ->from('team')
            ->where('is_deleted', 0);

        return $this->db->get()->result_array();
    }

    public function insert($table, $data){
        $this->db->set($data)
            ->insert($table);

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }
    
    public function update($table, $id, $information){
        $this->db->set($information)
            ->where('id', $id)
            ->update($table);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }
    
    public function fetch_by_id($table, $id = null){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id)
            ->where('is_deleted', 0);
        return $result = $this->db->get()->row_array();
    }

    public function get_current_user_team($user_id){
        $query = $this->db->select('*')
            ->from('team')
            ->like('member_id', ',' . $user_id . ',')
            ->or_where('leader_id', $user_id)
            ->where('is_deleted', 0);
        return $query->get()->result_array();
    }

    public function get_current_leader($user_id){
        $query = $this->db->select('*')
            ->from('team')
            ->where('leader_id', $user_id)
            ->where('is_deleted', 0);
        return $query->get()->result_array();
    }
  
    public function check_exist_product_id($table, $product_id=''){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('product_id', ',' . $product_id . ',')
            ->where('is_deleted', 0);
        return $result = $this->db->get()->num_rows();
    }

    public function get_by_user_id($table, $member_id=''){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('member_id', ',' . $member_id . ',')
            ->where('is_deleted', 0);
        return $result = $this->db->get()->result_array();
    }

    public function get_by_leader_id($table, $leader_id=''){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('leader_id', $leader_id)
            ->where('is_deleted', 0);
        return $result = $this->db->get()->result_array();
    }

    public function get_by_product_id($product_id='')
    {
        $this->db->select('*');
        $this->db->from('team');
        $this->db->like('product_id', ',' . $product_id . ',')
            ->where('is_deleted', 0);
        return $result = $this->db->get()->row_array();
    }

    public function get_team_products($team_id){
        $this->db->select('product_id');
        $this->db->from('team');
        $this->db->where('id', $team_id);
        return $result = $this->db->get()->result_array();
    }
}