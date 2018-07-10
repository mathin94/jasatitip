<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
            Users
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            <?php echo $title ?>
        </span>
    </div>
</div>
<!-- Register Page Start -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="col-md-8">
                    <p class='sidebar-title'><b> <?php echo $title ?></b></p> 
                    <br>
                    <div class="logincontainer">
                        <form method="post" action="<?php echo $url_form ?>" role="form" id='formku'>
                            <div class="form-group">
                                <label for="">Nama Alamat</label>
                                <input type="text" name="nama_alamat" class="required form-control" placeholder="Contoh : Alamat Rumah / Alamat Kantor / Alamar Orang Tua" autofocus=""  minlength='5' onkeyup="nospaces(this)" value="<?php echo isset($alamat['nama_alamat']) ? $alamat['nama_alamat'] : '' ?>">
                                <?php echo form_error('nama_alamat') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Penerima</label>
                                <input type="text" name="nama_penerima" class="required form-control" placeholder="Tulis Nama Lengkap Penerima" autofocus=""  minlength='5' onkeyup="nospaces(this)" value="<?php echo isset($alamat['nama_penerima']) ? $alamat['nama_penerima'] : '' ?>">
                                <?php echo form_error('nama_penerima') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Penerima</label>
                                <input type="text" name="nomor_penerima" class="required form-control" placeholder="Tulis Nomor Hp Penerima" autofocus=""  minlength='5' onkeyup="nospaces(this)" value="<?php echo isset($alamat['nomor_penerima']) ? $alamat['nomor_penerima'] : '' ?>">
                                <?php echo form_error('nomor_penerima') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <?php echo combo_provinsi(26141,"disabled='disabled'") ?>
                                <input type="hidden" id="id_prov" value="26141">
                            </div>
                            <div class="form-group">
                                <label for="id_kabupaten">Kota / Kabupaten</label>
                                <select name="id_kabupaten" id="id_kabupaten" class="form-control">
                                    <option value="">Pilih Kota / Kabupaten</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_kecamatan">Kecamatan</label>
                                <input type="hidden" class="kecid" value="<?php echo isset($alamat['kecamatan_id']) ? $alamat['kecamatan_id'] : '' ?>">
                                <select name="id_kecamatan" id="id_kecamatan" class="form-control">
                                    <option value="">-- Pilih Kecamatan --</option>
                                </select>
                                <?php echo form_error('id_kecamatan') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="5" class="form-control" placeholder="Tulis Alamat Lengkap"><?php echo isset($alamat['alamat_lengkap']) ? $alamat['alamat_lengkap'] : '' ?></textarea>
                                <?php echo form_error('alamat_lengkap') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Kode Pos</label>
                                <input type="text" name="kode_pos" class="required form-control" placeholder="Tulis Kode Pos" autofocus=""  minlength='5' onkeyup="nospaces(this)" value="<?php echo isset($alamat['kode_pos']) ? $alamat['kode_pos'] : '' ?>">
                                <?php echo form_error('kode_pos') ?>
                            </div>
                            <br>
                            <div align="center">
                                <input name='submit' type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" value="Simpan">
                            </div>
                        </form>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $("#id_kabupaten").change(function() {
        get_kecamatan($(this).val());
    });

    <?php if (!empty($alamat)): ?>
    $.ajax({
      url : "<?php echo base_url('ajax/get_kecamatan_byid');?>",
      method : "POST",
      data : {
        id_kecamatan: $(".kecid").val()
      },
      dataType : 'json',
      success: function(data){
        if (data==null) {
            get_kabupaten($("#id_provinsi").val());
        } else {
            $("#id_provinsi").val(data.id_provinsi);
            get_kabupaten(data.id_provinsi,data.id_kabupaten);
            get_kecamatan(data.id_kabupaten, data.id_kecamatan);
        }
      }
    });   
    <?php else: ?>
       get_kabupaten($("#id_provinsi").val()); 
    <?php endif ?>
});


function get_kabupaten(id, select = 0) {
    $.ajax({
      url : "<?php echo base_url('ajax/get_kabupaten');?>",
      method : "POST",
      data : {
        id_provinsi: id,
        selected: select
      },
      async : false,
      dataType : 'html',
      success: function(data){
        $('#id_kabupaten').html(data);
      }
    });
}

function get_kecamatan(id, select = 0) {
    $.ajax({
      url : "<?php echo base_url('ajax/get_kecamatan');?>",
      method : "POST",
      data : {
        id_kabupaten: id,
        selected: select
      },
      async : false,
      dataType : 'html',
      success: function(data){
        $('#id_kecamatan').html(data);
      }
    });
}


</script>   
