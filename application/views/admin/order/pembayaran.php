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
            <li class="breadcrumb-item"><a href="<?php echo base_url('administrator/order_masuk') ?>">Pesanan</a></li>
            <li class="breadcrumb-item"><a href="#">Cek Pembayaran Masuk</a></li>
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
                  <h3><?php echo $title ?></h3>
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
                  <th>Kode Transaksi</th>
                  <th>Pengirim</th>
                  <th>Rekening Tujuan</th>
                  <th width="150">Jumlah Transfer</th>
                  <th style="text-align:center">Action</th>
                  </tr>
                  <?php $start = 0 ?>
                  <?php if (!empty($pembayaran)): ?>
                    <?php foreach ($pembayaran as $row): ?>
                      <tr>
                        <td width="10px" style="text-align:center"><?php echo ++$start ?></td>
                        <td><?php echo $row->kode_transaksi ?></td>
                        <td><?php echo $row->nama_pengirim . ' - ' . $row->bank_pengirim . ' - ' . $row->rekening_pengirim ?></td>
                        <td><?php echo $row->rekening_tujuan ?></td>
                        <td><?php echo format_rupiah($row->jumlah_transfer) ?></td>
                        <td style="text-align:center">
                          <a href="<?php echo base_url('administrator/konfirmasi_pembayaran/'.$row->kode_transaksi) ?>" onclick=""> Konfirmasi</a>
                          <?php if ($row->bukti_transfer != ''): ?>
                          | <a href="<?php echo base_url('assets/bukti_transfer/'.$row->bukti_transfer) ?>" target="_blank"> Bukti Transfer</a>
                            
                          <?php endif ?>
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
