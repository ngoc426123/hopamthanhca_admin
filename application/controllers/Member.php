<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$this->load->model('model_user');
		$id = $this->session->id;

		if ($_GET["action"]=="editprofile") {
			$data["id"] = $id;
			$data["user"] = $this->model_user->get($id);
			$data["page_title"] = "Cập nhật thông tin";
			$data["page_view"] = "member_edit";
			$this->load->view("layout", $data);

		} else if ($_GET["action"]=="updateprofile") {
			if ($this->input->post('ok') !== NULL) {
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$displayName = $this->input->post('displayname');
				$array_update_user = [
					"name" => $name,
					"email" => $email,
					"displayname"  => $displayName,
				];

				$this->model_user->update($id, $array_update_user);
				$data["alert"] = ["success", "Cập nhật thành viên."];
			} else {
				$data["alert"] = ["warning", "Bạn không cập nhật gì cả."];
			}

			$data["id"] = $id;
			$data["user"] = $this->model_user->get($id);
			$data["page_title"] = "Cập nhật thông tin";
			$data["page_view"] = "member_edit";

			$this->load->view("layout", $data);
		} else if ( $_GET["action"]=="changepassword" ) {
			if ($this->input->post('ok') !== NULL) {
				$passOld = $this->input->post('passwordOld');
				$passOld = md_pass($passOld);
				$passNew = $this->input->post('password');
				$passAgain = $this->input->post('passwordAgain');

				if (!$this->model_user->checkpass($id, $passOld)) {
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