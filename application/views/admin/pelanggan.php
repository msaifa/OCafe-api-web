<div class="content-wrapper">

	<section class="content-header">
      <h1 >
        <?= $title ?>
      </h1>

	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pelanggan</li>
      </ol>
    </section>

	<div class="content">

		<div class="row">
				<div class="col-md-12">
          <div class="box box-primary ">
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
   	 			 <button class="btn btn-primary" data-toggle="modal" data-target="#insert">
   	 				<i class="fa fa-plus"></i> Tambah Pelanggan</button>
   	 			&nbsp;&nbsp;
   	 			<a class="btn btn-primary" href="<?= site_url('Admin/Cetak/pelanggan') ?>">
   	 				<i class="fa fa-print"></i> Cetak Pelanggan</a>

   	 		 </div>
   	 		 <div class="col-md-6 pull-right">
   	 			 <form action="<?=base_url()?>index.php/Admin/Pelanggan/cari" method="get">
   	 				<div class="input-group">

   	 				  <input type="text" name="key" class="form-control" placeholder="Masukkan Nama atau ID Pelanggan">
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
   	 							<th>ID</th>
   	 							<th>Pelanggan </th>
								<th>No telp </th>
								<th>Alamat</th>
								<th>Email</th>
								<th>Saldo</th>
								<th>Status</th>
   	 							<th>Action</th>
   	 						</tr>
   	 					</thead>

   	 					<tbody>

   	 						<?php foreach ($qpelanggan as $row): ?>
   	 							<tr>
   	 								<td><?= $idp = $row->id_pelanggan ?></td>
   	 								<td><?= $row->pelanggan ?></td>
									<td><?= $row->notelp?></td>
									<td><?= $row->alamat?></td>
									<td><?= $row->email?></td>
									<td><?= $row->saldo?></td>

									<td>
										<?php
										 	$s = $row->status_p;
										 	if($s==0){
										        ?>
										        <a class="btn btn-primary" id="statusP" onClick="changeStat(<?= $idp?>,<?=$s ?>)" >NonAktif</a>
										        <?php 	    
										 	}else{
										 	    ?>
										        <a class="btn btn-primary" id="statusP" onClick="changeStat(<?= $idp?>,<?=$s ?>)" >Aktif</a>
										        <?php 	    
										 	}
										 	
										?>
										
									</td>

   	 								<td>
										<a class="btn btn-danger" onClick="deleteData(<?= $idp?>)">Delete</a>
   	 								</td>
   	 							</tr>
   	 						<?php endforeach ?>

   	 					</tbody>
   	 				</table>
   	 			</div> <!-- /panel-body-->

   	 				<div class="label label-primary pull-left" style="margin-top:20px">
   	 					<h4>Jumlah Pelanggan : <?=$total?></h4>
   	 				</div>


					<br>
   	 				<div class="pull-right">
   	 				  <?php
					  	echo $paging;
					  	if (isset($_GET['key'])) {
					  		?>
								<a class="btn btn-warning" href="<?= base_url()?>index.php/Admin/Pelanggan">Back</a>
							<?php
					  	}
					  ?>
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

	<!--  Modal -->


<!-- Modal -->

	<!--  Insert -->

	<div id="insert" class="modal fade" role="dialog" data-id="">
	  <div class="modal-dialog">

	    <!-- Modal content-->
			<form id="insertForm" method="post">
		    <div class="modal-content">
		      <div class="modal-header bg-yellow">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Tambah Pelanggan</h4>
		      </div>
		      <div class="modal-body">
				  <div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">Pelanggan</h3>
		            </div>
		            <div class="box-body">

		              <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
		                <input type="text" class="form-control" placeholder="Nama Pelanggan" name="pelanggan">
		              </div>

					  <br>
					  <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<input type="email" class="form-control" placeholder="Email Pelanggan" name="email">
					  </div>

						<br>
					  <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-unlock"></i></span>
						<input type="password" class="form-control" placeholder="password" name="pass">
					  </div>
					  <br>
					  <div class="input-group">
					   	<textarea class="form-control" name="alamat" rows="5" cols="100" placeholder="Alamat"></textarea>
					 </div>
					 <br>
					 <div class="input-group">
					   <span class="input-group-addon"><i class="fa fa-phone"></i></span>
					   <input type="text" class="form-control" placeholder="Nomor Telepon" name="notelp">
					 </div>

		              <!-- /input-group -->
		            </div>
		            <!-- /.box-body -->
		          </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary pull-left" name="insert" value="Insert">
		      </div>
		    </div>
		</form>

	  </div>
	</div>


	<!-- Edit -->
	<div id="edit" class="modal fade" role="dialog" data-id="">
  <div class="modal-dialog">

    <!-- Modal content-->
		<form id="editForm" method="post">
	    <div class="modal-content">
	      <div class="modal-header bg-yellow">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Pelanggan</h4>
	      </div>
	      <div class="modal-body">
			  <div class="box box-warning">
	            <div class="box-header with-border">
	              <h3 class="box-title">Pelanggan</h3>
	            </div>
	            <div class="box-body">
				  <input type="hidden" class="form-control" placeholder="Nama Pelanggan" name="id_pelanggan">
				  <div class="input-group">
					 <span class="input-group-addon"><i class="fa fa-Pelanggan"></i></span>
					 <select class="form-control" name="level">
						 <option selected="true" disabled="disabled" >Pilih Jabatan</option>
						 <option value="0">Pegawai</option>
						 <option value="1">Juragan</option>
					 </select>
				   </div>
				   <br>
				 <div class="input-group">
				   <span class="input-group-addon"><i class="fa fa-Pelanggan-circle-o"></i></span>
				   <input type="text" class="form-control" placeholder="Nama Pelanggan" name="pelanggan">
				 </div>

				 <br>
				 <div class="input-group">
				   <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				   <input type="email" class="form-control" placeholder="Email Pelanggan" name="email">
				 </div>

	              <!-- /input-group -->
	            </div>
	            <!-- /.box-body -->
	          </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<input type="submit" class="btn btn-warning pull-left" name="edit" value="Update">
	      </div>
	    </div>
	</form>

  </div>
</div>

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
			var form = $(this).serialize();
			$.ajax({
				url:"<?= site_url()?>/Admin/Pelanggan/submit_edit",
				method:"POST",
				data:form,
				success:function(data){
					window.location.href="<?= site_url()?>/Admin/Pelanggan";
				}
			});
		});

		$("#insertForm").submit(function(e){
			e.preventDefault();
			var form = $(this).serialize();
			$.ajax({
				url:"<?= site_url()?>/Admin/Pelanggan/submit_insert",
				method:"POST",
				data:form,
				success:function(data){
					window.location.href="<?= site_url()?>/Admin/Pelanggan";
				}
			});
		});
	});
	
	function deleteData(id){
	    if(confirm("Apakah Anda yakin ?")){
	        $.ajax({
    	        url:"<?= site_url()?>/Admin/Pelanggan/deleteData",
    	        method:"post",
    	        data:{id:id},
    	        success:function(){
    	            location.reload();
    	        }
	        });    
	    }
	    
	}
	
	function changeStat(id,s){
	    
	    $.ajax({
	       url:"<?= site_url()?>/Admin/Pelanggan/submit_edit",
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










