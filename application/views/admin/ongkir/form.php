<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php echo $title ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Biaya Pengiriman</a></li>
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
              <?php echo form_open($form_post_url, array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="id_provinsi">Provinsi</label>
                    <?php echo combo_provinsi(isset($ongkir['id_provinsi']) ? $ongkir['id_provinsi'] : 26141, 'disabled') ?>
                  </div>
                  <div class="form-group">
                    <label for="id_kabupaten">Kota / Kabupaten</label>
                    <select name="id_kabupaten" id="id_kabupaten" class="form-control">
                      <option value="">-- Pilih Kota / Kabupaten --</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_kecamatan">Kecamatan</label>
                    <select name="id_kecamatan" id="id_kecamatan" class="form-control">
                      <option value="">-- Pilih Kecamatan --</option>
                    </select>
                    <?php echo form_error('id_kecamatan') ?>
                  </div>
                  <div class="form-group">
                    <label for="biaya">Biaya Kirim Per Kg</label>
                    <input type="text" name="biaya" id="biaya" class="form-control" placeholder="Tulis Biaya Kirim" value="<?php echo isset($ongkir['biaya']) ? $ongkir['biaya'] : '' ?>">
                    <?php echo form_error('biaya') ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <input type="hidden" name="id_ongkir" value="value="<?php echo isset($ongkir['id_ongkir']) ? $ongkir['id_ongkir'] : '' ?>"">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <button type="button" onclick="window.history.back()" class="btn btn-default"><i class="fa fa-rotate-left"></i> Batal</button>
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

  function get_kabupaten(id_prov, sel) {
    $.ajax({
      url: '<?php echo base_url() ?>ajax/get_kabupaten',
      type: 'POST',
      dataType: 'html',
      data: {
        id_provinsi: id_prov,
        selected: sel
      },
      success: function(data) {
        $("#id_kabupaten").html(data);
      }
    });
  }

  function get_kecamatan(id_kab, sel) {
    $.ajax({
      url: '<?php echo base_url() ?>ajax/get_kecamatan',
      type: 'POST',
      dataType: 'html',
      data: {
        id_kabupaten: id_kab,
        selected: sel
      },
      success: function(data) {
        $("#id_kecamatan").html(data);
      }
    });
  }
  <?php if ($title = 'Tambah Biaya Kirim'): ?>
  get_kabupaten($("#id_provinsi").val(), 0);  
  <?php else: ?>

  <?php endif ?>

  <?php if (isset($ongkir['id_kecamatan'])): ?>
      $.ajax({
        url: '<?php echo base_url() ?>ajax/get_kabupaten',
        type: 'POST',
        dataType: 'html',
        data: {
          id_provinsi: $("#id_provinsi").val(),
          selected: <?php echo $ongkir['id_kabupaten'] ?>
        },
        success: function(data) {
          $("#id_kabupaten").html(data);
          get_kecamatan(<?php echo $ongkir['id_kabupaten'] ?>, <?php echo $ongkir['id_kecamatan']!='' ? $ongkir['id_kecamatan'] : 0  ?>); 
        }
      });
  <?php endif ?>
  
  $("#id_kabupaten").change(function() {
    get_kecamatan($(this).val(), '');
  });
</script>