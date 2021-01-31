<?php

class Company_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function get_list_company_by_id($company_ids){
        $query = $this->db->select('*, users.company as companyName, users.username as companyUsername')
            ->from('company')
            ->join('users', 'users.id = company.client_id')
            ->where_in('company.id', $company_ids);
        return $query->get()->result_array();
    }

    public function get_all_year(){
        $query = $this->db->select('year')
            ->from('company')
            ->group_by('year');
        $result = $query->get()->result_array();
        $output = array();
        foreach($result as $value){
            $output[] = $value['year'];
        }
        return $output;
    }

    public function fetch_company_by_identity_and_year($identity, $year){
        $query = $this->db->select('*')
            ->from('company')
            ->where('identity', $identity)
            ->where('year', $year)
            ->limit(1)
            ->get();

        if($query->num_rows() == 1){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_company_by_identity($identity){
        $query = $this->db->select('*')
            ->from('company')
            ->where('identity', $identity)
            ->order_by("id", "desc");
        return $query->get()->result_array();
    }
}