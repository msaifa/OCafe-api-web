<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mlogin');
		$this->load->library('pagination');
	}

	public function index()
	{
		  $this->load->view('admin/login');
	  }

	  public function submit(){
		  $email = $this->input->post("email");
		  $pass = $this->input->post("password");
		  $_SESSION['email'] = $email;
		  $_SESSION['pass'] = $pass;
		  $pass = md5($pass);

		  $result = $this-> _custom_query("SELECT * FROM tbl_user WHERE email_user = '$email' AND password_user = '$pass' ");
		  if ($result->num_rows() > 0) {

			foreach ($result->result_array() as $row) {
				$_SESSION['nama_user'] = $row['nama_user'];
				$_SESSION['email_user'] = $row['email_user'];
				$_SESSION['id_user'] = $row['id_user'];
				echo $_SESSION['level'] = $row['level'];
			}


		  }else{
			echo "404";
		  }


	  }


	function deleteData()
	{
		$id = $this->uri->segment(4);
		$this->Mlogin->deleteData($id);
		redirect(site_url()."/Admin/Login");
	}

	function _insert($data){
		$this->Mlogin->_insert($data);
	}

	function _update($data,$id){
		$this->Mlogin->_update($data,$id);
	}

	function _get_where($kolom,$id){
		$query = $this->Mlogin->_get_where($kolom,$id);
		return $query->result_array();
	}

	function _custom_query($mysql_query){
		$query = $this->Mlogin->_custom_query($mysql_query);
		return $query;
	}
}
