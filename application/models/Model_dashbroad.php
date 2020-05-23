<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashbroad extends CI_Model {
	public function count() {
		$this->load->database();
		$result = [];

		// SONG
		$this->db->select("COUNT(id)");
		$this->db->from("song");
		$get = $this->db->get();
		$result["count_song"] = $get->row_array()["COUNT(id)"];

		// CAT
		$this->db->select("COUNT(id)");
		$this->db->from("cat");
		$get = $this->db->get();
		$result["count_cat"] = $get->row_array()["COUNT(id)"];

		// VIEW
		$this->db->select("SUM(CONVERT(value, SIGNED INTEGER)) as count_view");
		$this->db->from("songmeta");
		$this->db->where([
			"key" => "luotxem"
		]);
		$get = $this->db->get();
		$result["count_view"] = $get->row_array()["count_view"];

		// LOVE
		$this->db->select("SUM(CONVERT(value, SIGNED INTEGER)) as count_love");
		$this->db->from("songmeta");
		$this->db->where([
			"key" => "lovesong"
		]);
		$get = $this->db->get();
		$result["count_love"] = $get->row_array()["count_love"];
		return $result;
	}

	public function song_new() {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->order_by("id", "DESC");
		$this->db->limit(6, 0);
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
			$this->db->join("cat", "songcat.id_cat = cat.id");
			$this->db->where([
				"songcat.id_song" => $id_song
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$song_result[$key]["cat"][$item_cat['type_slug']] = $item_cat['cat_name'];
			}
		}
		return $song_result;
	}

	public function song_view() {
		$this->load->database();
		$this->db->select("*, CONVERT(songmeta.value, SIGNED INTEGER) as st_xem");
		$this->db->from("song");
		$this->db->join("songmeta", "song.id = songmeta.id_song");
		$this->db->where([
			"songmeta.key" => "luotxem"
		]);
		$this->db->order_by("st_xem", "DESC");
		$this->db->limit(6, 0);
		$get = $this->db->get();
		$song_result = $get->result_array();
		foreach ($song_result as $key => $item) {
			$id_song = $item['id_song'];

			// CATEGORY
			$this->db->select('*');
			$this->db->from('songcat');
			$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->join("cat", "songcat.id_cat = cat.id");
			$this->db->where([
				"songcat.id_song" => $id_song
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$song_result[$key]["cat"][$item_cat['type_slug']] = $item_cat['cat_name'];
			}
		}
		return $song_result;
	}

	public function song_love() {
		$this->load->database();
		$this->db->select("*, CONVERT(songmeta.value, SIGNED INTEGER) as st_love");
		$this->db->from("song");
		$this->db->join("songmeta", "song.id = songmeta.id_song");
		$this->db->where([
			"songmeta.key" => "lovesong"
		]);
		$this->db->order_by("st_love", "DESC");
		$this->db->limit(6, 0);
		$get = $this->db->get();
		$song_result = $get->result_array();
		foreach ($song_result as $key => $item) {
			$id_song = $item['id_song'];

			// CATEGORY
			$this->db->select('*');
			$this->db->from('songcat');
			$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->join("cat", "songcat.id_cat = cat.id");
			$this->db->where([
				"songcat.id_song" => $id_song
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$song_result[$key]["cat"][$item_cat['type_slug']] = $item_cat['cat_name'];
			}
		}
		return $song_result;
	}

	public function order_cat() {
		$this->load->database();
		$this->db->select("cat_name, COUNT(id_song) as count");
		$this->db->from("cat");
		$this->db->join("songcat", "cat.id = songcat.id_cat");
		$this->db->group_by("songcat.id_cat");
		$this->db->order_by("count", "DESC");
		$this->db->limit(6);
		$get = $this->db->get();
		$result = $get->result_array();
		return $result;
	}

	public function order_type() {
		$this->load->database();
		$this->db->select("type_name, COUNT(id_cat) as count");
		$this->db->from("type");
		$this->db->join("cattype", "type.id = cattype.id_type");
		$this->db->group_by("cattype.id_type");
		$this->db->order_by("count", "DESC");
		$this->db->limit(6);
		$get = $this->db->get();
		$result = $get->result_array();
		return $result;
	}

	public function order_post() {
		$this->load->database();
		$this->db->select("username, COUNT(song.author) as count");
		$this->db->from("user");
		$this->db->join("song", "user.id = song.author");
		$this->db->group_by("user.id");
		$this->db->order_by("count", "DESC");
		$this->db->limit(6);
		$get = $this->db->get();
		$result = $get->result_array();
		return $result;
	}
}