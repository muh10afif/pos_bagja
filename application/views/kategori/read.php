<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1><i class="fa fa-boxes mr-3"></i><?php echo $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 mb-2" align="left">
            <button class="btn btn-warning shadow" type="button" id="btn_create_kategori"><i class="fas fa-plus"></i> Tambah Kategori</button>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
          <div class="card shadow">
            <div class="card-body">
              <div class="table-responsive">
                  <table id="table" class="table table-hover table-striped table-bordered w-100">
                      <thead>
                          <tr class="text-center">
                              <th width="5%">No.</th>
                              <th>Nama Kategori</th>
                              <th width="15%">Aksi</th>
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
<div class="modal fade" id="modal_create_kategori" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title font-weight-bold text-white mb-3">Tambah Data Kategori</h5>
        <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_create_kategori" autocomplete="off">
            <div class="modal-body">
                <div class="form-group">
                    <label for="kategori" class="control_label">Nama Kategori</label>
                    <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Masukkan Nama Kategori" autocomplete="off">
                    <span class="help-block"></span>
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
<!-- Modal set Kategori -->
<div class="modal fade" id="modal_set_kategori" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title font-weight-bold text-white">Tetapkan Produk</h5>
        <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-dark">&times;</span>
        </button>
      </div>
        <form id="form_set_kategori" autocomplete="off">
            <input type="hidden" id="id_kategori" name="id_kategori">
            <div class="modal-body">
                <button type="button" class="btn btn-sm btn-primary" id="select_all"><i class="fas fa-check"></i></button>
                <button type="button" class="btn btn-sm btn-danger" id="deselect_all"><i class="fas fa-times"></i></button>
                <div class="form-group mt-3" align="center">
                    <select multiple="multiple" id="id_produk" name="id_produk[]" class="form-control">
                      <?php foreach($produk as $row) { ?>
                        <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                      <?php } ?>
                    </select>             
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btn_set_kategori">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function() {
        // Data Table
        var table = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Kategori/read')?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 2],
                "orderable": false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            }]
        });
        // reload table
        function reload_table()
        {
            table.ajax.reload(null,false);
        }
        // inisialisasi multi select
        $('#id_produk').multiSelect({
            selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Cari Produk'>",
            selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Cari Produk'>",
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
        // select al
        $('#select_all').click(function(){
          $('#id_produk').multiSelect('select_all');
          return false;
        });
        // deselect all
        $('#deselect_all').click(function(){
          $('#id_produk').multiSelect('deselect_all');
          return false;
        });
        // open modal add kategori
        $('#btn_create_kategori').click(function(event) {
            $('#form_create_kategori').trigger('reset');
            $('#modal_create_kategori').modal('show');
            $('.help-block').empty();
        });
        // create kategori
        $('#btn_save_kategori').click(function(event){
            $.ajax({
                url : "<?php echo base_url('Kategori/create_kategori')?>",
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
                data: $('#form_create_kategori').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: 'Anda Berhasil Menambah Data Kategori!'
                        });
                        $('#modal_create_kategori').modal('hide');
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
    });
    // Hapus Kategori
    function delete_data(id) {
        var table = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Kategori/read')?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 2],
                "orderable": false
            }],
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
                  url:"<?= base_url('Kategori/delete')?>",  
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
    // trigger buka modal set produk
    function set_produk(id) {
        $('#form_set_kategori')[0].reset();
        $('#modal_set_kategori').modal('show');
        $('#id_kategori').val(id);
        $('#id_produk').multiSelect('deselect_all');
        $('#id_produk').multiSelect('refresh');
    }
    // proses set produk
    $('#btn_set_kategori').click(function(event) {
        var table = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Kategori/read')?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 2],
                "orderable": false
            }],
            'bDestroy': true,
        });
        $.ajax({
            url : "<?php echo base_url('Kategori/set_produk')?>",
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
            data: $('#form_set_kategori').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status)
                {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Anda Berhasil Menambah Data Kategori!'
                    });
                    $('#modal_set_kategori').modal('hide');
                    table.ajax.reload(null, false);
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
</script>