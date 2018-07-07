
    <br>
    <br>
    <br>
    <br>

    
    <!-- Register Page Start -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="col-md-8">
                        <center>
                            <img src="<?php echo base_url('assets/front/images/success.png') ?>" class="img-responsive" alt="Image">
                            <br>
                            <br>
                            <p><?php echo $response ?></p>
                            <p><a href="<?php echo base_url('auth/login') ?>"> Klik Untuk Login</a></p>
                    </div>
                    
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="bor17 of-hidden pos-relative">
                            <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

                            <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>

                        <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Kategori Produk
                            </h4>

                            <?php echo list_kategori2() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>