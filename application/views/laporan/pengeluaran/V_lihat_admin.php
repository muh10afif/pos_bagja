<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-store-alt mr-3"></i>List UMKM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Bagja</div>
                <div class="breadcrumb-item">List UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-calendar mr-2"></i>Periode
                                    </div>
                                </div>
                                <input type="text" class="form-control daterange text-center" value="" name="tanggal_range" autocomplete="off" readonly>
                                <div class="input-group-prepend reset">
                                    <button type="button" class="btn btn-warning reset">Reset</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                <div class="card card-warning shadow">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabel_umkm" width="100%">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama UMKM </th>
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

<script>
    $(document).ready(function () {

        // 03-12-2020
        var tabel_umkm = $('#tabel_umkm').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Laporan/tampil_umkm_pengeluaran",
                "type"  : "POST",
                "data"  : function (data) {
                    var isi = $('.daterange').val();

                    var tgl = isi.split(" - ");

                    data.date_range = tgl;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,3],
                'className' : 'text-center',
            }]
        })

        // 03-12-2020
        $('.daterange').on('change', function () {

            tabel_umkm.ajax.reload(null, false);

        })

        // 03-12-2020
        $('.reset').on('click', function () {
            
            $('.daterange').val('');

            var date = moment(); //Get the current date
            var df   = date.format("YYYY-MM-DD"); //2014-07-10

            $('.daterange').val(df+" - "+df);
            
            var isi = $('.daterange').val();

            var ar = isi.split(" - ");

            tabel_umkm.ajax.reload(null, false);

        })
        
    })
</script>