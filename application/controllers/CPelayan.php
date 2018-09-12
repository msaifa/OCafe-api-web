<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class CPelayan extends CI_Controller
{

	function __construct() {
		parent::__construct();
	}


	function cancel(){
		$id = $this -> input -> post("faktur") ;

		$sql = "delete from tbl_bayar where faktur='$id'" ;
		if ($this -> _custom_query_exc($sql)){
			$hasil[0]["response"] = "berhasil" ;
			echo json_encode($hasil) ;
		} else {
			$hasil[0]["response"] = "gagal" ;
			echo json_encode($hasil) ;
		}
	}

	function getDetail(){
		$id_pelanggan = $this -> input -> post("faktur") ;

		$q = "select * from qorder where faktur='$id_pelanggan' order by faktur desc" ;
		$res = $this -> _custom_query($q) ;
		echo json_encode($res) ;
	}

	function getPesanan(){
		$cari = $this -> input -> post("cari") ;
		
		$sql = "select distinct id_pelanggan, pelanggan, alamat, notelp, email, password, saldo, id_user, nama_user, email_user, password_user, status, level, faktur, total_bayar, bayar, kembali, tgl_bayar, flag_bayar from qorder where status_order='0' and pelanggan like '%$cari%' order by faktur desc" ;

		echo json_encode($this -> _custom_query($sql)) ;
	}

	function konfirm(){
		$faktur = $this -> input -> post("faktur") ;

		$sql = "update tbl_order set status_order='1' where faktur='$faktur'" ;
		if ($this -> _custom_query_exc($sql)){
			$hasil[0]["response"] = "berhasil" ;
			echo json_encode($hasil) ;
		} else {
			$hasil[0]["response"] = "gagal" ;
			echo json_encode($hasil) ;
		}
	}

	function get($order_by) {
		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->get($order_by);
		return $query->result_array();
	}

	function get_with_limit($limit, $offset, $order_by) {
		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->get_with_limit($limit, $offset, $order_by);
		return $query->result_array();
	}

	function get_where($id) {
		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->get_where($id);
		return $query->result_array();
	}

	function get_where_custom($col, $value) {
		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->get_where_custom($col, $value);
		return $query->result_array();
	}

	function _insert($data) {
		$this->load->model('MPelanggan');
		$this->MPelanggan->_insert($data);
	}

	function _update($id, $data) {
		$this->load->model('MPelanggan');
		$this->MPelanggan->_update($id, $data);
	}

	function _delete($id) {
		$this->load->model('MPelanggan');
		$this->MPelanggan->_delete($id);
	}

	function count_where($column, $value) {
		$this->load->model('MPelanggan');
		$count = $this->MPelanggan->count_where($column, $value);
		return $count;
	}

	function rows_count() {
		$this->load->model('MPelanggan');
		$count = $this->MPelanggan->rows_count();
		return $count;
	}

	function get_max() {
		$this->load->model('MPelanggan');
		$max_id = $this->MPelanggan->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query) {
		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->_custom_query($mysql_query);
		return $query->result_array();
	}

	function _custom_query_exc($sql){
		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->_custom_query($sql);
		return $query ;
	}

}