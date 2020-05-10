<?php
if(!function_exists("check_login")){
    function check_login() {
        $CI =& get_instance();
        if (!$CI->session->has_userdata('username')) {
            redirect('login');
        }
    }
}