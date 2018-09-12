<table class="table table-hover table-bordered table-striped" id="">
		<thead>
			<tr>
				<th>Kode</th>
				<th>Nama</th>
				<th>Quantity</th>
				<th>Harga Satuan</th>
				<th>Harga Total</th>
				<th><button onclick="hapusSemua()" class="btn btn-default hapus-semua">Hapus Semua</button>
			</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($this->cart->contents() as $items){ ?>
			<tr>
				<td><?= $items['id'] ?></td>
				<td><?= $items['name'] ?></td>

				<td align="center">
					<button class="btn btn-warning pull-left" type="button" data="<?= $items['rowid'] ?>" data-qty='<?= $items['qty'] ?>' id="btn-<?= $items['id']?>" name="button" onclick="kurang_keranjang(<?= $items['id'] ?>)" > - </button>
					<?= $items['qty'] ?>

					<button class="btn btn-primary pull-right" type="button" data="<?= $items['rowid'] ?>" data-qty='<?= $items['qty'] ?>' id="btn-<?= $items['id']?>" name="button" onclick="tambah_keranjang(<?= $items['id'] ?>)" > + </button>
				</td>
				<td><?= $items['price'] ?></td>
				<td><?= $total = $items['price']*$items['qty'] ?></td>
				<td><a class="btn btn-danger" onClick='delete_row("<?= $items['rowid'] ?>")'>Hapus</a></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>

<script>


site_url = '<?=site_url()?>';
$.get(site_url+'/Admin/Cart/total', function(data) {
  $(".totalBayar").html(data).priceFormat({
	  prefix: 'Rp. ',
	  thousandsSeparator: '.',
	  centsLimit: 0
  });
});

function delete_row (id){
	$.ajax({
		url:site_url+'/Admin/Cart/deleterow/',
		method:'post',
		data:{id:id},
		success:function(){
			kolom();
			total();
		}
	});
}


function kurang_keranjang(id){
	var rowid = $('#btn-'+id).attr('data');
	var qty = $('#btn-'+id).attr('data-qty');
	$.ajax({
		url : '<?= site_url()?>'+'/Admin/Cart/kurang_keranjang',
		method: 'post',
		data:{
			rowid:rowid,
			qty:qty,
		},
		success:function(data){
			kolom();
			total();
		},
		error:function(){
			alert("Error");
		}
	});
}

function tambah_keranjang(id){
	var rowid = $('#btn-'+id).attr('data');
	var qty = $('#btn-'+id).attr('data-qty');
	$.ajax({
		url : '<?= site_url()?>'+'/Admin/Cart/tambah_keranjang',
		method: 'post',
		data:{
			rowid:rowid,
			qty:qty,
		},
		success:function(data){
			kolom();
			total();
		},
		error:function(){
			alert("Error");
		}
	});
}

</script>

<style media="screen">
@page {
  margin-top: 0.5cm;
  margin-left: 0.5cm;
  margin-right: 0.6cm;

}

@media print{
	.btn{
		display: none;
	}
	#printings{
		width:300px !important;
		height:auto !important;
		font-size:11px!important;
		line-height: 60% !important;
	}

}
</style>
