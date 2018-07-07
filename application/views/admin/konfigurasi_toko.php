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

#img-favicon{
    width: 17px;
    height: 17px;
}
#img-logo{
    width: 133px;
    height: 17px;
}
</style>
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
            <li class="breadcrumb-item"><a href="#">Konfigurasi Toko</a></li>
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
                <h3 class="card-title">Konfigurasi Toko</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart('administrator/konfigurasi_toko', array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="varchar">Nama Website <?php echo form_error('nama_website') ?></label>
                    <input type="text" class="form-control" id="nama_website" name="nama_website" placeholder="Tulis Nama Website" value="<?php echo $identitas['nama_website'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Favicon Website</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgFavicon" name="favicon">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <br>
                    <img id='img-favicon' 
                    <?php  
                    if ($identitas['favicon']!='') {
                      echo "src='".base_url('assets/front/images/'.$identitas['favicon'])."'";
                    }
                    ?>
                    />
                  </div>
                  <div class="form-group">
                    <label>Logo Website</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgLogo" name="logo">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <br>
                    <img id='img-logo' 
                    <?php  
                    if ($identitas['logo']!='') {
                      echo "src='".base_url('assets/front/images/'.$identitas['logo'])."'";
                    }
                    ?>
                    />
                  </div>
                  <div class="form-group">
                    <label for="varchar">E-Mail <?php echo form_error('email') ?></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Tulis Alamat Email" value="<?php echo $identitas['email'] ?>" >
                  </div>
                  <div class="form-group">
                    <label for="varchar">URL Facebook <?php echo form_error('facebook') ?></label>
                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Tulis URL Facebook" value="<?php echo $identitas['facebook'] ?>" >
                  </div>
                  <div class="form-group">
                    <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Tulis Nomor Telepon" value="<?php echo $identitas['no_telp'] ?>" >
                  </div>
                  <div class="form-group">
                    <label for="id_provinsi">Provinsi</label>
                    <?php echo combo_provinsi($id_provinsi) ?>
                  </div>
                  <div class="form-group">
                    <label for="id_kabupaten">Kota / Kabupaten</label>
                    <select name="id_kabupaten" id="id_kabupaten" class="form-control" required="required">
                      <option value="">Pilih Kota / Kabupaten</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Alamat Toko <?php echo form_error('alamat') ?></label>
                    <textarea name="alamat" id="alamat" placeholder="Tulis Alamat Toko" class="form-control" cols="30" rows="5"><?php echo $identitas['alamat'] ?></textarea>
                  </div>
                </div>
                  
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <input type="hidden" name="id_identitas" value="<?php echo $identitas['id_identitas'] ?>">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <a href="/administrator" class="btn btn-default"><i class="fa fa-rotate-left"></i> Batal</a>
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

<script type="text/javascript">
  $(document).ready(function() {
    $("#id_provinsi").change(function() {
      var id=$(this).val();
      get_kabupaten(id,<?php echo $identitas['kabupaten_id'] ?>);
    });
    get_kabupaten(<?php echo $id_provinsi . ',' . $identitas['kabupaten_id'] ?>);
  });


  function get_kabupaten(id, select = 0) {
    $.ajax({
      url : "<?php echo base_url();?>administrator/get_kabupaten",
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

  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              $('#img-favicon').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#imgFavicon").change(function(){
      readURL(this);
  });

  function readURL2(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              $('#img-logo').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#imgLogo").change(function(){
      readURL2(this);
  });
  
  <?php if ($this->session->flashdata('update_identitas_ok') == 1): ?>
    swal(
      'Selamat!',
      'Perubahan Berhasil!',
      'success'
    )
  <?php endif ?>
</script>         