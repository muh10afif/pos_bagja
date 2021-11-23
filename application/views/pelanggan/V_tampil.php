<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            
            <?php if ($user == 'Bagja'): ?>

                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-users mr-3"></i>Pelanggan  | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">List Pelanggan</div>
                    </div> 
                <?php else: ?>
                    <h1 class=""><i class="fa fa-users mr-3"></i>Pelanggan | <?= ucwords($nama_umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="<?= base_url('Pelanggan') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item active">Pelanggan</div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h1 class=""><i class="fa fa-users mr-3"></i>Pelanggan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">Bagja</div>
                    <div class="breadcrumb-item active"><?= $title ?></div>
                </div>  
            <?php endif; ?>
        
        </div>

        <div class="section-body">
            
            <a href="javascript:;" class="btn btn-icon icon-left btn-warning mb-3 shadow" id="tambah_pelanggan"><i class="fas fa-plus"></i> Tambah Pelanggan</a>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card card-warning shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tabel-pelanggan" width="100%">
                                <thead class="thead-light">                                 
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nomor Telepon</th>
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

<!-- 25-08-2020 -->

<!-- modal -->
<div id="modal-pelanggan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Pelanggan</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-pelanggan">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="Tambah">
                <input type="hidden" id="id_umkm" name="id_umkm" value="<?= $id_umkm ?>">
                <div class="modal-body">
                    <div class="row p-3 mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" class="form-control input_pelanggan" id="nama" name="nama" judul="Nama Pelanggan" placeholder="Masukkan Nama Pelanggan">
                                <span class="text-danger" id="nama_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control input_pelanggan numeric" id="telp" name="telp" judul="Nomer Telepon" placeholder="Masukkan Nomor Telepon">
                                <span class="text-danger" id="telp_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-warning" id="simpan_pelanggan"><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        var tabel_pelanggan = $('#tabel-pelanggan').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Pelanggan/tampil_data_pelanggan",
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
        

        // 25-08-2020

        $('.numeric').numericOnly();

        $('#tambah_pelanggan').on('click', function () {
            $('#modal-pelanggan').modal('show');
            $('#my-modal-title').html("<i class='fa fa-plus mr-3'></i>Tambah Pelanggan");

            $('#form-pelanggan').trigger('reset');

            $('.input_pelanggan').each(function () {
                
                var aksi  = $(this).attr('id');

                $("#"+aksi+"_error").attr('hidden', true);

            })

            $('#aksi').val('Tambah');

        })

        $('#simpan_pelanggan').on('click', function () {

            // var nama = $('#nama').val();
            // var telp = $('#telp').val();

            // if (nama == '') {
                
            //     $('#nama').focus();

            //     swal({
            //         title               : "Peringatan",
            //         text                : 'Nama harus terisi !',
            //         buttonsStyling      : false,
            //         type                : 'warning',
            //         showConfirmButton   : false,
            //         timer               : 700
            //     }); 
                

            // } else if (telp == '') {

            //     $('#telp').focus();

            //     swal({
            //         title               : "Peringatan",
            //         text                : 'Telepon harus terisi !',
            //         buttonsStyling      : false,
            //         type                : 'warning',
            //         showConfirmButton   : false,
            //         timer               : 700
            //     }); 

            // }
            
            var angka = -1;

            var i=1;
            $('.input_pelanggan').each(function () {

                var aksi  = $(this).attr('id');
                var judul = $(this).attr('judul');
                var isi   = $(this).val();

                if (isi == '') {

                    $("#"+aksi+"_error").removeAttr('hidden');
                    
                    $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                    $(this).on('keyup', function () {

                        if (isi != '') {
                            $("#"+aksi+"_error").removeAttr('hidden');
                            $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());
                        } else {
                            $("#"+aksi+"_error").attr('hidden', true);
                        }

                    })

                } else {
                    angka = angka + i;

                    i++;
                }

            })

            if (angka == 2) {

                var form_pelanggan  = $('#form-pelanggan').serialize();
                
                $.ajax({
                    url     : "<?= base_url() ?>Pelanggan/simpan_data_pelanggan",
                    type    : "POST",
                    beforeSend  : function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses Data',
                            onOpen  : () => {
                                swal.showLoading();
                            }
                        })
                    },
                    data    : form_pelanggan,
                    dataType: "JSON",
                    success : function (data) {

                        $('#modal-pelanggan').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        });    
        
                        tabel_pelanggan.ajax.reload(null,false);        
                        
                        $('#form-pelanggan').trigger("reset");
                        
                        $('#aksi').val('Tambah');
                        
                    }
                })
        
                return false;

            }


        })

        // edit data pelanggan
        $('#tabel-pelanggan').on('click', '.edit-pelanggan', function () {

            var id_bahan  = $(this).data('id');

            $.ajax({
                url         : "<?= base_url() ?>Pelanggan/ambil_data_pelanggan/"+id_bahan,
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

                    $('#modal-pelanggan').modal('show');
                    
                    $('#id_pelanggan').val(data.id);

                    $('#nama').val(data.nama);
                    $('#telp').val(data.telp);

                    $('#aksi').val('Ubah');

                    $('.input_pelanggan').each(function () {
                
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

        // hapus pelanggan
        $('#tabel-pelanggan').on('click', '.hapus-pelanggan', function () {

            var id_pelanggan    = $(this).data('id');
            var nama            = $(this).attr('nama');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus pelanggan '+nama+' ?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-success mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>Pelanggan/simpan_data_pelanggan",
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
                        data        : {aksi:'Hapus', id_pelanggan:id_pelanggan},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_pelanggan.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus pelanggan',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form-pelanggan').trigger("reset");

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
                            text                : 'Anda membatalkan hapus pelanggan',
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