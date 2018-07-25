<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund_model extends CI_Model {

	public $table = 'tb_refund';
	public $column_order = array(null, 'kode_transaksi','tanggal_pengajuan');
    public $column_search = array('kode_transaksi','tanggal_pengajuan'); 
    public $order = array('id_refund' => 'DESC');

    public function insert($data)
    {
    	return $this->db->insert($this->table, $data);
    }

    public function total_refund($status_refund = array('Menunggu Refund'))
    {
    	$this->db->from($this->table);
    	$this->db->where_in('status_refund', $status_refund);
    	return $this->db->get()->num_rows();
    }

    public function get_one($id)
    {
        $this->db->from($this->table);
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_refund.pemesanan_id');
        $this->db->where('id_refund', $id);
        return $this->db->get()->row_array();
    }

    public function ubah_status($id)
    {
        $this->db->where('id_refund', $id);
        $this->db->update($this->table, array(
            'status_refund' => 'Telah Direfund',
            'tanggal_refund'=> date('Y-m-d H:i:s')
        ));
    }

    //Datatables Method
    private function _get_datatables_query($status)
    {
         
        $this->db->from($this->table);
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_refund.pemesanan_id');
        
        if ($status != NULL) 
        {
        	$this->db->where_in('status_refund', $status);
        }

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

    function get_datatables($status = NULL)
    {
        $this->_get_datatables_query($status);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($status = NULL)
    {
        $this->_get_datatables_query($status);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($status = NULL)
    {
        $this->db->from($this->table);
        if ($status != NULL) 
        {
        	$this->db->where_in('status_refund', $status);
        }
        return $this->db->count_all_results();
    }	

}

/* End of file Refund_model.php */
/* Location: ./application/models/Refund_model.php */