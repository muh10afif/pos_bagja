<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Detail Pengeluaran</h5>
    <button class="close p-3" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <input type="hidden" id="aksi_tambah2" value="<?= $aksi_tambah ?>">
    <input type="hidden" id="id_umkm2" value="<?= $id_umkm ?>">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-hover table-borderless table-sm">
                <tbody>
                <tr>
                    <th scope="row" width="35%">Tanggal</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold"><?= nice_date($trn['created_at'], 'd F Y H:i:s'); ?></td>
                    <input type="hidden" id="tgl_trn" value="<?= nice_date($trn['created_at'], 'Y-m-d'); ?>">
                </tr>
                <tr>
                    <th scope="row">Kode Transaksi</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $trn['code_trn'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2 mb-2">
            <div class="progress" data-height="5" style="height: 5px;">
                <div class="progress-bar bg-warning" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-12 table-responsive mt-2">
            <input type="hidden" id="id_trn2" value="<?= $trn['id'] ?>">
            <button class="btn float-right btn-warning btn-sm tambah_pro mb-2 mr-2" data-id="<?= $trn['id'] ?>" hidden><i class="fa fa-plus fa-sm" ></i></button>
            <input type="hidden" id="jml_data" value="<?= count($list) ?>">
            <table class="table table-hover table-sm">
                <tbody>
                    <?php $no=1; foreach ($list as $k): ?>
                        <tr class="font-weight-bold">
                            <th scope="row" colspan="2"><?= $k['nama'] ?></th>
                            <th width="20%">
                                <div class="text-right">
                                <button class="btn btn-danger btn-sm hapus_pro" data-id="<?= $k['id'] ?>" hidden>
                                <i class="fa fa-trash fa-sm"></i>
                                </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td align="left"><?= $k['qty'] ?> x <?= number_format($k['harga'],0,'.','.') ?></td>
                            <td align="right"></td>
                            <td align="right"><?= number_format($k['sub_total'],0,'.','.') ?></td>
                        </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2">
            <div class="progress" data-height="5" style="height: 5px;">
                <div class="progress-bar bg-warning" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-12 table-responsive mt-3 d-flex justify-content-center">
            <table class="table table-hover table-borderless table-sm">
                <tbody>
                    <tr>
                        <th scope="row" width="35%">Total Bayar</th>
                        <td class="font-weight-bold">: Rp.</td>
                        <td class="text-right font-weight-bold"><?= number_format($trn['total_transaksi'],0,'.','.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class='fa fa-times-circle fa-lg mr-2'></i>Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        // 04-09-2020

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        
        $('.tambah_pro').on('click', function () {

            var id_trn      = $(this).data('id');
            var tgl_trn     = $('#tgl_trn').val();
            var aksi_tambah = "baru_kedua";

            $('#modal_detail_transaksi').modal('hide');
            $('#modal_pengeluaran').modal('show');

            $('#tgl_bayar').val(tgl_trn).attr('disabled', true);
            $('#tgl_bayar2').val(tgl_trn);
            $('.aksi_tambah').val(aksi_tambah);
            $('.close_tambah').attr('aksi_tambah', 'baru_kedua');
            $('#id_transaksi').val(id_trn);

            $('#simpan_pengeluaran').removeClass('btn-progress disabled').attr('disabled', true);

        })

        // 04-09-2020

        $('.hapus_pro').on('click', function () {
            
            var id_tr       = $(this).data('id');
            var id_trn2     = $('#id_trn2').val();
            var jml_data    = $('#jml_data').val();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>Transaksi/simpan_data_pengeluaran",
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
                        data        : {aksi:'Hapus', id_transaksi_kedua:id_tr, id_trn2:id_trn2, jml_data:jml_data},
                        dataType    : "JSON",
                        success     : function (data) {

                            var id_transaksi = data.id_trn;

                            if (id_transaksi == 0) {

                                swal.close();

                                var tabel_pengeluaran = $('.tabel_pengeluaran').DataTable({
                                    "processing"        : true,
                                    "serverSide"        : true,
                                    "order"             : [],
                                    "ajax"              : {
                                        "url"   : "<?= base_url() ?>Transaksi/tampil_pengeluaran",
                                        "type"  : "POST",
                                        "data"  : function (data) {
                                            var isi = $('.daterange').val();

                                            var ar = isi.split(" - ");

                                            data.date_range = ar;
                                            data.id_umkm    = $('#id_umkm2').val();
                                        },
                                        "dataSrc": function (json) {
                                            $('.tot_pengeluaran').text("Rp. "+separator(json.total));
                                            $('.jml_pengeluaran').text(json.jumlah);
                                            return json.data;
                                        }
                                    },
                                    "columnDefs"        : [{
                                        "targets"   : [0,4],
                                        "orderable" : false
                                    }, {
                                        'targets'   : [0,1,2,3,4],
                                        'className' : 'text-center',
                                    }],
                                    "bDestroy"  : true

                                })

                                tabel_pengeluaran.ajax.reload(null, false);
                                
                                $('#modal_detail_transaksi').modal('hide');
                                
                            } else {

                                $('.f_detail_transaksi').html('');

                                // isi modal detail transaksi
                                $.ajax({
                                    url         : "<?= base_url() ?>Transaksi/tampilan_detail_transaksi_pengeluaran",
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
                                    data        : {id_tr:id_transaksi, aksi_tambah:"baru_kedua"},
                                    success     : function (data2) {

                                        swal.close();

                                        var tabel_pengeluaran = $('.tabel_pengeluaran').DataTable({
                                            "processing"        : true,
                                            "serverSide"        : true,
                                            "order"             : [],
                                            "ajax"              : {
                                                "url"   : "<?= base_url() ?>Transaksi/tampil_pengeluaran",
                                                "type"  : "POST",
                                                "data"  : function (data) {
                                                    var isi = $('.daterange').val();

                                                    var ar = isi.split(" - ");

                                                    data.date_range = ar;
                                                    data.id_umkm    = $('#id_umkm2').val();
                                                },
                                                "dataSrc": function (json) {
                                                    $('.tot_pengeluaran').text("Rp. "+separator(json.total));
                                                    $('.jml_pengeluaran').text(json.jumlah);
                                                    return json.data;
                                                }
                                            },
                                            "columnDefs"        : [{
                                                "targets"   : [0,4],
                                                "orderable" : false
                                            }, {
                                                'targets'   : [0,1,2,3,4],
                                                'className' : 'text-center',
                                            }],
                                            "bDestroy"  : true

                                        })

                                        tabel_pengeluaran.ajax.reload(null, false);
                                        
                                        $('.f_detail_transaksi').html(data2);
                                        $('#modal_detail_transaksi').modal('show');

                            
                                        $('#form-pengeluaran').trigger("reset");
                                        
                                        $('#aksi').val('Tambah');

                                        // var isi = $('.daterange').val();

                                        // var ar = isi.split(" - ");
                                        
                                        // $.ajax({
                                        //     url         : "<?= base_url() ?>Transaksi/ambil_total",
                                        //     method      : "POST",
                                        //     data        : {date_range:ar, aksi:'Pengeluaran'},
                                        //     dataType    : "JSON",
                                        //     success     : function (data3) {

                                        //         console.log(data3.total);
                                                
                                        //         $('.tot_pengeluaran').text("Rp. "+separator(data3.total));

                                        //     }
                                        // })

                                    }
                                })    

                            }
                            
                        },
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus data',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

        })

    })
</script>

