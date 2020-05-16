<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$data["page_menu_index"] = 31;
		$data["page_title"] = "Chuyên mục";
		$data["page_view"] = "category";
		$this->load->view("layout", $data);
	}

	public function edit(){
		$data["page_menu_index"] = 31;
		$data["page_title"] = "Sửa chuyên mục";
		$data["page_view"] = "category_edit";
		$this->load->view("layout", $data);
	}
}