<?php
	if ($_SESSION['level'] < 2) {
		?>
		<aside class="main-sidebar" style="min-height:1000px;background-color:#181008!important"  >
		  <!-- sidebar: style can be found in sidebar.less -->
		  <section class="sidebar" style="">
		    <!-- Sidebar user panel -->
		    <div class="user-panel">
		      <div class="pull-left image">
		        <img src="http://thehalalfoodblog.com/wp-content/uploads/2017/04/cfbn-header-logo.png" class="img-circle" alt="User Image">
		      </div>
		      <div class="pull-left info">
		        <p>O'Cafe</p>
		        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		      </div>
		    </div>
		    <!-- search form -->
		    <form action="#" method="get" class="sidebar-form">
		      <div class="input-group">
		        <input type="text" name="q" class="form-control" placeholder="Search...">
		        <span class="input-group-btn">
		              <button type="submit" name="search" id="search-btn" class="btn btn-flat">
		                <i class="fa fa-search"></i>
		              </button>
		            </span>
		      </div>
		    </form>
		    <!-- /.search form -->
		    <!-- sidebar menu: : style can be found in sidebar.less -->
		    <ul class="sidebar-menu" data-widget="tree">
		      <li class="header">MAIN NAVIGATION</li>
		      <li class="active">
		        <a href="<?= base_url()?>index.php/">
		          <i class="fa fa-dashboard"></i> <span>Pesanan Dapur</span>
		        </a>

		      </li>

			  <li>
				<a href="<?= base_url()?>index.php/Admin/logout">
				  <i class="fa fa-sign-out"></i> <span>Logout</span>
				</a>
			  </li>
		  </section>
		  <!-- /.sidebar -->
		</aside>


		<?php
	}else{
 ?>
<aside class="main-sidebar" style="min-height:1000px;background-color:#181008!important"  >
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="http://thehalalfoodblog.com/wp-content/uploads/2017/04/cfbn-header-logo.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>O'Cafe</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="<?= base_url()?>index.php/">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>

      </li>
	  <!-- <li class="">
        <a href="<?= base_url()?>index.php/Admin/Cart">
          <i class="fa fa-shopping-cart"></i> <span>Penjualan</span>
        </a>

      </li> -->
	  <li class="">
		  <a href="<?= base_url()?>index.php/Admin/Transaksi_online">
			<i class="glyphicon glyphicon-transfer"></i> <span>Transaksi</span>
		  </a>

		</li>

		<li class="">
			<a href="<?= base_url()?>index.php/Admin/Promo">
			  <i class="glyphicon glyphicon-tags"></i> <span>Promo</span>
			</a>

		  </li>

	  <hr>
	  <li>
		<a href="<?= base_url()?>index.php/Admin/Topup">
		  <i class="fa fa-money"></i> <span>Top Up Saldo</span>
		</a>
	  </li>
	  	<li>
		  <a href="<?= base_url()?>index.php/Admin/Pelanggan">
			<i class="fa fa-users"></i> <span>Pelanggan</span>
		  </a>
		</li>
		<li>
		  <a href="<?= base_url()?>index.php/Admin/Jenis">
			<i class="fa fa-tags"></i> <span>Jenis</span>
		  </a>
		</li>
		<li>
		  <a href="<?= base_url()?>index.php/Admin/Barang">
			<i class="fa fa-cube"></i> <span>Barang</span>
		  </a>
		</li>

		<li>
		  <a href="<?= base_url()?>index.php/Admin/User">
			<i class="fa fa-address-book"></i> <span>User</span>
		  </a>
		</li>
		<li class="treeview">
		  <a href="#">
			<i class="fa fa-file"></i> <span>Laporan</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		  </a>
		  <ul class="treeview-menu">
			<li><a href="<?= base_url()?>index.php/Admin/Laporan/Transaksi"><i class="fa fa-circle"></i> Laporan Transaksi</a></li>
			<li><a href="<?= base_url()?>index.php/Admin/Laporan/Pendapatan"><i class="fa fa-circle"></i> Laporan Pendapatan</a></li>
			<li><a href="<?= base_url()?>index.php/Admin/Laporan/Labarugi"><i class="fa fa-circle"></i> Laporan Laba Rugi</a></li>
			<li><a href="<?= base_url()?>index.php/Admin/Laporan/Topup"><i class="fa fa-circle"></i> Laporan Top-Up</a></li>
		  </ul>
		</li>

      <hr>
	  <li>
		<a href="<?= base_url()?>index.php/Admin/logout">
		  <i class="fa fa-sign-out"></i> <span>Logout</span>
		</a>
	  </li>
  </section>
  <!-- /.sidebar -->
</aside>
<?php } ?>
