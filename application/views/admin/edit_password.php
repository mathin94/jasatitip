<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Data Produk</h1> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Edit Password</a></li>
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
                  <legend>Edit Password</legend>
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
              <?php echo validation_errors(); ?>              
              <?php echo $this->session->flashdata('password_check'); ?>              
              <?php echo form_open(base_url('administrator/edit_password'), array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="form-group">
                  <label for="">Password Lama</label>
                  <input type="password" class="form-control" name="password_lama" placeholder="Tulis Password Lama Anda" >
                </div>
                <div class="form-group">
                  <label for="">Password Baru</label>
                  <input type="password" class="form-control" name="password_baru" placeholder="Tulis Password Baru" >
                </div>
                <div class="form-group">
                  <label for="">Konfirmasi Password Baru</label>
                  <input type="password" class="form-control" name="konfirmasi_password" placeholder="Konfirmasi Password Baru" >
                </div>
                <input type="hidden" name="submit" value="">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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