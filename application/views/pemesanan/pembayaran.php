<!-- breadcrumb -->
<div class="container">
  <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
    <a href="<?php echo base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
      Home
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <a href="<?php echo base_url('pemesanan') ?>" class="stext-109 cl8 hov-cl1 trans-04">
      Pemesanan
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <span class="stext-109 cl4">
      Pembayaran
    </span>
  </div>
</div>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <h4 class="mtext-105 cl2 txt-center p-b-30" style="margin-top: -100px">
          Kode Transaksi : <?php echo $kode_transaksi ?>
        </h4>
    <div class="flex-w flex-tr">
      <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
        <h4 class="mtext-105 cl2 txt-center p-b-30">
          Total Pesanan
        </h4>
        <h5 class="mtext-105 cl2 txt-center p-b-30">
          <?php echo $total ?>
        </h5>
        <h6 class="txt-center p-b-30 stext-111">
          Silahkan Bayarkan Sesuai dengan nominal yang tertera ke nomer rekening di sebelah kanan, Lalu Tekan Konfirmasi Bayar Jika Sudah Melakukan Pembayaran
        </h6>
        <div class="text-center">
          <button type="button" class="btn btn-success konf">Konfirmasi Pembayaran</button>
        </div>
      </div>

      <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
        <?php foreach ($this->db->get('rekening_bank')->result() as $rek): ?>
        <div class="flex-w w-full p-b-42">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="fa fa-bank"></span>
          </span>

          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              <?php echo $rek->nama_bank ?>
            </span>

            <p class="stext-115 cl6 size-213 p-t-18">
              A/N : <?php echo $rek->atas_nama ?>
            </p>
            <p class="stext-115 cl6 size-213 p-t-18">
              No Rekening : <?php echo $rek->no_rekening ?>
            </p>
            <p class="stext-115 cl6 size-213 p-t-18">
              Cabang : <?php echo $rek->cabang ?>
            </p>
          </div>
        </div>  
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>
<script>
$(document).ready(function() {
  $('.konf').click(function() {
    window.location.href="<?php echo base_url('pemesanan/konfirmasi_pembayaran/'.$this->uri->segment(3)) ?>"
  });
});
</script>