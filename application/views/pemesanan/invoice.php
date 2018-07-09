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

    <a href="<?php echo base_url('pemesanan') ?>" class="stext-109 cl8 hov-cl1 trans-04">
      Pemesanan
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <span class="stext-109 cl4">
      Invoice
    </span>
  </div>
</div>
<br>
<!-- Shoping Cart -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
			<div class="col-lg-12">
				<div class="invoice-title">
					<h2>Invoice</h2><h3 class="pull-right"><?php echo $kode_transaksi ?></h3>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<address>
							<strong>Alamat Pengiriman:</strong><br>
							<?php echo $pemesanan['nama_penerima'] ?><br>
							<?php echo $pemesanan['nomor_penerima'] ?><br>
							<?php echo $pemesanan['alamat_lengkap'] ?><br>
							Kec. <?php echo ucfirst($pemesanan['nama_kecamatan']) ?>, <?php echo ucfirst($pemesanan['nama_kabupaten']) ?><br>
							<?php echo $pemesanan['nama_provinsi'] . ', ' . $pemesanan['kode_pos'] ?>
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<address>
							<strong>Tanggal Pemesanan :</strong> <span class="pull-right"><strong>Status Pemesanan :</strong></span><br>
							<?php echo tanggal_indo($pemesanan['tanggal']) ?><span class="pull-right"><?php echo $pemesanan['status'] ?></span><br><br>
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
								<?php foreach ($detail_pesanan as $items): ?>
									<tr>
										<td><?php echo $items->nama_produk ?></td>
										<td class="text-center"><?php echo 'Rp. ' . number_format($items->harga_produk) ?></td>
										<td class="text-center"><?php echo $items->qty ?></td>
										<td class="text-right"><?php echo 'Rp. ' . number_format($items->harga_produk*$items->qty) ?></td>
									</tr>	
								<?php endforeach ?>
								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line text-center"><strong>Subtotal</strong></td>
									<td class="thick-line text-right"><?php echo 'Rp. ' . number_format($pemesanan['total_harga']) ?></td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Biaya Kirim ( <?php echo $totber . ' Kg ' ?>)</strong></td>
									<td class="no-line text-right"><?php echo 'Rp. ' . number_format($pemesanan['total_ongkir']) ?></td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Total Pembayaran</strong></td>
									<td class="no-line text-right"><?php echo 'Rp. ' . number_format($pemesanan['total_harga']+$pemesanan['total_ongkir']) ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-bottom: 50px;">
		<div class="col-lg-6 pull-right">
			<button type="button" class="btn btn-success" id="cetak"><i class="fa fa-file-pdf-o"></i> Cetak Invoice</button>
		</div>
	</div>
</div>

<script>
	$("#cetak").click(function() {
		window.open('<?php echo site_url('pemesanan/cetak_invoice/'.$pemesanan['id_pemesanan']) ?>')
	});
</script>

