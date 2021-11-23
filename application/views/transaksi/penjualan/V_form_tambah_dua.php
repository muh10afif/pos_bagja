<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Transaksi Penjualan</h5>
    <button class="close p-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row"> 
        <!-- style="height: 270px; overflow-y: scroll;" -->
        <div class="col-md-12">
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
                                                <button class="btn btn-success btn-sm mr-2 edit_pro" key="<?= $key ?>" id_produk="<?= $s['id_produk'] ?>">
                                                    <i class="fa fa-pencil-alt fa-md mr-2"></i>Edit
                                                </button>
                                                <button class="btn btn-danger btn-sm hapus_pro" key="<?= $key ?>" id_produk="<?= $s['id_produk'] ?>">
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
    </div>
</div>
<div class="modal-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 d-flex justify-content-center offset-md-2">
                <button type="button" class="btn btn-warning btn-lg mr-2 tambah_varian_lain" data-id="<?= $id_produk ?>"><i class='fa fa-plus-circle fa-lg mr-2'></i>Tambah Varian Produk Lain</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        // 01-09-2020

        // aksi tambah varian lain
        $('.tambah_varian_lain').on('click', function () {

            var id_produk = $(this).data('id');
            
            $('#modal_list_pro').modal('hide');
            $('#modal_toping').modal('show');

            $('.f_transaksi').html('');
            
            $.ajax({
                url     : "<?= base_url() ?>Transaksi/ambil_data_produk/kedua/"+id_produk,
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

                    $('.aksi_tambah_'+id_produk).val('kedua');

                    $('#modal_toping').modal('show');

                    $('.f_transaksi').html(data);
                    
                }
            })

        })

        // edit produk
        $('.edit_pro').on('click', function () {

            var key         = $(this).attr('key');
            var id_produk   = $(this).attr('id_produk');
            
            $('#modal_list_pro').modal('hide');
            $('#modal_transaksi_kedua').modal('show');

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
                data        : {key:key, id_produk:id_produk, status_edit:'list', aksi_tambah:'kedua'},
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

        // hapus produk
        $('.hapus_pro').on('click', function () {

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
                        url         : "<?= base_url() ?>Transaksi/hapus_list_transaksi",
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

                                // swal({
                                //     title               : 'Hapus produk',
                                //     text                : 'Data Berhasil Dihapus',
                                //     buttonsStyling      : false,
                                //     confirmButtonClass  : "btn btn-success",
                                //     type                : 'success',
                                //     showConfirmButton   : false,
                                //     timer               : 1000
                                // }); 

                                $.ajax({
                                    url     : "<?= base_url() ?>Transaksi/ambil_kondisi_produk",
                                    method  : "POST",
                                    data    : {id_produk:id_produk},
                                    dataType: "JSON",
                                    success : function (data) {
                                        
                                        if (data.jumlah_pro == 0) {
                                            $('#modal_list_pro').modal('hide');
                                            $('.aksi_tambah').val('pertama');
                                        } else {
                                            $('#modal_list_pro').modal('show');
                                            $('.f_list_pro').html(data2);
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

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus produk',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })
        })

    })
</script>