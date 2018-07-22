<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Alamat_model', 'alamat');
		$this->load->model('Auth_model');
		$this->load->model('Users_model', 'users');
		$this->load->model('Pemesanan_model', 'order');
        $this->load->model('Ongkir_model', 'ongkir');
		$this->load->model('Users_model', 'users');
	}

    public function reset_pass()
    {
        $id = $this->input->post('id_user');
        $username = $this->input->post('username');
        $data = array(
            'password' => $this->Auth_model->makeHash($username)
        );

        $update = $this->users->update_byid($id, $data);

        if ($update) {
            echo json_encode(array('STATUS'=>1));
        }
        else
        {
            echo json_encode(array('STATUS'=>0));
        }
    }

    public function delete_admin()
    {
        $id = $this->input->post('id_user');

        $delete = $this->users->delete($id);

        if ($delete) {
            echo json_encode(array('STATUS'=>1));
        }
        else
        {
            echo json_encode(array('STATUS'=>0));
        }
    }

    public function activate_user()
    {
        $id = $this->input->post('id_user');
        $update = $this->users->update_byid($id, array('aktif'=>'Y'));
        if ($update) {
            echo json_encode(array('STATUS'=>1));
        }
        else
        {
            echo json_encode(array('STATUS'=>0));
        }
    }

    public function deactivate_user()
    {
        $id = $this->input->post('id_user');
        $update = $this->users->update_byid($id, array('aktif'=>'N'));
        if ($update) {
            echo json_encode(array('STATUS'=>1));
        }
        else
        {
            echo json_encode(array('STATUS'=>0));
        }
    }

	public function get_data_pelanggan()
	{
		$role = 'pelanggan';
		$list = $this->users->get_datatables($role);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
        	
        	if($field->aktif == 'N')
        		$button = '<button onclick="activate('.$field->id_user.',\''.$field->username.'\')" class="btn btn-sm btn-primary">Aktifkan</button>';
        	else
        		$button = '<button onclick="deactivate('.$field->id_user.',\''.$field->username.'\')" class="btn btn-sm btn-danger">Nonaktifkan</button>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->username;
            $row[] = $field->email;
            $row[] = $field->nama_lengkap;
            $row[] = $field->waktu_daftar;
            $row[] = $field->aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users->count_all($role),
            "recordsFiltered" => $this->users->count_filtered($role),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}

    public function get_data_admin()
    {
        $role = 'administrator';
        $list = $this->users->get_datatables($role);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) 
        {
            $button = '';
            if ($field->id_user != 1) 
            {
                if($field->aktif == 'N'){
                    $button .= '<button onclick="activate('.$field->id_user.',\''.$field->username.'\')" class="btn btn-sm btn-primary">Aktifkan</button>';
                }
                else {
                    $button .= '<button onclick="deactivate('.$field->id_user.',\''.$field->username.'\')" class="btn btn-sm btn-danger">Nonaktifkan</button>';
                }
            }
                

            $button .= ' <button onclick="reset_pass('.$field->id_user.',\''.$field->username.'\')" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i> Reset Pass</button>';

            if ($field->id_user != 1) 
            {
                $button .=  ' <button onclick="delete_admin('.$field->id_user.',\''.$field->username.'\')" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>';
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->username;
            $row[] = $field->email;
            $row[] = $field->nama_lengkap;
            $row[] = $field->waktu_daftar;
            $row[] = $field->aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users->count_all($role),
            "recordsFiltered" => $this->users->count_filtered($role),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

	public function json_all_ongkir()
	{
		$list = $this->ongkir->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_kabupaten;
            $row[] = $field->nama_kecamatan;
            $row[] = 'Rp. ' . number_format($field->biaya);
            $row[] = '<a href="'.site_url('administrator/edit_ongkir/'.$field->id_ongkir).'"><i class="fa fa-edit"></i></a> <a href="#" onclick="delete_ongkir('.$field->id_ongkir.',\''.$field->nama_kecamatan.'\')"><i class="fa fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ongkir->count_all(),
            "recordsFiltered" => $this->ongkir->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}

    public function json_laporan()
    {
        $list = $this->order->get_datatables(NULL, array('Dalam Proses', 'Dikirim', 'Terkirim'));

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->kode_transaksi;
            $row[] = $field->email;
            $row[] = $field->username;
            $row[] = $field->tanggal;
            $row[] = 'Rp. ' . number_format($field->total_harga+$field->total_ongkir+$field->total_fee+$field->kode_unik);
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->order->count_all(NULL, array('Dalam Proses','Dikirim', 'Terkirim')),
            "recordsFiltered" => $this->order->count_filtered(NULL, array('Dalam Proses','Dikirim', 'Terkirim')),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

	public function json_order_baru()
	{
		$role = 'pelanggan';
		$list = $this->order->get_datatables(NULL, array('Menunggu Konfirmasi'));

        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $field) {
        	$action = '';

        	if ($field->status == 'Menunggu Konfirmasi') 
        	{
        		$action = '<a href="'.base_url('administrator/cek_pembayaran/'.$field->kode_transaksi).'"> Lihat Detail Pembayaran</a>';
        	}

        	if ($field->status == 'Dalam Proses') 
        	{
        		$action = '<a href="'.base_url('administrator/konfirmasi_kirim/'.$field->kode_transaksi).'"> Konfirmasi Kirim</a>';
        	}

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->kode_transaksi;
            $row[] = $field->email;
            $row[] = 'Rp. ' . number_format($field->total_harga+$field->total_ongkir+$field->total_fee+$field->kode_unik);
            $row[] = $field->status;
            $row[] = $action;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->order->count_all(NULL, array('Menunggu Konfirmasi')),
            "recordsFiltered" => $this->order->count_filtered(NULL, array('Menunggu Konfirmasi')),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}

	public function json_all_order()
	{
		$role = 'pelanggan';
		$list = $this->order->get_datatables(NULL, array('Dalam Proses', 'Dikirim', 'Terkirim'));

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
        	$action = '';

        	if ($field->status == 'Menunggu Konfirmasi') 
        	{
        		$action = '<a href="'.base_url('administrator/cek_pembayaran/'.$field->kode_transaksi).'"> Lihat Detail Pembayaran</a>';
        	}

        	if ($field->status == 'Dalam Proses') 
        	{
        		$action = '<a href="'.site_url('administrator/konfirmasi_kirim/'.$field->id_pemesanan).'"> Konfirmasi Kirim</a>';
        	}

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->kode_transaksi;
            $row[] = $field->email;
            $row[] = 'Rp. ' . number_format($field->total_harga+$field->total_ongkir+$field->total_fee+$field->kode_unik);
            $row[] = $field->status;
            $row[] = $action;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->order->count_all(NULL, array('Dalam Proses', 'Dikirim', 'Terkirim')),
            "recordsFiltered" => $this->order->count_filtered(NULL, array('Dalam Proses', 'Dikirim', 'Terkirim')),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}

	public function get_kabupaten()
	{
		if(isset($_POST['id_provinsi']) && isset($_POST['selected']))
		{
			$id_provinsi = $this->input->post('id_provinsi');
			$selected 	 = $this->input->post('selected');
			
			if($id_provinsi != '')
				$data = $this->alamat->get_kabupaten_by_idprovinsi($id_provinsi);
			
			if($data) 
			{
				echo '<option value="">-- Pilih Kota / Kabupaten --</option>';
				foreach ($data as $r) {
					$sel = '';

					if($r->id_kabupaten == $selected)
						$sel = 'selected';
					echo "<option value='".$r->id_kabupaten."' ".$sel.">".$r->nama_kabupaten."</option>";
				}
			}
			else
			{
				echo '<option value="">-- Pilih Kota / Kabupaten --</option>';
			}
			
		}
	}

	public function get_kecamatan()
	{
		if(isset($_POST['id_kabupaten']) && isset($_POST['selected']))
		{
			$id_kabupaten = $this->input->post('id_kabupaten');
			$selected 	  = $this->input->post('selected');
			if ($id_kabupaten != '')
				$data = $this->alamat->get_kecamatan_by_idkabupaten($id_kabupaten);
	
			if($data)
			{
				echo '<option value="">-- Pilih Kecamatan --</option>';
				foreach ($data as $r) {
					$sel = '';
					if($r->id_kecamatan == $selected)
						$sel = 'selected';
					echo "<option value='".$r->id_kecamatan."' ".$sel.">".$r->nama_kecamatan."</option>";
				}
			}
			else
			{
				echo '<option value="">-- Pilih Kecamatan --</option>';
			}	
		}
	}

	public function get_kecamatan_byid()
	{
		$data = $this->alamat->get_kecamatan_full($this->input->post('id_kecamatan'));
		echo json_encode($data);
	}

}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */