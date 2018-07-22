<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
Carbon::setLocale('id');

class Pemesanan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pemesanan_model', 'order');
		$this->load->model('Users_model');
		$this->load->library('form_validation');
		allowed('pelanggan');
	}

	public function index()
	{
		$data = array(
			'title'				=> 'Data Pemesanan Barang'
		);

		$this->template->load('front', 'pemesanan/index', $data);
	}

	public function status()
	{
		allowed('pelanggan');
		$id = $this->uri->segment(3);

		if ($id != '') 
		{
			$this->load->model('Pengiriman_model', 'kirim');

			$detail 	= $this->kirim->get_detail($id);
			$pengiriman = $this->kirim->get_one($id);
			$order 		= $this->order->get_pemesanan_one($id);
			$trackstat  = 'c0';

			if ($order['status'] == 'Dalam Proses') 
				$trackstat = 'c1';
			elseif ($order['status'] == 'Dikirim')
				$trackstat = 'c2';
			elseif ($order['status'] == 'Diterima')
				$trackstat = 'c3';
			elseif ($order['status'] == 'Selesai')
				$trackstat = 'c4';

			$data = array(
				'title'			=> 'Detail Pengiriman',
				'pengiriman'	=> $pengiriman,
				'detail'		=> $detail,
				'pemesanan'		=> $order,
				'trackstat'		=> $trackstat
			);

			$this->template->load('front', 'pemesanan/tracking', $data);
		}
		else
		{
			redirect(site_url(),'refresh');
		}
	}

	public function json_pemesanan()
	{
		$list = $this->order->get_datatables($this->session->userdata('username'));

		$data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->kode_transaksi;
            $row[] = tanggal_indo($field->tanggal);
            $row[] = 'Rp. ' . number_format($field->total_harga+$field->total_ongkir+$field->total_fee+$field->kode_unik);
            $row[] = $field->status;
            $action = '';
            if ($field->status == 'Belum Dibayar' || $field->status == 'Menunggu Konfirmasi') 
            {
            	$action = '<a href="'.base_url('pemesanan/pembayaran/'.$field->id_pemesanan).'" class="btn btn-primary"><i class="fa fa-credit-card"></i> Bayar Tagihan</a> &nbsp';
            }
            else
            {
            	$action = '<a href="'.site_url('pemesanan/status/'.$field->id_pemesanan).'" class="btn btn-success"><i class="fa fa-truck"></i> Detail Status</a>  ';
            }

            $action .= '<a href="'.base_url('pemesanan/invoice/'.$field->id_pemesanan).'" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat Invoice</a>';

            $row[] = $action;
 
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->order->count_all($this->session->userdata('username')),
            "recordsFiltered" => $this->order->count_filtered($this->session->userdata('username')),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
	}

	public function cetak_invoice()
	{
		allowed('pelanggan');
		$id = $this->uri->segment(3);

		$this->load->library('Pdfgenerator');
		$this->load->helper('tanggal');

		$pemesanan = $this->order->get_pemesanan_one($id);

		$data = array(
			'title'		=> 'Rincian Pemesanan',
			'total'		=> 'Rp. ' . number_format($pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['kode_unik']),
			'kode_transaksi'=> $pemesanan['kode_transaksi'],
			'totalbayar'	=> $pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['kode_unik'],
			'pemesanan'		=> $pemesanan,
			'totber'		=> $this->total_berat($id),
			'detail_pesanan'=> $this->order->get_detail($id)
		);
		$nama = "invoice-".$pemesanan['kode_transaksi'];
		$html = $this->load->view('pemesanan/invoice_pdf', $data, true);
		$this->pdfgenerator->generate($html, $nama, true, 'A4', 'landscape');
	}

	public function invoice($id)
	{
		$this->load->model('Ongkir_model', 'ongkir');
		$users 		= $this->Users_model->get_by_username($this->session->userdata('username'));
		$id_pesanan = $this->uri->segment(3);
		
		$cekdata = $this->order->cek_pesanan($users['id_user'], $id_pesanan);
		
		if ($cekdata > 0) 
		{
			$pemesanan 	= $this->order->get_pemesanan_one($id_pesanan);
			$ongkir 	= $this->ongkir->get_by_kecamatanid($pemesanan['kecamatan_id']);
			$carbon 	= new Carbon($pemesanan['tanggal']);
			$tanggal 	= $carbon->format('d F Y');
			$data = array(
				'title'		=> 'Rincian Pemesanan',
				'total'		=> 'Rp. ' . number_format($pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['kode_unik']),
				'kode_transaksi'=> $pemesanan['kode_transaksi'],
				'totalbayar'	=> $pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['kode_unik'],
				'pemesanan'		=> $pemesanan,
				'tanggal' 		=> $tanggal,
				'ongkir'		=> $ongkir['biaya'],
				'totber'		=> $this->total_berat($id_pesanan),
				'detail_pesanan'=> $this->order->get_detail($id_pesanan)
			);

			$this->template->load('front', 'pemesanan/invoice', $data);
		}
		else
		{
			$this->session->set_flashdata('notifikasi', '<script>
					notifikasi("Anda Tidak Memiliki Akses Untuk Melihat Invoice ini", "danger", "fa fa-exclamation")
				</script>');
			redirect('pemesanan');
		}
	}

	public function total_berat($id_pesanan)
	{
		$detail_pesanan = $this->order->get_detail($id_pesanan);
		$berat = 0;
		foreach ($detail_pesanan as $item) {
			$berat += $item->qty*$item->berat;
		}

		$berat = ceil($berat/1000);

		return $berat;
	}

	public function pembayaran()
	{
		$users = $this->Users_model->get_by_username($this->session->userdata('username'));
		$id_pesanan = $this->uri->segment(3);

		$cekdata = $this->order->cek_pesanan($users['id_user'], $id_pesanan);
		
		if ($cekdata > 0) 
		{
			$pemesanan = $this->order->get_pemesanan_one($id_pesanan);
			$data = array(
				'title'		=> 'Rincian Pembayaran',
				'total'		=> 'Rp. ' . number_format($pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['total_fee']+$pemesanan['kode_unik']),
				'kode_transaksi'=> $pemesanan['kode_transaksi'],
				'totalbayar'	=> $pemesanan['total_harga']+$pemesanan['total_ongkir']+$pemesanan['kode_unik']
			);
			$this->template->load('front', 'pemesanan/pembayaran', $data);
		}
		else
		{
			$this->session->set_flashdata('notifikasi', '<script>
					notifikasi("Hanya Bisa Melakukan Pembayaran Untuk Pesanan yang sesuai", "danger", "fa fa-exclamation")
				</script>');
			redirect('pemesanan');
		}
	}

	public function konfirmasi_pembayaran()
	{
		$users = $this->Users_model->get_by_username($this->session->userdata('username'));
		$id_pesanan = $this->uri->segment(3);

		$cekdata = $this->order->cek_pesanan($users['id_user'], $id_pesanan);

		if ($cekdata > 0)
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
	            	$pemesanan    = $this->order->get_pemesanan_one($this->uri->segment(3));
					$data = array(
						'title'			=> 'Konfirmasi Transfer',
						'order'			=> $pemesanan,
						'post'			=> $post
					);

	        		$this->template->load('front', 'pemesanan/konfirmasi_pembayaran', $data);
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
	            	$datapesanan = array(
	            		'status'	=> 'Menunggu Konfirmasi'
	            	);
	            	$this->db->insert('tb_konfirmasi_transfer', $data);
	            	if ($this->db->insert_id()) {
	            		$this->order->update($this->uri->segment(3), $datapesanan);
	            		$this->session->set_flashdata('konfirmasi_pembayaran', '<script>
								notifikasi("Konfirmasi Pembayaran Telah Di Input, Tunggu Andmin Memeriksa Pembayaran Anda", "success", "fa fa-check");
		            		</script>');
		            	redirect(base_url());
	            	}
		            	
	            }
			}
			else
			{
				$id_pemesanan = $this->uri->segment(3);
				if($id_pemesanan)
				{
					$pemesanan    = $this->order->get_pemesanan_one($id_pemesanan);
					$data = array(
						'title'			 => 'Konfirmasi Pembayaran',
						'order' 		 => $pemesanan

					);

					$this->template->load('front', 'pemesanan/konfirmasi_pembayaran', $data);
				}
				else
				{
					redirect('/');
				}
			}
		}
		else
		{
			$this->session->set_flashdata('notifikasi', '<script>
					notifikasi("Hanya Bisa Melakukan Pembayaran Untuk Pesanan yang sesuai", "danger", "fa fa-exclamation")
				</script>');
			redirect('pemesanan');
		}
			
	}
}

/* End of file Pemesanan.php */
/* Location: ./application/controllers/Pemesanan.php */