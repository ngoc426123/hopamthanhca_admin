<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_song extends CI_Model {
	private $userID;
	private $userPermission;

	public function __construct() {
		$this->userID = $this->session->id;
		$this->userPermission = $this->session->permission;
	}

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

	public function getbykeyword($keyword) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->like("title", $keyword);
		$this->db->or_like("id", $keyword);
		$this->db->order_by("id", "DESC");
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

	public function getlist($offset = -1, $limit = -1) {
		$this->load->database();
		$this->load->driver('cache', ['adapter' => 'apc', 'backup' => 'file']);
	
		if ($offset === -1 && $limit === -1 && $this->cache->get('allsong')) 
			return $this->cache->get('allsong');

		$this->db->select("id, title, excerpt, slug, status, date");
		$this->db->from("song");
		// CHECK USER PERMISSION
		if($offset !== -1 && $limit !== -1 && $this->userPermission == 0)
			$this->db->where([
				"author" => $this->userID,
			]);
		$this->db->order_by("id", "DESC");
		if ($offset !== -1 && $limit !== -1)
			$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$song_result = $get->result_array();
		foreach ($song_result as $key => $item) {
			$id_song = $item['id'];

			// META
			$this->db->select("key, value");
			$this->db->from("songmeta");
			$this->db->where([
				"id_song" => $id_song,
				"key"     => "luotxem",
			]);
			$get = $this->db->get();
			$meta_result = $get->result_array();
			foreach ($meta_result as $item_meta) {
				$song_result[$key]["meta"][$item_meta['key']] = $item_meta['value'];
			}

			// CATEGORY
			$this->db->select('type.type_slug, cat.cat_name');
			$this->db->from('songcat');
			$this->db->join("cattype", "songcat.id_cat = cattype.id_cat");
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"songcat.id_song" => $id_song,
				"type.type_slug" => "tac-gia",
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$song_result[$key]["cat"][$item_cat['type_slug']][] = $item_cat;
			}
		}
		if ($offset === -1 && $limit === -1) {
			$this->db->select("*");
			$this->db->from("options");
			$this->db->where([
				"key" => "cache_unit",
			]);
			$this->db->or_where([
				"key" => "cache_value",
			]);
			$get = $this->db->get();
			$result_cache = $get->result_array();
			$timeCache = get_cache_time($result_cache[0]["value"], $result_cache[1]["value"]);
			$this->cache->save('allsong', $song_result, $timeCache);
		}
		return $song_result;
	}

	public function getlistoncat($cat_id, $offset = 0, $limit = 5) {
		$this->load->database();
		$this->db->select("*");
		$this->db->from("song");
		$this->db->join("songcat", "songcat.id_song = song.id");
		$this->db->where([
			"songcat.id_cat" => $cat_id,
		]);
		// CHECK USER PERMISSION
		if($this->userPermission == 0)
			$this->db->where([
				"author" => $this->userID,
			]);
		$this->db->order_by("song.id", "DESC");
		$this->db->limit($limit, $offset);
		$get = $this->db->get();
		$song_result = $get->result_array();

		foreach ($song_result as $key => $item) {
			$id_song = $item['id_song'];

			// META
			$this->db->select("key, value");
			$this->db->from("songmeta");
			$this->db->where([
				"id_song" => $id_song,
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
			$this->db->join("cat", "cat.id = cattype.id_cat");
			$this->db->join("type", "cattype.id_type = type.id");
			$this->db->where([
				"songcat.id_song" => $id_song
			]);
			$get = $this->db->get();
			$cat = $get->result_array();
			foreach ($cat as $key_cat => $item_cat) {
				$song_result[$key]["cat"][$item_cat['type_slug']][] = $item_cat;
			}
		}
		return $song_result;
	}

	public function count($cat_id = 0) {
		$this->load->database();
		$this->db->select("COUNT(song.id)");
		// CHECK USER PERMISSION
		if($this->userPermission == 0)
			$this->db->where([
				"author" => $this->userID,
			]);
		$this->db->from("song");
		if ( $cat_id != 0 ) {
			$this->db->join("songcat", "songcat.id_song = song.id");
			$this->db->join("cat", "cat.id = songcat.id_cat");
			$this->db->where([
				"cat.id" => $cat_id,
			]);
		}
		$get = $this->db->get();

		return $get->row_array()['COUNT(song.id)'];
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

	public function update_songcat($id, $array){
		$this->load->database();

		// DELETE
		$this->db->where([
			"id_song" => $id,
		]);
		$this->db->delete('songcat');
		
		// INSERT
		foreach ($array as $item) {
			$this->db->insert('songcat',[
				"id" => '',
				"id_song" => $id,
				"id_cat" => $item
			]);
		}
	}

	public function add_songcat($id, $array) {
		foreach ($array as $item) {
			$this->db->insert('songcat',[
				"id" => '',
				"id_song" => $id,
				"id_cat" => $item
			]);
		}
	}

	public function del($id) {
		$this->load->database();
		// SONG
		$this->db->where([
			"id" => $id,
		]);
		$this->db->delete("song");

		// SONGMETA
		$this->db->where([
			"id_song" => $id,
		]);
		$this->db->delete("songmeta");

		// SONGCAT
		$this->db->where([
			"id_song" => $id,
		]);
		$this->db->delete("songcat");
	}
}