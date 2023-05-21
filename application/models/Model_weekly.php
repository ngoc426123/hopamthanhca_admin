<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_weekly extends CI_Model {
  public function get($id) {
    $this->load->database();
    $this->load->database();
		$this->db->select("*");
		$this->db->from("weekly");
		$this->db->where([
			"id" => $id,
		]);
		$get = $this->db->get();
		$result = $get->row_array();

    return $result;
  }

  public function add($array) {
    $this->load->database();
    $this->db->insert('weekly', $array);
    
    return $this->db->insert_id();
  }

  public function update($id, $array_update) {
    $this->load->database();
		$this->db->set($array_update);
		$this->db->where([
			"id" => $id,
		]);
		$this->db->update("weekly");
  }

  public function del($id) {
    $this->load->database();
		$this->db->where([
			"id" => $id,
		]);
		$this->db->delete("weekly");
  }
}