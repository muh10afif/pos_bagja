<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Ubah Transaksi</h5>
    <button class="close p-3 batal_produk3" data-dismiss="modal" aria-label="Close" id_produk="<?= $pro['id'] ?>">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-0">
    <input type="hidden" value="<?= $pro['id'] ?>" id="id_produk_t3">
    <input type="hidden" value="<?= $pro['discount'] ?>" name="diskon" id="diskon3">
    <input type="hidden" value="<?= $aksi_tambah ?>" class="aksi_tambah2_<?= $pro['id'] ?>">
    <input type="hidden" value="<?= $key ?>" class="key">
    <input type="hidden" value="<?= $status_edit ?>" class="status_edit">
    <div class="row">
        <div class="col-md-12">
            <article class="article mb-0">
            <div class="article-header">
                <?php
                    if ($pro['image'] == null) {
                        $bg = base_url()."assets/template/img/news/img04.jpg";
                    } else {
                        // $bg = "https://mitrabagja.com/upload/produk/".$pro['image'];
                        $bg = "https://mitrabagja.com/upload/produk/".$pro['image'];
                    }
                ?>

                <div class="article-image" style="background-image: url('<?php echo $bg ?>')">
                </div>
                <div class="article-title">
                
                </div>
            </div>
            <div class="article-details mb-0">
                <div class="row">
                    <div class="col-md-6">
                        <?php              
                            if ($pro['discount'] == 0) {
                                $a = "";
                                $b = "";
                            } else {
                                $a = "<small><i class='fa fa-tag mr-2'></i>Rp. ".number_format($pro['discount'],0,'.','.')." off</small>";
                                $b = "<h6 class='text-muted'><del>".number_format($pro['harga'],0,'.','.')."</del></h6>";
                            }

                        ?>
                        <h5 class="j_produk"><?= $pro['nama'] ?></h5>
                        <?= $a ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <h5 class="h_produk3"><?= number_format($pro['harga'] - $pro['discount'],0,'.','.') ?></h5>
                        <?= $b ?>
                    </div>
                </div>
            </div>
            </article>
        </div>
    </div>

    <?php if (!empty($ukuran)): ?>
        <section class="section ml-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title mt-0">Ukuran</div>
                </div>
                <div class="col-md-6 text-right">
                    <span class="text-danger mr-3 note3"><?= ($produk['id_ukuran'] == null) ? 'Harap pilih ukuran!' : '' ?></span>
                </div>
            </div>
        </section> 
    <?php endif; ?>
    
    <div class="row mb-2 mr-2">

    <?php foreach ($ukuran as $u): ?>
        <div class="col-md-6">
            <div class="custom-switches-stacked">
                <label class="custom-switch">
                    <input type="radio" name="ukuran3" value="1" class="custom-switch-input ukuran3" id_produk="<?= $u['id_produk'] ?>" id_ukuran="<?= $u['id'] ?>" harga="<?= $u['harga'] ?>" <?= ($produk['id_ukuran'] == $u['id']) ? 'checked' : '' ?>>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description nm_bold_ukuran bold_ukuran<?= $u['id'] ?> <?= ($produk['id_ukuran'] == $u['id']) ? 'font-weight-bold' : '' ?>"><?= $u['ukuran'] ?></span>
                </label>
            </div>
        </div>
        <div class="col-md-6 text-right hrg3 t_harga3<?= $u['id'] ?> <?= ($produk['id_ukuran'] == $u['id']) ? 'font-weight-bold' : '' ?>" id_ukuran="<?= $u['id'] ?>">
            +<?= number_format($u['harga'],0,'.','.') ?>
        </div>
    <?php endforeach; ?>
        
    </div>

    <?php if (!empty($topping)): ?>
        <section class="section ml-2">
            <div class="section-title mt-0">Topping</div>
        </section> 
    <?php endif; ?>

    <div class="row mb-2 mr-2">

    <?php foreach ($topping as $t): ?>
        <div class="col-md-6">

            <div class="form-check ml-3 mb-2">
                <input class="form-check-input topping3" name="topping3" type="checkbox" id="etopping_<?= $t['id'] ?>" harga="<?= $t['harga'] ?>" id_topping="<?= $t['id'] ?>"

                <?php if ($produk['id_topping'] != null): ?>

                    <?php foreach ($produk['id_topping'] as $tp):
                        if ($tp == $t['id']) {
                            echo "checked";
                        } else {
                            echo "";
                        }     
                    ?>
                        
                    <?php endforeach; ?>

                <?php endif; ?>
                >
                <label class="form-check-label" for="etopping_<?= $t['id'] ?>">
                    <span class="nm_topping lb_topping3<?= $t['id'] ?>

                    <?php if ($produk['id_topping'] != null): ?>

                        <?php foreach ($produk['id_topping'] as $tp):
                            if ($tp == $t['id']) {
                                echo "font-weight-bold";
                            } else {
                                echo "";
                            }     
                        ?>
                            
                        <?php endforeach; ?>

                    <?php endif; ?>

                    "><?= $t['topping'] ?></span>
                </label>
            </div>

        </div>
        <div class="col-md-6 text-right hrg_tp tp_harga3<?= $t['id'] ?> 
        
        <?php if ($produk['id_topping'] != null): ?>

            <?php foreach ($produk['id_topping'] as $tp):
                if ($tp == $t['id']) {
                    echo "font-weight-bold";
                } else {
                    echo "";
                }     
            ?>
                
            <?php endforeach; ?>

        <?php endif; ?>
        
        " id_ukuran="<?= $t['id'] ?>">
            +<?= number_format($t['harga'],0,'.','.') ?>
        </div>
    <?php endforeach; ?>
        
    </div>

    <?php 
    
        // if ($produk['id_ukuran'] != null) {
        //     if ($produk['id_topping'] == null) {
        //         if ($produk['id_ukuran'] != null) {
        //             $dis = "disabled";
        //             $bt  = "btn-secondary";
        //         } else {
        //             $dis = "";
        //             $bt  = "btn-success";
        //         }
        //     } else {
        //         $dis = "disabled";
        //         $bt  = "btn-secondary";
        //     }
        // } else {
        //     $dis = "";
        //     $bt  = "btn-success";
        // }

        if ($produk['id_ukuran'] != null) {
            // if ($produk['id_topping'] == null) {
            //     if ($produk['id_ukuran'] != null) {
            //         $dis = "disabled";
            //         $bt  = "btn-secondary";
            //     } else {
            //         $dis = "";
            //         $bt  = "btn-success";
            //     }
            // } else {
            //     $dis = "disabled";
            //     $bt  = "btn-secondary";
            // }

            $dis = "";
            $bt  = "btn-success";
        } else {
            if ($produk['id_topping'] != null) {
                $dis = "";
                $bt  = "btn-success";
            }
            if ($produk['id_topping'] == null) {
                $dis = "";
                $bt  = "btn-success";
            }
        }
    
    ?>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="input-counter3 input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="btn-subtract3 btn btn-warning btn-spin3" <?= $dis ?> aksi="kurang">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control counter3 text-center angka_qty3" data-min="0" value="<?= $produk['qty'] ?>">
                        <div class="input-group-append">
                            <button type="button" class="btn-add3 btn btn-warning btn-spin3" <?= $dis ?> aksi="tambah">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="modal-footer d-flex justify-content-center mt-0">
    
    <button type="button" class="btn btn-warning btn-lg mr-2 batal_produk3" id="batal_produk" data-dismiss="modal" id_produk="<?= $pro['id'] ?>"><i class='fas fa-times mr-2'></i>Batal</button>
    <button type="button" class="btn <?= $bt ?> btn-lg" id="simpan_produk3" <?= $dis ?>>
        <span id="t_simpan3"><i class='fas fa-check mr-2'></i>Update - Rp. <?= number_format($produk['total'],0,'.','.') ?></span>
        <input type="hidden" name="in_tot" id="in_tot3" value="<?= $produk['total'] ?>">
    </button>

