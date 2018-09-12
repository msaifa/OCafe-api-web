<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cetak extends CI_Controller {
	public function __construct()
		{
			parent::__construct();
			$this->load->library('Pdf');
		}
	public function barang()
	{
			$data['date'] = date("Y-m-d");
			$data['title'] = "Laporan Barang";
			$data['isi'] = $this->get_barang();
			$this->load->view('admin/cetak/barang', $data);
	}
	public function pelanggan()
	{
			$data['date'] = date("Y-m-d");
			$data['title'] = "Laporan Pelanggan";
			$data['isi'] = $this->get_pelanggan();
			$this->load->view('admin/cetak/pelanggan', $data);
	}
	public function jenis()
	{
			$data['date'] = date("Y-m-d");
			$data['title'] = "Laporan Jenis Barang";
			$data['isi'] = $this->get_jenis();
			$this->load->view('admin/cetak/jenis', $data);
	}

	public function user()
	{
			$data['date'] = date("Y-m-d");
			$data['title'] = "Laporan User";
			$data['isi'] = $this->get_user();
			$this->load->view('admin/cetak/user', $data);
	}

	public function laporan_transaksi()
	{
		if ($_GET['tawal']=="") {
			$data['date'] = date("Y-m-d");
			$data['date2'] = date("Y-m-d");
			$data['title'] = "Laporan Transaksi";
			$data['isi'] = $this->get_where_tran($data['date'],$data['date']);
			$this->load->view('admin/cetak/laporan_transaksi', $data);
		}else{
			$data['date'] = $_GET['tawal'];
			$data['date2'] = $_GET['takhir'];
			$data['title'] = "Laporan Transaksi";
			$data['isi'] = $this->get_where_tran($_GET['tawal'],$_GET['takhir']);
			$this->load->view('admin/cetak/laporan_transaksi', $data);
		}

	}

	public function laporan_pendapatan()
	{
		if ($_GET['tawal']=="") {
			$data['date'] = date("Y-m-d");
			$data['date2'] = date("Y-m-d");
			$data['title'] = "Laporan Pendapatan";
			$data['isi'] = $this->get_where_tran($data['date'],$data['date']);
			$this->load->view('admin/cetak/laporan_pendapatan', $data);
		}else{
			$data['date'] = $_GET['tawal'];
			$data['date2'] = $_GET['takhir'];
			$data['title'] = "Laporan Pendapatan";
			$data['isi'] = $this->get_where_tran($_GET['tawal'],$_GET['takhir']);
			$this->load->view('admin/cetak/laporan_pendapatan', $data);
		}

	}

	public function laporan_labarugi()
	{
		if ($_GET['tawal']=="") {
			$data['date'] = date("Y-m-d");
			$data['date2'] = date("Y-m-d");
			$data['title'] = "Laporan Laba Rugi";
			$data['isi'] = $this->get_where_tran2($data['date'],$data['date']);
			$this->load->view('admin/cetak/laporan_labarugi', $data);
		}else{
			$data['date'] = $_GET['tawal'];
			$data['date2'] = $_GET['takhir'];
			$data['title'] = "Laporan Laba Rugi";
			$data['isi'] = $this->get_where_tran2($_GET['tawal'],$_GET['takhir']);
			$this->load->view('admin/cetak/laporan_labarugi', $data);
		}

	}

	public function laporan_topup()
	{
		if ($_GET['tawal']=="") {
			$data['date'] = date("Y-m-d");
			$data['date2'] = date("Y-m-d");
			$data['title'] = "Laporan Topup";
			$data['isi'] = $this->get_where_tran3($data['date'],$data['date']);
			$this->load->view('admin/cetak/laporan_topup', $data);
		}else{
			$data['date'] = $_GET['tawal'];
			$data['date2'] = $_GET['takhir'];
			$data['title'] = "Laporan Topup";
			$data['isi'] = $this->get_where_tran3($_GET['tawal'],$_GET['takhir']);
			$this->load->view('admin/cetak/laporan_topup', $data);
		}

	}




	public function get_pelanggan(){
		$this->load->model('Mpelanggan');
		$result = $this->Mpelanggan->get_allpelanggan();
		return $result;
	}

	public function get_barang(){
		$this->load->model('Mbarang');
		$result = $this->Mbarang->get_allbarang();
		return $result;
	}
	public function get_jenis(){
		$this->load->model('Mjenis');
		$result = $this->Mjenis->get_alljenis();
		return $result;
	}

	public function get_user(){
		$this->load->model('Muser');
		$result = $this->Muser->get_alluser();
		return $result;
	}

	function get_where_tran($tawal,$takhir){
		$query = $this->db->query("SELECT distinct faktur,tgl_order,nama_user,pelanggan,total_bayar,bayar FROM `qorder` WHERE tgl_order BETWEEN '$tawal' AND '$takhir'");
		return $query->result();
	}

	function get_where_tran2($tawal,$takhir){
		$query = $this->db->query("SELECT distinct faktur,tgl_order,nama_user,barang,jumlah,harga_jual,harga_beli,total_bayar,bayar FROM `qorder` WHERE tgl_order BETWEEN '$tawal' AND '$takhir'");
		return $query->result();
	}


	function get_where_tran3($tawal,$takhir){
			$query = $this->db->query("SELECT * FROM `qdeposit` WHERE tgl_deposit BETWEEN '$tawal' AND '$takhir' ");
			return $query->result();
	}

}
