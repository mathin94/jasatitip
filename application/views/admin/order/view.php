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
            <li class="breadcrumb-item"><a href="#">Pesanan</a></li>
            <li class="breadcrumb-item"><a href="#">Pesanan Masuk</a></li>
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
              <table class="table table-bordered" id="table-order" style="margin-bottom: 10px">
                <thead>
                  <tr>
                    <th width="10">No</th>
                    <th width="150">Kode Transaksi</th>
                    <th width="150">E-Mail Pengguna</th>
                    <th width="300">Total Pembayaran</th>
                    <th width="120">Status</th>
                    <th width="200" class="text-center">Action</th>
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
  var table;
  $(document).ready(function() {

      //datatables
      table = $('#table-order').DataTable({ 
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "processing": true, 
          "serverSide": true, 
          "order": [], 
          "language": {
              "sSearch": "Pencarian :",
              "lengthMenu": "Menampilkan _MENU_ data per halaman",
              "zeroRecords": "Tidak ada data",
              "info": "Menampilkan Halaman _PAGE_ sampai _PAGES_",
              "infoEmpty": "Tidak ada data",
              "infoFiltered": "(memfilter dari _MAX_ total data)",
              "paginate": {
                  "sFirst": "Pertama", // This is the link to the first page
                  "sPrevious": "Sebelumnya", // This is the link to the previous page
                  "sNext": "Selanjutnya", // This is the link to the next page
                  "sLast": "Akhir" // This is the link to the last page
              },
          },
          "ajax": {
              "url": "<?php echo $url_json ?>",
              "type": "POST"
          },
          "columnDefs": [
          { 
              "targets": [ 0 ], 
              "orderable": false, 
          },
          ],

      });

  });
</script>
