<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransaksi_online extends CI_Model {


	public function table(){
		$table= "tbl_bayar";
		return $table;
	}


	public function table2(){
		$table= "qorder";
		return $table;
	}

	function get($table)
	{
		$this->db->select("*");
		$this->db->from($table);

		return $this->db->get();
	}

	function _get_to($sql){
		$query = $this->db->query($sql);
		return $query;
	}


	function deleteData($faktur)
	{
		$table = $this->table();
        $this->db->where('faktur',$faktur);
        $this->db->delete($table);
	}

	public function _update($data,$id){
		$table = $this->table2();
		$this->db->where("faktur",$id);
		$this->db->update($table,$data);
	}

	public function _get($by){
		$table = $this->table();
		$this->db->order_by($by);
		$query = $this->db->get($table);
		return $query;
	}

	public function _insert($data){
		$table = $this->table();
		$this->db->insert($table,$data);
	}


	public function _get_where($kolom,$id){
		$table= $this->table();
		$this->db->where($kolom,$id);
		$query = $this->db->get($table);
		return $query;
	}

	public function _custom_query($sql){
		$query = $this->db->query($sql);
		return $query;
	}
}
