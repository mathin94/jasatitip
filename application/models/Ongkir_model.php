<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir_model extends CI_Model {

    public $table = 'tb_ongkir';
    public $id = 'id_ongkir';
    public $column_order = array(null, 'nama_kecamatan'); //field yang ada di table produk
    public $column_search = array('nama_kecamatan'); //field yang diizin untuk pencarian 
    public $order = array('id_ongkir' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->from($this->table);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_ongkir.kecamatan_id');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
        $this->db->order_by('nama_kabupaten', 'ASC');
        return $this->db->get()->result();
    }
    public function get_one($id)
    {
        $this->db->from($this->table);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_ongkir.kecamatan_id');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
        $this->db->where($this->id, $id);
        return $this->db->get()->row_array();
    }

    public function count_all_kec($id)
    {
        $this->db->from($this->table);
        $this->db->where('kecamatan_id', $id);
        return $this->db->count_all_results();
    }
    // get data by id
    function get_by_id($id)
    {
       	$this->db->from($this->table);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_ongkir.kecamatan_id');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
        $this->db->where($this->id, $id);
        return $this->db->get()->row_array();
    }

    // get data by id kecamatan
    function get_by_kecamatanid($id_kecamatan)
    {
        $this->db->from($this->table);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_ongkir.kecamatan_id');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
        $this->db->where('kecamatan_id', $id_kecamatan);
        return $this->db->get()->row_array();
    }
    
    // get total rows
    function total_rows($q = NULL) {
    	$this->db->from($this->table);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_ongkir.kecamatan_id');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
        $this->db->like('nama_kecamatan', $q);
    	$this->db->or_like('nama_kabupaten', $q);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) 
    {
        $this->db->from($this->table);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_ongkir.kecamatan_id');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_kecamatan', $q);
    	$this->db->or_like('nama_kabupaten', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get()->result();
    }


    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }	

    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_ongkir.kecamatan_id');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}

/* End of file Ongkir_model.php */
/* Location: ./application/models/Ongkir_model.php */