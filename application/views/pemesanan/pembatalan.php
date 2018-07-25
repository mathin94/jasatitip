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
      Pengajuan Pembatalan
    </span>
  </div>
</div>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <?php echo form_open(base_url() . 'pemesanan/pembatalan/' . $this->uri->segment(3), array('class'=>'form-horizontal','role'=>'form')); ?>
          <div class="form-group">
            <label for="">Kode Transaksi</label>
            <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $post['kode_transaksi'] ?>" readonly>

          </div>
          <div class="form-group">
            <label for="">Nama Bank</label>
            <input type="text" class="form-control" name="nama_bank" placeholder="Nama Bank" value="<?php echo isset($post['nama_bank']) ? $post['nama_bank'] : '' ?>">
            <?php echo form_error('nama_bank') ?>
          </div>
          <div class="form-group">
            <label for="">Nomor Rekening</label>
            <input type="text" class="form-control" name="nomor_rekening" placeholder="Nomor Rekening Bank" value="<?php echo isset($post['nomor_rekening']) ? $post['nomor_rekening'] : '' ?>">
            <?php echo form_error('nomor_rekening') ?>
          </div>
          <div class="form-group">
            <label for="">Nama Pemilik Rekening</label>
            <input type="text" class="form-control" name="atas_nama" placeholder="Nama Pemilik Rekening" value="<?php echo isset($post['atas_nama']) ? $post['atas_nama'] : '' ?>">
            <?php echo form_error('atas_nama') ?>
          </div>
          <div class="form-group">
            <label for="">Alasan Pembatalan</label>
            <input type="text" class="form-control" name="alasan_pembatalan" placeholder="Tulis Alasan Pembatalan" value="<?php echo isset($post['alasan_pembatalan']) ? $post['alasan_pembatalan'] : '' ?>">
            <?php echo form_error('alasan_pembatalan') ?>
          </div>
          <div class="text-right">
            <input type="hidden" name="submit">
            <button type="button" class="btn btn-danger batal">Kembali</button>
            <button type="submit" class="btn btn-success">Batalkan Pesanan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>

$(".batal").click(function() {
  window.location.href="<?php echo base_url('pemesanan') ?>"
});
</script>