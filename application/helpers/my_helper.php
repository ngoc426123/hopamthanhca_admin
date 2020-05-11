<?php
if(!function_exists("check_login")){
    function check_login() {
        $CI =& get_instance();
        if (!$CI->session->has_userdata('username')) {
            redirect('login');
        }
    }
}

if(!function_exists("pr")){
    function pr($arr) {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}