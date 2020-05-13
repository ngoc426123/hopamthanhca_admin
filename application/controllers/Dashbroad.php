<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbroad extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$data["page_title"] = "Thống kê toàn trang";
		$data["page_view"] = "dashbroad";
		$this->load->view("layout", $data);
	}
}
