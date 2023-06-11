<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_login extends CI_Model {
	public function check($username, $password) {
		$this->load->database();

		$username = $username;
		$password = md_pass($password);

		$this->db->select("*");
		$this->db->from("user");
		$this->db->where(array(
			"username" => $username,
			"password" => $password,
		));
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$arr = array(
				"id"           => $result["id"],
				"username"     => $result["username"],
				"name"         => $result["name"],
				"email"        => $result["email"],
				"dateregister" => $result["dateregister"],
				"displayname"  => $result["displayname"],
				"permission"   => $result["permission"],
			);
			$this->session->set_userdata($arr);
			return 1;
		} elseif ($query->num_rows() <= 0) {
			return 0;
		}
		die();
	}

	public function logout() {
		$arr = array(
			"id",
			"username",
			"name",
			"email",
			"dateregister",
			"displayname",
		);
		$this->session->unset_userdata($arr);
	}
}
