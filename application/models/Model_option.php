<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_option extends CI_Model {
	public function get($key) {
		$this->load->database();

		$this->db->select('*');
		$this->db->from('options');
		$this->db->where(['key' => $key]);
		$get = $this->db->get();

		return $get->row_array()["value"];
	}

	public function getall() {
		$return = [];
		$this->load->database();

		$this->db->select('*');
		$this->db->from('options');
		$get = $this->db->get();
		$result = $get->result_array();

		foreach($result as $item) {
			$return[$item['key']] = $item['value'];
		}
		return $return;
	}

	public function update($key, $value) {
		$this->load->database();
		// ADD WHEN NOT EXIST
		$this->db->select('*');
		$this->db->from('options');
		$this->db->where(['key' => $key]);
		$count = $this->db->count_all_results();

		if ($count == 0) {
			$this->load->database();
			$this->db->insert("options", [
				'id' => '',
				'key' => $key,
				'value' => $value,
			]);

			return;
		}

		// UPDATE
		$this->db->set([
			"value" => $value
		]);
		$this->db->where([
			"key" => $key,
		]);
		$this->db->update("options");
	}
}