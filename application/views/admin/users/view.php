<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item"><a href="#"><?php echo $title ?></a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-default">
            <div class="card-header">
              <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                  <h3><?php echo $title ?></h3>
                </div>
                <div class="col-md-4 text-center">
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                  <?php if ($act == 'administrator'): ?>
                  <a href="<?php echo base_url('administrator/tambah_admin') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Admin</a>
                  <?php endif ?>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" id="tabel-user" style="margin-bottom: 10px">
                <thead>
                  <tr>
                    <?php if ($act == 'pelanggan'): ?>
                    <th width="10">No</th>
                    <th width="150">Username</th>
                    <th width="150">E-Mail</th>
                    <th width="300">Nama Lengkap</th>
                    <th width="300">Waktu Daftar</th>
                    <th width="120" class="text-center">Aktif</th>
                    <th width="120">Action</th>  
                    <?php endif ?>
                    
                    <?php if ($act == 'administrator'): ?>
                    <th width="10">No</th>
                    <th width="150">Username</th>
                    <th width="150">E-Mail</th>
                    <th width="300">Nama Lengkap</th>
                    <th width="200">Waktu Terdaftar</th>
                    <th width="50" class="text-center">Aktif</th>
                    <th width="650" class="text-center">Action</th>
                    <?php endif ?>
                  </tr> 
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
  var table;
  $(document).ready(function() {
    //datatables
    table = $('#tabel-user').DataTable({ 
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "processing": true, 
      "serverSide": true, 
      "order": [], 

      "ajax": {
        "url": "<?php echo $url_ajax ?>",
        "type": "POST"
      },
      "columnDefs": [
      { 
        "targets": [ 0 ], 
        "orderable": false, 
      },
      ],

    });

  });

<?php if ($act == 'administrator'): ?>



function delete_admin(id,nama) {
  swal({
    title: 'Delete User '+nama+' ?',
    text: "User "+nama+" Akan Dihapus, Aksi Tidak Dapat Di batalkan !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'red',
    confirmButtonText: 'Reset !',
    cancelButtonText: 'Batal'
  }).then((result) => {
  
    if (result.value) {
      $.ajax({
        url: '<?php echo base_url('ajax/delete_admin') ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {
          id_user: id
        },
        success: function(data){
          $('#tabel-user').DataTable().ajax.reload();
          notifikasi("User " + nama + " Telah Di Hapus", "danger", "fa fa-check");
        }
      });
    }
  });
}

<?php endif ?>

function reset_pass(id,nama) {
  swal({
    title: 'Reset Password User '+nama+' ?',
    text: "Password User "+nama+" Akan Dikembalikan Ke Semula !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'blue',
    confirmButtonText: 'Reset !',
    cancelButtonText: 'Batal'
  }).then((result) => {
  
    if (result.value) {
      $.ajax({
        url: '<?php echo base_url('ajax/reset_pass') ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {
          id_user: id,
          username: nama
        },
        success: function(data){
          $('#tabel-user').DataTable().ajax.reload();
          notifikasi("Password User " + nama + " Telah Di Reset", "success", "fa fa-check");
        }
      });
    }
  });
}

function activate(id,nama) {
  swal({
    title: 'Aktifkan User '+nama+' ?',
    text: "User "+nama+" Akan Di Aktifkan Keanggotaan nya !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'blue',
    confirmButtonText: 'Aktifkan !',
    cancelButtonText: 'Batal'
  }).then((result) => {
  
    if (result.value) {
      $.ajax({
        url: '<?php echo base_url('ajax/activate_user') ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {id_user: id},
        success: function(data){
          $('#tabel-user').DataTable().ajax.reload();
          notifikasi("User " + nama + " Telah Di Aktifkan Keanggotaannya", "success", "fa fa-check");
        }
      });
    }
  });
}

function deactivate(id,nama) {
  swal({
    title: 'Nonaktifkan User '+nama+' ?',
    text: "User "+nama+" Akan Di Nonaktifkan Keanggotaan nya !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'red',
    confirmButtonText: 'Nonaktifkan !',
    cancelButtonText: 'Batal'
  }).then((result) => {
  
    if (result.value) {
      $.ajax({
        url: '<?php echo base_url('ajax/deactivate_user') ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {id_user: id},
        success: function(data){
          $('#tabel-user').DataTable().ajax.reload();
          notifikasi("User " + nama + " Telah Di Nonaktifkan Keanggotaannya", "danger", "fa fa-check");
        }
      });
    }
  });
}
 
</script>
