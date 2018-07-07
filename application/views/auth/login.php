<!-- Title page -->
    <br>
    <br>
    <br>
    <br>

    
    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="col-md-8">
                        <p class='sidebar-title'><b> Login Users</b></p> 
                        <div class='alert alert-info'>Gunakan email/username dan password untuk login,...</div>
                        <br>
                        <div class="logincontainer">
                            <?php echo form_open(site_url('auth/login'), array('role'=>'form','id'=>'formku')); ?>
                                <div class="form-group">
                                    <label for="inputEmail">Email / Username</label>
                                    <input type="text" name="username" class="required form-control" placeholder="Masukkan Email / Username" autofocus="">
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" name="password" class="form-control required" placeholder="Masukkan Password" onkeyup=\"nospaces(this)\" autocomplete="off">
                                </div>
                                <!-- <a href="<?php echo base_url() ?>auth/forget">Lupa Password Anda?</a><br><br> -->
                                <div align="center">
                                    <input type="hidden" name="submit">
                                    <input name='login' type="submit" class="btn btn-success" value="Login"> <a href="<?php echo base_url('auth/register') ?>" title="Mari gabung bersama Kami" class="btn btn-default">Belum Punya Akun?</a>
                                </div>
                            </form>
                        </div>   
                    </div>
                    
                </div>
            </div>
        </div>
    </section>