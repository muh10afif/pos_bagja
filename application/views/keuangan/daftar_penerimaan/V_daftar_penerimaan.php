<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-dollar-sign mr-3"></i>Daftar Penerimaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
            <div class="breadcrumb-item"><?= $title ?></div>
            <div class="breadcrumb-item">Daftar Penerimaan</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <div class="form-inline mb-3">
                        <a href="javascript:;" class="btn btn-icon icon-left btn-primary mr-3 shadow" id="tambah_penerimaan"><i class="fas fa-plus"></i> Tambah Penerimaan</a>
                        <a href="#" class="btn btn-icon icon-left btn-success mr-3 shadow"><i class="fas fa-download mr-2"></i>Download Laporan</a>
                        <div class="form-group mb-1">
                            <label for="staticEmail2" class="sr-only">Periode</label>
                            <input type="text" class="form-control datepicker shadow text-center">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-statistic-1 shadow">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-lightbulb"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Penerimaan</h4>
                                    </div>
                                    <div class="card-body">
                                        Rp. 10.500.000
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabel-pelanggan">
                                <thead>                                 
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nomor Penerimaan</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Nama Penerima</th>
                                        <th>Jumlah</th>
                                        <th>Akun</th>
                                        <th>Outlet</th>
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
<div id="modal_penerimaan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Tambah Penerimaan</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-pelanggan">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_penerimaan" name="id_penerimaan" value="Tambah">
                <div class="modal-body m-3">
                    <section class="section">
                        <div class="section-title mt-0">Data Penerimaan</div>
                    </section>
                    <div class="row p-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Penerimaan</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nomor Penerimaan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Penerimaan</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Penerimaan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Referensi</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Referensi">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" style="height: 100%;" placeholder="Masukkan Keterangan"></textarea>
                            </div>
                        </div>
                        <section class="section">
                            <div class="section-title mt-0">Data Akun</div>
                        </section>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="controls">
                                    <div class="entry row" data="0">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Akun</label>
                                                <select name="nm_akun" id="nm_akun" class="form-control">
                                                    <option value="">Akun</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Debit (Rp)</label>
                                                <input type="text" class="form-control number_separator numeric" placeholder="Masukkan Debit">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kredit (Rp)</label>
                                                <input type="text" class="form-control number_separator numeric" placeholder="Masukkan Kredit">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start ml-3">
                                            <button class="btn btn-success btn-sm shadow btn-add tombol mb-3" type="button">Tambah Akun Penerimaan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomor_buku_kas" class="col-sm-5 col-form-label">Total Debit</label>
                                <div class="col-sm-7">
                                    <h5>Rp. 2.000.000</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomor_buku_kas" class="col-sm-5 col-form-label">Total Kredit</label>
                                <div class="col-sm-7">
                                    <h5>Rp. 5.000.000</h5>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                            <div class="section-title mt-0">Data Tambahan</div>
                        </section>
                        <div class="col-md-12"></div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomor_buku_kas" class="col-sm-5 col-form-label">Tanggal Masuk</label>
                                <div class="col-sm-7">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar-week"></i></div>
                                        </div>
                                        <input type="text" class="form-control datepicker" name="tgl_masuk" id="tgl_masuk" placeholder="Masukkan Tanggal Masuk">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomor_buku_kas" class="col-sm-5 col-form-label">Tanggal Penagihan</label>
                                <div class="col-sm-7">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar-week"></i></div>
                                        </div>
                                        <input type="text" class="form-control datepicker" name="tgl_penagihan" id="tgl_penagihan" placeholder="Masukkan Tanggal Penagihan">
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
        $(document).on('click', '.btn-add', function(e) {

            e.preventDefault();

            var controlForm = $('.controls:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');

            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('Hapus');

            controlForm.find('.entry:not(:first)').attr("data", 1);
            
        }).on('click', '.btn-remove', function(e) {

            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;

            });
        }
    );
</script>

<script>
    $(document).ready(function () {
        
        $("#tabel-pelanggan").dataTable();

        $('#tambah_penerimaan').on('click', function () {
            $('#modal_penerimaan').modal('show');            
        })

    })
</script>