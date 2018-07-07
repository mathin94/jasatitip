<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function __construct() 
	{
		parent:: __construct();
	}

	public function getLoginData($username) 
	{
		$this->db->where('username',$username);
		$this->db->or_where('email',$username);
		$querry = $this->db->get('tb_users');
		if ($querry->num_rows() == 1) {
			foreach ($querry->result() as $row) {
				$data = array(
							'logged_in' 	=> 'Yes',
							'nama_lengkap' 	=> $row->nama_lengkap,
							'username' 		=> $row->username,
							'email' 		=> $row->email,
							'role' 			=> $row->role
					);
			}
		//SESSION DI CODEIGNITER
		$this->session->set_userdata($data);
		return $querry->row_array();
		}
	}
	
	function cekPass($email) {
        $this->db->select('password');
        $this->db->from('tb_users');
        $this->db->where('email', $email);
        $this->db->or_where('username', $email);
        $ck = $this->db->get();
        if ($ck->num_rows()>0){
            return $ck->row_array();
        } else {
        	return false;
        }
    }

    public function makeHash($string)
    {
		$options = array('cost' => 11);
		$hash    = password_hash($string, PASSWORD_BCRYPT, $options);
		return $hash;
    }

    public function updPass($username,$newHash) {
        $data = array(
                    'password' => $newHash
            );
        $this->db->where('username',$username);
        $update = $this->db->update('tb_users',$data);
        return TRUE;
    }

    public function add_account($data)
    {
    	$this->db->insert('tb_users', $data);
    }

    public function is_exists($field, $key)
    {
    	$this->db->where($field, $key);
    	$query = $this->db->get('tb_users');
    	if ($query->num_rows() > 0)
    	{
	        return TRUE;
	    }
	    else
	    {
	        return FALSE;
	    }
    }

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */