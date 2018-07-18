<!-- breadcrumb -->

<?php  
// var_dump($this->cart->contents()); die;
?>
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="<?php echo base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<a href="<?php echo base_url('cart') ?>" class="stext-109 cl4">
			Keranjang Belanja
		</a>
	</div>
</div>

<!-- Shoping Cart -->
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart" id="cart-tabel">
							<tr class="table_head">
								<th class="column-1" colspan="2">Produk</th>
								<th class="column-3">Harga</th>
								<th class="column-4">Jumlah</th>
								<th class="column-5">Total</th>
							</tr>
							<?php foreach ($cart as $items): ?>
							<tr class="table_row">
								<td class="column-1">
									<div class="how-itemcart1" rowid="<?php echo $items['rowid'] ?>">
										<img src="<?php echo $items['options']['gambar'] ?>" alt="IMG">
									</div>
								</td>
								<td class="column-2"><?php echo $items['name'] ?></td>
								<td class="column-3"><?php echo 'Rp. '.number_format($items['price']) ?></td>
								<td class="column-4">
									<div class="wrap-num-product flex-w m-l-auto m-r-0">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" rowid="<?php echo $items['rowid'] ?>" id="<?php echo $items['rowid'] ?>" value="<?php echo $items['qty'] ?>">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
								</td>
								<td class="column-5"><?php echo 'Rp. '. number_format($items['price']*$items['qty']) ?></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2">Biaya Jasa : <?php echo format_rupiah($items['options']['fee']) ?> / PCS</td>
								<td colspan="2">Total Biaya Jasa : <span class="feesubtotal"><?php echo format_rupiah($items['options']['fee']*$items['qty']) ?></span></td>
							</tr>
							<?php endforeach ?>
							

						</table>
					</div>
					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-w flex-m m-r-20 m-tb-5">
							
							
						</div>

						<button class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 " id="clearcart">
							Bersihkan Keranjang Belanja
						</button>
					</div>
				</div>
			</div>

			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Total Keranjang
					</h4>

					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<span class="stext-110 cl2">
								Subtotal:
							</span>
						</div>

						<div class="size-209">
							<span class="mtext-110 cl2 subtotal">
								<?php echo 'Rp. ' . number_format($this->cart->total()) ?>
							</span>
						</div>
					</div>

					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Alamat Kirim:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2 alamatlengkap">
									Pilih Alamat Pengiriman Untuk Menentukan Biaya Kirim.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Hitung Biaya Kirim
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2 alamatpilih" name="time">
											<option value="">Pilih Alamat ...</option>
											<?php foreach ($alamat as $alm): ?>
											<option value="<?php echo $alm->id_alamat ?>"><?php echo $alm->nama_alamat ?></option>
											<?php endforeach ?>
										</select>
										<div class="dropDownSelect2"></div>
										<input type="hidden" class="kecamatanid" value="">
									</div>
										<a href="<?php echo base_url('users/tambah_alamat') ?>">Tambah Alamat Pengiriman</a>
		
								</div>
							</div>
						</div>
						<br>
						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Ongkos Kirim:
								</span>
							</div>
							<div class="size-209">
								<span class="stext-110 cl2 ongkir">
									Rp. 0 
								</span>
							</div>
							<input type="hidden" class="ongkirval" value="0">
						</div>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Total Biaya Jasa:
								</span>
							</div>
							<div class="size-209">
								<span class="stext-110 cl2 feejastip">
									<?php echo format_rupiah($totaljasa) ?>
								</span>
							</div>
							<input type="hidden" class="ongkirval" value="0">
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2 totalakhir">
									<?php echo 'Rp. ' . number_format($this->cart->total()) ?>
								</span>

							</div>
						</div>
					<a href="#"><button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer cekot">
						Lanjutkan Checkout
					</button></a>
				</div>
			</div>
		</div>
	</div>
	<form action="<?php echo base_url('cart/checkout') ?>" method="POST" class="form-horizontal" hidden role="form" id="cekotform"> 
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<input type="text" name="id_user" id="id_user" value="<?php echo $users['id_user'] ?>">
				<input type="text" name="total_ongkir" id="total_ongkir">
				<input type="text" name="total_harga" id="total_harga" value="<?php echo $this->cart->total() ?>">
				<input type="text" name="total_fee" id="total_fee" value="<?php echo $totaljasa?>">
				<input type="text" name="id_alamat" id="id_alamat">
			</div>
		</div>
	</form>
<script>
$(document).ready(function() {
	$(".cekot").click(function() {
		var ongkir 		= $("#total_ongkir").val();
		var feejastip	= $("#total_fee").val();
		var subtotal 	= $("#total_harga").val();
		var id_user 	= $("#id_user").val();
		var id_alamat 	= $("#id_alamat").val();

		if (ongkir == 0 || feejastip == 0 || subtotal == 0 || id_user == 0 || id_user == 1 || id_alamat == 0) {
			swal({
			  type: 'error',
			  title: 'Gagal Checkout...',
			  text: 'Alamat Kirim Belum Dipilih atau Alamat Pengiriman Belum Didukung',
			})
		} else {
			$("#cekotform").submit();
		}
	});
	function update_cart_qty(elemendata, idrow, qty) {
		var _idrow = idrow;
        var _qty = qty;
        var _elemen = elemendata;
	    $.ajax({
			url: "<?php echo base_url('cart/update_cart_qty') ?>",
			type: 'POST',
			dataType: 'json',
			data: {
				rowid: _idrow,
				kecamatan_id: $(".kecamatanid").val(),
				qty: _qty
			},
			success: function(data){
				_elemen.closest('td').next().html(data.total);
				_elemen.closest('tr').next().find('.feesubtotal').html(data.totalfee);
                $('.subtotal').html(data.subtotal);
                $('.ongkir').html(data.ongkir);
                $('.feejastip').html(data.feejastip);
                $('#total_ongkir').val(data._ongkir);
                $('#total_harga').val(data._subtotal);
                $('#total_fee').val(data._fee);
                $('.totalakhir').html(data.grandtotal);
                show_cart();
            }
		});
	}

  /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 1) $(this).next().val(numProduct - 1);
        update_cart_qty($(this),$(this).next().attr('rowid'),$(this).next().val());
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
        update_cart_qty($(this),$(this).prev().attr('rowid'),$(this).prev().val());
    });

    $('.num-product').on('change', function(){
        update_cart_qty($(this),$(this).attr('rowid'),$(this).val());
    });

    $('.alamatpilih').on('change', function(){
        $.ajax({
			url: "<?php echo base_url('cart/show_alamat') ?>",
			type: 'POST',
			dataType: 'json',
			data: {
				id: $(this).val()
			},
			success: function(data){
                $('.alamatlengkap').html(data.alamat);
                
            }
		});
		show_ongkir($(this).val());
		$("#id_alamat").val($(this).val());
    });

    function show_ongkir(idalm) {
    	$.ajax({
    		url: '<?php echo base_url('cart/show_ongkir') ?>',
    		type: 'POST',
    		dataType: 'JSON',
    		data: {
    			id_alamat: idalm
    		},
    		success: function(data) {
    			$(".ongkir").html(data.ongkir);
    			$("#total_ongkir").val(data._ongkir);
    			$(".totalakhir").html(data.total);
    			$(".kecamatanid").val(data.kecamatan_id);
    		}
    	});
    	
    }

    $("#clearcart").click(function() {
    	swal({
    		title: 'Bersihkan Keranjang?',
    		text: "Menghapus Semua Item Yang ada di keranjang!",
    		type: 'warning',
    		showCancelButton: true,
    		confirmButtonColor: '#3085d6',
    		cancelButtonColor: '#d33',
    		confirmButtonText: 'Ya, Bersihkan!'
    	}).then((result) => {
    		if (result.value) {
    			$.ajax({
		    		url: '<?php echo site_url('cart/destroy') ?>',
		    		type: 'GET',
		    		success: function() {
		    			location.reload();
		    		}
		    	});
    		}
    	})
    });

    $(".how-itemcart1").click(function() {
    	swal({
    		title: 'Hapus Item?',
    		text: "Menghapus Item Di Keranjang!",
    		type: 'warning',
    		showCancelButton: true,
    		confirmButtonColor: '#3085d6',
    		cancelButtonColor: '#d33',
    		confirmButtonText: 'Ya, Hapus!'
    	}).then((result) => {
    		if (result.value) {
    			$.ajax({
		    		url: '<?php echo site_url() ?>cart/delete_single/'+$(this).attr('rowid'),
		    		type: 'GET',
		    		success: function() {
		    			location.reload();
		    		}
		    	});
    		}
    	})
    });

});

</script>