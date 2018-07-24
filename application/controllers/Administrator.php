<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Auth_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->model('Produk_model', 'produk');
		$this->load->model('Users_model', 'users');
		$this->load->model('Pemesanan_model', 'order');

		$cekdata = $this->session->userdata('logged_in');
		if (empty($cekdata)) 
		{
            echo "<script>document.location.href='".base_url('administrator/login')."';</script>";
        }
        else
        {
        	if ($this->session->userdata('role') == "administrator")
        	{
        		$data = [
					'title' 			=> 'JasTip Administrator - Home',
					'count_produk'		=> $this->produk->count_all(),
					'count_pelanggan'	=> $this->users->count_all('pelanggan'),
					'total_order' 		=> $this->order->total_pemesanan(),
					'order_baru'		=> $this->order->total_pemesanan_baru()

				];
				$this->template->load('back','admin/home', $data);
        	}
        	else
        	{
        		$this->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Tidak Memiliki Hak Akses Untuk Halaman Admin", "danger", "fa fa-exclamation")</script>');
        		redirect(base_url());
        	}
        }
				
	}


// Start Ongkos Kirim
// =================================================================================================
	
	public function ongkir()
	{
		allowed('administrator');

		$data = array(
			'title'			=> 'Pengaturan Biaya Kirim',
		);

		$this->template->load('back', 'admin/ongkir/view', $data);
	}

	public function tambah_ongkir()
	{
		allowed('administrator');
		$this->load->model('Ongkir_model', 'ongkir');

		if (isset($_POST['submit'])) 
		{
			// Config Validasi
            $config = array(
				array(
					'field' => 'id_kecamatan',
					'label'	=> 'Kecamatan',
					'rules'	=> 'required|is_unique[tb_ongkir.kecamatan_id]'
				),
				array(
					'field' => 'biaya',
					'label'	=> 'Biaya Kirim',
					'rules'	=> 'required|numeric'
				)
			);

            $post = $this->input->post();
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
					'title'			=> 'Tambah Biaya Kirim',
					'form_post_url'	=> base_url() . 'administrator/tambah_ongkir',
					'ongkir'		=> $post
				);

				$this->template->load('back', 'admin/ongkir/form', $data);
            }
            else
            {
            	$data = array(
            		'kecamatan_id' 	=> $post['id_kecamatan'],
            		'biaya'			=> $post['biaya']
            	);

            	$this->ongkir->insert($data);
            	$this->session->set_flashdata('notifikasi', '<script>
					notifikasi(
					  "Ongkir Berhasil Di Input!",
					  "success",
					  "fa fa-check"
					)
        		</script>');

        		redirect('administrator/ongkir');
            }
		}
		else
		{
			$data = array(
				'title'			=> 'Tambah Biaya Kirim',
				'form_post_url'	=> base_url() . 'administrator/tambah_ongkir'
			);

			$this->template->load('back', 'admin/ongkir/form', $data);
		}
	}

	public function delete_ongkir($id)
	{
		allowed('administrator');
		$this->load->model('Ongkir_model', 'ongkir');
		$this->ongkir->delete($id);
		$this->session->set_flashdata('notifikasi', '<script>
			notifikasi(
			  "Ongkir Berhasil Di Hapus!",
			  "success",
			  "fa fa-check"
			)
		</script>');

		redirect('administrator/ongkir');
	}

	public function edit_ongkir()
	{
		allowed('administrator');
		$this->load->model('Ongkir_model', 'ongkir');

		$id = $this->uri->segment(3);
		$ongkir = $this->ongkir->get_by_id($id);
		$bycek = $this->ongkir->get_by_kecamatanid($id);

		if (isset($_POST['submit'])) 
		{
			// Config Validasi
            $config = array(
				array(
					'field' => 'biaya',
					'label'	=> 'Biaya Kirim',
					'rules'	=> 'required|numeric'
				)
			);

            $post = $this->input->post();

			$this->form_validation->set_rules($config);
			
			if ($ongkir['kecamatan_id'] != $post['id_kecamatan']) {
				$this->form_validation->set_rules('kecamatan_id', 'Kecamatan', 'required|is_unique[tb_ongkir.kecamatan_id]');
			}
			
			if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
					'title'			=> 'Edit Biaya Kirim',
					'form_post_url'	=> base_url() . 'administrator/edit_ongkir/'.$id,
					'ongkir'		=> $post
				);

				$this->template->load('back', 'admin/ongkir/form', $data);
            }
            else
            {
            	$data = array(
            		'kecamatan_id' 	=> $post['id_kecamatan'],
            		'biaya'			=> $post['biaya']
            	);

            	$this->ongkir->update($id, $data);
                $this->session->set_flashdata('notifikasi', '<script>
						notifikasi(
						  "Ongkir Berhasil Di Update!",
						  "success",
						  "fa fa-check"
						)
            		</script>');

            		redirect('administrator/ongkir');
            }
		}
		else
		{
			$data = array(
				'title'			=> 'Edit Biaya Kirim',
				'ongkir'		=> $ongkir,
				'form_post_url'	=> base_url() . 'administrator/edit_ongkir/'.$id
			);

			$this->template->load('back', 'admin/ongkir/form', $data);
		}
	}

// End Ongkos Kirim
// =================================================================================================