</div>

<script>
    $(document).ready(function () {
        var options = {
            selectors: {
                addButtonSelector		: '.btn-add3',
                subtractButtonSelector	: '.btn-subtract3',
                inputSelector			: '.counter3',
            },
            settings: {
                checkValue: true,
                isReadOnly: true,
            },
        };

        $(".input-counter3").inputCounter(options);

        // 27-08-2020
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.ukuran3').on('change', function () {

            var isi         = $(this).val();
            var id_produk   = $(this).attr('id_produk');
            var id_ukuran   = $(this).attr('id_ukuran');
            var harga_u     = $(this).attr('harga');
            var hg          = $('.h_produk3').text().replace("Rp. ","").replace(".","");
            var angka       = $('.angka_qty3').val();

            var th = 0;
            $('.topping3').each(function () {
                var isi_t   = $(this).is(':checked');
                var harga   = $(this).attr('harga');

                if (isi_t == true) {
                    th = parseInt(th) + parseInt(harga);
                }
            })

            var tot = (parseInt(hg)+parseInt(harga_u)+parseInt(th));

            $('.btn-add3').removeAttr('disabled');
            $('.btn-subtract3').removeAttr('disabled');
            $('#simpan_produk3').removeAttr('disabled');
            $('.note3').text('');

            $('.hrg3').each(function () {

                $(".hrg3").removeClass("font-weight-bold");
                $(".t_harga3"+id_ukuran).addClass("font-weight-bold");
                $(".nm_bold_ukuran").removeClass("font-weight-bold");
                $(".bold_ukuran"+id_ukuran).addClass("font-weight-bold");

            })

            $('#simpan_produk3').removeClass('btn-secondary').addClass('btn-success');

            $('#t_simpan3').html("<i class='fas fa-check mr-2'></i>Update - Rp."+separator(tot*angka)).fadeOut('fast').fadeIn();

            $('#in_tot3').val(tot*angka);

        })

        $('.btn-spin3').on('click', function () {
            
            var hg      = $('.h_produk3').text().replace("Rp. ","").replace(".","");
            var angka   = $('.angka_qty3').val();
            var isi     = $("input[name='ukuran3']:checked").attr('harga');

            var th = 0;
            $('.topping3').each(function () {
                var isi_t     = $(this).is(':checked');
                var harga   = $(this).attr('harga');

                if (isi_t == true) {
                    th = parseInt(th) + parseInt(harga);
                }
            })

            if (isi == undefined) {
                isi_i = 0;
            } else {
                isi_i = isi;
            }

            var tot = (parseInt(hg)+parseInt(isi_i)+parseInt(th));

            if (angka != 0) {
                $('#simpan_produk3').removeClass('btn-danger').addClass('btn-success')
                $('#t_simpan3').html("<i class='fas fa-check mr-2'></i>Update - Rp."+separator(tot * angka)).fadeOut('fast').fadeIn();
            } else {
                $('#t_simpan3').html("<i class='fas fa-trash mr-2'></i>Hapus");
                $('#simpan_produk3').removeClass('btn-success').addClass('btn-danger');
            }

            $('#in_tot3').val(tot*angka);

        })

        // 28-08-2020

        $('.topping3').on('change', function () {
            var isi         = $(this).is(':checked');
            var id_topping  = $(this).attr('id_topping');

            var hg      = $('.h_produk3').text().replace("Rp. ","").replace(".","");
            var angka   = $('.angka_qty3').val();
            
            if (isi == true) {
                $('.lb_topping3'+id_topping).addClass('font-weight-bold');
                $('.tp_harga3'+id_topping).addClass('font-weight-bold');
            } 
            
            if (isi == false) {
                $('.lb_topping3'+id_topping).removeClass('font-weight-bold');
                $('.tp_harga3'+id_topping).removeClass('font-weight-bold');
            }

            var th = 0;
            $('.topping3').each(function () {

                var isi2        = $(this).is(':checked');
                var harga       = $(this).attr('harga');
                var id_tpg      = $(this).attr('id_topping');

                if (isi2 == true) {
                    th = parseInt(th) + parseInt(harga);
                } 
                
            })

            var isi3     = $("input[name='ukuran3']:checked").attr('harga');

            if (isi3 == undefined) {
                isi_i = 0;
            } else {
                isi_i = isi3;
            }

            var tot = (parseInt(hg) + parseInt(th) + parseInt(isi_i)) * angka;

            $('#t_simpan3').html("<i class='fas fa-check mr-2'></i>Update - Rp."+separator(tot)).fadeOut('fast').fadeIn();

            $('#in_tot3').val(tot);

        })

        // aksi batal produk
        $('.batal_produk3').on('click', function () {
            var id          = $(this).attr('id_produk');
            var aksi_tambah = $('.aksi_tambah2_'+id).val();
            var status_edit = $('.status_edit').val();

            if (aksi_tambah == 'pertama') {
                $('#modal_topping').modal('hide');
                $('#check_pro_'+id).prop('checked', false); 
            } else if (aksi_tambah == 'kedua') {
                $('#modal_topping').modal('hide');
                $('#modal_list_pro').modal('show');
                $('#check_pro_'+id).prop('checked', true); 
            } 

            if (status_edit == 'checkout') {
                $('#modal_transaksi_kedua').modal('hide');
                $('#modal_checkout').modal('show');
            }
        })

        var list_t = [];

        // aksi simpan produk
        $('#simpan_produk3').on('click', function () {
            var tot             = $('#in_tot3').val();
            var qty             = $('.angka_qty3').val();
            var harga_ukuran    = $("input[name='ukuran3']:checked").attr('harga');
            var id_ukuran       = $("input[name='ukuran3']:checked").attr('id_ukuran');
            var id_produk       = $("#id_produk_t3").val();
            var diskon          = $('#diskon3').val();
            var key             = $('.key').val();
            var status_edit     = $('.status_edit').val();
            
            var id_tp = [];
            $('input[name=topping3]:checked').each(function () {
                var a = $(this).attr('id_topping');

                id_tp.push(a);
            });

            $(this).addClass('btn-progress disabled');

            // var df = [tot];

            // list_t.push(tot);

            // console.log(key);
            
            $.ajax({
                url     : "<?= base_url() ?>Transaksi/simpan_ubah_list_transaksi2",
                type    : "POST",
                data    : {total:tot, qty:qty, harga_ukuran:harga_ukuran, id_ukuran:id_ukuran, id_produk:id_produk, id_topping:id_tp, diskon:(diskon * qty), key:key},
                dataType: "JSON",
                success : function (data) {

                    $('#modal_transaksi_kedua').modal('hide');

                    $(this).removeClass('btn-progress disabled');

                    $('.f_list_pro').html('');

                    if (status_edit == 'checkout') {

                        $.ajax({
                            url         : "<?= base_url() ?>Transaksi/tampil_produk",
                            method      : "POST",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            data        : {key:key, id_produk:id_produk},
                            success     : function (data2) {

                                    swal.close();

                                    $.ajax({
                                        url     : "<?= base_url() ?>Transaksi/ambil_kondisi_produk",
                                        method  : "POST",
                                        data    : {id_produk:id_produk},
                                        dataType: "JSON",
                                        success : function (data) {
                                            
                                            if (data.jml_pro == 0) {
                                                $('#modal_checkout').modal('hide');
                                                $('.aksi_tambah_'+id_produk).val('pertama');
                                            } else {
                                                $('#modal_checkout').modal('show');
                                            }

                                            $('.f_checkout').html(data2);
                                            
                                            // $('#modal_transaksi_kedua').modal('hide');

                                            if (data.qty > 0) {

                                                $('#t_qty_'+id_produk).text('');
                                                $('.t_qty_'+id_produk).attr('hidden', true);
                                                $('#t_qty_'+id_produk).text(data.qty+'x');
                                                $('#t_qty_'+id_produk).attr('hidden', false);
                                                
                                            } else {

                                                $('#check_pro_'+id_produk).prop('checked', false);

                                                $('#t_qty_'+id_produk).text('');
                                                $('.t_qty_'+id_produk).attr('hidden', true);
                                                $('#t_qty_'+id_produk).attr('hidden', true);
                                            }

                                            if (data.tot_qty == 0) {
                                                $('#btn_checkout').attr('disabled', true);
                                            } else {
                                                $('#btn_checkout').attr('disabled', false);
                                            }
                                            $('.angka_badge').text(data.tot_qty);  

                                        }
                                    })

                                    
                                
                            },
                            error       : function(xhr, status, error) {
                                var err = eval("(" + xhr.responseText + ")");
                                alert(err.Message);
                            }

                        })
                        
                        
                    } else {
                        $.ajax({
                            url     : "<?= base_url() ?>Transaksi/ambil_data_tambah_produk/"+id_produk,
                            type    : "POST",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            success : function (data) {

                                swal.close();
                                
                                $.ajax({
                                    url     : "<?= base_url() ?>Transaksi/ambil_kondisi_produk",
                                    method  : "POST",
                                    data    : {id_produk:id_produk},
                                    dataType: "JSON",
                                    success : function (data2) {

                                        // console.log(data2.jumlah_pro);

                                        if (status_edit == 'checkout') {
                                            $('#modal_transaksi_kedua').modal('hide');
                                            $('#modal_checkout').modal('show');
                                        } else {
                                            if (data2.jumlah_pro == 0) {
                                                $('#modal_list_pro').modal('hide');
                                                $('.aksi_tambah_'+id_produk).val('pertama');
                                            } else {
                                                $('#modal_list_pro').modal('show');
                                                $('.f_list_pro').html(data);
                                            }
                                        }
                                        
                                        $('#modal_transaksi_kedua').modal('hide');

                                        if (data2.qty > 0) {

                                            $('#t_qty_'+id_produk).text('');
                                            $('.t_qty_'+id_produk).attr('hidden', true);
                                            $('#t_qty_'+id_produk).text(data2.qty+'x');
                                            $('#t_qty_'+id_produk).attr('hidden', false);
                                            
                                        } else {

                                            $('#check_pro_'+id_produk).prop('checked', false);

                                            $('#t_qty_'+id_produk).text('');
                                            $('.t_qty_'+id_produk).attr('hidden', true);
                                            $('#t_qty_'+id_produk).attr('hidden', true);
                                        }

                                        if (data2.tot_qty == 0) {
                                            $('#btn_checkout').attr('disabled', true);
                                        } else {
                                            $('#btn_checkout').removeAttr('disabled');
                                        }

                                        $('.angka_badge').text(data2.tot_qty);  

                                    }
                                })

                            }
                        })
                    }

                }
            })

            return false;
        })

    })
</script>