<style>
    .tab-pane.active {
        animation: slide-down 0.5s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }

    textarea.form-control {
        height: 100px !important;
    }

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-right: 15px;
        margin-top: -27px;
        position: relative;
        z-index: 2;
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-cog mr-3"></i><?= $title ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
            <div class="breadcrumb-item"><?= $title ?></div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <div class="card shadow">
                        <div class="card-body">
                            <ul class="nav nav-pills justify-content-start" id="myTab3" role="tablist">
                                <li class="nav-item mr-2">
                                    <a class="nav-link active shadow" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="true"><h5 class="mb-0">Profile</h5></a>
                                </li>
                                <li class="nav-item" hidden>
                                    <a class="nav-link shadow" id="sk-tab3" data-toggle="tab" href="#sk3" role="tab" aria-controls="sk" aria-selected="false"><h5 class="mb-0">Syarat dan Ketentuan</h5></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    
                                <form id="form_user" method="post">
                                    <div class="row mt-3">
                                        <!-- <div class="col-12 col-md-3 col-lg-3">
                                            <article class="article article-style-c mb-0 shadow">
                                                <div class="article-header" style="border-radius: 15px;">
                                                    <?php
                                                        $bg = base_url()."assets/template/img/news/img02.jpg";
                                                    ?>
                                                    <div class="article-image" data-background="<?= $bg ?>">
                                                    </div>
                                                </div>
                                                <div class="article-details mb-0">
                                                    <div class="article-title text-center">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-8 d-flex justify-content-center offset-md-2">
                                                                <button type="button" class="btn btn-warning btn-md tambah_varian_lain" data-id="">Ubah Foto</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </article>  
                                        </div> -->
                                        <div class="col-12 col-md-12 col-lg-12 m-3">
                                            <section class="section">
                                                <div class="section-title mt-0 mb-3">Detail UMKM 
                                                    <button type="button" class="btn btn-warning mt-0 ml-3 mb-3 mr-3 float-right" id="ubah_password"><i class="fa fa-pencil-alt mr-2"></i>Ubah Password</button>
                                                    <button type="button" class="btn btn-success mt-0 ml-3 mb-3 float-right" id="ubah_detail_umkm"><i class="fa fa-pencil-alt mr-2"></i>Ubah Data</button>
                                                    <button type="button" class="btn btn-warning mt-0 ml-3 mb-3 mr-3 float-right" id="simpan_detail_umkm" hidden><i class="fa fa-check mr-2"></i>Simpan</button>
                                                    <button type="button" class="btn btn-danger mt-0 ml-3 mb-3 float-right" id="batal_detail_umkm" hidden><i class="fa fa-times mr-2"></i>Batal</button></div>
                                            </section> 
                                            <div class="form-group row ml-2">
                                                <div class="col-md-7">
                                                    <div class="row">
                                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama UMKM</label>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-1 t_nama">: <span id="txt_nama"><?= $umkm['nama'] ?></span> </h6>
                                                            <input type="text" class="form-control" id="t_nama" value="" name="nama_umkm" hidden>
                                                        </div>
                                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-1 t_alamat">: <span id="txt_alamat"><?= $umkm['alamat'] ?></span></h6>
                                                            <textarea class="form-control" id="t_alamat" cols="20" rows="5" name="alamat" hidden></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Owner</label>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-1 t_nama_owner">: <span id="txt_namaowner"><?= $umkm['namaowner'] ?></span></h6>
                                                            <input type="text" class="form-control" id="t_nama_owner" value="" name="nama_owner" hidden>
                                                        </div>
                                                        
                                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                                        <div class="col-sm-8">
                                                            <h6 class="mt-1 t_telp">: <span id="txt_telp"><?= $umkm['telp'] ?></span></h6>
                                                            <input type="text" class="form-control numeric" id="t_telp" value="" name="telp" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            <section class="section">
                                                <div class="section-title mt-0">Detail User</div>
                                            </section> 
                                            <div class="form-group row ml-2">
                                                <div class="col-md-7">
                                                    <div class="row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                                                        <div class="col-sm-7">
                                                            <h6 class="mt-1 t_user">: <span id="txt_user"><?= $user ?></span></h6>
                                                            <input type="text" class="form-control" id="t_user" value="" name="username" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <div class="tab-pane fade" id="sk3" role="tabpanel" aria-labelledby="sk-tab3">
                                    
                                    
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </section>
</div>

