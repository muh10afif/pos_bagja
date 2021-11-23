<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?php echo $title ?></h1>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header mb-3">
                            <h4>Pendapatan</h4>
                        </div>
                        <div class="card-body">
                            <h6>Rp. 150.000</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header mb-3">
                            <h4>Keuntungan</h4>
                        </div>
                        <div class="card-body">
                            <h6>Rp. 150.000</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header mb-3">
                            <h4>Harga Dasar</h4>
                        </div>
                        <div class="card-body">
                            <h6>Rp. 150.000</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header mb-3">
                            <h4>Pengeluaran</h4>
                        </div>
                        <div class="card-body">
                            <h6>Rp. 150.000</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header mb-3">
                            <h4>Saldo</h4>
                        </div>
                        <div class="card-body">
                            <h6>Rp. 150.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <canvas id="contoh" height="100"></canvas>
            </div>
        </div>
    </section>
</div>
<script>
    var ctx = document.getElementById('contoh').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First dataset',
                fill: false,
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45]
            },{
                label: 'My First dataset 2',
                fill: false,
                borderColor: 'rgb(112, 250, 97)',
                data: [10, 20, 20, 4, 10, 50, 35]
            }
            ]
        },
        options: {}
    });
</script>