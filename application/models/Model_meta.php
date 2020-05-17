<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_meta extends CI_Model {
	public function get($id, $key) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("songmeta");
		$this->db->where([
			"id_song" => $id,
			"key"     => $key
		]);
		$get = $this->db->get();
		return $get->row_array();
	}

	public function getmeta($id) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("songmeta");
		$this->db->where([
			"id_song" => $id
		]);
		$get = $this->db->get();
		return $get->result_array();
	}

	public function update($id, $key, $value) {
		$array_condition = [
			"id_song" => $id,
			"key"     => $key,
		];
		$array_update = [
			"value"  => $value,
		];
		$this->load->database();
		$this->db->set($array_update);
		$this->db->where($array_condition);
		$this->db->update("songmeta");
	}

	public function add($id, $key, $value) {
		$this->load->database();
		$this->db->insert("songmeta", [
			"id"      => "",
			"id_song" => $id,
			"key"     => $key,
			"value"   => $value,
		]);
	}
}