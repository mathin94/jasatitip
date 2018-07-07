<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {

	public function get_all()
	{
		return $this->db->get('slider')->result();
	}

	public function insert($data)
	{
		return $this->db->insert('slider',$data);
	}

	public function update($id, $data)
	{
		$this->db->where('id_slider', $id);
		return $this->db->update('slider', $data);
	}

	public function delete($id)
	{
		$this->db->where('id_slider', $id);
        return $this->db->delete('slider');
	}

	public function get_one($id)
	{
		$this->db->where('id_slider', $id);
		$this->db->from('slider');
		return $this->db->get()->row_array();
	}

}

/* End of file Slider_model.php */
/* Location: ./application/models/Slider_model.php */