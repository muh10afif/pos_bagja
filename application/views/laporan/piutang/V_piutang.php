<div class="main-content">
    <section class="section">
        <div class="section-header shadow">

            <?php if ($user == 'Bagja'): ?>

                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Piutang | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">Laporan Piutang</div>
                    </div> 
                <?php else: ?>
                    <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Piutang | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="<?= base_url('Laporan/piutang') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item active">Laporan Piutang</div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Piutang</h1>
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
                        <form action="<?= base_url('laporan/download_file_piutang') ?>" method="post">
                            <input type="hidden" id="aksi" name="jenis">
                            <input type="hidden" id="id_umkm" name="id_umkm" value="<?= $id_umkm ?>">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                <i class="fas fa-calendar mr-2"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control datepicker text-center" value="" name="tanggal_range" autocomplete="off" readonly>
                                            <div class="input-group-prepend reset">
                                                <button type="button" class="btn btn-warning reset">Reset</button>
                                            </div>
                                        </div>  
                                        
                                    </div>
                                    <div class="col-md-3 f_pelanggan">
                                        <select name="id_pelanggan" id="id_pelanggan" class="form-control select2">
                                            <option value="">Pilih Pelanggan</option>
                                            <!-- <?php foreach ($pelanggan as $p): ?>
                                                <option value="<?= $p['id'] ?>"><?= ucwords($p['nama']) ?></option>
                                            <?php endforeach; ?> -->
                                        </select>
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

            <div class="row mt-0 mb-0 f_alert">
                <div class="col-md-12" hidden>
                    <div class="alert alert-warning shadow">
                       <h5 class="mb-0"><i class="fa fa-info-circle mr-3"></i><em>Detail Piutang <span id="nama_pelanggan">Dimas</span> <span id="tanggal_filter"></span></em></h5> 
                    </div>
                </div>
            </div>

            <div class="row mt-2 mb-0">
                <div class="col-md-3">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-success">
                        <i class="text-white fa fa-user fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pelanggan Piutang</h4>
                        </div>
                        <div class="card-body tot_pelanggan text-right mt-2">
                            0
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-info">
                        <i class="text-white fa fa-money-check-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Piutang</h4>
                        </div>
                        <div class="card-body tot_piutang text-right mt-2">
                            Rp. 0
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-warning">
                        <i class="text-white fa fa-money-bill-wave-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Bayar</h4>
                        </div>
                        <div class="card-body tot_bayar text-right mt-2">
                            Rp. 0
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-danger">
                        <i class="text-white fa fa-money-check fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sisa Piutang</h4>
                        </div>
                        <div class="card-body tot_sisa_piutang text-right mt-2">
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
                        <table class="table table-hover table-striped table-bordered tabel_piutang" width="100%">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Bayar</th>
                                <th>Nominal Bayar</th>
                                <th>Sisa Piutang</th>
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

