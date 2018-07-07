<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->library('form_validation');
  	}

	public function index() 
	{
		redirect(site_url('auth/login'));
	}

	public function login() 
	{

		$cekdata = $this->session->userdata('logged_in');
        if (empty($cekdata)) {
        	if (isset($_POST['submit'])) 
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$cekdata = $this->Auth_model->getLoginData($username);
				if ($cekdata) 
				{

					$hash = $cekdata['password'];
					if (password_verify($password, $hash)) 
					{	
						if ($cekdata['aktif'] == 'Y') 
						{
							$this->session->set_flashdata('login_sukses', '<script>notifikasi("Login Sukses, Selamat Berbelanja !", "success", "fa fa-check")</script>');
							redirect(base_url());
						}
						else
						{
							$this->session->sess_destroy();
							echo "<script>alert('Login Gagal, Akun Anda Belum Diverifikasi');document.location.href='".base_url('auth/login')."';</script>";
						}
					}
					else
					{
						$this->session->sess_destroy();
						echo "<script>alert('Login Gagal, Username / Email / Password Salah');document.location.href='".base_url('auth/login')."';</script>";
					}
				}
				else
				{
					$this->session->sess_destroy();
					echo "<script>alert('Login Gagal, Username / Email / Password Salah');document.location.href='".base_url('auth/login')."';</script>";
				}
			}
			else
			{
				$data = ['title'=>'Login Pengguna'];
            	$this->template->load('front','auth/login',$data);
			}
        	
        } else {
        	echo "<script>document.location.href='".base_url()."';</script>";
        }
	}

	public function register()
	{
		$cekdata = $this->session->userdata('logged_in');
		if (empty($cekdata)) {
            if (isset($_POST['submit'])) 
            {
            	$nama_lengkap 		 = $this->input->post('nama_lengkap');
            	$email 				 = $this->input->post('email');
            	$username	 		 = $this->input->post('username');
            	$password 			 = $this->input->post('password');
            	$password_konfirmasi = $this->input->post('password_konfirmasi');

            	$config = array(
            		array(
            			'field' => 'nama_lengkap',
						'label'	=> 'Nama Lengkap',
						'rules'	=> 'trim|required|min_length[5]|max_length[32]'
            		),
            		array(
            			'field' => 'email',
						'label'	=> 'Email',
						'rules'	=> 'trim|required|valid_email|is_unique[tb_users.email]',
						'errors'=> array(
							'is_unique' => "Email '".$email."' Sudah Digunakan"
						)
            		),
            		array(
            			'field' => 'username',
						'label'	=> 'Username',
						'rules'	=> 'trim|required|min_length[5]|max_length[20]|is_unique[tb_users.username]',
						'errors'=> array(
							'is_unique' => "Username '".$username."' Sudah Digunakan"
						)
            		),
            		array(
						'field' => 'password',
						'label'	=> 'Password',
						'rules'	=> 'trim|required|min_length[5]|max_length[32]'
					),
					array(
						'field' => 'password_konfirmasi',
						'label'	=> 'Password Konfirmasi',
						'rules'	=> 'trim|required|matches[password]'
					),
            	);
            	$this->form_validation->set_rules($config);
            	$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
            	if ($this->form_validation->run() == FALSE)
	            {
	            	$data = ['title'=>'Pendaftaran Pengguna'];
            		$this->template->load('front','auth/register',$data);
	            }
	            else
	            {
	            	$data = array(
	            		'nama_lengkap'	=> $nama_lengkap,
	            		'email'			=> $email,
	            		'username'		=> $username,
	            		'password'		=> $this->Auth_model->makeHash($password),
	            		'aktif'			=> 'N',
	            		'role'			=> 'pelanggan'
	            	);

	            	// Tambahkan Akun Ke Database
	            	$id = $this->Auth_model->add_account($data);

	            	$this->session->set_flashdata('notifikasi', '<script>notifikasi("Pendaftaran Sukses Silahkan Login", "success", "fa fa-check")</script>');
	            	redirect('auth/login');
	            	
	       //      	//enkripsi id
	       //      	$encrypted_id = md5($id);

	       //      	$this->load->library('email');
				    // $config 				= array();
				    // $config['charset'] 		= 'utf-8';
				    // $config['useragent'] 	= 'Codeigniter';
				    // $config['protocol']		= "smtp";
				    // $config['mailtype']		= "html";
				    // $config['smtp_host']	= "smtp.gmail.com";//pengaturan smtp
				    // $config['smtp_port']	= "465";
				    // $config['smtp_timeout']	= "400";
				    // $config['smtp_user']	= "mathin2104@gmail.com"; // isi dengan email kamu
				    // $config['smtp_pass']	= "backtrack"; // isi dengan password kamu
				    // $config['crlf']			="\r\n"; 
				    // $config['newline']		="\r\n"; 
				    // $config['wordwrap'] 	= TRUE;
				    // //memanggil library email dan set konfigurasi untuk pengiriman email
				   
				    // $this->email->initialize($config);

				    // //konfigurasi pengiriman
				    // $this->email->from($config['smtp_user'], 'CodesQuery');
				    // $this->email->to($email);
				    // $this->email->subject("Verifikasi Akun Jastip");
				    // $this->email->message(
				    //  "terimakasih telah melakuan registrasi, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>".
				    //   site_url("auth/verifikasi_akun/$encrypted_id")
				    // );
				  
				    // if($this->email->send())
				    // {
				    // 	$data = [
				    //    		'title'		=> 'Pendaftaran Pengguna Berhasil',
				    //    		'response'	=> 'Berhasil melakukan registrasi, silahkan cek email kamu',
				    //    		'debug'		=> $this->email->print_debugger()
				    //    	];
        //     			$this->template->load('front','auth/register_response',$data);
				    // }
				    // else
				    // {
				    //    	$data = [
				    //    		'title'		=> 'Pendaftaran Pengguna Berhasil',
				    //    		'response'	=> 'Berhasil Melakukan Registrasi, Namun Gagal Mengirimkan Email Verifikasi, Silahkan tunggu akun anda di verifikasi manual oleh admin !',
				    //    		'debug'		=> $this->email->print_debugger()
				    //    	];
        //     			$this->template->load('front','auth/register_response',$data);
				    // }

	            }
            }
            else
            {
            	$data = ['title'=>'Pendaftaran Pengguna'];
            	$this->template->load('front','auth/register',$data);
            }
        } else {
        	echo "<script>alert('anda sudah login');document.location.href='".base_url()."';</script>";
        }
	}

	public function username_exists($key)
	{
		$this->Auth_model->is_exists('username', $key);
	}

	public function email_exists($key)
	{
		$this->Auth_model->is_exists('email', $key);
	}

	

	public function logout() {
		$this->session->sess_destroy();
    	redirect(site_url('auth/login'));
	}

	public function update_pass()
	{
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('password_lama') == '') 
        {
			$data['inputerror'][]   = 'password_lama';
			$data['error_string'][] = 'Password Lama Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password_baru') == '') 
        {
			$data['inputerror'][]   = 'password_baru';
			$data['error_string'][] = 'Password Baru Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password_konfirmasi') == '') 
        {
			$data['inputerror'][]   = 'password_konfirmasi';
			$data['error_string'][] = 'Password Konfirmasi Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password_baru') != $this->input->post('password_konfirmasi')) 
        {
			$data['inputerror'][]   = 'password_konfirmasi';
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

        $pass_lama       = $this->input->post('password_lama');
		$pass_baru       = $this->input->post('password_baru');
		$pass_konfirmasi = $this->input->post('password_konfirmasi');
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
			$data['inputerror'][]   = 'password_lama';
			$data['error_string'][] = 'Password Lama Salah';
            $data['status'] = FALSE;
            echo json_encode($data);
        	exit();
		}
	}

	public function ajax_logout() {
		$this->session->sess_destroy();
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama_pengguna');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
		$data['status'] = TRUE;
		echo json_encode($data);
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
