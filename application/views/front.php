<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo get_favicon() ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>fonts/linearicons-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_back() ?>plugins/datatables/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/MagnificPopup/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo assets_front() ?>css/main.css">
	<script src="<?php echo assets_front() ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap-notify.min.js"></script>
	<!-- Datatables -->
  <script src="<?php echo assets_back() ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo assets_back() ?>plugins/datatables/dataTables.bootstrap4.js"></script>
	<script>
		function notifikasi(pesan,tipe, ico = '') {
			$.notify({
				// options
				icon: ico,
				message: pesan,
			},{
				// settings
				type: tipe,
				z_index: 9999
			});
		}
	</script>
<!--===============================================================================================-->
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						<!-- Gratis Biaya Pengiriman untuk pembelanjaan diatas Rp.5000.000 -->
					</div>

					<div class="right-top-bar flex-w h-full">
						<?php if ($this->session->userdata('role') == 'administrator'): ?>
							<a href="<?php echo base_url() ?>administrator" class="flex-c-m trans-04 p-lr-25">
								Dashboard Admin
							</a>
						<?php endif ?>
						<?php if ($this->session->userdata('logged_in') == null): ?>
							<a href="<?php echo base_url() ?>auth/login" class="flex-c-m trans-04 p-lr-25">
								Login
							</a>
							<a href="<?php echo base_url() ?>auth/register" class="flex-c-m trans-04 p-lr-25">
								Register
							</a>
						<?php else: ?>
							<?php if ($this->session->userdata('role') == 'pelanggan'): ?>
							<a href="<?php echo base_url() ?>pemesanan/index" class="flex-c-m trans-04 p-lr-25">
								Data Pemesanan
							</a>
							<a href="<?php echo base_url() ?>users/profile" class="flex-c-m trans-04 p-lr-25">
								Pengaturan Profile
							</a>
							<a data-toggle="modal" href='#edit_pass' class="flex-c-m trans-04 p-lr-25">Ganti Password</a>
							
							<?php endif ?>
							<a href="#" id="logout" class="flex-c-m trans-04 p-lr-25">
								Logout
							</a>
						<?php endif ?>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="<?php echo base_url() ?>" class="logo">
						<img src="<?php echo get_logo() ?>" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="<?php echo base_url() ?>">Beranda</a>
							</li>
							<li>
								<a href="<?php echo base_url('produk') ?>">Produk</a>
								<?php echo list_kategori() ?>
							</li>

							<!-- <li class="label1" data-label1="hot">
								<a href="shoping-cart.html">Features</a>
							</li> -->

							<li>
								<a href="<?php echo base_url('page/cara_belanja') ?>">Cara Belanja</a>
							</li>

							<li>
								<a href="<?php echo base_url('page/hubungi_kami') ?>">Hubungi Kami</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" id="cart-icon" data-notify="0">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
						</a>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="<?php echo base_url() ?>"><img src="<?php echo assets_front() ?>images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Gratis Biaya Pengiriman untuk pembelanjaan diatas Rp.5000.000
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">

					<!-- 	<a href="#" class="flex-c-m p-lr-10 trans-04">
							My Account
						</a>
 -->
						<a href="<?php echo base_url() ?>auth/login" class="flex-c-m p-lr-10 trans-04">
							Login
						</a>

						<a href="<?php echo base_url() ?>auth/register" class="flex-c-m p-lr-10 trans-04">
							Register
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="<?php echo base_url() ?>">Beranda</a>
				</li>

				<li>
					<a href="#">Kategori</a>
					<ul class="sub-menu-m">
						<li><a href="#">Kategori 1</a></li>
						<li><a href="#">Kategori 2</a></li>
						<li><a href="#">Kategori 3</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="#">Cara Belanja</a>
				</li>

				<li>
					<a href="#">Hubungi Kami</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="<?php echo assets_front() ?>images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15" action="<?php echo base_url('produk/search') ?>">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="keyword" placeholder="Cari Produk...">
				</form>
			</div>
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Keranjang
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full" id="detail_cart">
					<!-- <li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li> -->
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: <span id="keranjang-total">Rp. 0 ,-</span>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="<?php echo site_url('cart/index') ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							Tampilkan Keranjang
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php echo $contents; ?>
	
	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="p-t-40">
				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed By Billy
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>
	
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<div class="modal fade" id="edit_pass" style="margin-top: 150px">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<form id="ganti_pass_form" accept-charset="utf-8">
					
					<div class="form-group">
						<label for="">Password Lama</label>
						<input type="password" class="form-control" name="pass_lama" id="pass_lama" placeholder="Masukan Password Lama">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label for="">Password Baru</label>
						<input type="password" class="form-control" name="pass_baru" id="pass_baru" placeholder="Masukan Password Baru">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
						<label for="">Konfirmasi Password</label>
						<input type="password" class="form-control" name="konfirmasi_pass" id="konfirmasi_pass" placeholder="Masukan Password Baru">
						<span class="help-block"></span>
					</div>

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary" onclick="change_pass()" id="submit">Ganti Pass</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal1 Quick View -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="<?php echo assets_front() ?>images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row" id="modal1-body">
					
				</div>
			</div>
		</div>
	</div>

	
	<script src="<?php echo assets_front() ?>vendor/animsition/js/animsition.min.js"></script>
	<script src="<?php echo assets_front() ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo assets_front() ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo assets_front() ?>vendor/select2/select2.min.js"></script>
	<script>
		function add_cart(getdata) {
			var produk_id     = getdata.data("idproduk");
            var produk_nama   = getdata.data("namaproduk");
            var produk_harga  = getdata.data("hargaproduk");
            var produk_gambar = getdata.data("gambarproduk");
            var produk_berat  = getdata.data("beratproduk");
            var produk_fee    = getdata.data("fee");
            var quantity      = $('#produk_qty').val();

            $.ajax({
                url : "<?php echo base_url('cart/add_to_cart') ?>",
                method : "POST",
                data : {
                	id_produk: produk_id, 
                	nama_produk: produk_nama, 
                	harga: produk_harga, 
                	gambar: produk_gambar,
                	fee: produk_fee,  
                	berat: produk_berat, 
                	qty: quantity
                },
                success: function(data){
                	if (data == '') {
                		swal('Gagal !', 'Anda Harus Login Sebagai Pelanggan Untuk Menambahkan Keranjang', 'error');
                		$('.js-modal1').removeClass('show-modal1');
                	} else {
                		$('#detail_cart').html(data);
	                    swal(produk_nama, "Telah Ditambahkan Ke keranjang !", "success");
	                    get_total();
	                    $('.js-modal1').removeClass('show-modal1');
                	}
                }
            });
		}

		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<script src="<?php echo assets_front() ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo assets_front() ?>vendor/daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo assets_front() ?>vendor/slick/slick.min.js"></script>
	<script src="<?php echo assets_front() ?>js/slick-custom.js"></script>
	<script src="<?php echo assets_front() ?>vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
	<script src="<?php echo assets_front() ?>vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
	<script src="<?php echo assets_front() ?>vendor/isotope/isotope.pkgd.min.js"></script>
	<script src="<?php echo assets_front() ?>vendor/sweetalert/swall.min.js"></script>
	<script>
		function change_pass() {
			var old_pass  = $("#pass_lama").val();
			var new_pass  = $("#pass_baru").val();
			var conf_pass = $("#konfirmasi_pass").val();
			
			$.ajax({
				url: '<?php echo base_url('users/ganti_pass') ?>',
				type: 'POST',
				data: $("#ganti_pass_form").serialize(),
                dataType: "JSON",
				success: function(data) {
                    if(data.ket == 1) {
                        $('#edit_pass').modal('hide');
                        swal({
                          title: "Success!",
                          text: "Sukses Mengubah Password, Silahkan Login Kembali !",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                        }).then(function (result) {
                        	window.location.href="<?php echo base_url('auth/logout') ?>";
                        });
                    } else  {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                        }
                    }
                    
                    $('#btn-savepass').text('Simpan'); 
                    $('#btn-savepass').attr('disabled',false);
                }
			});
			
		}
		show_cart();
		function show_cart() {
			$.ajax({
				url: '<?php echo base_url('cart/show_cart') ?>',
				type: 'GET',
				dataType: 'html',
				success: function(data){
	                $('#detail_cart').html(data);
	                get_total();
	            }
			});
		}

		function get_total() {
			$.ajax({
				url: '<?php echo base_url('cart/total_pembelian_cart') ?>',
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
	                $('#keranjang-total').html(data.total);
	                $('#cart-icon').attr('data-notify', data.count);
	            }
			});
		}
	</script>
	<script src="<?php echo assets_front() ?>vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});

		/*==================================================================
	    [ Show modal1 ]*/
	    $('.js-show-modal1').on('click',function(e){
	        e.preventDefault();
	        
	        
	        var id = $(this).attr('id_produk');

	        $.ajax({
	        	url: '<?php echo base_url() . 'produk/ajax_modal' ?>',
	        	type: 'POST',
	        	dataType: 'html',
	        	data: {id_produk: id},
	        	success: function(data) {
	        		$("#modal1-body").html(data);
	        	}
	        });
	        $('.js-modal1').addClass('show-modal1');
	        
	    });

	    $('.js-hide-modal1').on('click',function(){
	        $('.js-modal1').removeClass('show-modal1');
	    });

		$("#logout").click(function() {
			swal({
			  title: 'Logout ?',
			  text: "Akun Anda Akan Logout!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: 'green',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Logout',
			  cancelButtonText: 'Batal'
			}).then((result) => {
			  if (result.value) {
			    window.location.href="<?php echo base_url('auth/logout') ?>"
			  }
			})
		});


	</script>
	<script src="<?php echo assets_front() ?>js/main.js"></script>
	<?php echo $this->session->flashdata('konfirmasi_pembayaran'); ?>
	<?php echo $this->session->flashdata('notifikasi'); ?>
</body>
</html>