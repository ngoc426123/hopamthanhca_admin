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
        $this->load->model(['model_cat', 'model_option']);
        $data["setting"] = [
					"post_defaultstatus"=> $this->model_option->get('post_defaultstatus'),
				];

        if ( isset($_POST['ok']) ) {
          pr($_POST);

          $phaseCat = $this->model_cat->getlist("phan-hat");
          $content = [];

          foreach($phaseCat as $key => $item) {
            if (isset(($_POST[$item['cat_slug']])))
              $content[$item['cat_slug']] = $_POST[$item['cat_slug']];
          }



          // ADD WEEKLY
          pr($content);
        }

        $data["cat"]["nam-phung-vu"] = $this->model_cat->getlist("nam-phung-vu");
        $data["cat"]["phan-hat"] = $this->model_cat->getlist("phan-hat");
        $data["page_title"] = "Soạn mới";
				$data["page_view"] = "weekly_add";
				$this->load->view("layout", $data);
      }
    } else {
      $data["page_title"] = "Soạn bài hát";
      $data["page_view"] = "weekly";
      $this->load->view("layout", $data);
    }
  }

  public function add() {
    $this->load->model(['model_weekly']);
    $array = [
      'nhap-le' => [1827, 1862, 875],
      'dap-ca' => [275, 185],
      'dang-le' => [990, 452, 557, 1211],
      'hiep-le' => [228, 1128, 278, 1158, 1710, 2025],
      'ket-le' => [475, 137],
    ];
    $detail = serialize($array);
    $array = [
      'id' => '',
      'id_cat' => 1,
      'name' => 'Mùa thường niên - Chúa nhật thứ I',
      'slug' => 'mua-thuong-nien-chua-nhat-thu-I',
      'content' => $detail,
      'note' => '',
    ];
    $id = $this->model_weekly->add($array);
    echo $id;
  }

  public function update() {
    $this->load->model(['model_weekly']);
    $array = [
      'nhap-le' => [11,200,300],
      'dap-ca' => [70],
      'dang-le' => [115, 1801],
      'hiep-le' => [345,337],
      'ket-le' => [1148],
    ];
    $detail = serialize($array);
    $array = [
      'id_cat' => 4,
      'name' => 'Mùa chay- Chúa nhật thứ II',
      'slug' => 'mua-chay-chua-nhat-thu-II',
      'content' => $detail,
      'note' => '',
    ];
    $id = $this->model_weekly->update(5, $array);
    echo $id;
  }

  public function del() {
    $this->load->model(['model_weekly']);
    $this->model_weekly->del(3);
  }

  public function get() {
    $this->load->model(['model_weekly']);
    pr($this->model_weekly->get(6));
  }

  public function add_cat() {
    $this->load->model(['model_weeklycat']);
  }
}