// Start Konfigurasi Toko
// =================================================================================================
	public function konfigurasi_toko()
	{
		allowed('administrator');
		$this->load->model('Indentitas_model', 'identitas');
		$this->load->model('Alamat_model', 'alamat');
		if (isset($_POST['submit'])) 
		{
			$config['upload_path'] = './assets/front/images/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '20000'; // kb
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('favicon'))
            {
            	$hasil1=$this->upload->data();
            }
            if($this->upload->do_upload('logo'))
            {
            	$hasil2=$this->upload->data();
            }
            
            
            // Config Validasi
            $config = array(
				array(
					'field' => 'nama_website',
					'label'	=> 'Nama Website',
					'rules'	=> 'required'
				),
				array(
					'field' => 'email',
					'label'	=> 'Alamat Email',
					'rules'	=> 'required|valid_email'
				),
				array(
					'field' => 'no_telp',
					'label'	=> 'Nomor Telepon',
					'rules'	=> 'required|numeric'
				),
				array(
					'field' => 'id_kabupaten',
					'label'	=> 'Kota / Kabupaten',
					'rules'	=> 'required'
				),
				array(
					'field' => 'alamat',
					'label'	=> 'Alamat Toko',
					'rules'	=> 'required'
				),
			);

            $this->form_validation->set_rules($config);

		    if ($this->form_validation->run() == FALSE)
            {
            	$identitas = $this->identitas->get_one(1);
				$provinsi = $this->db->query('SELECT * FROM provinsi, kabupaten WHERE kabupaten.provinsi_id = provinsi.id_provinsi AND id_kabupaten = '.$identitas['kabupaten_id'])->row_array();

				$data = array(
					'title'			=> 'Konfigurasi Toko',
					'provinsi'		=> $this->alamat->get_provinsi(),
					'identitas'		=> $identitas,
					'id_provinsi'	=> $provinsi['id_provinsi']
				);
        		$this->template->load('back','admin/konfigurasi_toko',$data);
            }
            else
            {
            	if ($hasil1['file_name']=='' && $hasil2['file_name']=='')
	            {
			        $data = array('nama_website'		=> $this->input->post('nama_website'),
			        			  'email'				=> $this->input->post('email'),
			        			  'facebook'			=> $this->input->post('facebook'),
			        			  'no_telp'				=> $this->input->post('no_telp'),
			        			  'kabupaten_id'		=> $this->input->post('id_kabupaten'),
			        			  'alamat'				=> $this->input->post('alamat')
			        			);
			    }
			    else if ($hasil1['file_name']!='' && $hasil2['file_name']=='')
			    {
			    	$data = array('nama_website'		=> $this->input->post('nama_website'),
			        			  'email'				=> $this->input->post('email'),
			        			  'facebook'			=> $this->input->post('facebook'),
			        			  'no_telp'				=> $this->input->post('no_telp'),
			        			  'kabupaten_id'		=> $this->input->post('id_kabupaten'),
			        			  'alamat'				=> $this->input->post('alamat'),
			        			  'favicon'				=> $hasil1['file_name'],
			        			);
			    }
			    else if ($hasil1['file_name']=='' && $hasil2['file_name']!='')
			    {
			    	$data = array('nama_website'		=> $this->input->post('nama_website'),
			        			  'email'				=> $this->input->post('email'),
			        			  'facebook'			=> $this->input->post('facebook'),
			        			  'no_telp'				=> $this->input->post('no_telp'),
			        			  'kabupaten_id'		=> $this->input->post('id_kabupaten'),
			        			  'alamat'				=> $this->input->post('alamat'),
			        			  'logo'				=> $hasil2['file_name'],
			        			);
			    }
			    else
			    {
			    	$data = array('nama_website'		=> $this->input->post('nama_website'),
			        			  'email'				=> $this->input->post('email'),
			        			  'facebook'			=> $this->input->post('facebook'),
			        			  'no_telp'				=> $this->input->post('no_telp'),
			        			  'kabupaten_id'		=> $this->input->post('id_kabupaten'),
			        			  'alamat'				=> $this->input->post('alamat'),
			        			  'favicon'				=> $hasil1['file_name'],
			        			  'logo'				=> $hasil2['file_name'],
			        			);
			    }


				$this->identitas->update(1, $data);
				$this->session->set_flashdata('notifikasi', '<script>
                         notifikasi("Indentitas Toko Berhasil Di Update", "success", "fa fa-check");
					</script>');
				redirect('administrator/konfigurasi_toko');
            }
		}
		else
		{
			$identitas = $this->identitas->get_one(1);
			$provinsi = $this->db->query('SELECT * FROM provinsi, kabupaten WHERE kabupaten.provinsi_id = provinsi.id_provinsi AND id_kabupaten = '.$identitas['kabupaten_id'])->row_array();
			$data = array(
				'title'			=> 'Konfigurasi Toko',
				'provinsi'		=> $this->alamat->get_provinsi(),
				'identitas'		=> $identitas,
				'id_provinsi'	=> $provinsi['id_provinsi']
			);

			$this->template->load('back', 'admin/konfigurasi_toko', $data);
		}
	}

// End Konfigurasi Toko
// =================================================================================================
// 

