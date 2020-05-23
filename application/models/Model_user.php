<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {
	public function get($id) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where([
			"id" => $id,
		]);
		$get = $this->db->get();
		$result = $get->row_array();

		return $result;
	}

	public function getlist() {
		$this->load->database();

		$this->db->select("id, username, name, email, dateregister, displayname, permission");
		$this->db->from("user");
		$this->db->order_by("id", "ASC");
		
		$get = $this->db->get();
		$result = $get->result_array();

		return $result;
	}

	public function count($type = null) {
		$this->load->database();
		$this->db->select("COUNT(id)");
		$this->db->from("user");
		$get = $this->db->get();
		return $get->row_array()['COUNT(id)'];
	}

	public function add($array) {
		$this->load->database();
		$this->db->insert("user", $array);
		return $this->db->insert_id();
	}

	public function update($id, $array) {
		$this->load->database();
		$this->db->set($array);
		$this->db->where([
			"id" => $id,
		]);
		$this->db->update("user");
	}

	public function checkpass($id, $pass) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where([
			"id" => $id,
			"password" => $pass,
		]);
		$get = $this->db->get();
		return ($get->num_rows() > 0) ? true : false;
	}

	public function changepermission($id, $permission) {
		$this->load->database();
		$this->db->set([
			"permission" => $permission,
		]);
		$this->db->where([
			"id" => $id,
		]);
		$this->db->update("user");
	}

	public function changepassword($id, $passNew) {
		$this->load->database();
		$this->db->set([
			"password" => $passNew,
		]);
		$this->db->where([
			"id" => $id,
		]);
		$this->db->update("user");
	}
}