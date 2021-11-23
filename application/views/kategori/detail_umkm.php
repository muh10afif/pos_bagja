<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <?php if ($user == 'Bagja'): ?>

                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-th-large mr-3"></i>Kategori  | <?= ucwords($umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">List Kategori</div>
                    </div> 
                <?php else: ?>
                    <h1><i class="fa fa-th-large mr-3"></i>Kategori | <?= ucwords($umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Produk</a></div>
                        <div class="breadcrumb-item"><a href="<?= base_url('Kategori') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item">Detail Kategori</div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h1><i class="fa fa-th-large mr-3"></i>List Kategori</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">Bagja</div>
                    <div class="breadcrumb-item">List Kategori</div>
                </div>
            <?php endif; ?>
            
        </div>
    </section>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-warning shadow" type="button" id="tambah_kategori"><i class="fas fa-plus"></i> Tambah Kategori</button>
        </div>
        <div class="col-md-6 text-right">
            <?php if ($user == 'Bagja' && $hal == ''): ?>
                <a href="<?= base_url('Kategori') ?>" class="btn btn-warning shadow" type="button" id="btn_create_kategori"><i class="fas fa-angle-left mr-2"></i>Kembali</a>
            <?php endif; ?>
        </div>
        <div class="col-md-12 mt-3">
            <div class="alert alert-warning text-center font-weight-bold shadow" role="alert">
                <h5 class="mb-0">Total: <mark style="border-radius: 5px;" class="m-1 jml">0 Kategori</mark></h5>
            </div>
        </div>
    </div>
    <div class="row f_list">
        <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
          <div class="card card-warning shadow">
            <div class="card-body">
              <div class="table-responsive">
                  <table id="tabel_kategori" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr class="text-center">
                              <th width="5%">No.</th>
                              <th>Kategori</th>
                              <th>Status</th>
                              <th width="25%">Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modal_create_kategori" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title font-weight-bold text-white mb-3 title_kategori"></h5>
        <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_create_kategori" autocomplete="off">
            <input type="hidden" name="id_umkm" id="id_umkm" value="<?= $id_umkm ?>">
            <input type="hidden" id="aksi" name="aksi" value="Tambah">
            <input type="hidden" id="id_kategori2" name="id_kategori" value="Tambah">

            <div class="modal-body">

                <div class="form-group row p-1">
                    <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control input_kategori" name="kategori" id="kategori" judul="Nama Kategori" placeholder="Masukkan Nama Kategori">
                        <span class="text-danger" id="kategori_error"></span>
                    </div>
                </div>

                <div class="form-group row mb-0 p-1">
                    <label for="kategori" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <div class="selectgroup w-100" style="border-radius: 10px;">
                            <label class="selectgroup-item">
                                <input type="radio" name="status" id="aktif" value="1" class="selectgroup-input" checked="">
                                <span class="selectgroup-button bg-success" id="s_aktif">Aktif</span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="status" id="non_aktif" value="0" class="selectgroup-input">
                            <span class="selectgroup-button" id="s_non_aktif">Non Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                <button type="button" class="btn btn-warning" id="btn_save_kategori"><i class='fas fa-check mr-2'></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Set Kategori -->
<div class="modal fade" id="modal_set_kategori" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title font-weight-bold text-white mb-3">Tetapkan Produk</h5>
        <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_set_kategori" autocomplete="off">
            <input type="hidden" id="id_kategori" name="id_kategori">
            <div class="modal-body text-center">
                <button type="button" class="btn btn-sm btn-success mr-2" id="select_all"><i class="fas fa-check mr-1"></i>Select All</button>
                <button type="button" class="btn btn-sm btn-danger" id="deselect_all"><i class="fas fa-times mr-1"></i>Deselect All</button>
                <div class="form-group mt-3" align="center">
                    <select multiple="multiple" id="id_produk" name="id_produk[]" class="form-control">
                      <?php foreach($produk as $row) { ?>
                        <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                      <?php } ?>
                    </select>             
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                <button type="button" class="btn btn-warning" id="btn_set_kategori"><i class='fas fa-check mr-2'></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- modal list umkm -->
<div id="modal_produk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="title_list"></h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row table-responsive ml-1">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="tabel_produk" width="100%">
                            <thead class="thead-light">                                 
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
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

<!-- modal set produk -->
<div class="modal fade" id="modal_set_produk" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title font-weight-bold text-white mb-3"><i class="fa fa-check mr-3"></i><span class="t_judul"></span></h5>
        <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <div class="modal-body">

            <div class="form-group row p-3 m-3">
                <label for="kategori" class="col-sm-3 col-form-label">Produk</label>
                <div class="col-sm-9 gif" hidden>
                    <div class="row d-flex justify-content-center" >
                        <img src="<?= base_url('assets/img/loading2.gif') ?>" width="8%">
                    </div>
                </div>
                <div class="col-md-9 nama_produk">
                    <select name="nama_produk" id="nama_produk" class="form-control select2" multiple="">

                    </select>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
            <button type="button" class="btn btn-warning" id="simpan_produk"><i class='fas fa-check mr-2'></i>Simpan</button>
        </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function () {

        // 13-11-2020

        var id_umkm = $('#id_umkm').val();

        var tabel_kategori  = $('#tabel_kategori').DataTable({
            "processing"    : true,
            "ajax"              : {
                "url"   : "<?= base_url() ?>Kategori/tampil_kategori/"+id_umkm,
                "type"  : "POST",
                "dataSrc": function (json) {
                    $(".jml").text(json.jml_kategori+" Kategori"); 
                    return json.data;
                }
            },
            stateSave       : true,
            "order"         : [[ 0, 'asc']],
            "columnDefs"     : [{
                "targets"       : [3],
                "orderable"     : false
            }, {
                "targets"       : [0,2,3],
                "className"     : "text-center"
            }]
        });

        // 18-11-2020
        var tabel_produk  = $('#tabel_produk').DataTable({
            "processing"    : true,
            "ajax"              : {
                "url"   : "<?= base_url() ?>Kategori/tampil_produk",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_kategori = $('#id_kategori2').val();
                }
            },
            stateSave       : true,
            "order"         : [[ 0, 'asc']],
            "columnDefs"     : [{
                "targets"       : [4],
                "orderable"     : false
            }, {
                "targets"       : [0,1,4],
                "className"     : "text-center"
            }
            ],
            bAutoWidth: false, 
            aoColumns : [
                { sWidth: '5%' },
                { sWidth: '40%' },
                { sWidth: '30%' },
                { sWidth: '40%' },
                { sWidth: '15%' },
            ]
        });
        
        // 13-11-2020 & 18-11-2020
        $('#tabel_kategori').on('click', '.set_produk', function () {

            var id_kategori = $(this).data('id');
            var kategori    = $(this).attr('kategori');

            $('.t_judul').text('Kategori '+kategori);
            $('#id_kategori').val(id_kategori);
            $('#modal_set_produk').modal('show');

            $('#nama_produk').val('').trigger('change');

            $('.nama_produk').attr('hidden', true);
            $('.gif').attr('hidden', false);

            // ambil umkm
            $.ajax({
                url     : "<?= base_url() ?>Kategori/ambil_list_produk",
                method  : "POST",
                data    : {id_umkm:id_umkm},
                dataType: "JSON",
                success : function (data) {

                    $('.nama_produk').attr('hidden', false);
                    $('.gif').attr('hidden', true);

                    $('#nama_produk').html(data.option);
                    
                }
            })

            return false;
            
        })

        // 18-11-2020
        $('#simpan_produk').on('click', function () {

            var nama_produk     = $('#nama_produk').val();
            var id_kategori     = $('#id_kategori').val();
            var nama_produk2    = JSON.stringify(nama_produk);

            if (nama_produk.length == 0) {

                swal({
                    title               : "Peringatan",
                    text                : 'Nama Produk harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 700
                }); 

                $('#nama_produk').focus();  

            } else {

                $('#simpan_produk').addClass('btn-progress disabled');

                $.ajax({
                    url     : "<?= base_url() ?>Kategori/simpan_set_produk",
                    type    : "POST",
                    data    : {id_kategori:id_kategori, nama_produk:nama_produk2},
                    dataType: "JSON",
                    success : function (data) {

                        $('#simpan_produk').removeClass('btn-progress disabled');

                        $('#modal_set_produk').modal('hide');
                        
                        swal({
                            title               : "Berhasil",
                            text                : 'Data berhasil disimpan',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-success",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1000
                        });    

                        tabel_kategori.ajax.reload(null,false);        
                        
                    }
                })

                return false;
                
            }
            
        })

        // 13-11-2020
        // menampilkan multi select
        $('#id_produk').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Cari Produk'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Cari Produk'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e){
                  if (e.which === 40){
                    that.$selectableUl.focus();
                    return false;
                  }
                });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e){
                  if (e.which == 40){
                    that.$selectionUl.focus();
                    return false;
                  }
                });
              },
              afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
              },
              afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
        });

        // 13-11-2020
        // select all
        $('#select_all').click(function(){

            $('#id_produk').multiSelect('select_all');
            return false;

        });

        // 13-11-2020
        // deselect all
        $('#deselect_all').click(function(){

            $('#id_produk').multiSelect('deselect_all');
            return false;

        });

        // open modal add kategori
        $('#tambah_kategori').click(function(event) {
            $('#form_create_kategori').trigger('reset');
            $('#modal_create_kategori').modal('show');

            $('.title_kategori').html("<i class='fa fa-plus mr-3'></i>Tambah Kategori");
            
            $('.input_kategori').each(function () {
                
                var aksi  = $(this).attr('id');

                $("#"+aksi+"_error").attr('hidden', true);

            })

            $('#s_aktif').addClass("bg-success text-white");
            $('#s_non_aktif').removeClass("bg-danger text-white");

            $('#aksi').val('Tambah');

        });

        // 13-11-2020
        $('#s_aktif').on('click', function () {

            $(this).addClass("bg-success text-white");
            $('#s_non_aktif').removeClass("bg-danger text-white");
            
        })

        // 13-11-2020
        $('#s_non_aktif').on('click', function () {

            $(this).addClass("bg-danger text-white");
            $('#s_aktif').removeClass("bg-success text-white");
            
        })

        // 13-11-2020 & 18-11-2020
        // create kategori
        $('#btn_save_kategori').click(function(event){

            var angka = -1;

            var i=1;
            $('.input_kategori').each(function () {

                var aksi  = $(this).attr('id');
                var judul = $(this).attr('judul');
                var isi   = $(this).val();

                if (isi == '') {

                    $("#"+aksi+"_error").removeAttr('hidden');
                    
                    $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                    $(this).on('keyup', function () {

                        var isi2   = $('#'+aksi).val();

                        if (isi2 == '') {
                            $("#"+aksi+"_error").attr('hidden', false);
                            $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());
                        } else {
                            $("#"+aksi+"_error").attr('hidden', true);
                        }

                    })

                } else {
                    angka = angka + i;

                    
                }i++;

            })

            if (angka == 0) {

                var form_kategori  = $('#form_create_kategori').serialize();

                $('#btn_save_kategori').addClass('btn-progress disabled');
                
                $.ajax({
                    url     : "<?= base_url() ?>Kategori/simpan_data_kategori",
                    type    : "POST",
                    data    : form_kategori,
                    dataType: "JSON",
                    success : function (data) {

                        $('#btn_save_kategori').removeClass('btn-progress disabled');

                        if (data.status == 'sama') {
                            
                            swal({
                                title               : "Gagal",
                                text                : 'Kategori sudah ada!',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
                            });

                        } else {

                            $('#modal_create_kategori').modal('hide');
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            });    

                            $('.jml').text(data.jumlah+" Kategori");
            
                            tabel_kategori.ajax.reload(null,false);        
                            
                            $('#form_create_kategori').trigger("reset");
                            
                            $('#aksi').val('Tambah');
                        }

                        
                        
                    }
                })
        
                return false;
                
            }
        })

        // 13-11-2020
        $('#tabel_kategori').on('click', '.edit_kategori', function () {
            
            var id_kategori = $(this).data('id');
            var kategori    = $(this).attr('kategori');
            var status      = $(this).attr('status');

            $('.title_kategori').html("<i class='fa fa-pencil-alt mr-3'></i>Ubah Kategori");

            $('#modal_create_kategori').modal('show');
                    
            $('#id_kategori2').val(id_kategori);

            $('#kategori').val(kategori);

            if (status == '1') {
                $('#s_aktif').addClass("bg-success text-white");
                $('#s_non_aktif').removeClass("bg-danger text-white");
            } else {
                $('#s_non_aktif').addClass("bg-danger text-white");
                $('#s_aktif').removeClass("bg-success text-white");
            }

            $("input[name=status][value=" + status + "]").prop('checked', true);

            $('#aksi').val('Ubah');

            $('.input_kategori').each(function () {
        
                var aksi  = $(this).attr('id');

                $("#"+aksi+"_error").attr('hidden', true);

            })
            
        })

        // 18-11-2020
        $('#tabel_kategori').on('click', '.delete_kategori', function () {

            var id_kategori = $(this).data('id');
            var kategori    = $(this).attr('kategori');
            var id_umkm     = $(this).attr('id_umkm');

            swal({
                title       : 'Hapus Kategori!',
                html        : 'Produk kategori <strong>'+kategori+'</strong> akan terhapus juga, apakah yakin?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-success mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>Kategori/simpan_data_kategori",
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
                        data        : {aksi:'Hapus', id_kategori:id_kategori, id_umkm:id_umkm},
                        dataType    : "JSON",
                        success     : function (data) {

                                $('.jml').text(data.jumlah+" Kategori");

                                tabel_kategori.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus Kategori dan Produk',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

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

        // 18-11-2020
        $('#tabel_kategori').on('click', '.detail_produk', function () {

            var id_kat      = $(this).data('id');
            var kategori    = $(this).attr('kategori');

            $('#id_kategori2').val(id_kat);

            $('#title_list').html("<i class='fa fa-list-ol mr-3'></i>Produk kategori "+kategori);
            $('#tabel_produk tbody').empty();
            tabel_produk.ajax.reload(null, false);

            $('#modal_produk').modal('show');
            
        })

        // 18-11-2020
        $('#tabel_produk').on('click', '.remove_produk', function () {

            var id_produk = $(this).data('id');

            $('#remove'+id_produk).addClass('btn-progress disabled');

            $.ajax({
                url     : "<?= base_url() ?>Kategori/remove_produk",
                method  : "POST",
                data    : {id_produk:id_produk},
                dataType: "JSON",
                success : function (data) {

                    $('#remove'+id_produk).removeClass('btn-progress disabled');
                    tabel_produk.ajax.reload(null, false);
                    tabel_kategori.ajax.reload(null, false);
                }
            })

            return false;
            
        })
    })
</script>