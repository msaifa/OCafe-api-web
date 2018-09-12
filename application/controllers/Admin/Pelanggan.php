<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id_user'])) {
			redirect(site_url("/Admin/Login"));
		}
		$this->load->model('Mpelanggan');
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
		  $config['base_url'] = base_url().'index.php/Admin/Pelanggan?';   //url yang muncul ketika tombol pada paging diklik
		  $config['total_rows'] = $this->Mpelanggan->count_pelanggan(); // jlh total pelanggan
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

		  $data['title'] = 'Pelanggan'; //judul title
		  $data['box_title'] = 'Daftar Pelanggan'; //judul title
		  $data['total'] =$this->Mpelanggan->count_pelanggan(); // jlh total pelanggan;
		  $data['judule'] = 'pelanggan'; //judul title
		  $data['qpelanggan'] = $this->Mpelanggan->get_allpelanggan($batas,$offset); //query model semua pelanggan

		  $content="admin/pelanggan";
		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/pelanggan',$data);
		  $this->load->view('template/footer');

}

public function cari()
{
	$key= $this->input->get('key'); //method get key
	$page=$this->input->get('per_page');  //method get per_page

	$search=array(
		'pelanggan'=> $key,
		'id_pelanggan'=> $key
	); //array pencarian yang akan dibawa ke model

	$batas=8; //jlh data yang ditampilkan per halaman
	if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
	   $offset = 0;
	else:
	   $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
	endif;

	$config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
	$config['base_url'] = base_url().'index.php/Admin/Pelanggan?key='.$key;   //url yang muncul ketika tombol pada paging diklik
	$config['total_rows'] = $this->Mpelanggan->count_pelanggan_search($search); // jlh total pelanggan
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
	$data['total'] =$this->Mpelanggan->count_pelanggan_search($search); // jlh total pelanggan;

	$data['box_title'] = 'Daftar pelanggan'; //judul title
	$data['title'] = 'pelanggan'; //judul title
	$data['judule'] = 'pelanggan'; //judul title
	$data['qpelanggan'] = $this->Mpelanggan->get_allpelanggan($batas,$offset,$search); //query model semua pelanggan

	$content="admin/pelanggan";
	$this->load->view('template/header');
	$this->load->view('template/topbar');
	$this->load->view('template/leftbar');
	$this->load->view('admin/pelanggan',$data);
	$this->load->view('template/footer');

}

	function edit()
	{
		$id = $this->uri->segment(4);
		$query = $this->_get_where("id_pelanggan",$id);
		echo json_encode($query);
	}

	function submit_insert(){

		$pelanggan = $this->input->post("pelanggan");
		$alamat = $this->input->post("alamat");
		$notelp = $this->input->post("notelp");
		$email = $this->input->post("email");
		$pass = $this->input->post("pass");
		$pass = md5($pass);

		$data = array(
			"status_p" => 0 ,
			"pelanggan" => $pelanggan ,
			"alamat" => $alamat,
			"notelp" => $notelp,
			"email" => $email ,
			"password" => $pass ,
		);

		$in = $this->_insert($data);
	}

	function submit_edit(){
	    $id = $this->input->post('id');
	    $s = $this->input->post('s');
	    if($s==1){
	        $data = array(
	        "status_p" => 0
	        );     
	    }else{
	        $data = array(
	        "status_p" => 1
	        );     
	    }

		$in = $this->_update($data,$id);
		echo "berhasil";
	}

	function deleteData()
	{
		$id = $this->input->post('id');
		$this->Mpelanggan->deleteData($id);
	}

	function _insert($data){
		$this->Mpelanggan->_insert($data);
	}

	function _update($data,$id){
		$this->Mpelanggan->_update($data,$id);
	}

	function _get_where($kolom,$id){
		$query = $this->Mpelanggan->_get_where($kolom,$id);
		return $query->result_array();
	}
}
