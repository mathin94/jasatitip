<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat_model extends CI_Model {

	public function get_provinsi()
	{
		$this->db->from('provinsi');
		$this->db->order_by('nama_provinsi', 'ASC');
		return $this->db->get()->result();
	}

	public function get_kabupaten_by_idprovinsi($id_provinsi)
	{
		$this->db->from('kabupaten');
		$this->db->join('provinsi', 'kabupaten.provinsi_id = provinsi.id_provinsi');
		$this->db->where('provinsi_id', $id_provinsi);
		$this->db->where('nama_kabupaten', 'SUKABUMI');
		$this->db->or_where('nama_kabupaten', 'KOTA SUKABUMI');
		$this->db->order_by('nama_kabupaten', 'ASC');
		return $this->db->get()->result();
	}

	public function get_kecamatan_by_idkabupaten($id_kabupaten)
	{
		$this->db->from('kecamatan');
		$this->db->join('kabupaten', 'kecamatan.kabupaten_id = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.provinsi_id = provinsi.id_provinsi');
		$this->db->where('kabupaten_id', $id_kabupaten);
		$this->db->order_by('nama_kecamatan', 'ASC');
		return $this->db->get()->result();
	}

	public function get_kecamatan_full($id)
	{
		$this->db->from('kecamatan');
		$this->db->join('kabupaten', 'kecamatan.kabupaten_id = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.provinsi_id = provinsi.id_provinsi');
		$this->db->where('id_kecamatan', $id);
		return $this->db->get()->row_array();
	}

	public function get_alamat_pengiriman($username)
	{
		$this->db->from('tb_alamat_kirim');
		$this->db->join('tb_user_alamat', 'tb_user_alamat.alamat_id = tb_alamat_kirim.id_alamat');
		$this->db->join('tb_users', 'tb_users.id_user = tb_user_alamat.user_id');
		$this->db->where('username', $username);
		return $this->db->get()->result();
	}

	public function get_alamat_lengkap($id)
	{
		$this->db->from('tb_alamat_kirim');
		$this->db->join('tb_user_alamat', 'tb_user_alamat.alamat_id = tb_alamat_kirim.id_alamat');
		$this->db->join('tb_users', 'tb_users.id_user = tb_user_alamat.user_id');
		$this->db->join('kecamatan', 'tb_alamat_kirim.kecamatan_id = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'kecamatan.kabupaten_id = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.provinsi_id = provinsi.id_provinsi');
		$this->db->where('id_alamat', $id);
		return $this->db->get()->row_array();
	}

	public function get_alamat($username)
	{
		$this->db->from('tb_alamat_kirim');
		$this->db->join('tb_user_alamat', 'tb_user_alamat.alamat_id = tb_alamat_kirim.id_alamat');
		$this->db->join('tb_users', 'tb_users.id_user = tb_user_alamat.user_id');
		$this->db->join('kecamatan', 'tb_alamat_kirim.kecamatan_id = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'kecamatan.kabupaten_id = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.provinsi_id = provinsi.id_provinsi');
		$this->db->where('username', $username);
		return $this->db->get()->result();
	}

	public function update_alamat($id, $data)
	{
		$this->db->where('id_alamat', $id);
		return $this->db->update('tb_alamat_kirim', $data);
	}

	public function delete_alamat($id)
    {
        $this->db->where('id_alamat', $id);
        $delete = $this->db->delete('tb_alamat_kirim');
        if ($delete) {
        	$this->db->where('alamat_id', $id);
        	$this->db->delete('tb_user_alamat');
        }
    }

	public function insert_alamat($alamat, $user_id)
	{
		$this->db->insert('tb_alamat_kirim', $alamat);
		return $this->db->insert('tb_user_alamat', array(
			'user_id'	=> $user_id,
			'alamat_id' => $this->db->insert_id()
		));
	}

}

/* End of file Alamat_model.php */
/* Location: ./application/models/Alamat_model.php */