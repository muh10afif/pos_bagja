<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <?php if ($user == 'Bagja'): ?>

                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Pengeluaran | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">Laporan Pengeluaran</div>
                    </div> 
                <?php else: ?>
                    <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Pengeluaran | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="<?= base_url('Laporan/pengeluaran') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item active">Laporan Pengeluaran</div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Pengeluaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bagja</div>
                    <div class="breadcrumb-item active"><?= $title ?></div>
                </div>  
            <?php endif; ?>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <form action="<?= base_url('laporan/download_file_pengeluaran') ?>" method="post">
                            <input type="hidden" id="aksi" name="jenis">
                            <input type="hidden" id="id_umkm" name="id_umkm" value="<?= $id_umkm ?>">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control daterange text-center" value="" name="tanggal_range" autocomplete="off" readonly>
                                            <div class="input-group-prepend reset">
                                                <button type="button" class="btn btn-warning reset">Reset</button>
                                            </div>
                                        </div>  
                                        
                                    </div>
                                    <div class="col-md-3 btn_laporan" style="display: none;">

                                        <div class="btn-group mb-0 mt-1" role="group" aria-label="Basic example">
                                            <button type="button" style="cursor: default;" class="btn btn-light">Download Laporan</button>
                                            <button type="submit" class="btn btn-info" name="export" data="excel">Excel</button>
                                            <button type="submit" class="btn btn-success" name="export" data="pdf">PDF</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

            <!-- <div class="row mt-0 mb-0 f_alert" hidden>
                <div class="col-md-12">
                    <div class="alert alert-warning shadow">
                       <h5 class="mb-0"><i class="fa fa-info-circle mr-3"></i><em>Detail pengeluaran <span id="tanggal_filter"></span></em></h5> 
                    </div>
                </div>
            </div> -->

            <div class="row mb-0 d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-success">
                        <i class="text-white fa fa-money-bill-wave-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belanja</h4>
                        </div>
                        <div class="card-body tot_transaksi text-right mt-2">
                            0
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-warning">
                        <i class="text-white fa fa-money-check-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Belanja</h4>
                        </div>
                        <div class="card-body tot_belanja text-right mt-2">
                            Rp. 0
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
                                <th>Pengeluaran</th>
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

