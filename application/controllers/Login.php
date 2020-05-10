<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view("login");
	}

	public function check(){
		$this->load->model("model_login");
		echo $this->model_login->check($_POST['username'], $_POST['password']);
		die();
	}

	public function logout(){
		$this->load->model("model_login");
		$this->model_login->logout();
		$this->load->view("login");
	}
}
