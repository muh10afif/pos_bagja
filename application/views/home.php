<style>
    .tab-pane.active {
        animation: slide-down 0.5s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-header shadow">

            <?php if ($user == 'Bagja'): ?>

                <?php if ($this->uri->segment(5) == 'detail_off') : ?>
                    <h1 class=""><i class="fa fa-home mr-3"></i>Dashboard | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active"><?= $title ?></div>
                    </div>
                <?php else: ?>
                    <h1 class=""><i class="fa fa-home mr-3"></i>Dashboard</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active"><?= $title ?></div>
                    </div>
                <?php endif; ?>
                
            <?php else: ?>
                <h1 class=""><i class="fa fa-home mr-3"></i>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bagja</div>
                    <div class="breadcrumb-item active"><?= $title ?></div>
                </div>  
            <?php endif; ?>
        </div>

        <div class="section-body">
            <div class="row <?= ($this->session->userdata('hal') == '' && $this->session->userdata('nama') == 'Bagja') ? 'mb-3' : '' ?> d-flex justify-content-center">
                <div class="col-md-4">
                    <?php if ($this->session->userdata('nama') == 'Bagja') : ?>
                        <?php if ($this->session->userdata('hal') == ''): ?>
                            <select name="id_umkm" id="id_umkm" class="form-control select2">
                                <option value="0">Pilih UMKM</option>
                                <?php foreach ($umkm as $u): ?>
                                    <option value="<?= $u['id'] ?>"><?= ucwords($u['nama']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>  
                    <?php endif; ?>  
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning shadow">
                        <div class="card-body body_2" hidden>
                            <?= br(4) ?>
                                <div class="row d-flex justify-content-center">
                                    <img src="<?= base_url('assets/img/loading2.gif') ?>" width="10%">
                                </div>
                            <?= br(4) ?>
                        </div>
                        <div class="card-body body_1">
                            
                            <div class="row">
                                <!-- <div class="col-md-4">
                                    <?php if ($this->session->userdata('hal') == ''): ?>
                                        <select name="id_umkm" id="id_umkm" class="form-control select2">
                                            <option value="">Pilih UMKM</option>
                                            <?php foreach ($umkm as $u): ?>
                                                <option value="<?= $u['id'] ?>"><?= ucwords($u['nama']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                </div> -->
                                <div class="col-md-12">
                                    <ul class="nav nav-pills justify-content-end" id="myTab3" role="tablist"> 
                                        <li class="nav-item mr-2">
                                            <a class="nav-link active shadow" id="harian-tab3" data-toggle="tab" href="#harian3" role="tab" aria-controls="harian" aria-selected="true"><h5 class="mb-0">Harian</h5></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link shadow" id="bulanan-tab3" data-toggle="tab" href="#bulanan3" role="tab" aria-controls="bulanan" aria-selected="false"><h5 class="mb-0">Bulanan</h5></a>
                                        </li>
                                    </ul> 
                                </div>
                            </div>
                            
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="harian3" role="tabpanel" aria-labelledby="harian-tab3">
                                    
                                <div class="row mt-2 mb-0 d-flex justify-content-center">
                                    
                                    <div class="col-md-4">
                                        <div class="card card-statistic-1 shadow">
                                            <div class="card-icon bg-warning">
                                            <i class="text-white fa fa-money-check-alt fa-2x"></i>
                                            </div>
                                            <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Pendapatan</h4>
                                            </div>
                                            <div class="card-body tot_pendapatan">
                                                Rp. <?= number_format($tot_pendapatan_h,0,'.','.') ?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-statistic-1 shadow">
                                            <div class="card-icon bg-info">
                                            <i class="text-white fa fa-money-bill-wave-alt fa-2x"></i>
                                            </div>
                                            <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Keuntungan</h4>
                                            </div>
                                            <div class="card-body tot_keuntungan">
                                                Rp. <?= number_format($tot_keuntungan_h,0,'.','.') ?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-statistic-1 shadow">
                                            <div class="card-icon bg-success">
                                            <i class="text-white fa fa-money-check fa-2x"></i>
                                            </div>
                                            <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Pengeluaran</h4>
                                            </div>
                                            <div class="card-body tot_transaksi">
                                                Rp. <?= number_format($tot_pengeluaran_h,0,'.','.') ?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <canvas id="contoh" height="100"></canvas>
                                    </div>
                                </div>

                                </div>
                                <div class="tab-pane fade" id="bulanan3" role="tabpanel" aria-labelledby="bulanan-tab3">
                                    
                                    <div class="row mt-2 mb-0 d-flex justify-content-center">
                                        
                                        <div class="col-md-4">
                                            <div class="card card-statistic-1 shadow">
                                                <div class="card-icon bg-warning">
                                                <i class="text-white fa fa-money-check-alt fa-2x"></i>
                                                </div>
                                                <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Pendapatan</h4>
                                                </div>
                                                <div class="card-body tot_pendapatan">
                                                    Rp. <?= number_format($tot_pendapatan_b,0,'.','.') ?>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-statistic-1 shadow">
                                                <div class="card-icon bg-info">
                                                <i class="text-white fa fa-money-bill-wave-alt fa-2x"></i>
                                                </div>
                                                <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Keuntungan</h4>
                                                </div>
                                                <div class="card-body tot_keuntungan">
                                                    Rp. <?= number_format($tot_keuntungan_b,0,'.','.') ?>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-statistic-1 shadow">
                                                <div class="card-icon bg-success">
                                                <i class="text-white fa fa-money-check fa-2x"></i>
                                                </div>
                                                <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Pengeluaran</h4>
                                                </div>
                                                <div class="card-body tot_transaksi">
                                                    Rp. <?= number_format($tot_pengeluaran_b,0,'.','.') ?>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <canvas id="contoh2" height="100"></canvas>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
</div>

<?php 

    foreach ($bln as $b) {
        $bulan[] = $b;
    }

    foreach ($day as $d) {
        $hari[] = $d;
    }

    foreach ($pendapatan_h as $pd) {
        $pd_h[] = $pd;
    }

    foreach ($keuntungan_h as $k) {
        $kt_h[] = $k;
    }

    foreach ($pengeluaran_h as $plg) {
        $pgl_h[] = $plg;
    }

    foreach ($pendapatan_b as $pdb) {
        $pd_b[] = $pdb;
    }

    foreach ($keuntungan_b as $kb) {
        $kt_b[] = $kb;
    }

    foreach ($pengeluaran_b as $plgb) {
        $pgl_b[] = $plgb;
    }

?>

<script>
    $(document).ready(function () {

        // 07-12-2020
        $('#id_umkm').on('change', function () {

            $('.body_1').attr('hidden', true);
            $('.body_2').attr('hidden', false);

            var id_umkm = $('#id_umkm').val();

            $.ajax({
                url     : "<?= base_url() ?>Home/tampil_filter_home",
                method  : "POST",
                data    : {id_umkm:id_umkm},
                success : function (data) {

                    $('.body_2').attr('hidden', true);

                    $('.body_1').html(data);

                    $('.body_1').attr('hidden', false);
                    
                }
            })
            
        })
        
        var ctx = document.getElementById('contoh').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($hari) ?>,
                datasets: [{
                    label: 'Pendapatan',
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(255, 227, 189, 0.2)",
                    borderColor: '#ffa426',
                    data: <?= json_encode($pd_h) ?>
                },{
                    label: 'Keuntungan',
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(186, 228, 247, 0.2)",
                    borderColor: '#3abaf4',
                    data: <?= json_encode($kt_h) ?>
                },{
                    label: 'Pengeluaran',
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(186, 255, 202, 0.2)",
                    borderColor: '#47c363',
                    data: <?= json_encode($pgl_h) ?>
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if(parseInt(value) >= 1000){
                                    return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                } else {
                                    return 'Rp.' + value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chart){
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp. ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    }
                },
            }
        });

        var ctx = document.getElementById('contoh2').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($bulan) ?>,
                datasets: [{
                    label: 'Pendapatan',
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(255, 227, 189, 0.2)",
                    borderColor: '#ffa426',
                    data: <?= json_encode($pd_b) ?>
                },{
                    label: 'Keuntungan',
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(186, 228, 247, 0.2)",
                    borderColor: '#3abaf4',
                    data: <?= json_encode($kt_b) ?>
                },{
                    label: 'Pengeluaran',
                    fill: true,
                    lineTension: 0.5,
                    backgroundColor: "rgba(186, 255, 202, 0.2)",
                    borderColor: '#47c363',
                    data: <?= json_encode($pgl_b) ?>
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if(parseInt(value) >= 1000){
                                    return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                } else {
                                    return 'Rp.' + value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chart){
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp. ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    }
                },
            }
        });

    })
</script>