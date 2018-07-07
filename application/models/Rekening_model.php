<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_model extends CI_Model {

	public function get_all()
	{
		return $this->db->get('rekening_bank')->result();
	}

	public function insert($data)
	{
		return $this->db->insert('rekening_bank',$data);
	}

	public function update($id, $data)
	{
		$this->db->where('id_rekening', $id);
		return $this->db->update('rekening_bank', $data);
	}

	public function delete($id)
	{
		$this->db->where('id_rekening', $id);
        return $this->db->delete('rekening_bank');
	}

	public function get_one($id)
	{
		$this->db->where('id_rekening', $id);
		$this->db->from('rekening_bank');
		return $this->db->get()->row_array();
	}

}

/* End of file Rekening_model.php */
/* Location: ./application/models/Rekening_model.php */