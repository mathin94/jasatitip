<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
            Users
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Profile
        </span>
    </div>
</div>
<!-- Register Page Start -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="col-md-8">
                    <p class='sidebar-title'><b> Pengaturan Pengguna</b></p> 
                    <br>
                    <div class="logincontainer">
                        <form method="post" action="<?php echo base_url('users/profile') ?>" role="form" id='formku'>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="hidden" name="id_user" id="id_user" value="<?php echo isset($users['id_user']) ? $users['id_user'] : '' ?>">
                                <input type="text" name="username" class="required form-control" placeholder="Tulis Username Anda" autofocus=""  minlength='5' onkeyup="nospaces(this)" value="<?php echo isset($users['username']) ? $users['username'] : '' ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="required form-control" placeholder="Tulis Nama Lengkap" autofocus=""  minlength='5' onkeyup="nospaces(this)" value="<?php echo isset($users['nama_lengkap']) ? $users['nama_lengkap'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="required form-control" placeholder="Tulis Alamat Email Anda" autofocus=""  minlength='5' onkeyup="nospaces(this)" value="<?php echo isset($users['email']) ? $users['email'] : '' ?>">
                            </div>
                            <div align="center">
                                <input name='submit' type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" value="Simpan Perubahan">
                            </div>
                        </form>
                        <br>
                        <br>
                        <br>
                        <p class='sidebar-title'><b> Alamat Pengiriman</b></p><br>
                        <p class='sidebar-title'><a href="<?php echo base_url('users/tambah_alamat') ?>" class="cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Tambah Alamat</a></p><br>
                        <?php $no = 1; ?>
                        <table class="table table-default">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alamat</th>
                                    <th>Alamat Lengkap</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($alamat as $almt): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $almt->nama_alamat ?></td>
                                    <td><?php echo $almt->nama_penerima . '<br>' . $almt->nomor_penerima . '<br>' . $almt->alamat_lengkap . ' Kec. ' . $almt->nama_kecamatan . ', ' . $almt->nama_kabupaten . ', ' . $almt->nama_provinsi . ', ' . $almt->kode_pos ?></td>
                                    <td>
                                        <?php echo anchor(base_url() . 'users/edit_alamat/' . $almt->id_alamat, '<i class="fa fa-edit"></i> Edit'); ?>
                                        <?php echo '<br>' ?>
                                        <a href="#" id="hapus-alamat" onclick="hapus_alamat(<?php echo $almt->id_alamat ?>)"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>   
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

<script>
function hapus_alamat(id) {
    var id_alm = id;
    swal({
        title: 'Hapus Alamat ?',
        text: "Anda Akan Menghapus Alamat Pengiriman!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href="<?php echo base_url() ?>users/delete_alamat/"+id_alm
        }
    })
}
</script>   

<?php echo $this->session->flashdata('alamat_sukses'); ?>