<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan_model extends CI_Model {

	public $table = 'tb_pemesanan';
	public $column_order = array(null, 'kode_transaksi','username','status', 'tanggal');
    public $column_search = array('kode_transaksi','username','status', 'tanggal'); 
    public $order = array('id_pemesanan' => 'DESC');

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    
    public function pesanan_terbaru_limit($limit, $start = 0, $q = NULL) 
    {
        $this->db->from('tb_pemesanan');
        $this->db->join('tb_users', 'tb_users.id_user = tb_pemesanan.user_id');
        $this->db->where('status', 'Menunggu Konfirmasi');
        $this->db->like('kode_transaksi', $q);
    	$this->db->like('tanggal', $q);
        $this->db->order_by('id_pemesanan', 'DESC');
    	$this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    public function semua_transaksi($limit, $start = 0, $q = NULL) 
    {
        $this->db->from('tb_pemesanan');
        $this->db->join('tb_users', 'tb_users.id_user = tb_pemesanan.user_id');
        $this->db->where_in('status', array('Dalam Proses','Dikirim','Terkirim'));
        $this->db->like('kode_transaksi', $q);
    	$this->db->like('tanggal', $q);
        $this->db->order_by('id_pemesanan', 'DESC');
    	$this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    public function total_rows($q = NULL) 
    {
        $this->db->like('kode_transaksi', $q);
    	$this->db->or_like('tanggal', $q);
    	$this->db->or_like('status', $q);
    	$this->db->from('tb_pemesanan');
        return $this->db->count_all_results();
    }

    public function total_pemesanan()
    {
    	$this->db->from('tb_pemesanan');
    	$this->db->where_in('status', array('Sedang Diproses','Dikirim', 'Terkirim'));
    	return $this->db->get()->num_rows();
    }

    public function total_pemesanan_baru()
    {
    	$this->db->from('tb_pemesanan');
    	$this->db->where('status', 'Menunggu Konfirmasi');
    	return $this->db->get()->num_rows();
    }

	public function insert($data, $items)
	{
		$insert = $this->db->insert('tb_pemesanan', $data);
		if ($insert) 
		{
			$id_order = $this->db->insert_id();
			$this->session->set_flashdata('id_order', $id_order);
			foreach ($items as $item) 
			{
				$this->db->insert('tb_pemesanan_detail', array(
					'produk_id'		=> $item['id'],
                    'harga'         => $item['price'],
					'fee_jastip'	=> $item['options']['fee'],
					'qty'			=> $item['qty'],
					'pemesanan_id'	=> $id_order
				));
			}
		}
	}

	public function update($id,$data)
	{
		$this->db->where('id_pemesanan', $id);
        return $this->db->update('tb_pemesanan', $data);
	}

	public function cek_pesanan($userid, $id)
	{
		$this->db->from('tb_pemesanan');
        $this->db->join('tb_users', 'tb_users.id_user = tb_pemesanan.user_id');
        $this->db->where('user_id', $userid);
        $this->db->where('id_pemesanan', $id);
        return $this->db->count_all_results();
	}

	public function konfirmasi($kode_transaksi)
	{

		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->update('tb_pemesanan', array(
            'status'=>'Dalam Proses',
            'waktu_konfirmasi'=>date('Y-m-d H:i:s')
        ));

	}

	public function konfirmasi_kirim($id)
	{
		$this->db->where('id_pemesanan', $id);
		$this->db->update('tb_pemesanan', array('status'=>'Dikirim'));

	}

	public function get_pemesanan_one($id)
	{
		$this->db->from('tb_pemesanan');
		$this->db->join('tb_alamat_kirim', 'tb_alamat_kirim.id_alamat = tb_pemesanan.alamat_id');
		$this->db->join('kecamatan', 'kecamatan.id_kecamatan = tb_alamat_kirim.kecamatan_id');
		$this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.kabupaten_id');
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.provinsi_id');
		$this->db->where('id_pemesanan', $id);
		return $this->db->get()->row_array();
	}

	public function get_detail($id)
	{
		$this->db->select('pemesanan_id,tb_pemesanan_detail.fee_jastip as fee_jastip, tb_pemesanan_detail.harga as harga_produk, qty, berat, nama_produk');
		$this->db->from('tb_pemesanan_detail');
		$this->db->join('tb_produk', 'tb_produk.id_produk = tb_pemesanan_detail.produk_id');
		$this->db->where('pemesanan_id', $id);
		return $this->db->get()->result();
	}

	public function autokode()
	{
		$this->db->select("MAX(RIGHT(kode_transaksi,6)) AS kd_max");
		$this->db->from("tb_pemesanan");
		$this->db->where("DATE(tanggal)", date('Y-m-d'));
		$data = $this->db->get();
		$kd = "";

		if($data->num_rows()>0)
		{
			foreach ($data->result() as $k) {
				$tmp 	= ((int)$k->kd_max)+1;
				$kd 	= sprintf("%06s", $tmp);
			}
		}
		else 
		{
			$kd = "000001";			
		}

		date_default_timezone_set('Asia/Jakarta');

		return "TRX-".date('dmY')."-".$kd;
	}	

	public function kode_unik($nominal)
	{
		$sub = substr($nominal,-3);
		$sub2 = substr($nominal,-2);
		$sub3 = substr($nominal,-1);

		$total =  random_string('numeric', 3);
		$total2 =  random_string('numeric', 2);
		$total3 =  random_string('numeric', 1);

		if($sub==0){
			$hasil =  $nominal + $total; 
			return $total;
		} else if($sub2 == 0){
			$hasil = $nominal + $total2; 
			$no = substr($hasil,-3);
			return $no;
		} else if($sub3 == 0){
			$hasil = $nominal + $total3; 
			$no = substr($hasil,-3);
			return $no;
		}else{
			return $sub;
		}
	}


	private function _get_datatables_query($username = NULL, $status = NULL)
    {
         
        $this->db->from($this->table);
        $this->db->join('tb_users', 'tb_users.id_user = tb_pemesanan.user_id');

        if ($this->input->post('start_date')) 
        {
            $this->db->where('tanggal >=', $this->input->post('start_date'));
        }

        if ($this->input->post('end_date')) 
        {
            $this->db->where('tanggal <=', $this->input->post('end_date'));
        }

        if ($username != NULL) 
        {
            $this->db->where('username', $username);
        }
        
        if ($status != NULL) 
        {
            $this->db->where_in('status', $status);
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

    public function _query_report($start_date, $end_date)
    {
        $this->db->from($this->table);
        $this->db->join('tb_users', 'tb_users.id_user = tb_pemesanan.user_id');
        $this->db->where('tanggal >=', $start_date);
        $this->db->where('tanggal <=', $end_date);
        $this->db->where_in('status', array('Dikirim','Dalam Proses', 'Terkirim'));
        $this->db->order_by('id_pemesanan', 'desc');
        
    }
    public function get_data_range($start_date, $end_date)
    {
        $this->_query_report($start_date, $end_date);
        return $this->db->get()->result();
    }

    public function total_data_range($start_date, $end_date)
    {
        $this->_query_report($start_date, $end_date);
        $data = $this->db->get()->result();

        $total = 0;
        
        foreach ($data as $row) {
            $total += ($row->total_ongkir+$row->total_harga+$row->total_fee+$row->kode_unik);
        }

        return $total;
    }
 
    function get_datatables($username = NULL, $status = NULL)
    {
        $this->_get_datatables_query($username, $status);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($username = NULL, $status = NULL)
    {
        $this->_get_datatables_query($username, $status);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($username = NULL, $status = NULL)
    {
        $this->db->from($this->table);
        $this->db->join('tb_users', 'tb_users.id_user = tb_pemesanan.user_id');

        if ($status != NULL) 
        {
        	$this->db->where_in('status', $status);
        }

        if ($username != NULL) 
        {
        	$this->db->where('username', $username);
        }

        return $this->db->count_all_results();
    }
	
}

/* End of file Pemesanan_model.php */
/* Location: ./application/models/Pemesanan_model.php */