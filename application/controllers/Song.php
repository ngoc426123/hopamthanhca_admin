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
			if ($_GET['action'] == 'edit') {
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

			} else if ($_GET['action'] == 'update') {
				if ( isset($_POST['update']) ) {
					$this->load->model(['model_song' , 'model_meta', 'model_option']);
					$data["setting"] = [
						"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
						"post_defaultcategory"=> json_decode("{$this->model_option->get('post_defaultcategory')}", true),
					];
					$song_id = $_GET['id'];
					// UPDATE SONG
					$array_song_update = [
						"title" => $_POST['title'],
						"slug" => $_POST['seourl'],
						"content" => $_POST['content'],
						"excerpt" => $_POST['excerpt'],
						"status" => (isset($_POST['status']))?'publish':'private',
					];
					$this->model_song->update($song_id, $array_song_update);

					// UPDATE CATEGORY
					$array_danhmuc = [];
					$arr_chuyenmuc = (isset($_POST['chuyenmuc'])) ? $_POST['chuyenmuc'] : [$data["setting"]["post_defaultcategory"]["chuyen-muc"]];
					$arr_tacgia = (isset($_POST['tacgia'])) ? $_POST['tacgia'] : [$data["setting"]["post_defaultcategory"]["tac-gia"]];
					$arr_bangchucai = (isset($_POST['bangchucai'])) ? $_POST['bangchucai'] : [$data["setting"]["post_defaultcategory"]["bang-chu-cai"]];
					$arr_dieubaihat = (isset($_POST['dieubaihat'])) ? $_POST['dieubaihat'] : [$data["setting"]["post_defaultcategory"]["dieu-bai-hat"]];
					$array_danhmuc = array_merge($array_danhmuc, $arr_chuyenmuc, $arr_tacgia, $arr_bangchucai, $arr_dieubaihat);
					$this->model_song->update_songcat($song_id, $array_danhmuc);

					// UPDATE META
					$this->model_meta->update($song_id, 'seotitle', $_POST['seotitle']);
					$this->model_meta->update($song_id, 'seourl', $_POST['seourl']);
					$this->model_meta->update($song_id, 'seodes', $_POST['seodes']);
					$this->model_meta->update($song_id, 'seokeywork', $_POST['seokeywork']);
					$this->model_meta->update($song_id, 'pdffile', $_POST['pdffile']);
					$this->model_meta->update($song_id, 'hopamchinh', $_POST['hopamchinh']);
					$data["alert"] = ["success", "Thành công: cập nhật bài hát."];
				} else {
					$data["alert"] = ["warning", "Không có cập nhật."];
				}
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
				$this->load->model(["model_song", "model_meta", "model_cat", 'model_option']);
				$data["setting"] = [
					"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
					"post_defaultcategory"=> json_decode("{$this->model_option->get('post_defaultcategory')}", true),
				];
				if ( isset($_POST['ok']) ) {
					// INSERT SONG
					$array_insert_song = [
						'id'      => '',
						'title'   => $_POST["title"],
						'slug'    => $_POST['seourl'],
						'date'    => (isset($_POST['date']))?$_POST['date']:get_date_now(),
						'content' => $_POST['content'],
						'excerpt' => $_POST['excerpt'],
						'author'  => $this->session->id,
						'status'  => (isset($_POST['status']))?"publish":"private",
					];
					$insert_song_id = $this->model_song->add($array_insert_song);
					
					// INSERT CAT
					$array_danhmuc = [];
					$arr_chuyenmuc = (isset($_POST['chuyenmuc'])) ? $_POST['chuyenmuc'] : [$data["setting"]["post_defaultcategory"]["chuyen-muc"]];
					$arr_tacgia = (isset($_POST['tacgia'])) ? $_POST['tacgia'] : [$data["setting"]["post_defaultcategory"]["tac-gia"]];
					$arr_bangchucai = (isset($_POST['bangchucai'])) ? $_POST['bangchucai'] : [$data["setting"]["post_defaultcategory"]["bang-chu-cai"]];
					$arr_dieubaihat = (isset($_POST['dieubaihat'])) ? $_POST['dieubaihat'] : [$data["setting"]["post_defaultcategory"]["dieu-bai-hat"]];
					$array_danhmuc = array_merge($array_danhmuc, $arr_chuyenmuc, $arr_tacgia, $arr_bangchucai, $arr_dieubaihat);
					$this->model_song->add_songcat($insert_song_id, $array_danhmuc);

					// INSERT META
					$this->model_meta->add($insert_song_id, 'seotitle', $_POST['seotitle']);
					$this->model_meta->add($insert_song_id, 'seourl', $_POST['seourl']);
					$this->model_meta->add($insert_song_id, 'seodes', $_POST['seodes']);
					$this->model_meta->add($insert_song_id, 'seokeywork', $_POST['seokeywork']);
					$this->model_meta->add($insert_song_id, 'pdffile', $_POST['pdffile']);
					$this->model_meta->add($insert_song_id, 'hopamchinh', $_POST['hopamchinh']);
					$this->model_meta->add($insert_song_id, 'luotxem', 0);
					$this->model_meta->add($insert_song_id, 'lovesong', 0);

					$data["alert"] = ["success", "Thêm bài thành công."];
				}
				
				$data["cat"]["chuyen-muc"] = $this->model_cat->getlist("chuyen-muc");
				$data["cat"]["tac-gia"] = $this->model_cat->getlist("tac-gia");
				$data["cat"]["bang-chu-cai"] = $this->model_cat->getlist("bang-chu-cai");
				$data["cat"]["dieu-bai-hat"] = $this->model_cat->getlist("dieu-bai-hat");
				$data["page_title"] = "Thêm bài hát";
				$data["page_view"] = "song_add";
				$this->load->view("layout", $data);
			} else if ($_GET['action'] == 'search') {
				if ( isset($_GET['keyword']) ) {
					$this->load->model("model_song");
					$keyword = $_GET['keyword'];
					$data["list_song"] = $this->model_song->getbykeyword($keyword);
					$data["page_title"] = "Bài hát";
					$data["page_view"] = "song";
					$this->load->view("layout", $data);
				} else {
					
				}
				
			}
		} else {
			$page = $_GET['page'] || 1;
			if (isset($_GET['quickedit'])) {
				$this->load->model(['model_song','model_cat' , 'model_meta']);
				$song_id =$_GET['quickedit'];
				// UPDATE SONG
				$array_song_update = [
					"title" => $_POST['title'],
					"slug" => $_POST['seourl'],
					"status" => (isset($_POST['status']))?'publish':'private',
					"excerpt" => $_POST['excerpt'],
				];
				$this->model_song->update($song_id, $array_song_update);

				// UPDATE CATEGORY
				$array_danhmuc = $_POST['danhmuc'];
				$this->model_song->update_songcat($song_id, $array_danhmuc);

				// UPDATE META
				$this->model_meta->update($song_id, 'seotitle', $_POST['seotitle']);
				$this->model_meta->update($song_id, 'seourl', $_POST['seourl']);
				$this->model_meta->update($song_id, 'seodes', $_POST['seodes']);
				$this->model_meta->update($song_id, 'seokeywork', $_POST['seokeywork']);
				$this->model_meta->update($song_id, 'pdffile', $_POST['pdffile']);
				$this->model_meta->update($song_id, 'hopamchinh', $_POST['hopamchinh']);
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
			$data["list_song"] = $this->model_song->getlist($page_start, $number_song_on_page);
			$data["page_title"] = "Bài hát";
			$data["page_view"] = "song";
			$this->load->view("layout", $data);
		}
	}

	public function get_quick_song(){
		$this->load->model(['model_song','model_cat', 'model_meta']);
		$song = $this->model_song->get($_GET['id']);
		$danhmuc['chuyenmuc'] = $this->model_cat->getlist("chuyen-muc");
		$danhmuc['tacgia'] = $this->model_cat->getlist("tac-gia");
		$danhmuc['bangchucai'] = $this->model_cat->getlist("bang-chu-cai");
		$danhmuc['dieubaihat'] = $this->model_cat->getlist("dieu-bai-hat");
		$json = json_encode(array_merge($song, $danhmuc));
		$json = preg_replace("/chuyen-muc/", "chuyen_muc", $json);
		$json = preg_replace("/bang-chu-cai/", "bang_chu_cai", $json);
		$json = preg_replace("/tac-gia/", "tac_gia", $json);
		$json = preg_replace("/dieu-bai-hat/", "dieu_bai_hat", $json);
		echo $json;
		die();
	}

	public function del() {
		$id = $_POST["id"];
		$this->load->model('model_song');
		$this->model_song->del($id);
		echo "done";
		die();
	}

	public function listAllSongs() {
		$this->load->model(['model_song']);
		$count = $this->model_song->count();
		echo json_encode($this->model_song->getlist(0, $count), JSON_UNESCAPED_UNICODE);
	}
}