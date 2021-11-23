<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>List UMKM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Bagja</div>
                <div class="breadcrumb-item">List UMKM</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-prepend shadow">
                            <div class="input-group-text">
                            <i class="fas fa-calendar"></i>
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
            </div>

            <div class="row mt-3 mb-0 d-flex justify-content-center">
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
                        <table class="table table-striped table-bordered" id="tabel_umkm" width="100%">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama UMKM </th>
                                <th>Jumlah Transaksi</th>
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

<script>
    $(document).ready(function () {

        // 30-11-2020
        var tabel_umkm = $('#tabel_umkm').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_umkm_pengeluaran",
                "type"  : "POST",
                "data"  : function (data) {
                    var isi = $('.daterange').val();

                    var ar = isi.split(" - ");

                    data.date_range = ar;
                },
                "dataSrc": function (json) {
                    $(".tot_pengeluaran").text("Rp. "+json.total_transaksi); 
                    $(".jml_pengeluaran").text(json.jumlah_transaksi); 
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,2,4],
                'className' : 'text-center',
            }]

        })

        // 30-11-2020
        $('.daterange').on('change', function () {

            tabel_umkm.ajax.reload(null, false);

        })

        // 30-11-2020
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