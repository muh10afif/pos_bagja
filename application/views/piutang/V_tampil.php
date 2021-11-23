<div class="main-content">
    <section class="section">
        <div class="section-header shadow">

            <?php if ($user == 'Bagja'): ?>
                
                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-money-check mr-3"></i>Piutang | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">List Piutang</div>
                    </div>
                <?php else: ?>
                    <h1 class=""><i class="fa fa-money-check mr-3"></i>Piutang | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="<?= base_url('Piutang') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item active">Piutang</div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h1 class=""><i class="fa fa-money-check mr-3"></i>Piutang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bagja</div>
                    <div class="breadcrumb-item active"><?= $title ?></div>
                </div>  
            <?php endif; ?>
            
        </div>

        <div class="section-body">

            <a href="javascript:;" class="btn btn-icon icon-left btn-warning mb-3 shadow" id="tambah_piutang"><i class="fas fa-plus"></i> Bayar piutang</a>

            <div class="row mt-2">
                <div class="col-12">
                <div class="card card-warning shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tabel-piutang" width="100%">
                            <thead class="thead-light">                                 
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tot Piutang</th>
                                    <th width="20%">Aksi</th>
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

<!-- 05-09-2020 -->

<!-- modal -->
<div id="modal-piutang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">piutang</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-piutang">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_piutang" name="id_piutang" value="Tambah">
                <input type="hidden" id="id_umkm" name="id_umkm" value="<?= $id_umkm ?>">
                <div class="modal-body">
                    <div class="row p-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_bayar">Tanggal Bayar</label>
                                <input type="text" class="form-control datepicker" id="tgl_bayar" name="tgl_bayar" placeholder="Masukkan Tanggal Bayar">
                                <span class="text-danger" id="tgl_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idpelanggan">Nama Pelanggan</label>
                                <select class="form-control select2" id="idpelanggan" name="idpelanggan">
                                        <option value="" tot_piutang="">Pilih Pelanggan</option>
                                    <?php foreach ($list_nama as $n): ?>
                                        <option value="<?= $n['id'] ?>" tot_piutang="<?= $n['tot_piutang'] ?>"><?= $n['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger" id="nama_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bayar">Nominal Bayar</label>
                                <input type="text" class="form-control number_separator numeric" id="bayar" name="bayar" placeholder="Masukkan Nominal" disabled>
                                <span class="text-danger" id="telp_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sisa_piutang">Sisa Piutang</label>
                                <input type="text" class="form-control number_separator numeric" id="sisa_piutang" name="sisa_piutang" value="0" disabled>
                                <span class="text-danger" id="sisa_piutang_error"></span>
                            </div>
                        </div>
                        <input type="hidden" id="tot_piutang">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                <button type="button" class="btn btn-success" id="simpan_piutang"><i class='fas fa-check mr-2'></i>Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- 07-09-2020 -->

<div id="modal_detail_piutang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content f_detail_piutang">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="judul">Detail Piutang</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-2">
                <input type="hidden" id="id_pelanggan">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tabel_detail_piutang" width="100%">
                    <thead class="thead-light">                                 
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal Bayar</th>
                            <th>Bayar</th>
                            <th>Sisa Piutang</th>
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

<script>
    $(document).ready(function () {
        
        // 05-09-2020

        var tabel_piutang = $('#tabel-piutang').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Piutang/tampil_data_piutang",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_umkm    = $('#id_umkm').val();
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

        // 07-09-2020
        var tabel_detail_piutang = $('#tabel_detail_piutang').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Piutang/tampil_data_detail_piutang",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_pelanggan = $('#id_pelanggan').val();
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
        
        // 05-09-2020

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.numeric').numericOnly();

        $('#tambah_piutang').on('click', function () {

            $('#modal-piutang').modal('show');
            $('#my-modal-title').html("<i class='fa fa-plus mr-3'></i>Tambah piutang");

            $('#form-piutang').trigger('reset');

            $('#simpan_piutang').removeClass('btn-progress disabled');
            $('#idpelanggan').val("").trigger("change")

            var id_umkm = $('#id_umkm').val();

            $.ajax({
                url     : "<?= base_url() ?>Piutang/ambil_list_pelanggan",
                data    : {id_umkm:id_umkm},
                type    : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('#idpelanggan').html(data.list_pl);
                    
                }
            })
    
            return false;

        })

        $('#simpan_piutang').on('click', function () {

            var tgl_bayar       = $('#tgl_bayar').val();
            var id_pel          = $('#idpelanggan').val();
            var id_umkm         = $('#id_umkm').val();
            var bayar           = parseInt($('#bayar').val());

            var id_pelanggan    = $(".select2 option:selected").val();
            var nama_pel        = $(".select2 option:selected").text();
            var tot_piutang     = parseInt($(".select2 option:selected").attr('tot_piutang'));

            if (tgl_bayar == '') {
                
                swal({
                    title               : "Peringatan",
                    text                : 'Tanggal bayar harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 
                
                $('#tgl_bayar').focus();

            } else if (id_pel == '') {

                $('#idpelanggan').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Pelanggan harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

            } else if (isNaN(bayar)) {

                $('#bayar').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Nominal bayar harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

            } else {
                
                var form_piutang  = $('#form-piutang').serialize();

                $('#simpan_piutang').addClass('btn-progress disabled');
                
                $.ajax({
                    url     : "<?= base_url() ?>Piutang/simpan_data_piutang",
                    type    : "POST",
                    // beforeSend  : function () {
                    //     swal({
                    //         title   : 'Menunggu',
                    //         html    : 'Memproses Data',
                    //         onOpen  : () => {
                    //             swal.showLoading();
                    //         }
                    //     })
                    // },
                    data    : {tgl_bayar:tgl_bayar, idpelanggan:id_pelanggan,bayar:bayar, tot_piutang:tot_piutang, id_umkm:id_umkm, nama_pel:nama_pel},
                    dataType: "JSON",
                    success : function (data) {

                        $('#simpan_piutang').removeClass('btn-progress disabled');

                        $('#modal-piutang').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 700
                        });    
        
                        tabel_piutang.ajax.reload(null,false);        
                        
                        $('#form-piutang').trigger("reset");
                        
                        $('#aksi').val('Tambah');

                        $('#idpelanggan').html(data.list_pl);
                        
                    }
                })
        
                return false;

            }

        })

        // edit data piutang
        $('#tabel-piutang').on('click', '.edit-piutang', function () {

            var id_bahan  = $(this).data('id');

            $.ajax({
                url         : "<?= base_url() ?>Piutang/ambil_data_piutang/"+id_bahan,
                type        : "GET",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                dataType    : "JSON",
                success     : function(data)
                {
                    console.log(data);

                    swal.close();

                    $('#modal-piutang').modal('show');
                    
                    $('#id_piutang').val(data.id);

                    $('#nama').val(data.nama);
                    $('#telp').val(data.telp);

                    $('#aksi').val('Ubah');

                    $('.input_piutang').each(function () {
                
                        var aksi  = $(this).attr('id');

                        $("#"+aksi+"_error").attr('hidden', true);

                    })

                    return false;

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            })

            return false;

        })

        // hapus piutang
        $('#tabel-piutang').on('click', '.hapus-piutang', function () {

            var id_piutang = $(this).data('id');

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
                        url         : "<?= base_url() ?>Piutang/simpan_data_piutang",
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
                        data        : {aksi:'Hapus', id_piutang:id_piutang},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_piutang.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus piutang',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form-piutang').trigger("reset");

                                $('#aksi').val('Tambah');
                            
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
                            text                : 'Anda membatalkan hapus piutang',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

        })

        // 07-09-2020
        function ucwords (str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        $('#tabel-piutang').on('click', '.detail-piutang', function () {
            
            var id_pelanggan = $(this).data('id'); 
            var nama         = $(this).attr('nama'); 

            $('#id_pelanggan').val(id_pelanggan);
            $('#judul').text('Detail Piutang '+ucwords(nama));
            $('#modal_detail_piutang').modal('show');

            $('#tabel_detail_piutang tbody').empty();

            tabel_detail_piutang.ajax.reload(null, false);

        })

        // 06-09-2020
        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 06-09-2020 07-09-2020
        $('#idpelanggan').on('change', function () {
            
            var tot_piutang  = $(".select2 option:selected").attr('tot_piutang');
            var isi          = $('#bayar').val().replace('.','');
            var piutang      = $('#tot_piutang').val();
            
            if (tot_piutang == '') {
                $('#bayar').val('');
                $('#sisa_piutang').val(0);
                $('#bayar').attr('disabled', true);
            } else {
                $('#bayar').val('');
                $('#bayar').attr('disabled', false);
                $('#sisa_piutang').val(separator(tot_piutang));
            }

            $('#tot_piutang').val(tot_piutang);
            $('#sisa_piutang_error').text('');

        })

        // 07-09-2020
        $('#bayar').on('keyup', function () {
            
            var isi          = $(this).val().replace('.','');
            var piutang      = $('#tot_piutang').val();
            var sisa_piutang = $('#sisa_piutang').val().replace('.',''); 

            var sisa_piutang  = piutang - isi;

            if (sisa_piutang < 0) {
                $('#sisa_piutang_error').text('Sisa piutang tidak boleh minus (-) atau kurang dari nol!');
                $('#simpan_piutang').attr("disabled", true);
            } else {
                $('#sisa_piutang_error').text('');
                $('#simpan_piutang').attr("disabled", false);
            }

            $('#sisa_piutang').val(separator(sisa_piutang));
            
        })

    })
</script>