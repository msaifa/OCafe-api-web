<header class="main-header">
  <!-- Logo -->
  <a href="<?= base_url()?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>O</b>C</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>O'</b>Cafe</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->

        <!-- Notifications: style can be found in dropdown.less -->

        <!-- Tasks: style can be found in dropdown.less -->

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="http://thehalalfoodblog.com/wp-content/uploads/2017/04/cfbn-header-logo.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?= $_SESSION['nama_user']?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header" style="background:#181008!important">
              <img src="http://thehalalfoodblog.com/wp-content/uploads/2017/04/cfbn-header-logo.png" class="img-circle" alt="User Image">

              <p>
                <?= $_SESSION['nama_user']?>
                <small>Bekerja di IT-Bisnis.com</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">8 <br> Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">2,4k <br> Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">40 <br> Friends</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
				<a href="<?= base_url()?>index.php/Admin/Logout" class="btn btn-default btn-flat">
					Sign out
				</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>

  </nav>
</header>
