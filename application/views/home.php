<style>
	.paginate{position: relative;}
	.pagination>li>a, .pagination>li>span {
	  padding: 6px 16px;
	  margin-left: 3px;
	  margin-right: 3px;
	  line-height: 1.42857143;
	  color: #337ab7;
	  background-color: #ECF0F1;
	  border: 0px;
	  font-size: 20px;
	}
	.pagination>li>a.page-prev, .pagination>li>span.page-prev,.pagination>li>a.page-next, .pagination>li>span.page-next {
	  background-color: #1478B8;
	  color: #FFF;
	}
	.pagination>li>a.page-prev, .pagination>li>span.page-prev{
	  position: absolute;
	  right: 60px;
	}
	.pagination>li>a.page-next, .pagination>li>span.page-next{
	  position: absolute;
	  right: 0px;
	}
</style>
<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<?php foreach ($dataslide as $itemslide): ?>
				<div class="item-slick1" style="background-image: url(<?php echo assets_front('images/slider/').$itemslide['gambar'] ?>)">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									<?php echo $itemslide['caption'] ?>
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									<?php echo $itemslide['judul'] ?>
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="<?php echo $itemslide['url'] ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Lihat
								</a>
							</div>
						</div>
					</div>
				</div>	
				<?php endforeach ?>
			</div>
		</div>
	</section>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Daftar Produk
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>

				</div>

				<div class="flex-w flex-c-m m-tb-10">

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Cari
					</div>
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Cari Produk ...">
					</div>	
				</div>

			</div>

			<div class="row isotope-grid">
				<?php foreach ($produk as $prod): ?>
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img height="300px" src="<?php echo base_url('assets/foto_produk/'.$prod->gambar_1) ?>" alt="IMG-PRODUCT">
								<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" id_produk="<?php echo $prod->id_produk ?>">
				                Quick View
				              </a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="<?php echo base_url('produk/detail_produk/'.$prod->id_produk.'-'.permalink($prod->nama_produk)) ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?php echo $prod->nama_produk ?>
									</a>

									<span class="stext-105 cl3">
										<?php echo format_rupiah($prod->harga) ?>
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="<?php echo base_url('assets/front/images/icons/icon-heart-01.png') ?>" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="<?php echo base_url('assets/front/images/icons/icon-heart-02.png') ?>" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<?php echo $pagination ?>
			</div>
		</div>
	</section>
<?php if ($this->session->flashdata('login_sukses') != ''): ?>
<?php echo $this->session->flashdata('login_sukses'); ?>
<?php endif ?>