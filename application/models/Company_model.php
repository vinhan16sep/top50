<?php

class Company_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function get_list_company_by_id($company_ids){
        $query = $this->db->select('company.*, users.id as userId,users.company as companyName, users.username as companyUsername')
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
}