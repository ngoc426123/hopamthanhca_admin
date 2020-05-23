<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbroad extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$this->load->model(['model_dashbroad']);
		$data["count"] = $this->model_dashbroad->count();
		$data["song_new"] = $this->model_dashbroad->song_new();
		$data["song_view"] = $this->model_dashbroad->song_view();
		$data["song_love"] = $this->model_dashbroad->song_love();
		$data["order_cat"] = $this->model_dashbroad->order_cat();
		$data["order_type"] = $this->model_dashbroad->order_type();
		$data["order_post"] = $this->model_dashbroad->order_post();

		$data["page_menu_index"] = 1;
		$data["page_title"] = "Thống kê toàn trang";
		$data["page_view"] = "dashbroad";
		$this->load->view("layout", $data);
	}
}