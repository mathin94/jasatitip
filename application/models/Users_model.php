<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public $table = 'tb_users'; //nama tabel dari database
    public $column_order = array(null, 'username','email','nama_lengkap'); //field yang ada di table user
    public $column_search = array('username','email','nama_lengkap'); //field yang diizin untuk pencarian 
    public $order = array('id_user' => 'asc'); // default order 
	public $unique = 'username';

	public function get_by_username($username)
	{
		$this->db->from($this->table);
		$this->db->where($this->unique, $username);
		return $this->db->get()->row_array();
	}

    public function insert($data)
    {
        return $this->db->insert($this->table,$data);
    }

    public function delete($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->delete($this->table);
    }


	public function update($username, $data)
	{
		$this->db->where($this->unique, $username);

		$this->session->set_userdata('username', $data['username']);
		$this->session->set_userdata('email', $data['email']);
		$this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);

		return $this->db->update($this->table, $data);
	}

    public function update_byid($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update($this->table, $data);
    }

	private function _get_datatables_query($role)
    {
         
        $this->db->from($this->table);
 		$this->db->where('role', $role);
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {

            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($role)
    {
        $this->_get_datatables_query($role);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($role)
    {
        $this->_get_datatables_query($role);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($role)
    {
        $this->db->from($this->table);
        $this->db->where('role', $role);
        return $this->db->count_all_results();
    }	

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */