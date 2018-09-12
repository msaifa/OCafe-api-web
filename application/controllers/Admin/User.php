<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


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
		$page=$this->input->get('per_page');
		  $batas=8; //jlh data yang ditampilkan per halaman
		  if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
			 $offset = 0;
		  else:
			 $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
		  endif;

		  $config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
		  $config['base_url'] = base_url().'index.php/Admin/User?';   //url yang muncul ketika tombol pada paging diklik
		  $config['total_rows'] = $this->Muser->count_user(); // jlh total user
		  $config['per_page'] = $batas; //batas sesuai dengan variabel batas

		  $config['uri_segment'] = $page; //merupakan posisi pagination dalam url pada kesempatan ini saya menggunakan method get untuk menentukan posisi pada url yaitu per_page

		  $config['full_tag_open'] = '<ul class="pagination">';
		  $config['full_tag_close'] = '</ul>';
		  $config['first_link'] = '&laquo; First';
		  $config['first_tag_open'] = '<li class="prev page">';
		  $config['first_tag_close'] = '</li>';

		  $config['last_link'] = 'Last &raquo;';
		  $config['last_tag_open'] = '<li class="next page">';
		  $config['last_tag_close'] = '</li>';

		  $config['next_link'] = 'Next &rarr;';
		  $config['next_tag_open'] = '<li class="next page">';
		  $config['next_tag_close'] = '</li>';

		  $config['prev_link'] = '&larr; Prev';
		  $config['prev_tag_open'] = '<li class="prev page">';
		  $config['prev_tag_close'] = '</li>';

		  $config['cur_tag_open'] = '<li class="current"><a href="">';
		  $config['cur_tag_close'] = '</a></li>';

		  $config['num_tag_open'] = '<li class="page">';
		  $config['num_tag_close'] = '</li>';
		  $this->pagination->initialize($config);
		  $data['paging']=$this->pagination->create_links();
		  $data['jlhpage']=$page;

		  $data['title'] = 'User'; //judul title
		  $data['box_title'] = 'Daftar User'; //judul title
		  $data['total'] =$this->Muser->count_user(); // jlh total user;
		  $data['judule'] = 'user'; //judul title
		  $data['quser'] = $this->Muser->get_alluser($batas,$offset); //query model semua user

		  $content="admin/user";
		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/user',$data);
		  $this->load->view('template/footer');

}

public function cari()
{
	$key= $this->input->get('key'); //method get key
	$page=$this->input->get('per_page');  //method get per_page

	$search=array(
		'nama_user'=> $key,
		'id_user'=> $key
	); //array pencarian yang akan dibawa ke model

	$batas=8; //jlh data yang ditampilkan per halaman
	if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
	   $offset = 0;
	else:
	   $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
	endif;

	$config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
	$config['base_url'] = base_url().'index.php/Admin/User?key='.$key;   //url yang muncul ketika tombol pada paging diklik
	$config['total_rows'] = $this->Muser->count_user_search($search); // jlh total user
	$config['per_page'] = $batas; //batas sesuai dengan variabel batas

	$config['uri_segment'] = $page; //merupakan posisi pagination dalam url pada kesempatan ini saya menggunakan method get untuk menentukan posisi pada url yaitu per_page

	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = '&laquo; First';
	$config['first_tag_open'] = '<li class="prev page">';
	$config['first_tag_close'] = '</li>';

	$config['last_link'] = 'Last &raquo;';
	$config['last_tag_open'] = '<li class="next page">';
	$config['last_tag_close'] = '</li>';

	$config['next_link'] = 'Next &rarr;';
	$config['next_tag_open'] = '<li class="next page">';
	$config['next_tag_close'] = '</li>';

	$config['prev_link'] = '&larr; Prev';
	$config['prev_tag_open'] = '<li class="prev page">';
	$config['prev_tag_close'] = '</li>';

	$config['cur_tag_open'] = '<li class="current"><a href="">';
	$config['cur_tag_close'] = '</a></li>';

	$config['num_tag_open'] = '<li class="page">';
	$config['num_tag_close'] = '</li>';
	$this->pagination->initialize($config);
	$data['paging']=$this->pagination->create_links();
	$data['jlhpage']=$page;
	$data['total'] =$this->Muser->count_user_search($search); // jlh total user;

	$data['box_title'] = 'Daftar user'; //judul title
	$data['title'] = 'user'; //judul title
	$data['judule'] = 'user'; //judul title
	$data['quser'] = $this->Muser->get_alluser($batas,$offset,$search); //query model semua user

	$content="admin/user";
	$this->load->view('template/header');
	$this->load->view('template/topbar');
	$this->load->view('template/leftbar');
	$this->load->view('admin/user',$data);
	$this->load->view('template/footer');

}

	function edit()
	{
		$id = $this->uri->segment(4);
		$query = $this->_get_where("id_user",$id);
		echo json_encode($query);
	}

	function submit_insert(){
		$level = $this->input->post("level");
		$user = $this->input->post("user");
		$email = $this->input->post("email");
		$pass = $this->input->post("pass");
		$pass = md5($pass);

		$data = array(
			"level" => $level ,
			"nama_user" => $user ,
			"email_user" => $email ,
			"password_user" => $pass ,
		);

		$in = $this->_insert($data);
	}

	function submit_edit(){
		$id = $this->input->post("id_user");
		$level = $this->input->post("level");
		$user = $this->input->post("user");
		$email = $this->input->post("email");

		$data = array(
			"level" => $level ,
			"nama_user" => $user ,
			"email_user" => $email ,
		);

		$in = $this->_update($data,$id);
		echo "berhasil";
	}

	function deleteData()
	{
		$id = $this->input->post('id');
		$this->Muser->deleteData($id);
	}

	function _insert($data){
		$this->Muser->_insert($data);
	}

	function _update($data,$id){
		$this->Muser->_update($data,$id);
	}

	function _get_where($kolom,$id){
		$query = $this->Muser->_get_where($kolom,$id);
		return $query->result_array();
	}
}