<!-- modal -->
<div id="modal_ubah_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Ubah Password</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-password">
                <input type="hidden" name="iduser" value="<?= $this->session->userdata('id_user'); ?>">
                <input type="hidden" name="username" value="<?= $this->session->userdata('nama');?>">
                <div class="modal-body">
                    <div class="row p-3 mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password Saat Ini</label>
                                <input type="password" class="form-control" id="password_saat_ini" name="password" placeholder="Masukkan Password Saat Ini">
                                <span toggle="#password_saat_ini" class="fa fa-smile-beam fa-lg field-icon toggle-password"></span>
                                <span class="text-danger" id="nama_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="passwordbaru" placeholder="Masukkan Password Baru">
                                <span toggle="#password_baru" class="fa fa-smile-beam fa-lg field-icon toggle-password"></span>
                                <span class="text-danger" id="telp_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmpassword" placeholder="Masukkan Konfirmasi Password">
                                <span toggle="#konfirmasi_password" class="fa fa-smile-beam fa-lg field-icon toggle-password"></span>
                                <span class="text-danger" id="telp_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_password"><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // 17-09-2020
        $('.numeric').numericOnly();

        // 17-09-2020    
        $('#ubah_detail_umkm').on('click', function () {

            // $('.ses_nama').text('Afif');

            $('#simpan_detail_umkm').removeClass('btn-progress disabled');

            $('#simpan_detail_umkm').attr('hidden', false);
            $('#batal_detail_umkm').attr('hidden', false);
            $('#ubah_password').attr('hidden', true);
            $('#ubah_detail_umkm').attr('hidden', true);
            
            var t_nama = $('#txt_nama').text();

            $('.t_nama').attr('hidden', true);
            $('#t_nama').val(t_nama).attr('hidden', false).addClass('mb-3').fadeOut('fast').fadeIn();
            
            var t_nm_owner = $('#txt_namaowner').text();

            $('.t_nama_owner').attr('hidden', true);
            $('#t_nama_owner').val(t_nm_owner).attr('hidden', false).addClass('mb-3').fadeOut('fast').fadeIn();

            var t_alamat = $('#txt_alamat').text();

            $('.t_alamat').attr('hidden', true);
            $('#t_alamat').val(t_alamat).attr('hidden', false).addClass('mb-3').fadeOut('fast').fadeIn();

            var t_telp = $('#txt_telp').text();

            $('.t_telp').attr('hidden', true);
            $('#t_telp').val(t_telp).attr('hidden', false).addClass('mb-3').fadeOut('fast').fadeIn();

            var t_user = $('#txt_user').text();

            $('.t_user').attr('hidden', true);
            $('#t_user').val(t_user).attr('hidden', false).addClass('mb-3').fadeOut('fast').fadeIn();

        })

        // 17-09-2020
        $('#batal_detail_umkm').on('click', function () {

            $('#simpan_detail_umkm').attr('hidden', true);
            $('#batal_detail_umkm').attr('hidden', true);
            $('#ubah_detail_umkm').attr('hidden', false);
            $('#ubah_password').attr('hidden', false);

            $('#t_nama').attr('hidden', true).removeClass('mb-3');
            $('.t_nama').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#t_nama_owner').attr('hidden', true).removeClass('mb-3');
            $('.t_nama_owner').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#t_alamat').attr('hidden', true).removeClass('mb-3');
            $('.t_alamat').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#t_telp').attr('hidden', true).removeClass('mb-3');
            $('.t_telp').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#t_user').attr('hidden', true).removeClass('mb-3');
            $('.t_user').attr('hidden', false).fadeOut('fast').fadeIn();

        })

        // 17-09-2020
        $('#simpan_detail_umkm').on('click', function () {
            
            var form_user  = $('#form_user').serialize();

            $(this).addClass('btn-progress disabled');

            $.ajax({
                url     : "Pengaturan/simpan_data_user",
                type    : "POST",
                data    : form_user,
                dataType: "JSON",
                success : function (data) {

                    $('#simpan_detail_umkm').removeClass('btn-progress disabled');

                    swal({
                        title               : "Berhasil",
                        text                : 'Data berhasil disimpan',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-success",
                        type                : 'success',
                        showConfirmButton   : false,
                        timer               : 700
                    });

                    $('#simpan_detail_umkm').attr('hidden', true);
                    $('#batal_detail_umkm').attr('hidden', true);
                    $('#ubah_detail_umkm').attr('hidden', false);
                    $('#ubah_password').attr('hidden', false);

                    var t_nama = $('#t_nama').val();
                    $('#txt_nama').text(t_nama);

                    $('.t_nama').attr('hidden', false).fadeOut('fast').fadeIn();
                    $('#t_nama').attr('hidden', true).removeClass('mb-3');
                    
                    var t_nm_owner = $('#t_nama_owner').val();
                    $('#txt_namaowner').text(t_nm_owner);

                    $('.t_nama_owner').attr('hidden', false).fadeOut('fast').fadeIn();
                    $('#t_nama_owner').attr('hidden', true).removeClass('mb-3');

                    var t_alamat = $('#t_alamat').val();
                    $('#txt_alamat').text(t_alamat);

                    $('.t_alamat').attr('hidden', false).fadeOut('fast').fadeIn();
                    $('#t_alamat').attr('hidden', true).removeClass('mb-3');

                    var t_telp = $('#t_telp').val();
                    $('#txt_telp').text(t_telp);

                    $('.t_telp').attr('hidden', false).fadeOut('fast').fadeIn();
                    $('#t_telp').attr('hidden', true).removeClass('mb-3');

                    var t_user = $('#t_user').val();
                    $('#txt_user').text(t_user);

                    $('.t_user').attr('hidden', false).fadeOut('fast').fadeIn();
                    $('#t_user').attr('hidden', true).removeClass('mb-3');

                    $('.ses_nama').text(t_user.toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()));

                    
                }
            })
    
            return false;

        })

        // 18-09-2020
        $('#ubah_password').on('click', function () {

            $('#form-password').trigger('reset');
            $('#modal_ubah_password').modal('show');

        })

        // 18-09-2020
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-smile-beam fa-meh-rolling-eyes");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }

        });

        // 18-09-2020
        $("#simpan_password").on('click', function () {
            
            var form_password       = $('#form-password').serialize();
            var password_saat_ini   = $('#password_saat_ini').val();
            var password_baru       = $('#password_baru').val();
            var konfirmasi_password = $('#konfirmasi_password').val();

            $(this).addClass('btn-progress disabled');

            if ((password_saat_ini == "") && (password_baru == "") && (konfirmasi_password == "")) {

                $('#password_saat_ini').focus();
                $('#simpan_password').removeClass('btn-progress disabled');

                swal({
                    title               : "Peringatan",
                    text                : 'Semua data harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;

            } else if (password_saat_ini == "") {

                $('#password_saat_ini').focus();
                $('#simpan_password').removeClass('btn-progress disabled');

                swal({
                    title               : "Peringatan",
                    text                : 'Password saat ini harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;

            } else if (password_baru == "") {

                $('#password_baru').focus();
                $('#simpan_password').removeClass('btn-progress disabled');

                swal({
                    title               : "Peringatan",
                    text                : 'Password Baru harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;

            } else if (konfirmasi_password == "") {

                $('#konfirmasi_password').focus();
                $('#simpan_password').removeClass('btn-progress disabled');

                swal({
                    title               : "Peringatan",
                    text                : 'Konfirmasi Password harus terisi dahulu!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                return false;

            }

            $.ajax({
                url     : "https://mitrabagja.com/be/ubahPassword",
                type    : "POST",
                data    : form_password,
                dataType: "JSON",
                success : function (data) {

                    console.log(data);

                    $('#simpan_password').removeClass('btn-progress disabled');

                    if (data.status == 0) {

                        $('#password_saat_ini').val('');
                        $('#password_saat_ini').focus();

                        swal({
                            title               : "Peringatan",
                            text                : data.pesan,
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        return false;
                        
                    } else if (data.status == 2) {
                        
                        $('#konfirmasi_password').val('');
                        $('#konfirmasi_password').focus();

                        swal({
                            title               : "Peringatan",
                            text                : data.pesan,
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        return false;
                        
                    } else {

                        $('#form-password').trigger('reset');
                        $('#modal_ubah_password').modal('hide');

                        swal({
                            title               : "Berhasil Diubah",
                            html                : "Catat! Password anda saat ini adalah <strong>"+konfirmasi_password+"</strong>",
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : true,
                        });

                    }

                    
                }
            })
    
            return false;

        })
        
    })
</script>