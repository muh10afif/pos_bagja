<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-dollar-sign mr-3"></i>Laporan Laba Rugi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
            <div class="breadcrumb-item"><?= $title ?></div>
            <div class="breadcrumb-item">Laporan Rugi Laba</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <div class="form-inline">
                        <a href="javascript:;" class="btn btn-icon icon-left btn-success shadow mr-3" id="download_laporan"><i class="fas fa-download"></i> Download Laporan</a>
                        <div class="form-group mb-1">
                            <label for="staticEmail2" class="sr-only">Periode</label>
                            <input type="text" class="form-control datepicker shadow text-center">
                        </div>
                    </div>

                    <div class="card shadow mt-3">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabel-pelanggan">
                            <thead>                                 
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No Tagihan</th>
                                    <th>No Pembayaran</th>
                                    <th>Nama Tagihan</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Total Bayar</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
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
        
        $("#tabel-pelanggan").dataTable();

    })
</script>