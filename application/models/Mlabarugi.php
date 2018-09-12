<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlabarugi extends CI_Model {

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
		$tabel ="qorder";
		return $tabel;
	}

	function get_where_tran($tawal,$takhir){
		$this->db->from($this->tabel());
		$query = $this->db->query("SELECT distinct faktur,tgl_order,nama_user,barang,jumlah,harga_jual,harga_beli,total_bayar,bayar FROM `qorder` WHERE tgl_order BETWEEN '$tawal' AND '$takhir'");
		return $query->result();
	}

	function get_alllabarugi($batas=null,$offset=null,$key=null) {

	    $this->db->from($this->tabel());
		    if($batas != null){
		       $this->db->limit($batas,$offset);
		    }
		    if ($key != null) {
		       $this->db->or_like($key);
		    }
		    $query = $this->db->query("SELECT distinct faktur,tgl_order,nama_user,pelanggan,total_bayar,bayar FROM `qorder`");

	    //cek apakah ada labarugi
		    if ($query->num_rows() > 0) {
		        return $query->result();
		    }
		}

		function count_labarugi(){
		    $query = $this->db->get($this->tabel())->num_rows();
		    return $query;
		}

		function  count_labarugi_search($orlike) {
		    $this->db->or_like($orlike);
		    $query = $this->db->get($this->tabel());

		    return $query->num_rows();
		}

	function deleteData($id)
	{
		$table = $this->tabel();
        $this->db->where('id_labarugi',$id);
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
		$this->db->where("id_labarugi",$id);
		$this->db->update($table,$data);
	}


	public function _get_where($kolom,$id){
		$table= $this->tabel2();
		$this->db->where($kolom,$id);
		$query = $this->db->get($table);
		return $query;
	}
}
