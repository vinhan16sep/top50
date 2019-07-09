<?php

class Status_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function insert($type, $data){
        $this->db->set($data)
            ->insert($type);

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }
    
    public function update($type, $id, $information){
        $this->db->set($information)
            ->where('client_id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }
    
    public function fetch_by_client_id($id = null){
        $this->db->select('*');
        $this->db->from('status');
        $this->db->where('client_id', $id);
        return $result = $this->db->get()->row_array();
    }

    public function fetch_by_is_final($is_final = 0){
        $this->db->select('*');
        $this->db->from('status');
//        $this->db->where('is_final', $is_final);
        return $result = $this->db->get()->result_array();
    }
}