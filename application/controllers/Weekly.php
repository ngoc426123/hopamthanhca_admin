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

          foreach($phaseCat as $key => $item) {
            if (isset(($_POST[$item['cat_slug']])))
              $content[$item['cat_slug']] = $_POST[$item['cat_slug']];
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
          "post_defaultcategory"=> json_decode("{$this->model_option->get('post_defaultcategory')}", true),
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
      }
    } else {
      $this->load->model("model_weekly");
      
      $page = $_GET['page'] || 1;
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
      $data["page_title"] = "Soạn bài hát";
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