<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weekly extends CI_Controller {
  public function __construct(){
		parent::__construct();
	}

  public function index () {
    $data["page_menu_index"] = 41;
    if (isset($_GET['action'])) {
      if ($_GET['action'] === "add") {
        $this->load->model(['model_weekly', 'model_meta', 'model_cat', 'model_option']);
        if ( isset($_POST['ok']) ) {
          $phaseCat = $this->model_cat->getlist("phan-hat");
          $content = [];
          foreach($_POST as $key => $item) {
            foreach ($phaseCat as $value) {
              if (array_search($key, $value)) $content[$key] = $item;
            }
          }
          // INSERT WEEKLY
          $array_insert_weekly = [
            'id'      => '',
            'name'    => $_POST['title'],
            'slug'    => $_POST['seourl'],
            'date'    => (isset($_POST['date'])) ? $_POST['date'] : get_date_now(),
            'content' => serialize($content),
            'desc'    => $_POST['desc'],
            'note'    => $_POST['note'],
            'status'  => (isset($_POST['status']))?'publish':'private',
          ];
          $insert_weekly_id = $this->model_weekly->add($array_insert_weekly);

          // INSERT CAT
          $array_danhmuc = isset($_POST['chuyenmuc']) ? $_POST['chuyenmuc'] : $data["setting"]["post_defaultcategory"]["nam-phung-vu"];
          $this->model_weekly->add_weeklycat($insert_weekly_id, $array_danhmuc);

          // INSERT META
          $this->model_meta->add('weekly', $insert_weekly_id, 'seotitle', $_POST['seotitle']);
					$this->model_meta->add('weekly', $insert_weekly_id, 'seourl', $_POST['seourl']);
					$this->model_meta->add('weekly', $insert_weekly_id, 'seodes', $_POST['seodes']);
					$this->model_meta->add('weekly', $insert_weekly_id, 'seokeywork', $_POST['seokeywork']);
        
          $data["alert"] = ["success", "Thêm soạn thành công."];
        }
        $data["setting"] = [
					"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
          "post_defaultcategory"=> unserialize($this->model_option->get('post_defaultcategory'))
				];
        $data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
        $data["cat"]["phan-hat"] = $this->model_cat->getlist("phan-hat");
        $data["page_title"] = "Soạn mới";
				$data["page_view"] = "weekly_add";
				$this->load->view("layout", $data);
      } else if ($_GET['action'] == 'edit') {
				$this->load->model(["model_weekly", "model_cat", "model_song"]);
        $weekly_id = $_GET['id'];
        $data["weekly"] = $this->model_weekly->get($weekly_id);
        $data["list_song"] = $this->model_song->getlist();
        $data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
        $data["cat"]["phan-hat"] = $this->model_cat->getlist("phan-hat");
        $data["page_title"] = "Sửa phần soạn thánh lễ";
				$data["page_view"] = "weekly_edit";
        $this->load->view("layout", $data);
      } else if ($_GET['action'] == 'update') {
        $this->load->model(["model_weekly", "model_cat", "model_song", "model_meta"]);
				if ( isset($_POST['update']) ) {
					$phaseCat = $this->model_cat->getlist("phan-hat");
          $weekly_id = $_GET['id'];
          $content = [];
          foreach($_POST as $key => $item) {
            foreach ($phaseCat as $value) {
              if (array_search($key, $value)) $content[$key] = $item;
            }
          }
          // UPDATE WEEKLY
          $array_update_weekly = [
            'name'    => $_POST['title'],
            'slug'    => $_POST['seourl'],
            'date'    => (isset($_POST['date'])) ? $_POST['date'] : get_date_now(),
            'content' => serialize($content),
            'desc'    => $_POST['desc'],
            'note'    => $_POST['note'],
            'status'  => (isset($_POST['status']))?'publish':'private',
          ];
          $this->model_weekly->update($weekly_id, $array_update_weekly);
    
          // UPDATE WEEKLYCAT
          $array_danhmuc = isset($_POST['chuyenmuc']) ? $_POST['chuyenmuc'] : $data["setting"]["post_defaultcategory"]["nam-phung-vu"];
          $this->model_weekly->update_weeklycat($weekly_id, $array_danhmuc);
          
          // UPDATE WEEKLY META
          $this->model_meta->add('weekly', $weekly_id, 'seotitle', $_POST['seotitle']);
					$this->model_meta->add('weekly', $weekly_id, 'seourl', $_POST['seourl']);
					$this->model_meta->add('weekly', $weekly_id, 'seodes', $_POST['seodes']);
					$this->model_meta->add('weekly', $weekly_id, 'seokeywork', $_POST['seokeywork']);
					$data["alert"] = ["success", "Thành công: cập nhật bài hát."];
				} else {
					$data["alert"] = ["warning", "Không có cập nhật."];
				}
				$weekly_id = $_GET['id'];
        $data["weekly"] = $this->model_weekly->get($weekly_id);
        $data["list_song"] = $this->model_song->getlist();
        $data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
        $data["cat"]["phan-hat"] = $this->model_cat->getlist("phan-hat");
        $data["page_title"] = "Sửa phần soạn thánh lễ";
				$data["page_view"] = "weekly_edit";
        $this->load->view("layout", $data);
      } else if ($_GET['action'] == 'search') {
				if ( isset($_GET['keyword']) ) {
					$this->load->model("model_weekly");
					$keyword = $_GET['keyword'];
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
      for ($i=1; $i <= $number_pagination ; $i++) {
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
		$id = $_POST["id"];
		$this->load->model('model_weekly');
		$this->model_weekly->del($id);
		echo "done";
		die();
	}
}