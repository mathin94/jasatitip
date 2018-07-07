<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo $title ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('administrator/data_admin') ?>">Data Admin</a></li>
            <li class="breadcrumb-item"><?php echo $title ?></li>
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
              <?php echo form_open(site_url('administrator/tambah_admin'), array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="username" class="form-control" placeholder="Tulis Nama Lengkap" value="<?php echo isset($admin['nama_lengkap']) ? $admin['nama_lengkap'] : '' ?>">
                    <?php echo form_error('nama_lengkap') ?>
                  </div>
                  <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Tulis Username" value="<?php echo isset($admin['username']) ? $admin['username'] : '' ?>">
                    <?php echo form_error('username') ?>
                  </div>
                  <div class="form-group">
                    <label for="">Alamat E-Mail</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Tulis E-Mail" value="<?php echo isset($admin['email']) ? $admin['email'] : '' ?>">
                    <?php echo form_error('email') ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <input type="hidden" name="id_user" value="value="<?php echo isset($admin['id_user']) ? $admin['id_user'] : '' ?>"">
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