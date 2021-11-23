<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1><i class="fa fa-boxes mr-3"></i><?php echo $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
    <div id="main">
        <div class="row mb-3">
            <div class="col-lg-2 col-md-2 col-xs-2">
                <select id="kategori_filter" name="kategori_filter" class="form-control shadow">
                    <option value="all">Semua Kategori</option>
                    <?php foreach ($kategori as $row) { ?>
                        <option value="<?php echo $row->id ?>"><?php echo $row->kategori ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-2">
                <button class="btn btn-warning mt-1 shadow" type="button" id="btn_create_produk"><i class="fas fa-plus"></i> Tambah Produk</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-hover table-striped table-bordered w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th width="3%">No.</th>
                                        <th>Nama Produk</th>
                                        <th>Stok</th>
                                        <th>Harga Dasar</th>
                                        <th>Harga Jual</th>
                                        <th width="20%">Aksi</th>
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
</div>
<!-- Modal Upload -->
<div class="modal fade" id="modal_upload" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title font-weight-bold text-white">Upload Data Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <form id="upload_data" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="data-excel" class="control-label">Pilih File</label>
                    <input type="file" class="form-control-file" id="data-excel" name="data-excel">
                </div>
                <a href="javascript:;" class="btn btn-success"><i class="fas fa-upload"></i> Download Template</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="import_data">Upload Data</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal Tambah Produk -->
<div class="modal fade" id="modal_produk" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title font-weight-bold text-white mb-3" id="judul_modal">Tambah Data Produk</h5>
        <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_produk" autocomplete="off">
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" id="method" value="create">
                    <label for="nama" class="control_label">Nama Produk</label>
                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="hpp" class="control_label">Harga Pokok Penjualan</label>
                    <input type="text" class="form-control" name="hpp" id="hpp" autocomplete="off">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="harga" class="control_label">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" autocomplete="off">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="id_kategori" class="control_label">Kategori</label>
                    <select id="id_kategori" name="id_kategori" class="form-control">
                        <option selected disabled hidden>--PILIH--</option>
                        <?php foreach ($kategori as $row) { ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->kategori ?></option>
                        <?php } ?>
                    </select>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="h_stok" class="control_label">Stok</label>
                    <select id="h_stok" name="h_stok" class="form-control">
                        <option selected disabled hidden>--PILIH--</option>
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="h_topping" class="control_label">Topping</label>
                    <select id="h_topping" name="h_topping" class="form-control">
                        <option selected disabled hidden>--PILIH--</option>
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="h_ukuran" class="control_label">Ukuran</label>
                    <select id="h_ukuran" name="h_ukuran" class="form-control">
                        <option selected disabled hidden>--PILIH--</option>
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="h_split" class="control_label">Split</label>
                    <select id="h_split" name="h_split" class="form-control">
                        <option selected disabled hidden>--PILIH--</option>
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="h_status" class="control_label">Status</label>
                    <select id="h_status" name="h_status" class="form-control">
                        <option selected disabled hidden>--PILIH--</option>
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="discount" class="control_label">Diskon</label>
                    <input type="text" class="form-control" name="discount" id="discount" autocomplete="off">
                    <span class="help-block"></span>
                </div>
                <div class="form-group" id=preview>
                    <label class="control-label">Gambar Produk</label>
                    <div id="foto">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="control_label">Gambar Produk</label>
                    <input type="file" id="image" name="image" class="form-control-file">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                <button type="button" class="btn btn-warning" id="btn_save_produk"><i class='fas fa-check mr-2'></i>Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>
<script>
    var table;
    $(function() {
        // Data Table
        var table = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Produk/read')?>",
                "type": "POST",
                "data": function (data) {
                    data.kategori_filter     = $('#kategori_filter').val();
                },
            },
            "columnDefs": [{
                "targets": [0, 5],
                "orderable": false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });
        // reload table
        function reload_table()
        {
            table.ajax.reload(null,false);
        }
        // filter kategori
        $('#kategori_filter').change(function(event) {
            reload_table();
        });
        // open modal upload
        $('#btn_upload').click(function(event) {
            $('#upload_data').trigger('reset');
            $('#modal_upload').modal('show');
        });
        // open modal create
        $('#btn_create_produk').click(function(event) {
            $('#method').val('create');
            $('#judul_modal').text('Tambah Data Produk')
            $('#form_produk').trigger('reset');
            $('#modal_produk').modal('show');
            $('.help-block').empty();
            $('#preview').hide();
        });
        // number only
        $('#hpp').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        $('#harga').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        $('#discount').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        // create produk
        $('#btn_save_produk').click(function(event){
            if($('#method').val() == 'create') {
                url     = "<?php echo base_url('Produk/create')?>";
                url_api = "https://mitrabagja.com/be/updateProduk";
                text    = 'Anda Berhasil Menambah Data Produk!';
            }
            else
            {
                url     = "<?php echo base_url('Produk/update')?>";
                url_api = "https://mitrabagja.com/be/updateProduk";
                text    = 'Anda Berhasil Menyunting Data Produk!';
            }
            var formData = new FormData($('#form_produk')[0]);
            $.ajax({
                url : url,
                beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    console.log(data.id_produk);
                    $('#id').val(data.id_produk);
                    if(data.status)
                    {
                        $.ajax({
                            url         : url_api,
                            type        : "POST",
                            data        : new FormData($('#form_produk')[0]),
                            processData : false,
                            contentType : false,
                            cache       : false,
                            async       : false,
                            dataType    : "JSON",
                            success     : function (data2) {

                                swal({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: text
                                });
                                $('#modal_produk').modal('hide');
                                reload_table();
                                
                            }
                        })

                        return false;

                        
                    }
                    else
                    {
                        swal.close();
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                        }
                    } 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
        });
    });
    // fungsi numbering
    function number_format (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    // get data buat update
    function update_data(id) {
        $('#method').val('update');
        $('#form_produk').trigger('reset');
        $('#modal_produk').modal('show');
        $('.help-block').empty();
        $('#preview').show();
        $.ajax({
            url: '<?php echo base_url("Produk/get")?>/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data)
            {
                $('#judul_modal').text('Sunting Data '+data.nama);
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#hpp').val(number_format(data.hpp,0,',',','));
                $('#harga').val(number_format(data.harga,0,',',','));
                if(data.id_kategori)
                {
                   $('#id_kategori').val(data.id_kategori); 
                }
                $('#h_stok').val(data.h_stok ? data.h_stok : 0);
                $('#h_topping').val(data.h_topping ? data.h_topping : 0);
                $('#h_ukuran').val(data.h_ukuran ? data.h_ukuran : 0);
                $('#h_split').val(data.h_split ? data.h_split : 0);
                $('#h_status').val(data.h_status ? data.h_status : 0);
                $('#discount').val(number_format(data.discount,0,',',','));
                if(data.image) 
                {
                    var base_url = "<?php echo base_url(); ?>"
                    $('#label-photo').text('Ganti Gambar Produk');
                    $('#preview div').html('<img src="https://mitrabagja.com/upload/produk/'+data.image+'" width="100" height="50" class="img-thumbnail">');
                }
                else
                {
                    $('#label-photo').text('Upload Gambar');
                    $('#foto').text('(Belum ada Gambar)');
                }
            }
        });
    }
    // Hapus Produk
    function delete_data(id) {
        var table2 = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Produk/read')?>",
                "type": "POST",
                "data": function (data) {
                    data.kategori_filter     = $('#kategori_filter').val();
                },
            },
            "columnDefs": [{
                "targets": [0, 5],
                "orderable": false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            },
            'bDestroy': true,
        });
        swal({
          title: 'Konfirmasi',
          text: "Yakin Ingin Menghapus Data ini?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                  url:"https://mitrabagja.com/be/hapusProduk",  
                  method:"post",
                  beforeSend :function () {
                  swal({
                      title: 'Menunggu',
                      html: 'Memproses data',
                      onOpen: () => {
                        swal.showLoading()
                      }
                    })      
                  },    
                  data:{id:id},
                  dataType : "JSON",
                  success:function(data){
                    swal(
                      'Hapus',
                      'Data Berhasil Terhapus',
                      'success'
                    )
                    table2.ajax.reload(null, false);
                  }
                })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal(
                  'Batal',
                  'Anda membatalkan penghapusan',
                  'error'
                )
                table2.ajax.reload(null, false);

            }
        })
    }
</script>