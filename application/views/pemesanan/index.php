<!-- breadcrumb -->
<div class="container">
  <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
    <a href="<?php echo base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
      Home
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <span class="stext-109 cl4">
      Data Pemesanan
    </span>
  </div>
</div>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <h4 class="mtext-105 cl2 txt-center p-b-30" style="margin-top: -100px">
      Data Transaksi Pemesanan
    </h4>
    <div class="row">
      <table class="table table-bordered" id="table-order">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Total Pembayaran</th>
            <th class="text-center">Status</th>
            <th class="text-center" width="300">Action</th>
          </tr>
        </thead>
        <tbody>
         
        </tbody>
      </table>
    </div>
  </div>
</section>

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
             
            "ajax": {
                "url": "<?php echo site_url('pemesanan/json_pemesanan')?>",
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
