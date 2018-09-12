<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id_user'])) {
			redirect(site_url("/Admin/Login"));
		}
		$this->load->model('Muser');
		$this->load->library('pagination');
	}
	public function index()
	{
		$day = array(
			"now" => date("Y-m-d"),
			"yesterday" => date("Y-m-d",strtotime("now -1 day"))
		);
		$order = array(
			"table" => "qbayar",
			"kolom" => "tgl_bayar",
		);
		$pel = array(
			"table" => "tbl_pelanggan"
		);
		$topup = array(
			"table" => "qdeposit",
			"kolom" => "tgl_deposit"
		);
		$sale = array(
			"table" => "qbarang",
			"kolom" => "jenis",
		);

		//Top Content
		$data['neworder'] = $this->custom_num_rows($order['table'],$order['kolom'],$day['now']);
		$data['oldorder'] = $this->custom_num_rows($order['table'],$order['kolom'],$day['yesterday']);

		$orderLama = $data['oldorder'];
		$orderBaru = $data['neworder'];
		$data['presentase'] = "0";

		$data['pelanggan'] = $this->custom_num_rows($pel['table']);
		$data['newtopup'] = $this->custom_num_rows($topup['table'],$topup['kolom'],$day['now']);

		//Bottom Content
		$data['kopi'] = $this->custom_num_rows($sale['table'],$sale['kolom'],"kopi");
		$data['qjenis'] = $this->get_jenis();
		$data['qbayar'] = $this->get_bayar();

		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/leftbar');
		$this->load->view('admin/homepage',$data);
		$this->load->view('template/footer');

	}

	public function custom_num_rows($table,$kolom=null,$data=null){
		if ($kolom!=null) {
			$this->db->where($kolom,$data);
		}
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function get_jenis(){
		$table = "tbl_jenis";
		$result = $this->Muser->get($table);
		return $result->result();
	}

	public function get_bayar(){
		$table = "tbl_bayar";
		$result = $this->db->query("SELECT DISTINCT tgl_bayar FROM $table ORDER BY tgl_bayar LIMIT 5");
		return $result->result();
	}
}
