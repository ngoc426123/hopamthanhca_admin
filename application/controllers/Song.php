<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$data["page_menu_index"] = 2;
		if (isset($_GET['action'])) {
			if($_GET['action'] == 'edit') {
				$song_id = $_GET['id'];
				$this->load->model(["model_song", "model_cat"]);
				$data["song"] = $this->model_song->get($song_id);
				$data["cat"]["chuyen-muc"] = $this->model_cat->getlist("chuyen-muc");
				$data["cat"]["tac-gia"] = $this->model_cat->getlist("tac-gia");
				$data["cat"]["bang-chu-cai"] = $this->model_cat->getlist("bang-chu-cai");
				$data["cat"]["dieu-bai-hat"] = $this->model_cat->getlist("dieu-bai-hat");
				$data["page_title"] = "Sửa bài hát";
				$data["page_view"] = "song_edit";
				$this->load->view("layout", $data);
			} else if ($_GET['action'] == 'add') {
				$data["page_title"] = "Thêm bài hát";
				$data["page_view"] = "song_add";
				$this->load->view("layout", $data);
			}
		} else {
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
			$this->load->model("model_song");
			$arr_pagination = array();
			$number_song_on_page = 20;
			$count_song = $this->model_song->count();
			$number_pagination = ceil($count_song / $number_song_on_page);
			for ($i=1; $i <= $number_pagination ; $i++) {
				$active = ($i == $page)?1:0;
				$arr_pagination[] = [
					"number" => $i,
					"link" => base_url("song?page={$i}"),
					"active" => $active,
				];
			}
			$page_start = ($page - 1) * $number_song_on_page;
			$data["pagination_song"] = $arr_pagination;
			$data["list_song"] = $this->model_song->getlist($page_start, 20);
			$data["page_title"] = "Bài hát";
			$data["page_view"] = "song";
			$this->load->view("layout", $data);
		}
	}

	public function edit(){
		
	}

	public function add(){
		
	}
}