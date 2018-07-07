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
      Konfirmasi Pembayaran
    </span>
  </div>
</div>
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <?php echo form_open_multipart(base_url() . 'pemesanan/konfirmasi_pembayaran/' . $this->uri->segment(3), array('class'=>'form-horizontal','role'=>'form')); ?>
          <div class="form-group">
            <label for="">Kode Transaksi</label>
            <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $order['kode_transaksi'] ?>" readonly>

          </div>
          <div class="form-group">
            <label for="">Nama Pengirim</label>
            <input type="text" class="form-control" name="nama_pengirim" placeholder="Nama Pengirim" value="<?php echo isset($post['nama_pengirim']) ? $post['nama_pengirim'] : '' ?>">
            <?php echo form_error('nama_pengirim') ?>
          </div>
          <div class="form-group">
            <label for="">Nama Bank</label>
            <input type="text" class="form-control" name="bank_pengirim" placeholder="Nama Bank Pengirim" value="<?php echo isset($post['bank_pengirim']) ? $post['bank_pengirim'] : '' ?>">
            <?php echo form_error('bank_pengirim') ?>
          </div>
          <div class="form-group">
            <label for="">Rekening Pengirim</label>
            <input type="text" class="form-control" name="rekening_pengirim" placeholder="Nomor Rekening Pengirim" value="<?php echo isset($post['rekening_pengirim']) ? $post['rekening_pengirim'] : '' ?>">
            <?php echo form_error('rekening_pengirim') ?>
          </div>
          <div class="form-group">
            <label for="">Rekening Tujuan</label>
            <?php echo combo_rekening(isset($post['rekening_tujuan']) ? $post['rekening_tujuan'] : '') ?>
            <?php echo form_error('rekening_tujuan') ?>
          </div>
          <div class="form-group">
            <label for="">Jumlah Transfer</label>
            <input type="text" class="form-control" name="jumlah_transfer" placeholder="Nominal Transfer" value="<?php echo $order['total_harga']+$order['total_ongkir']+$order['kode_unik'] ?>" readonly>
          </div>
          <div class="form-group">
            <div class="input-group input-file" name="bukti_transfer">
              <span class="input-group-btn">
                </span>
                <input type="text" class="form-control" name="bukti" placeholder='Bukti Transfer...' />
                <span class="input-group-btn">
                    <input type="hidden" name="submit">
                     <button class="btn btn-danger btn-reset" type="button">Hapus</button>
                     <button class="btn btn-info btn-choose" type="button">Pilih</button>
                </span>
            </div>
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
function bs_input_file() {
  $(".input-file").before(
    function() {
      if ( ! $(this).prev().hasClass('input-ghost') ) {
        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
        element.attr("name",$(this).attr("name"));
        element.change(function(){
          element.next(element).find('input').val((element.val()).split('\\').pop());
        });
        $(this).find("button.btn-choose").click(function(){
          element.click();
        });
        $(this).find("button.btn-reset").click(function(){
          element.val(null);
          $(this).parents(".input-file").find('input').val('');
        });
        $(this).find('input').css("cursor","pointer");
        $(this).find('input').mousedown(function() {
          $(this).parents('.input-file').prev().click();
          return false;
        });
        return element;
      }
    }
  );
}
$(function() {
  bs_input_file();
});

$(".batal").click(function() {
  window.location.href="<?php echo base_url('pemesanan') ?>"
});
</script>