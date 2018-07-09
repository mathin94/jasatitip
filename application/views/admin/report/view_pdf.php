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
                <h4>Laporan Transaksi Periode <?php echo $tgl_awal ?> - <?php echo $tgl_akhir ?></h4>
                <p><h5>Username Admin : <?php echo $this->session->userdata('username'); ?></h5></p>
                <p><h5>Tanggal Cetak : <?php echo date_indo(date('Y-m-d')) . ' ' . date('H:i:s') ?></h5></p>
            </div>
            <hr>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <td><strong>Kode Transaksi</strong></td>
                            <td class="text-center"><strong>E-Mail</strong></td>
                            <td class="text-center"><strong>Username</strong></td>
                            <td class="text-center"><strong>Tanggal Transaksi</strong></td>
                            <td class="text-right"><strong>Total Pembayaran</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order as $row): ?>
                        <tr>
                            <td><?php echo $row->kode_transaksi ?></td>
                            <td class="text-center"><?php echo $row->email ?></td>
                            <td class="text-center"><?php echo $row->username ?></td>
                            <td class="text-center"><?php echo date_indo($row->tanggal) ?></td>
                            <td class="text-right"><?php echo format_rupiah($row->total_harga) ?></td>
                        </tr>    
                        <?php endforeach ?>
                        <tr>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line text-center"><strong>Total Pemasukan</strong></td>
                            <td class="thick-line text-right"><?php echo format_rupiah($total) ?></td>
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