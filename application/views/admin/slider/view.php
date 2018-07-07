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
            <li class="breadcrumb-item"><a href="#">Pengaturan Slider</a></li>
            <li class="breadcrumb-item"><a href="#">Daftar Slider</a></li>
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
                  <?php echo anchor(site_url('administrator/tambah_gambar_slider'),'Tambah Slider', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                  <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                  </div>
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
                  <th>Slider</th>
                  <th>Judul</th>
                  <th>Caption</th>
                  <th style="text-align:center">Action</th>
                  </tr>
                  <?php $start = 0 ?>
                  <?php if (!empty($slider)): ?>
                    <?php foreach ($slider as $slide): ?>
                      <tr>
                        <td width="10px" style="text-align:center"><?php echo ++$start ?></td>
                        <td><img src="<?php assets_front('images/slider/'.$slide->gambar) ?>" class="img-responsive" alt="" width="200px"></td>
                        <td><?php echo $slide->judul ?></td>
                        <td><?php echo $slide->caption ?></td>
                        <td style="text-align:center" width="100px">
                          <?php 
                          echo anchor(site_url('administrator/edit_gambar_slider/'.$slide->id_slider),'<i class="fa fa-edit"></i>'); 
                          echo ' '; 
                          ?>
                          <a href="#" onclick="delete_slider(<?php echo $slide->id_slider ?>)"><i class="fa fa-trash"></i></a>
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
  function delete_slider(id) {
    var id_slider = id;
    swal({
        title: 'Hapus Slider ?',
        text: "Gambar Slider Akan Dihapus !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href="<?php echo base_url() ?>administrator/delete_gambar_slider/"+id_slider
        }
    })
  }
</script>
