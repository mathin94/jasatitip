<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk_model extends CI_Model
{

    public $table = 'tb_produk';
    public $id = 'id_produk';
    public $column_order = array(null, 'nama_produk','nama_kategori','kode_produk'); //field yang ada di table produk
    public $column_search = array('nama_produk','nama_kategori','kode_produk'); //field yang diizin untuk pencarian 
    public $orderby = 'DESC';
    public $order = array('id_produk' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    public function get_produk($number, $offset, $filter = NULL)
    {
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');

        if($filter != NULL)
        {
            $no = 1;
            foreach ($filter as $key => $value) {
                if ($no>1) 
                {
                    $this->db->or_where($key, $value);
                }
                else
                {
                    $this->db->where($key, $value);
                }
                
                $no++;
            }
        }
        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($number, $offset);

        return $this->db->get()->result();
    }

    public function search($q, $number, $offset)
    {  
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');

        if($q != NULL)
        {
            $this->db->like('nama_produk', $q);
        }

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($number, $offset);

        return $this->db->get()->result();
    }

    public function get_produk_terbaru()
    {
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');
        $this->db->order_by('id_produk', 'desc');
        $this->db->limit(8);
        return $this->db->get()->result();
    }

    public function get_data($config, $page = 0, $id_kategori = NULL, $q = NULL)
    {  
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');

        if ($id_kategori != NULL) 
            $this->db->where('kategori_id', $id_kategori);

        if ($q != NULL)
        {
            $this->db->like('nama_produk', $q);
            $this->db->like('nama_kategori', $q);
            $this->db->like('kode_produk', $q);
        }

        $this->db->limit($config['per_page'], $page);
        
        return $this->db->get();
    }

    

    // get all
    function get_all()
    {
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');
        $this->db->order_by('id_produk', 'DESC');
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');
        $this->db->where($this->id, $id);
        return $this->db->get()->row_array();
    }
    
    

    public function get_related($where)
    {
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');
        $this->db->where('id_kategori', $where);
        return $this->db->get()->result();
    }

    public function total_rows($id_kat='')
    {
        $this->db->from($this->table);
        if ($id_kat != '') {
            $this->db->where('kategori_id', $id_kat);
        }
        $this->db->get()->num_rows();
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
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.kategori_id');
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
 
    public function count_all($kategori_id = 0, $q = null)
    {
        $this->db->from($this->table);
        if ($q != null) 
        {
            $this->db->like('nama_produk', $q);
        }

        if ($kategori_id != 0) 
        {
            $this->db->where('kategori_id', $kategori_id);
        }
        return $this->db->count_all_results();
    }

}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */
