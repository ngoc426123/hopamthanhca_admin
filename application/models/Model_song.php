<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_song extends CI_Model {
	public function get($id) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->where([
			"id" => $id,
		]);
		$get = $this->db->get();
		$result = $get->row_array();

		// META
		$this->db->select("key, value");
		$this->db->from("songmeta");
		$this->db->where([
			"id_song" => $id
		]);
		$get = $this->db->get();
		$meta_result = $get->result_array();
		foreach ($meta_result as $key_meta => $item_meta) {
			$result["meta"][$item_meta['key']] = $item_meta['value'];
		}

		// CATEGORY
		$this->db->select('*');
		$this->db->from('songcat');
		$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
		$this->db->join("type", "cattype.id_type = type.id");
		$this->db->where([
			"songcat.id_song" => $id
		]);
		$get = $this->db->get();
		$cat = $get->result_array();
		foreach ($cat as $key_cat => $item_cat) {
			$result["cat"][$item_cat['type_slug']][] = $item_cat['id_cat'];
		}

		return $result;
	}

	public function getlist($offset = 0, $limit = 5) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->order_by("id", "DESC");
		$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$song_result = $get->result_array();
		foreach ($song_result as $key => $item) {
			$id_song = $item['id'];

			// META
			$this->db->select("key, value");
			$this->db->from("songmeta");
			$this->db->where([
				"id_song" => $id_song
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $key_meta => $item_meta) {
				$song_result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}

			// CATEGORY
			$this->db->select('*');
			$this->db->from('songcat');
			$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"songcat.id_song" => $id_song
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$song_result[$key]["cat"][$item_cat['type_slug']][] = $item_cat['id_cat'];
			}
		}
		return $song_result;
	}

	public function count() {
		$this->load->database();
		$this->db->select("COUNT(id)");
		$this->db->from("song");
		$get = $this->db->get();
		return $get->row_array()['COUNT(id)'];
	}

	public function update($id, $array_update) {
		$this->load->database();
		$this->db->set($array_update);
		$this->db->where([
			"id" => $id,
		]);
		$this->db->update("song");
	}

	public function add($array) {
		$this->load->database();
		$this->db->insert("song", $array);
		return $this->db->insert_id();
	}
}