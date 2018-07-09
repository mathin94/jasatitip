<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar Biaya Pengiriman</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Biaya Kirim</a></li>
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
                  <?php echo anchor(site_url('administrator/tambah_ongkir'),'Tambah Ongkir', 'class="btn btn-primary"'); ?>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" id="table-ongkir" style="margin-bottom: 10px">
                <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th>Kota / Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Biaya Kirim (per kilogram)</th>
                    <th style="text-align:center">Action</th>
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
      table = $('#table-ongkir').DataTable({ 
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
              "url": "<?php echo site_url('ajax/json_all_ongkir') ?>",
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

  function delete_ongkir(id, nama) {
    var id_ongkir = id;
    var nama_alamat = nama;
    swal({
        title: 'Hapus Ongkir '+nama_alamat+' ?',
        text: "Biaya Kirim ini akan dihapus !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href="<?php echo base_url() ?>administrator/delete_ongkir/"+id_ongkir
        }
    });
  }
</script>