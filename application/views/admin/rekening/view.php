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
            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
            <li class="breadcrumb-item"><a href="#">Rekening Toko</a></li>
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
                  <?php echo anchor(site_url('administrator/tambah_rekening'),'Tambah Rekening', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                  
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" style="margin-bottom: 10px">
                <tr>
                  <th style="text-align:center">No</th>
                  <th>Nama Bank</th>
                  <th>Nomor Rekening</th>
                  <th>Nama</th>
                  <th style="text-align:center">Action</th>
                  </tr>
                  <?php $start = 0 ?>
                  <?php if (!empty($rekening)): ?>
                    <?php foreach ($rekening as $row): ?>
                      <tr>
                        <td width="10px" style="text-align:center"><?php echo ++$start ?></td>
                        <td><?php echo $row->nama_bank ?></td>
                        <td><?php echo $row->no_rekening ?></td>
                        <td><?php echo $row->atas_nama ?></td>
                        <td style="text-align:center" width="100px">
                          <?php 
                          echo anchor(site_url('administrator/edit_rekening/'.$row->id_rekening),'<i class="fa fa-edit"></i>'); 
                          echo ' '; 
                          ?>
                          <a href="#" onclick="delete_rekening(<?php echo $row->id_rekening ?>)"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  <?php endif ?>
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
<!-- /.content-wrapper -->

<script>
  function delete_rekening(id) {
    var id_rek = id;
    swal({
        title: 'Hapus Rekening ?',
        text: "Nomor Rekening Bank Akan Dihapus !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href="<?php echo base_url() ?>administrator/delete_rekening/"+id_rek
        }
    })
  }
</script>

