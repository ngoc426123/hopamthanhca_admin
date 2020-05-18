<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$this->load->model(['model_cat', 'model_meta']);
		$slug = $_GET['slug'];
		switch ($slug) {
			case 'chuyen-muc':
				$data["page_menu_index"] = 31;
				break;
			case 'tac-gia':
				$data["page_menu_index"] = 32;
				break;
			case 'bang-chu-cai':
				$data["page_menu_index"] = 33;
				break;
			case 'dieu-bai-hat':
				$data["page_menu_index"] = 34;
				break;
			default:
				$data["page_menu_index"] = 30;
				break;
		}
		$data["page_title"] = "Chuyên mục";

		if ( isset($_GET["action"]) ) {
			if ( $_GET["action"] == "edit" ) {
				$id_song = $_GET["id"];
				$data["slug"] = $_GET['slug'];
				$data["cat"] = $this->model_cat->get($id_song);
				$data["page_view"] = "category_edit";
				$this->load->view("layout", $data);
			} else if ( $_GET["action"] == "update" ) {
				$id_cat = $_GET["id"];
				if ( isset($_POST["ok"]) ) {
					// UPDATE SONG
					$array_cat_update = [
						"cat_name" => $_POST['name'],
						"cat_slug" => $_POST['seourl'],
						"cat_des" => $_POST['des']
					];
					$this->model_cat->update($id_cat, $array_cat_update);

					// UPDATE META
					$this->model_meta->update_cat($id_cat, 'seotitle', $_POST['seotitle']);
					$this->model_meta->update_cat($id_cat, 'seourl', $_POST['seourl']);
					$this->model_meta->update_cat($id_cat, 'seokeywork', $_POST['seokeywork']);

					$data["alert"] = ["success", "Thành công: cập nhật danh mục."];
				} else {
					$data["alert"] = ["warning", "Không có cập nhật."];
				}
				
				$data["slug"] = $_GET['slug'];
				$data["cat"] = $this->model_cat->get($id_cat);
				$data["page_view"] = "category_edit";
				$this->load->view("layout", $data);
			} else if ( $_GET["action"] == "add" ) {
				if ( isset($_POST["ok"]) ) {
					// ADD CAT
					$array_insert_cat = [
						"id" => "",
						"cat_name" => $_POST["name"],
						"cat_slug" => $_POST["seourl"],
						"cat_des" => $_POST["des"],
					];
					$id_cat = $this->model_cat->add($array_insert_cat);

					// ADD CAT TYPE
					$type = $this->model_cat->getcattype($slug);
					$id_type = $type["id"];
					$array_insert_cattype = [
						"id" => "",
						"id_type" => $id_type,
						"id_cat" => $id_cat,
					];
					$this->model_cat->addcattype($array_insert_cattype);

					// ADD CAT META
					$this->model_meta->add_cat($id_cat, 'seotitle', $_POST['seotitle']);
					$this->model_meta->add_cat($id_cat, 'seourl', $_POST['seourl']);
					$this->model_meta->add_cat($id_cat, 'seokeywork', $_POST['seokeywork']);

					$data["alert"] = ["success", "Thêm danh mục."];
				} else {
					$data["alert"] = ["warning", "Không có thêm danh mục."];
				}

				$page = $_GET['page'];
			
				$number_cat_on_page = 10;
				$start = ($page - 1) * $number_cat_on_page;

				$count = $this->model_cat->count($slug);
				$number_pagination = ceil($count / $number_cat_on_page);
				for ($i=1; $i <= $number_pagination ; $i++) {
					$active = ($i == $page)?1:0;
					$arr_pagination[] = [
						"number" => $i,
						"link" => base_url("category?slug={$slug}&page={$i}"),
						"active" => $active,
					];
				}

				$data["slug"] = $_GET["slug"];
				$data["page"] = $_GET["page"];
				$data["list_cat"] = $this->model_cat->getlist($slug, $start, $number_cat_on_page);
				$data["pagination_song"] = $arr_pagination;
				$data["page_view"] = "category";
				$this->load->view("layout", $data);
			}
		} else {
			$page = $_GET['page'];
			
			$number_cat_on_page = 10;
			$start = ($page - 1) * $number_cat_on_page;

			$count = $this->model_cat->count($slug);
			$number_pagination = ceil($count / $number_cat_on_page);
			for ($i=1; $i <= $number_pagination ; $i++) {
				$active = ($i == $page)?1:0;
				$arr_pagination[] = [
					"number" => $i,
					"link" => base_url("category?slug={$slug}&page={$i}"),
					"active" => $active,
				];
			}

			$data["slug"] = $slug;
			$data["page"] = $page;
			$data["list_cat"] = $this->model_cat->getlist($slug, $start, $number_cat_on_page);
			$data["pagination_song"] = $arr_pagination;
			$data["page_view"] = "category";
			$this->load->view("layout", $data);
		}
	}

	public function edit(){
		$data["page_menu_index"] = 31;
		$data["page_title"] = "Sửa chuyên mục";
		$data["page_view"] = "category_edit";
		$this->load->view("layout", $data);
	}
}