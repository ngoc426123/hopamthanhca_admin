<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbroad extends CI_Controller {
	public function __construct(){
		parent::__construct();
		check_login();
	}

	public function index(){
		$this->load->view("layout");
	}
}
