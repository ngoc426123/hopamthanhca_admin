<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$this->load->model('model_user');
		if ( $_GET["action"]=="editprofile" ) {
			$data["id"] = $this->session->id;
			$data["user"] = $this->model_user->get($this->session->id);
			$data["page_title"] = "Cập nhật thông tin";
			$data["page_view"] = "member_edit";
			$this->load->view("layout", $data);

		} else if ( $_GET["action"]=="updateprofile" ) {
			if ( isset($_POST["ok"]) ) {
				$id = $this->session->id;
				$array_update_user = [
					"name"     => $_POST["name"],
					"email"    => $_POST["email"],
					"displayname"  => $_POST["displayname"],
				];
				$this->model_user->update($id, $array_update_user);
				$data["alert"] = ["success", "Cập nhật thành viên."];
			} else {
				$data["alert"] = ["warning", "Bạn không cập nhật gì cả."];
			}

			$data["id"] = $this->session->id;
			$data["user"] = $this->model_user->get($this->session->id);
			$data["page_title"] = "Cập nhật thông tin";
			$data["page_view"] = "member_edit";
			$this->load->view("layout", $data);
			
		} else if ( $_GET["action"]=="changepassword" ) {
			if ( isset($_POST["ok"]) ) {
				$id = $this->session->id;
				$passOld = md_pass($_POST["passwordOld"]);
				$passNew = $_POST["password"];
				$passAgain = $_POST["passwordAgain"];

				if ( !$this->model_user->checkpass($this->session->id, $passOld) ) {
					$data["alert"] = ["warning", "Mật khẩu cũ sai"];
				} else if ( $passNew != $passAgain ) {
					$data["alert"] = ["warning", "Mật khẩu nhập lại sai"];
				} else {
					$passNew = md_pass($passNew);
					$this->model_user->changepassword($id, $passNew);
					$data["alert"] = ["success", "Cập nhật mật khẩu."];
				}
			}

			$data["page_title"] = "Cập nhật mật khẩu";
			$data["page_view"] = "member_changepass";
			$this->load->view("layout", $data);
		}
	}
}