// Start Rekening Toko
// =================================================================================================	

	public function rekening()
	{
		$this->load->model('Rekening_model', 'rekening');
		$data = array(
			'title' 	=> 'Pengaturan Slider',
			'rekening'	=> $this->rekening->get_all()
		);
		$this->template->load('back', 'admin/rekening/view', $data);
	}

	public function tambah_rekening()
	{
		$this->load->model('Rekening_model', 'rekening');

		if (isset($_POST['submit'])) 
		{
			$config = array(
		    	array(
        			'field' => 'nama_bank',
					'label'	=> 'Nama Bank',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'atas_nama',
					'label'	=> 'Nama',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'cabang',
					'label'	=> 'Cabang bank',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'no_rekening',
					'label'	=> 'Nomor Rekening',
					'rules'	=> 'required|numeric'
        		)
		    );

		    $post = $this->input->post();

		    $this->form_validation->set_rules($config);

		    if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'			=> 'Tambah Rekening Bank',
            		'form_url'		=> base_url('administrator/tambah_rekening'),
            		'row'			=> $post
            	);

        		$this->template->load('back','admin/rekening/form',$data);
            }
            else
            {
            	$data = array(
            		'nama_bank'		=> $post['nama_bank'],
            		'cabang'		=> $post['cabang'],
            		'atas_nama'		=> $post['atas_nama'],
            		'no_rekening'	=> $post['no_rekening'],
            	);

            	$this->rekening->insert($data);
            	$this->session->set_flashdata('notifikasi', '<script>
            		notifikasi("Rekening Berhasil Ditambahkan", "success", "fa fa-check")</script>');
            	redirect('administrator/rekening');
            }
		}
		else
		{
			$cek = $this->rekening->get_all();
			if (count($cek)>3) 
			{
				$this->session->set_flashdata('notifikasi', '<script>
                      notifikasi("Maksimal Hanya 4 Rekening", "danger", "fa fa-exclamation")
					</script>');
				redirect('administrator/rekening');
			}
			else
			{
				$data = array(
					'title'		=> 'Tambah Rekening Bank',
					'form_url'	=> base_url('administrator/tambah_rekening')
				);

				$this->template->load('back', 'admin/rekening/form', $data);
			}
		}
	}

	public function edit_rekening($id)
	{
		$this->load->model('Rekening_model', 'rekening');
		$rek = $this->rekening->get_one($id);

		if (isset($_POST['submit'])) 
		{
			$config = array(
		    	array(
        			'field' => 'nama_bank',
					'label'	=> 'Nama Bank',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'atas_nama',
					'label'	=> 'Nama',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'cabang',
					'label'	=> 'Cabang bank',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'no_rekening',
					'label'	=> 'Nomor Rekening',
					'rules'	=> 'required|numeric'
        		)
		    );

		    $post = $this->input->post();

		    $this->form_validation->set_rules($config);

		    if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'			=> 'Edit Rekening Bank',
            		'form_url'		=> base_url('administrator/edit_rekening/'.$id),
            		'row'			=> $post
            	);

        		$this->template->load('back','admin/rekening/form',$data);
            }
            else
            {
            	$data = array(
            		'nama_bank'		=> $post['nama_bank'],
            		'cabang'		=> $post['cabang'],
            		'atas_nama'		=> $post['atas_nama'],
            		'no_rekening'	=> $post['no_rekening'],
            	);

            	$this->rekening->update($id,$data);
            	$this->session->set_flashdata('notifikasi', '<script>
            		notifikasi("Rekening Berhasil Diubah", "success", "fa fa-check")</script>');
            	redirect('administrator/rekening');
            }
		}
		else
		{
			$data = array(
				'title'		=> 'Edit Rekening Bank',
				'form_url'	=> base_url('administrator/edit_rekening/'.$id),
				'row'		=> $rek
			);

			$this->template->load('back', 'admin/rekening/form', $data);
		}
	}

	public function delete_rekening($id)
	{
		$this->load->model('Rekening_model', 'rekening');
		$this->rekening->delete($id);
		$this->session->set_flashdata('notifikasi', '<script>
           notifikasi("Rekening Berhasil Dihapus", "success", "fa fa-check")</script>');
		redirect('administrator/rekening');
	}

// End Rekening Toko
// =================================================================================================


// Start Gambar Slider
// =================================================================================================

	public function gambar_slider()
	{
		$this->load->model('Slider_model', 'slider');
		$data = array(
			'title' 	=> 'Pengaturan Slider',
			'slider'	=> $this->slider->get_all()
		);
		$this->template->load('back', 'admin/slider/view', $data);
	}

	public function tambah_gambar_slider()
	{
		allowed('administrator');
		$cek = $this->db->get('slider')->num_rows();
		$this->load->model('Slider_model', 'slider');
		$url_action = base_url('administrator/tambah_gambar_slider'); 
		if ($cek < 5) 
		{
			if (isset($_POST['submit'])){
				$config['upload_path'] = './assets/front/images/slider/';
	            $config['allowed_types'] = 'jpg|png|jpeg';
	            $config['max_size'] = '20000'; // kb
	            $config['overwrite'] = TRUE;
	            $this->load->library('upload', $config);
	            $this->upload->do_upload('gambar');
	            $hasil=$this->upload->data();
	            $config = array(
			    	array(
	        			'field' => 'judul',
						'label'	=> 'Judul Slider',
						'rules'	=> 'required'
	        		),
	        		array(
	        			'field' => 'caption',
						'label'	=> 'Caption Slider',
						'rules'	=> 'required'
	        		),
	        		array(
	        			'field' => 'url',
						'label'	=> 'URL Slider',
						'rules'	=> 'required'
	        		)
			    );

	            $post = $this->input->post();

			    $this->form_validation->set_rules($config);
			    if ($this->form_validation->run() == FALSE)
	            {
	            	$data = array(
	            		'title'		=> 'Tambah Gambar Slider',
	            		'slider'	=> $post,
	            		'url_action'=> $url_action
	            	);
	        		$this->template->load('back','admin/slider/form',$data);
	            }
	            else
	            {
	            	if ($hasil['file_name']!='')
		            {
				        $dataslider = array(
				        			  'judul'				=> $post['judul'],
				        			  'caption'				=> $post['caption'],
				        			  'url'					=> $post['url'],
				        			  'gambar'				=> $hasil['file_name']
				        			);
				        $this->slider->insert($dataslider);
				        $this->session->set_flashdata('notifikasi', 'notifikasi("input slider berhasil", "success", "fa fa-check")');
						redirect('administrator/gambar_slider');
				    }
				    else
				    {
				    	$this->session->set_flashdata('notifikasi', 'notifikasi("Gambar Slider Tidak Boleh Kosong", "danger", "fa fa-exclamation")');
				    	$data = array(
		            		'title'		=> 'Tambah Gambar Slider',
		            		'url_action'=> $url_action,
		            		'slider'	=> $post
		            	);
		        		$this->template->load('back','admin/slider/form',$data);
				    }
	            }
	        }
			else
			{
				$data = array(
					'title' 	=> 'Tambah Slider',
	            	'url_action'=> $url_action
				);

				$this->template->load('back', 'admin/slider/form', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('notifikasi', 'notifikasi("Hanya Bisa Input 5 Slider!", "danger", "fa fa-exclamation")');
			redirect('administrator/gambar_slider');
		}
	}


	public function edit_gambar_slider()
	{
		$id = $this->uri->segment(3);
		if ($id) 
		{
			allowed('administrator');
			$this->load->model('Slider_model', 'slider');
			$url_action = base_url('administrator/edit_gambar_slider/'.$id);

			if (isset($_POST['submit'])) 
			{
				$config['upload_path'] = './assets/front/images/slider/';
	            $config['allowed_types'] = 'jpg|png|jpeg';
	            $config['max_size'] = '20000'; // kb
	            $config['overwrite'] = TRUE;
	            $this->load->library('upload', $config);
	            $this->upload->do_upload('gambar');
	            $hasil=$this->upload->data();
	            
	            $config = array(
			    	array(
	        			'field' => 'judul',
						'label'	=> 'Judul Slider',
						'rules'	=> 'required'
	        		),
	        		array(
	        			'field' => 'caption',
						'label'	=> 'Caption Slider',
						'rules'	=> 'required'
	        		),
	        		array(
	        			'field' => 'url',
						'label'	=> 'URL Slider',
						'rules'	=> 'required'
	        		)
			    );

	            $post = $this->input->post();
			    $this->form_validation->set_rules($config);

			    if ($this->form_validation->run() == FALSE)
	            {
	            	$data = array(
	            		'title'		=> 'Edit Gambar Slider',
	            		'slider'	=> $post,
	            		'url_action'=> $url_action
	            	);
	        		$this->template->load('back','admin/slider/form',$data);
	            }
	            else
	            {
	            	if ($hasil['file_name']!='')
		            {
				        $dataslider = array(
				        			  'judul'				=> $post['judul'],
				        			  'caption'				=> $post['caption'],
				        			  'url'					=> $post['url'],
				        			  'gambar'				=> $hasil['file_name']
				        			);
				    }
				    else
				    {
				    	$dataslider = array(
				        			  'judul'				=> $post['judul'],
				        			  'caption'				=> $post['caption'],
				        			  'url'					=> $post['url'],
				        			);
				        
				    }

				    $this->slider->update($id,$dataslider);
			    	$this->session->set_flashdata('notifikasi', '<script>notifikasi("Berhasil Ubah Slider!", "success", "fa fa-check")</script>');
					redirect('administrator/gambar_slider');
	            }
			}
			else
			{
				$slider = $this->slider->get_one($id);
				$data = array(
					'title'		=> 'Edit Data Slider',
					'slider'	=> $slider,
					'url_action'=> $url_action
				);

				$this->template->load('back', 'admin/slider/form', $data);
			}
		}
		else
		{
			redirect('administrator/gambar_slider');
		}
			
	}

	public function delete_gambar_slider($id)
	{
		allowed('administrator');
		$this->load->model('Slider_model', 'slider');

		if ($id) 
		{
			$cek = $this->db->get('slider')->num_rows();
			if ($cek == 1) 
			{
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Tidak Dapat Menghapus Slider Jika Sisa Slider Hanya 1", "danger", "fa fa-exclamation")</script>');
				redirect('administrator/gambar_slider');
			}
			else
			{
				$this->slider->delete($id);
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Slider telah di hapus!", "success", "fa fa-check")</script>');
				redirect('administrator/gambar_slider');
			}
		}
		else
		{
			redirect('administrator/gambar_slider');
		}
			
	}

// End Gambar Slider
// =================================================================================================


// Start Kategori Produk
// =================================================================================================

	public function kategori_produk()
	{
		allowed('administrator');
		$this->load->model('Kategori_model', 'kategori');
		$data = array(
			'title'		=> 'Daftar Kategori Produk',
			'record'	=> $this->kategori->get_all()
		);

		$this->template->load('back','admin/kategori_produk/view_kategori',$data);
	}

	public function tambah_kategori_produk()
	{
		allowed('administrator');
		$this->load->model('Kategori_model', 'kategori');

		if (isset($_POST['submit'])) 
		{
			$data = array(
				'nama_kategori' => $this->input->post('nama_kategori') 
			);

			$insert = $this->kategori->insert($data);

			$this->session->set_flashdata('notifikasi', '<script>notifikasi("Kategori Telah Ditambahkan", "success", "fa fa-check")</script>');
			redirect('administrator/kategori_produk');
		}
		else
		{
			$data['title'] = 'Tambah Kategori Produk';
			$this->template->load('back', 'admin/kategori_produk/tambah_kategori', $data);
		}
	}

	public function delete_kategori_produk()
	{
		allowed('administrator');
		$this->load->model('Kategori_model', 'kategori');
		$this->load->model('Produk_model', 'produk');
		$id = $this->uri->segment(3);
		$cek = $this->produk->is_kategori_exist($id);
		if ($cek == FALSE) 
		{
			$this->kategori->delete($id);
			$this->session->set_flashdata('notifikasi', '<script>notifikasi("Kategori Telah Dihapus", "success", "fa fa-check")</script>');
			redirect('administrator/kategori_produk');
		}
		else 
		{
			$this->session->set_flashdata('notifikasi', '<script>notifikasi("Kategori Gagal Dihapus Karena Ada Produk yang menggunakan kategori ini", "danger", "fa fa-exclamation")</script>');
			redirect('administrator/kategori_produk');
		}
	}

// End Kategori Produk
// =================================================================================================


// Start Produk
// =================================================================================================

	public function produk()
	{
		allowed('administrator');
		
        $data = array(
            'title'         => 'Daftar Produk',
        );
        $this->template->load('back','admin/produk/view', $data);
	}

	public function tambah_produk()
	{
		allowed('administrator');
		$this->load->model('Produk_model', 'produk');

		$url_action = base_url('administrator/tambah_produk');
		if (isset($_POST['submit']))
		{
			$config['upload_path'] = './assets/foto_produk/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '20000'; // kb
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            $hasil1 = ['file_name'=>''];
            $hasil2 = ['file_name'=>''];
            $hasil3 = ['file_name'=>''];

            if ($this->upload->do_upload('gambar_1')) 
            	$hasil1=$this->upload->data();
            if ($this->upload->do_upload('gambar_2')) 
            	$hasil2=$this->upload->data();
            if ($this->upload->do_upload('gambar_3')) 
            	$hasil3=$this->upload->data();

            $config = array(
        		array(
        			'field' => 'kategori_id',
					'label'	=> 'Kategori Produk',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'nama_produk',
					'label'	=> 'Nama Produk',
					'rules'	=> 'required'
        		),	
        		array(
        			'field' => 'kode_produk',
					'label'	=> 'Kode Produk',
					'rules'	=> 'required|is_unique[tb_produk.kode_produk]'
        		),
        		array(
        			'field' => 'harga',
					'label'	=> 'Harga Produk',
					'rules'	=> 'required|numeric|greater_than[100]'
        		),
        		array(
        			'field' => 'fee',
					'label'	=> 'Biaya Jasa',
					'rules'	=> 'required|numeric|greater_than[100]'
        		),
        		array(
        			'field' => 'berat',
					'label'	=> 'Berat',
					'rules'	=> 'required|numeric'
        		)
		    );

            $post = $this->input->post();

		    $this->form_validation->set_rules($config);

		    if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'		=> 'Tambah Data Produk',
            		'produk'	=> $post,
            		'url_action' => $url_action
            	);
        		$this->template->load('back','admin/produk/form',$data);
            }
            else
            {
            	$data = array(
            		'kategori_id'		=> $post['kategori_id'],
            		'kode_produk'		=> $post['kode_produk'],
            		'nama_produk'		=> $post['nama_produk'],
            		'harga'				=> $post['harga'],
            		'fee_jastip'		=> $post['fee'],
            		'berat'				=> $post['berat'],
            		'deskripsi'			=> $post['deskripsi'],
            	);

			    if ($hasil1['file_name'] == '') 
			    	$data += ['gambar_1' => 'no_image.jpg'];
			    else
			    	$data += ['gambar_1' => $hasil1['file_name']];

			    if ($hasil2['file_name'] == '') 
			    	$data += ['gambar_2' => 'no_image.jpg'];
			    else
			    	$data += ['gambar_2' => $hasil2['file_name']];

			    if ($hasil3['file_name'] == '') 
			    	$data += ['gambar_3' => 'no_image.jpg'];
			    else
			    	$data += ['gambar_3' => $hasil3['file_name']];

			    $this->produk->insert($data);
			    $this->session->set_flashdata('notifikasi', '<script>
						notifikasi("Produk Berhasil Ditambahkan", "success", "fa fa-check");
			    	</script>');
				redirect('administrator/produk');
            }
		}
		else
		{
			$data = array(
				'title'		=> 'Tambah Data Produk',
				'url_action' => $url_action
			);
			$this->template->load('back','admin/produk/form',$data);
		}
	}

	public function edit_produk()
	{
		allowed('administrator');
		$this->load->model('Produk_model', 'produk');
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
	        
	        $config['upload_path'] = './assets/foto_produk/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '20000'; // kb
            $config['overwrite'] = TRUE;

	        $this->load->library('upload', $config);

            $hasil1 = ['file_name'=>''];
            $hasil2 = ['file_name'=>''];
            $hasil3 = ['file_name'=>''];

            if ($this->upload->do_upload('gambar_1')) 
            	$hasil1=$this->upload->data();
            if ($this->upload->do_upload('gambar_2')) 
            	$hasil2=$this->upload->data();
            if ($this->upload->do_upload('gambar_3')) 
            	$hasil3=$this->upload->data();

            $prod = $this->produk->get_by_id($id);

            $config = array(
        		array(
        			'field' => 'kategori_id',
					'label'	=> 'Kategori Produk',
					'rules'	=> 'required'
        		),
        		array(
        			'field' => 'nama_produk',
					'label'	=> 'Nama Produk',
					'rules'	=> 'required'
        		),	
        		array(
        			'field' => 'harga',
					'label'	=> 'Harga Produk',
					'rules'	=> 'required|numeric|greater_than[100]'
        		),
        		array(
        			'field' => 'fee',
					'label'	=> 'Biaya Jasa',
					'rules'	=> 'required|numeric|greater_than[100]'
        		),
        		array(
        			'field' => 'berat',
					'label'	=> 'Berat',
					'rules'	=> 'required|numeric'
        		)
		    );

		    $post = $this->input->post();

		    if ($post['kode_produk'] != $prod['kode_produk']) {

		    	$this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required|is_unique[tb_produk.kode_produk]');
		    }

		    $this->form_validation->set_rules($config);

		    if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'		=> 'Edit Data Produk ',
            		'produk'	=> $post,
            		'url_action'=> site_url('administrator/edit_produk/'.$id)
            	);

        		$data['produk'] = $this->produk->get_by_id($id);

        		$this->template->load('back','admin/produk/form',$data);
            }
            else
            {
            	$data = array(
            		'kategori_id'		=> $post['kategori_id'],
            		'kode_produk'		=> $post['kode_produk'],
            		'nama_produk'		=> $post['nama_produk'],
            		'harga'				=> $post['harga'],
            		'fee_jastip'		=> $post['fee'],
            		'berat'				=> $post['berat'],
            		'deskripsi'			=> $post['deskripsi'],
            	);

			    if ($hasil1['file_name'] != '') 
			    	$data += ['gambar_1' => $hasil1['file_name']];

			    if ($hasil2['file_name'] != '') 
			    	$data += ['gambar_2' => $hasil2['file_name']];

			    if ($hasil3['file_name'] != '') 
			    	$data += ['gambar_3' => $hasil3['file_name']];

				$this->produk->update($id, $data);
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Produk Berhasil Diubah", "success", "fa fa-check")</script>');
				redirect('administrator/produk');
            }
	            
		}
		else
		{
			$prod = $this->produk->get_by_id($id);
			$data = array(
				'title'		=> 'Edit Data Produk ',
				'produk'	=> $prod,
				'url_action'=> site_url('administrator/edit_produk/'.$id)
			);

			$this->template->load('back','admin/produk/form',$data);
		}
	}

	public function delete_produk($id)
	{
		allowed('administrator');
		$this->load->model('Produk_model', 'produk');
		$this->produk->delete($id);
		$this->session->set_flashdata('notifikasi', '<script>notifikasi("Produk Berhasil Dihapus", "success", "fa fa-check")</script>');
		redirect('administrator/produk');
	}

