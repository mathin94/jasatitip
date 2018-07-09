<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Produk</li>
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
                  <?php echo anchor(site_url('administrator/tambah_produk'),'Tambah Produk', 'class="btn btn-primary"'); ?>
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
              <table class="table table-bordered" id="table-produk">
                <thead>
                  <tr>
                    <th style="text-align:center">No</th>
                    <th>Foto Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Berat</th>
                    <th style="text-align:center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
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
        table = $('#table-produk').DataTable({ 
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
              "zeroRecords": "Tidak ada data produk",
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
                "url": "<?php echo site_url('produk/json_produk')?>",
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

  function delete_produk(id, nama) {
    var id_produk = id;
    var nama_produk = nama;
    swal({
        title: 'Hapus Produk '+nama_produk+' ?',
        text: "Produk ini akan dihapus !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href="<?php echo base_url() ?>administrator/delete_produk/"+id_produk
        }
    })
  }
</script>