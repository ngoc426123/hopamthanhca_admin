<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_meta extends CI_Model {
	public function get($table, $id, $key) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where([
			"id_{$table}" => $id,
			"key"     => $key
		]);
		$get = $this->db->get();
		return $get->row_array();
	}

	public function getmeta($table, $id) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where([
			"id_{$table}" => $id
		]);
		$get = $this->db->get();
		return $get->result_array();
	}

	public function update($table, $id, $key, $value) {
		$array_condition = [
			"id_{$table}" => $id,
			"key"         => $key,
		];
		$array_update = [
			"value"  => $value,
		];
		$this->load->database();
		$this->db->set($array_update);
		$this->db->where($array_condition);
		$this->db->update("{$table}meta");
	}

	public function add($table, $id, $key, $value) {
		$this->load->database();
		$this->db->insert("{$table}meta", [
			"id"          => "",
			"id_{$table}" => $id,
			"key"         => $key,
			"value"       => $value,
		]);
	}

	public function update_cat($id, $key, $value) {
		$array_condition = [
			"id_cat" => $id,
			"key"     => $key,
		];
		$array_update = [
			"value"  => $value,
		];
		$this->load->database();
		$this->db->set($array_update);
		$this->db->where($array_condition);
		$this->db->update("catmeta");
	}

	public function add_cat($id, $key, $value) {
		$this->load->database();
		$this->db->insert("catmeta", [
			"id"      => "",
			"id_cat" => $id,
			"key"     => $key,
			"value"   => $value,
		]);
	}
}