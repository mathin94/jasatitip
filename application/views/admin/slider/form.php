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

#img-upload{
    width: 300px;
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
            <li class="breadcrumb-item"><a href="#">Pengaturan Slider</a></li>
            <li class="breadcrumb-item"><a href="#">Edit Slider</a></li>
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
                <h3 class="card-title">Edit Gambar Slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart($url_action, array('class'=>'form-horizontal','role'=>'form')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="varchar">Judul Slider</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Tulis Judul Slider" value="<?php echo isset($slider['judul']) ? $slider['judul'] : '' ?>">
                    <?php echo form_error('judul') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">Caption Slider</label>
                    <textarea name="caption" id="caption" cols="30" rows="4" class="form-control" placeholder="Isi Caption Slider"><?php echo isset($slider['caption']) ? $slider['caption'] : '' ?></textarea>
                    <?php echo form_error('caption') ?>
                  </div>
                  <div class="form-group">
                    <label for="varchar">URL Slider</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Tulis URL Slider" value="<?php echo isset($slider['url']) ? $slider['url'] : '' ?>">
                    <?php echo form_error('url') ?>
                  </div>
                  <div class="form-group">
                    <label>Gambar Slider</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="imgInp" name="gambar">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <br>
                    <img id='img-upload' <?php  
                      if (isset($slider['gambar'])) 
                      {
                        if($slider['gambar'] != '')
                        {
                          echo 'src="'.site_url('assets/front/images/slider/'.$slider['gambar']).'"';
                        }
                      }
                        
                    ?>/>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="submit">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  <a class="btn btn-default" href="<?php echo base_url('administrator/gambar_slider') ?>"><i class="fa fa-rotate-left"></i> Batal</a>
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

<?php if (!empty($this->session->flashdata('gagal_insert'))): ?>
  <?php echo $this->session->flashdata('gagal_insert') ?>
<?php endif ?>

