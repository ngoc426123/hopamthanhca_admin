<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song extends CI_Controller {
	private $userID;
	private $userPermission;

	public function __construct(){
		parent::__construct();
		$this->userID = $this->session->id;
		$this->userPermission = $this->session->permission;
	}

	public function index(){
		$data["page_menu_index"] = 2;

		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'edit') {
				$this->load->model(["model_song", "model_cat"]);
				$song_id = $this->input->get('id');

				$data["song"] = $this->model_song->get($song_id);
				$data["cat"]["chuyen-muc"] = $this->model_cat->getlist("chuyen-muc");
				$data["cat"]["tac-gia"] = $this->model_cat->getlist("tac-gia");
				$data["cat"]["bang-chu-cai"] = $this->model_cat->getlist("bang-chu-cai");
				$data["cat"]["dieu-bai-hat"] = $this->model_cat->getlist("dieu-bai-hat");
				$data["page_title"] = "Sửa bài hát";
				$data["page_view"] = "song_edit";

				if ($this->userPermission == 1)
					$this->load->view("layout", $data);
				else {
					$author = $data["song"]["author"] ?? -1;
					$view = $this->userID == $author ? "layout" : "layout-not-permission";

					$this->load->view($view, $data);
				}
			} else if ($_GET['action'] == 'update') {
				$this->load->model(["model_song", "model_cat", "model_meta", "model_option"]);

				$song_id = $this->input->get('id');

				if ($this->input->post('update') !== NULL) {
					$title = $this->input->post('title');
					$slug = $this->input->post('seourl');
					$content = $this->input->post('content');
					$excerpt = $this->input->post('excerpt');
					$status = $this->input->post('status');
					$chuyenmuc = $this->input->post('chuyenmuc');
					$tacgia = $this->input->post('tacgia');
					$bangchucai = $this->input->post('bangchucai');
					$dieubaihat = $this->input->post('dieubaihat');
					$seotitle = $this->input->post('seotitle');
					$seourl = $slug;
					$seodes = $this->input->post('seodes');
					$seokeywork = $this->input->post('seokeywork');
					$pdffile = $this->input->post('pdffile');
					$hopamchinh = $this->input->post('hopamchinh');

					$data["setting"] = [
						"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
						"post_defaultcategory"=> unserialize($this->model_option->get('post_defaultcategory')),
					];
					
					// UPDATE SONG
					$array_song_update = [
						"title"   => $title,
						"slug"    => $slug,
						"content" => $content,
						"excerpt" => $excerpt,
						'status'  => $status ? "publish" : "private",
					];
					$this->model_song->update($song_id, $array_song_update);

					// UPDATE CATEGORY
					$array_danhmuc = [];
					$arr_chuyenmuc = $chuyenmuc ?? [$data["setting"]["post_defaultcategory"]["chuyen-muc"]];
					$arr_tacgia = $tacgia ?? [$data["setting"]["post_defaultcategory"]["tac-gia"]];
					$arr_bangchucai = $bangchucai ?? [$data["setting"]["post_defaultcategory"]["bang-chu-cai"]];
					$arr_dieubaihat = $dieubaihat ?? [$data["setting"]["post_defaultcategory"]["dieu-bai-hat"]];
					$array_danhmuc = array_merge($array_danhmuc, $arr_chuyenmuc, $arr_tacgia, $arr_bangchucai, $arr_dieubaihat);

					$this->model_song->update_songcat($song_id, $array_danhmuc);

					// UPDATE META
					$this->model_meta->update('song', $song_id, 'seotitle', $seotitle);
					$this->model_meta->update('song', $song_id, 'seourl', $seourl);
					$this->model_meta->update('song', $song_id, 'seodes', $seodes);
					$this->model_meta->update('song', $song_id, 'seokeywork', $seokeywork);
					$this->model_meta->update('song', $song_id, 'pdffile', $pdffile);
					$this->model_meta->update('song', $song_id, 'hopamchinh', $hopamchinh);

					$data["alert"] = ["success", "Thành công: cập nhật bài hát."];
				} else {
					$data["alert"] = ["warning", "Không có cập nhật."];
				}

				$data["song"] = $this->model_song->get($song_id);
				$data["cat"]["chuyen-muc"] = $this->model_cat->getlist("chuyen-muc");
				$data["cat"]["tac-gia"] = $this->model_cat->getlist("tac-gia");
				$data["cat"]["bang-chu-cai"] = $this->model_cat->getlist("bang-chu-cai");
				$data["cat"]["dieu-bai-hat"] = $this->model_cat->getlist("dieu-bai-hat");
				$data["page_title"] = "Sửa bài hát";
				$data["page_view"] = "song_edit";
				if ($this->userPermission == 1)
					$this->load->view("layout", $data);
				else {
					$view = $this->userID == $data["song"]["author"] ? "layout" : "layout-not-permission";
					$this->load->view($view, $data);
				}
			} else if ($_GET['action'] == 'add') {
				$this->load->model(["model_song", "model_meta", "model_cat", 'model_option']);

				$data["setting"] = [
					"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
					"post_defaultcategory"=> unserialize($this->model_option->get('post_defaultcategory')),
				];

				if ($this->input->post('ok') !== NULL) {
					$title = $this->input->post('title');
					$slug = $this->input->post('seourl');
					$date = $this->input->post('date');
					$content = $this->input->post('content');
					$excerpt = $this->input->post('excerpt');
					$status = $this->input->post('status');
					$chuyenmuc = $this->input->post('chuyenmuc');
					$tacgia = $this->input->post('tacgia');
					$bangchucai = $this->input->post('bangchucai');
					$dieubaihat = $this->input->post('dieubaihat');
					$seotitle = $this->input->post('seotitle');
					$seourl = $slug;
					$seodes = $this->input->post('seodes');
					$seokeywork = $this->input->post('seokeywork');
					$pdffile = $this->input->post('pdffile');
					$hopamchinh = $this->input->post('hopamchinh');

					// INSERT SONG
					$array_insert_song = [
						'id'      => '',
						'title'   => $title,
						'slug'    => $slug,
						'date'    => $date ?? get_date_now(),
						'content' => $content,
						'excerpt' => $excerpt,
						'author'  => $this->session->id,
						'status'  => $status ? "publish" : "private",
					];
					$insert_song_id = $this->model_song->add($array_insert_song);
					
					// INSERT CAT
					$array_danhmuc = [];
					$arr_chuyenmuc = $chuyenmuc ?? [$data["setting"]["post_defaultcategory"]["chuyen-muc"]];
					$arr_tacgia = $tacgia ?? [$data["setting"]["post_defaultcategory"]["tac-gia"]];
					$arr_bangchucai = $bangchucai ?? [$data["setting"]["post_defaultcategory"]["bang-chu-cai"]];
					$arr_dieubaihat = $dieubaihat ?? [$data["setting"]["post_defaultcategory"]["dieu-bai-hat"]];
					$array_danhmuc = array_merge($array_danhmuc, $arr_chuyenmuc, $arr_tacgia, $arr_bangchucai, $arr_dieubaihat);

					$this->model_song->add_songcat($insert_song_id, $array_danhmuc);

					// INSERT META
					$this->model_meta->add('song', $insert_song_id, 'seotitle', $seotitle);
					$this->model_meta->add('song', $insert_song_id, 'seourl', $seourl);
					$this->model_meta->add('song', $insert_song_id, 'seodes', $seodes);
					$this->model_meta->add('song', $insert_song_id, 'seokeywork', $seokeywork);
					$this->model_meta->add('song', $insert_song_id, 'pdffile', $pdffile);
					$this->model_meta->add('song', $insert_song_id, 'hopamchinh', $hopamchinh);
					$this->model_meta->add('song', $insert_song_id, 'luotxem', 0);
					$this->model_meta->add('song', $insert_song_id, 'lovesong', 0);

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

					$keyword = 	$this->input->get('keyword');

					$data["list_song"] = $this->model_song->getbykeyword($keyword);
					$data["page_title"] = "Bài hát";
					$data["page_view"] = "song";

					$this->load->view("layout", $data);
				}
			}
		} else {
			if (isset($_GET['quickedit'])) {
				$this->load->model(['model_song','model_cat' , 'model_meta']);
				$song_id = $this->input->get('quickedit');
				$title = $this->input->post('title');
				$slug = $this->input->post('seourl');
				$status = $this->input->post('status');
				$excerpt = $this->input->post('excerpt');
				$seotitle = $this->input->post('seotitle');
				$seourl = $slug;
				$seodes = $this->input->post('seodes');
				$seokeywork = $this->input->post('seokeywork');
				$pdffile = $this->input->post('pdffile');
				$hopamchinh = $this->input->post('hopamchinh');
				$array_danhmuc = $this->input->post('danhmuc');

				// UPDATE SONG
				$array_song_update = [
					"title"   => $title,
					"slug"    => $slug,
					"status"  => isset($status) ? 'publish' : 'private',
					"excerpt" => $excerpt,
				];
				$this->model_song->update($song_id, $array_song_update);

				// UPDATE CATEGORY
				$this->model_song->update_songcat($song_id, $array_danhmuc);

				// UPDATE META
				$this->model_meta->update('song', $song_id, 'seotitle', $seotitle );
				$this->model_meta->update('song', $song_id, 'seourl', $seourl);
				$this->model_meta->update('song', $song_id, 'seodes', $seodes);
				$this->model_meta->update('song', $song_id, 'seokeywork', $seokeywork);
				$this->model_meta->update('song', $song_id, 'pdffile', $pdffile);
				$this->model_meta->update('song', $song_id, 'hopamchinh', $hopamchinh);
			}

			$this->load->model("model_song");

			$page = $this->input->get('page');
			$arr_pagination = array();
			$number_song_on_page = 20;
			$count_song = $this->model_song->count();
			$number_pagination = ceil($count_song / $number_song_on_page);

			for ($i=1; $i <= $number_pagination ; $i++) {
				$active = $i == $page ? 1 : 0;
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

		$id = $this->input->get('id');
		$song = $this->model_song->get($id);
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
		$id = $this->input->post('id');

		$this->load->model('model_song');
		$this->model_song->del($id);

		echo "done";
		die();
	}

	public function listAllSongs() {
		$this->load->model(['model_song']);

		echo json_encode($this->model_song->getlist(), JSON_UNESCAPED_UNICODE);
		die();
	}
}