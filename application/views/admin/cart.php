<div class="content-wrapper">

	<section class="content-header">
      <h1 >
        <?= $title ?>
      </h1>

	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cart</li>
      </ol>
    </section>

	<div class="content">

		<div class="row">
				<div class="col-md-12">
		  <div class="box box-primary ">
			<div class="box-header with-border">
			  <h3 class="box-title"><?= $title?></h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			  </div>
			  <!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">

<!-- Form -->
<section class="section1">
	<div class="container">
	<div class="row">
	<div class="col-md-4">

	<div class="bs-example bs-example-tabs">
		<div>
		    <ul id="myTab" class="nav nav-tabs" role="tablist">
		      <!--<li class=""><a href="#home" role="tab" data-toggle="tab"><i class="fa fa-gear"></i> Auto</a></li>-->
		      <li class="active"><a href="#profile" role="tab" data-toggle="tab"><i class="fa fa-gear"></i> Manual</a></li>
		    </ul>
	    </div>
	    <div id="myTabContent" class="tab-content">
	        <div class="tab-pane fade in" id="home">
		      	<form id="form" action="" method="POST" role="form">
					<div class="input-group">
						<input id="kode" type="text" name="kode" autocomplete="off" autofocus="autofocus" class="form-control" placeholder="Kode" required="required">
					</div>
					<div align="right">
					</div>
				</form>
		    </div>
		    <div class="tab-pane fade active in " id="profile">
		    	<form action="" method="POST" role="form">
		    		<div class="input-group">
						<input id="manual" type="text" name="kode" autocomplete="off" autofocus="autofocus" class="form-control" placeholder="Masukkan Nama " required="required">
				      <span class="input-group-btn">
						<button type="button" class="btn btn-default tabs" id="tombol" > Add</button>
				      </span>
				    </div>
				</form>
	        </div>
	    </div>
	</div>

	</div>
	<div class="col-md-4 harga">
		<!--empty-->
	</div>
	<div class="col-md-4 harga">
		<a data-toggle="modal" href='#modal-id' class="kusus btn btn-primary">
		<div class="kotak-harga">
			<div class="garis">
			  <span>BAYAR</span>
			  <h3 id="total" ></h3>
			</div>
		</div>
		</a>

</div>
</div>
</div>
</div>
</section>
<!-- List Barang -->
<section>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<!-- Keranjang View -->
			<div class="table-responsive keranjang">
			</div>
		</div>
	</div>
</section>
<!--Modal-->
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="tutup" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">PEMBAYARAN</h4>
			</div>
			<div class="modal-body text-center">
				<h4 class="totalan" ></h4>
				<form>
				<center >
				<input type="text" id="bayare" name="" class="form-control" required="required" placeholder="Bayar">
				</center>
				<div id="ganti">
				</div>
			</div>
			<div class="modal-footer">
					<button type="button" id="kembalian" class="btn btn-primary">KEMBALIAN</button>
					<button type="button" class="btn btn-success selesai" onClick="selesai();">SELESAI</button>
				<form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
</div>
</div>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.price_format.2.0.min.js') ?>"></script>
<script>
$(function() {
	var availableTags = [
	  <?php foreach ($cari->result() as $row): ?>
		"<?= $row->barang ?>",
	  <?php endforeach ?>
	];
	$( "#manual" ).autocomplete({
	  source: availableTags
	});

	$('#myTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	})

	$('#kode').keyup(function() {
	    konfirmasi();
	});

	$('#tombol').click(function() {
		$(this).addClass('disabled');
		konfirmasi();
	});

	kolom();
	total();

	var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
	$('#bayare').priceFormat(rupiah);
	$('#ganti');

	$('#kembalian').click(function() {
		site_url = '<?=site_url()?>';
		$.get(site_url+'/Admin/Cart/total', function(data) {
			tot = data;
			bayare = $('#bayare').unmask();
			kembali = bayare - tot;
			$('#ganti').html('<h4 class="totalan">'+kembali+'</h4>');
			$('.totalan').priceFormat({prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0});
	    });
	});

	$('.tutup').click(function() {
		/* Act on the event */

	});
});


function kolom()
{
  site_url = '<?=site_url()?>';
  $.get(site_url+'/Admin/Cart/daftarkeranjang', function(data) {
    $(".keranjang").html(data);
  });
}

function total()
{
  site_url = '<?=site_url()?>';
  $.get(site_url+'/Admin/Cart/total', function(data) {
    $("#total, .totalan").html(data).priceFormat({
		prefix: 'Rp. ',
	    thousandsSeparator: '.',
	    centsLimit: 0
    });
  });
}

function konfirmasi()
{
    setTimeout(function(){
   	  site_url = '<?=site_url()?>';
   	  var cek = $("#kode").val();
	  var id;

      if (cek == '' ) {

		  id = $("#manual").val();
		  $.ajax({
			url:site_url+'/Admin/Cart/get_idbar/',
			method:'post',
			data:{
			  barang : id
			},
			success:function (data){
			  id = data;

			        $.get(site_url+'/Admin/Cart/keranjang/'+id, function() {
			          /*optional stuff to do after success */
			          $("#kode").val('');
			          $("#manual").val('');
			          kolom();
			          total();
			        }).done(function() {
			  		$("#tombol").removeClass('disabled');
			  	  });
		  },
		  error:function(){
			  alert("Error");
		  }
		});

      }else{
	      id = $("#kode").val();

		        $.get(site_url+'/Admin/Cart/keranjang/'+id, function() {
			          /*optional stuff to do after success */
			          $("#kode").val('');
			          $("#manual").val('');
			          kolom();
			          total();
			        }).done(function() {
			  		$("#tombol").removeClass('disabled');
			  	  });
      }


    }, 700);
}

    function selesai(){
        $.ajax({
			url:'<?= site_url()."/Admin/Cart/selesai/"?>',
			method:'post',
			data:{
				bayar: $("#bayare").unmask(),
			},
			success: function(){
				var newPage = window.open('<?= site_url('/Admin/Cart/printing')?>', '_blank');
				newPage.focus();
				location.reload(true);

			}
		});        
    }



function hapusSemua()
{
    if(confirm("Apakah Anda yakin ?")){
    	site_url = '<?=site_url()?>';
    	$.ajax({
    	   url : site_url+'/Admin/Cart/delete',
    	   method:'post',
    	   success:function(){
    	       kolom();
    	       total();
    	   }
    	});   
        
    }


}

</script>