// Pemesanan
// =================================================================================================

	public function order_masuk()
	{
		allowed('administrator');
        $data = array(
            'title'         => 'Pesanan Masuk Terbaru',
            'url_json'		=> site_url('ajax/json_order_baru')
        );
        
        $this->template->load('back','admin/order/view', $data);
		
	}

	public function data_order()
	{
		allowed('administrator');
        $data = array(
            'title'         => 'Data Semua Pemesanan',
            'url_json'		=> site_url('ajax/json_all_order')
        );
        
        $this->template->load('back','admin/order/view', $data);
		
	}

	public function cek_pembayaran()
	{
		allowed('administrator');
		$this->load->model('Model_app', 'crud');
		$kode_transaksi = $this->uri->segment(3);

		$databayar = $this->crud->view_where('tb_konfirmasi_transfer', array('kode_transaksi'=>$kode_transaksi))->result();

		$data = array(
			'title'		=> 'Data Pembayaran Invoice : ' . $kode_transaksi,
			'pembayaran'=>	$databayar
		);

		$this->template->load('back','admin/order/pembayaran', $data);
	}

	public function konfirmasi_pembayaran()
	{
		allowed('administrator');
		$this->load->model('Pemesanan_model', 'order');
		$kode_transaksi = $this->uri->segment(3);
		$this->order->konfirmasi($kode_transaksi);
		$this->session->set_flashdata('notifikasi', '<script>notifikasi("Pesanan Berhasil Dikonfirmasi", "success", "fa fa-check")</script>');
		redirect('administrator/data_order');
	}

	public function konfirmasi_kirim()
	{
		allowed('administrator');
		if ($this->uri->segment(3) != '') 
		{
			$id_pemesanan = $this->uri->segment(3);
			$this->load->model('Pemesanan_model', 'order');
			$this->load->model('Pengiriman_model', 'kirim');
			$pemesanan = $this->order->get_pemesanan_one($id_pemesanan);
			if (isset($_POST['submit'])) 
			{
				$config = array(
	        		array(
	        			'field' => 'nama_kurir',
						'label'	=> 'Nama Kurir',
						'rules'	=> 'required'
	        		),
	        		array(
	        			'field' => 'nomor_kurir',
						'label'	=> 'Nomor Kurir',
						'rules'	=> 'required|numeric|min_length[11]'
	        		)
			    );

				$post = $this->input->post();

			    $this->form_validation->set_rules($config);

			    if ($this->form_validation->run() == FALSE)
	            {
	            	$data = array(
	            		'title'		=> 'Konfirmasi Kirim ',
	            		'order'		=> $post
	            	);

	        		$this->template->load('back','admin/pengiriman/konfirmasi',$data);
	            }
	            else
	            {
	            	$data = array(
	            		'nama_kurir'		=> $post['nama_kurir'],
	            		'nomor_kurir'		=> $post['nomor_kurir'],
	            		'pemesanan_id'		=> $this->uri->segment(3)
	            	);

					$kirim = $this->kirim->insert($data);
					
					if ($kirim) 
					{
						$this->order->konfirmasi_kirim($id_pemesanan);
						$this->session->set_flashdata('notifikasi', '<script>notifikasi("Data Pengiriman Telah Di Input", "success", "fa fa-check")</script>');
						redirect('administrator/data_order');
					}
					else
					{
						$this->session->set_flashdata('notifikasi', '<script>notifikasi("Terjadi Kesalahan", "danger", "fa fa-exclamation")</script>');
						redirect('administrator/data_order');
					}
					
						
	            }
			}
			else
			{
				$data['title'] 	= 'Konfirmasi Pengiriman';
				$data['order']	= $pemesanan;
				$this->template->load('back', 'admin/pengiriman/konfirmasi', $data);
			}
		}
		else
		{
			redirect('administrator','refresh');
		}
	}


