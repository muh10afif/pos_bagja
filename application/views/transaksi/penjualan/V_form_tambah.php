<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Tambah Transaksi</h5>
    <button class="close p-3 batal_produk" data-dismiss="modal" aria-label="Close" id_produk="<?= $pro['id'] ?>">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-0">
    <input type="hidden" value="<?= $pro['id'] ?>" id="id_produk_t">
    <input type="hidden" value="<?= $pro['discount'] ?>" name="diskon" id="diskon">
    <input type="hidden" value="<?= $aksi_tambah ?>" class="aksi_tambah_<?= $pro['id'] ?>">
    <div class="row">
        <div class="col-md-12">
            <article class="article mb-0">
            <div class="article-header">
                <?php
                    if ($pro['image'] == null) {
                        $bg = base_url()."assets/template/img/news/img04.jpg";
                    } else {
                        // $bg = "https://mitrabagja.com/upload/produk/".$pro['image'];
                        // $bg = "https://mitrabagja.com/upload/produk/".$pro['image'];
                        $bg = base_url()."upload/".$pro['image'];
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
                        <h5 class="h_produk"><?= number_format($pro['harga'] - $pro['discount'],0,'.','.') ?></h5>
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
                    <span class="text-danger mr-3 note">Harap pilih ukuran!</span>
                </div>
            </div>
        </section> 
    <?php endif; ?>
    
    <div class="row mb-2 mr-2">

    <?php foreach ($ukuran as $u): ?>
        <div class="col-md-6">
            <div class="custom-switches-stacked">
                <label class="custom-switch">
                    <input type="radio" name="ukuran" value="1" class="custom-switch-input ukuran" id_produk="<?= $u['id_produk'] ?>" id_ukuran="<?= $u['id'] ?>" harga="<?= $u['harga'] ?>">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description"><?= $u['ukuran'] ?></span>
                </label>
            </div>
        </div>
        <div class="col-md-6 text-right hrg t_harga<?= $u['id'] ?>" id_ukuran="<?= $u['id'] ?>">
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
                <input class="form-check-input topping" name="topping" type="checkbox" id="topping_<?= $t['id'] ?>" harga="<?= $t['harga'] ?>" id_topping="<?= $t['id'] ?>">
                <label class="form-check-label" for="topping_<?= $t['id'] ?>">
                    <span class="nm_topping lb_topping<?= $t['id'] ?>"><?= $t['topping'] ?></span>
                </label>
            </div>

        </div>
        <div class="col-md-6 text-right hrg_tp tp_harga<?= $t['id'] ?>" id_ukuran="<?= $t['id'] ?>">
            +<?= number_format($t['harga'],0,'.','.') ?>
        </div>
    <?php endforeach; ?>
        
    </div>

    <?php 
    
        if (!empty($ukuran)) {
            if (empty($topping)) {
                if (!empty($ukuran)) {
                    $dis = "disabled";
                    $bt  = "btn-secondary";
                } else {
                    $dis = "";
                    $bt  = "btn-success";
                }
            } else {
                $dis = "disabled";
                $bt  = "btn-secondary";
            }
        } else {
            $dis = "";
            $bt  = "btn-success";
        }
    
    ?>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="input-counter input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="btn-subtract btn btn-warning btn-spin" <?= $dis ?> aksi="kurang">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control counter text-center angka_qty" data-default="1" data-min="1">
                        <div class="input-group-append">
                            <button type="button" class="btn-add btn btn-warning btn-spin" <?= $dis ?> aksi="tambah">
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
    
    <button type="button" class="btn btn-warning btn-lg mr-2 batal_produk" id="batal_produk" data-dismiss="modal" id_produk="<?= $pro['id'] ?>"><i class='fas fa-times mr-2'></i>Batal</button>
    <button type="button" class="btn <?= $bt ?> btn-lg" id="simpan_produk" <?= $dis ?>>
        <span id="t_simpan"><i class='fas fa-check mr-2'></i>Simpan - Rp. <?= number_format($pro['harga'] - $pro['discount'],0,'.','.') ?></span>
        <input type="hidden" name="in_tot" id="in_tot" value="<?= $pro['harga'] - $pro['discount'] ?>">
    </button>

</div>

<script>
    $(document).ready(function () {
        var options = {
            selectors: {
                addButtonSelector		: '.btn-add',
                subtractButtonSelector	: '.btn-subtract',
                inputSelector			: '.counter',
            },
            settings: {
                checkValue: true,
                isReadOnly: true,
            },
        };

        $(".input-counter").inputCounter(options);

        // 27-08-2020
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.ukuran').on('change', function () {

            var isi         = $(this).val();
            var id_produk   = $(this).attr('id_produk');
            var id_ukuran   = $(this).attr('id_ukuran');
            var harga_u     = $(this).attr('harga');
            var hg          = $('.h_produk').text().replace("Rp. ","").replace(".","");
            var angka       = $('.angka_qty').val();

            var th = 0;
            $('.topping').each(function () {
                var isi_t   = $(this).is(':checked');
                var harga   = $(this).attr('harga');

                if (isi_t == true) {
                    th = parseInt(th) + parseInt(harga);
                }
            })

            var tot = (parseInt(hg)+parseInt(harga_u)+parseInt(th));

            $('.btn-add').removeAttr('disabled');
            $('.btn-subtract').removeAttr('disabled');
            $('#simpan_produk').removeAttr('disabled');
            $('.note').text('');

            $('.hrg').each(function () {

                $(".hrg").removeClass("font-weight-bold");
                $(".t_harga"+id_ukuran).addClass("font-weight-bold");

            })

            $('#simpan_produk').removeClass('btn-secondary').addClass('btn-success');

            $('#t_simpan').html("<i class='fas fa-check mr-2'></i>Simpan - Rp."+separator(tot*angka)).fadeOut('fast').fadeIn();

            $('#in_tot').val(tot*angka);

        })

        $('.btn-spin').on('click', function () {
            
            var hg      = $('.h_produk').text().replace("Rp. ","").replace(".","");
            var angka   = $('.angka_qty').val();
            var isi     = $("input[name='ukuran']:checked").attr('harga');

            var th = 0;
            $('.topping').each(function () {
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

            $('#t_simpan').html("<i class='fas fa-check mr-2'></i>Simpan - Rp."+separator(tot * angka)).fadeOut('fast').fadeIn();

            $('#in_tot').val(tot*angka);

        })

        // 28-08-2020

        $('.topping').on('change', function () {
            var isi         = $(this).is(':checked');
            var id_topping  = $(this).attr('id_topping');

            var hg      = $('.h_produk').text().replace("Rp. ","").replace(".","");
            var angka   = $('.angka_qty').val();
            
            if (isi == true) {
                $('.lb_topping'+id_topping).addClass('font-weight-bold');
                $('.tp_harga'+id_topping).addClass('font-weight-bold');
            } 
            
            if (isi == false) {
                $('.lb_topping'+id_topping).removeClass('font-weight-bold');
                $('.tp_harga'+id_topping).removeClass('font-weight-bold');
            }

            var th = 0;
            $('.topping').each(function () {

                var isi2         = $(this).is(':checked');
                var harga       = $(this).attr('harga');
                var id_tpg      = $(this).attr('id_topping');

                if (isi2 == true) {
                    th = parseInt(th) + parseInt(harga);
                } 
                
            })

            var isi3     = $("input[name='ukuran']:checked").attr('harga');

            if (isi3 == undefined) {
                isi_i = 0;
            } else {
                isi_i = isi3;
            }

            var tot = (parseInt(hg) + parseInt(th) + parseInt(isi_i)) * angka;

            $('#t_simpan').html("<i class='fas fa-check mr-2'></i>Simpan - Rp."+separator(tot)).fadeOut('fast').fadeIn();

            $('#in_tot').val(tot);

        })

        // aksi batal produk
        $('.batal_produk').on('click', function () {
            var id          = $(this).attr('id_produk');
            var aksi_tambah = $('.aksi_tambah_'+id).val();

            if (aksi_tambah == 'pertama') {
                $('#modal_topping').modal('hide');
                $('#check_pro_'+id).prop('checked', false); 
            } else {
                $('#modal_topping').modal('hide');
                $('#modal_list_pro').modal('show');
                $('#check_pro_'+id).prop('checked', true); 
            }

            
        })

        var list_t = [];

        // aksi simpan produk
        $('#simpan_produk').on('click', function () {
            var tot             = $('#in_tot').val();
            var qty             = $('.angka_qty').val();
            var harga_ukuran    = $("input[name='ukuran']:checked").attr('harga');
            var id_ukuran       = $("input[name='ukuran']:checked").attr('id_ukuran');
            var id_produk       = $("#id_produk_t").val();
            var diskon          = $('#diskon').val();
            var aksi_tambah     = $('.aksi_tambah_'+id_produk).val();
            
            var id_tp = [];
            $('input[name=topping]:checked').each(function () {
                var a = $(this).attr('id_topping');

                id_tp.push(a);
            });

            // console.log(aksi_tambah);

            $(this).addClass('btn-progress disabled');

            // var df = [tot];

            // list_t.push(tot);

            // console.log(list_t);
            
            $.ajax({
                url     : "<?= base_url() ?>Transaksi/simpan_list_transaksi",
                type    : "POST",
                data    : {total:tot, qty:qty, harga_ukuran:harga_ukuran, id_ukuran:id_ukuran, id_produk:id_produk, id_topping:id_tp, diskon:(diskon * qty)},
                dataType: "JSON",
                success : function (data) {

                    // console.log(id_produk);

                    // list_t.push(data.list);

                    // console.log(list_t);

                    $(this).removeClass('btn-progress disabled');

                    // $('#check_pro_'+id_produk).prop('checked', true);

                    // $('#t_qty_'+id_produk).text(data.qty+'x');
                    // $('#t_qty_'+id_produk).attr('hidden', false);

                    // $('#btn_checkout').removeAttr('disabled');
                    // $('.angka_badge').text(data.tot_qty);  

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

                    $('#btn_checkout').removeAttr('disabled');
                    $('.angka_badge').text(data.tot_qty); 

                    if (aksi_tambah == 'pertama') {

                        $('#modal_toping').modal('hide');

                    } else if (aksi_tambah == 'kedua') {

                        $('#modal_toping').modal('hide');

                        $('.f_list_pro').html('');

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
                                
                                $('.f_list_pro').html(data);
                                $('#modal_list_pro').modal('show');

                                $.ajax({
                                    url     : "<?= base_url() ?>Transaksi/ambil_kondisi_produk",
                                    method  : "POST",
                                    data    : {id_produk:id_produk},
                                    dataType: "JSON",
                                    success : function (data) {
                                        
                                        if (data.jumlah_pro == 0) {
                                            $('#modal_list_pro').modal('hide');
                                            $('.aksi_tambah_'+id_produk).val('pertama');
                                        } else {
                                            $('#modal_list_pro').modal('show');
                                            $('.aksi_tambah_'+id_produk).val('kedua');
                                        }
                                        
                                        $('#modal_transaksi_kedua').modal('hide');

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

                                        $('.angka_badge').text(data.tot_qty);  

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