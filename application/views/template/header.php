<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>O'Cafe - Managament Cafe jadi lebih Praktis</title>
  <link rel="shortcut icon" href="<?= base_url('assets/img/coffe-ico.png')?>">
  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/js') ?>/jquery-1.11.1.min.js"></script>

  <script src="<?php echo base_url('assets/js') ?>/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/css');?>/jquery-ui.min.css">

  <!--  Auto Complete -->
  <script src="<?php echo base_url('assets/js') ?>/jquery.autocomplete.js"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/css');?>/jquery.autocomplete.css">

  <!--  Price Format-->
  <script src="<?php echo base_url('assets/js') ?>/jquery.price_format.2.0.min.js"></script>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/back/bower_components') ?>/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/back/bower_components') ?>/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/back/bower_components') ?>/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/back/bower_components') ?>/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/back/dist') ?>/css/AdminLTE.min.css">
  <!--  JQUERY-UI-->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/back/bower_components') ?>/jquery/dist/jquery-ui.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/template/back/dist') ?>/css/skins/_all-skins.min.css">
  <!--  Data Tables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/af-2.2.2/b-1.4.2/b-print-1.4.2/datatables.min.css"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  	<![endif]-->
  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


	<link rel="stylesheet" href="<?php echo base_url('assets');?>/custom.css">

</head>
<body class="hold-transition skin-blue sidebar-mini" style="height:auto;min-height:100%;" >
<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	date_default_timezone_set("Asia/Jakarta");
	 function rp($num){
		$rp = "Rp ".number_format($num);
		return $rp;
	}

?>
