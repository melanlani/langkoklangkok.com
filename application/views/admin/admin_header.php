 <?php 
if(!isset($_GET['rel'])){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo base_url('asset/admin/images/spices.png'); ?>" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Website Belanja Bumbu Dapur | MPU</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/fonts/font-awesome/css/font-awesome.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/AdminLTE.min.css'); ?>">
    <!-- Choose a skin from the css/skins to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/skins/_all-skins.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/jquery.autocomplete.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/daterangepicker/daterangepicker-bs3.css'); ?>">
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/morris/morris.css'); ?>">
    
  <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('asset/admin/js/jQuery-3.1.0.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('asset/admin/js/jquery-ui.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url('asset/admin/js/bootstrap.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('asset/admin/js/app.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/admin/plugins/jquery.jclock.js'); ?>"></script>
    <script src="<?php echo base_url('asset/admin/plugins/jquery.autocomplete.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/datepicker/datepicker3.css'); ?>">
    <script src="<?php echo base_url('asset/admin/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo base_url('asset/admin/js/hmis.js'); ?>"></script>

    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url('asset/admin/plugins/chartjs/Chart.min.js'); ?>"></script> 

    <!-- Morris.js charts -->
    <script src="<?php echo base_url('asset/admin/plugins/morris/morris.min.js'); ?>"></script> 
    <script src="<?php echo base_url('asset/admin/plugins/morris/raphael-min.js'); ?>"></script> 
  
  <!-- Mask Money -->
  <script src="<?php echo base_url('asset/admin/js/jquery.maskMoney.js'); ?>" type="text/javascript"></script>
  

  <!-- Data Table -->
  <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/smoothness/jquery-ui.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/dataTables.jqueryui.css'); ?>">
  <script src="<?php echo base_url('asset/admin/js/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo base_url('asset/admin/js/dataTables.jqueryui.js'); ?>"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" crossorigin="anonymous">

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js" crossorigin="anonymous"></script>

  
  <!-- iCheck -->
  
  <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/iCheck/all.css'); ?>">
  <script src="<?php echo base_url('asset/admin/plugins/iCheck/icheck.min.js'); ?>"></script>
  

  <!-- SELECT2 -->
  <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins/select2/select2.min.css'); ?>">
  <script src="<?php echo base_url('asset/admin/plugins/select2/select2.full.min.js'); ?>"></script>
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src='<?php echo base_url('assets/images/admin/logo.png'); ?>' style="max-width:55px"></img></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src='<?php echo base_url('assets/images/admin/logo4.png'); ?>' style="max-width:210px"></img></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('asset/admin/images/avatar2.png')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('username'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('asset/admin/images/avatar2.png')?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('username'); ?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=site_url('profil')?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                <?php echo anchor('logout','Logout', ['class'=>'btn btn-default btn-flat']); ?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar" style="background-color:#423d3a;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('asset/admin/images/avatar2.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active"><a href="<?php echo site_url('administrator'); ?>"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
        <?php echo buildMenu(); ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div id="page-content">
    <?php 
    }
    ?>

    <div id="page-content">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1><?php echo $title; ?></h1>
          <ol class="breadcrumb">
        <?php echo buildBreadcrumb(); ?>
          </ol>
      </section>
    </div>



  

        
      