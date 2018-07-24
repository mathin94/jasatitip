<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
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
                <h4>Laporan Pemasukan Ongkir Periode <?php echo tanggal_indo(normalize_datetime($this->input->get('start_date'), 'Y-m-d')) ?> - <?php echo tanggal_indo(normalize_datetime($this->input->get('end_date'), 'Y-m-d')) ?></h4>
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
                            <td class="text-center"><strong>Tanggal Transaksi</strong></td>
                            <td class="text-right"><strong>Total Ongkir</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order as $row): ?>
                            <tr>
                                <td><?php echo $row->kode_transaksi ?></td>
                                <td class="text-center"><?php echo tanggal_indo(normalize_datetime($row->tanggal, 'Y-m-d')) ?></td>
                                <td class="text-right"><?php echo format_rupiah($row->total_ongkir) ?></td>
                            </tr>    
                        <?php endforeach ?>
                        <tr>
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
</body>