// =================================================================================================

// Pengguna 
// =================================================================================================

	public function data_pelanggan()
	{
		allowed('administrator');

        $data = array(
            'title'         => 'Data Pelanggan',
            'act'			=> 'pelanggan',
            'url_ajax'		=> site_url('ajax/get_data_pelanggan')
        );
        
        $this->template->load('back','admin/users/view', $data);
	}

	public function data_admin()
	{
		allowed('administrator');

        $data = array(
            'title'         => 'Data Admin Toko',
            'act'			=> 'administrator',
            'url_ajax'		=> site_url('ajax/get_data_admin')
        );
        
        $this->template->load('back','admin/users/view', $data);
	}

	public function tambah_admin()
	{
		allowed('administrator');

		$this->load->model('Users_model', 'users');
		if (isset($_POST['submit'])) 
		{
			$post = $this->input->post();

			$config = array(
		    	array(
        			'field' => 'nama_lengkap',
					'label'	=> 'Nama Lengkap',
					'rules'	=> 'trim|required|min_length[5]|max_length[32]'
        		),
        		array(
        			'field' => 'username',
					'label'	=> 'Username',
					'rules'	=> 'trim|required|min_length[5]|max_length[20]|is_unique[tb_users.username]',
					'errors'=> array(
						'is_unique' => "Username '".$post['username']."' Sudah Digunakan"
					)
        		),
        		array(
        			'field' => 'email',
					'label'	=> 'Alamat Email',
					'rules'	=> 'trim|required|valid_email|is_unique[tb_users.email]',
					'errors'=> array(
						'is_unique' => "Alamat Email '".$post['email']."' Sudah Digunakan"
					)
        		)
		    );

		    $this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'		=> 'Tambah Admin',
            		'admin'		=> $post
            	);

        		$this->template->load('back','admin/users/form',$data);
            }
            else
            {
            	$data = array(
            		'username'		=> $post['username'],
            		'email'			=> $post['email'],
            		'nama_lengkap'	=> $post['nama_lengkap'],
            		'aktif'			=> 'Y',
            		'role'			=> 'administrator',
            		'password'		=> $this->Auth_model->makeHash($post['username'])
            	);

            	$this->users->insert($data);
            	$this->session->set_flashdata('notifikasi', '<script>notifikasi("Admin Telah Ditambahkan", "success", "fa fa-exclamation")</script>');
            	redirect(site_url('administrator/data_admin'));
            }
		}
		else
		{
			$data = array(
				'title'	=> 'Tambah Admin'
			);
			$this->template->load('back','admin/users/form', $data);
		}
	}

