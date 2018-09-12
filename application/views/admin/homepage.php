

<script language="JavaScript" type="text/javascript" src="<?php echo base_url('assets/js') ?>/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
$CI =& get_instance();
$CI->load->model('Muser');
?>
<div class="content-wrapper">

	<section class="content-header">
	      <h1>
	        Dashboard
	        <small>Control panel</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class="active">Dashboard</li>
	      </ol>
	    </section>

	<div class="content">
		<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $neworder?></h3>

              <p>Orderan Baru</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php 
              if($presentase < 0){
                  echo "0";
              }else{
                  echo $presentase;
              } 
              ?><sup style="font-size: 20px">%</sup></h3>

              <p>Kenaikan Order </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $pelanggan?></h3>

              <p>Pelanggan</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $newtopup?></h3>

              <p>Top Up Baru</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

	  <div class="row">
		<div class="col-md-7">
			<h3>Sales</h3>
			<div id="myfirstchart" class="" style="background-color:white"></div>
		 </div>
		 <div class="col-md-5">
			 <h3>Sales</h3>
			 <div id="pie-chart" class="" style="background-color:white;max-height:300px"></div>
		 </div>
	  </div>
	</div>

</div>

<script type="text/javascript">
new Morris.Bar({
// ID of the element in which to draw the chart.
element: 'myfirstchart',
// Chart data records -- each entry in this array corresponds to a point on
// the chart.
data: [
		<?php foreach ($qbayar as $rows): ?>
			{ day: "<?= $rows->tgl_bayar ?>", value: <?= $this->Muser->custom_num_rows("tbl_bayar","tgl_bayar",$rows->tgl_bayar);  ?> },
		<?php endforeach; ?>
	],
	xkey: 'day',
// A list of names of data record attributes that contain y-values.
ykeys: ['value'],
// Labels for the ykeys -- will be displayed when you hover over the
// chart.
resize: true,

labels: ['Value'],
barColors: ['rgb(82, 54, 33)', 'red'],
pointStrokeColors: ['black', 'blue'],
lineColors: ['red', 'blue']
});

Morris.Donut({
  element: 'pie-chart',
  data: [
	  <?php foreach ($qjenis as $row): ?>
	  	{label: "<?= $row->jenis ?>", value: <?= $this->Muser->custom_num_rows("qbarang","jenis",$row->jenis);  ?>},
	  <?php endforeach; ?>

],
colors: [
  '#BF6820',
  'rgb(82, 54, 33)',
  '#181008',



],
});

</script>
