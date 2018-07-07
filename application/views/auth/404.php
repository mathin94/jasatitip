<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Data Tidak Ditemukan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Mathin Mochammad">
    <meta name="description" content="Sistem Penjadwalan POLITEKNIK SUKABUMI">

    <!--[if IE]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo script('assets/plugins/lib/modernizr.js') ?>
    <link rel="icon" href="<?php echo base_url('assets/images/favicon.png') ?>" type="image/gif">
    
    <?php echo style('assets/plugins/bootstrap/bootstrap.css') ?>
    <?php echo style('assets/css/bs-overide/bootstrap.buttons.css') ?>
    <?php echo style('assets/css/lib/page-404.css') ?>
</head>

<body class="page404">
    
    <div class="cont_principal">
        <div class="cont_error">
            <h1>Oops</h1>  
            <p>Data yang kamu cari telum tersedia disini.</p>
            
            <a class="btn btn-success" href="javascript:void(0)" onclick="back_page()"><i class="fa fa-home"></i> Kembali ke Dashboard</a>
            
        </div>
        <div class="cont_aura_1"></div>
        <div class="cont_aura_2"></div>
    </div>
    
    <?php echo script('assets/plugins/lib/jquery-2.2.4.min.js') ?>
    <?php echo script('assets/plugins/bootstrap/bootstrap.min.js') ?>
    <script>
    function back_page() {
        window.location.href = "<?php echo site_url()?>";
    }
    window.onload = function(){
        document.querySelector('.cont_principal').className= "cont_principal cont_error_active"; 
    };
    </script>
</body>
</html>