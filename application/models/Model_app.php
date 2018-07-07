<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_app extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_all($table, $order = '',$by = '')
    {
        if($order == '' && $by == '')
        {
            $data = $this->db->get($table)->result();
        }
        else if ($by == '' && $order != '')
        {
            $this->db->order_by($order, 'asc');
            $data = $this->db->get($table)->result();
        }
        else
        {
            $this->db->order_by($order, $by);
            $data = $this->db->get($table)->result();
        }

        return $data;
            
    }

    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table,$order,$ordering,$baris,$dari)
    {
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_where_ordering_limit($table,$data,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table)->result();
    }
    
    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result();
    }

    public function view_where_ordering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $query = $this->db->get($table);
        return $query;
    }

    public function view_join_one($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_rows($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }

    public function view_join_where_one($table1,$table2,$field,$where){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        return $this->db->get();
    }

    public function get_one($table, $pkey, $pkeyval)
    {
        $this->db->where($pkey, $pkeyval);
        return $this->db->get($table)->row_array();
    }

    public function update_identitas($data)
    {
        $this->db->where('id_identitas', '1');
        return $this->db->update('identitas', $data);
    }

    function cari_produk($kata){
        $pisah_kata = explode(" ",$kata);
        $jml_katakan = (integer)count($pisah_kata);
        $jml_kata = $jml_katakan-1;
        $cari = "SELECT * FROM rb_produk WHERE ";
            for ($i=0; $i<=$jml_kata; $i++){
              $cari .= " nama_produk LIKE '%".$pisah_kata[$i]."%'";
                if ($i < $jml_kata ){
                    $cari .= " OR "; 
                } 
            }
        $cari .= " ORDER BY id_produk DESC LIMIT 18";
        return $this->db->query($cari);
    }

    function jual($id){
        return $this->db->query("SELECT sum(a.jumlah) as jual FROM rb_penjualan_detail a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where a.id_produk='$id' AND b.proses='1'");
    }

    function beli($id){
        return $this->db->query("SELECT sum(a.jumlah_pesan) as beli FROM rb_pembelian_detail a where a.id_produk='$id'");
    }

    function jual_umum($produk){
        return $this->db->query("SELECT sum(jumlah) as jual FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where b.id_produk='$produk' AND a.proses!='0'");
    }

    function beli_umum($produk){
        return $this->db->query("SELECT sum(jumlah_pesan) as beli FROM `rb_pembelian_detail` where id_produk='$produk'");
    }

    function umenu_akses($link,$id){
        return $this->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    }

    public function cek_login($username,$password,$table){
        return $this->db->query("SELECT * FROM $table where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."' AND blokir='N'");
    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function orders_report($id){
        return $this->db->query("SELECT * FROM `rb_penjualan` a where a.id_pembeli='$id' ORDER BY a.id_penjualan DESC");
    }

    function konfirmasi_bayar(){
        return $this->db->query("SELECT b.kode_transaksi, a.*, c.* FROM `rb_konfirmasi` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan JOIN rb_rekening c ON a.id_rekening=c.id_rekening ORDER BY a.id_konfirmasi_pembayaran DESC");
    }

    function orders_report_all($id){
        return $this->db->query("SELECT * FROM `rb_penjualan` a ORDER BY a.id_penjualan DESC");
    }

    function orders_report_home($limit){
        return $this->db->query("SELECT * FROM `rb_penjualan` a ORDER BY a.id_penjualan DESC LIMIT $limit");
    }

    function profile_konsumen($id){
        return $this->db->query("SELECT a.id_konsumen, a.username, a.nama_lengkap, a.email, a.jenis_kelamin, a.tanggal_lahir, a.tempat_lahir, a.alamat_lengkap, a.no_hp, a.tanggal_daftar, a.foto, b.kota_id, b.nama_kota as kota FROM `rb_konsumen` a LEFT JOIN rb_kota b ON a.kota_id=b.kota_id where a.id_konsumen='$id'");
    }

}

/* End of file Model_app.php */
/* Location: ./application/models/Model_app.php */
 
