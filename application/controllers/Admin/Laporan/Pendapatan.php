<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpendapatan');
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
		  $config['base_url'] = base_url().'index.php/Admin/Laporan/Pendapatan?';   //url yang muncul ketika tombol pada paging diklik
		  $config['total_rows'] = $this->Mpendapatan->count_pendapatan(); // jlh total pendapatan
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

		  $data['title'] = 'Laporan Pendapatan'; //judul title
		  $data['box_title'] = 'Daftar Laporan'; //judul title
		  $data['total'] = $this->Mpendapatan->count_pendapatan(); // jlh total pendapatan;
		  $data['judule'] = 'pendapatan'; //judul title

		  $data['qpendapatan'] = $this->Mpendapatan->get_allpendapatan($batas,$offset); //query model semua pendapatan


		  $content="admin/pendapatan";
		  $this->load->view('template/header');
		  $this->load->view('template/topbar');
		  $this->load->view('template/leftbar');
		  $this->load->view('admin/laporan/pendapatan',$data);
		  $this->load->view('template/footer');

}

	function _insert($data){
		$this->Mpendapatan->_insert($data);
	}

	function _update($data,$id){
		$this->Mpendapatan->_update($data,$id);
	}

	function _get_where($kolom,$id){
		$query = $this->Mpendapatan->_get_where($kolom,$id);
		return $query->result_array();
	}
}
