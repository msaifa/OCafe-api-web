<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcart extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get($table)
	{
		$this->db->select("*");
		$this->db->from($table);

		return $this->db->get();
	}

	function get_where($table,$faktur)
	{
		$query = $this->db->query("SELECT * FROM $table WHERE faktur = '$faktur' ");
		return $query;
	}

	function tabel(){
		$tabel ="tbl_barang";
		return $tabel;
	}

	function get_allbarang($batas =null,$offset=null,$key=null) {

	    $this->db->from($this->tabel());
		    if($batas != null){
		       $this->db->limit($batas,$offset);
		    }
		    if ($key != null) {
		       $this->db->or_like($key);
		    }
		    $query = $this->db->get();

	    //cek apakah ada barang
		    if ($query->num_rows() > 0) {
		        return $query->result();
		    }
		}

		function count_barang(){
		    $query = $this->db->get($this->tabel())->num_rows();
		    return $query;
		}

		function  count_barang_search($orlike) {
		    $this->db->or_like($orlike);
		    $query = $this->db->get($this->tabel());

		    return $query->num_rows();
		}


	function getData($table, $condition)
	{
        $this->db->where($condition);
        $this->db->select("*");
        $this->db->from($table);

        return $this->db->get();
	}

	function addData($table,$data)
	{
		$this->db->insert($table, $data);
	}

	function updateData($table, $data, $condition)
	{
        $this->db->where($condition);
        $this->db->update($table, $data);
	}

	function deleteData($table, $condition)
	{
        $this->db->where($condition);
        $this->db->delete($table);
	}

	function setoran($table, $condition)
	{
		$this->db->group_by("tgl");
		$this->db->where($condition);
        $this->db->select("*");
        $this->db->from($table);

        return $this->db->get();
	}

	function totalSetor($table, $condition)
	{
		$this->db->select_sum('total_harga');
		$this->db->where($condition);
        $this->db->from($table);

        return $this->db->get();
	}
}

/* End of file myigniter_model.php */
/* Location: ./application/models/myigniter_model.php */
