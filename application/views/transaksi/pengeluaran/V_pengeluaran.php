<div class="main-content">
    <section class="section">
        <div class="section-header shadow">

            <?php if ($user == 'Bagja'): ?>
                
                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Transaksi Pengeluaran | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">List Pengeluaran</div>
                    </div>
                <?php else: ?>
                    <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Transaksi Pengeluaran | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="<?= base_url('Transaksi/pengeluaran') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item active">Pengeluaran</div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Transaksi Pengeluaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bagja</div>
                    <div class="breadcrumb-item"><?= $title ?></div>
                    <div class="breadcrumb-item active">Pengeluaran</div>
                </div>  
            <?php endif; ?>

        </div>

        <div class="section-body">
            
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-prepend shadow">
                            <div class="input-group-text">
                            <i class="fas fa-calendar mr-2"></i> Range Periode
                            </div>
                        </div>
                        <input type="text" class="form-control daterange shadow text-center">
                        <div class="input-group-prepend shadow reset" style="cursor: pointer;">
                            <div class="input-group-text bg-warning text-white">
                                Reset
                            </div>
                        </div>
                    </div>  
                    
                </div>
                <div class="col-md-7 text-right">
                    <a href="javascript:;" class="btn btn-icon icon-left btn-success shadow mt-1 mr-3" hidden><i class="fas fa-upload"></i> Upload Data</a>  
                    <a href="javascript:;" class="btn btn-icon icon-left btn-warning shadow mt-1" id="tambah_transaksi"><i class="fas fa-plus"></i> Tambah Transaksi</a>  
                </div>
            </div>

            <div class="row mt-3 mb-0">

                <div class="col-md-6">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-success text-white">
                        <i class="fa fa-money-check-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header mb-2">
                            <h4>Jumlah Transaksi Pengeluaran</h4>
                        </div>
                        <div class="card-body jml_pengeluaran text-right">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-warning text-white">
                        <i class="fa fa-money-bill-wave-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header mb-2">
                            <h4>Total Transaksi Pengeluaran</h4>
                        </div>
                        <div class="card-body tot_pengeluaran text-right">
                        </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                <div class="card card-warning shadow">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered tabel_pengeluaran" width="100%">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Total Transaksi</th>
                                <th>Aksi</th>
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

    </section>
</div>

<!-- 04-09-2020 -->

<div id="modal_detail_transaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content f_detail_transaksi">
            
        </div>
    </div>
</div>

