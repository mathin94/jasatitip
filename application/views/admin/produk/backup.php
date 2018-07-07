<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Produk</a></li>
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
                  <?php echo anchor(site_url('administrator/tambah_produk'),'Tambah Produk', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                  <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                  </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                  <form action="<?php echo site_url('administrator/produk'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                      <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                      <span class="input-group-btn">
                        <?php 
                        if ($q <> '')
                        {
                          ?>
                          <a href="<?php echo site_url('administrator/produk'); ?>" class="btn btn-default">Reset</a>
                          <?php
                        }
                        ?>
                        <button class="btn btn-primary" type="submit">Search</button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" style="margin-bottom: 10px">
                <tr>
                  <th style="text-align:center">No</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                  <th>Berat</th>
                  <th style="text-align:center">Action</th>
                  </tr><?php
                  foreach ($produk_data as $produk)
                  {
                    ?>
                    <tr>
                      <td width="10px" style="text-align:center"><?php echo ++$start ?></td>
                      <td><?php echo $produk->kode_produk ?></td>
                      <td><?php echo $produk->nama_produk ?></td>
                      <td><?php echo $produk->nama_kategori ?></td>
                      <td><?php echo format_rupiah($produk->harga) ?></td>
                      <td><?php echo format_berat($produk->berat) ?></td>
                      <td style="text-align:center" width="100px">
                        <?php 
                        echo anchor(site_url('administrator/view_produk/'.$produk->id_produk),'<i class="fa fa-eye"></i>'); 
                        echo ' '; 
                        echo anchor(site_url('administrator/edit_produk/'.$produk->id_produk),'<i class="fa fa-edit"></i>'); 
                        echo ' '; 
                        ?>
                        <a href="#" onclick="delete_produk(<?php echo $produk->id_produk ?>,'<?php echo $produk->nama_produk ?>')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </table>
                <div class="row">
                  <div class="col-md-6">
                    <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                  </div>
                  <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                  </div>
                </div>
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
  function delete_produk(id, nama) {
    var id_produk = id;
    var nama_produk = nama;
    swal({
        title: 'Hapus Produk '+nama_produk+' ?',
        text: "Produk ini akan dihapus !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href="<?php echo base_url() ?>administrator/delete_produk/"+id_produk
        }
    })
  }
</script>