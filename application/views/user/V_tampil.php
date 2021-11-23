<style>
    .tab-pane.active {
        animation: slide-down 0.5s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
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
            <h1 class=""><i class="fa fa-user-circle mr-3"></i><?= $title ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Bagja</div>
            <div class="breadcrumb-item"><?= $title ?></div>
        </div>
        </div>

        <div class="section-body">

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold active shadow mr-3" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true" style="font-size: 18px;">User UMKM</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold shadow" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 18px;">User Investor</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                                    <div class="table-responsive">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-icon icon-left btn-success mb-3 shadow" id="tambah_user_umkm"><i class="fas fa-plus"></i> Tambah User UMKM</button>
                                        </div>

                                        <table class="table table-striped table-bordered" id="tabel_user" width="100%">
                                            <thead class="thead-light">                                 
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>UMKM</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th width="20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-icon icon-left btn-success mb-3 shadow" id="tambah_user_investor"><i class="fas fa-plus"></i> Tambah User Investor</button>
                                    </div>
                                    

                                    <table class="table table-striped table-bordered" id="tabel_investor" width="100%">
                                        <thead class="thead-light">                                 
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </section>
</div>

<!-- modal tambah user umkm -->
<div id="modal_user_umkm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="title_umkm"></h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_user_umkm">
                <input type="hidden" id="aksi_umkm" name="aksi_umkm" value="Tambah">
                <input type="hidden" id="id_umkm" name="id_umkm">
                <input type="hidden" id="id_user" name="id_user">
                <input type="hidden" id="password_lama" name="password_lama">
                <div class="modal-body">
                    <div class="row p-3 mt-2 d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Umkm</label>
                                <div class="col-sm-9 gif" hidden>
                                    <div class="row d-flex justify-content-center" >
                                        <img src="<?= base_url('assets/img/loading2.gif') ?>" width="8%">
                                    </div>
                                </div>
                                <div class="col-md-9 nama_umkm">
                                    <select name="nama_umkm" id="nama_umkm" class="form-control select2">

                                    </select>
                                </div>
                                <div class="col-md-9 t_umkm">
                                    <h6 id="nm_umkm" class="mt-2"></h6>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username_umkm" name="username_umkm" judul="Username UMKM" placeholder="Masukkan Username">
                                    <span class="text-danger" id="username_umkm_error"></span>
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password_umkm" name="password_umkm" judul="Password UMKM" placeholder="Masukkan Password">
                                    <span toggle="#password_umkm" class="fa fa-smile-beam fa-lg field-icon toggle-password"></span>
                                    <span class="text-danger" id="password_umkm_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email_umkm" name="email_umkm" judul="Email UMKM" placeholder="Masukkan Email">
                                    <span class="text-danger" id="email_umkm_error"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-warning" id="simpan_user_umkm"><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal tambah user investor -->
<div id="modal_user_investor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="title_investor"></h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_user_investor">
                <input type="hidden" id="aksi_investor" name="aksi_investor" value="Tambah">
                <input type="hidden" id="id_investor" name="id_investor">
                <input type="hidden" id="password_lama_in" name="password_lama_in">
                <div class="modal-body">
                    <div class="row p-3 mt-2 d-flex justify-content-center">
                        <div class="col-md-8">

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username_investor" name="username_investor" judul="Username Investor" placeholder="Masukkan Username">
                                    <span class="text-danger" id="username_investor_error"></span>
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password_investor" name="password_investor" judul="Password Investor" placeholder="Masukkan Password">
                                    <span toggle="#password_investor" class="fa fa-smile-beam fa-lg field-icon toggle-password"></span>
                                    <span class="text-danger" id="password_investor_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email_investor" name="email_investor" judul="Email Investor" placeholder="Masukkan Email">
                                    <span class="text-danger" id="email_investor_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Umkm</label>
                                <div class="col-sm-9 gif2" hidden>
                                    <div class="row d-flex justify-content-center" >
                                        <img src="<?= base_url('assets/img/loading2.gif') ?>" width="8%">
                                    </div>
                                </div>
                                <div class="col-md-9 nama_umkm2">
                                    <select name="nama_umkm2" id="nama_umkm2" class="form-control select2" multiple="">

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-warning" id="simpan_user_investor"><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal list umkm -->
<div id="modal_umkm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="title_list"></h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="tabel_umkm" width="100%">
                            <thead class="thead-light">                                 
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Owner</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // 16-11-2020
        var tabel_user = $('#tabel_user').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "User/tampil_data_user_umkm",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,4,5],
                'className' : 'text-center',
            }]

        })

        // 16-11-2020
        var tabel_investor = $('#tabel_investor').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "User/tampil_data_user_investor",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,3,4],
                'className' : 'text-center',
            }]

        })

        // 17-11-2020
        var tabel_umkm = $('#tabel_umkm').DataTable({
            "processing"    : true,
            "order"         : [],
            stateSave       : true,
            "ajax"              : {
                "url"   : "User/tampil_data_umkm",
                "type"  : "POST",
                "data"  : function (data) {

                    data.id_investor = $('#id_investor').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }]

        })

        // 17-11-2020
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-smile-beam fa-meh-rolling-eyes");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });

        // 17-11-2020
        $('#tambah_user_umkm').on('click', function () {

            $('#title_umkm').html("<i class='fa fa-plus mr-3'></i>Tambah User UMKM");
            $('#modal_user_umkm').modal('show');
            $('#form_user_umkm').trigger('reset');

            $('.nama_umkm').attr('hidden', true);
            $('.gif').attr('hidden', false);
            $('.t_umkm').attr('hidden', true);
            
            $('#aksi_umkm').val('Tambah');
            $('#password_umkm_error').text('');

            // ambil umkm
            $.ajax({
                url     : "User/ambil_list_umkm",
                method  : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('.nama_umkm').attr('hidden', false);
                    $('.gif').attr('hidden', true);

                    $('#nama_umkm').html(data.option);

                    if (data.jml == 0) {
                        $('#simpan_user_umkm').attr('disabled', true);
                    } else {
                        $('#simpan_user_umkm').attr('disabled', false);
                    }
                    
                    
                }
            })

            return false;

        })

        // 17-11-2020
        $('#tambah_user_investor').on('click', function () {

            $('#title_investor').html("<i class='fa fa-plus mr-3'></i>Tambah User Investor");
            $('#modal_user_investor').modal('show');
            $('#form_user_investor').trigger('reset');

            $('.nama_umkm2').attr('hidden', true);
            $('.gif2').attr('hidden', false);
            $('.t_umkm2').attr('hidden', true);

            $('#aksi_investor').val('Tambah');
            $('#password_investor_error').text('');
            $('#nama_umkm2').val('').trigger('change');

            // ambil umkm
            $.ajax({
                url     : "User/ambil_list_umkm_investor",
                method  : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('.nama_umkm2').attr('hidden', false);
                    $('.gif2').attr('hidden', true);

                    $('#nama_umkm2').html(data.option);

                    if (data.jml == 0) {
                        $('#simpan_user_investor').attr('disabled', true);
                    } else {
                        $('#simpan_user_investor').attr('disabled', false);
                    }
                    
                    
                }
            })

            return false;

        })

        // 17-11-2020
        $('#nama_umkm2').on('change', function () {
            
            var nama    = $(this).val();
            var pass    = $('#password_investor').val();
            var email   = $('#email_investor').val();
            var aksi    = $('#aksi_investor').val();

            if (validatePass(pass)) {
                if (validateEmail(email)) {
                    if (nama.length != 0) {
                        $('#simpan_user_investor').attr('disabled', false); 
                    } else {
                        if (aksi == 'Ubah') {
                            $('#simpan_user_investor').attr('disabled', false);
                        } else{
                            $('#simpan_user_investor').attr('disabled', true);
                        }
                    }
                } else {
                    $('#simpan_user_investor').attr('disabled', true);  
                }
            } else {
                if (aksi == 'Ubah') {
                    $('#simpan_user_investor').attr('disabled', false);
                } else{
                    $('#simpan_user_investor').attr('disabled', true);
                }
            }
        })

        // 17-11-2020
        $('#password_umkm').on('keyup', function () {

            var pass    = $(this).val();
            var email   = $('#email_umkm').val();
            var nama    = $('#nama_umkm').val();
            var aksi    = $('#aksi_umkm').val();

            if (validatePass(pass)) {
                if (validateEmail(email)) {
                    if (nama != '') {
                       $('#simpan_user_umkm').attr('disabled', false); 
                    } else {
                        if (aksi == 'Ubah') {
                            $('#simpan_user_umkm').attr('disabled', false);
                        } else{
                            $('#simpan_user_umkm').attr('disabled', true);
                        }
                    }
                } else {
                  $('#simpan_user_umkm').attr('disabled', true);  
                }
            } else {
                if (aksi == 'Ubah') {
                    $('#simpan_user_umkm').attr('disabled', false);
                } else{
                    $('#simpan_user_umkm').attr('disabled', true);
                }
            }

            if (aksi == 'Ubah') {
                if (pass != '') {
                    tx = (text + text1 + text2 + text3);
                } else {
                    tx = "Harap diisi bila ingin ganti password!";
                }
            } else {
                if (pass != '') {
                    tx = (text + text1 + text2 + text3);
                } else {
                    tx = "";
                }
            }

            $('#password_umkm_error').text(validatePass(pass) ? "" : tx);
            
        })

        // 17-11-2020
        $('#password_investor').on('keyup', function () {

            var pass    = $(this).val();
            var email   = $('#email_investor').val();
            var nama    = $('#nama_umkm2').val();
            var aksi    = $('#aksi_investor').val();

            if (validatePass(pass)) {
                if (validateEmail(email)) {
                    if (nama.length != 0) {
                        $('#simpan_user_investor').attr('disabled', false); 
                    } else {
                        if (aksi == 'Ubah') {
                            $('#simpan_user_investor').attr('disabled', false);
                        } else{
                            $('#simpan_user_investor').attr('disabled', true);
                        }
                    }
                } else {
                    $('#simpan_user_investor').attr('disabled', true);  
                }
            } else {
                if (aksi == 'Ubah') {
                    $('#simpan_user_investor').attr('disabled', false);
                } else{
                    $('#simpan_user_investor').attr('disabled', true);
                }
            }

            if (aksi == 'Ubah') {
                if (pass != '') {
                    tx = (text + text1 + text2 + text3);
                } else {
                    tx = "Harap diisi bila ingin ganti password!";
                }
            } else {
                if (pass != '') {
                    tx = (text + text1 + text2 + text3);
                } else {
                    tx = "";
                }
            }

            $('#password_investor_error').text(validatePass(pass) ? "" : tx);

        })

        // 17-11-2020
        function validateEmail(email) {
            
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            if (email == '') {
                return false;
            } else {
                return (!emailReg.test( email ) ? false : true);
            }

        }

        function validatePass(pass) {

            validated = true;

            if(pass.length < 6) {
                validated = false; 
                text = "Minamal 6 karakter | ";  
            } else {
                text = "";
            }

            if(!/\d/.test(pass)) {
                validated = false; text1 = "Harus ada angka | ";
            } else {
                text1 = "";
            }
               

            if(!/[a-z]/.test(pass)){
                validated = false; text2 = "Harus ada huruf kecil | ";
            } else {
                text2 = "";
            }
                
            if(!/[A-Z]/.test(pass)){
                validated = false; text3 = "Harus ada huruf besar | ";
            } else {
                text3 = "";
            }

            return validated;
        }

        // 17-11-2020
        $('#email_umkm').on('keyup', function () {

            var email   = $(this).val();
            var pass    = $('#password_umkm').val();
            var nama    = $('#nama_umkm').val();
            var aksi    = $('#aksi_umkm').val();

            if (validateEmail(email)) {
                if (validatePass(pass)) {
                    if (nama != '') {
                        $('#simpan_user_umkm').attr('disabled', false); 
                    } else {
                        $('#simpan_user_umkm').attr('disabled', true);
                    }
                } else {
                    if (aksi == 'Ubah') {
                        $('#simpan_user_umkm').attr('disabled', false);
                    } else{
                        $('#simpan_user_umkm').attr('disabled', true);
                    }
                }
            } else {
                if (aksi == 'Ubah') {
                    $('#simpan_user_umkm').attr('disabled', false);
                } else{
                    $('#simpan_user_umkm').attr('disabled', true);
                }
            }

            $('#email_umkm_error').text(validateEmail(email) ? "" : "Isi email dengan format yang benar!" );
            
        })

        $('#email_investor').on('keyup', function () {

            var email   = $(this).val();
            var pass    = $('#password_investor').val();
            var nama    = $('#nama_umkm2').val();
            var aksi    = $('#aksi_investor').val();

            if (validateEmail(email)) {
                if (validatePass(pass)) {
                    if (nama.length != 0) {
                        $('#simpan_user_investor').attr('disabled', false); 
                    } else {
                        $('#simpan_user_investor').attr('disabled', true);
                    }
                } else {
                    if (aksi == 'Ubah') {
                        $('#simpan_user_investor').attr('disabled', false);
                    } else{
                        $('#simpan_user_investor').attr('disabled', true);
                    }
                }
            } else {
                if (aksi == 'Ubah') {
                    $('#simpan_user_investor').attr('disabled', false);
                } else{
                    $('#simpan_user_investor').attr('disabled', true);
                }
            }

            $('#email_investor_error').text(validateEmail(email) ? "" : "Isi email dengan format yang benar!" );

        })

        // 17-11-2020
        $('#simpan_user_umkm').on('click', function () {
            
            var nama_umkm       = $('#nama_umkm').val();
            var username_umkm   = $('#username_umkm').val();
            var password_umkm   = $('#password_umkm').val();
            var email_umkm      = $('#email_umkm').val();
            var aksi_umkm       = $('#aksi_umkm').val();

            if (password_umkm == '') {

                if (aksi_umkm == 'Tambah') {
                    swal({
                        title               : "Peringatan",
                        text                : 'Password harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 700
                    }); 
                    
                    $('#password_umkm').focus();  
                }

            } 

            if (nama_umkm == '') {
                
                swal({
                    title               : "Peringatan",
                    text                : 'Nama UMKM harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 
                
                $('#nama_umkm').focus();

            } else if (username_umkm == '') {
                
                swal({
                    title               : "Peringatan",
                    text                : 'Username harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 
                
                $('#username_umkm').focus();

            } else if (email_umkm == '') {
                
                swal({
                    title               : "Peringatan",
                    text                : 'Email harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 
                
                $('#email_umkm').focus();

            } else {
                
                var form_user_umkm  = $('#form_user_umkm').serialize();

                $('#simpan_user_umkm').addClass('btn-progress disabled');
                
                $.ajax({
                    url     : "User/simpan_data_user",
                    type    : "POST",
                    data    : form_user_umkm,
                    dataType: "JSON",
                    success : function (data) {

                        $('#simpan_user_umkm').removeClass('btn-progress disabled');

                        $('#modal_user_umkm').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        });    
        
                        tabel_user.ajax.reload(null,false);        
                        
                        $('#form_user_umkm').trigger("reset");
                        
                        $('#aksi').val('Tambah');
                        
                    }
                })
        
                return false;

            }

        })

        // 17-11-2020
        $('#simpan_user_investor').on('click', function () {

            var nama_umkm   = $('#nama_umkm2').val();
            var username    = $('#username_investor').val();
            var password    = $('#password_investor').val();
            var email       = $('#email_investor').val();
            var aksi        = $('#aksi_investor').val();
            var password_lm = $('#password_lama').val();
            var id_investor = $('#id_investor').val();

            var nama_umkm2  = JSON.stringify(nama_umkm);

            if (password == '') {

                if (aksi == 'Tambah') {
                    swal({
                        title               : "Peringatan",
                        text                : 'Password harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 700
                    }); 
                    
                    $('#password_investor').focus();  
                }

            } 

            if (nama_umkm.length == 0) {

                swal({
                    title               : "Peringatan",
                    text                : 'Nama UMKM harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                $('#nama_umkm2').focus();  

            } else if (username == '') {

                swal({
                    title               : "Peringatan",
                    text                : 'Username harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                $('#username_investor').focus();

            } else if (email == '') {

            swal({
                title               : "Peringatan",
                text                : 'Email harus terisi !',
                buttonsStyling      : false,
                type                : 'warning',
                showConfirmButton   : false,
                timer               : 700
            }); 

            $('#email_investor').focus();

            } else {

                var form_user_investor  = $('#form_user_investor').serialize();

                $('#simpan_user_investor').addClass('btn-progress disabled');

                $.ajax({
                    url     : "User/simpan_data_investor",
                    type    : "POST",
                    data    : {aksi_investor:aksi, username_investor:username, password_investor:password, password_lama:password_lm, email_investor:email, nama_umkm2:nama_umkm2, id_investor:id_investor},
                    // data    : form_user_investor,
                    dataType: "JSON",
                    success : function (data) {

                        $('#simpan_user_investor').removeClass('btn-progress disabled');

                        $('#modal_user_investor').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        });    

                        tabel_investor.ajax.reload(null,false);        
                        
                        $('#form_user_investor').trigger("reset");
                        
                        $('#aksi_investor').val('Tambah');
                        
                    }
                })

                return false;

            }

        })

        // 17-11-2020
        $('#tabel_user').on('click', '.status-user', function () {

            var status  = $(this).attr('status');
            var id      = $(this).data('id');

            $('#status'+id).addClass('btn-progress disabled');

            // ambil umkm
            $.ajax({
                url     : "User/ubah_status_user",
                method  : "POST",
                data    : {status:status, id_user:id},
                dataType: "JSON",
                success : function (data) {

                    tabel_user.ajax.reload(null, false);
                    $('#status'+id).removeClass('btn-progress disabled');

                }
            })

            return false;
            
        })

        // 17-11-2020
        $('#tabel_investor').on('click', '.status-user', function () {

            var status  = $(this).attr('status');
            var id      = $(this).data('id');

            $('#status_in'+id).addClass('btn-progress disabled');

            // ambil umkm
            $.ajax({
                url     : "User/ubah_status_investor",
                method  : "POST",
                data    : {status:status, id_investor:id},
                dataType: "JSON",
                success : function (data) {

                    tabel_investor.ajax.reload(null, false);
                    $('#status_in'+id).removeClass('btn-progress disabled');

                }
            })

            return false;

        })

        // 17-11-2020
        $('#tabel_user').on('click', '.edit-user', function () {

            var id          = $(this).data('id');
            var nama        = $(this).attr('umkm');
            var username    = $(this).attr('username');
            var email       = $(this).attr('email');
            var password    = $(this).attr('password');
            var id_umkm     = $(this).attr('id_umkm');

            $('#simpan_user_umkm').attr('disabled', false);
            $('#id_user').val(id);
            $('#id_umkm').val(id_umkm);
            $('#username_umkm').val(username);
            $('#email_umkm').val(email);
            $('#password_lama').val(password);
            $('#nm_umkm').text(': '+nama);
            $('#title_umkm').html("<i class='fa fa-pencil-alt mr-3'></i>Ubah User UMKM");
            $('#password_umkm').val('');
            $('#password_umkm_error').text('Harap diisi bila ingin ganti password!');

            $('#aksi_umkm').val('Ubah');
            $('.gif').attr('hidden', true);
            $('.nama_umkm').attr('hidden', true);
            $('.t_umkm').attr('hidden', false);
            
            $('#modal_user_umkm').modal('show');
            
        })

        // 17-11-2020
        $('#tabel_investor').on('click', '.edit-user', function () {

            var id          = $(this).data('id');
            var username    = $(this).attr('username');
            var email       = $(this).attr('email');
            var password    = $(this).attr('password');

            $('#simpan_user_investor').attr('disabled', false);
            $('#id_investor').val(id);
            $('#username_investor').val(username);
            $('#email_investor').val(email);
            $('#password_lama_in').val(password);
            $('#title_investor').html("<i class='fa fa-pencil-alt mr-3'></i>Ubah User Investor");
            $('#password_investor').val('');
            $('#password_investor_error').text('Harap diisi bila ingin ganti password!');

            $('#aksi_investor').val('Ubah');

            $('.nama_umkm2').attr('hidden', true);
            $('.gif2').attr('hidden', false);

            $('#modal_user_investor').modal('show');
            

            // ambil umkm
            $.ajax({
                url     : "User/ambil_list_umkm_investor_edit",
                method  : "POST",
                data    : {id_investor:id},
                dataType: "JSON",
                success : function (data) {

                    $('.nama_umkm2').attr('hidden', false);
                    $('.gif2').attr('hidden', true);

                    $('#nama_umkm2').html(data.option);

                    var nama_umkm  = JSON.stringify(data.selected);
                    
                    $('#nama_umkm2').val(data.selected).trigger('change');
                }
            })

            return false;

        })

        // 17-11-2020
        $('#tabel_investor').on('click', '.list-umkm', function () {

            var id_investor = $(this).data('id');
            var investor    = $(this).attr('investor');

            $('#id_investor').val(id_investor);

            $('#modal_umkm').modal('show');

            $('#title_list').html("<i class='fa fa-list-ol mr-3'></i>Umkm Investor "+investor);
            $('#tabel_umkm tbody').empty();
            tabel_umkm.ajax.reload(null, false);
            
        })

        // 17-11-2020
        $('#tabel_umkm').on('click', '.remove-umkm', function () {

            var id_umkm = $(this).data('id');

            $('#status_u'+id_umkm).addClass('btn-progress disabled');

            $.ajax({
                url     : "User/remove_umkm",
                method  : "POST",
                data    : {id_umkm:id_umkm},
                dataType: "JSON",
                success : function (data) {

                    $('#status_u'+id_umkm).removeClass('btn-progress disabled');
                    tabel_umkm.ajax.reload(null, false);
                }
            })

            return false;
            
        })
        
    })
</script>