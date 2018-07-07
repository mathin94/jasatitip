<!-- breadcrumb -->
<style>
	.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
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
<br>
<!-- Shoping Cart -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
			<div class="col-lg-12">
				<div class="invoice-title">
					<h2>Invoice</h2><h3 class="pull-right"><?php echo $trans['kode_transaksi'] ?></h3>
				</div>
				<hr>
				<div class="row text-right">
					<div class="col-lg-12">
						<address>
							<strong>Alamat Pengiriman:</strong><br>
							<?php echo $alamat['nama_penerima'] ?><br>
							<?php echo $alamat['nomor_penerima'] ?><br>
							<?php echo $alamat['alamat_lengkap'] ?><br>
							Kec. <?php echo ucfirst($alamat['nama_kecamatan']) ?>, <?php echo ucfirst($alamat['nama_kabupaten']) ?><br>
							<?php echo $alamat['nama_provinsi'] . ', ' . $alamat['kode_pos'] ?>
						</address>
					</div>
				</div>
				<div class="row text-right">
					<div class="col-lg-12">
						<address>
							<strong>Tanggal Pemesanan :</strong><br>
							<?php echo $tanggal ?><br><br>
						</address>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default" style="margin-top: -70px">
				<div class="panel-heading">
					<h3 class="panel-title"><strong>Rincian Pemesanan</strong></h3>
					<br>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<td><strong>Nama Produk</strong></td>
									<td class="text-center"><strong>Harga</strong></td>
									<td class="text-center"><strong>Jumlah</strong></td>
									<td class="text-right"><strong>Total</strong></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cart as $items): ?>
									<tr>
										<td><?php echo $items['name'] ?></td>
										<td class="text-center"><?php echo 'Rp. ' . number_format($items['price']) ?></td>
										<td class="text-center"><?php echo $items['qty'] ?></td>
										<td class="text-right"><?php echo 'Rp. ' . number_format($items['price']*$items['qty']) ?></td>
									</tr>	
								<?php endforeach ?>
								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line text-center"><strong>Subtotal</strong></td>
									<td class="thick-line text-right"><?php echo 'Rp. ' . number_format($trans['total_harga']) ?></td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Biaya Kirim ( <?php echo $totber . ' Kg ' ?>)</strong></td>
									<td class="no-line text-right"><?php echo 'Rp. ' . number_format($trans['total_ongkir']) ?></td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Total Harga</strong></td>
									<td class="no-line text-right"><?php echo 'Rp. ' . number_format($trans['total_harga']+$trans['total_ongkir']) ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 50px;">
		<div class="col-lg-6">
			<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer konfirmasi">
				Konfirmasi Pemesanan
			</button>
		</div>
	</div>
</div>
<form action="<?php echo base_url('cart/checkout_konfirmasi') ?>" method="POST" class="form-horizontal" hidden role="form" id="cekotform"> 
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input type="text" name="id_user" id="id_user" value="<?php echo $users['id_user'] ?>">
			<input type="text" name="total_ongkir" id="total_ongkir" value="<?php echo $trans['total_ongkir'] ?>">
			<input type="text" name="total_harga" id="total_harga" value="<?php echo $trans['total_harga'] ?>">
			<input type="text" name="id_alamat" id="id_alamat" value="<?php echo $trans['alamat_id'] ?>">
			<input type="text" name="id_user" id="id_user" value="<?php echo $trans['user_id'] ?>">
		</div>
	</div>
</form>
<script>
$(document).ready(function() {
	$(".konfirmasi").click(function() {
		var ongkir 		= $("#total_ongkir").val();
		var subtotal 	= $("#total_harga").val();
		var id_user 	= $("#id_user").val();
		var id_alamat 	= $("#id_alamat").val();

		if (ongkir == 0 || subtotal == 0 || id_user == 0 || id_user == 1 || id_alamat == 0) {
			swal({
			  type: 'error',
			  title: 'Gagal Checkout...',
			  text: 'Alamat Kirim Belum Dipilih atau Alamat Pengiriman Belum Didukung',
			})
		} else {
			$("#cekotform").submit();
		}
	});
});

</script>