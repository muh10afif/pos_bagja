<style>
    .selectgroup-input:checked + .selectgroup-button {
        background-color: orange;
        color: #fff;
        z-index: 1;
    }

</style>
<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Transaksi Penjualan</h5>
    <button class="close p-3 batal_produk" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-7" style="height: 500px; overflow-y: scroll;">
            <?php foreach ($list as $key => $s): 
                
                // produk
                $pro = $this->transaksi->cari_data('mst_produk', ['id' => $s['id_produk']])->row_array();

                // kategori
                $kat = $this->transaksi->cari_data('mst_kategori', ['id' => $pro['id_kategori']])->row_array();

                // ukuran
                $ukr = $this->transaksi->cari_data('mst_ukuran', ['id' => $s['id_ukuran']])->row_array();

                if ($pro['image'] == null) {
                    $bg = base_url()."assets/template/img/news/img04.jpg";
                } else {
                    // $bg = "https://mitrabagja.com/upload/produk/".$pro['image'];
                    $bg = "https://mitrabagja.com/upload/produk/".$pro['image'];
                }
                
            ?>
            
            <div class="card shadow">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <article class="article">
                            <div class="article-header">
                                <div class="article-image" style="background-image: url('<?= $bg ?>')"></div>
                            </div>
                            <div class="article-details p-0">
                                <div class="row d-flex justify-content-center" style=" margin-top: 0px;">
                                    <div class="col-md-12 mt-2" style="margin-bottom: -20px;">
                                        <div class="row p-2">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-success btn-sm mr-2 edit_pro2" key="<?= $key + 1 ?>" id_produk="<?= $s['id_produk'] ?>">
                                                    <i class="fa fa-pencil-alt fa-md mr-2"></i>Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm hapus_pro2" key="<?= $key + 1 ?>" id_produk="<?= $s['id_produk'] ?>">
                                                <i class="fa fa-trash fa-md mr-2"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                            <h5 class="card-title"><?= $pro['nama'] ?></h5>
                            </div>
                            <div class="col-md-4 text-right">
                                <code><h5 class="text-success"><?= $s['qty'] ?>x</h5></code>
                            </div>
                        </div>

                        <?php 
                                        
                            if ($pro['discount'] == 0) {
                                $a = "";
                            } else {
                                $a = "<small class='text-muted'><del>".number_format(($s['total'] + $s['diskon']),0,'.','.')."</del></small>";
                            }

                        ?>
                        
                        <h6><mark><?= number_format($s['total'],0,'.','.') ?></mark><?= nbs() ?>
                        <?= $a ?></h6> 

                        <?php if ($s['id_ukuran'] != null): ?>

                        <section class="section">
                            <div class="section-body mt-2">
                                <div class="section-title mt-0">Ukuran <?= $ukr['ukuran'] ?></div>
                            </div>
                        </section>

                        <?php endif ?>
                        
                        <?php if ($s['id_topping'] != null): ?>

                        <section class="section">
                            <div class="section-body mt-2">
                                <div class="section-title mt-0">Topping </div>
                                
                            </div>
                        </section>
                        <style>
                            li {
                                display: block;
                                float: left;
                                padding: 5px;
                            }
                        </style>
                        <ul class="ml-1" style="margin-top: -10px;">
                            <?php foreach ($s['id_topping'] as $tp):
                                $nm_t = $this->transaksi->cari_data('mst_topping', ['id' => $tp])->row_array();    
                            ?>
                                <li><span class="fa fa-dot-circle fa-xs mr-2"></span><?= $nm_t['topping'] ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <?php endif; ?>

                    </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
        <div class="col-md-5">
            <div class="form-group p-2 row">
                <label for="atas_nama" class="col-sm-4 col-form-label">Atas Nama</label>
                <div class="col-sm-8">
                    <div class="input-group mb-3 f_atas_nama">
                        <select name="atas_nama" id="atas_nama" class="form-control">
                            <option value="" disabled selected>-- Pilih Atas Nama --</option>
                            <?php foreach ($atas_nama as $a): ?>
                                <option value="<?= $a['id'] ?>" telp="<?= $a['telp'] ?>" tot_piutang="<?= $a['tot_piutang'] ?>"><?= ucwords($a['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="top" title="Tambah Pelanggan" id="tambah_an"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="input-group mb-2 ft_atas_nama" hidden>
                        <input type="text" name="t_atas_nama" id="t_atas_nama" class="form-control" placeholder="Masukkan Atas Nama">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="top" title="Batal Tambah" id="batal_tambah"><i class="fa fa-undo-alt"></i></button>
                        </div>
                    </div>
                    <span class="text-danger" id="nama_error" hidden>Harap isi atas nama pelanggan!</span>
                    <input type="hidden" id="status_atas_nama" value="lama">
                </div>
                <label for="atas_nama" class="col-sm-4 col-form-label">Telepon</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                        </div>
                        <input type="text" class="form-control numeric" id="telp_an" placeholder="Masukkan Telepon" readonly>
                    </div>
                    <span class="text-danger" id="telp_error" hidden>Harap isi nomor telepon!</span>
                </div>
            </div>

            <div class="progress mb-3 mt-3" data-height="5" style="height: 5px;">
                <div class="progress-bar bg-warning" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>

            <div class="form-group p-2 row">
                <label for="atas_nama" class="col-sm-4 col-form-label mt-3 mb-3">Total Diskon</label>
                <div class="col-sm-8">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                        </div>
                        <input type="text" class="form-control text-right" value="<?= number_format($tot_diskon,0,'.','.') ?>" readonly>
                    </div>
                </div>
                <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Diskon</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="selectgroup w-100" style="height: 95%;">
                                <label class="selectgroup-item">
                                <input type="radio" name="s_discount" value="rp" class="selectgroup-input" checked="">
                                <span class="selectgroup-button p-1" id="s_rp" style="font-size: 15px; font-weight: bold; height:100%" >Rp. </span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="s_discount" value="persen" class="selectgroup-input">
                                    <span class="selectgroup-button p-1" id="s_persen" style="font-size: 15px; font-weight: bold; height:100%">%</span>
                                </label>
                            </div>
                        </div>
                        <input type="text" name="discount" id="discount" judul="discount" class="form-control text-right numeric number_separator" placeholder="0" autocomplete="off">
                    </div>
                    <input type="hidden" id="nilai_diskon" class="form-control">
                    <input type="hidden" id="jenis" class="form-control" value="rp">
                </div>
                <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Total Belanja</label>
                <div class="col-sm-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                        </div>
                        <input type="hidden" class="form-control text-right" id="total_belanja2" value="<?= $tot_belanja ?>">
                        <input type="text" class="form-control text-right" id="total_belanja" value="<?= number_format($tot_belanja,0,'.','.') ?>" readonly>
                    </div>
                </div>
                <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Total Bayar</label>
                <div class="col-sm-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                        </div>
                        <input type="text" class="form-control text-right number_separator numeric" id="tunai" placeholder="0" autocomplete="off">
                    </div>
                </div>
                <label for="atas_nama" class="col-sm-4 col-form-label mb-3">Kembalian</label>
                <div class="col-sm-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                        </div>
                        <input type="text" class="form-control text-right" id="kembali" value="0" readonly>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="modal-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 d-flex justify-content-center">
                <button type="button" class="btn btn-warning btn-lg mr-2" data-dismiss="modal"><i class='fa fa-plus-circle mr-2'></i>Tambah Produk</button>
            </div>
            <div class="col-md-5 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary btn-lg mr-3" id="piutang" disabled><i class='fas fa-book-reader mr-2'></i>Piutang</button>
                <button type="button" class="btn btn-secondary btn-lg" id="simpan_transaksi" disabled><i class='fas fa-check mr-2'></i>Bayar
                </button>
            </div>
        </div>
    </div>
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

        // 29-08-2020
        $('#atas_nama').on('change', function () {

            var isi     = $(this).find('option:selected').attr('telp');
            var tunai   = $('#tunai').val();
            var kembali = $('#kembali').val().replace('.','');

            $('#telp_an').val(isi).fadeOut('fast').fadeIn();

            if (tunai != 0) {
                if (kembali < 0) {
                    $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                    $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                } else {
                    $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                    $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                }
            } else {
                $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
            }
            

        })

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.numeric').numericOnly();

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 29-11-2020
        $('input[name=s_discount]').on('click', function () {

            var isi         = $(this).val();
            var total_bel2   = $('#total_belanja2').val();
            var total_bel   = $('#total_belanja').val().split('.').join('');
            var tunai       = $('#tunai').val().split('.').join('');

            $('#discount').val('0');
            $('#nilai_diskon').val('0');
            $('#jenis').val(isi);

            $('#total_belanja').val(separator(total_bel2));

            var kembali = parseInt((tunai == '' ? 0 : tunai)) - parseInt(total_bel2);
            $('#kembali').val(separator(kembali));
        })

        // 29-11-2020
        $('#discount').on('keyup', function () {

            var jenis       = $('#jenis').val();
            var value       = $('#discount').val().split('.').join('');
            var total_bel   = $('#total_belanja').val().split('.').join('');
            var total_bel2  = $('#total_belanja2').val();
            var tunai       = $('#tunai').val().split('.').join('');
            var isi         = $('#discount').val().split('.').join('');
            
            var rp_diskon = 0;

            if (jenis == 'persen') {
                $('#discount').val(Math.max(Math.min(value, 100), -100));  

                if (value > 100) {
                    rp_diskon = total_bel2;
                } else {
                    rp_diskon = (value * total_bel2) / 100; 
                }
            } else {

                $('#discount').val(Math.max(Math.min(value, total_bel2), -total_bel2));  

                if (parseInt(value) > parseInt(total_bel)) {
                    rp_diskon = total_bel2;
                } else {
                    rp_diskon = value;
                }
            }

            var tot     = parseInt(total_bel2) - parseInt(rp_diskon);

            if ($('#discount').val().split('.').join('') == 0) {
                tot = total_bel2;
            } else {
                tot = tot;
            }

            console.log($('#discount').val())

            $('#nilai_diskon').val(rp_diskon);
            $('#total_belanja').val(separator(tot));

            var kembali = parseInt((tunai == '' ? 0 : tunai)) - tot;
            $('#kembali').val(separator(kembali));
        })

        $('#tunai').on('keyup', function () {
            var isi              = $(this).val().replace('.','');
            var tot_belanja      = $('#total_belanja').val().replace('.','');
            var atas_nama        = $('#atas_nama').find('option:selected').val();
            var status_atas_nama = $('#status_atas_nama').val();
            var t_atas_nama      = $('#t_atas_nama').val();
            var telp_an          = $('#telp_an').val();

            $('#kembali').val(separator(isi - tot_belanja)).fadeOut(50).fadeIn(50);

            var kembali     = $('#kembali').val().replace('.','');

            if (isi != 0) {

                // cek atas nama baru atau lama
                if (status_atas_nama == 'lama') {
                    // if (atas_nama != "") {
                    //     if (kembali < 0) {
                    //         $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                    //         $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                    //     } else {
                    //         $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                    //         $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    //     }
                    // } else {
                    //     $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                    //     $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    // }
                    if (kembali < 0) {
                        $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                        $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                    } else {
                        $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                        $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    }
                } else {
                    if ((t_atas_nama && telp_an) != '') {
                        if (kembali < 0) {
                            $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                            $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                        } else {
                            $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                            $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                        }
                    } else {
                        $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                        $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    }
                }

                
            } else {
                $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                if (atas_nama != "") {
                    $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                } else {
                    $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                }
            }
            
        })

        $('#simpan_transaksi').on('click', function () {

            var atas_nama        = $("#atas_nama").find('option:selected').val();
            var t_atas_nama      = $('#t_atas_nama').val();
            var telp_an          = $('#telp_an').val();
            var status_atas_nama = $('#status_atas_nama').val();
            var tunai            = $('#tunai').val();
            var diskon_tr        = $('#nilai_diskon').val();
            var total_belanja    = $('#total_belanja').val().split('.').join('');
            var id_umkm          = $('#id_umkm').val();

            $(this).addClass('btn-progress disabled');
            
            $.ajax({
                url      : "<?= base_url() ?>Transaksi/simpan_transaksi/"+id_umkm,
                type     : "POST",
                data     : {atas_nama:atas_nama, status_atas_nama:status_atas_nama, t_atas_nama:t_atas_nama, telp_an:telp_an, tunai:tunai, diskon_tr:diskon_tr, total_belanja:total_belanja},
                dataType : "JSON",
                success  : function (data) {

                    $(this).removeClass('btn-progress disabled');

                    // swal({
                    //     title               : "Berhasil",
                    //     text                : 'Data berhasil disimpan',
                    //     buttonsStyling      : false,
                    //     confirmButtonClass  : "btn btn-success",
                    //     type                : 'success',
                    //     showConfirmButton   : false,
                    //     timer               : 1000
                    // });  
                    
                    // location.reload();

                    var id_tr = data.id_transaksi;

                    $('#modal_checkout').modal('hide');

                    $('.f_detail_transaksi').html('');
                    
                    // isi modal detail transaksi
                    $.ajax({
                        url         : "<?= base_url() ?>Transaksi/tampilan_detail_transaksi",
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
                        data        : {id_tr:id_tr, aksi:'reload'},
                        success     : function (data2) {

                            swal.close();
                            
                            $('.f_detail_transaksi').html(data2);
                            $('#modal_detail_transaksi').modal('show');

                        }
                    })

                }
            })

            return false;

            // $('#modal_checkout').modal('hide');

            // $('.f_detail_transaksi').html('');
            
            // // isi modal detail transaksi
            // $.ajax({
            //     url         : "tampilan_detail_transaksi",
            //     method      : "POST",
            //     beforeSend  : function () {
            //         swal({
            //             title   : 'Menunggu',
            //             html    : 'Memproses Data',
            //             onOpen  : () => {
            //                 swal.showLoading();
            //             }
            //         })
            //     },
            //     data        : {id_tr:58},
            //     success     : function (data2) {

            //         swal.close();
                    
            //         $('.f_detail_transaksi').html(data2);
            //         $('#modal_detail_transaksi').modal('show');

            //     }
            // })

        })

        // 30-08-2020
        $('#tambah_an').on('click', function () {
            $('.f_atas_nama').attr('hidden', true);
            $('.ft_atas_nama').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#telp_an').attr('readonly', false);
            $('#telp_an').val(null);
            $('#status_atas_nama').val('baru');

            var t_atas_nama = $('#t_atas_nama').val();
            var telp_an     = $('#telp_an').val();
            var tunai       = $('#tunai').val().replace('.','');
            var kembali     = $('#kembali').val().replace('.','');

            if (t_atas_nama != '') {
                $('#nama_error').attr('hidden', true);
            } else {
                $('#nama_error').attr('hidden', false);
            }

            if (telp_an != '') {
                $('#telp_error').attr('hidden', true);
            } else {
                $('#telp_error').attr('hidden', false);
            }

            if ((t_atas_nama && telp_an) != '') {
                if (kembali < 0 || tunai == 0) {
                    $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                    $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                } else {
                    $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                    $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                }
            } else {
                $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
            }
            
        })

        $('#batal_tambah').on('click', function () {
            $('.f_atas_nama').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.ft_atas_nama').attr('hidden', true);
            $('#telp_an').attr('readonly', true);
            $('#atas_nama').val('');
            $('#status_atas_nama').val('lama');
            $('#nama_error').attr('hidden', true);
            $('#telp_error').attr('hidden', true);
            $('#telp_an').val(null);

            $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);

            var atas_nama        = $('#atas_nama').find('option:selected').val();

            // if (atas_nama != '') {
            //     if (kembali < 0) {
            //         $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
            //         $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
            //     } else {
            //         $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
            //         $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
            //     }
            // } else {
            //     $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
            //     $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
            // }

            if (kembali < 0) {
                $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
            } else {
                $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
            }

        })

        $('#t_atas_nama').on('keyup', function () {
            
            var isi         = $(this).val();
            var t_atas_nama = $('#t_atas_nama').val();
            var telp_an     = $('#telp_an').val();
            var tunai       = $('#tunai').val().replace('.','');
            var kembali     = $('#kembali').val().replace('.','');

            if (isi != '') {
                $('#nama_error').attr('hidden', true);
            } else {
                $('#nama_error').attr('hidden', false);
            }

            if ((t_atas_nama && telp_an) != '') {
                $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
            }

            if (isi == '') {
                $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
            } else {
                if ((t_atas_nama && telp_an) != '') {
                    if (kembali < 0 || tunai == 0) {
                        $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                        $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                    } else {
                        $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                        $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    }
                } else {
                    $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                }
            }

        })

        $('#telp_an').on('keyup', function () {
            
            var isi         = $(this).val();
            var t_atas_nama = $('#t_atas_nama').val();
            var telp_an     = $('#telp_an').val();
            var tunai       = $('#tunai').val().replace('.','');
            var kembali     = $('#kembali').val().replace('.','');

            if (isi != '') {
                $('#telp_error').attr('hidden', true);
            } else {
                $('#telp_error').attr('hidden', false);
            }
            
            if ((t_atas_nama && telp_an) != '') {
                $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
            }

            if (isi == '') {
                $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
            } else {
                if ((t_atas_nama && telp_an) != '') {
                    if (kembali < 0 || tunai == 0) {
                        $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                        $('#piutang').removeClass('btn-secondary').addClass('btn-warning').attr('disabled', false);
                    } else {
                        $('#simpan_transaksi').removeClass('btn-secondary').addClass('btn-success').attr('disabled', false);
                        $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    }
                } else {
                    $('#piutang').removeClass('btn-warning').addClass('btn-secondary').attr('disabled', true);
                    $('#simpan_transaksi').removeClass('btn-success').addClass('btn-secondary').attr('disabled', true);
                }
            }
        })

        // piutang
        $('#piutang').on('click', function () {
            var total_belanja   = $('#total_belanja').val().replace('.','');
            var tunai           = $('#tunai').val().replace('.','');
            var t_atas_nama     = $('#t_atas_nama').val();
            var t_telp_an       = $('#telp_an').val();
            var status_ats_nama = $('#status_atas_nama').val();
            var atas_nama       = $("#atas_nama").find('option:selected').text();
            var id_pelanggan    = $("#atas_nama").find('option:selected').val();
            var piutang_sbl     = $("#atas_nama").find('option:selected').attr('tot_piutang');

            var nm_atas_nama    = '';
            var t_piutang_sbl   = 0;

            if (status_ats_nama == 'baru') {
                nm_atas_nama = t_atas_nama;
                t_piutang_sbl = 0;
            } else {
                nm_atas_nama = atas_nama;
                t_piutang_sbl = piutang_sbl;
            }

            console.log(nm_atas_nama);
            console.log(t_telp_an);

            if (nm_atas_nama == '-- Pilih Atas Nama --') {

                swal({
                    title               : 'Peringatan',
                    text                : 'Atas nama harus terisi',
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    type                : 'error',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

            } else {

                var nom_piutang = total_belanja - tunai;
                var tot_piutang = parseInt(nom_piutang) + parseInt(t_piutang_sbl);

                $('#p_total_belanja').val(separator(total_belanja));
                $('#p_tunai').val(separator(tunai));
                $('#p_atas_anam').text(": "+nm_atas_nama);
                $('#p_telepon').text(": "+t_telp_an)
                $('.p_atas_anam').val(nm_atas_nama);
                $('.p_telepon').val(t_telp_an)
                $('#p_nominal_piutang').val(separator(nom_piutang));
                $('#p_piutang_sbl').val(separator(t_piutang_sbl));
                $('#tot_piutang').val(separator(tot_piutang));
                $('#status_ats_nama').val(status_ats_nama);
                $('#id_pelanggan').val(id_pelanggan);

                $('#modal_checkout').modal('hide');
                $('#modal_piutang').modal('show');

            }
            
            
        })

        // 02-09-2020
        // hapus produk
        $('.hapus_pro2').on('click', function () {

            var key         = $(this).attr('key');
            var id_produk   = $(this).attr('id_produk');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus produk ini?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>Transaksi/hapus_produk",
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

                                        // swal({
                                        //     title               : 'Hapus produk',
                                        //     text                : 'Data Berhasil Dihapus',
                                        //     buttonsStyling      : false,
                                        //     confirmButtonClass  : "btn btn-success",
                                        //     type                : 'success',
                                        //     showConfirmButton   : false,
                                        //     timer               : 1000
                                        // }); 

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

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    // swal({
                    //         title               : 'Batal',
                    //         text                : 'Anda membatalkan hapus produk',
                    //         buttonsStyling      : false,
                    //         confirmButtonClass  : "btn btn-primary",
                    //         type                : 'error',
                    //         showConfirmButton   : false,
                    //         timer               : 1000
                    //     }); 
                }
            })
        })

        // edit produk
        $('.edit_pro2').on('click', function () {

            var key         = $(this).attr('key');
            var id_produk   = $(this).attr('id_produk');

            $('#modal_checkout').modal('hide');
            $('#modal_transaksi_kedua').modal('show');

            console.log(key);

            $('.f_transaksi_kedua').html('');

            $.ajax({
                url         : "<?= base_url() ?>Transaksi/ambil_halaman_topping",
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
                data        : {key:key, id_produk:id_produk, status_edit:'checkout', aksi_tambah:'ketiga'},
                success     : function (data) {

                    swal.close();

                    $('.f_transaksi_kedua').html(data);
                    
                },
                error       : function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }

            })
        })

    })
</script>