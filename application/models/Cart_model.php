<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

	function get_all_produk(){
        $hasil=$this->db->get('tb_produk');
        return $hasil->result();
    }	

}

/* End of file Cart_model.php */
/* Location: ./application/models/Cart_model.php */