<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_online extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id_user'])) {
			redirect(site_url("/Admin/Login"));
		}
		$this->load->model('Mtransaksi_online','Mto');
		$this->load->library('pagination');
	}

	public function index()
	{
		$data['title'] = "Transaksi Online";
		$data['box_title'] = "Daftar Transaksi";
		  $content="admin/transaksi_online";
		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/transaksi_online',$data);
		  $this->load->view('template/footer');

}
	public function showData(){
		$query = $this->Mto->_get_to("SELECT DISTINCT faktur,tgl_order,pelanggan,total_bayar,status_order
				FROM `qorder` WHERE status_order = 3 ORDER BY status_order")->result_array();
		echo json_encode($query);

	}

	function edit()
	{
		$id = $this->uri->segment(4);
		$query = $this->_get_where("id_transaksi_online",$id);
		echo json_encode($query);
	}

	function deleteData()
	{
		$faktur = $this->input->post('faktur');
		$this->Mto->deleteData($faktur);

	}


		function ambilData()
		{
			$faktur = $this->input->post('faktur');
			$data = array(
				"status_order"=>4,
			);
			$up = $this->_update($data,$faktur);
		}

	function konfirmData()
	{
		$faktur = $this->input->post('faktur');
		$data = array(
			"status_order"=>1,
		);
		$up = $this->_update($data,$faktur);
	}

	function kirimData()
	{
		$faktur = $this->input->post('faktur');
		$data = array(
			"status_order"=>2,
		);
		$up = $this->_update($data,$faktur);
	}

	function detailData(){
		$faktur = $this->input->post('faktur');
		$query = $this->_custom_query("SELECT * FROM qorder WHERE faktur = '$faktur' ")->result_array();
		echo json_encode($query);
	}


	function _insert($data){
		$this->Mto->_insert($data);
	}

	function _update($data,$id){
		$this->Mto->_update($data,$id);
	}

	function _get_where($kolom,$id){
		$query = $this->Mto->_get_where($kolom,$id);
		return $query->result_array();
	}

	function _custom_query($sql){
		$query = $this->Mto->_custom_query($sql);
		return $query;
	}
}
