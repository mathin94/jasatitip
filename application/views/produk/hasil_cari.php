<!-- Product -->
  <div class="bg0 m-t-23 p-b-140">
    <div class="container">
      <div class="flex-w flex-sb-m p-b-52">
        <div class="flex-w flex-l-m filter-tope-group m-tb-10">
          <span class="stext-106" >
             Hasil Pencarian : <?php echo $keyword ?>
          </span>
        </div>
      </div>

      <div class="row isotope-grid">
        <?php foreach ($produk_data as $row): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
          <!-- Block2 -->
          <div class="block2">
            <div class="block2-pic hov-img0">
              <img height="350" src="<?php echo base_url('assets/foto_produk/'.$row->gambar_1) ?>" alt="IMG-PRODUCT">

              <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" id_produk="<?php echo $row->id_produk ?>">
                Quick View
              </a>
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
              <div class="block2-txt-child1 flex-col-l ">
                <a href="<?php echo base_url('produk/detail_produk/'.$row->id_produk.'-'.permalink($row->nama_produk)) ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                  <?php echo $row->nama_produk ?>
                </a>

                <span class="stext-105 cl3">
                  <?php echo format_rupiah($row->harga) ?>
                </span>
              </div>
            </div>
          </div>
        </div> 
        <?php endforeach ?>
    </div>
  </div>
</div>