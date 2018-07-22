<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Konfirmasi Pengiriman</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pengiriman</a></li>
            <li class="breadcrumb-item">Konfirmasi</li>
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
              <?php echo form_open(site_url('administrator/konfirmasi_kirim/'.$this->uri->segment(3)), array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="varchar">Kode Transaksi</label>
                    <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" placeholder="" value="<?php echo isset($order['kode_transaksi']) ? $order['kode_transaksi'] : '' ?>" readonly>
                    <?php echo form_error('kode_transaksi') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Nama Kurir</label>
                    <input type="text" class="form-control" id="nama_kurir" name="nama_kurir" placeholder="Tulis Nama Kurir" value="<?php echo isset($order['nama_kurir']) ? $order['nama_kurir'] : '' ?>" autofocus>
                    <?php echo form_error('nama_kurir') ?>
                  </div>
                  <div class="form-group">
                    <label for="kategori_id">Nomor Kurir</label>
                    <input type="text" class="form-control" id="nomor_kurir" name="nomor_kurir" placeholder="Tulis Nomor Kurir" value="<?php echo isset($order['nomor_kurir']) ? $order['nomor_kurir'] : '' ?>">
                    <?php echo form_error('nomor_kurir') ?>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Konfirmasi</button>
                  <a class="btn btn-default" href="<?php echo base_url('administrator/data_order') ?>"><i class="fa fa-rotate-left"></i> Batal</a>
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