// =================================================================================================

// Authentikasi 
// =================================================================================================

	public function login()
	{
		$cekdata = $this->session->userdata('logged_in');
        if (empty($cekdata)) {
            $this->load->view('admin/login');
        } else {
        	echo "<script>document.location.href='".base_url()."';</script>";
        }
	}

	public function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama_pengguna');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
    	redirect(site_url('administrator/login'));
	}

	public function login_proses() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// qwe
		// $2y$10$x1HAmNLDvfSW2dU2m2sBruHO1ur.TMWT04VH1EJSvFdH1kF79kftS
		$cekdata = $this->Auth_model->getLoginData($username);
		if ($cekdata) {
			$hash = $cekdata['password'];
			if (password_verify($password, $hash)) {
				
				if($cekdata['role']=='administrator')
				{
					$this->session->set_flashdata('notifikasi', '<script>
						notifikasi("Login Sukses, Selamat Bekerja ...", "success", "fa fa-check")</script>');
					redirect('administrator');
				}
			    else
			    {
				    $this->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Bukan Administrator ..", "danger", "fa fa-exclamation")</script>');
		    		redirect(site_url());
			    }
			} else {
			    $this->session->set_flashdata('notifikasi', '<script>notifikasi("Login Gagal , Username / Password Salah", "danger", "fa fa-exclamation")</script>');
			    $this->session->unset_userdata('logged_in');
	    		redirect(site_url('administrator/login'));
			}
		} else {
			$this->session->set_flashdata('notifikasi', '<script>notifikasi("Login Gagal , Username / Password Salah", "danger", "fa fa-exclamation")</script>');
    		redirect(site_url('administrator/login'));
		}
	}

	public function profile()
	{
		allowed('administrator');
		// var_dump($this->session->userdata()); die;
		$this->load->model('Users_model', 'users');
		$users = $this->users->get_by_username($this->session->userdata('username'));

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
				'username'		=> $post['username'],
				'email'			=> $post['email'],
				'nama_lengkap'	=> $post['nama_lengkap']
			);

			if($this->session->userdata('email') != $post['email'])
				$this->form_validation->set_rules('email', 'Alamat Email', 'required|is_unique[tb_users.email]');

			if($this->session->userdata('username') != $post['username'])
				$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_users.username]');

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
            	$data = array(
            		'title'		=> 'Pengaturan Profil',
            		'users'		=> $datauser
            	);

        		$this->template->load('back','admin/profile',$data);
            }
            else
            {
            	$cekdata = $this->Auth_model->cekPass($this->session->userdata('username'));
				$pass = $cekdata['password'];
				if (password_verify($post['password'], $pass) == 1) {
					$update = $this->users->update($users['username'], $datauser);
					if ($update) {
						$this->session->set_flashdata('notifikasi', '<script>
							notifikasi("Data Profil Berhasil Di Update", "success", "fa fa-check")</script>');
						redirect('administrator/profile');
					}
						
				}
				else
				{
					$this->session->set_flashdata('notifikasi', '<script>
						notifikasi("Password Salah, Update Profile Gagal", "danger", "fa fa-exclamation")</script>');
					redirect('administrator/profile');
				}
            }
		}
		else
		{
			$data = array(
        		'title'		=> 'Pengaturan Profil',
        		'users'		=> $users
        	);

    		$this->template->load('back','admin/profile',$data);
		}
	}

	public function edit_password()
	{
		allowed('administrator');
		if (isset($_POST['submit'])) 
		{
			$username 				 = $this->session->userdata('username');
			$password_lama 		 = $this->input->post('password_lama');
			$password_baru 		 = $this->input->post('password_baru');
			$password_konfirmasi = $this->input->post('konfirmasi_password');

			$config = array(
				array(
					'field' => 'password_lama',
					'label'	=> 'Password Lama',
					'rules'	=> 'required'
				),
				array(
					'field' => 'password_baru',
					'label'	=> 'Password Baru',
					'rules'	=> 'required'
				),
				array(
					'field' => 'konfirmasi_password',
					'label'	=> 'Password Konfirmasi',
					'rules'	=> 'required|matches[password_baru]'
				),
			);

			$this->form_validation->set_rules($config);

			$cekdata = $this->Auth_model->cekPass($username);
			$pass = $cekdata['password'];

			if ($this->form_validation->run() == FALSE)
            {
            	$data['title'] = 'Edit Password';
				$this->template->load('back','admin/edit_password', $data);
            }
            else
            {
            	if(password_verify($password_lama, $pass)) {
					$newHash = $this->Auth_model->makeHash($password_konfirmasi);
					$upd     = $this->Auth_model->updPass($username,$newHash);
					$this->session->set_flashdata('notifikasi', '<script>
						notifikasi("Password Berhasil Di Update", "success", "fa fa-check")</script>');
					redirect('administrator/edit_password');
				} else {
					$this->session->set_flashdata('notifikasi', '<script>
						notifikasi("Password Salah, Update Profile Gagal", "danger", "fa fa-exclamation")</script>');
					redirect('administrator/edit_password');
				}
                
            }
		}
		else
		{
			$data['title'] = 'Edit Password';
			$this->template->load('back','admin/edit_password', $data);
		}
	}

	// Laporan
	// 
	
	public function laporan_penjualan()
	{
		allowed('administrator');
		$data = array(
			'title'	=> 'Laporan Penjualan'
		);

		$this->template->load('back', 'admin/report/view', $data);
	}

	public function cetak_laporan()
	{
		allowed('administrator');
		$this->load->library('Pdfgenerator');
		$this->load->helper('tanggal');
		$this->load->model('Pemesanan_model', 'order');

		$tgl_awal 		= $this->input->get('start_date');
		$tgl_akhir 		= $this->input->get('end_date');
		$order 			= $this->order->get_data_range($tgl_awal, $tgl_akhir);
		$total_earn 	= $this->order->total_data_range($tgl_awal, $tgl_akhir);
		
		$data 			= array(
			'order'		=> $order,
			'tgl_awal' 	=> date_indo($tgl_awal),
			'tgl_akhir' => date_indo($tgl_akhir),
			'total'		=> $total_earn
		);

		$nama = "Laporan-Penjualan-".$tgl_awal."-to-".$tgl_akhir;
		$html = $this->load->view('admin/report/view_pdf', $data, true);
		echo $html; die;
		$this->pdfgenerator->generate($html, $nama, true, 'A4', 'portrait');

	}

// =================================================================================================

	// AJAX
	// 
	public function get_kabupaten()
	{
		if(isset($_POST['id_provinsi']) && isset($_POST['selected']))
		{
			$id_provinsi = $this->input->post('id_provinsi');
			$selected 	 = $this->input->post('selected');
			$data = $this->db->query("SELECT * FROM kabupaten WHERE provinsi_id = ".$id_provinsi)->result();
			foreach ($data as $r) {
				$sel = '';
				if($r->id_kabupaten == $selected)
					$sel = 'selected';
				echo "<option value='".$r->id_kabupaten."' ".$sel.">".$r->nama_kabupaten."</option>";
			}
		}
		else
		{
			$this->template->load('back', 'admin/404', array('title' => '404 Page Not Found'));
		}
	}
}

/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */
?>