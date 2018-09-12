<div class="content-wrapper">

	<section class="content-header">
      <h1 >
        <?= $title ?>
      </h1>

	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daftar Pesanan</li>
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

   	 	<div class="row">
   	 		<div class="col-lg-12">

   	 			<div class="table-responsive scroll">
   	 				<table class="table table-hover table-bordered table-striped" id="myTable">
   	 					<thead>
   	 						<tr>
   	 							<th>Faktur</th>
   	 							<th>Tanggal Order</th>
								<th>Pelanggan</th>
								<th>Total</th>
								<th>Status </th>
   	 							<th>Action</th>
   	 						</tr>
   	 					</thead>

   	 					<tbody>
							<!-- Ajax DataTable -->
   	 					</tbody>
   	 				</table>
   	 			</div> <!-- /panel-body-->
				<br>
				<br>
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

<!-- Detail -->
<div id="detail" class="modal fade" role="dialog" data-id="">
<div class="modal-dialog">

<!-- Modal content-->
	<form id="editForm" method="post">
	<div class="modal-content">
	  <div class="modal-header bg-yellow">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Detail Order</h4>
	  </div>
	  <div class="modal-body">

				<div class="table-responsive">
  				  <table class="table table-hover table-bordered table-striped" id="tableDetail">
  					  <thead>
  						  <tr>
  							  <th>ID Barang</th>
  							  <th>Barang </th>
							  <th>Harga</th>
  							  <th>Jumlah </th>
  							  <th>Total</th>

  						  </tr>
  					  </thead>
  					  <tbody>

					 </tbody>
				</table>

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<h4 class="pull-left" id="totalDetail"></h4>
	  </div>
	</div>
</form>

</div>
</div>
</div>


<script type="text/javascript">

	$(document).ready(function(){
        showData();


		setInterval(function(){
		    showData();
		},10000);


	});


	//End Document Ready
	function showData(){
		$("#myTable tbody").empty();

		$.getJSON('<?= site_url('Admin/Transaksi_online/showData')?>', function(data) {
			$.each(data,function(i,item){
				var s = data[i].status_order;
				var faktur = data[i].faktur;
				var buttonAksi;
				var buttonDelete;
				var buttonDetail = '<button type="button" class="btn btn-info" name="detail" data-toggle="modal" data-target="#detail" onclick="detailData('+faktur+')">Detail</button>';

				s="Selesai";
				buttonAksi ='<button type="button" class="btn btn-primary" name="aksi" onclick="ambilData('+faktur+')">Sudah Diambil</button>';
				buttonDelete ='<button type="button" class="btn btn-danger" name="delete" onclick="deleteData('+faktur+')">Hapus</button>';

				$("#myTable tbody").append(
					"<tr>"+
						"<td>"+faktur+"</td>"+
						"<td>"+data[i].tgl_order+"</td>"+
						"<td>"+data[i].pelanggan+"</td>"+
						"<td>"+"Rp."+data[i].total_bayar+" &nbsp;&nbsp; "+buttonDetail +"</td>"+
						"<td>"+ s +"</td>"+
						"<td>"+ buttonAksi+"   "+ buttonDelete +"</td>"+
					"<tr>"
				);

			});
		});

	}


			function ambilData(faktur){
					$.ajax({
						url:"<?= site_url('/Admin/Transaksi_online/ambilData')?>",
						method:"post",
						data:{
							faktur:faktur
						},
						success:function(){
							var newPage = window.open('<?= site_url('/Admin/Cart/printing/')?>'+faktur, '_blank');
							newPage.focus();
							showData();
						}
					});
				}



	function deleteData(faktur){
		$.ajax({
			url:"<?= site_url('/Admin/Transaksi_online/deleteData')?>",
			method:"post",
			data:{
				faktur:faktur
			},
			success:function(){
				showData();
			}
		});
	}

	function detailData(faktur){
		var total=0;
		var gtotal=0;
		$.ajax({
			url:"<?= site_url('/Admin/Transaksi_online/detailData')?>",
			method:"post",
			dataType:'json',
			data:{
				faktur:faktur
			},
			success:function(data){
				$("#tableDetail tbody").empty();
				$.each(data,function(i,item){
					 total = data[i].jumlah * data[i].harga_jual;
					$("#tableDetail tbody").append(
						"<tr>"+
							"<td>"+	data[i].id_barang+	"</td>"+
							"<td>"+	data[i].barang+	"</td>"+
							"<td> Rp. "+	data[i].harga_jual+	"</td>"+
							"<td>"+	data[i].jumlah+	"</td>"+
							"<td> Rp. "+	total +	"</td>"+
						"</tr>"
					);

					 gtotal += total;
				});
				$("#totalDetail").text("Total : Rp. "+gtotal);
			}
		});
	}
</script>
