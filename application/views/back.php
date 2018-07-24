<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo get_title($title) ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo assets_back() ?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo assets_back() ?>plugins/daterangepicker/daterangepicker.css">
  <!-- animate css -->
  <link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/animate/animate.css">
  <!-- datatables css -->
  <link rel="stylesheet" type="text/css" href="<?php echo assets_back() ?>plugins/datatables/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo assets_back() ?>css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="<?php echo assets_back() ?>plugins/jquery/jquery.min.js"></script>

  <!-- Sweet Alert Plugin -->
  <script src="<?php echo assets_back() ?>js/swall.min.js"></script>
  <!-- Datatables -->
  <script src="<?php echo assets_back() ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo assets_back() ?>plugins/datatables/dataTables.bootstrap4.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap-notify.min.js"></script>
  <!-- daterange js -->
  <script src="<?php echo assets_back() ?>plugins/daterangepicker/moment.min.js"></script>
  <script src="<?php echo assets_back() ?>plugins/daterangepicker/daterangepicker.min.js"></script>
  <script src="<?php echo assets_back() ?>plugins/daterangepicker/id.js"></script>
  <script>
    function notifikasi(pesan,tipe, ico = '') {
      $.notify({
        // options
        icon: ico,
        message: pesan,
      },{
        // settings
        type: tipe,
        z_index: 9999
      });
    }
  </script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-gears"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('administrator/profile') ?>" class="dropdown-item">
            <i class="fa fa-gear mr-2"></i> Edit Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('administrator/edit_password') ?>" class="dropdown-item">
            <i class="fa fa-key mr-2"></i> Ganti Password 
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" id="logout" class="dropdown-item">
            <i class="fa fa-power-off mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url() ?>administrator" class="brand-link">
      <img src="<?php echo assets_back() ?>img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">JasTip Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo assets_back() ?>img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('nama_lengkap') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('administrator') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-folder-open-o"></i>
              <p>
                Produk
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('administrator/tambah_produk') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Tambah Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('administrator/produk') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Daftar Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('administrator/kategori_produk') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Kategori Produk</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>
                Order
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/order_masuk') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pesanan Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/data_order') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Semua Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('administrator/ongkir') ?>" class="nav-link">
              <i class="nav-icon fa fa-truck"></i>
              <p>
                Biaya Pengiriman
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-bar-chart"></i>
              <p>
                Laporan
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/laporan_penjualan') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/laporan_ongkir') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pemasukan Ongkir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/laporan_jastip') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pemasukan Biaya Jasa</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-gear"></i>
              <p>
                Pengaturan
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/konfigurasi_toko') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Konfigurasi Toko</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/gambar_slider') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pengaturan Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/rekening') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rekening Toko</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Pengguna
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/data_admin') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('administrator/data_pelanggan') ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <?php echo $contents; ?>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0-alpha
    </div>
    <strong>Copyright &copy; 2018 <a href="<?php echo base_url() ?>">JasTip</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Bootstrap 4 -->
<script src="<?php echo assets_back() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo assets_back() ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo assets_back() ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo assets_back() ?>js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo assets_back() ?>js/demo.js"></script>

<script>
  $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $("#logout").click(function() {
      swal({
        title: 'Logout ?',
        text: "Akun Anda Akan Logout!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
          window.location.href="<?php echo base_url('administrator/logout') ?>"
        }
      })
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });   
  });
</script>
<?php echo $this->session->flashdata('notifikasi'); ?>
</body>
</html>
