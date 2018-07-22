<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman_model extends CI_Model {

	public $table = 'tb_pengiriman';
	public $column_order = array(null, 'kode_transaksi','nama_kurir','nomor_kurir', 'tgl_kirim', 'tgl_terima', 'nama_penerima');
    public $column_search = array('kode_transaksi','nama_kurir','nomor_kurir', 'tgl_kirim', 'tgl_terima', 'nama_penerima'); 
    public $order = array('id_pengiriman' => 'DESC');

    public function insert($data)
    {
    	$insert = $this->db->insert($this->table, $data);
    	
    	if ($insert) 
    	{
    		$id_kirim = $this->db->insert_id();
    		$this->db->insert('tb_pengiriman_detail', array(
    			'pengiriman_id'	=> $id_kirim,
    			'status'		=> 'Dalam Pengiriman',
    			'keterangan'	=> 'Pesanan Sedang Dikirim Oleh Kurir'
    		));

    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    public function get_detail($id)
    {
        $this->db->from($this->table);
        $this->db->join('tb_pengiriman_detail', 'tb_pengiriman.id_pengiriman = tb_pengiriman_detail.pengiriman_id');
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pengiriman.pemesanan_id');
        $this->db->where('pemesanan_id', $id);
        return $this->db->get()->result();
    }

    public function get_one($id)
    {
        $this->db->from($this->table);
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pengiriman.pemesanan_id');
        $this->db->where('pemesanan_id', $id);
        return $this->db->get()->row();
    }

    //Datatables Method
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pengiriman.pemesanan_id');

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

/* End of file Pengiriman_model.php */
/* Location: ./application/models/Pengiriman_model.php */