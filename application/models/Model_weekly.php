<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_weekly extends CI_Model {
  public function get($id) {
    $this->load->database();
		$this->db->select("*");
		$this->db->from("weekly");
		$this->db->where([
			"id" => $id,
		]);
		$get = $this->db->get();
		$result = $get->row_array();

		// META
		$this->db->select("key, value");
		$this->db->from("weeklymeta");
		$this->db->where([
			"id_weekly" => $id
		]);
		$get = $this->db->get();
		$meta_result = $get->result_array();
		foreach ($meta_result as $key_meta => $item_meta) {
			$result["meta"][$item_meta['key']] = $item_meta['value'];
		}

		// CATEGORY
		$this->db->select('*');
		$this->db->from('weeklycat');
		$this->db->join("cattype", "weeklycat.id_cat = cattype.id_cat");
		$this->db->join("type", "cattype.id_type = type.id");
		$this->db->where([
			"weeklycat.id_weekly" => $id
		]);
		$get = $this->db->get();
		$cat = $get->result_array();
		foreach ($cat as $key_cat => $item_cat) {
			$result["cat"][$item_cat['type_slug']][] = $item_cat['id_cat'];
		}
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
		// WEEKLY
		$this->db->where([
			"id" => $id,
		]);
		$this->db->delete("weekly");

		// WEEKLY META
		$this->db->where([
			"id_weekly" => $id,
		]);
		$this->db->delete("weeklymeta");

		// WEEKLY CAT
		$this->db->where([
			"id_weekly" => $id,
		]);
		$this->db->delete("weeklycat");
	}

  public function add_weeklycat($id, $array) {
		foreach ($array as $item) {
			$this->db->insert('weeklycat',[
				"id" => '',
				"id_weekly" => $id,
				"id_cat" => $item
			]);
		}
	}

	public function update_weeklycat($id, $array){
		$this->load->database();

		// DELETE
		$this->db->where([
			"id_weekly" => $id,
		]);
		$this->db->delete('weeklycat');
		
		// INSERT
		foreach ($array as $item) {
			$this->db->insert('weeklycat',[
				"id" => '',
				"id_weekly" => $id,
				"id_cat" => $item
			]);
		}
	}

	public function getlist($offset = -1, $limit = -1) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("weekly");
		$this->db->order_by("id", "DESC");
		if ($offset !== -1 && $limit !== -1)
			$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$weekly_result = $get->result_array();
		foreach ($weekly_result as $key => $item) {
			$id_weekly = $item['id'];
			// META
			$this->db->select("key, value");
			$this->db->from("weeklymeta");
			$this->db->where([
				"id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $key_meta => $item_meta) {
				$weekly_result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}

			// CATEGORY
			$this->db->select('*');
			$this->db->from('weeklycat');
			$this->db->join("cattype", "weeklycat.id_cat = cattype.id_cat");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"weeklycat.id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$weekly_result[$key]["cat"][$item_cat['type_slug']][] = $item_cat;
			}
		}
		return $weekly_result;
	}

	public function getlistoncat($cat_id, $offset = 0, $limit = 5) {
		$this->load->database();
		$this->db->select("* ");
		$this->db->from("weekly");
		$this->db->join("weeklycat", "weeklycat.id_weekly = weekly.id");
		$this->db->where([
			"weeklycat.id_cat" => $cat_id,
		]);
		$this->db->order_by("weekly.id", "DESC");
		$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$weekly_result = $get->result_array();

		foreach ($weekly_result as $key => $item) {
			$id_weekly = $item['id_weekly'];

			// META
			$this->db->select("key, value");
			$this->db->from("weeklymeta");
			$this->db->where([
				"id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $key_meta => $item_meta) {
				$weekly_result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}

			// CATEGORY
			$this->db->select('*');
			$this->db->from('weeklycat');
			$this->db->join("cattype", "weeklycat.id_cat = cattype.id_cat");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"weeklycat.id_weekly" => $id_weekly
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$weekly_result[$key]["cat"][$item_cat['type_slug']][] = $item_cat;
			}
		}
		return $weekly_result;
	}

	public function count($cat_id = 0) {
		$this->load->database();
		$this->db->select("COUNT(weekly.id)");
		$this->db->from("weekly");
		if ( $cat_id != 0 ) {
			$this->db->join("weeklycat", "weeklycat.id_weekly = weekly.id");
			$this->db->join("cat", "cat.id = weeklycat.id_cat");
			$this->db->where([
				"cat.id" => $cat_id,
			]);
		}
		$get = $this->db->get();

		return $get->row_array()['COUNT(weekly.id)'];
	}
}