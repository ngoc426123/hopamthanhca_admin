<?php
if (!function_exists('check_admin')) {
  function check_login() {
    $CI =& get_instance();
  
    if ($CI->session->has_userdata('username')) return;
    if ($CI->uri->segment(1) !== 'login') redirect('/login');
  }
}

if (!function_exists('check_admin')) {
	function check_admin() {
		$CI =& get_instance();
		$permission = $CI->session->permission;
    $segment = $CI->uri->segment(1);
    $arrNeedAdmin = ['user', 'database', 'config'];

    if ($permission != 1 && in_array($segment, $arrNeedAdmin)) redirect('/notpermission');
	}
}


?>