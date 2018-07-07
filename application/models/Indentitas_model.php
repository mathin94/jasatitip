<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indentitas_model extends CI_Model {

	public function get_one($id)
	{
		$this->db->where('id_identitas', $id);
		$this->db->from('identitas');
		return $this->db->get()->row_array();
	}

	public function update($id, $data)
	{
		$this->db->where('id_identitas', $id);
		return $this->db->update('identitas', $data);
	}

}

/* End of file Indentitas_model.php */
/* Location: ./application/models/Indentitas_model.php */