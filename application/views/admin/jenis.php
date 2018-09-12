vb<div class="content-wrapper">

	<section class="content-header">
      <h1 >
        <?= $title ?>
      </h1>

	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jenis</li>
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
   	 				<i class="fa fa-plus"></i> Tambah Jenis</button>
   	 			&nbsp;&nbsp;
   	 			<a class="btn btn-primary" href="<?= site_url('Admin/Cetak/jenis') ?>">
   	 				<i class="fa fa-print"></i> Cetak Jenis</a>

   	 		 </div>
   	 		 <div class="col-md-6 pull-right">
   	 			 <form action="<?=base_url()?>index.php/Admin/Jenis/cari" method="get">
   	 				<div class="input-group">

   	 				  <input type="text" name="key" class="form-control" placeholder="Masukkan Nama atau ID Jenis">
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
   	 							<th>Jenis </th>
   	 							 <th>Keterangan Jenis </th>
   	 							<th>Action</th>
   	 						</tr>
   	 					</thead>

   	 					<tbody>
   	 						<?php foreach ($qjenis as $row): ?>
   	 							<tr>
   	 								<td><?= $row->id_jenis ?></td>
   	 								<td><?= $row->jenis ?></td>
   	 						    	<td><?= $row->ket_jenis ?></td>

   	 								<td>

   	 									<button class="btn btn-warning" data-toggle="modal" data-target="#edit" onClick="editData(<?= $row->id_jenis?>)">Edit</button> |
   	 									
										<a class="btn btn-danger" onClick="deleteData(<?= $row->id_jenis ?>)">Delete</a>
   	 								</td>
   	 							</tr>
   	 						<?php endforeach ?>

   	 					</tbody>
   	 				</table>
   	 			</div> <!-- /panel-body-->

   	 				<div class="label label-primary pull-left" style="margin-top:20px">
   	 					<h4>Jumlah Jenis : <?=$total?></h4>
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
		        <h4 class="modal-title">Tambah Jenis</h4>
		      </div>
		      <div class="modal-body">
				  <div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">Jenis</h3>
		            </div>
		            <div class="box-body">

		              <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
		                <input type="text" class="form-control" placeholder="Nama Jenis" name="jenis">
		              </div>
		              
		                                  <br>
                    	              <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
	                <input type="text" class="form-control" placeholder="Ket Jenis" name="kjenis">
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
	        <h4 class="modal-title">Edit Jenis</h4>
	      </div>
	      <div class="modal-body">
			  <div class="box box-warning">
	            <div class="box-header with-border">
	              <h3 class="box-title">Jenis</h3>
	            </div>
	            <div class="box-body">
				  <input type="hidden" class="form-control" placeholder="Nama Jenis" name="id_jenis">
	              <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
	                <input type="text" class="form-control" placeholder="Nama" name="jenis">
	              </div>
                    <br>
                    	              <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
	                <input type="text" class="form-control" placeholder="Ket Jenis" name="kjenis">
	              </div>

				 <br>
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
				url:"<?= site_url()?>/Admin/Jenis/submit_edit",
				method:"POST",
				data:form,
				success:function(data){
					window.location.href="<?= site_url()?>/Admin/Jenis";
				}
			});
		});

		$("#insertForm").submit(function(e){
			e.preventDefault();
			var form = $(this).serialize();
			$.ajax({
				url:"<?= site_url()?>/Admin/Jenis/submit_insert",
				method:"POST",
				data:form,
				success:function(data){
					window.location.href="<?= site_url()?>/Admin/Jenis";
				}
			});
		});
	});

	function editData(id){
		$.ajax({
			url:"<?= site_url()?>/Admin/Jenis/edit/"+id,
			method:"GET",
			dataType: 'json',
			success:function(data){
				for (var i = 0; i < data.length; i++) {
					$("#edit input[name=id_jenis]").val(data[i].id_jenis);
					$("#edit input[name=jenis]").val(data[i].jenis);
					$("#edit input[name=kjenis]").val(data[i].ket_jenis);

				}
			},
			error: function(){
				alert('Could not Edit Data');
			}

		});

	}
	
	function deleteData(id){
	    if(confirm('Apakah Anda yakin ?')){
    	    $.ajax({
    	        url:"<?= site_url()?>/Admin/Jenis/deleteData",
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
</script>
