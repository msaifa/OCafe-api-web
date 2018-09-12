<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class CPelanggan extends CI_Controller
{

	function __construct() {
		parent::__construct();
	}
	
    function getDetailBarang(){
        $id = $this -> input -> post("idjenis") ;
        
        $sql = "select * from qbarang where id_jenis='$id'" ;
        echo json_encode($this -> _custom_query($sql)) ;
    }
	
	function getDetailHistory(){
	    $faktur = $this -> input -> post("faktur") ;
	    
	    $sql = "select * from qorder where faktur='$faktur'" ;
	    echo json_encode($this -> _custom_query($sql)) ;
	}

	function getAkun(){
		$id_pelanggan = $this -> input -> post("id_pelanggan") ;

		$res = $this -> _custom_query("select * from tbl_pelanggan where id_pelanggan='$id_pelanggan'") ;
		echo json_encode($res) ;
	}

	function login(){
		$e = $this -> input -> post("email") ;
		$p = md5($this -> input -> post("password")) ;

		$res = $this -> _custom_query("select * from tbl_pelanggan where email='$e' and password='$p'") ;
		if (count($res) == 1){
			echo json_encode($res) ;
		} else {
			echo json_encode($res) ;
		}
	}

	function ubahPassword(){
		$id_pelanggan = $this -> input -> post("id_pelanggan") ;
		$passBaru = md5($this -> input -> post("passbaru")) ;
		$passLama = md5($this -> input -> post("passlama")) ;

		$sql = "select * from tbl_pelanggan where id_pelanggan='$id_pelanggan'" ;
		$res = $this -> _custom_query($sql) ;
		$passDB = $res[0]["password"] ;

		if ($passDB == $passLama){
			$sql = "update tbl_pelanggan set password='$passBaru' where id_pelanggan='$id_pelanggan'" ;

			if ($this -> _custom_query_exc($sql)){
				$hasil[0]['response'] = "berhasil" ;
				echo json_encode($hasil) ;
			} else {
				$hasil[0]['response'] = "gagal" ;
				echo json_encode($hasil) ;
			}

		} else {
			$hasil[0]['response'] = "beda" ;
			echo json_encode($hasil) ;
		}
	}

	function ubahProfil(){
		$pelanggan = $this -> input -> post("pelanggan") ;
		$alamat = $this -> input -> post("alamat") ; 
		$notelp = $this -> input -> post("notelp") ;
		$email = $this -> input -> post("email") ;
		$id_pelanggan = $this -> input -> post("id_pelanggan") ;

		$sql = "update tbl_pelanggan set pelanggan='$pelanggan', alamat='$alamat', notelp='$notelp', email='$email' where id_pelanggan='$id_pelanggan'" ;

		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->_custom_query($sql);

		if ($query){
			$hasil[0]['response'] = "berhasil" ;
			echo json_encode($hasil);
		} else {
			$hasil[0]['response'] = "gagal" ;
			echo json_encode($hasil);
		}	
	}

	function getHistory(){
		$id_pelanggan = $this -> input -> post("id_pelanggan") ;

// 		$q = "select * from qbayar where id_pelanggan='$id_pelanggan' order by faktur desc" ;
        $q = "select distinct id_pelanggan, pelanggan, alamat, notelp, email, password, saldo, id_user, nama_user, email_user, password_user, status_order as status, level, faktur, total_bayar, bayar, kembali, tgl_bayar, flag_bayar from qorder where id_pelanggan='$id_pelanggan' order by faktur desc" ;
		$res = $this -> _custom_query($q) ;
		echo json_encode($res) ;

	}

	function bayar(){
		$faktur = date('YmdHis') ;
		$id_pelanggan = $this -> input -> post("id_pelanggan") ;
		$id_user = "1" ;
		$total_bayar = $this -> input -> post("total_bayar") ;
		$bayar = $this -> input -> post("bayar") ;
		$kembali = $this -> input -> post("kembali") ;
		$tgl_bayar = $this -> input -> post("tgl_bayar") ;
		$flag_bayar = "1" ;

		$sql = "INSERT INTO tbl_bayar VALUES (
			'$faktur',
			'$id_pelanggan',
			'$id_user',
			'$total_bayar',
			'$bayar',
			'$kembali',
			'$tgl_bayar',
			'$flag_bayar'
		)" ;

		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->_custom_query($sql);

		if ($query){
			$hasil[0]['response'] = "berhasil" ;
			$hasil[0]['faktur'] = $faktur ;
			echo json_encode($hasil);
		} else {
			$hasil[0]['response'] = "gagal" ;
			echo json_encode($hasil);
		}
	}

	function order(){
		$id_barang = $this -> input -> post("idbarang") ;
		$tgl_order = $this -> input -> post("tglorder") ;
		$jam_order = $this -> input -> post("jamorder") ;
		$jumlah = $this -> input -> post("jumlah") ;
		$faktur = $this -> input -> post("faktur") ;
		$harga_order = $this -> input -> post("hargaorder") ;

		$sql = "INSERT INTO tbl_order (id_barang,tgl_order,jam_order,jumlah,faktur,harga_order,status_order) values ('$id_barang','$tgl_order',
				'$jam_order','$jumlah','$faktur','$harga_order','0') ;" ;

		$this->load->model('MPelanggan');
		$query = $this->MPelanggan->_custom_query($sql);

		if ($query){
			$hasil[0]['response'] = "berhasil" ;
			$hasil[0]['faktur'] = "berhasil" ;
			echo json_encode($hasil);
		} else {
			$hasil[0]['response'] = "gagal" ;
			$hasil[0]['faktur'] = "berhasil" ;
			echo json_encode($hasil);
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