
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?> | QPRO e-Employee</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/media/css/dataTables.bootstrap.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- DatePicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS sidedar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-purple fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>QPRO</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>QPRO</b> e-Employee</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo base_url() ?>"><i class="fa fa-home">&nbsp;</i>Home</a>
            </li>
            <li>
              <a href="<?php echo base_url('dashboard/profil') ?>"><i class="fa fa-institution">&nbsp;</i>Profil Perusahaan</a>
            </li>
            <li>
              <a href="<?php echo base_url('login/logout') ?>"><i class="fa fa-sign-out">&nbsp;</i>Sign Out</a>
            </li>
          </ul>
        </div>
    </nav>
  </header>
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php if(!empty($this->session->userdata('logged_in'))) { ?>
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/images/no_avatar.png') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          <a href="<?php echo base_url('karyawan/view?id='.$this->session->userdata('nik')); ?>"><i class="fa fa-user text-success"></i> Profile</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      <?php if($this->session->userdata('logged_in')=='loginasadmin' && ($this->session->userdata('isTheBoss') > 0 ||  $this->session->userdata('divisi')=='D.01.16.11.002')) { ?>
        <li class="header text-center">MASTER DATA</li>
        <?php
            if($this->session->userdata('logged_in') == "loginasadmin" && $this->session->userdata('divisi')=='D.01.16.11.002'){
        ?>
        <li><a href="<?php echo base_url('departemen'); ?>"><i class="fa fa-circle-o"></i><span>Departemen / Divisi</span></a></li>
        <li><a href="<?php echo base_url('jabatan'); ?>"><i class="fa fa-circle-o"></i><span>Jabatan</span></a></li>
        <li><a href="<?php echo base_url('jenis_cuti'); ?>"><i class="fa fa-circle-o"></i><span>Jenis Cuti</span></a></li>
        <?php } ?>
        <li><a href="<?php echo base_url('karyawan'); ?>"><i class="fa fa-circle-o"></i><span>Karyawan</span></a></li>
       <!--  <li><a href="<?php echo base_url('posisi'); ?>"><i class="fa fa-circle-o"></i><span>Posisi Karyawan</span></a></li> -->
      <?php }?>
        <li class="header text-center">CUTI</li>
        <li><a href="<?php echo base_url('cuti'); ?>"><i class="fa fa-circle-o"></i><span>Daftar Pengajuan Cuti</span></a></li>
        <?php
            if($this->session->userdata('prioritas') == 1 && $this->session->userdata('isTheBoss') > 0):
        ?>
        <li><a href="<?php echo base_url('approval'); ?>"><i class="fa fa-circle-o"></i><span>Approval Cuti</span></a></li>
        <?php if($this->session->userdata('divisi') == 'D.01.16.11.002'): ?>
        <li><a href="<?php echo base_url('validasi'); ?>"><i class="fa fa-circle-o"></i><span> Validasi Cuti</span></a></li>
        <?php endif; ?>
        <li class="header text-center">LAPORAN</li>
        <li><a href="<?php echo base_url('report'); ?>"><i class="fa fa-circle-o"></i><span>Rekap Cuti</span></a></li>
        <?php endif; ?>
      </ul>

      <?php } ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php
        echo ($title == 'Home' ? "DASHBOARD" : strtoupper($title));
        ?>
      </h1>
      <ol class="breadcrumb">
        <li><span id="timer" style="font-size:1.2em;font-weight:bold;"></span></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-body">
          <?php if(!empty($message)) { ?>
          <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
            <div id="msg_alert" class="alert alert-warning fade in">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
              <div style="text-align: center;width: 100%;">
                <?php echo $message ?>
              </div>
            </div>
          </div>
          <?php } ?> 
          <?php echo $content;?>     
        </div>
      </div>
    </section>
  </div>

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo (date('Y')=='2016' ? date('Y') : '2016-'.date('Y')); ?> by PT. QPRO.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js'); ?>"></script>
<!-- DatePicker -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<!-- Datatables -->
<script src="<?php echo base_url('assets/plugins/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js') ?>"></script>
<!-- Input Mask -->
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js'); ?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>
<!-- TinyMCE 4.4.3 -->
<script src="<?php echo base_url('assets/plugins/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/app.min.js'); ?>"></script>
<!-- Live Clock -->
<script src="<?php echo base_url('assets/js/live_clock.js'); ?>"></script>


<!-- Custom -->
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
</body>
</html>
