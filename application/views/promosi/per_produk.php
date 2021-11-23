<div class="main-content">
    <section class="section">

        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-bullhorn mr-3"></i><?= $title ?></h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
                <div class="breadcrumb-item" id="jenis_promosi"><?= $jenis ?></div>
            </div>

        </div>

        <div class="section-body">

            <div class="row mt-2">
                <div class="col-md-6">
                    <a href="javascript:;" class="btn btn-icon icon-left btn-warning shadow" id="tambah_promosi" jenis="<?= $jenis ?>"><i class="fas fa-plus"></i> Tambah Promosi</a>  
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped w-100" id="table">
                                <thead>                                 
                                    <tr class="text-center">
                                        <th width="3%">No</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Potongan</th>
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
<!-- modal lewat tombol tambah -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="modal_header">Title</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id" class="form-control-label">Produk</label>
                        <select id="select_produk" name="id" class="form-control">
                            <option selected disabled hidden>--PILIH--</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="discount" class="form-control-label">Nilai Diskon</label>
                        <input type="text" class="form-control" name="discount" id="discount" placeholder="Masukkan Nilai Diskon" autocomplete="off">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="btn_save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal lewat tombol update -->
<div id="modal_trigger" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title mb-3" id="modal_header_trigger">Title</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_trigger">
                <div class="modal-body">
                    <input type="hidden" id="id_trigger" name="id">
                    <div class="form-group">
                        <label for="discount" class="form-control-label">Nilai Diskon</label>
                        <input type="text" class="form-control" name="discount" id="discount_trigger" autocomplete="off">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="btn_save_trigger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        // tabel
        var table = $("#table").DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Promosi/read_per_produk')?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 4],
                "orderable": false
            }, {
                'targets'   : [0,4],
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
        // generate value untuk option
        $.ajax({
            url : "<?php echo base_url('Promosi/get_produk_tanpa_diskon')?>",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $.each(data, function(i, data) {
                    $('#select_produk').append(
                        `<option value='`+data.id+`'>`+data.nama+`</option>`
                    );
                });
            }
        });
        // trigger modal
        $('#tambah_promosi').on('click', function () {
            $('#modal').modal('show');
            $('#modal_header').text('Tambah Promosi');
            $('#form').trigger('reset');
            $('.help-block').empty();
        })
         // number only
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
        })
        $('#discount_trigger').keyup(function(event) {
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
        // save lewat add
        $('#btn_save').click(function(event) {
            $.ajax({
                url : "<?php echo base_url('Promosi/update')?>",
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
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: 'Transaksi Data Berhasil!'
                        });
                        $('#modal').modal('hide');
                        reload_table();
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
        // save lewat update
        $('#btn_save_trigger').click(function(event) {
             $.ajax({
                url : "<?php echo base_url('Promosi/update')?>",
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
                data: $('#form_trigger').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: 'Transaksi Data Berhasil!'
                        });
                        $('#modal_trigger').modal('hide');
                        table.ajax.reload(null,false);
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
    })
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
        $('#form_trigger').trigger('reset');
        $('#modal_trigger').modal('show');
        $('.help-block').empty();
        $.ajax({
            url: '<?php echo base_url("Produk/get")?>/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data)
            {
                $('#modal_header_trigger').text('Sunting Data '+data.nama);
                $('#id_trigger').val(data.id);
                $('#discount_trigger').val(number_format(data.discount,0,',',','));
            }
        });
    }
    // Hapus Diskon, kagak sih, cuma bikin diskon jadi 0 aja
    function delete_data(id) {
        var table = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Promosi/read_per_produk')?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 4],
                "orderable": false
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
                  url:"<?= base_url('Promosi/delete')?>",  
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
                  success:function(data){
                    swal(
                      'Hapus',
                      'Data Berhasil Terhapus',
                      'success'
                    )
                    table.ajax.reload(null, false);
                    $.ajax({
                        url : "<?php echo base_url('Promosi/get_produk_tanpa_diskon')?>",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data)
                        {
                            $.each(data, function(i, data) {
                                $('#select_produk').append(
                                    `<option value='`+data.id+`'>`+data.nama+`</option>`
                                );
                            });
                        }
                    });
                  }
                })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal(
                  'Batal',
                  'Anda membatalkan penghapusan',
                  'error'
                )
            }
        })
    }
</script>