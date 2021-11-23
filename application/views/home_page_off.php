<style>
    textarea.form-control {
        height: 100px !important;
    }
</style>
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

            <a href="javascript:;" class="btn btn-icon icon-left btn-warning mb-3 shadow" id="tambah_umkm"><i class="fas fa-plus"></i> Tambah UMKM</a>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tabel-umkm" width="100%">
                                <thead class="thead-light">                                 
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama UMKM</th>
                                        <th>Nama Owner</th>
                                        <th>Nomor Telepon</th>
                                        <th width="30%">Alamat</th>
                                        <th width="15%">Aksi</th>
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

<!-- modal -->
<div id="modal-umkm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">umkm</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-umkm">
                <input type="hidden" id="id_kategori">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_umkm" name="id_umkm" value="Tambah">
                <div class="modal-body">
                    <div class="row p-3 mt-2 d-flex justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Umkm</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input_umkm" id="nama_umkm" name="nama_umkm" judul="Nama Umkm" placeholder="Masukkan Nama Umkm">
                                    <span class="text-danger" id="nama_umkm_error"></span>
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Owner</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input_umkm" id="nama_owner" name="nama_owner" judul="Nama Owner" placeholder="Masukkan Nama Owner">
                                    <span class="text-danger" id="nama_owner_error"></span>
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input_umkm numeric" id="telp" name="telp" judul="Nomer Telepon" placeholder="Masukkan Nomor Telepon">
                                    <span class="text-danger" id="telp_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control input_umkm" name="alamat" id="alamat" judul="Alamat"  placeholder="Masukkan Alamat"></textarea>
                                    <span class="text-danger" id="alamat_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kategori Usaha</label>
                                <div class="col-sm-9">
                                    <select name="kat_usaha" id="kat_usaha" judul="Kategori Usaha" class="form-control select2 input_umkm" style="width: 100%;">
                                        <option value="">Masukkan Kategori Usaha</option>
                                        <?php foreach ($kat_usaha as $k): ?>
                                            <option value="<?= $k['jenis'] ?>"><?= $k['jenis'] ?></option>
                                        <?php endforeach; ?>
                                        
                                    </select>
                                    <span class="text-danger" id="kat_usaha_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Usaha</label>
                                <div class="col-sm-9">
                                    <select name="jns_usaha" id="jns_usaha" judul="Jenis Usaha" class="form-control select2 input_umkm" style="width: 100%;" disabled>
                                        <option value="">Masukkan Jenis Usaha</option>
                                    </select>
                                    <span class="text-danger" id="jns_usaha_error"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-warning" id="simpan_umkm"><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        // 11-11-2020
        var tabel_umkm = $('#tabel-umkm').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Home/tampil_data_umkm",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }]

        })
        
        // 12-11-2020
        $('#kat_usaha').on('change', function () {

            var isi     =  $(this).val();
            var id_kat  =  $('#kat_usaha').attr('id_kategori');

            if (isi == '') {
                $('#jns_usaha').attr('disabled', true);
                $('#kat_usaha_error').attr('hidden', false);
            } else {
                $('#jns_usaha').attr('disabled', false);
                $('#kat_usaha_error').attr('hidden', true);
            }

            
            $('#kat_usaha_error').attr('hidden', true);
            $('#jns_usaha_error').attr('hidden', false);

            $.ajax({
                url     : "<?= base_url() ?>Home/ambil_list_nama_kategori",
                data    : {jenis:isi, id_kategori:id_kat},
                type    : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('#jns_usaha').html(data.list_nama_kategori);
                    
                }
            })
    
            return false;
            
        })

        // 12-11-2020
        $('#jns_usaha').on('change', function () {
            
            var isi =  $(this).val();

            if (isi == '') {
                $('#jns_usaha_error').attr('hidden', false);
            } else {
                $('#jns_usaha_error').attr('hidden', true);
            }

            $('#jns_usaha_error').attr('hidden', true);
            
        })

        // 11-11-2020
        $('.numeric').numericOnly();

        $('#tambah_umkm').on('click', function () {
            $('#modal-umkm').modal('show');
            $('#my-modal-title').html("<i class='fa fa-plus mr-3'></i>Tambah Umkm");

            $('#form-umkm').trigger('reset');

            $('.input_umkm').each(function () {
                
                var aksi  = $(this).attr('id');

                $("#"+aksi+"_error").attr('hidden', true);

            })

            $('#jns_usaha_error').attr('hidden', true);
            $('#kat_usaha_error').attr('hidden', true);

            $('#kat_usaha').val('').trigger('change');
            $('#jns_usaha').val('').trigger('change').attr('disabled', true);

        })

        $('#simpan_umkm').on('click', function () {
            
            var angka = -1;

            var i=1;
            $('.input_umkm').each(function () {

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
                }
                
                i++;

            })

            if (angka == 20) {

                var form_umkm  = $('#form-umkm').serialize();

                $('#simpan_umkm').addClass('btn-progress disabled');
                
                $.ajax({
                    url     : "<?= base_url() ?>Home/simpan_data_umkm",
                    type    : "POST",
                    data    : form_umkm,
                    dataType: "JSON",
                    success : function (data) {

                        $('#simpan_umkm').removeClass('btn-progress disabled');

                        $('#modal-umkm').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        });    
        
                        tabel_umkm.ajax.reload(null,false);        
                        
                        $('#form-umkm').trigger("reset");

                        $('#kat_usaha').val('').trigger('change');
                        $('#jns_usaha').val('').trigger('change').attr('disabled', true);

                        $('#id_kategori').val('');
                        
                        $('#aksi').val('Tambah');
                        
                    }
                })
        
                return false;

            }


        })

        // edit data umkm
        $('#tabel-umkm').on('click', '.edit-umkm', function () {

            $('#my-modal-title').html("<i class='fa fa-pencil-alt mr-3'></i>Ubah Umkm");

            var id_umkm = $(this).data('id');
            var jenis   = $(this).attr('jenis');
            var id_kat  = $(this).attr('id_kat');
            $('#kat_usaha').attr('id_kategori', id_kat);

            $.ajax({
                url         : "<?= base_url() ?>Home/ambil_data_umkm/"+id_umkm,
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
                    swal.close();

                    $('#modal-umkm').modal('show');
                    
                    $('#id_umkm').val(data.id);

                    $('#nama_umkm').val(data.nama);
                    $('#nama_owner').val(data.namaowner);
                    $('#telp').val(data.telp);
                    $('#alamat').val(data.alamat);

                    $('#kat_usaha').val(jenis).trigger('change');
                    
                    $('#aksi').val('Ubah');

                    $('.input_umkm').each(function () {
                
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

        // hapus bahan
        $('#tabel-umkm').on('click', '.hapus-umkm', function () {

            var id_umkm = $(this).data('id');
            var umkm    = $(this).attr('umkm');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus umkm '+umkm+' ?',
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
                        url         : "<?= base_url() ?>Home/simpan_data_umkm",
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
                        data        : {aksi:'Hapus', id_umkm:id_umkm},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_umkm.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus umkm',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#form-umkm').trigger("reset");
                                $('#kat_usaha').val('').trigger('change');
                                $('#jns_usaha').val('').trigger('change').attr('disabled', true);

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
                            text                : 'Anda membatalkan hapus umkm',
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