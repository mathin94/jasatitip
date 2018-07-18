<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
			<?php echo $produk['nama_kategori'] ?>
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			<?php echo $produk['nama_produk'] ?>
		</span>
	</div>
</div>

<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-7 p-b-30">
				<div class="p-l-25 p-r-30 p-lr-0-lg">
					<div class="wrap-slick3 flex-sb flex-w">
						<div class="wrap-slick3-dots"></div>
						<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

						<div class="slick3 gallery-lb">
							<div class="item-slick3" data-thumb="<?php echo site_url('assets/foto_produk/'.$produk['gambar_1']) ?>">
								<div class="wrap-pic-w pos-relative">
									<img src="<?php echo site_url('assets/foto_produk/'.$produk['gambar_1']) ?>" alt="IMG-PRODUCT">

									<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo site_url('assets/foto_produk/'.$produk['gambar_1']) ?>">
										<i class="fa fa-expand"></i>
									</a>
								</div>
							</div>
							<?php if (!empty($produk['gambar_2'])): ?>
							<div class="item-slick3" data-thumb="<?php echo site_url('assets/foto_produk/'.$produk['gambar_2']) ?>">
								<div class="wrap-pic-w pos-relative">
									<img src="<?php echo site_url('assets/foto_produk/'.$produk['gambar_2']) ?>" alt="IMG-PRODUCT">

									<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo site_url('assets/foto_produk/'.$produk['gambar_2']) ?>">
										<i class="fa fa-expand"></i>
									</a>
								</div>
							</div>	
							<?php endif ?>
							
							<?php if (!empty($produk['gambar_3'])): ?>
							<div class="item-slick3" data-thumb="<?php echo site_url('assets/foto_produk/'.$produk['gambar_3']) ?>">
								<div class="wrap-pic-w pos-relative">
									<img src="<?php echo site_url('assets/foto_produk/'.$produk['gambar_3']) ?>" alt="IMG-PRODUCT">

									<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo site_url('assets/foto_produk/'.$produk['gambar_3']) ?>">
										<i class="fa fa-expand"></i>
									</a>
								</div>
							</div>		
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
				
			<div class="col-md-6 col-lg-5 p-b-30">
				<div class="p-r-50 p-t-5 p-lr-0-lg">
					<h4 class="mtext-105 cl2 js-name-detail p-b-14">
						<?php echo $produk['nama_produk'] ?>
					</h4>

					<span class="mtext-106 cl2">
						<?php echo format_rupiah($produk['harga']) ?>
					</span>
					<p></p>
					<span class="stext-106 cl2">
						Berat : <?php echo format_berat($produk['berat']) ?>
					</span>
					<p></p>
					<span class="stext-106 cl2">
						Biaya Jasa : <?php echo format_rupiah($produk['fee_jastip']) ?> per barang
					</span>
					<p class="stext-102 cl3 p-t-23">
						<?php echo $produk['deskripsi'] ?>
					</p>
					
					<!--  -->
					<div class="p-t-33">
						<div class="size-204 flex-w flex-m respon6-next">
							<div class="wrap-num-product flex-w m-r-20 m-tb-10">
								<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
									<i class="fs-16 zmdi zmdi-minus"></i>
								</div>

								<input class="mtext-104 cl3 txt-center num-product" type="number" name="produk_qty" id="produk_qty" value="1">

								<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
									<i class="fs-16 zmdi zmdi-plus"></i>
								</div>
							</div>

							<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" id="btn-addcart" data-idproduk="<?php echo $produk['id_produk'] ?>" data-hargaproduk="<?php echo $produk['harga'] ?>" data-fee="<?php echo $produk['fee_jastip'] ?>" data-namaproduk="<?php echo $produk['nama_produk'] ?>" data-beratproduk="<?php echo $produk['berat'] ?>" data-gambarproduk="<?php echo $produk['gambar_1'] ?>">
								Tambahkan Ke Keranjang
							</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
		<span class="stext-107 cl6 p-lr-25">
			SKU: <?php echo $produk['kode_produk'] ?>
		</span>

		<span class="stext-107 cl6 p-lr-25">
			Kategori: <?php echo $produk['nama_kategori'] ?>
		</span>
	</div>
</section>


<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
	<div class="container">
		<div class="p-b-45">
			<h3 class="ltext-106 cl5 txt-center">
				Kategori <?php echo $produk['nama_kategori'] ?> Lain nya
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">
				<?php foreach ($related as $rel): ?>
				<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?php echo site_url('assets/foto_produk/'.$rel->gambar_1) ?>" alt="IMG-PRODUCT">
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="<?php echo site_url('produk/detail_produk/'.$rel->id_produk.'-'.permalink($rel->nama_produk)) ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $rel->nama_produk ?>
								</a>

								<span class="stext-105 cl3">
									<?php echo format_rupiah($rel->harga) ?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="<?php echo assets_front() ?>images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="<?php echo assets_front() ?>images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>	
				<?php endforeach ?>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('.btn-num-product-down').on('click', function(){
	        var numProduct = Number($(this).next().val());
	        if(numProduct > 0) $(this).next().val(numProduct - 1);
	    });

	    $('.btn-num-product-up').on('click', function(){
	        var numProduct = Number($(this).prev().val());
	        $(this).prev().val(numProduct + 1);
	    });
		$("#btn-addcart").click(function() {
			var produk_id     = $(this).data("idproduk");
            var produk_nama   = $(this).data("namaproduk");
            var produk_harga  = $(this).data("hargaproduk");
            var produk_fee    = $(this).data("fee");
            var produk_gambar = $(this).data("gambarproduk");
            var produk_berat  = $(this).data("beratproduk");
            var quantity      = $('#produk_qty').val();
            $.ajax({
                url : "<?php echo base_url('cart/add_to_cart') ?>",
                method : "POST",
                data : {
                	id_produk: produk_id, 
                	nama_produk: produk_nama, 
                	harga: produk_harga, 
                	fee: produk_fee, 
                	gambar: produk_gambar, 
                	berat: produk_berat, 
                	qty: quantity
                },
                success: function(data){
                	if (data == '') {
                		swal('Gagal !', 'Anda Harus Login Sebagai Pelanggan Untuk Menambahkan Keranjang', 'error');
                	} else {
                		$('#detail_cart').html(data);
	                    swal(produk_nama, "Telah Ditambahkan Ke keranjang !", "success");
	                    get_total();
                	}
                }
            });
		});
	});

	

	
</script>