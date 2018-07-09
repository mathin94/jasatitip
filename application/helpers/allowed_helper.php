<?php
function allowed($param) 
{
    $CI =& get_instance();
    $role = $CI->session->userdata('role');
    if ( $role != $param ) 
    {
    	if ($param == 'administrator') 
    	{
    		$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Admin", "danger", "fa fa-exclamation")</script>');
    		redirect(base_url('administrator/login'));
    	}
    	else
    	{
    		$CI->session->set_flashdata('notifikasi', '<script>notifikasi("Anda Harus Login Sebagai Pelanggan", "danger", "fa fa-exclamation")</script>');
    		redirect(base_url());
    	}
        
    }
}