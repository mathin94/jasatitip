<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
        	parent::__construct();
        	$this->load->model('Produk_model', 'produk');
        	$this->load->model('Model_app', 'crud');
                $this->load->library('pagination');
	}

	public function index()
	{
        $data['produk'] = $this->produk->get_produk_terbaru();           
        $data['dataslide'] = $this->crud->view('slider')->result_array();
        $data['title'] = 'Home - Jasa Pemesanan Barang Online';
		$this->template->load('front','home', $data);
	}

	public function cek()
	{
		var_dump($this->cart->insert(['id'=>1]));	
	}
}

/* End of file Home_front.php */
/* Location: ./application/controllers/Home_front.php */
