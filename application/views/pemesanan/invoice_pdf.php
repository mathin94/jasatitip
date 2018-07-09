<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <!-- Latest compiled and minified CSS & JS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <style type="text/css">
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
<?php date_default_timezone_set("Asia/Jakarta"); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h3>Invoice : # <?php echo $kode_transaksi ?></h3>
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
    
    <div class="row">
        <div class="col-md-12">
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

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
         <script src="Hello World"></script>
    </body>
</html>