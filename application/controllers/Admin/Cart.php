<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id_user'])) {
			redirect(site_url("/Admin/Login"));
		}
		$this->load->helper('form');
		$this->load->library('cart');
		$this->load->model('Mcart');
	}


	public function index()
	{
		$table = "tbl_barang";
		$data['cari'] = $this->Mcart->get($table);

		$data['title'] = "Penjualan";
		$data['judule'] = "ProWarkop";
		$content = "cart";

		$this->load->view('template/header');
		$this->load->view('template/topbar');
		$this->load->view('template/leftbar');
		$this->load->view('admin/'.$content,$data);
		$this->load->view('template/footer');
	}

	public function get_idbar(){
		$table = "tbl_barang";
		$barang= $this->input->post('barang');
		$condition['barang'] = $barang;
		$get = $this->Mcart->getData($table, $condition) -> result_array();

		foreach ($get as $row) {
			echo $row['id_barang'];
		}
	}

	public function daftarkeranjang()
	{
		$this->load->view('admin/cart_view');
	}

	public function total()
	{
		echo $this->cart->total();
	}

	public function keranjang($id)
	{
		$table = "tbl_barang";
		$condition['id_barang'] = $id;
		$get = $this->Mcart->getData($table, $condition);
		$jml = $get->num_rows();
		$tambah = TRUE;
		foreach ($this->cart->contents() as $items){
			$kode = $id;
			  if($items['id'] == $kode){
			  	$total = $items['qty'] + 1;
			  	$data = array(
					'rowid'   => $items['rowid'],
					'qty'     => $total
				);

				$this->cart->update($data);
				$tambah = FALSE;
				break;
			}elseif ($items['name']==$kode) {
				$total = $items['qty'] + 1;
			  	$data = array(
					'rowid'   => $items['rowid'],
					'qty'     => $total
				);

				$this->cart->update($data);
				$tambah = FALSE;
				break;
			}
		}

		if($tambah){
	        if($jml == 0){

	        	echo "<script>
	        	alert('Id barang yang dimasukan tidak ada!');
	        	</script>";

	        }else{
	        	foreach ($get->result() as $row) {
					$data = array(
						'id'      => $row->id_barang,
						'qty'     => 1,
						'price'   => $row->harga_jual,
						'name'    => $row->barang
					);
					$this->cart->insert($data);
					break;
				}
			}
		}
	}

	public function tambah_keranjang(){
		$rowid = $this->input->post('rowid');
		$qty = $this->input->post('qty');

		$data = array(
        	'rowid' => $rowid,
        	'qty'   => $qty+1
		);
		$this->cart->update($data);
	}

	//Print
	public function printing(){
		 $faktur = $this->uri->segment(4);
		$data['qorder'] = $this->Mcart->get_where('qorder',$faktur);
		$this->load->view("admin/print",$data);
	}

	public function kurang_keranjang(){
		$rowid = $this->input->post('rowid');
		$qty = $this->input->post('qty');

		$data = array(
			'rowid' => $rowid,
			'qty'   => $qty-1
		);
		$this->cart->update($data);
	}

	public function deleterow()
	{
	    $id = $this->input->post('id');
		$data = array(
			'rowid'   => $id,
			'qty'     => 0
		);

		$this->cart->update($data);
	}
	public function delete()
	{
        $this->cart->destroy();
	}

	public function destroy(){
		$this->cart->destroy();
	}

    public function selesai()
    {
		$id_user = $_SESSION['id_user'];
		$no_faktur = date("Ymdhis");
		$tgl = date("Y-m-d");
		$jam = date("H:i:s");
    	$table = "tbl_order";

		$table2 = "tbl_bayar";
		$total_harga = $this->cart->total();
		$bayar = $this->input->post("bayar");
		$_SESSION['bayar'] = $bayar;
		$_SESSION['faktur'] = $no_faktur;

    	foreach ($this->cart->contents() as $insert){
    		$total = $insert['price']*$insert['qty'];
    		$data = array(
    			'id_barang' => $insert['id'],
				'tgl_order' => $tgl,
				'jam_order' => $jam,
    			'jumlah' => $insert['qty'],
				'faktur' => $no_faktur,
    			'harga_order' => $total,
				'status_order'=> 2,
    			);

    		$this->Mcart->addData($table, $data);

    	}

		$data2 = array(
			'id_pelanggan' => 1,
			'id_user' => $id_user,
			"faktur" => $no_faktur,
			"total_bayar" => $total_harga,
			"bayar" => $bayar,
			"kembali" => $bayar - $total_harga,
			"tgl_bayar" => $tgl,
			'flag_bayar'=>0

		);
		$this->Mcart->addData($table2, $data2);

    }

}
