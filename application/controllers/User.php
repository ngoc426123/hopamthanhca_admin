<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		if ($this->session->permission != 1) {
			$this->load->view("layout-not-permission");
			return;
		}

		$this->load->model('model_user');

		if ( isset($_GET["action"]) ) {
			if ( $_GET["action"]=="add" ) {
				if ($this->input->post('ok') !== NULL) {
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$passwordMD5 = md_pass($password);
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$displayname = $this->input->post('displayname');
					$checkadmin = $this->input->post('checkadmin');
					$array_insert_user = [
						"id" => "",
						"username" => $username,
						"password" => $passwordMD5,
						"name" => $name,
						"email" => $email,
						"dateregister" => get_date_now(),
						"displayname" => $displayname,
						"permission" => $checkadmin ? 1 : 0,
					];
	
					$this->model_user->add($array_insert_user);
					$data["alert"] = ["success", "Thêm thành viên, username : <b>{$username}</b> mật khẩu : <b>{$password}</b>."];
				}

				$data["page_menu_index"] = 4;
				$data["page_title"] = "Thêm thành viên";
				$data["page_view"] = "user_add";

				$this->load->view("layout", $data);

			} else if ( $_GET["action"]=="edit" ) {
				$id = $this->input->get('id');
				$data["id"] = $id;
				$data["user"] = $this->model_user->get($id);
				$data["page_menu_index"] = 4;
				$data["page_title"] = "Cập nhật thành viên";
				$data["page_view"] = "user_edit";

				$this->load->view("layout", $data);

			} else if ( $_GET["action"]=="update" ) {
				if ($this->input->post('ok') !== NULL) {
					$id = $this->input->get('id');
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$displayname = $this->input->post('displayname');
					$checkadmin = $this->input->post('checkadmin');
					$array_update_user = [
						"name" => $name,
						"email" => $email,
						"displayname" => $displayname,
						"permission" => $checkadmin ? 1 : 0,
					];

					$this->model_user->update($id, $array_update_user);
					$data["alert"] = ["success", "Cập nhật thành viên."];

					if ($this->input->post('checkChangePass') !== NULL) {
						$password = $this->input->post('password');
						$passwordAgain = $this->input->post('passwordAgain');

						if ($password != $passwordAgain) {
							$data["alert"] = ["danger", "Mật khẩu nhập lại không giống nên không cập nhật mật khẩu"];
						} else {
							$password = md_pass($password);
							$return = $this->model_user->changepassword($id, $password);
							$data["alert"] = ["success", "Cập nhật thành viên, bạn đã đổi mật khẩu thành <b>{$passwordAgain}</b>"];
						}
					}
				} else {
					$data["alert"] = ["warning", "Bạn không cập nhật gì cả."];
				}

				$data["id"] = $id;
				$data["user"] = $this->model_user->get($id);
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

		$id = $this->input->post('id');
		$permission = $this->input->post('permission');
		$return = $this->model_user->changepermission($id, $permission);

		die();
	}

	public function changepassword() {
		$this->load->model('model_user');
	
		$id = $this->input->post('id');
		$passNew = md_pass($this->input->post('passNew'));
		$return = $this->model_user->changepassword($id, $passNew);

		die();
	}
}