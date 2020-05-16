<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Database extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function index(){
		$list_tables = [];
		foreach ($this->db->list_tables() as $key => $value) {
			$list_tables[$value]["field"] = $this->db->list_fields($value);
			$this->db->select("count(id) as count");
			$this->db->from($value);
			$list_tables[$value]["record"] = $this->db->get()->row_array()["count"];
		}
		$data["list_tables"] = $list_tables;
		$data["page_menu_index"] = 5;
		$data["page_title"] = "Dữ liệu";
		$data["page_view"] = "database";
		$this->load->view('layout',$data);
	}
	public function emptytable($table){
		if(isset($table)){
			$this->db->empty_table($table);
			$this->db->query("ALTER TABLE {$table} AUTO_INCREMENT = 1");
			$data["alert"]=array(
				"stt"     => "success",
				"title"   => "Xóa record bảng",
				"content" => "Xóa thành công, bạn vừa xóa record bảng <strong>{$table}</strong>"	
			);
		}
		$list_tables = [];
		foreach ($this->db->list_tables() as $key => $value) {
			$list_tables[$value]["field"] = $this->db->list_fields($value);
			$this->db->select("count(id) as count");
			$this->db->from($value);
			$list_tables[$value]["record"] = $this->db->get()->row_array()["count"];
		}
		$data["list_tables"] = $list_tables;
		$data["page_menu_index"] = 5;
		$data["page_title"] = "Dữ liệu";
		$data["page_view"] = "database";
		$this->load->view('layout',$data);
	}
	public function optimizetable($table){
		if(isset($table)){
			$this->load->dbutil();
			$this->dbutil->repair_table($table);
			$this->dbutil->optimize_table($table);
			$data["alert"]=array(
				"stt"     => "success",
				"title"   => "Sửa bảng",
				"content" => "Sửa thành công, bạn vừa optimize + repair bảng <strong>{$table}</strong>"	
			);
		}
		$list_tables = [];
		foreach ($this->db->list_tables() as $key => $value) {
			$list_tables[$value]["field"] = $this->db->list_fields($value);
			$this->db->select("count(id) as count");
			$this->db->from($value);
			$list_tables[$value]["record"] = $this->db->get()->row_array()["count"];
		}
		$data["list_tables"] = $list_tables;
		$data["page_menu_index"] = 5;
		$data["page_title"] = "Dữ liệu";
		$data["page_view"] = "database";
		$this->load->view('layout',$data);
	}
	public function backup(){
		$filename="backup_hopamthanhca_".date("d-m-Y_H-i-s").'.sql';
		$this->load->dbutil();
		$backup = $this->dbutil->backup();
		$this->load->helper('file');
		write_file('./backup/'.$filename, $backup);
		$this->load->helper('download');
		force_download($filename, $backup);
	}
}
