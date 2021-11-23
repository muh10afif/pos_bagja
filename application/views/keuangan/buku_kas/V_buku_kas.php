<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-dollar-sign mr-3"></i>Buku Kas & Bank</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
                <div class="breadcrumb-item">Buku Kas & Bank</div>
            </div>
        </div>

        <div class="section-body">

            <div class="form-inline">
                <a href="javascript:;" class="btn btn-icon icon-left btn-primary shadow mr-3" id="tambah_buku_kas"><i class="fas fa-plus"></i> Tambah Buku Kas & Bank</a>
                <div class="form-group mb-1">
                    <label for="staticEmail2" class="sr-only">Periode</label>
                    <input type="text" class="form-control datepicker shadow text-center">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabel-pelanggan">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nomor Akun</th>
                                <th>Nama Akun Kas</th>
                                <th>Keterangan</th>
                                <th>Tipe</th>
                                <th>Saldo</th>
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

    </section>
</div>

<!-- 25-08-2020 -->

<!-- modal -->
<div id="modal_buku_kas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Tambah Buku Kas</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" autocomplete="off" id="form-pelanggan">
                <input type="hidden" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="Tambah">
                <div class="modal-body m-3">
                    <div class="form-group row">
                      <label for="nomor_buku_kas" class="col-sm-3 col-form-label">Nomor Buku Kas</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nomor_buku_kas" id="nomor_buku_kas" placeholder="Masukkan Nomor Buku Kas">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="nama_buku_kas" class="col-sm-3 col-form-label">Nama Buku Kas</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama_buku_kas" id="nama_buku_kas" placeholder="Masukkan Nama Buku Kas">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" rows="3" style="height:100%;" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="saldo" class="col-sm-3 col-form-label">Saldo</label>
                      <div class="col-sm-9">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control number_separator numeric" name="saldo" id="saldo" placeholder="Masukkan Saldo">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Tipe</label>
                        <div class="col-sm-9">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="buku_kas" name="tipe" class="custom-control-input" value="buku_kas">
                                <label class="custom-control-label" for="buku_kas">Buku Kas</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="bank" name="tipe" class="custom-control-input" value="bank">
                                <label class="custom-control-label" for="bank">Bank</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row tipe_bank" hidden>
                        <label for="keterangan" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nama_rekening">Nama Rekening</label>
                                    <input type="text" class="form-control" id="nama_rekening" placeholder="Nama Rekening">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nomor_rekening">Nomor Rekening</label>
                                    <input type="text" class="form-control" id="nomor_rekening" placeholder="Nomor Rekening">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nm_bank">Bank</label>
                                    <select name="nm_bank" id="nm_bank" class="form-control">
                                        <option value="mandiri">Bank Mandiri</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                    <button type="button" class="btn btn-success" id="simpan_pelanggan"><i class='fas fa-check mr-2'></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        $("#tabel-pelanggan").dataTable();

        // 25-08-2020
        $('#tambah_buku_kas').on('click', function () {
            $('#modal_buku_kas').modal('show');
        })

        $('[name=tipe]').on('change', function () {
            var isi = $(this).val();

            if (isi == 'bank') {
                $('.tipe_bank').removeAttr('hidden');
            } else {
                $('.tipe_bank').attr('hidden', true);
            }
        })

    })
</script>