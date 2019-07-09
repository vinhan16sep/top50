<?php

class Rating_model extends CI_Model {

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

    public function fetch_by_product_id($type, $id){
        $query = $this->db->select('rating.*, users.*')
            ->from($type)
            ->join('users', 'users.id = rating.member_id')
            ->where('product_id', $id)
            ->get();

        return $query->result_array();
    }

    public function fetch_by_product_id_and_logged_in_user($type, $id, $user_id){
        $query = $this->db->select('rating.result')
            ->from($type)
            ->where('product_id', $id)
            ->where('member_id', $user_id)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }
        return false;
    }

//    public function fetch_all($type){
//        $query = $this->db->select('*')
//            ->from($type)
//            ->where('is_deleted', 0)
//            ->get();
//
//        if($query->num_rows() > 0){
//            return $query->result_array();
//        }
//
//        return false;
//    }
//
//    public function fetch_all_pagination($limit = NULL, $start = NULL) {
//        $this->db->select('*');
//        $this->db->from('information');
//        $this->db->where('is_deleted', 0);
//        $this->db->limit($limit, $start);
//        $this->db->order_by("id", "desc");
//
//        return $result = $this->db->get()->result_array();
//    }
//
//    public function get_all_product($id, $limit = NULL, $start = NULL) {
//        $this->db->select('*');
//        $this->db->from('product');
//        $this->db->where('client_id', $id);
//        $this->db->limit($limit, $start);
//        $this->db->order_by("id", "desc");
//
//        return $result = $this->db->get()->result_array();
//    }
//
//    public function fetch_all_by_type($type){
//        $query = $this->db->select('*')
//            ->from('information')
//            ->where('type', $type)
//            ->where('is_deleted', 0)
//            ->get();
//
//        if($query->num_rows() > 0){
//            return $query->result_array();
//        }
//
//        return false;
//    }
//
//    public function fetch_latest_informations($quantity){
//        $query = $this->db->select('*')
//            ->from('information')
//            ->where('is_deleted', 0)
//            ->order_by('created_at', 'desc')
//            ->limit($quantity)
//            ->get();
//
//        if($query->num_rows() > 0){
//            return $query->result_array();
//        }
//
//        return false;
//    }
//
//    public function count_all() {
//        $query = $this->db->select('*')
//            ->from('information')
//            ->where('is_deleted', 0)
//            ->get();
//
//        return $query->num_rows();
//    }
//
//    public function count_informations() {
//        $query = $this->db->select('*')
//            ->from('information')
//            ->get();
//
//        return $query->num_rows();
//    }
//
//    public function count_companys() {
//        $query = $this->db->select('*')
//            ->from('company')
//            ->get();
//
//        return $query->num_rows();
//    }
//
//    public function count_all_product() {
//        $query = $this->db->select('*')
//            ->from('product')
//            ->get();
//
//        return $query->num_rows();
//    }
//
//    public function count_product($id) {
//        $query = $this->db->select('*')
//            ->from('product')
//            ->where('client_id', $id)
//            ->get();
//
//        return $query->num_rows();
//    }
//
//    public function fetch_by_id($type, $id){
//        $query = $this->db->select('*')
//            ->from($type)
//            ->where('id', $id)
//            ->where('is_deleted', 0)
//            ->limit(1)
//            ->get();
//
//        if($query->num_rows() == 1){
//            return $query->row_array();
//        }
//
//        return false;
//    }
//
//    public function fetch_user_by_id($id){
//        $query = $this->db->select('*')
//            ->from('users')
//            ->where('id', $id)
//            ->limit(1)
//            ->get();
//
//        if($query->num_rows() == 1){
//            return $query->row_array();
//        }
//
//        return false;
//    }
//
//    public function fetch_by_user_id($type, $id){
//        $query = $this->db->select('*')
//            ->from($type)
//            ->where('client_id', $id)
//            ->limit(1)
//            ->get();
//
//        if($query->num_rows() == 1){
//            return $query->row_array();
//        }
//
//        return false;
//    }
//
//    public function fetch_product_by_user_and_id($type, $user_id, $id){
//        $query = $this->db->select('*')
//            ->from($type)
//            ->where('client_id', $user_id)
//            ->where('id', $id)
//            ->limit(1)
//            ->get();
//
//        if($query->num_rows() == 1){
//            return $query->row_array();
//        }
//
//        return false;
//    }
//
//    public function fetch_product_by_id($type, $id){
//        $query = $this->db->select('*')
//            ->from($type)
//            ->where('id', $id)
//            ->limit(1)
//            ->get();
//
//        if($query->num_rows() == 1){
//            return $query->row_array();
//        }
//
//        return false;
//    }
//
//
//
//    public function insert_company($type, $data){
//        $this->db->set($data)
//            ->insert($type);
//
//        if($this->db->affected_rows() == 1){
//            return $this->db->insert_id();
//        }
//
//        return false;
//    }
//
//    public function insert_product($type, $data){
//        $this->db->set($data)
//            ->insert($type);
//
//        if($this->db->affected_rows() == 1){
//            return $this->db->insert_id();
//        }
//
//        return false;
//    }
//
//    public function update($type, $id, $information){
//        $this->db->set($information)
//            ->where('id', $id)
//            ->update($type);
//
//        if($this->db->affected_rows() == 1){
//            return true;
//        }
//
//        return false;
//    }
//
//    public function delete($type, $id){
//        $this->db->set('is_deleted', 1)
//            ->where('id', $id)
//            ->update($type);
//
//        if($this->db->affected_rows() == 1){
//            return true;
//        }
//
//        return false;
//    }
//
//    public function fetch_all_company_pagination($limit = NULL, $start = NULL) {
//        $this->db->select('company.*, users.company as company');
//        $this->db->from('company');
//        $this->db->join('users', 'users.id = company.client_id');
//        $this->db->limit($limit, $start);
//        $this->db->order_by("company.id", "desc");
//
//        return $result = $this->db->get()->result_array();
//    }
//
//    public function fetch_company_by_id($id = null){
//        $this->db->select('company.*, users.*, information.*');
//        $this->db->from('company');
//        $this->db->join('users', 'users.id = company.client_id');
//        $this->db->join('information', 'information.client_id = company.client_id');
//        $this->db->where('company.id', $id);
//        $this->db->where('company.is_submit', 1);
//        return $result = $this->db->get()->row_array();
//    }
//
//    public function fetch_company_by_client_id($id = null){
//        $this->db->select('company.*, users.*, information.*');
//        $this->db->from('company');
//        $this->db->join('users', 'users.id = company.client_id');
//        $this->db->join('information', 'information.client_id = company.client_id');
//        $this->db->where('company.client_id', $id);
//        $this->db->where('company.is_submit', 1);
//        return $result = $this->db->get()->row_array();
//    }
//
//    public function count_company_search($search = '') {
//        $query = $this->db->select('company.*, users.*')
//            ->from('company')
//            ->join('users', 'users.id = company.client_id')
//            ->like('users.company', $search)
//            ->get();
//
//        return $query->num_rows();
//    }
//
//    public function fetch_all_company_pagination_search($limit = NULL, $start = NULL, $search = '') {
//        $this->db->select('company.*, users.company as company');
//        $this->db->from('company');
//        $this->db->join('users', 'users.id = company.client_id');
//        $this->db->limit($limit, $start);
//        $this->db->like('users.company', $search);
//        $this->db->order_by("company.id", "desc");
//
//        return $result = $this->db->get()->result_array();
//    }
//
//    public function fetch_client_id($id = null){
//        $this->db->select('*');
//        $this->db->from('company');
//        $this->db->where('client_id', $id);
//        $this->db->where('is_submit', 1);
//        return $result = $this->db->get()->row_array();
//    }
//
//      public function get_all_for_export($type, $client_id = null){
//        $this->db->select('*');
//        $this->db->from($type);
//        if($client_id != null){
//            $this->db->where('client_id', $client_id);
//        }
//        $this->db->where('is_submit', 1);
//        $this->db->order_by("id", "asc");
//
//        return $result = $this->db->get()->result_array();
//    }
//
//    public function fetch_company_by_member_id_pagination_search($member_id, $limit = NULL, $start = NULL, $search = '') {
//        $this->db->select('company.*, users.company as company');
//        $this->db->from('company');
//        $this->db->join('users', 'users.id = company.client_id');
//        $this->db->limit($limit, $start);
//        $this->db->like('users.company', $search);
//        $this->db->where('company.member_id', $member_id);
//        $this->db->order_by("company.id", "desc");
//
//        return $result = $this->db->get()->result_array();
//    }
//
//    public function count_company_search_by_member_id($member_id, $search = '') {
//        $query = $this->db->select('company.*, users.*')
//            ->from('company')
//            ->join('users', 'users.id = company.client_id')
//            ->like('users.company', $search)
//            ->where('company.member_id', $member_id)
//            ->get();
//
//        return $query->num_rows();
//    }
//
//    public function count_company_by_member_id($member_id) {
//        $query = $this->db->select('*')
//            ->from('company')
//            ->where('member_id', $member_id)
//            ->get();
//
//        return $query->num_rows();
//    }
}