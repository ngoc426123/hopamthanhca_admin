<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$this->load->model(['model_cat', 'model_meta','model_song', 'model_weekly']);
		$arr_pagination = array();
		$slug = $this->input->get('slug');

		switch ($slug) {
			case 'chuyen-muc': $data["page_menu_index"] = 31; break;
			case 'tac-gia': $data["page_menu_index"] = 32; break;
			case 'bang-chu-cai': $data["page_menu_index"] = 33; break;
			case 'dieu-bai-hat': $data["page_menu_index"] = 34; break;
			case 'phan-hat': $data["page_menu_index"] = 42; break;
			case 'nam-phung-vu': $data["page_menu_index"] = 43; break;
			default: $data["page_menu_index"] = 30; break;
		}

		$data["page_title"] = "Chuyên mục";

		if ( isset($_GET["action"]) ) {
			if ( $_GET["action"] == "edit" ) {
				$id_song = $this->input->get('id');
				$data["slug"] = $this->input->get('slug');
				$data["cat"] = $this->model_cat->get($id_song);
				$data["page_view"] = "category_edit";

				$this->load->view("layout", $data);

			} else if ( $_GET["action"] == "update" ) {
				$id_cat = $this->input->get('id');

				if ($this->input->post('ok') !== NULL) {
					$name = $this->input->post('name');
					$url = $this->input->post('seourl');
					$desc = $this->input->post('des');
					$seotitle = $this->input->post('seotitle');
					$seourl = $slug;
					$seokeywork = $this->input->post('seokeywork');
					$seodesc = $desc;
					$page =$this->input->get('page');

					// UPDATE CAT
					$array_cat_update = [
						"cat_name" => $name,
						"cat_slug" => $url,
						"cat_des" => $desc,
					];
					$this->model_cat->update($id_cat, $array_cat_update);

					// UPDATE META
					$this->model_meta->update_cat($id_cat, 'seotitle', $seotitle);
					$this->model_meta->update_cat($id_cat, 'seourl', $seourl);
					$this->model_meta->update_cat($id_cat, 'seokeywork', $seokeywork);
					$this->model_meta->update_cat($id_cat, 'seodes', $seodesc);

					$data["alert"] = ["success", "Thành công: cập nhật danh mục."];
				} else {
					$data["alert"] = ["warning", "Không có cập nhật."];
				}

				$data["slug"] = $slug;
				$data["cat"] = $this->model_cat->get($id_cat);
				$data["page_view"] = "category_edit";

				$this->load->view("layout", $data);
			} else if ($_GET["action"] == "add") {
				if ($this->input->post('ok') !== NULL) {
					$name = $this->input->post('name');
					$url = $this->input->post('seourl');
					$desc = $this->input->post('des');
					$seotitle = $this->input->post('seotitle');
					$seourl = $slug;
					$seokeywork = $this->input->post('seokeywork');
					$seodesc = $desc;
					$page = $this->input->get('page');

					// ADD CAT
					$array_insert_cat = [
						"id" => "",
						"cat_name" => $name,
						"cat_slug" => $url,
						"cat_des" => $desc,
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
					$this->model_meta->add_cat($id_cat, 'seotitle', $seotitle);
					$this->model_meta->add_cat($id_cat, 'seourl', $seourl);
					$this->model_meta->add_cat($id_cat, 'seokeywork', $seokeywork);
					$this->model_meta->add_cat($id_cat, 'seodes', $seodesc);

					$data["alert"] = ["success", "Thêm danh mục."];
				} else {
					$data["alert"] = ["warning", "Không có thêm danh mục."];
				}

				$page = $this->input->get('page');
				$number_cat_on_page = 10;
				$start = ($page - 1) * $number_cat_on_page;
				$count = $this->model_cat->count($slug);
				$number_pagination = ceil($count / $number_cat_on_page);

				for ($i=1; $i <= $number_pagination ; $i++) {
					$active = $i == $page ? 1 : 0;
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
		} else if ( isset($_GET["cat_id"]) ) {
				$page = $this->input->get('page');
				$cat_id = $this->input->get('cat_id');
				$cat_info = $this->model_cat->get($cat_id);
				$cat_name = mb_strtoupper($cat_info["cat_name"]);
				$number_song_on_page = 20;
				$count_song = $this->model_song->count($cat_id);
				$number_pagination = ceil($count_song / $number_song_on_page);

				for ($i = 1; $i <= $number_pagination ; $i++) {
					$active = $i == $page ? 1 : 0;
					$arr_pagination[] = [
						"number" => $i,
						"link" => base_url("/category?slug={$slug}&cat_id={$cat_id}&page={$i}"),
						"active" => $active,
					];
				}

				$isWeekly = in_array($slug, ["phan-hat", "nam-phung-vu"]);
				$page_start = ($page - 1) * $number_song_on_page;
				$data["pagination_song"] = $arr_pagination;
				$data["list_song"] = $this->model_song->getlistoncat($cat_id, $page_start, $number_song_on_page);
				$data["list_weekly"] = $this->model_weekly->getlistoncat($cat_id, $page_start, $number_song_on_page);
				$data["page_title"] = "Chuyên mục {$cat_name}";
				$data["page_view"] = $isWeekly ? "category_weekly" : "category_song";

				$this->load->view("layout", $data);
		} else {
			$page = $this->input->get('page');
			$number_cat_on_page = 10;
			$start = ($page - 1) * $number_cat_on_page;
			$count = $this->model_cat->count($slug);
			$number_pagination = ceil($count / $number_cat_on_page);

			for ($i=1; $i <= $number_pagination ; $i++) {
				$active = $i == $page ? 1 : 0;
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
}