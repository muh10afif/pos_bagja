<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-dollar-sign mr-3"></i>Daftar Tagihan Rutin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
            <div class="breadcrumb-item"><?= $title ?></div>
            <div class="breadcrumb-item">Tagihan Rutin</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <a href="javascript:;" class="btn btn-icon icon-left btn-primary mr-2 shadow" id="tambah_tagihan_rutin"><i class="fas fa-plus"></i> Tambah Tagihan Rutin</a>

                    <div class="card shadow mt-3">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabel-pelanggan">
                            <thead>                                 
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Tagihan</th>
                                    <th>Supplier</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>Status Tagihan</th>
                                    <th>Nama Rekening</th>
                                    <th>Nomor Rekening</th>
                                    <th>Bank</th>
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
<div id="modal_tagihan_rutin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Tambah Pengeluaran</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-pelanggan">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_tagihan_rutin" name="id_tagihan_rutin" value="Tambah">
                <div class="modal-body m-3">
                    <section class="section">
                        <div class="section-title mt-0">Data Tagihan</div>
                    </section>
                    <div class="row p-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_tagihan">Nama Tagihan</label>
                                <input type="text" class="form-control" id="nama_tagihan" name="nama_tagihan" placeholder="Masukkan Nama Tagihan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_supplier">Supplier</label>
                                <select name="supplier" id="supplier" class="form-control">
                                    <option value="">Sulaiman</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_tagihan">Jumlah Tagihan</label>
                                <input type="text" class="form-control" id="nama_tagihan" name="nama_tagihan" placeholder="Masukkan Nama Tagihan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_tagihan">Tanggal Jatuh Tempo</label>
                                <input type="text" class="form-control" id="nama_tagihan" name="nama_tagihan" placeholder="Masukkan Nama Tagihan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_tagihan">Jadikan Tagihan Otomatis</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="buku_kas" name="tipe" class="custom-control-input" value="buku_kas">
                                    <label class="custom-control-label" for="buku_kas">Ya</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="bank" name="tipe" class="custom-control-input" value="bank">
                                    <label class="custom-control-label" for="bank">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <section class="section">
                            <div class="section-title mt-0">Data Akun</div>
                        </section>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="controls2">
                                    <div class="entry2 row" data="0">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Rekening</label>
                                                <input type="text" class="form-control" placeholder="Masukkan Nama Rekening">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input type="text" class="form-control" placeholder="Masukkan Nomor Rekening">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <select name="n_bank" id="n_bank" class="form-control">
                                                    <option value="">Mandiri</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start ml-3">
                                            <button class="btn btn-success btn-sm shadow btn-add2 tombol mb-3" type="button">Tambah Rekening</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_penerimaan"><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function(){
        $(document).on('click', '.btn-add2', function(e) {

            e.preventDefault();

            var controlForm = $('.controls2:first'),
                currentEntry = $(this).parents('.entry2:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');

            controlForm.find('.entry2:not(:last) .btn-add2')
                .removeClass('btn-add2').addClass('btn-remove2')
                .removeClass('btn-success').addClass('btn-danger')
                .html('Hapus');

            controlForm.find('.entry2:not(:first)').attr("data", 1);
            
        }).on('click', '.btn-remove2', function(e) {

            $(this).parents('.entry2:first').remove();

            e.preventDefault();
            return false;

            });
        }
    );
</script>

<script>
    $(document).ready(function () {
        
        $("#tabel-pelanggan").dataTable();

        $('#tambah_tagihan_rutin').on('click', function () {
            $('#modal_tagihan_rutin').modal('show');
        })

    })
</script>