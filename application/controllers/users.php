<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Alamat_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		redirect('users/profile');
	}	

	public function tambah_alamat()
	{
		if (isset($_POST['submit'])) 
		{
			$config = array(
				array(
					'field'	=> 'nama_alamat',
					'label' => 'Nama Alamat',
					'rules' => 'required',
				),
				array(
					'field'	=> 'nama_penerima',
					'label' => 'Nama Penerima',
					'rules' => 'required',
				),
				array(
					'field'	=> 'nomor_penerima',
					'label' => 'Nomor HP Penerima',
					'rules' => 'required|numeric',
				),
				array(
					'field'	=> 'id_kecamatan',
					'label' => 'Kecamatan',
					'rules' => 'required',
				),
				array(
					'field'	=> 'alamat_lengkap',
					'label' => 'Alamat Lengkap',
					'rules' => 'required',
				),
				array(
					'field'	=> 'kode_pos',
					'label' => 'Kode Pos',
					'rules' => 'required|numeric',
				)
			);

			$post   = $this->input->post();
			$users  = $this->Users_model->get_by_username($this->session->userdata('username'));
			$alamat = array(
				'nama_alamat'	=> $post['nama_alamat'],
				'nama_penerima'	=> $post['nama_penerima'],
				'nomor_penerima'=> $post['nomor_penerima'],
				'kecamatan_id'	=> $post['id_kecamatan'],
				'alamat_lengkap'=> $post['alamat_lengkap'],
				'kode_pos'		=> $post['kode_pos']
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'		=> 'Tambah Data Alamat ',
            		'url_form'	=> base_url('users/tambah_alamat'),
            		'alamat'	=> $alamat
            	);

        		$this->template->load('front','users/form_alamat',$data);
            }
            else
            {
				$this->Alamat_model->insert_alamat($alamat, $users['id_user']);
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Tambah Data Alamat Berhasil", "success", "fa fa-check")</script>');
				redirect('users/profile');
            }
		}
		else
		{
			$data = array(
				'title'		=> 'Tambah Data Alamat',
				'url_form'	=> base_url('users/tambah_alamat')
			);

			$this->template->load('front', 'users/form_alamat', $data);
		}
	}

	public function delete_alamat($id)
	{
		$this->Alamat_model->delete_alamat($id);
		$this->session->set_flashdata('alamat_sukses', '<script>notifikasi("Hapus Data Alamat Berhasil", "success", "fa fa-trash")</script>');
		redirect('users/profile');
	}
	public function edit_alamat($id)
	{
		if (isset($_POST['submit'])) 
		{
			$config = array(
				array(
					'field'	=> 'nama_alamat',
					'label' => 'Nama Alamat',
					'rules' => 'required',
				),
				array(
					'field'	=> 'nama_penerima',
					'label' => 'Nama Penerima',
					'rules' => 'required',
				),
				array(
					'field'	=> 'nomor_penerima',
					'label' => 'Nomor HP Penerima',
					'rules' => 'required|numeric',
				),
				array(
					'field'	=> 'id_kecamatan',
					'label' => 'Kecamatan',
					'rules' => 'required',
				),
				array(
					'field'	=> 'alamat_lengkap',
					'label' => 'Alamat Lengkap',
					'rules' => 'required',
				),
				array(
					'field'	=> 'kode_pos',
					'label' => 'Kode Pos',
					'rules' => 'required|numeric',
				)
			);

			$post   = $this->input->post();

			$users  = $this->Users_model->get_by_username($this->session->userdata('username'));

			$alamat = array(
				'nama_alamat'	=> $post['nama_alamat'],
				'nama_penerima'	=> $post['nama_penerima'],
				'nomor_penerima'=> $post['nomor_penerima'],
				'kecamatan_id'	=> $post['id_kecamatan'],
				'alamat_lengkap'=> $post['alamat_lengkap'],
				'kode_pos'		=> $post['kode_pos']
			);

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'		=> 'Edit Data Alamat ',
            		'url_form'	=> base_url('users/edit_alamat/'.$id),
            		'alamat'	=> $alamat
            	);

        		$this->template->load('front','users/form_alamat',$data);
            }
            else
            {
				$this->Alamat_model->update_alamat($id, $alamat);
				$this->session->set_flashdata('alamat_sukses', '<script>notifikasi("Edit Data Alamat Berhasil", "success", "fa fa-check")</script>');
				redirect('users/profile');
            }
		}
		else
		{
			$data = array(
				'title'		=> 'Edit Data Alamat',
				'url_form'	=> base_url('users/edit_alamat/'.$id),
				'alamat'	=> $this->Alamat_model->get_alamat_lengkap($id)
			);

			$this->template->load('front', 'users/form_alamat', $data);
		}
	}

	public function ganti_pass()
	{
		$this->load->model('Auth_model');
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('pass_lama') == '') 
        {
			$data['inputerror'][]   = 'pass_lama';
			$data['error_string'][] = 'Password Lama Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('pass_baru') == '') 
        {
			$data['inputerror'][]   = 'pass_baru';
			$data['error_string'][] = 'Password Baru Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('konfirmasi_pass') == '') 
        {
			$data['inputerror'][]   = 'konfirmasi_pass';
			$data['error_string'][] = 'Password Konfirmasi Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('pass_baru') != $this->input->post('konfirmasi_pass')) 
        {
			$data['inputerror'][]   = 'konfirmasi_pass';
			$data['error_string'][] = 'Password Konfirmasi Tidak Cocok';
            $data['status'] = FALSE;
        }

		if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }

    	$username = $this->session->userdata('username');
        $cekdata  = $this->Auth_model->cekPass($username);
        $pass     = $cekdata['password'];

        $pass_lama       = $this->input->post('pass_lama');
		$pass_baru       = $this->input->post('pass_baru');
		$pass_konfirmasi = $this->input->post('konfirmasi_pass');

		if(password_verify($pass_lama, $pass)) {
			$newHash = $this->Auth_model->makeHash($pass_konfirmasi);
			$upd     = $this->Auth_model->updPass($username,$newHash);
			if($upd == 1) {
				$data['status'] = TRUE;
				$data['ket'] 	= 1;
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['ket'] 	= 0;
				echo json_encode($data);
			}
		} else {
			$data['inputerror'][]   = 'pass_lama';
			$data['error_string'][] = 'Password Lama Salah';
            $data['status'] = FALSE;
            echo json_encode($data);
        	exit();
		}
	}

	public function ajax_logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama_pengguna');
		$this->session->unset_userdata('role');
		$this->session->sess_destroy();
		$data['status'] = TRUE;
		echo json_encode($data);
	}

	public function profile()
	{
		allowed('pelanggan');
		
		$username 	= $this->session->userdata('username');
		$users 		= $this->Users_model->get_by_username($username);
		$alamat		= $this->Alamat_model->get_alamat($username);

		if (isset($_POST['submit'])) 
		{
			$config = array(
				array(
					'field'	=> 'nama_lengkap',
					'label' => 'Nama Lengkap',
					'rules' => 'required',
				)
			);

			$post = $this->input->post();

			$datauser = array(
				'username'		=> $username,
				'email'			=> $post['email'],
				'nama_lengkap'	=> $post['nama_lengkap']
			);

			if($this->session->userdata('email') != $post['email'])
				$this->form_validation->set_rules('email', 'Alamat Email', 'required|is_unique[tb_users.email]');

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'		=> 'Pengaturan Profil ',
            		'users'		=> $datauser,
            		'alamat'	=> $alamat
            	);

        		$this->template->load('front','users/profile',$data);
            }
            else
            {
				$this->Users_model->update($users['username'], $users);
				redirect('users/profile');
            }
		}
		else
		{
			$data = array(
				'title'	=> 'Profil Pengguna',
				'users' => $users,
				'alamat'=> $alamat
			);
			$this->template->load('front', 'users/profile', $data);
		}
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */