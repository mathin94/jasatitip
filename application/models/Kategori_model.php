<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public $table = 'tb_kategori';
	public $pkey = 'id_kategori';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all()
	{
		$this->db->order_by('nama_kategori', 'ASC');
		return $this->db->get($this->table)->result();
	}

	public function get_one($id)
	{
		$this->db->where($this->pkey, $id);
		return $this->db->get($this->table)->row_array();
	}

	public function kondisi($where = array())
	{
		$this->db->where($where);
		$this->db->order_by('nama_kategori', 'asc');
		return $this->db->get($this->table)->row();
	}

	public function is_exist($field, $value)
	{
		$this->db->from($this->table);
		$this->db->where($this->table.'.'.$field, $value);
		return $this->db->get()->result();
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		$this->db->where($this->pkey, $id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where($this->pkey, $id);
		$this->db->delete($this->table);
	}

}

/* End of file Kategori_model.php */
/* Location: ./application/models/Kategori_model.php */