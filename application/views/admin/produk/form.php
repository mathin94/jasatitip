<style>
  .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload-1{
    width: 300px;
}
</style>
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
            <li class="breadcrumb-item"><a href="#">Produk</a></li>
            <li class="breadcrumb-item"><a href="#"><?php echo $title ?></a></li>
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
                <h3 class="card-title"><?php echo $title ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart($url_action, array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="varchar">Kode Produk</label>
                    <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Tulis Kode Produk" value="<?php echo isset($produk['kode_produk']) ? $produk['kode_produk'] : '' ?>">
                    <?php echo form_error('kode_produk') ?>
                  </div>
                  <div class="form-group <?php echo form_error('nama_produk') ? 'has-error has-feedback' : '' ?>">
                    <label for="varchar">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Tulis Nama Produk" value="<?php echo isset($produk['nama_produk']) ? $produk['nama_produk'] : '' ?>">
                    <?php echo form_error('nama_produk') ?>
                  </div>
                  <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <?php echo combo_kategori(isset($produk['kategori_id']) ? $produk['kategori_id'] : '') ?>
                    <?php echo form_error('kategori_id') ?>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga Produk" value="<?php echo isset($produk['harga']) ? $produk['harga'] : '' ?>" />
                    <?php echo form_error('harga') ?>
                  </div>
                  <div class="form-group">
                    <label for="harga">Fee Jasa Titip</label>
                    <input type="text" class="form-control" name="fee" id="fee" placeholder="Biaya Jasa Titipan" value="<?php echo isset($produk['fee_jastip']) ? $produk['fee_jastip'] : '' ?>" />
                    <?php echo form_error('fee') ?>
                  </div>
                  <div class="form-group">
                    <label for="berat">Berat</label>
                    <input type="text" class="form-control" name="berat" id="berat" placeholder="Isi Berat Produk (Satuan Gram)" value="<?php echo isset($produk['berat']) ? $produk['berat'] : '' ?>" />
                    <?php echo form_error('berat') ?>
                  </div>
                  <div class="form-group">
                    <label for="longtext">Deskripsi <?php echo form_error('deskripsi') ?></label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Tulis Deskripsi Produk ..."><?php echo isset($produk['deskripsi']) ? $produk['deskripsi'] : '' ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Pilih Gambar 1</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp1" name="gambar_1">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id='img-upload-1'
                    <?php  
                    if (isset($produk['gambar_1']) && $produk['gambar_1'] != '') {
                      echo "src='".base_url('assets/foto_produk/'.$produk['gambar_1'])."'";
                    }
                    ?>
                    />
                  </div>
                  <div class="form-group">
                    <label>Pilih Gambar 2</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp2" name="gambar_2">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id='img-upload-2'
                    <?php  
                    if (isset($produk['gambar_2']) && $produk['gambar_2'] != '') {
                      echo "src='".base_url('assets/foto_produk/'.$produk['gambar_2'])."'";
                    }
                    ?>
                    />
                  </div>
                  <div class="form-group">
                    <label>Pilih Gambar 3</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp3" name="gambar_3">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id='img-upload-3'
                    <?php  
                    if (isset($produk['gambar_3']) && $produk['gambar_3'] != '') {
                      echo "src='".base_url('assets/foto_produk/'.$produk['gambar_3'])."'";
                    }
                    ?>
                    />
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <input type="hidden" name="id_produk" value="<?php echo isset($produk['id_produk']) ? $produk['id_produk'] : '' ?>">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <a class="btn btn-default" href="<?php echo base_url('administrator/produk') ?>"><i class="fa fa-rotate-left"></i> Batal</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<script>
  function readURL(input, pic) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              if (pic == 1) {
                $('#img-upload-1').attr('src', e.target.result);
              } else if (pic == 2) {
                $('#img-upload-2').attr('src', e.target.result);
              } else {
                $('#img-upload-3').attr('src', e.target.result);
              }
              
          }
          
          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#imgInp1").change(function(){
      readURL(this, 1);
  });

  $("#imgInp2").change(function(){
      readURL(this, 2);
  });

  $("#imgInp3").change(function(){
      readURL(this, 3);
  });
</script>