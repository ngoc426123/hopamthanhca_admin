<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		if ($this->session->permission != 1) {
			$this->load->view("layout-not-permission");
			return;
		}

		$this->load->model(['model_option', 'model_cat']);
		if ( isset($_GET['action']) ) {
			if ( $_GET['action']=='maintain' ) {
				if ( isset($_POST['update']) ) {
					$this->model_option->update('maintain_status', $_POST['status']);
					$this->model_option->update('maintain_title', $_POST['title']);
					$this->model_option->update('maintain_content', $_POST['content']);
					$this->model_option->update('maintain_background', $_POST['background']);
					$data["alert"] = ["success", "Thành công: cập nhật bảo trì."];
				}

				$data["maintain"] = [
					"status" => $this->model_option->get('maintain_status'),
					"title" => $this->model_option->get('maintain_title'),
					"content" => $this->model_option->get('maintain_content'),
					"background" => $this->model_option->get('maintain_background'),
				];
				$data["page_menu_index"] = 62;
				$data["page_title"] = "Bảo trì trang web";
				$data["page_view"] = "maintain";
				$this->load->view("layout", $data);
			} else if ( $_GET['action']=='setting' ) {
				if ( isset($_POST['update']) ) {
					foreach($_POST as $key => $value) {
						if ($key == 'update') break;
						$this->model_option->update($key, $key == 'post_defaultcategory' ? serialize($value) : $value);
					}
					$data["alert"] = ["success", "Thành công: cập nhật trang web."];
				}
				$data["tab"] = isset($_GET["tab"]) ? $_GET["tab"] : "config";
				$data["cat"]["chuyen-muc"] = $this->model_cat->getlist("chuyen-muc");
				$data["cat"]["tac-gia"] = $this->model_cat->getlist("tac-gia");
				$data["cat"]["bang-chu-cai"] = $this->model_cat->getlist("bang-chu-cai");
				$data["cat"]["dieu-bai-hat"] = $this->model_cat->getlist("dieu-bai-hat");
				$data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
				$data["setting"] = $this->model_option->getall();
				$data["page_menu_index"] = 61;
				$data["page_title"] = "Tùy chỉnh trang web";
				$data["page_view"] = "setting";
				$this->load->view("layout", $data);
			}
		}
	}
}