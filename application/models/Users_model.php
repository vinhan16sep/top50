<?php
/**
* 
*/
class Users_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	public function fetch_all_users_groups(){
        $query = $this->db->select('*')
            ->from('users_groups')
            ->where('group_id', 3)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function count_all_users_groups(){
        $query = $this->db->select('*')
            ->from('users_groups')
            ->where('group_id', 3)
            ->get();

        return $query->num_rows();
    }

    public function fetch_all_member(){
        $query = $this->db->select('users_groups.*, users.*')
            ->from('users_groups')
            ->where(array('group_id' => 2, 'user_id !=' => 1, 'group_id !=' => 3))
            ->join('users', 'users.id = users_groups.user_id')
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_all_member_with_where($where = array()){
        $this->db->select('users_groups.*, users.*');
        $this->db->from('users_groups');
        $this->db->where(array('group_id' => 2, 'user_id !=' => 1, 'group_id !=' => 3));
        if($where != null){
            $this->db->where_not_in('users.id', $where);
        }
        $this->db->join('users', 'users.id = users_groups.user_id');
        
        return $result = $this->db->get()->result_array();
    }

    public function fetch_all_client($id){
        $query = $this->db->select('company.*, users.*')
            ->from('company')
            ->join('users', 'users.id = company.client_id')
            ->where('company.member_id', $id)
            ->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        }

        return false;
    }

    public function fetch_by_id($id = ''){
        $query = $this->db->select('*')
            ->from('users')
            ->where('id', $id)
            ->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }

        return false;
    }

    public function fetch_member_by_id($id = ''){
        $query = $this->db->select('*')
            ->from('users')
            ->where('id', $id)
            ->get();

        if($query->num_rows() > 0){
            return true;
        }

        return false;
    }

    public function update_company($id, $data = [])
    {
        $this->db->set($data)
            ->where('id', $id)
            ->update('users');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function update($type, $id, $information){
        $this->db->set($information)
            ->where('id', $id)
            ->update($type);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function count_search($group_id = null, $keywords = ''){

        $this->db->select('*')
        ->join('users_groups', 'users.id = users_groups.user_id')
        ->from('users')
        ->where('email !=', 'admin@admin.com')
        ->where('users_groups.group_id', $group_id);

        if($keywords != ''){
            $this->db->where('(username LIKE "%' . $keywords . '%" OR company LIKE "%' . $keywords . '%" OR email LIKE "%' . $keywords . '%")');
        }

        return $result = $this->db->get()->num_rows();
    }

    public function get_all_with_pagination_search($group_id = null, $limit = NULL, $start = NULL, $keywords = null) {
        $this->db->select('*');
        $this->db->join('users_groups', 'users.id = user_id');
        $this->db->from('users');
        if ( !empty($keywords) ){
            $this->db->like('username', $keywords)->or_like('company', $keywords)->or_like('email', $keywords);
        }
        $this->db->where('email !=', 'admin@admin.com');
        $this->db->limit($limit, $start);
        $this->db->where('users_groups.group_id', $group_id);
        $this->db->order_by('created_on', 'desc');

        return $result = $this->db->get()->result_array();
    }

    public function fetch_all_leaders(){
	    $this->db->select('*')
            ->from('users')
            ->join('users_groups', 'users.id = users_groups.user_id')
            ->where('users_groups.group_id', 2)
            ->where('users.member_role', 'leader');

	    return $this->db->get()->result_array();
    }

    public function fetch_all_members(){
        $this->db->select('*')
            ->from('users')
            ->join('users_groups', 'users.id = users_groups.user_id')
            ->where('users_groups.group_id', 2)
            ->where('users.member_role', 'member');

        return $this->db->get()->result_array();
    }
}