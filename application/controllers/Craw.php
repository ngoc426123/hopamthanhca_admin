<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Craw extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
        $this->load->database();

        $this->db->select("*");
        $this->db->from("type");
        $this->db->order_by("id", "ASC");
        $query = $this->db->get();
        $cat = $query->result_array();
        $data_cat =  file_get_contents("http://hopamthanhca.com/wp-json/hopam/danh-muc");
        $data_cat = json_decode($data_cat, true);
        foreach($data_cat as $dat) {
            $arr_cat = array(
                'id' => $dat['term_id'],
                'cat_name' => $dat['name'],
                'cat_slug' => $dat['slug'],
            );
            $id  = $dat["term_id"];
            $slug = $dat['taxonomy'];
            foreach ($cat as $ct) {
                if ($ct['type_slug'] == $slug) {
                    $id_type = $ct['id'];
                    $this->db->insert("cattype", array(
                        'id' => '',
                        'id_type' => $id_type,
                        'id_cat'  => $id
                    ));
                }
            }
            $this->db->insert("cat", $arr_cat);
        }

        $data_song =  file_get_contents("http://hopamthanhca.com/wp-json/hopam/bai-hat?perpage=-1&order_by=date");
        $data_song = json_decode($data_song, true);

        foreach ($data_song as $dat) {
            $arr_song_insert = array(
                'id'      => $dat['id'],
                'title'   => $dat['title'],
                'slug'    => $dat['slug'],
                'date'    => $dat['date'],
                'content' => $dat['noidung'],
                'excerpt' => $dat['meta']['loidau'],
                'author'  => 1,
                'status'  => $dat['status'],
            );
            $this->db->insert("song", $arr_song_insert);
            
            $arr_type = ['tacgia','chuyenmuc','dieubaihat','bangchucai'];
            $arr_cat = array();
            foreach ($arr_type as $item) {
                foreach($dat['meta'][$item] as $itemcat) {
                    array_push($arr_cat, $itemcat['term_id']);
                }
            }
            foreach($arr_cat as $item) {
                $arr_songcat_insert = array(
                    'id'      => '',
                    'id_song' => $dat['id'],
                    'id_cat'  => $item,
                );
                $this->db->insert("songcat", $arr_songcat_insert);
            }

            $arr_meta_name = ['luotxem', 'lovesong', 'hopamchinh'];
            foreach ($arr_meta_name as $item) {
                $arr_songmeta_insert = array(
                    'id'      => '',
                    'id_song' => $dat['id'],
                    'key'     => $item,
                    'value'   => $dat['meta'][$item],
                );
                $this->db->insert("songmeta", $arr_songmeta_insert);
            }
        }
    }
    
    public function remove(){
        $this->load->database();
        $this->db->query("DELETE FROM cat WHERE 1");
        $this->db->query("DELETE FROM cattype WHERE 1");
        $this->db->query("DELETE FROM song WHERE 1");
        $this->db->query("DELETE FROM songcat WHERE 1");
        $this->db->query("DELETE FROM songmeta WHERE 1");

		$this->db->query("ALTER TABLE cat AUTO_INCREMENT = 1");
        $this->db->query("ALTER TABLE cattype AUTO_INCREMENT = 1");
		$this->db->query("ALTER TABLE song AUTO_INCREMENT = 1");
        $this->db->query("ALTER TABLE songcat AUTO_INCREMENT = 1");
        $this->db->query("ALTER TABLE songmeta AUTO_INCREMENT = 1");
		echo "Mọi sự đã hoàn tất !!!";
    }

    public function get(){
        $this->load->database();

        $this->db->select("*");
        $this->db->from("cattype");
        $this->db->join("cat","cattype.id_cat = cat.id");
        $this->db->join("type","cattype.id_type = type.id");
        $this->db->where("type.type_slug", "dieu-bai-hat");
        $query = $this->db->get();
        $cat = $query->result_array();
        pr($cat);

    }
}