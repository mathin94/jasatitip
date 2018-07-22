<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cart_model');
		$this->load->model('Ongkir_model');
		$this->load->model('Users_model');
		$this->load->model('Alamat_model');
		$this->load->model('Pemesanan_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == 'Yes') 
		{
			if ($this->session->userdata('role') == 'pelanggan') 
			{
				$cart = $this->cart->contents();
				// var_dump($cart); die;
				$alamat = $this->Alamat_model->get_alamat_pengiriman($this->session->userdata('username'));
				$users = $this->Users_model->get_by_username($this->session->userdata('username'));
				$data = array(
					'title' => 'Keranjang Belanja',
					'cart'	=> $cart,
					'alamat'=> $alamat,
					'users' => $users,
					'total' => $this->cart->total(),
					'totaljasa'=>$this->total_fee()

				);

				$this->template->load('front', 'cart/index', $data);
			}
			else
			{
				$this->session->set_flashdata('notifikasi', '<script>notifikasi("Halaman Keranjang Hanya Dapat Di Akses oleh pelanggan", "danger", "fa fa-exclamation")</script>');
				redirect(base_url());
			}
		}
		else
		{
			$this->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Untuk Mengakses Halaman Keranjang", "danger", "fa fa-exclamation")</script>');
				redirect(base_url());
		}
				
	}

	public function checkout()
	{
		if (isset($_POST['id_user'])) 
		{
			$post 			= $this->input->post();
			$cart 			= $this->cart->contents();
			$alamat 		= $this->Alamat_model->get_alamat_lengkap($post['id_alamat']);
			$ongkir 		= $this->Ongkir_model->get_by_kecamatanid($alamat['kecamatan_id']);
			$trans = array(
				'user_id'		=> $post['id_user'],
				'alamat_id'		=> $post['id_alamat'],
				'total_harga'	=> $post['total_harga'],
				'total_ongkir'	=> $post['total_ongkir'],
				'total_fee'		=> $post['total_fee'],
				'kode_transaksi'=> $this->Pemesanan_model->autokode(),
				'tanggal'		=> date('Y-m-d'),
				'status'		=> 'Belum Dibayar'
			);

			$data = array(
				'cart'		=> $cart,
				'trans'		=> $trans,
				'totaljasa'	=> $this->total_fee(),
				'title'		=> 'Konfirmasi Checkout',
				'no'		=> 1,
				'ongkir'	=> $ongkir['biaya'],
				'totber'	=> $this->total_berat(),
				'alamat'	=> $this->Alamat_model->get_alamat_lengkap($post['id_alamat']),
				'tanggal'	=> tanggal_indo(date('Y-m-d'))
			);

			$this->template->load('front', 'cart/checkout', $data);
		}
	}

	public function checkout_konfirmasi()
	{
		$post 			= $this->input->post();
		$cart 			= $this->cart->contents();
		$kode_unik 		= $this->Pemesanan_model->kode_unik($post['total_harga']);
		$trans = array(
			'user_id'		=> $post['id_user'],
			'alamat_id'		=> $post['id_alamat'],
			'total_harga'	=> $post['total_harga'],
			'total_ongkir'	=> $post['total_ongkir'],
			'total_fee'		=> $post['total_fee'],
			'kode_transaksi'=> $this->Pemesanan_model->autokode(),
			'status'		=> 'Belum Dibayar',
			'kode_unik'		=> $kode_unik
		);

		$cart = $this->cart->contents();

		$insert = $this->Pemesanan_model->insert($trans, $cart);
		$this->session->set_flashdata('notifikasi', '<script>notifikasi("Pesanan Berhasil Dibuat, Silahkan Bayar Pesanan Anda Sesuai Dengan Yang Tertulis di halaman pembayaran !", "success", "fa fa-check")</script>');
		$this->cart->destroy();
		redirect('pemesanan/pembayaran/'.$this->session->flashdata('id_order'));
	}

	public function pembayaran()
	{
		$pemesanan = $this->Pemesanan_model->get_pemesanan_one(2);
		$data = array(
			'title'		=> 'Rincian Pembayaran',
			'total'		=> 'Rp. ' . number_format($pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['kode_unik']),
			'kode_transaksi'=> $pemesanan['kode_transaksi'],
			'totalbayar'	=> $pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['total_fee']+$pemesanan['kode_unik']
		);

		
		$this->template->load('front', 'cart/pembayaran', $data);
	}

	public function konfirmasi_pembayaran()
	{
		if (isset($_POST['submit'])) 
		{
			$config['upload_path'] = './assets/bukti_transfer/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '20000'; // kb
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload('bukti_transfer');
            $hasil=$this->upload->data();

            // Config Validasi
            $config = array(
				array(
					'field' => 'nama_pengirim',
					'label'	=> 'Nama Pengirim',
					'rules'	=> 'required'
				),
				array(
					'field' => 'bank_pengirim',
					'label'	=> 'Nama Bank',
					'rules'	=> 'required'
				),
				array(
					'field' => 'rekening_pengirim',
					'label'	=> 'Nomor Rekening',
					'rules'	=> 'required|numeric'
				),
				array(
					'field' => 'rekening_tujuan',
					'label'	=> 'Nomor Rekening Tujuan',
					'rules'	=> 'required'
				)
			);

            $post = $this->input->post();

			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
            {
            	$pemesanan    = $this->Pemesanan_model->get_pemesanan_one($this->uri->segment(3));
				$data = array(
					'title'			=> 'Konfirmasi Transfer',
					'order'			=> $pemesanan,
					'post'			=> $post
				);

        		$this->template->load('front', 'cart/konfirmasi_pembayaran', $data);
            }
            else
            {
            	$bank = $this->db->where('id_rekening', $post['rekening_tujuan'])->get('rekening_bank')->row_array();
            	if($hasil['file_name'] == '')
            	{
            		$data = array(
            			'kode_transaksi' 	=> $post['kode_transaksi'],
            			'nama_pengirim'	 	=> $post['nama_pengirim'],
            			'bank_pengirim'  	=> $post['bank_pengirim'],
            			'rekening_pengirim' => $post['rekening_pengirim'],
            			'rekening_tujuan'	=> $bank['nama_bank'] . ' - ' . $bank['no_rekening'],
            			'jumlah_transfer'	=> $post['jumlah_transfer'],
            			'status'			=> 'N'
            		);
            	}
            	else
            	{
            		$data = array(
            			'kode_transaksi' 	=> $post['kode_transaksi'],
            			'nama_pengirim'	 	=> $post['nama_pengirim'],
            			'bank_pengirim'  	=> $post['bank_pengirim'],
            			'rekening_pengirim' => $post['rekening_pengirim'],
            			'rekening_tujuan'	=> $bank['nama_bank'] . ' - ' . $bank['no_rekening'],
            			'jumlah_transfer'	=> $post['jumlah_transfer'],
            			'status'			=> 'N',
            			'bukti_transfer'	=> $hasil['file_name']
            		);
            	}

            	$this->db->insert('tb_konfirmasi_transfer', $data);
            	$this->session->set_flashdata('konfirmasi_pembayaran', '<script>
						notifikasi("Konfirmasi Pembayaran Telah Di Input, Tunggu Andmin Memeriksa Pembayaran Anda", "success", "fa fa-check");
            		</script>');
            	redirect(base_url());
            }
		}
		else
		{
			$id_pemesanan = $this->uri->segment(3);
			if($id_pemesanan)
			{
				$pemesanan    = $this->Pemesanan_model->get_pemesanan_one($id_pemesanan);
				$data = array(
					'title'			 => 'Konfirmasi Pembayaran',
					'order' 		 => $pemesanan

				);

				$this->template->load('front', 'cart/konfirmasi_pembayaran', $data);
			}
			else
			{
				redirect('/');
			}
		}
	}

	public function add_to_cart()
	{
		if ($this->session->userdata('logged_in') == 'Yes') 
		{
			if ($this->session->userdata('role') == 'pelanggan') 
			{
				$data = array(
					'id'			=> $this->input->post('id_produk'),
					'name'			=> $this->input->post('nama_produk'),
					'price'			=> $this->input->post('harga'),
					'qty'			=> $this->input->post('qty'),
					'options'		=> array(
						'gambar'	=> site_url().'assets/foto_produk/'.$this->input->post('gambar'),
						'berat'		=> ($this->input->post('berat')),
						'fee'		=> ($this->input->post('fee')),
					)
				);

				$this->cart->insert($data);
				echo $this->show_cart();
			}
			else
			{
				echo FALSE;
			}
		}
		else
		{
			echo FALSE;
		}
				
	}

	public function show_alamat()
	{
		$id = $this->input->post('id');
		$alamat = $this->Alamat_model->get_alamat_lengkap($id);

		if($alamat) $text = $alamat['nama_penerima'] . '<br>' . $alamat['nomor_penerima'] . '<br>' . $alamat['alamat_lengkap'] . ', Kec. ' . $alamat['nama_kecamatan'] . ', ' . $alamat['nama_kabupaten'] . ', ' . $alamat['nama_provinsi'] . ', ' . $alamat['kode_pos'];
		else $text = 'Pilih Alamat Pengiriman Untuk Menentukan Biaya Kirim. ';
		
		echo json_encode(array('alamat'=>$text));
	}

	public function show_ongkir()
	{
		$id_alamat 	= $this->input->post('id_alamat');
		$alamat    	= $this->Alamat_model->get_alamat_lengkap($id_alamat);
		$ongkir 	= $this->Ongkir_model->get_by_kecamatanid($alamat['kecamatan_id']);
		$biaya 		= $ongkir['biaya']*$this->total_berat();
		$data 		= array(
			'kecamatan_id'	=> $ongkir['kecamatan_id'],
			'ongkir'		=> 'Rp. ' . number_format($biaya),
			'_ongkir'		=> $biaya,
			'total'			=> 'Rp. ' . number_format($this->cart->total() + $biaya)
		);

		echo json_encode($data);
	}

	public function show_cart()
	{
		$output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .='
            	<li class="header-cart-item flex-w flex-t m-b-12">
					<div class="header-cart-item-img">
						<img src="'.$items["options"]["gambar"].'" alt="IMG">
					</div>

					<div class="header-cart-item-txt p-t-8">
						<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							'.$items['name'].'
						</a>

						<span class="header-cart-item-info">
							'.$items['qty'].' x Rp. '.number_format($items['price']).'
						</span>
					</div>
				</li>
            ';
        }
       
        echo $output;
	}

	public function update_cart_qty()
	{
		$data = array(
			'rowid'			=> $this->input->post('rowid'),
			'qty'			=> $this->input->post('qty')
		);

		$this->cart->update($data);
		$biaya = 0;
		$fee   = 0;
		$kecamatan_id = $this->input->post('kecamatan_id');
		
		if ($kecamatan_id != '') 
		{
			$ongkir 	= $this->Ongkir_model->get_by_kecamatanid($kecamatan_id);
			$biaya 		= $ongkir['biaya']*$this->total_berat();
		}

		$item = $this->cart->get_item($this->input->post('rowid'));
		$row = array(
			'total'			=> 'Rp. ' . number_format($item['price']*$item['qty']),
			'totalfee'		=> 'Rp. ' . number_format($item['options']['fee']*$item['qty']),
			'subtotal'		=> 'Rp. ' . number_format($this->cart->total()),
			'grandtotal'	=> 'Rp. ' . number_format($this->cart->total()+$biaya),
			'ongkir'		=> 'Rp. ' . number_format($biaya),
			'feejastip'		=> 'Rp. ' . number_format($this->total_fee()),
			'_fee'			=> $this->total_fee(),
			'_ongkir'		=> $biaya,
			'_subtotal'		=> $this->cart->total()
		);
		echo json_encode($row);
	}

	public function total_berat()
	{
		$items = $this->cart->contents();
		$berat = 0;
		foreach ($items as $item) {
			$berat += $item['qty']*$item['options']['berat'];
		}

		$berat = ceil($berat/1000);

		return $berat;
	}

	public function total_fee()
	{
		$items = $this->cart->contents();
		$fee = 0;
		foreach ($items as $item) {
			$fee += $item['qty']*$item['options']['fee'];
		}

		return $fee;
	}

	public function total_pembelian_cart()
	{
		$data = array(
			'total'=>'Rp. '.number_format($this->cart->total()).' ,-',
			'count'=>$this->cart->total_items()
		);
		echo json_encode($data);
	}

	public function delete_single($rowid)
	{
		$data = array(
			'rowid' => $rowid,
			'qty' 	=> 0
		);
		$this->cart->update($data);
	}

	public function destroy()
	{
		$this->cart->destroy();
	}

}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */