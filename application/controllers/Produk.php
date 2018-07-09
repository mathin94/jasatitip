<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Kategori_model', 'kategori');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    public function index()
    {
        //konfigurasi pagination
        $config['base_url'] = site_url('produk/index'); //site url
        
        
        $config['per_page'] = 8;  //show record per halaman
        $config['total_rows'] = $this->db->count_all('tb_produk'); //total row
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['produk_data'] = $this->produk->get_data($config, $this->uri->segment(3), NULL)->result(); 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
                  
 
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Semua Produk ';
        $data['kategori_produk'] = 'Semua Produk';
        $this->template->load('front','produk/daftar_produk', $data);
    }

    public function search()
    {
        $keyword = $this->input->get('keyword');
        $config['per_page'] = 8;  //show record per halaman
        $config['total_rows'] = $this->db->count_all('tb_produk'); //total row
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['produk_data'] = $this->produk->search($keyword, $config, $data['page'])->result(); 
 
        $data['pagination'] = $this->pagination->create_links();
        $data['keyword'] = $keyword;
        $data['title'] = 'Hasil Pencarian Produk ' . $keyword;
        $this->template->load('front', 'produk/hasil_cari', $data);
    }

    public function detail_produk($id) 
    {
        $row = $this->produk->get_by_id($id);

        if ($row) 
        {
            $data = array(
                'title'     => 'Pre-Order ' . $row['nama_produk'],
                'produk'    => $row,
                'related'   => $this->produk->get_related($row['id_kategori'])
            );

            $this->template->load('front', 'produk/detail_produk', $data);
        }
        else
        {
            $this->template->load('front', 'produk/404', array('title'=>'Produk Tidak Ditemukan'));
        }
    }

    public function ajax_modal()
    {
        $id = $this->input->post('id_produk');
        $row = $this->produk->get_by_id($id);

        if ($row) 
        {
            $html = '';
            $html .= '<div class="col-md-6 col-lg-7 p-b-30"><div class="p-l-25 p-r-30 p-lr-0-lg"><div class="wrap-slick3 flex-sb flex-w"><div class="wrap-slick3-dots"></div><div class="wrap-slick3-arrows flex-sb-m flex-w"></div><div class="slick3 gallery-lb"><div class="item-slick3" data-thumb="'.site_url('assets/foto_produk/'.$row['gambar_1']).'"><div class="wrap-pic-w pos-relative"> <img src="'.site_url('assets/foto_produk/'.$row['gambar_1']).'" alt="IMG-PRODUCT"> <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.site_url('assets/foto_produk/'.$row['gambar_1']).'"> <i class="fa fa-expand"></i> </a></div></div>';
            if ($row['gambar_2'] != NULL) 
            {
                $html .= '<div class="item-slick3" data-thumb="'.site_url('assets/foto_produk/'.$row['gambar_2']).'"><div class="wrap-pic-w pos-relative"> <img src="'.site_url('assets/foto_produk/'.$row['gambar_2']).'" alt="IMG-PRODUCT"> <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.site_url('assets/foto_produk/'.$row['gambar_2']).'"> <i class="fa fa-expand"></i> </a></div></div>';
            }
            if ($row['gambar_3'] != NULL) 
            {
                $html .= '<div class="item-slick3" data-thumb="'.site_url('assets/foto_produk/'.$row['gambar_3']).'"><div class="wrap-pic-w pos-relative"> <img src="'.site_url('assets/foto_produk/'.$row['gambar_3']).'" alt="IMG-PRODUCT"> <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'.site_url('assets/foto_produk/'.$row['gambar_3']).'"> <i class="fa fa-expand"></i> </a></div></div>';
            }

            $html .= '</div></div></div></div>';
            $html .= '<div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                '.$row['nama_produk'].'
                            </h4>

                            <span class="mtext-106 cl2">
                                Rp. '.number_format($row['harga']).'
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                '.$row['deskripsi'].'
                            </p>
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="if(Number($(this).next().val()) > 0) $(this).next().val(Number($(this).next().val()) - 1)">
                                                <i class="fs-16 zmdi zmdi-minus" ></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="produk_qty" id="produk_qty" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="$(this).prev().val(Number($(this).prev().val()) + 1)">
                                                <i class="fs-16 zmdi zmdi-plus" ></i>
                                            </div>
                                        </div>

                                        <button onclick="add_cart($(this))" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" id="btn-addcart" data-idproduk="'.$row['id_produk'].'" data-hargaproduk="'.$row['harga'].'" data-namaproduk="'.$row['nama_produk'].'" data-beratproduk="'.$row['berat'].'" data-gambarproduk="'.$row['gambar_1'].'">
                                            Tambahkan Ke Keranjang
                                        </button>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>';

            echo $html;
        }
    }

    public function kategori($id)
    {
        $kat = $this->kategori->get_one($id);
        
        //konfigurasi pagination
        $config['base_url'] = site_url('produk/kategori/'.$id); //site url
        
        
        $config['per_page'] = 8;  //show record per halaman
        $config['total_rows'] = $this->produk->total_rows($id); //total row
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['produk_data'] = $this->produk->get_data($config, $this->uri->segment(4), $id)->result(); 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
                  
 
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Kategori ' . $kat['nama_kategori'];
        $data['kategori_produk'] = $kat['nama_kategori'];
        $this->template->load('front','produk/daftar_produk', $data);
    }

    public function json_produk()
    {
        $list = $this->produk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<img width="130px" height="150px" src="'.site_url('assets/foto_produk/'.$field->gambar_1).'" alt="">';
            $row[] = $field->nama_produk;
            $row[] = $field->nama_kategori;
            $row[] = 'Rp. ' . number_format($field->harga);
            $row[] = ceil($field->berat/1000) . ' Kg';
            $row[] = '<a href="'.site_url('administrator/edit_produk/'.$field->id_produk).'"><i class="fa fa-edit"></i></a> <a href="#" onclick="delete_produk('.$field->id_produk.',"'.$field->nama_produk.'")"><i class="fa fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->produk->count_all(),
            "recordsFiltered" => $this->produk->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_produk.xls";
        $judul = "tb_produk";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
    	xlsWriteLabel($tablehead, $kolomhead++, "Kategori Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Kode Produk");
    	xlsWriteLabel($tablehead, $kolomhead++, "Status Produk");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama Produk");
    	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
    	xlsWriteLabel($tablehead, $kolomhead++, "Berat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Gambar 1");
    	xlsWriteLabel($tablehead, $kolomhead++, "Gambar 2");
    	xlsWriteLabel($tablehead, $kolomhead++, "Gambar 3");

	foreach ($this->produk->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kategori_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_produk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_produk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_produk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->harga);
	    xlsWriteLabel($tablebody, $kolombody++, $data->berat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gambar_1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gambar_2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gambar_3);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-08 14:58:33 */
/* http://harviacode.com */