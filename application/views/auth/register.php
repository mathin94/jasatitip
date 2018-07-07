
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
                        <p class='sidebar-title'><b> Pendaftaran Pengguna</b></p> 
                        <br>
                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo validation_errors() ?>
                            </div>
                        <?php endif ?>
                        <div class="logincontainer">
                            <form method="post" action="<?php echo base_url('auth/register') ?>" role="form" id='formku'>
                                
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="required form-control" placeholder="Tulis Nama Lengkap" autofocus=""  minlength='5' onkeyup="nospaces(this)">
                                </div>

                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="required form-control" placeholder="Tulis Alamat Email Anda" autofocus=""  minlength='5' onkeyup="nospaces(this)">
                                </div>

                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" class="required form-control" placeholder="Tulis Username Anda" autofocus=""  minlength='5' onkeyup="nospaces(this)">
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" name="password" class="form-control required" placeholder="Masukkan Password" onkeyup=\"nospaces(this)\" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Konfirmasi Password</label>
                                    <input type="password" name="password_konfirmasi" class="form-control required" placeholder="Masukkan Password" onkeyup=\"nospaces(this)\" autocomplete="off">
                                </div>
                                <div align="center">
                                    <input name='submit' type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" value="Daftar">
                                </div>
                            </form>
                        </div>   
                    </div>
                    
                </div>

               
            </div>
        </div>
    </section>