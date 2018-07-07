<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <h3 class="card-title">Tambah Kategori Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('administrator/tambah_kategori_produk', array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_kategori">Nama Kategori Produk</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Tulis Nama Kategori">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <button type="button" onclick="window.history.back()" class="btn btn-default"><i class="fa fa-rotate-left"></i> Batal</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper