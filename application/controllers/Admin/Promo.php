<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {


	public function __construct()
{
	parent::__construct();
	if (!isset($_SESSION['id_user'])) {
		redirect(site_url("/Admin/Login"));
	}
	$this->load->model('Mpromo');
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
		  $config['base_url'] = base_url().'index.php/Admin/Promo?';   //url yang muncul ketika tombol pada paging diklik
		  $config['total_rows'] = $this->Mpromo->count_promo(); // jlh total promo
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

		  $data['title'] = 'Promo'; //judul title
		  $data['box_title'] = 'Daftar promo'; //judul title
		  $data['total'] =$this->Mpromo->count_promo(); // jlh total promo;
		  $data['judule'] = 'Promo'; //judul title
		  $data['qpromo'] = $this->Mpromo->get_allpromo($batas,$offset); //query model semua promo

		  $data['kat'] = $this->_get("tbl_jenis","jenis");

		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/promo',$data);
		  $this->load->view('template/footer');

}

public function cari()
{
	$key= $this->input->get('key'); //method get key
	$page=$this->input->get('per_page');  //method get per_page

	$search=array(
		'nama_promo'=> $key,
		'id_promo'=> $key
	); //array pencarian yang akan dibawa ke model

	$batas=8; //jlh data yang ditampilkan per halaman
	if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
	   $offset = 0;
	else:
	   $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
	endif;

	$config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
	$config['base_url'] = base_url().'index.php/Admin/Promo?key='.$key;   //url yang muncul ketika tombol pada paging diklik
	$config['total_rows'] = $this->Mpromo->count_promo_search($search); // jlh total promo
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
	$data['total'] =$this->Mpromo->count_promo_search($search); // jlh total promo;

	$data['box_title'] = 'Daftar promo'; //judul title
	$data['title'] = 'promo'; //judul title
	$data['judule'] = 'Data promo'; //judul title
	$data['qpromo'] = $this->Mpromo->get_allpromo($batas,$offset,$search); //query model semua promo
	$data['kat'] = $this->_get("tbl_jenis","jenis");
	$content="Admin/promo";
	$this->load->view('template/header');
	$this->load->view('template/topbar');
	$this->load->view('template/leftbar');
	$this->load->view('admin/promo',$data);
	$this->load->view('template/footer');

}

function edit()
{
	$id = $this->uri->segment(4);
	$query = $this->_get_where("id_promo",$id);
	echo json_encode($query);
}

function submit_insert(){

    $file = $_FILES["img"];
	$file_name = $file['name'];
	$tmp = $file['tmp_name'];
	$img = date("YmdHis").".jpg";
	$ext = substr($file_name, strlen($file_name)-3,3 );
	move_uploaded_file($tmp, './assets/img/'.$img);


	$id = $this->input->post("id_promo");
	$promo = $this->input->post("promo");
	$jenis = $this->input->post("jenis");
	$hb = $this->input->post("harga_beli");
	$hj = $this->input->post("harga_jual");
	$stok = $this->input->post("stok");
	$ket = $this->input->post("ket");
	$des = $this->input->post("deskripsi");

	$data = array(
		"id_promo" => $id,
		"id_jenis" => $jenis,
		"promo" => $promo ,
		"harga_beli" => $hb ,
		"deskripsi" => $des,
		"harga_jual" => $hj ,
		"stok" => $stok,
		"ket" => $ket,
		"img" => $img
	);
	$in = $this->_insert($data);
}


function deleteData()
{
	$id = $this->input->post('id');
	$this->Mpromo->deleteData($id);
	redirect(site_url()."/Admin/promo");
}

function _insert($data){
	$this->Mpromo->_insert($data);
}

function _update($data,$id){
	$this->Mpromo->_update($data,$id);
}

function _get_where($kolom,$id){
	$query = $this->Mpromo->_get_where($kolom,$id);
	return $query->result_array();
}

function _get($table,$by){
	$query = $this->Mpromo->_get($table,$by);
	return $query->result_array();
}
function submit_edit(){
	$id = $this->input->post('id');
	$s = $this->input->post('s');
	if($s==1){
		$data = array(
		"status_promo" => 0
		);
	}else{
		$data = array(
		"status_promo" => 1
		);
	}

	$in = $this->_update($data,$id);
	echo "berhasil";
}



}
