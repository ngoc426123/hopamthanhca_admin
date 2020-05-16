<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$data["page_menu_index"] = 4;
		$data["page_title"] = "Thành viên";
		$data["page_view"] = "user";
		$this->load->view("layout", $data);
	}

	public function edit(){
		$data["page_menu_index"] = 4;
		$data["page_title"] = "Cập nhật thông tin";
		$data["page_view"] = "user_edit";
		$this->load->view("layout", $data);
	}
}