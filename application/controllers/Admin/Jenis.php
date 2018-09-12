<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id_user'])) {
			redirect(site_url("/Admin/Login"));
		}
		$this->load->model('Mjenis');
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
		  $config['base_url'] = base_url().'index.php/Admin/Jenis?';   //url yang muncul ketika tombol pada paging diklik
		  $config['total_rows'] = $this->Mjenis->count_jenis(); // jlh total jenis
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

		  $data['title'] = 'Jenis'; //judul title
		  $data['box_title'] = 'Daftar Jenis'; //judul title
		  $data['total'] =$this->Mjenis->count_jenis(); // jlh total jenis;
		  $data['judule'] = 'jenis'; //judul title
		  $data['qjenis'] = $this->Mjenis->get_alljenis($batas,$offset); //query model semua jenis

		  $content="admin/jenis";
		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/jenis',$data);
		  $this->load->view('template/footer');

}

public function cari()
{
	$key= $this->input->get('key'); //method get key
	$page=$this->input->get('per_page');  //method get per_page

	$search=array(
		'jenis'=> $key,
		'id_jenis'=> $key
	); //array pencarian yang akan dibawa ke model

	$batas=8; //jlh data yang ditampilkan per halaman
	if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
	   $offset = 0;
	else:
	   $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
	endif;

	$config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
	$config['base_url'] = base_url().'index.php/Admin/Jenis?key='.$key;   //url yang muncul ketika tombol pada paging diklik
	$config['total_rows'] = $this->Mjenis->count_jenis_search($search); // jlh total jenis
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
	$data['total'] =$this->Mjenis->count_jenis_search($search); // jlh total jenis;

	$data['box_title'] = 'Daftar jenis'; //judul title
	$data['title'] = 'jenis'; //judul title
	$data['judule'] = 'jenis'; //judul title
	$data['qjenis'] = $this->Mjenis->get_alljenis($batas,$offset,$search); //query model semua jenis

	$content="admin/jenis";
	$this->load->view('template/header');
	$this->load->view('template/topbar');
	$this->load->view('template/leftbar');
	$this->load->view('admin/jenis',$data);
	$this->load->view('template/footer');

}

	function edit()
	{
		$id = $this->uri->segment(4);
		$query = $this->_get_where("id_jenis",$id);
		echo json_encode($query);
	}

	function submit_insert(){
		$jenis = $this->input->post("jenis");
		$kjenis = $this->input->post("kjenis");


		$data = array(
			"jenis" => $jenis,
			"ket_jenis" => $kjenis

		);

		$in = $this->_insert($data);
	}

	function submit_edit(){
		$id = $this->input->post("id_jenis");
		$jenis = $this->input->post("jenis");
		$kjenis = $this->input->post("kjenis");



		$data = array(
			"jenis" => $jenis,
			"ket_jenis" => $kjenis

		);

		$in = $this->_update($data,$id);
		echo "berhasil";
	}

	function deleteData()
	{
		$id = $this->input->post('id');
		$this->Mjenis->deleteData($id);
	}

	function _insert($data){
		$this->Mjenis->_insert($data);
	}

	function _update($data,$id){
		$this->Mjenis->_update($data,$id);
	}

	function _get_where($kolom,$id){
		$query = $this->Mjenis->_get_where($kolom,$id);
		return $query->result_array();
	}
}
