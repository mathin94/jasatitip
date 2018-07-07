<?php
function allowed($param) 
{
    $CI =& get_instance();
    if ($CI->session->userdata('role') != $param) {
            redirect(base_url(),'refresh');
        }
}