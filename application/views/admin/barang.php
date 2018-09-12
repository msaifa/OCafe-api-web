<div class="content-wrapper">

	<section class="content-header">
      <h1>
        <?= $title ?>

      </h1>
	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Barang</li>
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
   	 		     <div class="col-md-9 col-sm-6" style="padding:0px;">
						<form id="cariJenis">
						<div class="col-md-9" style="padding:0px;">
							<select class="form-control" name="cjenis">
								<option selected="true"  value="">Pilih Jenis</option>
								<?php
									foreach ($kat as $row) {
										?>
											<option value="<?= $row['id_jenis']?>"><?= $row['jenis']?></option>
										<?php
									}

								?>
							</select>
						</div>
						<div class="col-md-3" style="padding:0px;">
							<input type="submit" class="btn btn-gray" value="Submit">
						</div>
						</form>
					</div>
						<br> <br> <br>
				 <button onclick="reset()" class="btn btn-primary" data-toggle="modal" data-target="#insert">
   	 				<i class="fa fa-plus"></i> Tambah Barang
				</button>
   	 			&nbsp;&nbsp;
   	 			<a class="btn btn-primary" href="<?= site_url('Admin/Cetak/barang') ?>">
   	 				<i class="fa fa-print"></i> Export PDF</a>

   	 		 </div>
   	 		    	 		 <div class="col-md-6 pull-right">
   	 			 <form action="<?=base_url()?>index.php/Admin/Barang/cari" method="get">
   	 				<div class="input-group">

   	 				  <input type="text" name="key" class="form-control" placeholder="Masukkan Nama atau ID Barang">
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
								<th>Kode Barang</th>
   	 							<th>Nama</th>
   	 							<th>Deskripsi</th>
   	 							<th>Jenis</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Stok</th>
								<th>Image</th>
								<th>Ket</th>
   	 							<th>Action</th>
   	 						</tr>
   	 					</thead>

   	 					<tbody>
							<?php
							if (isset($_GET['cjenis']) && $_GET['cjenis'] != "" ) {

								$jeniss = $_GET['cjenis'];
								$qbarangs = $this->Mbarang->_get_where("id_jenis",$jeniss);
								$total = $qbarangs->num_rows();
								$paging="";
								$no=1;
								foreach ($qbarangs->result() as $rows){ ?>
	   	 							<tr>
	   	 								<td><?= $rows->id_barang ?></td>
	   	 								<td><?= $rows->barang ?></td>
	   	 								<td><?= $rows->deskripsi ?></td>
										<td><?= $rows->jenis ?></td>
										<td><?= rp($rows->harga_beli); ?></td>
										<td><?= rp($rows->harga_jual); ?></td>
										<td><?= $rows->stok ?></td>
										<td>
										    <?php
													$img = $rows->img;
													if ($img=="") {
														echo "Kosong";
													}else{
														?>
															<button class="btn btn-primary" onClick="viewImage(<?= $rows->id_barang?>)">View</button>
															<div id="bukti-<?=  $rows->id_barang ?>" onclick="hideImage(<?=  $rows->id_barang?>)" >
																<img src="<?= base_url('assets/img/').$rows->img ?>">
															</div>
														<?php
													}
												?>
										</td>
										<td><?= $rows->ket ?></td>
	   	 								<td>
											<button class="btn btn-warning" data-toggle="modal" data-target="#edit" onClick="editData(<?= $rows->id_barang?>)">Edit</button> |
											<a class="btn btn-danger" onClick="deleteData(<?= $rows->id_barang?>)" >Delete</a>
	   	 								</td>
	   	 							</tr>
	   	 						<?php }
							}else{
								$no=1; foreach ($qbarang as $row){ ?>
									<tr>
										<td><?= $row->id_barang ?></td>
										<td><?= $row->barang ?></td>
										<td><?= $row->deskripsi ?></td>
										<td><?= $row->jenis ?></td>
										<td><?= rp($row->harga_beli); ?></td>
										<td><?= rp($row->harga_jual); ?></td>
										<td><?= $row->stok ?></td>
										<td>
											<?php
													$img = $row->img;
													if ($img=="") {
														echo "Kosong";
													}else{
														?>
															<button class="btn btn-primary" onClick="viewImage(<?= $row->id_barang?>)">View</button>
															<div id="bukti-<?=  $row->id_barang ?>" onclick="hideImage(<?=  $row->id_barang?>)" >
																<img src="<?= base_url('assets/img/').$row->img ?>">
															</div>
														<?php
													}
												?>
										</td>
										<td><?= $row->ket ?></td>
										<td>
											<button class="btn btn-warning" data-toggle="modal" data-target="#edit" onClick="editData(<?= $row->id_barang?>)">Edit</button> |
											<a class="btn btn-danger" onClick="deleteData(<?= $row->id_barang?>)" >Delete</a>
										</td>
									</tr>
								<?php
								}
							}
							?>

   	 					</tbody>
   	 				</table>
   	 			</div> <!-- /panel-body-->

   	 				<div class="label label-primary pull-left" style="margin-top:20px">
   	 					<h4>Jumlah Barang : <?=$total?></h4>
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
				<h4 class="modal-title">Tambah Barang</h4>
			  </div>
			  <div class="modal-body">
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Barang</h3>
					</div>
					<div class="box-body">

						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-tags">&nbsp;&nbsp;Jenis&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						  <select class="form-control" name="jenis" required="">
							  <option selected="true" disabled="disabled" >Pilih</option>
							  <?php
								  foreach ($kat as $row) {
									  ?>
										  <option value="<?= $row['id_jenis']?>"><?= $row['jenis']?></option>
									  <?php
								  }

							  ?>
						  </select>
						</div>

						<br>
						<div class="input-group">
  							<span class="input-group-addon"> <i class="fa fa-key">&nbsp;&nbsp;Kode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
  							<input type="text" class="form-control" placeholder="Kode Barang" name="id_barang" required>
  					  	</div>
  					  	<br>


					  <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-cube">&nbsp;&nbsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="text" class="form-control" placeholder="Nama Barang" name="barang" required>
					  </div>
					  <br>
					  
					   <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-cube">&nbsp;&nbsp;Deskripsi&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="text" class="form-control" placeholder="Deskripsi Barang" name="deskripsi" required>
					  </div>
					  <br>

					  <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-money">&nbsp;&nbsp;Harga Beli</i></span>
						<input type="text" class="form-control" placeholder="Harga Beli" name="harga_beli" required="">
					  </div>
					  <br>

					  <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-money">&nbsp;&nbsp;Harga Jual</i></span>
						<input type="text" class="form-control" placeholder="Harga Jual" name="harga_jual" required="">
					  </div>

					  <br>
					  <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-database">&nbsp;&nbsp;Stok&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="number" class="form-control" placeholder="Stok " name="stok" required="">
					  </div>
					  <br>
					 
					  <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-image">&nbsp;&nbsp;Img&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="file" class="form-control" placeholder="Pilih Gambar " name="img" required="">
					  </div>
					 
					 <br>
					 <div class="input-group">
					  <span class="input-group-addon"><i class="fa fa-pencil">&nbsp;&nbsp;Ket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
					  <select class="form-control" name="ket" required="">
						  <option selected="true" disabled="disabled">Pilih</option>
						  <option >Kulakan</option>
						  <option >Titipan</option>

					  </select>
					</div>
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
		<div id="edit" class="modal fade" role="dialog" data-id="">
	  <div class="modal-dialog">

	    <!-- Modal content-->
			<form id="editForm" method="post" enctype="multipart/form-data">
		    <div class="modal-content">
		      <div class="modal-header bg-yellow">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Barang</h4>
		      </div>
		      <div class="modal-body">
				  <div class="box box-warning">
		            <div class="box-header with-border">
		              <h3 class="box-title">Barang</h3>
		            </div>
		            <div class="box-body">
						<div class="input-group">
						  <span class="input-group-addon"> <i class="fa fa-key">&nbsp;&nbsp;Kode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </i></span>
						  <input type="text" class="form-control" placeholder="Kode Barang" name="id_barang" readonly>
						</div>
						<br>
						<div class="input-group">
	  						<span class="input-group-addon"><i class="fa fa-tags">&nbsp;&nbsp;Jenis&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
	  						<select class="form-control" name="jenis">

	  							<?php
	  								foreach ($kat as $row) {
	  									?>
	  										<option value="<?= $row['id_jenis']?>"><?= $kat = $row['jenis']?></option>
	  									<?php
	  								}

	  							?>
	  						</select>
	  					 </div>

  					  <br>
		              <div class="input-group">
		                <span class="input-group-addon"> <i class="fa fa-cube">&nbsp;&nbsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
		                <input type="text" class="form-control" placeholder="Nama" name="barang">
		              </div>
					  <br>
					    <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-cube">&nbsp;&nbsp;Deskripsi&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="text" class="form-control" placeholder="Deskripsi Barang" name="deskripsi" required>
					  </div>
					  <br>

					  <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-money">&nbsp;&nbsp;Harga Beli</i></span>
						<input type="text" class="form-control" placeholder="Harga Beli" name="harga_beli">
					  </div>
					  <br>

					  <div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-money">&nbsp;&nbsp;Harga Jual</i></span>
						<input type="text" class="form-control" placeholder="Harga Jual" name="harga_jual">
					  </div>

					  <br>


					  <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-database">&nbsp;&nbsp;Stok&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="number" class="form-control" placeholder="Stok" name="stok">
					  </div>
					  <br>
					  <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-image">&nbsp;&nbsp;Img&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
						<input type="file" class="form-control" placeholder="Pilih Gambar " name="img">
					  </div>
					 <br>
					 
					 <div class="input-group">
					  <span class="input-group-addon"><i class="fa fa-pencil">&nbsp;&nbsp;Ket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
					  <select class="form-control" name="ket">
						<option selected="true" disabled="disabled">Pilih</option>
						<option >Kulakan</option>
						<option >Titipan</option>
						<option >Hutang</option>
					  </select>

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
				var form = $(this);
				var formData = new FormData($(this)[0]);
				
				$.ajax({
					url:"<?= site_url()?>/Admin/Barang/submit_edit",
					method:"POST",
					cache:false,
					contentType:false,
					processData:false,
					async:false,
					data:formData,
					success:function(data){
						window.location.href="<?= site_url()?>/Admin/Barang";
					}
				});
			});

			$("#insertForm").submit(function(e){
				e.preventDefault();
				var form = $(this);
				var formData = new FormData($(this)[0]);
				$.ajax({
					url:"<?= site_url()?>/Admin/Barang/submit_insert",
					method:"POST",
					cache:false,
					contentType:false,
					processData:false,
					async:false,
					data:formData,
					success:function(data){
				// 		window.location.href="<?= site_url()?>/Admin/Barang";
					}
				});
			});
			
			
			
		});
		
		function deleteData(id){
		    if(confirm("Apakah Anda yakin ?")){
		        
    		    $.ajax({
    		       url:"<?= site_url()?>/Admin/Barang/deleteData",
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
				url:"<?= site_url()?>/Admin/Barang/edit/"+id,
				method:"GET",
				dataType: 'json',
				success:function(data){
					for (var i = 0; i < data.length; i++) {
						$("#edit input[name=id_barang]").val(data[i].id_barang);
						$("#edit input[name=barang]").val(data[i].barang);
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
	</script>
