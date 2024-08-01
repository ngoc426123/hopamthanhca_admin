<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weekly extends CI_Controller {
  public function __construct(){
		parent::__construct();
	}

  public function index () {
    $data["page_menu_index"] = 41;

    if (isset($_GET['action'])) {
      if ($_GET['action'] === 'add') {
        $this->load->model(['model_weekly', 'model_meta', 'model_cat', 'model_option']);

        $data["setting"] = [
					"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
          "post_defaultcategory"=> unserialize($this->model_option->get('post_defaultcategory'))
				];

        if ($this->input->post('ok') !== NULL) {
          $phaseCat = $this->model_cat->getlist("phan-hat");
          $content = [];
          $title = $this->input->post('title');
          $url = $this->input->post('seourl');
          $date = $this->input->post('date');
          $desc = $this->input->post('desc');
          $note = $this->input->post('note');
          $status = $this->input->post('status');
          $seotitle = $this->input->post('seotitle');
          $seourl = $url;
          $seodesc = $this->input->post('seodes');
          $seokeywork = $this->input->post('seokeywork');
          $chuyenmuc = $this->input->post('chuyenmuc');

          foreach($this->input->post() as $key => $item) {
            foreach ($phaseCat as $value) {
              if (array_search($key, $value)) $content[$key] = $item;
            }
          }

          // INSERT WEEKLY
          $array_insert_weekly = [
            'id'      => '',
            'name'    => $title,
            'slug'    => $url,
            'date'    => $date ?? get_date_now(),
            'content' => serialize($content),
            'desc'    => $desc,
            'note'    => $note,
            'status'  => $status ? 'publish' : 'private',
          ];
          $insert_weekly_id = $this->model_weekly->add($array_insert_weekly);

          // INSERT CAT
          $array_danhmuc = $chuyenmuc ?? $data["setting"]["post_defaultcategory"]["nam-phung-vu"];
          $this->model_weekly->add_weeklycat($insert_weekly_id, $array_danhmuc);

          // INSERT META
          $this->model_meta->add('weekly', $insert_weekly_id, 'seotitle', $seotitle);
					$this->model_meta->add('weekly', $insert_weekly_id, 'seourl', $seourl);
					$this->model_meta->add('weekly', $insert_weekly_id, 'seodes', $seodesc);
					$this->model_meta->add('weekly', $insert_weekly_id, 'seokeywork', $seokeywork);
        
          $data["alert"] = ["success", "Thêm soạn thành công."];
        }

        $data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
        $data["cat"]["phan-hat"] = $this->model_cat->getlist("phan-hat");
        $data["page_title"] = "Soạn mới";
				$data["page_view"] = "weekly_add";
        
				$this->load->view("layout", $data);
      } else if ($_GET['action'] == 'edit') {
				$this->load->model(["model_weekly", "model_cat", "model_song"]);

        $weekly_id = $this->input->get('id');
        $data["weekly"] = $this->model_weekly->get($weekly_id);
        $data["list_song"] = $this->model_song->getlist();
        $data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
        $data["cat"]["phan-hat"] = $this->model_cat->getlist("phan-hat");
        $data["page_title"] = "Sửa phần soạn thánh lễ";
				$data["page_view"] = "weekly_edit";

        $this->load->view("layout", $data);
      } else if ($_GET['action'] == 'update') {
        $this->load->model(['model_weekly', 'model_cat', 'model_song', 'model_meta', 'model_option']);

        $data['setting'] = [
					'post_defaultstatus'=> $this->model_option->get('post_defaultstatus'),
          'post_defaultcategory'=> unserialize($this->model_option->get('post_defaultcategory'))
				];

				if ($this->input->post('update') !== NULL) {
					$phaseCat = $this->model_cat->getlist("phan-hat");
          $weekly_id = $this->input->get('id');
          $content = [];
          $title = $this->input->post('title');
          $url = $this->input->post('seourl');
          $date = $this->input->post('date');
          $desc = $this->input->post('desc');
          $note = $this->input->post('note');
          $status = $this->input->post('status');
          $seotitle = $this->input->post('seotitle');
          $seourl = $url;
          $seodesc = $this->input->post('seodes');
          $seokeywork = $this->input->post('seokeywork');
          $chuyenmuc = $this->input->post('chuyenmuc');

          foreach($_POST as $key => $item) {
            foreach ($phaseCat as $value) {
              if (array_search($key, $value)) $content[$key] = $item;
            }
          }

          // UPDATE WEEKLY
          $array_update_weekly = [
            'name'    => $title,
            'slug'    => $url,
            'date'    => $date ?? get_date_now(),
            'content' => serialize($content),
            'desc'    => $desc,
            'note'    => $note,
            'status'  => $status ? 'publish' : 'private',
          ];

          $this->model_weekly->update($weekly_id, $array_update_weekly);

          // UPDATE WEEKLYCAT
          $array_danhmuc = $chuyenmuc ?? $data["setting"]["post_defaultcategory"]["nam-phung-vu"];
          $this->model_weekly->update_weeklycat($weekly_id, $array_danhmuc);
          
          // UPDATE WEEKLY META
          $this->model_meta->add('weekly', $weekly_id, 'seotitle', $seotitle);
					$this->model_meta->add('weekly', $weekly_id, 'seourl', $seourl);
					$this->model_meta->add('weekly', $weekly_id, 'seodes', $seodesc);
					$this->model_meta->add('weekly', $weekly_id, 'seokeywork', $seokeywork);
					$data["alert"] = ["success", "Thành công: cập nhật bài hát."];
				} else {
					$data["alert"] = ["warning", "Không có cập nhật."];
				}

        $data["weekly"] = $this->model_weekly->get($weekly_id);
        $data["list_song"] = $this->model_song->getlist();
        $data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
        $data["cat"]["phan-hat"] = $this->model_cat->getlist("phan-hat");
        $data["page_title"] = "Sửa phần soạn thánh lễ";
				$data["page_view"] = "weekly_edit";

        $this->load->view("layout", $data);
      } else if ($_GET['action'] == 'search') {
				if ( $this->input->get('keyword') !== NULL ) {
					$this->load->model("model_weekly");

					$keyword = $this->input->get('keyword');
					$data["list_weekly"] = $this->model_weekly->getbykeyword($keyword);
					$data["page_title"] = "Danh sách";
					$data["page_view"] = "weekly";

					$this->load->view("layout", $data);
				}
			}
    } else {
      $this->load->model("model_weekly");

      $page = $this->input->get('page');
      $number_weekly_on_page = 20;
      $count_weekly = $this->model_weekly->count();
      $number_pagination = ceil($count_weekly / $number_weekly_on_page);

      for ($i = 1; $i <= $number_pagination ; $i++) {
				$active = ($i == $page)?1:0;
				$arr_pagination[] = [
					"number" => $i,
					"link" => base_url("weekly?page={$i}"),
					"active" => $active,
				];
			}

			$page_start = ($page - 1) * $number_weekly_on_page;
      $data["pagination_weekly"] = $arr_pagination;
      $data["list_weekly"] = $this->model_weekly->getlist($page_start, $number_weekly_on_page);
      $data["page_title"] = "Danh sách";
      $data["page_view"] = "weekly";

      $this->load->view("layout", $data);
    }
  }

  public function del() {
		$id = $this->input->post('id');

		$this->load->model('model_weekly');
		$this->model_weekly->del($id);

		echo "done";
		die();
	}
}