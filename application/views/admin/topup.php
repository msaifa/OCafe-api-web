<div class="content-wrapper">

	<section class="content-header">
      <h1 >
        <?= $title ?>
      </h1>

	  <br>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Top Up</li>
      </ol>
    </section>

	<div class="content">

		<div class="row">
		<div class="col-md-7">
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
					<form id="Topup-form">


						  <div class="input-group">
							<span class="input-group-addon">&nbsp;@ &nbsp;</span>
							<input type="email" class="form-control" placeholder="Email Pelanggan" name="email" required>
						  </div>
							<br>

						 <div class="input-group">
						   <span class="input-group-addon">Rp.</span>
						   <input type="number" class="form-control" placeholder="Jumlah Top-up" name="saldo" min="10000" required>
						 </div>
						 <br/>
						 <span style="font-size:12px"> <i>Minimal Top-up Rp.10 000</i> </span>
						 <br/>
						 <br/>
						 <input type="submit" name="Topup" class="pull-right btn btn-primary" value="TopUp">
				 </form>
   	 		</div>

            </div>
            <!-- /.box-body -->
          </div>
		  <div class="col-md-5">
			  <div class="small-box bg-brown">
				  <div class="inner">
					<h3>30</h3>

					<p>New Top Up</p>
				  </div>
				  <div class="icon">
					<i class="ion ion-bag"></i>
				  </div>
				  <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>

			  <div class="small-box bg-yellow">
		            <div class="inner">
		              <h3>23</h3>

		              <p>Yesterday</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-stats-bars"></i>
		            </div>
		            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>

				<div class="small-box bg-red">
		            <div class="inner">
		              <h3>150</h3>

		              <p>This Week</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-pie-graph"></i>
		            </div>
		            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		          </div>
		  </div>
          <!-- /.box -->
        </div>
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

		$("#Topup-form").submit(function(e){
			e.preventDefault();
			var form = $(this).serialize();
			$.ajax({
				url:"<?= site_url()?>/Admin/Topup/submit_insert",
				method:"POST",
				data:form,
				success:function(data){
					alert(data);
					window.location.href="<?= site_url()?>/Admin/Topup";
				}
			});
		});
	});
</script>
