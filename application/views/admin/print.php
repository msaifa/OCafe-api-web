<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
date_default_timezone_set("Asia/Jakarta");
 function rp($num){
	$rp = "Rp ".number_format($num);
	return $rp;
} ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Print Struk</title>

		<style media="screen">
		@page {
			margin: 0;
		}

		</style>

		<script src="<?php echo base_url('assets/js') ?>/jquery-1.11.1.min.js"></script>

		<script src="<?php echo base_url('assets/js') ?>/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url('assets/css');?>/jquery-ui.min.css">

		<!--  Auto Complete -->
		<script src="<?php echo base_url('assets/js') ?>/jquery.autocomplete.js"></script>
		<link rel="stylesheet" href="<?php echo base_url('assets/css');?>/jquery.autocomplete.css">

		<!--  Price Format-->
		<script src="<?php echo base_url('assets/js') ?>/jquery.price_format.2.0.min.js"></script>
		  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
<body style="font-family:'Halvetica',sans-serif">

<div class="" style="width:300px;height:auto;">
	<h4>O'Cafe</h4>
	<p>JL.Jenggolo No 2.A Siwalanpanji <br> Sidoarjo Jawa Timur
		<br>Telp : 083856821255 <br>Email : ocafe.sda@gmail.com
	</p>
	<br>
	<p style="font-size:12px">No : <?= $this->uri->segment(4);?>  &nbsp;&nbsp;&nbsp;&nbsp; Tanggal : <?= date("Y-m-d")?><p>
<table style="border:none;border-collapse:separate;border-spacing:2px">
	<tr align="left">
		<th>Barang</th>
		<th>Harga</th>
		<th>Jmlh</th>

	</tr>

<?php foreach ($qorder->result_array() as $row){ ?>
	<tr>
		<td><?= $row['barang'] ?></td>
		<td><?= rp($row['harga_jual']) ?></td>
		<td align="center"><?= $row['jumlah'] ?></td>
	</tr>
<?php
	$total = $row['harga_jual']*$row['jumlah'];
	$gtotal += $total;
}
?>
</table>
<br>
<hr style="border-top: dotted 1px;">
<div class="total">
Total : <?= rp($gtotal)?><br>
Bayar : <?= rp($gtotal) ?><br>
<?php
	$kembalian = $_SESSION['bayar'] - $gtotal;
	if ($kembalian > 0){
		echo "Kembalian : ".rp($kembalian);
	};
?>
</div>


</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
	    $.ajax({
				url:"<?= site_url('/Admin/Cart/destroy')?>",
				method:"post",
				success:function(){
					window.print();
					window.close();
		    	}

		});
	});

</script>

</html>
