<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            
            <?php if ($hal == 'detail off') : ?>
                <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Split | <?= ucwords($nama_umkm) ?></h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bagja</div>
                    <div class="breadcrumb-item active">Laporan Split</div>
                </div> 
            <?php else: ?>
                <h1 class=""><i class="fa fa-file-alt mr-3"></i>Laporan Split</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">Bagja</div>
                    <div class="breadcrumb-item">Laporan Split</div>
                </div>
            <?php endif; ?>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <form action="<?= base_url('laporan/download_file_split') ?>" method="post">
                            <input type="hidden" id="aksi" name="jenis">
                            <input type="hidden" id="id_umkm" name="id_umkm" value="<?= $id_umkm ?>">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    
                                    <div class="col-md-5">
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
                                    <?php if ($this->session->userdata('nama') == 'Bagja') : ?>
                                        <?php if ($this->session->userdata('hal') == ''): ?>
                                            <div class="col-md-3 f_umkm" style="display: none;">
                                                <select name="umkm" id="umkm" class="form-control select2">
                                                    <option value="">Pilih UMKM</option>
                                                </select>
                                            </div>
                                        <?php endif; ?>  
                                    <?php endif; ?>  
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

            <div class="row">
                <div class="col-12">
                <div class="card card-warning shadow">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabel_umkm" width="100%">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th width='10%'>Aksi</th>
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

<div id="modal_detail_split" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content f_detail_split">
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // 06-12-2020
        var tabel_umkm = $('#tabel_umkm').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Laporan/tampil_umkm_split",
                "type"  : "POST",
                "data"  : function (data) {
                    var isi = $('.daterange').val();

                    var tgl = isi.split(" - ");

                    data.date_range = tgl;
                    data.id_umkm    = $('#id_umkm').val();
                },
                "dataSrc": function (json) {
                    if (json.jumlah > 0) {
                        $('.btn_laporan').slideDown();
                        $('.f_umkm').slideDown();
                    } else {
                        $('.btn_laporan').slideUp();
                        $('.f_umkm').slideUp();
                    }
                    $("#umkm").html(json.list_umkm); 
                    return json.data;
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

        // 06-12-2020
        $('.daterange').on('change', function () {

            tabel_umkm.ajax.reload(null, false);

        })

        // 06-12-2020
        $('.reset').on('click', function () {
            
            $('.daterange').val('');

            var date = moment(); //Get the current date
            var df   = date.format("YYYY-MM-DD"); //2014-07-10

            $('.daterange').val(df+" - "+df);
            
            var isi = $('.daterange').val();

            var ar = isi.split(" - ");

            tabel_umkm.ajax.reload(null, false);

        })

        // 07-12-2020
        $('#umkm').on('change', function () {

            var id_umkm = $('#umkm').val();

            $('#id_umkm').val(id_umkm);

            tabel_umkm.ajax.reload(null, false);
            
        })

        // 07-12-2020
        $('#tabel_umkm').on('click', '.detail', function () {

            var id_produk   = $(this).attr('id_produk');
            var id_umkm     = $(this).attr('id_umkm');
            var qty         = $(this).attr('qty');
            var nama_produk = $(this).attr('nama_produk');

            $('.f_detail_split').html('');

            // isi modal detail split
            $.ajax({
                url         : "<?= base_url() ?>Laporan/tampilan_detail_split",
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
                data        : {id_produk:id_produk, id_umkm:id_umkm, qty:qty, nama_produk:nama_produk},
                success     : function (data) {

                    swal.close();
                    
                    $('.f_detail_split').html(data);
                    $('#modal_detail_split').modal('show');

                }
            })
            
        })

        // 07-12-2020
        $('button[name="export"]').on('click', function () {
            var jns = $(this).attr('data');

            $('#aksi').val(jns);
        })
        
    })
</script>