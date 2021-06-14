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
		$result = $get->row_array();

		// META
		$this->db->select("key, value");
		$this->db->from("catmeta");
		$this->db->where([
			"id_cat" => $id
		]);
		$get = $this->db->get();
		$meta_result = $get->result_array();
		foreach ($meta_result as $key_meta => $item_meta) {
			$result["meta"][$item_meta['key']] = $item_meta['value'];
		}

		return $result;
	}

	public function getlist($type = null, $offset = -1, $limit = 10) {
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
			if ( $offset!=-1 ) {
				$this->db->limit($limit, $offset);
			}
		}
		$this->db->order_by('cat.cat_name', 'ASC');
		
		$get = $this->db->get();
		$result = $get->result_array();

		// META
		foreach ($result as $key => $item_cat) {
			$id_cat = $item_cat['id'];
			$this->db->select("key, value");
			$this->db->from("catmeta");
			$this->db->where([
				"id_cat" => $id_cat
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $key_meta => $item_meta) {
				$result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}
		}
		return $result;
	}

	public function count($type = null) {
		$this->load->database();
		$this->db->select("COUNT(cat.id)");
		if ( $type == null ) {
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
		return $get->row_array()['COUNT(cat.id)'];
	}

	public function update($id, $array_update) {
		$this->load->database();
		$this->db->set($array_update);
		$this->db->where([
			"id" => $id,
		]);
		$this->db->update("cat");
	}

	public function add($array) {
		$this->load->database();
		$this->db->insert("cat", $array);
		return $this->db->insert_id();
	}

	public function getcattype($slug) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("type");
		$this->db->where([
			"type_slug" => $slug,
		]);
		$get = $this->db->get();
		return $get->row_array();
	}

	public function addcattype($array) {
		$this->load->database();
		$this->db->insert("cattype", $array);
	}
}