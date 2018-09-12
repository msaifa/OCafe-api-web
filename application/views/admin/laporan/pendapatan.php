<div class="content-wrapper">

	<section class="content-header">
      <h1 >
        <?= $title ?>
      </h1>

	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Pendapatan</li>
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
				 <a class="btn btn-primary" href="<?= site_url('Admin/Cetak/laporan_pendapatan?tawal='.$_GET['tawal']).'&takhir='.$_GET['takhir'] ?>">
   	 				<i class="fa fa-print"></i> Export PDF
				</a>


   	 		 </div>
   	 		 <div class="col-md-6 pull-right">
   	 			 <form method="get">
   	 				<div class="input-group">
					  <span>  Tanggal &nbsp;&nbsp;&nbsp; </span>
   	 				  <input type="date" name="tawal" value="<?= date("Y-m-d")?>">
					  <span> &nbsp;&nbsp; &nbsp; Sampai &nbsp;&nbsp;&nbsp; </span>
					  <input type="date" name="takhir" value="<?= date("Y-m-d")?>">

   	 				  <span class="input-group-btn">
   	 					<input type="submit" class="btn btn-primary" name="submit" value="Cari">
   	 				  </span>
   	 				</div><!-- /input-group -->
   	 			  </form>
   	 		 </div>

   	 	<div class="row">
   	 		<div class="col-lg-12 scroll">

   	 			<br>
   	 			<br>
   	 			<div class="table-responsive">
   	 				<table class="table table-hover table-bordered table-striped" id="myTable">
   	 					<thead>
   	 						<tr>
   	 							<th>Faktur</th>
   	 							<th>Tanggal </th>
								<th>Pelanggan</th>
								<th>Total Bayar</th>
   	 						</tr>
   	 					</thead>

   	 					<tbody>
   	 						<?php
							$pendapatan="";
							$CI =& get_instance();
							$CI->load->model('Mpendapatan');
							if (isset($_GET['tawal'])) {

								$result = $CI->Mpendapatan->get_where_tran($_GET['tawal'],$_GET['takhir']);
								foreach ($result as $rows){
									?>
									<tr>
										<td><?= $rows->faktur ?></td>
										<td><?php

											$date = $rows->tgl_order;
											$date = date(' d F Y', strtotime($date));
											echo $date;
										   	 ?></td>
										<td><?= $rows->pelanggan ?></td>
										<td><?php
												$tot = $rows->total_bayar;
												echo rp($tot);
											?>
										</td>
									</tr>
									<?php
									$pendapatan += $tot;
								}
							}else{
								$result = $CI->Mpendapatan->get_where_tran(date("Y-m-d"),date("Y-m-d"));
								foreach ($result as $row){
									?>
									<tr>
										<td><?= $row->faktur ?></td>
										<td><?php

											$date = $rows->tgl_order;
											$date = date(' d F Y', strtotime($date));
											echo $date;
										   	 ?></td>
										<td><?= $row->pelanggan ?></td>
										<td><?php $tot = $row->total_bayar; echo rp($tot)?></td>


									</tr>
									<?php
									$pendapatan += $tot;
								}
							}
							?>

   	 					</tbody>
   	 				</table>
   	 			</div> <!-- /panel-body-->

   	 				<div class="label label-primary pull-left" style="margin-top:20px">
   	 					<h4>Jumlah Pendapatan : <?= rp($pendapatan)?></h4>
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
		        <h4 class="modal-title">Tambah laporan</h4>
		      </div>
		      <div class="modal-body">
				  <div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">laporan</h3>
		            </div>
		            <div class="box-body">

		              <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
		                <input type="text" class="form-control" placeholder="Nama Laporan" name="laporan">
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
	        <h4 class="modal-title">Edit laporan</h4>
	      </div>
	      <div class="modal-body">
			  <div class="box box-warning">
	            <div class="box-header with-border">
	              <h3 class="box-title">laporan</h3>
	            </div>
	            <div class="box-body">
				  <input type="hidden" class="form-control" placeholder="Nama Laporan" name="id_laporan">
	              <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
	                <input type="text" class="form-control" placeholder="Nama" name="laporan">
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

	});
</script>
