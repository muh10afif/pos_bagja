<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-dollar-sign mr-3"></i>Daftar Pengeluaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
            <div class="breadcrumb-item"><?= $title ?></div>
            <div class="breadcrumb-item">Daftar Pengeluaran</div>
        </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <div class="form-inline mb-3">
                        <a href="#" class="btn btn-icon icon-left btn-primary mr-3 shadow" id="tambah_pengeluaran"><i class="fas fa-plus"></i> Tambah Pengeluaran</a>
                        <a href="#" class="btn btn-icon icon-left btn-success mr-3 shadow"><i class="fas fa-download mr-2"></i>Download Laporan</a>
                        <div class="form-group mb-1">
                            <label for="staticEmail2" class="sr-only">Periode</label>
                            <input type="text" class="form-control datepicker shadow text-center">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1 shadow">
                                <div class="card-icon bg-primary">
                                <i class="far fa-lightbulb"></i>
                                </div>
                                <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pengeluran</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 10.500.000
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1 shadow">
                                <div class="card-icon bg-warning">
                                <i class="far fa-lightbulb"></i>
                                </div>
                                <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Tagihan</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 5.000.000
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
                                    <th>Tanggal</th>
                                    <th>No Tagihan</th>
                                    <th>No Pembayaran</th>
                                    <th>Nama Tagihan</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Total Bayar</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
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
<div id="modal_pengeluaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                <input type="hidden" id="id_pengeluaran" name="id_pengeluaran" value="Tambah">
                <div class="modal-body m-3">
                    <section class="section">
                        <div class="section-title mt-0">Data Pengeluaran</div>
                    </section>
                    <div class="row p-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_pembayaran">Nomor Pembayaran</label>
                                <input type="text" class="form-control" id="nomor_pembayaran" name="nomor_pembayaran" placeholder="Masukkan Nomor Pembayaran">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_tagihan">Nomor Tagihan</label>
                                <input type="text" class="form-control" id="nomor_tagihan" name="nomor_tagihan" placeholder="Masukkan Nomor Tagihan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_po">Nomor PO</label>
                                <input type="text" class="form-control" id="nomor_po" name="nomor_po" placeholder="Masukkan Nomor PO">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_tagihan">Nama Tagihan</label>
                                <input type="text" class="form-control" id="nama_tagihan" name="nama_tagihan" placeholder="Masukkan Nama Tagihan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_supplier">Nama Supplier</label>
                                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="Masukkan Jumlah">
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

                        <div class="col-md-12">

                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="data-tambahan-tab3" data-toggle="tab" href="#data_tambahan" role="tab" aria-controls="data_tambahan" aria-selected="true">Data Tambahan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="detail-po-tab3" data-toggle="tab" href="#detail_po" role="tab" aria-controls="detail_po" aria-selected="false">Detail PO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rekening-tab3" data-toggle="tab" href="#rekening" role="tab" aria-controls="rekening" aria-selected="false">Rekening</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="data_tambahan" role="tabpanel" aria-labelledby="data-tambahan-tab3">
                                <div class="row p-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Tagihan</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-calendar-week"></i></div>
                                                </div>
                                                <input type="text" class="form-control datepicker" name="tgl_masuk" id="tgl_masuk" placeholder="Masukkan Tanggal Masuk">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Pembelian</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-calendar-week"></i></div>
                                                </div>
                                                <input type="text" class="form-control datepicker" name="tgl_masuk" id="tgl_masuk" placeholder="Masukkan Tanggal Masuk">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Pembayaran</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-calendar-week"></i></div>
                                                </div>
                                                <input type="text" class="form-control datepicker" name="tgl_masuk" id="tgl_masuk" placeholder="Masukkan Tanggal Masuk">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="detail_po" role="tabpanel" aria-labelledby="detail-po-tab3">
                                <div class="table-responsive p-3">
                                    <table class="table table-striped table-bordered" id="tabel-detail-po">
                                        <thead>                                 
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Produk</th>
                                                <th>Jumlah</th>
                                                <th>Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Total</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="rekening" role="tabpanel" aria-labelledby="rekening-tab3">
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

        $('#tambah_pengeluaran').on('click', function () {
            $('#modal_pengeluaran').modal('show');
        })

    })
</script>