<div id="modal_detail_transaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content f_detail_transaksi">
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // 09-09-2020
        $('button[name="export"]').on('click', function () {
            var jns = $(this).attr('data');

            $('#aksi').val(jns);
        })
        
        // 09-09-2020

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 09-09-2020

        var tabel_pengeluaran = $('.tabel_pengeluaran').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Laporan/tampil_pengeluaran",
                "type"  : "POST",
                "data"  : function (data) {
                    var isi = $('.daterange').val();

                    var tgl = isi.split(" - ");

                    data.date_range = tgl;
                    data.id_umkm    = $('#id_umkm').val();
                },
                "dataSrc": function (json) {
                    if (json.jumlah > 0) {
                        $('.btn_laporan').slideDown('fast');
                    } else {
                        $('.btn_laporan').slideUp('fast');
                    }
                    $(".tot_transaksi").text(json.jumlah); 
                    $(".tot_belanja").text("Rp. "+json.total); 
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,1,3,4],
                'className' : 'text-center',
            }]

        })

        // 09-09-2020

        $('.daterange').on('change', function () {

            // $('.tabel_pengeluaran tbody').empty();

            // var tanggal = $('.daterange').val();

            // $('.f_alert').attr('hidden', false);

            // var tgl = tanggal.split(" - ");

            // if (tanggal != "") {

            //     var tahun_a = tgl[0].slice(0,4);
            //     var bulan_a = tgl[0].slice(5,7);
            //     var tgl_a   = tgl[0].slice(8,10);

            //     var tgl_1 = tgl_a+"-"+bulan_a+'-'+tahun_a;

            //     var tahun_b = tgl[1].slice(0,4);
            //     var bulan_b = tgl[1].slice(5,7);
            //     var tgl_b   = tgl[1].slice(8,10);

            //     var tgl_2 = tgl_b+"-"+bulan_b+'-'+tahun_b;

            //     tggl = "Tanggal "+tgl_1+" s/d "+tgl_2;

            // } else {
            //     tggl = "";
            // }

            // $('#tanggal_filter').text(tggl);

            tabel_pengeluaran.ajax.reload(null, false);

            // if ( !tabel_pengeluaran.data().any() ) {
            //     $('.btn_laporan').slideUp('fast');
            // }

            // $('.tot_transaksi').text(0);
            // $('.tot_belanja').text("Rp. 0");

            // $.ajax({
            //     url         : "<?= base_url() ?>Laporan/ambil_total_pengeluaran",
            //     method      : "POST",
            //     data        : {tanggal:tgl},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         if (data.tot_transaksi != 0) {
            //             $('.btn_laporan').slideDown('fast');
            //         } else {
            //             $('.btn_laporan').slideUp('fast');
            //         }
                    
            //         $('.tot_transaksi').text(data.tot_transaksi);
            //         $('.tot_belanja').text("Rp. "+separator(data.tot_belanja));

            //     }
            // })

        })

        // 09-09-2020

        $('.reset').on('click', function () {
            $('.daterange').val('');

            var date = moment(); //Get the current date
            var df   = date.format("YYYY-MM-DD"); //2014-07-10

            $('.daterange').val(df+" - "+df);

            $('.tabel_pengeluaran tbody').empty();

            tabel_pengeluaran.ajax.reload(null, false);

            // $('.f_alert').attr('hidden', true);

            // var tanggal = $('.daterange').val();

            // var tgl = tanggal.split(" - ");

            // if (tanggal != "") {

            //     var tahun_a = tgl[0].slice(0,4);
            //     var bulan_a = tgl[0].slice(5,7);
            //     var tgl_a   = tgl[0].slice(8,10);

            //     var tgl_1 = tgl_a+"-"+bulan_a+'-'+tahun_a;

            //     var tahun_b = tgl[1].slice(0,4);
            //     var bulan_b = tgl[1].slice(5,7);
            //     var tgl_b   = tgl[1].slice(8,10);

            //     var tgl_2 = tgl_b+"-"+bulan_b+'-'+tahun_b;

            //     tggl = "Tanggal "+tgl_1+" s/d "+tgl_2;

            // } else {
            //     tggl = "";
            // }

            // $('#tanggal_filter').text(tggl);

            // $('.btn_laporan').slideUp('fast');

            // $('.tot_transaksi').text(0);
            // $('.tot_belanja').text("Rp. 0");

            // $.ajax({
            //     url         : "<?= base_url() ?>Laporan/ambil_total_pengeluaran",
            //     method      : "POST",
            //     data        : {tanggal:tgl},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         if (data.tot_transaksi != 0) {
            //             $('.btn_laporan').slideDown('fast');
            //         } else {
            //             $('.btn_laporan').slideUp('fast');
            //         }
                    
            //         $('.tot_transaksi').text(data.tot_transaksi);
            //         $('.tot_belanja').text("Rp. "+separator(data.tot_belanja));

            //     }
            // })

        })

        // 09-09-2020

        function ucwords (str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        // 10-09-2020

        $('.tabel_pengeluaran').on('click', '.detail_trn', function () {
            
            var id_tr = $(this).attr('id_trn');

            $('.f_detail_transaksi').html('');

            // isi modal detail transaksi
            $.ajax({
                url         : "<?= base_url() ?>Laporan/tampilan_detail_pengeluaran",
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
                data        : {id_tr:id_tr},
                success     : function (data2) {

                    swal.close();
                    
                    $('.f_detail_transaksi').html(data2);
                    $('#modal_detail_transaksi').modal('show');

                }
            })

        })

    })
</script>