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
            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
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
              <?php echo form_open($form_url, array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="varchar">Nama Bank</label>
                    <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Tulis Nama Bank" value="<?php echo isset($row['nama_bank']) ? $row['nama_bank'] : '' ?>">
                    <?php echo form_error('nama_bank') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Cabang Bank</label>
                    <input type="text" class="form-control" id="cabang" name="cabang" placeholder="Tulis Cabang Bank" value="<?php echo isset($row['cabang']) ? $row['cabang'] : '' ?>">
                    <?php echo form_error('cabang') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Nomor Rekening</label>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="Tulis Nomor Rekening" value="<?php echo isset($row['no_rekening']) ? $row['no_rekening'] : '' ?>">
                    <?php echo form_error('no_rekening') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Nama</label>
                    <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Tulis Nama Pemilik Rekening" value="<?php echo isset($row['atas_nama']) ? $row['atas_nama'] : '' ?>">
                    <?php echo form_error('atas_nama') ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <a class="btn btn-default" href="<?php echo base_url('administrator/rekening') ?>"><i class="fa fa-rotate-left"></i> Batal</a>
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