<script>
    $(document).ready(function () {

        // 09-09-2020
        $('button[name="export"]').on('click', function () {
            var jns = $(this).attr('data');

            $('#aksi').val(jns);
        })
        
        // 08-09-2020

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        var tabel_piutang = $('.tabel_piutang').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Laporan/tampil_piutang",
                "type"  : "POST",
                "data"  : function (data) {
                    var isi = $('.datepicker').val();

                    var tgl = isi.split(" - ");

                    data.tanggal        = $('.datepicker').val();
                    data.id_pelanggan   = $('#id_pelanggan').val();
                    data.id_umkm        = $('#id_umkm').val();

                },
                "dataSrc": function (json) {
                    if (json.jumlah > 0) {
                        $('.f_pelanggan').slideDown('fast');
                        $('.btn_laporan').slideDown('fast');
                    } else {
                        $('.f_pelanggan').slideUp('fast');
                        $('.btn_laporan').slideUp('fast');
                    }

                    $(".tot_pelanggan").text(json.jumlah); 
                    $(".tot_piutang").text("Rp. "+json.piutang); 
                    $(".tot_bayar").text("Rp. "+json.bayar); 
                    $(".tot_sisa_piutang").text("Rp. "+json.sisa); 
                    $('#id_pelanggan').html(json.list_plg);
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0],
                "orderable" : false
            }, {
                'targets'   : [0,2,3,4],
                'className' : 'text-center',
            }]

        })

        $('.datepicker').on('change', function () {

            $('.tabel_piutang tbody').empty();

            tabel_piutang.ajax.reload(null, false);

            // var nama    = $("#id_pelanggan option:selected").text();
            // var id_pl   = $("#id_pelanggan option:selected").val();
            // var tanggal = $('.daterange').val();

            // $('.f_alert').attr('hidden', false);

            // var tgl = tanggal.split(" - ");

            // var nm = "";
            // if (nama != "Pilih Pelanggan") {
            //     nm = nama;  
            // } else {
            //     nm = "";
            // }

            //     $('#nama_pelanggan').text(ucwords(nm));

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

            //     $('#tanggal_filter').text(tggl);

            // $('.tot_pelanggan').text(0);
            // $('.tot_bayar').text("Rp. 0");
            // $('.tot_sisa_piutang').text("Rp. 0");
            // $('.tot_piutang').text("Rp. 0");

            // $('.btn_laporan').slideUp('fast');

            // var id_umkm = $('#id_umkm').val();

            // $.ajax({
            //     url         : "<?= base_url() ?>Laporan/ambil_total",
            //     method      : "POST",
            //     data        : {tanggal:tgl, id_pelanggan:id_pl, id_umkm:id_umkm},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         if (data.tot_pelanggan != 0) {
            //             $('.btn_laporan').slideDown('fast');
            //             $('.f_pelanggan').slideDown('fast');
            //         } else {
            //             $('.btn_laporan').slideUp('fast');
            //             $('.f_pelanggan').slideUp('fast');
            //         }
                    
            //         $('.tot_pelanggan').text(data.tot_pelanggan);
            //         $('.tot_bayar').text("Rp. "+separator(data.tot_bayar));
            //         $('.tot_sisa_piutang').text("Rp. "+separator(data.tot_sisa_piutang));
            //         $('.tot_piutang').text("Rp. "+separator(data.tot_piutang));

            //         $('#id_pelanggan').html(data.list_plg);

            //     }
            // })

        })

        // 08-09-2020

        $('.reset').on('click', function () {

            var date = moment(); //Get the current date
            var df   = date.format("YYYY-MM-DD"); //2014-07-10

            $('.datepicker').val(df);

            $('.tabel_piutang tbody').empty();

            tabel_piutang.ajax.reload(null, false);

            // var nama    = $("#id_pelanggan option:selected").text();
            // var id_pl   = $("#id_pelanggan option:selected").val();
            // var tanggal = $('.daterange').val();

            // var tgl = tanggal.split(" - ");

            // var nm = "";
            // if (nama != "Pilih Pelanggan") {
            //     nm = nama;  
            // } else {
            //     nm = "";
            // }

            //     $('#nama_pelanggan').text(ucwords(nm));

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

            //     $('#tanggal_filter').text(tggl);

            // if (tanggal == "" && nama == "Pilih Pelanggan") {
            //     $('.f_alert').attr('hidden', true);
            // } else {
            //     $('.f_alert').attr('hidden', false);
            // }

            // $('.tot_pelanggan').text(0);
            // $('.tot_bayar').text("Rp. 0");
            // $('.tot_sisa_piutang').text("Rp. 0");
            // $('.tot_piutang').text("Rp. 0");

            // $('.btn_laporan').slideUp('fast');

            // var id_umkm = $('#id_umkm').val();

            // $.ajax({
            //     url         : "<?= base_url() ?>Laporan/ambil_total",
            //     method      : "POST",
            //     data        : {tanggal:tgl, id_pelanggan:id_pl, id_umkm:id_umkm},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         if (data.tot_pelanggan != 0) {
            //             $('.btn_laporan').slideDown('fast');
            //             $('.f_pelanggan').slideDown('fast');
            //         } else {
            //             $('.btn_laporan').slideUp('fast');
            //             $('.f_pelanggan').slideUp('fast');
            //         }
                    
            //         $('.tot_pelanggan').text(data.tot_pelanggan);
            //         $('.tot_bayar').text("Rp. "+separator(data.tot_bayar));
            //         $('.tot_sisa_piutang').text("Rp. "+separator(data.tot_sisa_piutang));
            //         $('.tot_piutang').text("Rp. "+separator(data.tot_piutang));

            //         $('#id_pelanggan').html(data.list_plg);

            //     }
            // })

        })

        // 08-09-2020

        $('#id_pelanggan').on('change', function () {

            // var nama    = $("#id_pelanggan option:selected").text();
            // var id_pl   = $("#id_pelanggan option:selected").val();
            // var tanggal = $('.daterange').val();
            
            $('.tabel_piutang tbody').empty();

            tabel_piutang.ajax.reload(null, false);

            // var tgl = tanggal.split(" - ");

            // var nm = "";
            // if (nama != "Pilih Pelanggan") {
            //     nm = nama;  
            // } else {
            //     nm = "";
            // }

            //     $('#nama_pelanggan').text(ucwords(nm));

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

            //     $('#tanggal_filter').text(tggl);

            // if (tanggal == "" && nama == "Pilih Pelanggan") {
            //     $('.f_alert').attr('hidden', true);
            // } else {
            //     $('.f_alert').attr('hidden', false);
            // }

            // $('.tot_pelanggan').text(0);
            // $('.tot_bayar').text("Rp. 0");
            // $('.tot_sisa_piutang').text("Rp. 0");
            // $('.tot_piutang').text("Rp. 0");

            // var id_umkm = $('#id_umkm').val();

            // $.ajax({
            //     url         : "<?= base_url() ?>Laporan/ambil_total",
            //     method      : "POST",
            //     data        : {tanggal:tgl, id_pelanggan:id_pl, id_umkm:id_umkm},
            //     dataType    : "JSON",
            //     success     : function (data) {
                    
            //         $('.tot_pelanggan').text(data.tot_pelanggan);
            //         $('.tot_bayar').text("Rp. "+separator(data.tot_bayar));
            //         $('.tot_sisa_piutang').text("Rp. "+separator(data.tot_sisa_piutang));
            //         $('.tot_piutang').text("Rp. "+separator(data.tot_piutang));

            //     }
            // })
            
        })

        // 08-09-2020

        function ucwords (str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

    })
</script>