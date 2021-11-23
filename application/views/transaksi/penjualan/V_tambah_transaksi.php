<style>
    .modal {
        overflow-y:auto;
    }
</style>
<style>
    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: orange;
        border-color: orange orange orange;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid orange;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: orange;
    }
    .nav-tabs {
        border-bottom: 3px solid orange;
    }
    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: orange;
        background-color: orange;
    }
    .tab-pane.active {
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .selectgroup-input:checked + .selectgroup-button {
        background-color: orange;
        color: #fff;
        z-index: 1;
    }
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <?php if ($user == 'Bagja'): ?>
                <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Tambah Transaksi | <?= ucwords($nama_umkm) ?></h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="<?= base_url('Transaksi/penjualan') ?>">List UMKM</a></div>
                    <div class="breadcrumb-item"><a href="<?= base_url("Transaksi/detail_umkm/$id_umkm") ?>">Transaksi</a></div>
                    <div class="breadcrumb-item active">Tambah Transaksi</div>
                </div>
            <?php else: ?>
                <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Tambah Transaksi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="<?= base_url('Transaksi/penjualan') ?>"><?= $title ?></a></div>
                    <div class="breadcrumb-item active">Tambah Transaksi</div>
                </div>
            <?php endif; ?>
            
        </div>

        <div class="section-body">
            <input type="hidden" name="id_umkm" id="id_umkm" value="<?= $id_umkm ?>">
            <div class="row mb-3">
                <div class="col-md-6 offset-md-6"></div>
                <div class="col-md-6 text-right">
                    <input type="text" class="form-control shadow search" placeholder="cari...">
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-warning btn-icon icon-left btn-lg shadow" id="btn_checkout" <?= ($qty != 0) ? '' : 'disabled' ?>>
                        <i class="fa fa-shopping-bag fa-2x mr-2"></i> 
                        <span style="font-size: 15px;">Checkout</span> <span class="badge badge-success angka_badge" style="font-size: 23px;"><?= $qty ?></span>
                    </button>  
                </div>
                
            </div>

            <div class="row">

            <div class="col-md-12 mt-2 mb-2">
                <ul class="nav nav-tabs d-flex justify-content-center" id="myTab3" role="tablist">
                    
                    <?php $ck=0; foreach ($kategori as $ks): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($ck == 0) ? 'active' : '' ?> font-weight-bold" id="<?= $ks['id']."-tab2" ?>" data-toggle="tab" href="#aa<?= $ks['id'] ?>_t" role="tab" aria-controls="<?= $ks['id'] ?>_tt" aria-selected="<?= ($ck == 0) ? 'true' : 'false' ?>" style="font-size: 18px;"><?= ucwords($ks['kategori']) ?> <code><mark class="font-weight-bold" id="qty_kat_<?= $ks['id'] ?>" style="font-size: 18px; border-radius: 10px;" hidden>15</mark></code></a>
                        </li>
                    <?php $ck++; endforeach; ?>

                </ul>
                <div class="tab-content" id="myTab4Content">
                    <?php $ck2=0; foreach ($kategori as $k): ?>

                        <?php $produk_kat = $this->transaksi->list_produk_kategori($id_umkm, $k['id'])->result_array(); ?>
                        
                        <div class="tab-pane fade <?= ($ck2 == 0) ? 'show active' : '' ?>" id="aa<?= $k['id'] ?>_t" role="tabpanel" aria-labelledby="<?= $k['id']."-tab2" ?>">

                        <div class="row p-3">
                            <?php $i=0; $id_kat = $k['id']; foreach ($produk_kat as $p):  ?>

                                <div class="col-12 col-md-3 col-lg-3" id="menu-<?= $p['id'] ?>">
                                    <label class="imagecheck mb-4" style="width: 100%;">
                                        <input name="imagecheck" type="checkbox" id_kategori="<?= $id_kat ?>" value="1" id="check_pro_<?= $p['id'] ?>" class="imagecheck-input" data="0" nm_produk="<?= $p['nama'] ?>" id_produk="<?= $p['id'] ?>" harga="<?= $p['harga'] ?>" isi_ukuran="<?= $p['h_ukuran'] ?>" isi_topping="<?= $p['h_topping'] ?>"
                                        
                                        <?php foreach ($id_produk as $k): 
                                            
                                            if ($p['id'] == $k) {
                                                echo $ck = 'checked';
                                            } else {
                                                echo $ck = '';
                                            }
                                            
                                        ?>
                                            
                                        <?php endforeach; ?>
                                        
                                        />
                                        <figure class="imagecheck-figure shadow">
                                            <article class="article article-style-c imagecheck-image mb-0">
                                                <div class="article-header">
                                                    <?php
                                                        if ($p['image'] == null) {
                                                            $bg = base_url()."assets/template/img/news/img04.jpg";
                                                        } else {
                                                            // $bg = base_url()."assets/img/upload/produk/".$p['image'];
                                                            // $bg = "https://mitrabagja.com/upload/produk/".$p['image'];
                                                            // $bg = "https://mitrabagja.com/upload/produk/".$p['image'];
                                                            $bg = base_url()."upload/".$p['image'];
                                                        }
                                                    ?>
                                                    <div class="article-image" data-background="<?= $bg ?>">
                                                    </div>
                                                </div>
                                                <div class="article-details mb-0">
                                                    <div class="article-title text-center">
                                                        <?php 
                                                        
                                                        if ($p['discount'] == 0) {
                                                            $a = "";
                                                        } else {
                                                            $a = "<small class='text-muted'><del>".number_format($p['harga'],0,'.','.')."</del></small>";
                                                        }

                                                        ?>
                                                        
                                                        <h5>
                                                        <?php $tot = 0; foreach ($list as $l): 
                                                            
                                                            if ($p['id'] == $l['id_produk']) {
                                                                $l_id = $l['id_produk'];

                                                                echo $qty = "<code class='text-success t_qty_kat_$id_kat  t_qty_".$l_id."' style='font-size: 20px'>".$l['qty']."x</code>";
                                                            } else {
                                                                $p_id = $p['id'];
                                                                echo $qty = "<code class='text-success t_qty_kat_$id_kat ' id='t_qty_".$p_id."' style='font-size: 20px' hidden>0x</code>";
                                                            }
                                                            
                                                        ?><?php endforeach; ?>
                                                        <span class="nama-product" data-id="<?= $p['id'] ?>"><?= $p['nama'] ?></span></h5>
                                                        <h6><mark><?= number_format($p['harga'] - $p['discount'],0,'.','.') ?></mark><?= nbs() ?>
                                                        <?= $a ?></h6> 
                                                        <h6 class="text-muted mb-3 mt-0"><?= $p['kategori'] ?></h6>

                                                    </div>
                                                </div>
                                            </article>  
                                        </figure>
                                    </label>
                                </div>

                            <?php $i++; endforeach; ?>

                        </div>

                        </div>
                        
                    <?php $ck2++; endforeach; ?>
                </div>

            </div>

            </div>

        </div>

    </section>
</div>

<div id="modal_toping" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content f_transaksi">
            
        </div>
    </div>
</div>

<div id="modal_checkout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content f_checkout">
            
        </div>
    </div>
</div>

<div id="modal_piutang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content f_piutang">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Piutang</h5>
                <button class="close p-3 batal_piutang" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="form_piutang">

                    <input type="hidden" name="status_atas_nama" id="status_ats_nama">
                    <input type="hidden" name="atas_nama" id="id_pelanggan">
                    <input type="hidden" name="aksi" value="piutang">

                    <div class="form-group p-2 row">
                        <label for="atas_nama" class="col-sm-4 col-form-label mt-3 mb-3">Total Belanja</label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control text-right" name="total_belanja" id="p_total_belanja" value="0" readonly>
                            </div>
                        </div>
                        <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Tunai</label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control text-right number_separator numeric" name="tunai" id="p_tunai" value="0" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="progress mb-3 mt-3" data-height="5" style="height: 5px;">
                        <div class="progress-bar bg-warning" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>

                    <div class="form-group p-2 row">
                        <label for="atas_nama" class="col-sm-4 col-form-label mt-3 mb-3">Atas Nama</label>
                        <div class="col-sm-8 mt-3 mb-3">
                            <input type="hidden" name="t_atas_nama" class="p_atas_anam">
                            <span id="p_atas_anam" class="font-weight-bold">: Budi</span>
                        </div>
                        <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Telepon</label>
                        <div class="col-sm-8 mb-3">
                            <input type="hidden" name="telp_an" class="p_telepon">
                            <span id="p_telepon" class="font-weight-bold">: 9808992990</span>
                        </div>

                        <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Nominal Piutang</label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control text-right" name="p_nominal_piutang" id="p_nominal_piutang" value="0" readonly>
                            </div>
                        </div>
                        <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Piutang Sebelumnya</label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control text-right" id="p_piutang_sbl" value="0" readonly>
                            </div>
                        </div>
                        <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Total Piutang</label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control text-right" name="tot_piutang" id="tot_piutang" value="0" readonly>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-2 batal_piutang"><i class='fas fa-times mr-2'></i>Batal</button>
                <button type="button" class="btn btn-success" id="simpan_piutang"><i class='fas fa-check mr-2'></i>Simpan</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_list_pro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content f_list_pro">
            
        </div>
    </div>
</div>

<div id="modal_transaksi_kedua" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content f_transaksi_kedua">
            
        </div>
    </div>
</div>

<div id="modal_edit_topping" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content f_edit_topping">
            
        </div>
    </div>
</div>

<div id="modal_detail_transaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content f_detail_transaksi">
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // 30-08-2020
        // Live Search
        $('.search').keyup(function(event) {
            var filter = $(this).val();
            $('.nama-product').each(function() {
                var id = $(this).data('id');
                if($(this).text().search(new RegExp(filter, 'i')) < 0) {
                $('#menu-'+id).hide();
                }
                else
                {
                    $('#menu-'+id).show();
                }
            });
        });

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.f_transaksi').html('');
        
        $('.imagecheck-input').on('change', function () {

            var isi         = $(this).is(':checked');
            var nama        = $(this).attr('nm_produk');
            var id_produk   = $(this).attr('id_produk');
            var harga       = $(this).attr('harga');
            var isi_ukuran  = $(this).attr('isi_ukuran');
            var isi_topping = $(this).attr('isi_topping');
            var id_kategori = $(this).attr('id_kategori');

            if (isi == true) {
                $(this).attr('data', 1);

                $('#check_pro_'+id_produk).prop('checked', true);

                $('.j_produk').text(nama);
                $('.h_produk').text("Rp. "+separator(harga));
                $('#modal_toping').modal('show');

                $('.f_transaksi').html('');

                $.ajax({
                    url     : "<?= base_url() ?>Transaksi/ambil_data_produk/pertama/"+id_produk,
                    type    : "POST",
                    beforeSend  : function () {
                        swal({
                            title   : 'Loading..',
                            html    : 'Harap tunggu!',
                            onOpen  : () => {
                                swal.showLoading();
                            }
                        })
                    },
                    success : function (data) {

                        swal.close();

                        $('.f_transaksi').html(data);
                        
                    }
                })
                
            } else {
                $(this).attr('data', 0);

                $('#check_pro_'+id_produk).prop('checked', true);

                if ((isi_ukuran == 0 && isi_topping == 0)) {
                    
                    $('#modal_transaksi_kedua').modal('show');

                    $('.f_transaksi_kedua').html('');

                    $.ajax({
                        url     : "<?= base_url() ?>Transaksi/ambil_data_tambah_produk_kedua/"+id_produk+"/bukan",
                        type    : "GET",
                        beforeSend  : function () {
                            swal({
                                title   : 'Loading..',
                                html    : 'Harap tunggu!',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        success : function (data) {

                            swal.close();

                            $('.f_transaksi_kedua').html(data);
                            
                        }
                    })

                } else {

                    $('#modal_list_pro').modal('show');

                    $('.f_list_pro').html('');

                    $.ajax({
                        url     : "<?= base_url() ?>Transaksi/ambil_data_tambah_produk/"+id_produk,
                        type    : "GET",
                        beforeSend  : function () {
                            swal({
                                title   : 'Loading..',
                                html    : 'Harap tunggu!',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        success : function (data) {

                            swal.close();

                            $('.f_list_pro').html(data);
                            
                        }
                    })

                }
                
            }

            // var tot_qty_kat = 0;
            // $('.t_qty_kat_'+id_kategori).each(function(){
            //     var t_qty_kat   = $(this).text().replace('x','');
            //     tot_qty_kat  += parseInt(t_qty_kat);
            // });

            // $('#qty_kat_'+id_kategori).attr('hidden', false);
            // $('#qty_kat_'+id_kategori).text(tot_qty_kat);

        })

        // aksi close modal
        $('#close_produk').on('click', function () {
            var id = $(this).attr('id_produk');

            $('#check_pro_'+id).prop('checked', false);
        })

        // 29-08-2020
        $('#btn_checkout').on('click', function () {
            
            $.ajax({
                url     : "<?= base_url() ?>Transaksi/halaman_checkout/<?= $id_umkm ?>",
                type    : "POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Loading..',
                        html    : 'Harap tunggu!',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                success : function (data) {

                    swal.close();

                    $('.f_checkout').html(data);

                    $('#modal_checkout').modal('show');
                    
                }
            })

            return false;

        })

        // 31-08-2020
        $('.batal_piutang').on('click', function () {
            $('#modal_checkout').modal('show');
            $('#modal_piutang').modal('hide');
        })

        $('#simpan_piutang').on('click', function () {

            var form_piutang = $('#form_piutang').serialize();

            $.ajax({
                url     : "<?= base_url() ?>Transaksi/simpan_transaksi/<?= $id_umkm ?>",
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
                data    : form_piutang,
                dataType: "JSON",
                success : function (data) {

                    swal({
                        title               : "Berhasil",
                        text                : 'Data berhasil disimpan',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-success",
                        type                : 'success',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    $('#modal_piutang').modal('hide');
                    $('#modal_checkout').modal('hide');
                    
                    location.reload();
                    
                }
            })
    
            return false;
        })

    })
</script>