<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Craw extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
        $this->load->database();

        // INSERT TYPE
        $arr_type_insert = [
            [
                'id'        => '',
                'type_name' => 'chuyên mục',
                'type_slug' => 'chuyen-muc'
            ],
            [
                'id'        => '',
                'type_name' => 'tác giả',
                'type_slug' => 'tac-gia'
            ],
            [
                'id'        => '',
                'type_name' => 'bảng chữ cái',
                'type_slug' => 'bang-chu-cai'
            ],
            [
                'id'        => '',
                'type_name' => 'điệu bài hát',
                'type_slug' => 'dieu-bai-hat'
            ],
        ];
        foreach ($arr_type_insert as $item) {
            $this->db->insert("type", $item);
        }
        // INSERT USER
        $arr_user_insert = [
            [
                'id'           => '',
                'username'     => 'admin',
                'password'     => md5('b'),
                'name'         => 'Hoàng Minh Ngọc',
                'email'        => 'minhngoc.ith@gmail.com',
                'dateregister' => '16/05/2020 12:23:00',
                'displayname'  => 'Minh Ngọc',
                'permission'   => '1',
            ],
            [
                'id'           => '',
                'username'     => 'ducanh',
                'password'     => md5('1234567890'),
                'name'         => 'Nguyễn Trần Đức Anh',
                'email'        => 'ducanh1996@gmail.com',
                'dateregister' => '12/05/2020 12:25:00',
                'displayname'  => 'DA1528',
                'permission'   => '0',
            ],
            [
                'id'           => '',
                'username'     => 'linhking1945',
                'password'     => md5('123456'),
                'name'         => 'Trương Hoàng Linh',
                'email'        => 'linhking145@gmail.com',
                'dateregister' => '12/05/2020 15:45:00',
                'displayname'  => 'LinhZuto',
                'permission'   => '0',
            ],
        ];
        foreach ($arr_user_insert as $item) {
            $this->db->insert("user", $item);
        }

        // CRAW CATEGORY
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

        // CRAW SONG
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
            $keywork = 'Hợp âm thánh ca, ';
            $keywork = $dat['title'].', ';
            $keywork .= 'bài hát '.$dat['title'].', ';
            $keywork .= 'hợp âm '.$dat['title'].', ';
            $keywork .= 'hợp âm guitar '.$dat['title'].', ';
            $keywork .= $dat['title'].' hợp âm';
            $arr_meta_name = [
                'pdffile'    => '',
                'seotitle'   => $dat['title'],
                'seourl'     => $dat['slug'],
                'seodes'     => $dat['meta']['loidau'],
                'seokeywork' => $keywork,
            ];
            foreach ($arr_meta_name as $key => $item) {
                $arr_songmeta_insert = array(
                    'id'      => '',
                    'id_song' => $dat['id'],
                    'key'     => $key,
                    'value'   => $item,
                );
                $this->db->insert("songmeta", $arr_songmeta_insert);
            }
        }
    }
}