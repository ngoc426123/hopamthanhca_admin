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
                'type_slug' => 'chuyen-muc',
                'desc'      => 'Danh sách bài hát được lọc theo bảng chữ cái, thuận tiện cho việc tìm kiếm các bài hát theo các mẫu tự.',
            ],
            [
                'id'        => '',
                'type_name' => 'tác giả',
                'type_slug' => 'tac-gia',
                'desc'      => 'Bài hát được sắp xếp theo từng tác giả, từng nhà soạn nhạc dễ dàng cho việc tìm kiếm, tra cứu các bài hát, tiện lợi cho việc sử dụng của người dùng.',
            ],
            [
                'id'        => '',
                'type_name' => 'bảng chữ cái',
                'type_slug' => 'bang-chu-cai',
                'desc'      => 'Danh sách bài hát được lọc theo bảng chữ cái, thuận tiện cho việc tìm kiếm các bài hát theo các mẫu tự.',
            ],
            [
                'id'        => '',
                'type_name' => 'điệu bài hát',
                'type_slug' => 'dieu-bai-hat',
                'desc'      => 'Bài hát được sắp xếp theo từng điệu bài hát, từng nhà soạn nhạc dễ dàng cho việc tìm kiếm, tra cứu các bài hát, tiện lợi cho việc sử dụng của người dùng.',
            ],
        ];
        foreach ($arr_type_insert as $item) {
            $this->db->insert("type", $item);
        }
        // INSERT USER
        $arr_options_insert = [
            [
                'id'    => '',
                'key'   => 'title',
                'value' => 'Hợp âm thánh ca ',
            ],
            [
                'id'    => '',
                'key'   => 'keywork',
                'value' => 'Hợp am thánh ca, hợp âm thánh ca có hợp âm, hợp âm guitar, hợm âm guitar hay nhất, thánh ca có hợp âm',
            ],
            [
                'id'    => '',
                'key'   => 'desc',
                'value' => 'Wepsite những bài hát thánh ca có hợp âm theo chuẩn. Cung cấp các công cụ hữu ích khi tra cứu hợp âm. Kho bài hát thánh ca đồ sộ với các bái hát của các tác giả nổi tiếng. Bài hát được chia theo từng chuyên mục, từng tác giả, thuận tiện trong việc tìm kiếm.',
            ],
            [
                'id'    => '',
                'key'   => 'site_url',
                'value' => 'http://hopamthanhca.com',
            ],
            [
                'id'    => '',
                'key'   => 'home_url',
                'value' => 'http://hopamthanhca.com',
            ],
            [
                'id'    => '',
                'key'   => 'favicon',
                'value' => 'tmp/img.favicon.ico',
            ],
            [
                'id'    => '',
                'key'   => 'maintain_status',
                'value' => '0',
            ],
            [
                'id'    => '',
                'key'   => 'maintain_title',
                'value' => 'Bảo Trì Trang Web',
            ],
            [
                'id'    => '',
                'key'   => 'maintain_content',
                'value' => 'Thật sự không muốn có những bất tiện này xẩy đến, chúng tôi luôn mong muốn có những trải nghiệm tốt nhất cho các bạn nên chúng tôi đành phải bảo trì trang web để cập nhật những tính năng tất nhất và hay nhất cho các bạn. Luôn luôn hy vọng các bạn đồng hành cùng trang web. Xin cảm ơn.',
            ],
            [
                'id'    => '',
                'key'   => 'maintain_background',
                'value' => 'http://localhost/hopamthanhca_admin/tmp/img/bg.jpg',
            ],
            [
                'id'    => '',
                'key'   => 'post_defaultstatus',
                'value' => 'publish',
            ],
            [
                'id'    => '',
                'key'   => 'post_defaultcategory',
                'value' => '{"chuyen-muc":38,"tac-gia":189,"bang-chu-cai":152,"dieu-bai-hat":208}',
            ],
            [
                'id'    => '',
                'key'   => 'email',
                'value' => 'minhngoc.ith@gmail.com',
            ],
            [
                'id'    => '',
                'key'   => 'dateformat',
                'value' => 'dd/mm/yyyy',
            ],
            [
                'id'    => '',
                'key'   => 'timeformat',
                'value' => 'HH:ss',
            ],
        ];
        foreach ($arr_options_insert as $item) {
            $this->db->insert("options", $item);
        }

        // INSERT OPTION
        $arr_user_insert = [
            [
                'id'           => '',
                'username'     => 'admin',
                'password'     => md5('@hopam!thanhca@ngoclock7680123'),
                'name'         => 'Hoàng Minh Ngọc',
                'email'        => 'minhngoc.ith@gmail.com',
                'dateregister' => '16/05/2020 12:23:00',
                'displayname'  => 'Minh Ngọc',
                'permission'   => '1',
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
        $data_cat =  file_get_contents("http://localhost/hopamthanhca/wp-json/hopam/danh-muc");
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

            $keywork = 'chuyên mục hợp âm thánh ca, ';
            $keywork = $dat['name'].', ';
            $keywork .= 'chuyên mục '.$dat['name'].', ';
            $keywork .= $dat['name'].' chuyên mục';
            $array_meta_name = [
                'seotitle'   => $dat['name'],
                'seourl'     => $dat['slug'],
                'seodes'     => '',
                'seokeywork' => $keywork,
            ];
            foreach ($array_meta_name as $key => $item) {
                $array_insert_catmeta = [
                    "id"     => "",
                    "id_cat" => $id,
                    "key"    => $key,
                    "value"  => $item
                ];
                $this->db->insert("catmeta", $array_insert_catmeta);
            }
        }

        // CRAW SONG
        $data_song =  file_get_contents("http://localhost/hopamthanhca/wp-json/hopam/bai-hat?perpage=-1&order_by=date");
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