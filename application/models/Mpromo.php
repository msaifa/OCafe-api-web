<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpromo extends CI_Model {

	function get($table)
	{
		$this->db->select("*");
		$this->db->from($table);

		return $this->db->get();
	}

	function tabel(){
		$tabel ="tbl_promo";
		return $tabel;
	}

	function get_allpromo($batas =null,$offset=null,$key=null) {

	    $this->db->from($this->tabel());
		    if($batas != null){
		       $this->db->limit($batas,$offset);
		    }
		    if ($key != null) {
		       $this->db->or_like($key);
		    }
		    $query = $this->db->get();

	    //cek apakah ada promo
		    if ($query->num_rows() > 0) {
		        return $query->result();
		    }
		}

		function count_promo(){
		    $query = $this->db->get($this->tabel())->num_rows();
		    return $query;
		}

		function  count_promo_search($orlike) {
		    $this->db->or_like($orlike);
		    $query = $this->db->get($this->tabel());

		    return $query->num_rows();
		}

	function deleteData($id)
	{
		$table = $this->table();
        $this->db->where('id_promo',$id);
        $this->db->delete($table);
	}
	public function table(){
		$table= "tbl_promo";
		return $table;
	}

	public function _get($table,$by){
		$this->db->order_by($by);
		$query = $this->db->get($table);
		return $query;
	}

	public function _insert($data){
		$table = $this->table();
		$this->db->insert($table,$data);
	}

	public function _update($data,$id){
		$table = $this->table();
		$this->db->where("id_promo",$id);
		$this->db->update($table,$data);
	}


	public function _get_where($kolom,$id){
		$table= $this->tabel();
		$this->db->where($kolom,$id);
		$query = $this->db->get($table);
		return $query;
	}

		public function custom_num_rows($table,$kolom=null,$data=null){
			if ($kolom!=null) {
				$this->db->where($kolom,$data);
			}
			$query = $this->db->get($table);
			return $query->num_rows();
		}
}
