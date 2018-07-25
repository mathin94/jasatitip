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
      Konfirmasi Penerimaan Barang
    </span>
  </div>
</div>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <?php echo form_open(base_url() . 'pemesanan/konfirmasi_penerimaan/' . $this->uri->segment(3), array('class'=>'form-horizontal','role'=>'form')); ?>
          <div class="form-group">
            <label for="">Kode Transaksi</label>
            <input type="hidden" name="id_pemesanan" value="<?php echo $post['id_pemesanan'] ?>">
            <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $post['kode_transaksi'] ?>" readonly>

          </div>
          <div class="form-group">
            <label for="">Nama Penerima</label>
            <input type="text" class="form-control" name="nama_penerima" placeholder="Nama Penerima" value="<?php echo isset($post['nama_penerima']) ? $post['nama_penerima'] : '' ?>">
            <?php echo form_error('nama_penerima') ?>
          </div>
          <div class="text-right">
            <input type="hidden" name="submit">
            <button type="button" class="btn btn-danger batal">Batal</button>
            <button type="submit" class="btn btn-success">Konfirmasi</button>
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