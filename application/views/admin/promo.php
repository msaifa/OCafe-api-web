<div class="content-wrapper">
	<?php
		$CI =& get_instance();
		$CI->load->model('Mpromo');
	?>
	<section class="content-header">
      <h1>
        <?= $title ?>

      </h1>
	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Promo</li>
      </ol>
    </section>

	<div class="content">

		<div class="row">
				<div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $box_title?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

   	 		 <div class="col-md-6">

					<button onclick="reset()" class="btn btn-primary" data-toggle="modal" data-target="#insert">
						<i class="fa fa-plus"></i> Tambah Promo
					</button>
					&nbsp;&nbsp;
					<a class="btn btn-primary" href="<?= site_url('Admin/Cetak/promo/') ?>">
						<i class="fa fa-print"></i> Export Promo
					</a>
   	 		 </div>
   	 		 <div class="col-md-6 pull-right">
   	 			 <form action="<?=base_url()?>index.php/Admin/Promo/cari" method="get">
   	 				<div class="input-group">

   	 				  <input type="text" name="key" class="form-control" placeholder="Masukkan Nama atau ID Promo">
   	 				  <span class="input-group-btn">
   	 					<button class="btn btn-default" type="submit">cari</button>
   	 				  </span>
   	 				</div><!-- /input-group -->
   	 			  </form>
   	 		 </div>

   	 	<div class="row">
   	 		<div class="col-lg-12">

   	 			<br>
   	 			<br>
   	 			<div class="table-responsive">
   	 				<table class="table table-hover table-bordered table-striped" id="myTable">
   	 					<thead>
   	 						<tr>
								<th>Kode Promo</th>
   	 							<th>Nama</th>
   	 							<th>Deskripsi</th>
								<th>Diskon</th>
   	 							<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
								<th>Status</th>
   	 							<th>Action</th>
   	 						</tr>
   	 					</thead>

   	 					<tbody>
							<?php

								$no=1; foreach ($qpromo as $row){
									if ($row->status_promo == 1) {
										$s = "Aktif";
									}else{
										$s = "Belum Aktif";
									}
									?>

									<tr>
										<td><?= $row->id_promo ?></td>
										<td><?= $row->nama_promo ?></td>
										<td><?= $row->deskripsi_promo ?></td>
										<td><?= $row->diskon ?>%</td>
										<td><?= $row->tanggalAwal ?></td>
										<td><?= $row->tanggalAkhir ?></td>
										<td><?= $s ?></td>

										<td>
											<button class="btn btn-warning" onClick="changeStat(<?= $row->id_promo?>,<?= $row->status_promo?>)">Ubah Status</button> |
											<a class="btn btn-danger" onClick="deleteData(<?= $row->id_promo?>)" >Delete</a>
										</td>
									</tr>
								<?php
								}

							?>

   	 					</tbody>
   	 				</table>
   	 			</div> <!-- /panel-body-->

   	 				<div class="label label-primary pull-left" style="margin-top:20px">
   	 					<h4>Jumlah Promo : <?=$total?></h4>
   	 				</div>

   	 				<div class="pull-right">
   	 				  <?=$paging?>
   	 				</div>

   	 			</div>
   	 			</div>
   	 		</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>



		</div>

	</div>

	<!-- Modal -->

		<!--  Insert -->

		<div id="insert" class="modal fade" role="dialog" data-id="">
	  <div class="modal-dialog">

		<!-- Modal content-->
			<form id="insertForm" method="post" enctype="multipart/form-data">
			<div class="modal-content">
			  <div class="modal-header bg-yellow">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Promo</h4>
			  </div>
			  <div class="modal-body">
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Promo</h3>
					</div>
					<div class="box-body">

						<div class="input-group">
  							<span class="input-group-addon"> <i class="fa fa-key">&nbsp;&nbsp;Kode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
  							<input type="text" class="form-control" placeholder="Kode Promo" name="id_promo" required>
  					  	</div>
  					  	<br>


					  <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-cube">&nbsp;&nbsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="text" class="form-control" placeholder="Nama Promo" name="promo" required>
					  </div>
					  <br>

					   <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-cube">&nbsp;&nbsp;Deskripsi&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="text" class="form-control" placeholder="Deskripsi Promo" name="deskripsi" required>
					  </div>
					  <br>


					  <!-- /input-group -->
					</div>
					<!-- /.box-body -->
				  </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary pull-left" name="edit" value="Tambah">
			  </div>
			</div>
		</div>
		</form>
	  </div>

		<!-- Edit -->

	<script type="text/javascript">

		$(document).ready(function(){

			$('#myTable').DataTable({
				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": false,
				"bAutoWidth": false,
				"searching":false
			});

			$("#editForm").submit(function(e){
				e.preventDefault();
				var form = $(this);
				var formData = new FormData($(this)[0]);

				$.ajax({
					url:"<?= site_url()?>/Admin/Promo/submit_edit",
					method:"POST",
					cache:false,
					contentType:false,
					processData:false,
					async:false,
					data:formData,
					success:function(data){
						window.location.href="<?= site_url()?>/Admin/Promo";
					}
				});
			});

			$("#insertForm").submit(function(e){
				e.preventDefault();
				var form = $(this);
				var formData = new FormData($(this)[0]);
				$.ajax({
					url:"<?= site_url()?>/Admin/Promo/submit_insert",
					method:"POST",
					cache:false,
					contentType:false,
					processData:false,
					async:false,
					data:formData,
					success:function(data){
				// 		window.location.href="<?= site_url()?>/Admin/Promo";
					}
				});
			});



		});

		function deleteData(id){
		    if(confirm("Apakah Anda yakin ?")){

    		    $.ajax({
    		       url:"<?= site_url()?>/Admin/Promo/deleteData",
    		       method:"post",
    		       data:{
    		           id:id,
    		       },
    		       success:function(){
    		           location.reload();
    		       }
    		    });
		    }
		}

		function editData(id){
			$.ajax({
				url:"<?= site_url()?>/Admin/Promo/edit/"+id,
				method:"GET",
				dataType: 'json',
				success:function(data){
					for (var i = 0; i < data.length; i++) {
						$("#edit input[name=id_promo]").val(data[i].id_promo);
						$("#edit input[name=promo]").val(data[i].promo);
						$("#edit select[name=jenis]").val(data[i].id_jenis);
						$("#edit input[name=stok]").val(data[i].stok);
						$("#edit input[name=deskripsi]").val(data[i].deskripsi);
						$("#edit input[name=harga_beli]").val(data[i].harga_beli);
						$("#edit input[name=harga_jual]").val(data[i].harga_jual);
						$("#edit select[name=ket]").val(data[i].ket);
					}
				},
				error: function(){
					alert('Could not Edit Data');
				}

			});

		}

    	function viewImage(id){
    		$("#bukti-"+id).addClass("view");
    		$("#bukti-"+id).removeClass("hide");
    	}

    	function hideImage(id){
    		$("#bukti-"+id).addClass("hide");
    		$("#bukti-"+id).removeClass("view");
    	}
		function changeStat(id,s){

			$.ajax({
			   url:"<?= site_url()?>/Admin/Promo/submit_edit",
			   method:"post",
			   data:{
				   id:id,
				   s:s,
			   },
			   success:function(){
				   location.reload();
			   }
			});
		}
	</script>
