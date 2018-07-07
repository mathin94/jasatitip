<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
				
	}

	public function cara_belanja()
	{
		$data = array(
			'title' => 'Cara Berbelanja Di Toko Kami'
		);
		$this->template->load('front', 'page/cara_belanja', $data);
	}

	public function hubungi_kami()
	{
		$identitas = $this->db->get('identitas')->row_array();

		$data = array(
			'title'	=> 'Hubungi Kami',
			'row'	=> $identitas
		);

		$this->template->load('front', 'page/hubungi_kami', $data);
	}

}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */