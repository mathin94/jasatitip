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
            <li class="breadcrumb-item">Laporan Penjualan</li>
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
                  <h3><?php echo $title ?> <?php echo date('d/m/y') ?></h3>
                </div>
                <div class="col-md-4 text-center">
                </div>
                <div class="col-md-3 text-right">
                <!-- Date range -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">

                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="periode" value="<?php echo date('d/m/Y') . ' - ' . date('d/m/Y') ?>">
                  </div>

                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                </div>
                <div class="col-md-1 text-right">
                  <button type="button" class="btn btn-default btn-md" id="cari"><i class="fa fa-search"></i> Cari</button>
                </div>
                
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" id="table-order" style="margin-bottom: 10px">
                <thead>
                  <tr>
                    <th width="10">No</th>
                    <th width="150">Kode Transaksi</th>
                    <th width="150">E-Mail Pengguna</th>
                    <th width="150">Username</th>
                    <th width="150">Tanggal Transaksi</th>
                    <th width="200">Total Pembayaran</th>
                  </tr>
                </thead>
                <tbody></tbody>
                  
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
  //Date range picker
  $('#periode').daterangepicker({
    opens: 'left',
    locale: {
      applyButtonClasses: "btn-success",
      cancelLabel: 'Batal',
      applyLabel: 'Pilih',
      format: 'DD/MM/YYYY',
      changeMonth: true,
    }
  });



  var table;
  $(document).ready(function() {

      //datatables
      table = $('#table-order').DataTable({ 
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "processing": true, 
          "serverSide": true, 
          "order": [], 
           
          "ajax": {
              "url": "<?php echo site_url('ajax/json_laporan') ?>",
              "type": "POST"
          },
          "columnDefs": [
          { 
              "targets": [ 0 ], 
              "orderable": false, 
          },
          ],

      });

      $("#cari").click(function() {
        var tglawal = $("#periode").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var tglakhir = $("#periode").data('daterangepicker').endDate.format('YYYY-MM-DD');
      });

  });
  
</script>
