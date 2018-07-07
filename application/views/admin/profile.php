</style>
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
                <h3 class="card-title"><?php echo $title ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open(base_url('administrator/profile'), array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="varchar">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Tulis Nama Lengkap" value="<?php echo isset($users['nama_lengkap']) ? $users['nama_lengkap'] : '' ?>">
                    <?php echo form_error('nama_lengkap') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Alamat Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Tulis email" value="<?php echo isset($users['email']) ? $users['email'] : '' ?>">
                    <?php echo form_error('email') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Tulis Username" value="<?php echo isset($users['username']) ? $users['username'] : '' ?>">
                    <?php echo form_error('username') ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="col-md-5">
                  <div class="input-group">
                  <input type="password" name="password" class="form-control" placeholder="Masukan Password Anda">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <a class="btn btn-default" href="<?php echo base_url('administrator') ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                  </div>  
                  </div>
                  <input type="hidden" name="submit">
                  
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
