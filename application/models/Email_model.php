<?php 

/**
 * 
 */
class Email_model extends CI_Model
{
	
	function __construct(){
		parent::__construct();
	}

	function insert($data) {
        $this->db->set($data)->insert('email');
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('email', $data);
    }

	public function count_search($keyword = ''){
        $this->db->select('*');
        $this->db->from('email');
        $this->db->like('title', $keyword);
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_all_with_pagination_search($limit = NULL, $start = NULL, $keywords = null) {
        $this->db->select('*');
        $this->db->from('email');
        if ( !empty($keywords) ){
            $this->db->like('title', $keywords);
        }
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function find($id){
    	$this->db->select('*');
        $this->db->from('email');
        $this->db->where('id', $id);
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->row_array();
    }
}