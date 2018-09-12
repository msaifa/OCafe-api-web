<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="UTF-8">
	<title>O'Cafe - login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= base_url().'assets/login' ?>/coffe.jpeg">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/login' ?>/main.css">
<!--===============================================================================================-->
</head>
<body >

	<div class="limiter">
		<div class="container-login100" style='background-image:url("<?= base_url()?>assets/login/caffe.jpg")'>
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="login" method="post">

					<span class="login100-form-title p-b-34">
						O'Cafe login
					</span>

					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="eamil" name="email" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="https://colorlib.com/etc/lf/login_v17/index.html#" class="txt2">
							User name / password?
						</a>
					</div>

					<div class="w-full text-center">
						<a href="https://colorlib.com/etc/lf/login_v17/index.html#" class="txt3">
							Sign Up
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url(<?= base_url('assets/login')?>/coffee.jpeg);"></div>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script type="text/javascript" async="" src="<?= base_url().'assets/login' ?>/analytics.js.download"></script><script src="<?= base_url().'assets/login' ?>/jquery-3.2.1.min.js.download"></script>
<!--===============================================================================================-->
	<script src="<?= base_url().'assets/login' ?>/animsition.min.js.download"></script>
<!--===============================================================================================-->
	<script src="<?= base_url().'assets/login' ?>/popper.js.download"></script>
	<script src="<?= base_url().'assets/login' ?>/bootstrap.min.js.download"></script>
<!--===============================================================================================-->
	<script src="<?= base_url().'assets/login' ?>/select2.min.js.download"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="<?= base_url().'assets/login' ?>/moment.min.js.download"></script>
	<script src="<?= base_url().'assets/login' ?>/daterangepicker.js.download"></script>
<!--===============================================================================================-->
	<script src="<?= base_url().'assets/login' ?>/countdowntime.js.download"></script>
<!--===============================================================================================-->
	<script src="<?= base_url().'assets/login' ?>/main.js.download"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async="" src="<?= base_url().'assets/login' ?>/js"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>


</body></html>

<script type="text/javascript">
	$(document).ready(function(){
		$("#login").submit(function(e){
			e.preventDefault();
			var data = $(this).serialize();

			$.ajax({
				url:"<?= site_url().'/Admin/Login/submit' ?>",
				method:"post",
				data:data,
				success:function(data){
					if (data == 404) {
						alert("Maaf Email / Password Salah !");
					}else{
						if (data == 1) {
							window.location.href="<?= base_url('index.php/Admin/Daftar_pesanan')?>";
						}else if (data == 2) {
							window.location.href="<?= base_url()?>";
						}
					}
				}
			});

		});
	});
</script>
