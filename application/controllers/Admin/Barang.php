<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {


	public function __construct()
{
	parent::__construct();
	if (!isset($_SESSION['id_user'])) {
		redirect(site_url("/Admin/Login"));
	}
	$this->load->model('Mbarang');
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
		  $config['base_url'] = base_url().'index.php/Admin/barang?';   //url yang muncul ketika tombol pada paging diklik
		  $config['total_rows'] = $this->Mbarang->count_barang(); // jlh total barang
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

		  $data['title'] = 'Barang'; //judul title
		  $data['box_title'] = 'Daftar barang'; //judul title
		  $data['total'] =$this->Mbarang->count_barang(); // jlh total barang;
		  $data['judule'] = 'barang'; //judul title
		  $data['qbarang'] = $this->Mbarang->get_allbarang($batas,$offset); //query model semua barang

		  $data['kat'] = $this->_get("tbl_jenis","jenis");

		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/barang',$data);
		  $this->load->view('template/footer');

}

public function cari()
{
	$key= $this->input->get('key'); //method get key
	$page=$this->input->get('per_page');  //method get per_page

	$search=array(
		'barang'=> $key,
		'id_barang'=> $key
	); //array pencarian yang akan dibawa ke model

	$batas=8; //jlh data yang ditampilkan per halaman
	if(!$page):     //jika page bernilai kosong maka batas akhirna akan di set 0
	   $offset = 0;
	else:
	   $offset = $page; // jika tidak kosong maka nilai batas akhir nya akan diset nilai page terakhir
	endif;

	$config['page_query_string'] = TRUE; //mengaktifkan pengambilan method get pada url default
	$config['base_url'] = base_url().'index.php/Admin/Barang?key='.$key;   //url yang muncul ketika tombol pada paging diklik
	$config['total_rows'] = $this->Mbarang->count_barang_search($search); // jlh total barang
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
	$data['total'] =$this->Mbarang->count_barang_search($search); // jlh total barang;

	$data['box_title'] = 'Daftar barang'; //judul title
	$data['title'] = 'Barang'; //judul title
	$data['judule'] = 'Data Barang'; //judul title
	$data['qbarang'] = $this->Mbarang->get_allbarang($batas,$offset,$search); //query model semua barang
	$data['kat'] = $this->_get("tbl_jenis","jenis");
	$content="Admin/barang";
	$this->load->view('template/header');
	$this->load->view('template/topbar');
	$this->load->view('template/leftbar');
	$this->load->view('admin/barang',$data);
	$this->load->view('template/footer');

}

function edit()
{
	$id = $this->uri->segment(4);
	$query = $this->_get_where("id_barang",$id);
	echo json_encode($query);
}

function submit_insert(){
    
    $file = $_FILES["img"];
	$file_name = $file['name'];
	$tmp = $file['tmp_name'];
	$img = date("YmdHis").".jpg";
	$ext = substr($file_name, strlen($file_name)-3,3 );
	move_uploaded_file($tmp, './assets/img/'.$img);
		

	$id = $this->input->post("id_barang");
	$barang = $this->input->post("barang");
	$jenis = $this->input->post("jenis");
	$hb = $this->input->post("harga_beli");
	$hj = $this->input->post("harga_jual");
	$stok = $this->input->post("stok");
	$ket = $this->input->post("ket");
	$des = $this->input->post("deskripsi");

	$data = array(
		"id_barang" => $id,
		"id_jenis" => $jenis,
		"barang" => $barang ,
		"harga_beli" => $hb ,
		"deskripsi" => $des,
		"harga_jual" => $hj ,
		"stok" => $stok,
		"ket" => $ket,
		"img" => $img
	);
	$in = $this->_insert($data);
}



function submit_edit(){

    $id = $this->input->post("id_barang");
	$barang = $this->input->post("barang");
	$jenis = $this->input->post("jenis");
	$hb = $this->input->post("harga_beli");
	$hj = $this->input->post("harga_jual");
	$stok = $this->input->post("stok");
	$ket = $this->input->post("ket");
		$des = $this->input->post("deskripsi");


    
    if($_FILES["img"] != ""){
    $file = $_FILES["img"];
	$file_name = $file['name'];
	$tmp = $file['tmp_name'];
	$img = date("YmdHis").".jpg";
	$ext = substr($file_name, strlen($file_name)-3,3 );
	move_uploaded_file($tmp, './assets/img/'.$img);   
	    
	   	$data = array(
    		"id_jenis" => $jenis,
    		"barang" => $barang ,
			"deskripsi" => $des,
    		"harga_beli" => $hb ,
    		"harga_jual" => $hj ,
    		"stok" => $stok,
    		"ket" => $ket,
    		"img"=>$img
    	);
    }else{
    	$data = array(
    		"id_jenis" => $jenis,
    		"barang" => $barang ,
    		 "barang" => $barang ,
    		"harga_beli" => $hb ,
    		"harga_jual" => $hj ,
    		"stok" => $stok,
    		"ket" => $ket
    	);
    }
    
    
	


	$in = $this->_update($data,$id);
	echo "berhasil";
}

function deleteData()
{
	$id = $this->input->post('id');
	$this->Mbarang->deleteData($id);
	redirect(site_url()."/Admin/barang");
}

function _insert($data){
	$this->Mbarang->_insert($data);
}

function _update($data,$id){
	$this->Mbarang->_update($data,$id);
}

function _get_where($kolom,$id){
	$query = $this->Mbarang->_get_where($kolom,$id);
	return $query->result_array();
}

function _get($table,$by){
	$query = $this->Mbarang->_get($table,$by);
	return $query->result_array();
}
}
