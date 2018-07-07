<?php
function cmb_dinamis($name,$table,$field,$pk,$selected,$placeholder = '-Pilihan-') {
    $ci = get_instance();
    $cmb = "<select class='form-control' size='1' name='$name' id='$name'>";
    $data = $ci->db->get($table)->result();
    $cmb .= "<option value=''>".$placeholder."</option>";
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  ucwords($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}

function combo_status($selected=0)
{
    $cmb = "<select class='form-control' size='1' name='status_produk' id='status_produk'>";
    $cmb .='<option value="">- Pilih Status Produk-</option>';
    $cmb .='<option value="Stok Tersedia"';
    $cmb .=$selected == 'Stok Tersedia' ? ' selected' : '';
    $cmb .='>Stok Tersedia</option>';
    $cmb .='<option value="Stok Kosong"';
    $cmb .=$selected == 'Stok Kosong' ? ' selected' : '';
    $cmb .='>Stok Kosong</option>';
    $cmb .="</select>";

    return $cmb;  

}

function combo_rekening($selected = 0) {
    $ci = get_instance();
    $cmb = "<select class='form-control' size='1' name='rekening_tujuan' id='rekening_tujuan'>";
    $cmb .= "<option value=''>- Pilih Rekening -</option>";
    $data = $ci->db->query("SELECT * FROM rekening_bank ORDER BY nama_bank ASC")->result();
    if (!empty($data)) {
        foreach ($data as $d) {
            $cmb .="<option value='".$d->id_rekening."'";
            $cmb .= $selected==$d->id_rekening?" selected='selected'":'';
            $cmb .=">".  $d->nama_bank . " - " . $d->no_rekening ."</option>";
        }
    } 
    $cmb .="</select>";
    return $cmb;
}

function combo_kategori($selected = 0) {
    $ci = get_instance();
    $cmb = "<select class='form-control' size='1' name='kategori_id' id='kategori_id'>";
    $cmb .= "<option value=''>- Pilih Kategori -</option>";
    $data = $ci->db->query("SELECT * FROM tb_kategori ORDER BY nama_kategori ASC")->result();
    foreach ($data as $d) {
        $cmb .="<option value='".$d->id_kategori."'";
        $cmb .= $selected==$d->id_kategori?" selected='selected'":'';
        $cmb .=">".  ucwords($d->nama_kategori)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function combo_provinsi($selected = 0, $disabled = '') {
    $ci = get_instance();
    $cmb = "<select class='form-control' size='1' name='id_provinsi' id='id_provinsi' ".$disabled.">";
    $cmb .= "<option value=''>- Pilih Provinsi -</option>";
    $data = $ci->db->query("SELECT * FROM provinsi ORDER BY nama_provinsi ASC")->result();
    foreach ($data as $d) {
        $cmb .="<option value='".$d->id_provinsi."'";
        $cmb .= $selected==$d->id_provinsi?" selected='selected'":'';
        $cmb .=">".  ucwords($d->nama_provinsi)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function list_kategori()
{
    $ci = get_instance();
    $lst = "<ul class='sub-menu'>";
    $data = $ci->db->query("SELECT * FROM tb_kategori ORDER BY nama_kategori ASC")->result();
    foreach ($data as $d) {
        $lst .="<li><a href='".base_url('produk/kategori/'.$d->id_kategori.'-'.permalink($d->nama_kategori))."'>".$d->nama_kategori."</a></li>";
    }
    $lst .= "</ul>";
    return $lst;
}

function list_kategori2()
{
    $ci = get_instance();
    $lst = "<ul>";
    $data = $ci->db->query("SELECT * FROM tb_kategori ORDER BY nama_kategori ASC")->result();
    foreach ($data as $d) {
        $lst .="<li class='bor18'><a class='dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4' href='".base_url('kategori/'.$d->nama_kategori)."'>".$d->nama_kategori."</a></li>";
    }
    $lst .= "</ul>";
    return $lst;
}