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
            <!-- <h2 class="section-title"><?= $title ?></h2>
            <p class="section-lead">
                Menampilkan list pelanggan.
            </p> -->

            <div class="row mt-2">
                <div class="col-md-6">
                    <a href="#" class="btn btn-icon icon-left btn-primary shadow" id="tambah_promosi" jenis="<?= $jenis ?>"><i class="fas fa-plus"></i> Tambah Promosi</a>  
                </div>
                <div class="col-md-2 text-right">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="aktif">
                        <label class="custom-control-label" for="aktif"><span class="badge badge-success">Aktif</span></label>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="non_aktif">
                        <label class="custom-control-label" for="non_aktif"><span class="badge badge-dark">Non aktif</span></label>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="kadaluarsa">
                        <label class="custom-control-label" for="kadaluarsa"><span class="badge badge-danger">Kadaluarsa</span></label>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tabel_per_total_pembelian">
                                <thead>                                 
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Promosi</th>
                                        <th><?= ($jenis == 'Per Produk') ? 'Produk' : 'Deskripsi' ?></th>
                                        <th>Potongan</th>
                                        <th><?= ($jenis == 'Per Produk') ? 'Minimal Pembelian/Kuantitas' : 'Minimal Pembelian' ?></th>
                                        <th>Durasi</th>
                                        <th>Status Promosi</th>
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

<div id="modal-promosi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mb-3" id="my-modal-title">Title</h5>
                <button class="close p-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Promosi</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Promosi">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Deskripsi Promosi</label>
                            <input type="text" class="form-control" placeholder="Masukkan Deskripsi Promosi">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Mulai">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Berakhir</label>
                            <input type="text" class="form-control datepicker" placeholder="Masukkan Tanggal Berakhir">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="text" class="form-control timepicker" placeholder="Masukkan Jam Mulai">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jam Berakhir</label>
                            <input type="text" class="form-control timepicker" placeholder="Masukkan Jam Berakhir">
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="form-group" style="margin-left: -40px;">
                            <label class="custom-switch">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="pilih_semua">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Pilih semua hari</span>
                            </label>
                        </div>
                        
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                        <ul class="list-group list-group-horizontal-lg mb-3">
                            <li class="list-group-item shadow mr-3" data="0" style="cursor: pointer; border-radius: 10px;">Senin</li>
                            <li class="list-group-item shadow mr-3" data="0" style="cursor: pointer; border-radius: 10px;">Selasa</li>
                            <li class="list-group-item shadow mr-3" data="0" style="cursor: pointer; border-radius: 10px;">Rabu</li>
                            <li class="list-group-item shadow mr-3" data="0" style="cursor: pointer; border-radius: 10px;">Kamis</li>
                            <li class="list-group-item shadow mr-3" data="0" style="cursor: pointer; border-radius: 10px;">Jum'at</li>
                            <li class="list-group-item shadow mr-3" data="0" style="cursor: pointer; border-radius: 10px;">Sabtu</li>
                            <li class="list-group-item shadow mr-3" data="0" style="cursor: pointer; border-radius: 10px;">Minggu</li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group" style="margin-left: -40px;">
                            <label class="custom-switch">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input status_promo">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Status Promo</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12 f_promo" hidden>
                        <div class="row">
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Potongan</label>
                                    <select name="jenis_potongan" id="jenis_potongan" class="form-control">
                                        <option value="persen">%</option>
                                        <option value="harga">Harga</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Input Potongan</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nilai Potongan">
                                </div>
                            </div>
                            <div class="col-md-6 min_beli">
                                <div class="form-group">
                                    <label>Minimal Pembelian</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Minimal Pembelian">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        
        $("#tabel_per_total_pembelian").dataTable();

        $('#tambah_promosi').on('click', function () {
            
            $('#modal-promosi').modal('show');
            $('#my-modal-title').text('Tambah Promosi '+$('#jenis_promosi').text());

        })

        // 26-08-2020

        // checkbox pilih status promo
        $('.status_promo').on('change', function () {
            var isi = $(this).is(':checked');

            if (isi == true) {
                $('.f_promo').removeAttr('hidden');
            } else {
                $('.f_promo').attr('hidden', true);
            }
        })

        // checkbox pilih semua hari
        $('#pilih_semua').on('change', function () {
            var isi = $(this).is(':checked');

            if (isi == true) {
                $('.list-group-item').each(function () {
                    $(this).addClass('bg-success text-white');
                })
            } else {
                $('.list-group-item').each(function () {
                    $(this).removeClass('bg-success text-white');
                })
            }
        })

        // saat list hari ditekan
        $('.list-group-item').on('click', function () {

            var isi = $(this).hasClass('bg-success');

            if (isi == true) {
                $(this).attr('data', 0);
                $(this).removeClass('bg-success text-white');
            } else {
                $(this).attr('data', 1);
                $(this).addClass('bg-success text-white');
            }

            var angka = 0;
            var i = 1;

            $('.list-group-item').each(function () {
                var dt = $(this).attr('data');

                if (dt == 1) {
                    angka += i;
                }

            })

            if (angka == 7) {
                $('#pilih_semua').prop('checked', true);
            } else {
                $('#pilih_semua').prop('checked', false);
            }
            
        })

    })
</script>