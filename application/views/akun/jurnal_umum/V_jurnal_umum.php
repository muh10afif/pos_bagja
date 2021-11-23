<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-book mr-3"></i>Daftar Penyesuaian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
            <div class="breadcrumb-item"><?= $title ?></div>
            <div class="breadcrumb-item">Jurnal Umum</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <div class="form-inline">
                        <a href="javascript:;" class="btn btn-icon icon-left btn-primary shadow mr-3" id="tambah_buku_kas"><i class="fas fa-plus"></i> Tambah Penyesuaian</a>
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
                                    <th>Nomer</th>
                                    <th>Nama</th>
                                    <th>Nama Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
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