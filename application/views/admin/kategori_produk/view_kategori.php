<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Kategori Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Produk</a></li>
            <li class="breadcrumb-item"><a href="#">Kategori</a></li>
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
                  <?php echo anchor(site_url('administrator/tambah_kategori_produk'),'Tambah Kategori', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                  <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                  </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" style="margin-bottom: 10px">
                <tr>
                  <th style="text-align:center">No</th>
                  <th>Nama Kategori Produk</th>
                  <th style="text-align:center">Action</th>
                  </tr><?php
                  $start = 0;
                  foreach ($record as $row)
                  {
                    ?>
                    <tr>
                      <td width="10px" style="text-align:center"><?php echo ++$start ?></td>
                      <td><?php echo $row->nama_kategori ?></td>
                      <td style="text-align:center" width="100px">
                        <a href="#" onclick="delete_kategori(<?php echo $row->id_kategori ?>,'<?php echo $row->nama_kategori ?>')" title=""><i class="fa fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
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
  function delete_kategori(id, nama) {
    swal({
        title: 'Hapus Kategori '+nama+' ?',
        text: "Hapus Kategori Dapat Dilakukan jika tidak ada produk yang menggunakan kategori ini !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href="<?php echo base_url() ?>administrator/delete_kategori_produk/"+id
        }
    })
  }
</script>