<!-- modal tambah pengeluaran -->
<div id="modal_pengeluaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Tambah pengeluaran</h5>
                <button class="close p-3 close_tambah" aksi_tambah="baru_pertama" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-pengeluaran">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="aksi_tambah" class="aksi_tambah" name="aksi_tambah" value="baru_pertama">
                <input type="hidden" id="id_pengeluaran" name="id_pengeluaran">        
                <input type="hidden" id="id_transaksi" name="id_transaksi_kedua">      
                <input type="hidden" id="id_detail" name="id_detail">      
                <input type="hidden" id="id_tr" name="id_tr">      
                <input type="hidden" id="tgl_bayar2" name="tgl_bayar2">  
                <input type="hidden" name="id_umkm" id="id_umkm" value="<?= $id_umkm ?>">
                <div class="modal-body">
                    <div class="row p-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_bayar">Tanggal Bayar</label>
                                <input type="text" class="form-control datepicker" id="tgl_bayar" name="tgl_bayar" placeholder="Masukkan Tanggal Bayar">
                                <span class="text-danger" id="tgl_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Pembayaran/Produk</label>
                                <input type="text" class="form-control input_pelanggan" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk">
                                <span class="text-danger" id="nama_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nama_produk">QTY</label>
                                <input type="text" class="form-control qty text-center input_pelanggan numeric" id="qty" name="qty" placeholder="Masukkan Qty" value="0">
                                <span class="text-danger" id="qty_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control input_pelanggan" id="satuan" name="satuan" placeholder="Masukkan Satuan">
                                <span class="text-danger" id="satuan_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="harga">Harga Satuan</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control text-right harga number_separator numeric" id="harga" name="harga" value="0" readonly>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sub_total">Subtotal</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control sub_total text-right" id="sub_total" name="sub_total" value="0" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2 close_tambah" aksi_tambah="baru_pertama"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-warning" id="simpan_pengeluaran" disabled><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // 04-09-2020

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.daterange').on('change', function () {
            var isi = $(this).val();

            var ar = isi.split(" - ");

            tabel_pengeluaran.ajax.reload(null, false);
            
            // $.ajax({
            //     url         : "<?= base_url() ?>Transaksi/ambil_total",
            //     method      : "POST",
            //     data        : {date_range:ar, aksi:'Pengeluaran'},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         console.log(data.total);
                    
            //         $('.tot_pengeluaran').text("Rp. "+separator(data.total));

            //     }
            // })

        })

        // 04-09-2020

        $('.reset').on('click', function () {
            $('.daterange').val('');

            var date = moment(); //Get the current date
            var df   = date.format("YYYY-MM-DD"); //2014-07-10

            $('.daterange').val(df+" - "+df);
            
            var isi = $('.daterange').val();

            var ar = isi.split(" - ");

            tabel_pengeluaran.ajax.reload(null, false);
            
            // $.ajax({
            //     url         : "<?= base_url() ?>Transaksi/ambil_total",
            //     method      : "POST",
            //     data        : {date_range:ar, aksi:'Pengeluaran'},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         // console.log(data.total);
                    
            //         $('.tot_pengeluaran').text("Rp. "+separator(data.total));

            //     }
            // })
        })

        // 04-09-2020

        var tabel_pengeluaran = $('.tabel_pengeluaran').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Transaksi/tampil_pengeluaran",
                "type"  : "POST",
                "data"  : function (data) {
                    var isi = $('.daterange').val();

                    var ar = isi.split(" - ");

                    data.date_range = ar;
                    data.id_umkm    = $('#id_umkm').val();
                },
                "dataSrc": function (json) {
                    $('.tot_pengeluaran').text("Rp. "+separator(json.total));
                    $('.jml_pengeluaran').text(json.jumlah);
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,1,2,3,4],
                'className' : 'text-center',
            }]

        })

        // 02-12-2020
        $('.tabel_pengeluaran').on('click', '.hapus', function () {

            var id_detail = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-success mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>Transaksi/simpan_data_pengeluaran",
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
                        data        : {aksi:'Hapus', id_detail:id_detail},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_pengeluaran.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus Transaksi',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form-pengeluaran').trigger("reset");

                                $('#aksi').val('Tambah');
                            
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
                            text                : 'Anda membatalkan hapus transaksi',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

        })

        // 02-12-2020 && 03-12-2020
        $('.tabel_pengeluaran').on('click', '.edit', function () {

            var id_detail   = $(this).data('id');
            var id_tr       = $(this).attr('id_tr');
            var tanggal     = $(this).attr('tanggal');
            var nama        = $(this).attr('nama');
            var qty         = $(this).attr('qty');
            var harga       = $(this).attr('harga');
            var satuan      = $(this).attr('satuan');
            var sub_total   = $(this).attr('sub_total');

            $('#id_tr').val(id_tr);
            $('#id_detail').val(id_detail);
            $('#tgl_bayar').val(tanggal).trigger('change');
            $('#nama_produk').val(nama);
            $('#qty').val(qty);
            $('#satuan').val(satuan);
            $('#harga').val(separator(harga)).attr('readonly', false);
            $('#sub_total').val(separator(sub_total));

            $('#my-modal-title').text('Edit Pengeluaran');
            $('#modal_pengeluaran').modal('show');

            $('#aksi').val('Ubah');

            $('#simpan_pengeluaran').attr('disabled', false);
        })

        // 04-09-2020

        $('.tabel_pengeluaran').on('click', '.detail_trn', function () {
            
            var id_tr       = $(this).attr('id_trn');
            var id_umkm     = $('#id_umkm').val();

            $('.f_detail_transaksi').html('');

            // isi modal detail transaksi
            $.ajax({
                url         : "<?= base_url() ?>Transaksi/tampilan_detail_transaksi_pengeluaran",
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
                data        : {id_tr:id_tr, aksi_tambah:"baru_kedua", id_umkm:id_umkm},
                success     : function (data2) {

                    swal.close();
                    
                    $('.f_detail_transaksi').html(data2);
                    $('#modal_detail_transaksi').modal('show');

                }
            })

        })

        // 04-09-2020 && 03-12-2020
        $('#tambah_transaksi').on('click', function () {

            $('#my-modal-title').text('Tambah Pengeluaran');
            
            $('#modal_pengeluaran').modal('show');

            $('#simpan_pengeluaran').removeClass('btn-progress disabled');

            $('.close_tambah').attr('aksi_tambah', 'baru_pertama');

            $('#form-pengeluaran').trigger("reset");
                        
            $('#aksi').val('Tambah');

            $('#simpan_pengeluaran').attr('disabled', true);
        })

        $('#simpan_pengeluaran').on('click', function () {
            
            var form_pengeluaran  = $('#form-pengeluaran').serialize();
            var nama_produk       = $('#nama_produk').val();
            var aksi_tambah       = $('#aksi_tambah').val();

            if (nama_produk == '') {
                
                $('#nama_produk').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Nama Pembayaran/Produk harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 
 
            } else {

                $('#simpan_pengeluaran').addClass('btn-progress disabled');
                
                $.ajax({
                    url     : "<?= base_url() ?>Transaksi/simpan_data_pengeluaran",
                    type    : "POST",
                    data    : form_pengeluaran,
                    dataType: "JSON",
                    success : function (data) {

                        $('#simpan_pengeluaran').removeClass('btn-progress disabled');

                        // if (aksi_tambah == 'baru_pertama') {
                        //     $('#modal_pengeluaran').modal('hide');

                        //     swal({
                        //         title               : "Berhasil",
                        //         text                : 'Data berhasil disimpan',
                        //         buttonsStyling      : false,
                        //         confirmButtonClass  : "btn btn-success",
                        //         type                : 'success',
                        //         showConfirmButton   : false,
                        //         timer               : 700
                        //     });  

                        // } else {
                        //     $('#modal_pengeluaran').modal('hide');

                        //     var id_transaksi = data.id_trn;

                        //     $('.f_detail_transaksi').html('');

                        //     // isi modal detail transaksi
                        //     $.ajax({
                        //         url         : "<?= base_url() ?>Transaksi/tampilan_detail_transaksi_pengeluaran",
                        //         method      : "POST",
                        //         beforeSend  : function () {
                        //             swal({
                        //                 title   : 'Menunggu',
                        //                 html    : 'Memproses Data',
                        //                 onOpen  : () => {
                        //                     swal.showLoading();
                        //                 }
                        //             })
                        //         },
                        //         data        : {id_tr:id_transaksi, aksi_tambah:"baru_kedua"},
                        //         success     : function (data2) {

                        //             swal.close();
                                    
                        //             $('.f_detail_transaksi').html(data2);
                        //             $('#modal_detail_transaksi').modal('show');

                        //         }
                        //     })
                        // }

                        $('#modal_pengeluaran').modal('hide');

                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 700
                        }); 
        
                        tabel_pengeluaran.ajax.reload(null,false);        
                        
                        $('#form-pengeluaran').trigger("reset");
                        
                        $('#aksi').val('Tambah');

                        // var isi = $('.daterange').val();

                        // var ar = isi.split(" - ");
                        
                        // $.ajax({
                        //     url         : "<?= base_url() ?>Transaksi/ambil_total",
                        //     method      : "POST",
                        //     data        : {date_range:ar, aksi:'Pengeluaran'},
                        //     dataType    : "JSON",
                        //     success     : function (data) {

                        //         // console.log(data.total);
                                
                        //         $('.tot_pengeluaran').text("Rp. "+separator(data.total));

                        //     }
                        // })
                        
                    }
                })
        
                return false;

            }
            
        })

        // 04-09-2020

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.numeric').numericOnly();
        
        // 03-12-2020
        $('.qty').on('keyup', function () {
            
            var isi         = $(this).val();
            var harga       = $('.harga').val().replace('.','');
            var sub_total   = $('.sub_total').val().replace('.','');

            console.log(isi)

            if (isi == '' || isi == 0) {
                $('.harga').attr('readonly', true);

                if (sub_total == 0 || isi == '') {
                    $('#simpan_pengeluaran').attr('disabled', true);
                } else {
                    $('.harga').attr('readonly', false);
                }

            } else {
                $('.harga').attr('readonly', false);

                var sub_tot = harga * isi;
                $('.sub_total').val(separator(sub_tot));

                if (sub_total == 0) {
                    $('#simpan_pengeluaran').attr('disabled', true);
                } else {
                    $('#simpan_pengeluaran').attr('disabled', false);
                }

            }

        })

        // 04-09-2020
        
        $('.harga').on('keyup', function () {
            
            var isi         = $(this).val().replace('.','');
            var harga       = $('.qty').val();
            var sub_total   = $('.sub_total').val().replace('.','');

            var sub_tot = harga * isi;
            $('.sub_total').val(separator(sub_tot));

            if (isi == '' || isi == 0) {
                $('#simpan_pengeluaran').attr('disabled', true);
            } else {
                $('#simpan_pengeluaran').attr('disabled', false);
            }

        })

        // 04-09-2020
        $('.close_tambah').on('click', function () {

            var aksi = $(this).attr('aksi_tambah');

            if (aksi == 'baru_pertama') {
                $('#modal_pengeluaran').modal('hide');
            } else {
                $('#modal_pengeluaran').modal('hide');
                $('#modal_detail_transaksi').modal('show');
            }

            tabel_pengeluaran.ajax.reload(null,false);
            
        })

    })
</script>