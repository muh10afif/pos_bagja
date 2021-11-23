<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Bagja Lite</title>
        <!-- icon -->
        <link href="<?php echo base_url() ?>assets/img/logo.png" rel="shortcut icon">
        <!-- Bootstrap 4 -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/fontawesome/css/all.min.css">
        <!-- Template CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/css/components.css">
        <style>
          .field-icon {
              float: right;
              margin-left: -25px;
              margin-right: 10px;
              margin-top: -26px;
              position: relative;
              z-index: 2;
          }
        </style>
    </head>
    <!-- END: Head -->
    <body>
      <div id="app">
        <section class="section">
          <div class="container mt-5">
            <div class="row">
              <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                  <img src="<?php echo base_url() ?>assets/img/logo.png" alt="logo" width="150" class="shadow-light rounded-circle pl-3 pr-3 pt-1s pb-1">
                </div>

                <div class="card card-warning shadow">
                  <div class="card-header">
                    <div class="container-fluid">
                      <div class="row text-center">
                        <div class="col-md-12 ">
                          <h4 class="text-warning font-weight-bold mt-2 mb-0" style="font-size: 25px;">BAGJA - LITE</h4>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <form id="form-login" method="post" autocomplete="off">
                    <div class="card-body mb-0">
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input id="username" type="username" class="form-control" name="username" tabindex="1" placeholder="Username">
                        </div>
                        <div class="form-group mb-0">
                          <div class="d-block">
                              <label for="password" class="control-label">Password</label>
                          </div>
                          <input id="password" type="password" class="form-control" name="password" tabindex="2" placeholder="Password">
                          <i toggle="#password" class="fa fa-smile-beam fa-lg field-icon toggle-password"></i>
                        </div>
                    </div>
                    <div class="card-footer mb-2 p-3">
                      <button type="submit" class="btn btn-warning btn-lg btn-block">
                          Login
                        </button>
                    </div>
                  </form>
                </div>
                <div class="simple-footer">
                  Powered by Bagja Indonesia &copy; <?php echo date('Y') ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- General JS Scripts -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      <script src="<?= base_url() ?>assets/template/js/stisla.js"></script>

      <!-- JS Libraies -->

      <!-- Template JS File -->
      <script src="<?= base_url() ?>assets/template/js/scripts.js"></script>
      <script src="<?= base_url() ?>assets/template/js/custom.js"></script>
        <script src="<?= base_url() ?>assets/swa/sweetalert2.all.min.js"></script>
        <!-- END: JS Assets-->

        <script>
        
            $(document).ready(function () {
                
                $('#form-login').on('submit', function () {

                    var username    = $('#username').val();
                    var password    = $('#password').val();

                    if ((username == "") && (password == "")) {

                        $('#username').focus();

                        swal({
                            title               : "Peringatan",
                            text                : 'Semua data harus terisi dahulu!',
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        return false;

                    } else if (username == "") {

                        $('#username').focus();

                        swal({
                            title               : "Peringatan",
                            text                : 'Username harus terisi dahulu!',
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 700
                        }); 

                        return false;

                    } else if (password == "") {

                        $('#password').focus();

                        swal({
                            title               : "Peringatan",
                            text                : 'Password harus terisi dahulu!',
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 700
                        }); 

                        return false;

                    } else {
                        // jalankan proses ajax kirim data
                        $.ajax({
                            type        : "post",
                            // url         : "https://mitrabagja.com/be/authLogin",
                            //url         : "http://apilite-tester.mitrabagja.com/be/authLogin",
                            url         : "Login/cek_masuk",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            data        : {username:username, password:password},
                            dataType    : 'JSON',
                            success     : function (data) {

                              // buat localhost
                              if (data.status == 1) {

                                var url = "<?= base_url('Home') ?>";

                                window.location.href = url;

                              } else if (data.status == 0) {

                                $('#username').val('');

                                swal({
                                    title               : "Peringatan",
                                    text                :  (data.pesan).toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()),
                                    type                : 'warning',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#username').focus();

                                return false;

                              } else if (data.status == 2) {

                                $('#password').val('');

                                swal({
                                    title               : "Peringatan",
                                    text                : (data.pesan).toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()),
                                    type                : 'warning',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#password').focus();

                                return false;

                              }
                              // akhir localhost

                                // if (data[0].status == 1) {

                                //   $.ajax({
                                //     url     : "Login/buat_session",
                                //     type    : "post",
                                //     data    : {umkm:data[0].umkm},
                                //     dataType: "JSON",
                                //     success : function (data) {

                                //       // console.log(data.pesan);
                                      
                                //       var url = "<?= base_url('Home') ?>";
                                //       window.location.href = url;

                                //     }
                                //   })

                                // } else if (data[0].status == 0) {

                                //   $('#username').val('');

                                //   swal({
                                //       title               : "Peringatan",
                                //       text                :  (data[0].pesan).toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()),
                                //       type                : 'warning',
                                //       showConfirmButton   : false,
                                //       timer               : 800
                                //   }); 

                                //   $('#username').focus();

                                //   return false;
                                  
                                // } else if (data[0].status == 2) {

                                //   $('#password').val('');

                                //   swal({
                                //       title               : "Peringatan",
                                //       text                : (data[0].pesan).toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()),
                                //       type                : 'warning',
                                //       showConfirmButton   : false,
                                //       timer               : 800
                                //   }); 

                                //   $('#password').focus();

                                //   return false;
                                  
                                // } else if (data[0].status == 3) {

                                //   var a = data[0].umkm;

                                //   var b = a[0].iduser;

                                //     var url = "http://bagja-investor.mitrabagja.com/login/"+b;
                                //     window.location.href = url;

                                // }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                              swal({
                                  title               : "Peringatan",
                                  text                : "Koneksi Tidak Terhubung",
                                  type                : 'warning',
                                  showConfirmButton   : false,
                                  timer               : 1000
                              }); 

                              return false;
                            }							

                            
                        })
                        
                        return false;

                    }

                })
                
                // <i class="fas fa-meh-rolling-eyes"></i>


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

            })
            
        </script>

    </body>
</html>