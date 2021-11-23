<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1><i class="fa fa-file-alt mr-3"></i><?php echo $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
                <div class="breadcrumb-item"><?= $crumb ?></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
    </section>
    <!-- Filter & Download -->
    <form action="<?php echo base_url('Laporan/cetak') ?>" method="POST" target="_blank">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-6"></div>
            <div class="col-lg-2 col-md-2 col-xs-2">
                <div class="input-group">
                    <a href="javascript:;" id="reset_pelanggan" data-toogle="tooltip" data-placement="top" title="Reset">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </a>
                    <select id="pelanggan" name="pelanggan" class="form-control">
                        <option value="">Semua Pelanggan</option>
                        <?php foreach($pelanggan as $row) { ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-2">
                <div class="input-group">
                    <a href="javascript:;" id="reset_periode" data-toogle="tooltip" data-placement="top" title="Reset">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                    </a>
                    <input type="text" class="form-control" id="periode" name="periode" placeholder="Periode" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-2">
                <button type="submit" class="btn btn-secondary btn-block">
                    <i class="fas fa-file"></i> Download Laporan
                </button>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 bg-secondary mt-2">
                <h3 id="banner" class="m-2">Detail Piutang</h3>
            </div>
        </div>
    </form>
    <!-- Cards -->
    <div class="row mt-2">
        <div class="col-lg-2 col-md-2 col-xs-2"></div>
        <div class="col-lg-2 col-md-2 col-xs-2">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Piutang</h4>
                    </div>
                    <div class="card-body">
                        1000
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-xs-2">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Piutang</h4>
                    </div>
                    <div class="card-body">
                        Rp. 500.000
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-xs-2">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Bayar</h4>
                    </div>
                    <div class="card-body">
                        Rp. 500.000
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-xs-2">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Sisa Piutang</h4>
                    </div>
                    <div class="card-body">
                        Rp.50.000
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabel -->
    <div class="row mt-2">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="table-responsive">
                <table id="table" class="table table-hover table-striped table-bordered w-100">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Piutang</th>
                            <th>Sisa Kasbon</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        // Date Picker
        $('#periode').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
        $('.prev i').removeClass();
        $('.prev i').addClass("fa fa-chevron-left");
        $('.next i').removeClass();
        $('.next i').addClass("fa fa-chevron-right");
        // Data Table
        var table = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Laporan/read_piutang')?>",
                "type": "POST",
                "data": function (data) {
                    data.periode        = $('#periode').val();
                    data.pelanggan      = $('#pelanggan option:selected').val();
                },
            },
            "columnDefs": [{
                "targets": [0, 4],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });
        // button reset periode
        $('#reset_periode').click(function(event) {
            $('#periode').val('');
            if($('#pelanggan option:selected').val() == 'null')
            {
                $('#banner').text('Detail Piutang');
            }
            else
            {
                var pelanggan = $('#pelanggan option:selected').html();
                $('#banner').text('Detail Piutang '+pelanggan);
            }
            // table.ajax.reload(null, false);
        });
        // button reset pelanggan
        $('#reset_pelanggan').click(function(event) {
            $('#pelanggan option[value="null"]').prop('selected', 'selected').change();
            if($('#periode').val() == '')
            {
                $('#banner').text('Detail Piutang');
            }
            else
            {
                var tanggal     = $('#periode').val().slice(0, 2);
                if(tanggal.charAt(0) < 1) {
                    tanggal     = tanggal.charAt(1);
                }
                var nilai_bulan = $('#periode').val().slice(3, 5);
                var tahun       = $('#periode').val().slice(6, 10);
                var bulan       = lokalisasi_bulan(nilai_bulan);
                $('#banner').text('Detail Piutang Tanggal '+tanggal+' '+bulan+' '+tahun);
            }
            // table.ajax.reload(null, false);
        });
        // Filter Pelanggan
        $('#pelanggan').change(function(event) {
            var pelanggan = $('#pelanggan option:selected').html();
            if($('#periode').val() == '')
            {
                if($('#pelanggan option:selected').val() == 'null')
                {
                    $('#banner').text('Detail Piutang');
                }
                else
                {
                    $('#banner').text('Detail Piutang '+pelanggan);
                }
            }
            else
            {
                var tanggal     = $('#periode').val().slice(0, 2);
                if(tanggal.charAt(0) < 1) {
                    tanggal     = tanggal.charAt(1);
                }
                var nilai_bulan = $('#periode').val().slice(3, 5);
                var tahun       = $('#periode').val().slice(6, 10);
                var bulan       = lokalisasi_bulan(nilai_bulan);
                if($('#pelanggan option:selected').val() == 'null')
                {
                    $('#banner').text('Detail Piutang Tanggal '+tanggal+' '+bulan+' '+tahun);
                }
                else
                {
                    $('#banner').text('Detail Piutang '+pelanggan+' Tanggal '+tanggal+' '+bulan+' '+tahun);
                }
            }
        });
        // Filter Tanggal
        $('#periode').change(function(event) {
            var tanggal     = $(this).val().slice(0, 2);
            if(tanggal.charAt(0) < 1) {
                tanggal     = tanggal.charAt(1);
            }
            var nilai_bulan = $(this).val().slice(3, 5);
            var tahun       = $(this).val().slice(6, 10);
            var bulan       = lokalisasi_bulan(nilai_bulan);
            if($('#pelanggan option:selected').val() == 'null')
            {
                $('#banner').text('Detail Piutang Tanggal '+tanggal+' '+bulan+' '+tahun);
            }
            else
            {
                var pelanggan = $('#pelanggan option:selected').html();
                $('#banner').text('Detail Piutang '+pelanggan+' Tanggal '+tanggal+' '+bulan+' '+tahun);
            }
        });
        // Penyesuaian Bulan
        function lokalisasi_bulan(x) {
            if(x == '01') {
                return x = 'Januari';
            }
            if(x == '02') {
                return x = 'Februari';
            }
            if(x == '03') {
                return x = 'Maret';
            }
            if(x == '04') {
                return x = 'April';
            }
            if(x == '05') {
                return x = 'Mei';
            }
            if(x == '06') {
                return x = 'Juni';
            }
            if(x == '07') {
                return x = 'Juli';
            }
            if(x == '08') {
                return x = 'Agustus';
            }
            if(x == '09') {
                return x = 'September';
            }
            if(x == '10') {
                return x = 'Oktober';
            }
            if(x == '11') {
                return x = 'November';
            }
            if(x == '12') {
                return x = 'Desember';
            }
        }
    });
</script>