<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id_user'])) {
			redirect(site_url("/Admin/Login"));
		}
		$this->load->model('Mtopup');
		$this->load->library('pagination');
	}

	public function index()
	{
		  $data['title'] = "Top-up";
		  $data['box_title'] = "Top-up Saldo";
		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/topup',$data);
		  $this->load->view('template/footer');

	}


	function submit_insert(){
		$idp;
		$idu = $_SESSION['id_user'];
		$saldo = $this->input->post("saldo");
		$email = $this->input->post("email");
		$tgl = date("Y-m-d");
		$sql = "SELECT * FROM tbl_pelanggan WHERE email='$email' AND status_p=1";
		$cek = $this->_custom_query($sql);
		if ($cek->num_rows() > 0) {

			foreach ($cek->result_array() as $row) {
				$idp = $row['id_pelanggan'];
			}

			$data = array(

				"tgl_deposit" => $tgl,
				"jumlah_deposit" => $saldo ,
				"id_pelanggan" => $idp,
				"id_user" => $idu

			);

			$in = $this->_insert($data);
			echo "Top-up Berhasil";
		}else{
			echo "Maaf Email Tidak Ada !";
		}


	}

	function _insert($data){
		$this->Mtopup->_insert($data);
	}

	function _update($data,$id){
		$this->Mtopup->_update($data,$id);
	}

	function _get_where($kolom,$id){
		$query = $this->Mtopup->_get_where($kolom,$id);
		return $query->result_array();
	}

	function _custom_query($sql){
		$query = $this->Mtopup->_custom_query($sql);
		return $query;
	}
}
