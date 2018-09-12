<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mltopup extends CI_Model {

	function get($table)
	{
		$this->db->select("*");
		$this->db->from($table);

		return $this->db->get();
	}

	function tabel(){
		$tabel ="tbl_bayar";
		return $tabel;
	}

	function tabel2(){
		$tabel ="qdeposit";
		return $tabel;
	}

	function get_where_tran($tawal,$takhir){
		$this->db->from($this->tabel());
		$query = $this->db->query("SELECT * FROM `qdeposit` WHERE tgl_deposit BETWEEN '$tawal' AND '$takhir' ");
		return $query->result();
	}

	function get_alltopup($batas=null,$offset=null,$key=null) {

	    $this->db->from($this->tabel());
		    if($batas != null){
		       $this->db->limit($batas,$offset);
		    }
		    if ($key != null) {
		       $this->db->or_like($key);
		    }
		    $query = $this->db->query("SELECT * FROM `qdeposit`");

	    //cek apakah ada topup
		    if ($query->num_rows() > 0) {
		        return $query->result();
		    }
		}

		function count_topup(){
		    $query = $this->db->get($this->tabel())->num_rows();
		    return $query;
		}

		function  count_topup_search($orlike) {
		    $this->db->or_like($orlike);
		    $query = $this->db->get($this->tabel());

		    return $query->num_rows();
		}

	function deleteData($id)
	{
		$table = $this->tabel();
        $this->db->where('id_order',$id);
        $this->db->delete($table);
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

	public function _update($data,$id){
		$table = $this->table();
		$this->db->where("id_order",$id);
		$this->db->update($table,$data);
	}


	public function _get_where($kolom,$id){
		$table= $this->tabel2();
		$this->db->where($kolom,$id);
		$query = $this->db->get($table);
		return $query;
	}
}
