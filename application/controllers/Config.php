<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
		check_admin_rdr();
	}

	public function index(){
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
					echo "phone: ".$this->model_option->get('phonenumber');
					$this->model_option->update('title', $_POST['title']);
					$this->model_option->update('keywork', $_POST['keywork']);
					$this->model_option->update('desc', $_POST['desc']);
					$this->model_option->update('email', $_POST['email']);
					$this->model_option->update('phonenumber', $_POST['phonenumber']);
					$this->model_option->update('dateformat', $_POST['dateformat']);
					$this->model_option->update('timeformat', $_POST['timeformat']);
					$this->model_option->update('site_url', $_POST['site_url']);
					$this->model_option->update('home_url', $_POST['home_url']);
					$this->model_option->update('favicon', $_POST['favicon']);
					$this->model_option->update('post_defaultstatus', $_POST['post_defaultstatus']);
					$this->model_option->update('post_defaultcategory', '{"chuyen-muc":'.$_POST["post_defaultcategory_chuyenmuc"].',"tac-gia":'.$_POST["post_defaultcategory_tacgia"].',"bang-chu-cai":'.$_POST["post_defaultcategory_bangchucai"].',"dieu-bai-hat":'.$_POST["post_defaultcategory_dieubaihat"].', "nam-phung-vu":'.$_POST["post_defaultcategory_namphungvu"].'}');
					
					$data["alert"] = ["success", "Thành công: cập nhật trang web."];
				}

				$data["cat"]["chuyen-muc"] = $this->model_cat->getlist("chuyen-muc");
				$data["cat"]["tac-gia"] = $this->model_cat->getlist("tac-gia");
				$data["cat"]["bang-chu-cai"] = $this->model_cat->getlist("bang-chu-cai");
				$data["cat"]["dieu-bai-hat"] = $this->model_cat->getlist("dieu-bai-hat");
				$data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
				$data["setting"] = [
					"title"=> $this->model_option->get('title'),
					"keywork"=> $this->model_option->get('keywork'),
					"desc"=> $this->model_option->get('desc'),
					"email"=> $this->model_option->get('email'),
					"phonenumber"=> $this->model_option->get('phonenumber'),
					"dateformat"=> $this->model_option->get('dateformat'),
					"timeformat"=> $this->model_option->get('timeformat'),
					"site_url"=> $this->model_option->get('site_url'),
					"home_url"=> $this->model_option->get('home_url'),
					"favicon"=> $this->model_option->get('favicon'),
					"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
					"post_defaultcategory"=> json_decode("{$this->model_option->get('post_defaultcategory')}", true),
				];
				$data["page_menu_index"] = 61;
				$data["page_title"] = "Tùy chỉnh trang web";
				$data["page_view"] = "setting";
				$this->load->view("layout", $data);
			}
		}
	}
}