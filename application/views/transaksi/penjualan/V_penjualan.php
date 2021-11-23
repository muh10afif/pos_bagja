<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            
            <?php if ($user == 'Bagja'): ?>
                
                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Transaksi Penjualan | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">List Penjualan</div>
                    </div>
                <?php else: ?>
                    <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Transaksi Penjualan | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="<?= base_url('Transaksi/penjualan') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item active">Penjualan</div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h1 class=""><i class="fa fa-shopping-bag mr-3"></i>Transaksi Penjualan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bagja</div>
                    <div class="breadcrumb-item"><?= $title ?></div>
                    <div class="breadcrumb-item active">Penjualan</div>
                </div>  
            <?php endif; ?>
            
        </div>

        <div class="section-body">
            <input type="hidden" name="id_umkm" id="id_umkm" value="<?= $id_umkm ?>">
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
                    <a href="javascript:;" class="btn btn-icon icon-left btn-success shadow mt-1 mr-3" id="tambah_transaksi" hidden><i class="fas fa-upload"></i> Upload Data</a>  
                    <a href="<?= base_url("Transaksi/halaman_tambah_transaksi/$id_umkm") ?>" class="btn btn-icon icon-left btn-warning shadow mt-1" id="tambah_transaksi"><i class="fas fa-plus"></i> Tambah Transaksi</a>  
                </div>
            </div>

            <div class="row mt-3 mb-0">
                <div class="col-md-4">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-success text-white">
                        <i class="fa fa-money-check-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header mb-2">
                            <h4>Jumlah Transaksi Penjualan</h4>
                        </div>
                        <div class="card-body jml_penjualan text-right">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-warning text-white">
                        <i class="fa fa-money-bill-wave-alt fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header mb-2">
                            <h4>Total Transaksi Penjualan</h4>
                        </div>
                        <div class="card-body tot_penjualan text-right">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-statistic-1 shadow">
                        <div class="card-icon bg-danger text-white">
                        <i class="fas fa-book-reader fa-2x"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="card-header mb-2">
                            <h4>Total Piutang</h4>
                        </div>
                        <div class="card-body tot_piutang text-right">
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
                        <table class="table table-hover table-striped table-bordered" id="tabel_penjualan" width="100%">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Atas Nama</th>
                                <th>Total Belanja</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
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

        // 03-09-2020

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.daterange').on('change', function () {
            var isi = $(this).val();

            var ar = isi.split(" - ");

            tabel_penjualan.ajax.reload(null, false);
            
            // $.ajax({
            //     url         : "ambil_total",
            //     method      : "POST",
            //     data        : {date_range:ar, aksi:'Pemasukan'},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         // console.log(data.total);
                    
            //         $('.tot_penjualan').text("Rp. "+separator(data.total));

            //     }
            // })

        })

        $('.reset').on('click', function () {
            $('.daterange').val('');

            var date = moment(); //Get the current date
            var df   = date.format("YYYY-MM-DD"); //2014-07-10

            $('.daterange').val(df+" - "+df);
            
            var isi = $('.daterange').val();

            var ar = isi.split(" - ");

            tabel_penjualan.ajax.reload(null, false);
            
            // $.ajax({
            //     url         : "ambil_total",
            //     method      : "POST",
            //     data        : {date_range:ar, aksi:'Pemasukan'},
            //     dataType    : "JSON",
            //     success     : function (data) {

            //         // console.log(data.total);
                    
            //         $('.tot_penjualan').text("Rp. "+separator(data.total));

            //     }
            // })
        })

        // 03-09-2020

        var tabel_penjualan = $('#tabel_penjualan').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Transaksi/tampil_penjualan",
                "type"  : "POST",
                "data"  : function (data) {
                    var isi = $('.daterange').val();

                    var ar = isi.split(" - ");

                    data.date_range = ar;
                    data.id_umkm    = $('#id_umkm').val();
                },
                "dataSrc": function (json) {
                    $('.tot_penjualan').text("Rp. "+separator(json.total));
                    $('.jml_penjualan').text(json.jumlah);
                    $('.tot_piutang').text("Rp. "+separator(json.total_piutang));
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,7],
                "orderable" : false
            }, {
                'targets'   : [0,1,2,4,5,6,7],
                'className' : 'text-center',
            }]

        })

        // 03-09-2020

        $('#tabel_penjualan').on('click', '.detail_trn', function () {
            
            var id_tr = $(this).attr('id_trn');

            $('.f_detail_transaksi').html('');

            // isi modal detail transaksi
            $.ajax({
                url         : "<?= base_url() ?>Transaksi/tampilan_detail_transaksi",
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
                data        : {id_tr:id_tr, aksi:'no_reload'},
                success     : function (data2) {

                    swal.close();
                    
                    $('.f_detail_transaksi').html(data2);
                    $('#modal_detail_transaksi').modal('show');

                }
            })

        })

    })
</script>