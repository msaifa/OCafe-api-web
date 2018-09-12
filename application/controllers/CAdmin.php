<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class CAdmin extends CI_Controller
{

	function __construct() {
		parent::__construct();
	}
	
	function login(){
		$e = $this -> input -> post("email") ;
		$p = md5($this -> input -> post("password")) ;

		$res = $this -> _custom_query("select * from tbl_user where email_user='$e' and password_user='$p'") ;
		echo json_encode($res) ;
	}

	function getJenis(){
		if ($this -> isToken()){
			$cari = $this->input->post('cari');

			$q = "select * from tbl_jenis WHERE jenis like '%$cari%' order  by jenis asc " ;
			$res = $this -> _custom_query($q) ;
			echo json_encode($res) ;
		} else {
			echo 'Halaman Salah';
		}
	}

	function getBarang(){
		if ($this -> isToken()){
		    $cari = $this->input->post('cari');
		    
			$q = "select * from qbarang WHERE barang like '%$cari%' order by barang asc" ;
			$res = $this -> _custom_query($q) ;
			echo json_encode($res) ;
		} else {
			echo 'Halaman Salah';
		}
	}

	function getPengguna(){
		if ($this -> isToken()){
		    $cari = $this->input->post('cari');
			$q = "select * from tbl_user WHERE nama_user like'%$cari%' order by nama_user asc" ;
			$res = $this -> _custom_query($q) ;
			echo json_encode($res) ;
		} else {
			echo 'Halaman Salah';
		}
	}

	function getPelanggan(){
		if ($this -> isToken()){
		    $cari = $this->input->post('cari');

			$q = "select * from tbl_pelanggan WHERE pelanggan like '%$cari%' and id_pelanggan<>'1' order by pelanggan asc" ;
			$res = $this -> _custom_query($q) ;
			echo json_encode($res) ;
		} else {
			echo 'Halaman Salah';
		}
	}

	function getPembayaran(){
		if ($this -> isToken()){
		    
		    $cari = $this->input->post('cari');
		    $dari = $this->input->post('dari');
		    $sampai = $this->input->post('sampai');
		    
			$q = "select * from qbayar WHERE pelanggan like '%$cari%' AND tgl_bayar BETWEEN '$dari' AND '$sampai' order by faktur asc" ;
			$res = $this -> _custom_query($q) ;
			echo json_encode($res) ;
		} else {
			echo 'Halaman Salah';
		}
	}

	function getPenjualan(){
		if ($this -> isToken()){
		    $cari = $this->input->post('cari');
		    $dari = $this->input->post('dari');
		    $sampai = $this->input->post('sampai');
		    
			$q = "select * from qorder WHERE pelanggan like '%$cari%' AND tgl_order BETWEEN '$dari' AND '$sampai' order by faktur asc" ;
			$res = $this -> _custom_query($q) ;
			echo json_encode($res) ;
		} else {
			echo 'Halaman Salah';
		}
	}
	
	



	function get($order_by) {
		$this->load->model('MAdmin');
		$query = $this->MAdmin->get($order_by);
		return $query->result_array();
	}

	function get_with_limit($limit, $offset, $order_by) {
		$this->load->model('MAdmin');
		$query = $this->MAdmin->get_with_limit($limit, $offset, $order_by);
		return $query->result_array();
	}

	function get_where($id) {
		$this->load->model('MAdmin');
		$query = $this->MAdmin->get_where($id);
		return $query->result_array();
	}

	function get_where_custom($col, $value) {
		$this->load->model('MAdmin');
		$query = $this->MAdmin->get_where_custom($col, $value);
		return $query->result_array();
	}

	function _insert($data) {
		$this->load->model('MAdmin');
		$this->MAdmin->_insert($data);
	}

	function _update($id, $data) {
		$this->load->model('MAdmin');
		$this->MAdmin->_update($id, $data);
	}

	function _delete($id) {
		$this->load->model('MAdmin');
		$this->MAdmin->_delete($id);
	}

	function count_where($column, $value) {
		$this->load->model('MAdmin');
		$count = $this->MAdmin->count_where($column, $value);
		return $count;
	}

	function rows_count() {
		$this->load->model('MAdmin');
		$count = $this->MAdmin->rows_count();
		return $count;
	}

	function get_max() {
		$this->load->model('MAdmin');
		$max_id = $this->MAdmin->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query) {
		$this->load->model('MAdmin');
		$query = $this->MAdmin->_custom_query($mysql_query);
		return $query->result_array();
	}

}
