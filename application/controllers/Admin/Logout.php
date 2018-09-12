<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mlogin');
		$this->load->library('pagination');
	}

	public function index()
	{

		session_destroy();
		redirect(base_url());

	  }

}
