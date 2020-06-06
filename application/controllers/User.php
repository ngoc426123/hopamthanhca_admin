<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
		check_admin_rdr();
	}

	public function index(){
		$this->load->model('model_user');
		if ( isset($_GET["action"]) ) {
			if ( $_GET["action"]=="add" ) {
				if ( isset($_POST["ok"]) ) {
					$password = md_pass($_POST["username"]);
					$array_insert_user = [
						"id" => "",
						"username" => $_POST["username"],
						"password" => $password,
						"name"     => $_POST["name"],
						"email"    => $_POST["email"],
						"dateregister" => get_date_now(),
						"displayname"  => $_POST["displayname"],
						"permission"   => (isset($_POST["checkadmin"])) ? 1 : 0,
					];
					$this->model_user->add($array_insert_user);
					$data["alert"] = ["success", "Thêm thành viên, username : <b>{$_POST["username"]}</b> mật khẩu : <b>{$_POST["password"]}</b>."];
				}

				$data["page_menu_index"] = 4;
				$data["page_title"] = "Thêm thành viên";
				$data["page_view"] = "user_add";
				$this->load->view("layout", $data);

			} else if ( $_GET["action"]=="edit" ) {
				$data["id"] = $_GET["id"];
				$data["user"] = $this->model_user->get($_GET["id"]);
				$data["page_menu_index"] = 4;
				$data["page_title"] = "Cập nhật thành viên";
				$data["page_view"] = "user_edit";
				$this->load->view("layout", $data);

			} else if ( $_GET["action"]=="update" ) {
				if ( isset($_POST["ok"]) ) {
					$id = $_GET["id"];
					$array_update_user = [
						"name"     => $_POST["name"],
						"email"    => $_POST["email"],
						"displayname"  => $_POST["displayname"],
						"permission"   => (isset($_POST["checkadmin"])) ? 1 : 0,
					];
					$this->model_user->update($id, $array_update_user);
					$data["alert"] = ["success", "Cập nhật thành viên."];

					if ( isset($_POST["checkChangePass"]) ) {
						$id = $_GET["id"];
						$password = $_POST["password"];
						$passwordAgain = $_POST["passwordAgain"];
						if( $password != $passwordAgain ) {
							$data["alert"] = ["danger", "Mật khẩu nhập lại không giống nên không cập nhật mật khẩu"];
						} else {
							$password=md_pass($password);
							$return = $this->model_user->changepassword($id, $password);
							$data["alert"] = ["success", "Cập nhật thành viên, bạn đã đổi mật khẩu thành <b>{$passwordAgain}</b>"];
						}
					}
				} else {
					$data["alert"] = ["warning", "Bạn không cập nhật gì cả."];
				}
				$data["id"] = $_GET["id"];
				$data["user"] = $this->model_user->get($_GET["id"]);
				$data["page_menu_index"] = 4;
				$data["page_title"] = "Cập nhật thành viên";
				$data["page_view"] = "user_edit";
				$this->load->view("layout", $data);
			}
		} else {
			$data["list_user"] = $this->model_user->getlist();
			$data["page_menu_index"] = 4;
			$data["page_title"] = "Thành viên";
			$data["page_view"] = "user";
			$this->load->view("layout", $data);
		}
	}

	public function changepermission() {
		$this->load->model('model_user');
		$id         = $_POST["id"];
		$permission = $_POST["permission"];
		$return = $this->model_user->changepermission($id, $permission);
		die();
	}

	public function changepassword() {
		$this->load->model('model_user');
		$id         = $_POST["id"];
		$passNew    = md_pass($_POST["passNew"]);
		$return = $this->model_user->changepassword($id, $passNew);
		die();
	}
}