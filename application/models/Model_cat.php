<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cat extends CI_Model {
	public function get($id) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("cat");
		$this->db->where([
			"id" => $id,
		]);
		$get = $this->db->get();
		return $get->row_array();
	}

	public function getlist($type=null) {
		$this->load->database();

		$this->db->select("*");
		if ($type==null) {
			$this->db->from("cat");
		} else {
			$this->db->from("type");
			$this->db->join("cattype", "type.id = cattype.id_type");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->where([
				"type.type_slug" => $type,
			]);
		}
		
		$get = $this->db->get();
		return  $get->result_array();
	}
}