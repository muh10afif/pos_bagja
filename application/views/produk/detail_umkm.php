<style>
    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: orange;
        border-color: orange orange orange;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 1px solid orange;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: orange;
    }
    .nav-tabs {
        border-bottom: 2px solid orange;
    }
    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: orange;
        background-color: orange;
    }
    .tab-pane.active {
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .selectgroup-input:checked + .selectgroup-button {
        background-color: orange;
        color: #fff;
        z-index: 1;
    }
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <?php if ($user == 'Bagja'): ?>

                <?php if ($hal == 'detail off') : ?>
                    <h1 class=""><i class="fa fa-th-large mr-3"></i>Produk  | <?= ucwords($umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">Bagja</div>
                        <div class="breadcrumb-item active">List Produk</div>
                    </div> 
                <?php else: ?>
                    <h1><i class="fa fa-th-large mr-3"></i>Produk | <?= ucwords($umkm) ?></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Produk</a></div>
                        <div class="breadcrumb-item"><a href="<?= base_url('Kategori') ?>">List UMKM</a></div>
                        <div class="breadcrumb-item">Detail Produk</div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <h1><i class="fa fa-th-large mr-3"></i>List Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">Bagja</div>
                    <div class="breadcrumb-item">List Produk</div>
                </div>
            <?php endif; ?>
        </div>
        
    </section>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-warning shadow" type="button" id="tambah_produk"><i class="fas fa-plus"></i> Tambah Produk</button>
        </div>
        <div class="col-md-6 text-right">
            <?php if ($user == 'Bagja' && $hal == ''): ?>
                <a href="<?= base_url('Produk') ?>" class="btn btn-warning shadow" type="button" id="btn_create_kategori"><i class="fas fa-angle-left mr-2"></i>Kembali</a>
            <?php endif; ?>
        </div>
        <div class="col-md-12 mt-3">
            <div class="alert alert-warning text-center font-weight-bold shadow" role="alert">
                <h5 class="mb-0">Total: <mark style="border-radius: 5px;" class="m-1 jml"><?= $jml_produk ?> Produk</mark></h5>
            </div>
        </div>
    </div>
    <div class="row f_list">
        <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
          <div class="card card-warning shadow">
            <div class="card-header row d-flex justify-content-center">
                    <div class="col-md-4">
                        <select name="kategori" id="kategori" class="form-control select2 shadow" style="width: 100%;">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id'] ?>"><?= $k['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="selectgroup w-100 mt-2">
                            <label class="selectgroup-item shadow">
                            <input type="radio" name="status_tampil" value="1" class="selectgroup-input" checked="">
                            <span class="selectgroup-button bg-success p-1" id="s_aktif" style="font-size: 17px; font-weight: bold; height:100%" >Tampil Dimenu</span>
                            </label>
                            <label class="selectgroup-item shadow">
                                <input type="radio" name="status_tampil" value="0" class="selectgroup-input">
                                <span class="selectgroup-button p-1" id="s_non_aktif" style="font-size: 17px; font-weight: bold; height:100%">Tidak Tampil Dimenu</span>
                            </label>
                        </div>
                    </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table id="tabel_produk" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr class="text-center">
                              <th width="5%">No.</th>
                              <th>Gambar</th>
                              <th>Nama Produk</th>
                              <th>Harga Dasar</th>
                              <th>Harga Jual</th>
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

<!-- modal tambah produk -->
<div class="modal fade" id="modal_produk" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <form id="form_produk" autocomplete="off">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title font-weight-bold text-white mb-3 title_produk"></h5>
                <button type="button" class="close p-3" onclick="location.reload()" aria-label="Close">
                <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        
            <input type="hidden" name="id_umkm" id="id_umkm" value="<?= $id_umkm ?>">
            <input type="hidden" id="aksi" name="aksi" value="Tambah">
            <input type="hidden" name="id" id="id_produk" class="form-control">
            <input type="hidden" id="status_simpan_produk_atas" value="no">
            <input type="hidden" id="status_simpan_produk" value="no">
            <input type="hidden" id="status_foto" value="0">
            <input type="hidden" id="id_stok">
            <input type="hidden" id="id_expire">

            <div class="modal-body">

                <div class="row p-3">
                    <div class="col-md-5">
                        <div class="form-group row p-1 mt-3">
                            <label for="gambar" class="col-sm-12 col-form-label">Gambar</label>
                            <div class="col-sm-12">
                                <input name="image" id="image" type="file" class="dropify" data-max-file-size="5M" data-show-errors="true" data-allowed-file-extensions="jpg png jpeg"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group row p-0">
                            <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input_produk" name="nama_produk" id="nama_produk" judul="Nama Produk" placeholder="Contoh: Nasi Goreng..">
                                <span class="text-danger" id="nama_produk_error"></span>
                            </div>
                        </div>
                        <div class="form-group row p-0 mt-0">
                            <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <div class="row no-gutters">
                                    <div class="col-md-9 kat_lama">
                                        <select name="id_kategori" id="id_kategori" class="form-control input_produk select2 shadow" judul="Kategori" style="width: 100%;">
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategori as $k): ?>
                                                <option value="<?= $k['id'] ?>"><?= $k['kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-9 kat_baru" hidden>
                                        <input type="text" class="form-control input_produk" placeholder="Contoh: Makanan.." id="nama_kategori" name="nama_kategori" judul="Kategori" value="produk">
                                    </div>
                                    <div class="col-md-2 mt-1 ml-3 btn_tambah">
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="Tambah Kategori baru" class="btn btn-block btn-success" id="tambah_kategori"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-2 mt-1 ml-3 btn_batal" hidden>
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="Batal Menambahkan" class="btn btn-block btn-danger" id="batal_kategori"><i class="fa fa-undo"></i></button>
                                    </div>
                                    <span class="text-danger" id="id_kategori_error"></span>
                                    <span class="text-danger" id="nama_kategori_error"></span>
                                    <input type="hidden" name="status_kategori" id="status_kategori" class="form-control" value="lama">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row p-0">
                            <label for="harga_dasar" class="col-sm-3 col-form-label">Harga Dasar</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" name="harga_dasar" id="harga_dasar" judul="Harga Dasar" class="form-control text-right numeric number_separator input_produk" placeholder="0">
                                </div>
                                <span class="text-danger" id="harga_dasar_error"></span>
                            </div>
                        </div>
                        <div class="form-group row p-0">
                            <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" name="harga_jual" id="harga_jual" judul="Harga Jual" class="form-control text-right numeric number_separator input_produk" placeholder="0">
                                </div>
                                <span class="text-danger" id="harga_jual_error"></span>
                            </div>
                        </div>
                        <div class="form-group row p-0">
                            <label for="harga_jual" class="col-sm-3 col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="selectgroup w-100" style="height: 95%;">
                                            <label class="selectgroup-item">
                                            <input type="radio" name="s_discount" value="rp" class="selectgroup-input" checked="">
                                            <span class="selectgroup-button p-1" id="s_rp" style="font-size: 15px; font-weight: bold; height:100%" >Rp. </span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="s_discount" value="persen" class="selectgroup-input">
                                                <span class="selectgroup-button p-1" id="s_persen" style="font-size: 15px; font-weight: bold; height:100%">%</span>
                                            </label>
                                        </div>
                                    </div>
                                    <input type="text" name="discount" id="discount" judul="discount" class="form-control text-right numeric number_separator" placeholder="0" disabled>
                                    <input type="hidden" name="discount2" id="discount2" class="form-control text-right" placeholder="0">
                                </div>
                                <input type="hidden" id="nilai_diskon" class="form-control">
                                <input type="hidden" id="jenis" class="form-control" value="rp">
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-md-12 mt-2">
                        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="bhnbaku-tab2" data-toggle="tab" href="#bhnbaku_t" role="tab" aria-controls="bhnbaku_t" aria-selected="true" hidden>Komposisi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" id="ukuran-tab2" data-toggle="tab" href="#ukuran_t" role="tab" aria-controls="ukuran_t" aria-selected="false">Ukuran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="topping-tab2" data-toggle="tab" href="#topping_t" role="tab" aria-controls="topping_t" aria-selected="false">Topping</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="status-tab2" data-toggle="tab" href="#status_t" role="tab" aria-controls="status_t" aria-selected="false">Status</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="stok-tab2" data-toggle="tab" href="#stok_t" role="tab" aria-controls="stok_t" aria-selected="false">Stok</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="split-tab2" data-toggle="tab" href="#split_t" role="tab" aria-controls="split" aria-selected="false" hidden>Split</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTab3Content">
                            <div class="tab-pane fade" id="bhnbaku_t" role="tabpanel" aria-labelledby="bhnbaku-tab2">
                                <div class="row p-3">
                                    <div class="col-md-6 c_bahan_baku">
                                        <div class="custom-control custom-checkbox mb-2 ">
                                            <input type="checkbox" class="custom-control-input" id="bhnbakuCheck">
                                            <label class="custom-control-label font-weight-bold" for="bhnbakuCheck">Aktifkan Resep Produk</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right tambah_baru" style="display: none">
                                        <button type="button" class="btn btn-info mr-2" id="tambahkan_list_baru"><i class="fa fa-angle-double-down mr-2"></i>Tambah List Baru</button> 
                                        <button type="button" class="btn btn-success" id="tambah_bahan_baku_baru" ><i class="fa fa-plus mr-2"></i>Tambah bahan baku baru</button> 
                                    </div>
                                    
                                    <div class="col-md-12 mt-3 f_bahan" style="display: none">
                                        <div class="row">
                                            <div class="col-md-4 offset-md-2">
                                                <div class="form-group row p-0">
                                                    <label for="bahan_baku0" class="col-sm-12 col-form-label">Bahan Baku</label>
                                                    <div class="col-sm-12">
                                                        <select name="bahan_baku0" id="bahan_baku0" judul="Bahan Baku" class="form-control input_bahan bahan_baku" no="0">
                                                            <option value="" satuan="">Pilih Bahan Baku</option>
                                                            <?php foreach ($bahan_baku as $b): ?>
                                                                <option value="<?= $b['id'] ?>" satuan="<?= $b['satuan'] ?>"><?= $b['bahan_baku'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <span class="text-danger" id="bahan_baku0_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row p-0">
                                                    <label for="satuan" class="col-sm-12 col-form-label">Takaran</label>
                                                    <div class="col-sm-12">
                                                        
                                                        <div class="input-group">
                                                            <input type="text" class="form-control numeric text-right input_bahan takaran" id="takaran0" name="takaran0" no="0" judul="Takaran" placeholder="0">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text t_satuan0">satuan</span>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="takaran0_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 list_baru">

                                    </div>
                                    <div class="col-md-12 mt-0 f_bahan_baru" style="display: none">
                                        <div class="row">
                                            <div class="col-md-12 text-right batal_baru" style="display: none">
                                                <button type="button" class="btn btn-danger"><i class="fa fa-undo-alt mr-2"></i>Batal menambahkan baru</button>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3">
                                            <div class="col-md-7">
                                                <div class="form-group row p-0">
                                                    <label for="kategori" class="col-sm-3 col-form-label">Nama Bahan Baku</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control input_bahan_baku" id="nama_bahan" name="nama_bahan" judul="Nama Bahan Baku" placeholder="Contoh: Gula..">
                                                        <span class="text-danger" id="nama_bahan_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row p-0">
                                                    <label for="kategori" class="col-sm-3 col-form-label">Satuan</label>
                                                    <div class="col-sm-9">
                                                        <select name="satuan" id="satuan2" class="select2 input_bahan_baku" judul="Satuan">
                                                            <option value="">Pilih Satuan</option>
                                                            <?php foreach ($satuan as $s): ?>
                                                                <option value="<?= $s['id'] ?>"><?= $s['satuan'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <span class="text-danger" id="satuan2_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row p-0">
                                                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-counter input-group">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn-subtract btn btn-success btn-spin kurang1" aksi="kurang">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" class="form-control counter text-center numeric stok_bahan input_bahan_baku" name="stok_bahan" id="stok_bahan" style="font-size: 17px;" data-min="1" value="1">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn-add btn btn-success btn-spin tambah1" aksi="tambah">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" id="stok_bahan_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row p-0">
                                                    <label for="harga_bahan" class="col-sm-3 col-form-label">Harga</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp. </span>
                                                            </div>
                                                            <input type="text" id="harga_bahan" name="harga_bahan" judul="Harga" class="form-control text-right numeric number_separator input_bahan_baku" placeholder="0">
                                                        </div>
                                                        <span class="text-danger" id="harga_bahan_error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row p-0 mt-2">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9 text-right">
                                                        <button type="button" class="btn btn-info" id="simpan_bahan_baku">Simpan Bahan Baku</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade show active" id="ukuran_t" role="tabpanel" aria-labelledby="ukuran-tab2">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="ukuranCheck">
                                            <label class="custom-control-label font-weight-bold" for="ukuranCheck">Aktifkan Ukuran</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right f_ukuran" style="display: none">
                                        <button type="button" class="btn btn-info" id="tambah_ukuran"><i class="fa fa-angle-double-down mr-2"></i>Tambah List baru</button>
                                    </div>
                                    <div class="col-md-12 mt-3 f_ukuran f_ukuran_pertama" style="display: none">
                                        <div class="row">
                                            <div class="col-md-4 offset-md-2">
                                                <div class="form-group row p-0">
                                                    <label for="ukuran0" class="col-sm-12 col-form-label">Ukuran</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control input_ukuran ukuran" id="ukuran0" name="ukuran0" no="0" judul="ukuran" placeholder="Contoh: Large..">
                                                        <span class="text-danger" id="ukuran0_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row p-0">
                                                    <label for="harga_ukuran0" class="col-sm-12 col-form-label">Harga</label>
                                                    <div class="col-sm-12">
                                                        
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp. </span>
                                                            </div>
                                                            <input type="text" class="form-control number_separator numeric text-right input_ukuran harga_ukuran" id="harga_ukuran0" name="harga_ukuran0" judul="Harga Ukuran" no="0" placeholder="0">
                                                        </div>
                                                        <span class="text-danger" id="harga_ukuran0_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 list_baru_ukuran">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="topping_t" role="tabpanel" aria-labelledby="topping-tab2">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="toppingCheck">
                                            <label class="custom-control-label font-weight-bold" for="toppingCheck">Aktifkan Topping</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right f_topping" style="display: none">
                                        <button type="button" class="btn btn-info" id="tambah_topping"><i class="fa fa-angle-double-down mr-2"></i>Tambah List Baru</button>
                                    </div>
                                    <div class="col-md-12 mt-3 f_topping f_topping_pertama" style="display: none">
                                        <div class="row">
                                            <div class="col-md-4 offset-md-2">
                                                <div class="form-group row p-0">
                                                    <label for="topping0" class="col-sm-12 col-form-label">Topping</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control input_topping topping" id="topping0" name="topping0" judul="topping" placeholder="Contoh: Coklat..">
                                                        <span class="text-danger" id="topping0_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row p-0">
                                                    <label for="harga_topping0" class="col-sm-12 col-form-label">Harga</label>
                                                    <div class="col-sm-12">
                                                        
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp. </span>
                                                            </div>
                                                            <input type="text" class="form-control number_separator numeric text-right input_topping harga_topping" id="harga_topping0" name="harga_topping0" judul="Harga Topping" placeholder="0">
                                                        </div>
                                                        <span class="text-danger" id="harga_topping0_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 list_baru_topping">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="status_t" role="tabpanel" aria-labelledby="status-tab2">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="statusCheck">
                                            <label class="custom-control-label font-weight-bold" for="statusCheck">Aktifkan Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right f_status" style="display: none">
                                        <button type="button" class="btn btn-info" id="tambah_status"><i class="fa fa-angle-double-down mr-2"></i>Tambah List Baru</button>
                                    </div>
                                    <div class="col-md-12 mt-3 f_status f_status_pertama" style="display: none">
                                        <div class="row">
                                            <div class="col-md-6 offset-md-3">
                                                <div class="form-group row p-0">
                                                    <label for="status0" class="col-sm-3 col-form-label">Nama Status</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control input_status status" id="status0" name="status0" judul="status" placeholder="Contoh: Diproses..">
                                                        <span class="text-danger" id="status0_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 list_baru_status">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="stok_t" role="tabpanel" aria-labelledby="stok-tab2">
                                <div class="row p-3">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="stokCheck">
                                            <label class="custom-control-label font-weight-bold" for="stokCheck">Aktifkan Stok</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 f_stok" style="display: none">
                                                
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-4">
                                                <div class="form-group row p-0">
                                                    <label for="stok" class="col-sm-12 col-form-label">Stok</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-counter input-group">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="btn-subtract btn btn-warning btn-spin kurang" aksi="kurang">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" class="form-control counter text-center numeric stok_p" style="font-size: 17px;" data-min="1" value="1">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn-add btn btn-warning btn-spin tambah" aksi="tambah">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row p-0">
                                                    <label for="satuan_stok" class="col-sm-12 col-form-label">Satuan</label>
                                                    <div class="col-sm-12">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-9 satuan_lama">
                                                            <select name="satuan_stok" id="satuan_stok" class="select2 input_satuan" judul="Satuan">
                                                                <option value="">Pilih Satuan</option>
                                                                <?php foreach ($satuan as $s): ?>
                                                                    <option value="<?= $s['id'] ?>"><?= $s['satuan'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9 satuan_baru" hidden>
                                                            <input type="text" class="form-control input_satuan" placeholder="Contoh: Pcs.." id="nama_satuan" name="nama_satuan" judul="Satuan">
                                                        </div>
                                                        <div class="col-md-2 mt-1 ml-3 btn_tambah_sat">
                                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Tambah satuan baru" class="btn btn-block btn-success" id="tambah_satuan"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                        <div class="col-md-2 mt-1 ml-3 btn_batal_sat" hidden>
                                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Batal Menambahkan" class="btn btn-block btn-danger" id="batal_satuan"><i class="fa fa-undo"></i></button>
                                                        </div>
                                                        <span class="text-danger" id="satuan_stok_error"></span>
                                                        <span class="text-danger" id="nama_satuan_error"></span>
                                                        <input type="hidden" name="status_satuan" id="status_satuan" class="form-control" value="lama">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 text-left">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="expiredCheck" disabled>
                                                    <label class="custom-control-label font-weight-bold" for="expiredCheck">Aktifkan Expired Date</label>
                                                </div>
                                            </div>  
                                        </div>

                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-4">
                                                <div class="form-group row f_expired" style="display: none">
                                                    <label for="satuan" class="col-sm-12 col-form-label">Tanggal Expired</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control text-center" id="tgl_expired" name="tgl_expired" value="<?= date("Y-m-d", now('Asia/Jakarta')) ?>">
                                                        <span class="text-danger" id="tgl_expired_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="split_t" role="tabpanel" aria-labelledby="split-tab2">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="splitCheck">
                                            <label class="custom-control-label font-weight-bold" for="splitCheck">Aktifkan Split</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right f_split" style="display: none">
                                        <button type="button" class="btn btn-info" id="tambah_split" disabled><i class="fa fa-angle-double-down mr-2"></i>Tambah List Baru</button>
                                        <input type="hidden" id="nilai_harga_jual">
                                    </div>
                                    <div class="col-md-12 mt-3 f_split f_split_pertama" style="display: none">
                                        <div class="row">
                                            <div class="col-md-4 offset-md-2">
                                                <div class="form-group row p-0">
                                                    <label for="split1" class="col-sm-12 col-form-label">Split</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control input_split input_split2 split" id="split1" name="split1" judul="nama split" no="1" placeholder="Contoh: Pemilik..">
                                                        <span class="text-danger" id="split1_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row p-0">
                                                    <label for="komisi1" class="col-sm-12 col-form-label">Komisi</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp. </span>
                                                            </div>
                                                            <input type="text" class="form-control number_separator numeric text-right komisi" id="komisi1" name="komisi1" judul="Komisi" placeholder="0" no="2">
                                                        </div>
                                                        <span class="text-danger" id="komisi1_error"></span>
                                                        <span class="text-danger" id="komisi1_nilai_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 offset-md-2">
                                                <div class="form-group row p-0">
                                                    <label for="split2" class="col-sm-12 col-form-label">Split</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control input_split input_split2 split" id="split2" name="split2" judul="nama split" no="2" placeholder="Contoh: Pemilik..">
                                                        <span class="text-danger" id="split2_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row p-0">
                                                    <label for="komisi2" class="col-sm-12 col-form-label">Komisi</label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Rp. </span>
                                                            </div>
                                                            <input type="text" class="form-control number_separator numeric text-right komisi" id="komisi2" name="komisi2" judul="Komisi" placeholder="0" no="2">
                                                        </div>
                                                        <span class="text-danger" id="komisi2_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 list_baru_split">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid ft_modal" style="margin-bottom: -10px;">
                    <div class="row">
                        <div class="col-md-6 text-left" style="margin-left: -20px;">
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="custom-switch-checkbox" id="checkTampil" class="custom-switch-input" checked>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Tampilkan Pada Menu</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-danger mr-2" onclick="location.reload()"><i class='fas fa-times mr-2'></i>Batal</button>
                            <button type="button" class="btn btn-warning" id="simpan_produk"><i class='fas fa-check mr-2'></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
  </div>
</div>

<div id="modal_detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content f_detail">
        
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('.numeric').numericOnly();

        function separator(kalimat) {
            return kalimat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // 19-11-2020
        $('#s_aktif').on('click', function () {

            $(this).addClass("bg-success text-white");
            $('#s_non_aktif').removeClass("bg-danger text-white");

        })

        // 19-11-2020
        $('#s_non_aktif').on('click', function () {

            $(this).addClass("bg-danger text-white");
            $('#s_aktif').removeClass("bg-success text-white");

        })

        // 19-11-2020
        var tabel_produk  = $('#tabel_produk').DataTable({
            "processing"    : true,
            "ajax"          : {
                "url"   : "<?= base_url() ?>Produk/tampil_produk",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_kategori    = $('#kategori').val();
                    data.id_umkm        = $('#id_umkm').val();
                    data.status_tampil  = $('input[name="status_tampil"]:checked').val();
                },
                "dataSrc": function (json) {
                    $(".jml").text(json.jumlah+" Produk");
                    return json.data;
                }
            },
            stateSave       : true,
            "order"         : [[ 0, 'asc']],
            "columnDefs"     : [{
                "targets"       : [1,5],
                "orderable"     : false
            }, {
                "targets"       : [0,1,5],
                "className"     : "text-center"
            }],
            bAutoWidth: false, 
            aoColumns : [
                { sWidth: '5%' },
                { sWidth: '30%' },
                { sWidth: '20%' },
                { sWidth: '10%' },
                { sWidth: '10%' },
                { sWidth: '20%' },
            ]
        });

        // 08-12-2020 && 10-12-2020
        $('#tabel_produk').on('click', '.edit_produk', function () {

            $('#aksi').val('Ubah');

            $('#status_simpan_produk_atas').val('ok');
            $('#status_simpan_produk').val('ok');

            $('.title_produk').html("<i class='fa fa-pencil-alt mr-3'></i>Ubah Produk");

            var id_produk   = $(this).data('id');
            var produk      = $(this).attr('produk');
            var id_umkm     = $(this).attr('id_umkm');
            var harga_dasar = $(this).attr('harga_dasar');
            var harga_jual  = $(this).attr('harga_jual');
            var id_kategori = $(this).attr('id_kategori');
            var discount    = $(this).attr('discount');
            var image       = $(this).attr('image');
            var sts_tampil  = $(this).attr('status_tampil');
            var list_produk = $(this).attr('list_produk');

            var drEvent = $('.dropify').dropify(
            {
                defaultFile: image
            });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            // drEvent.clearElement();
            drEvent.settings.defaultFile = image;
            drEvent.destroy();
            drEvent.init();

            $('#id_produk').val(id_produk);
            $('#nama_produk').val(produk);
            $('#id_kategori').val(id_kategori).trigger('change');
            $('#harga_dasar').val(separator(harga_dasar));
            $('#harga_jual').val(separator(harga_jual));
            $('#discount').val(separator(discount)).attr('disabled', false);
            $('#discount2').val(separator(discount));
            $('#nilai_harga_jual').val(harga_jual);

            $('#split-tab2').attr('hidden', false);

            $('.list_u').remove();
            $('.f_ukuran').slideUp(300);
            $('.list_t').remove();
            $('.f_topping').slideUp(300);
            $('.list_s').remove();
            $('.f_status').slideUp(300);
            $('.list_p').remove();
            $('.f_split').slideUp(300);

            $('#simpan_produk').attr('disabled', false);

            $.ajax({
                url         : "<?= base_url() ?>Produk/ambil_detail_produk",
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
                data        : {id_produk:id_produk},
                dataType    : "JSON",
                success     : function (data) {
                    swal.close();
                    console.log(data.ukuran.length);

                    if (sts_tampil == 1) {
                        $('#checkTampil').prop('checked', true); 
                    } else {
                        $('#checkTampil').prop('checked', false);
                    }

                    if (data.produk.h_ukuran == 1) {
                        $('#ukuranCheck').prop('checked', true); 

                        $('.f_ukuran').slideDown(300);
                        $('.f_ukuran_pertama').remove();
                        $('.list_baru_ukuran').slideDown(300);

                        $('.list_u').remove();
                        
                        var i = 999;
                        jQuery.each(data.ukuran, function(r,val) {

                            list = 
                                `
                                <div class="row list_u" id="list_ukuran`+i+`">
                                    <div class="col-md-4 offset-md-2">
                                        <div class="form-group row p-0">
                                            <label for="ukuran" class="col-sm-12 col-form-label">Ukuran</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control input_ukuran ukuran" id="ukuran`+i+`" name="ukuran" judul="ukuran" placeholder="Contoh: Large.." value="`+val.ukuran+`">
                                                <span class="text-danger" id="ukuran`+i+`_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row p-0">
                                            <label for="harga_ukuran" class="col-sm-12 col-form-label">Harga</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="text" class="form-control number_separator numeric text-right input_ukuran harga_ukuran" id="harga_ukuran`+i+`" name="harga_ukuran" judul="Harga Ukuran" placeholder="0" value="`+val.harga+`">
                                                </div>
                                                <span class="text-danger" id="harga_ukuran`+i+`_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row p-0">
                                            <div class="col-sm-12" style="margin-top: 35px;">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+i+`"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                `;    

                            $('.list_baru_ukuran').append(list);
                            $('#list_ukuran'+i).hide().slideDown();

                            $('.number_separator').divide({
                                delimiter:'.',
                                divideThousand: true, // 1,000..9,999
                                delimiterRegExp: /[\.\,\s]/g
                            });

                            $('.numeric').numericOnly();
                            
                            i++;
                            
                        })

                    } else {
                        $('#ukuranCheck').prop('checked', false);
                    }

                    if (data.produk.h_topping == 1) {
                        $('#toppingCheck').prop('checked', true); 

                        $('.f_topping').slideDown(300);
                        $('.f_topping_pertama').remove();
                        $('.list_baru_topping').slideDown(300);

                        var i = 999;
                        jQuery.each(data.topping, function(r,val) {

                            list = 
                                `
                                <div class="row list_t" id="list_topping`+i+`">
                                    <div class="col-md-4 offset-md-2">
                                        <div class="form-group row p-0">
                                            <label for="topping`+i+`" class="col-sm-12 col-form-label">Topping</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control input_topping topping" id="topping`+i+`" name="topping`+i+`" no="`+i+`" judul="topping" placeholder="Contoh: Coklat.." value="`+val.topping+`">
                                                <span class="text-danger" id="topping`+i+`_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row p-0">
                                            <label for="harga_topping`+i+`" class="col-sm-12 col-form-label">Harga</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="text" class="form-control number_separator numeric text-right input_topping harga_topping" id="harga_topping`+i+`" name="harga_topping`+i+`" judul="Harga Topping" no="`+i+`" placeholder="0" value="`+val.harga+`">
                                                </div>
                                                <span class="text-danger" id="harga_topping`+i+`_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row p-0">
                                            <div class="col-sm-12" style="margin-top: 35px;">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+i+`"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                `;    

                            $('.list_baru_topping').append(list);
                            $('#list_topping'+i).hide().slideDown();

                            $('.number_separator').divide({
                                delimiter:'.',
                                divideThousand: true, // 1,000..9,999
                                delimiterRegExp: /[\.\,\s]/g
                            });

                            $('.numeric').numericOnly();
                            
                            i++;
                            
                        })
                        
                    } else {
                        $('#toppingCheck').prop('checked', false);
                    }

                    if (data.produk.h_status == 1) {
                        $('#statusCheck').prop('checked', true); 

                        $('.f_status').slideDown(300);
                        $('.f_status_pertama').remove();
                        $('.list_baru_status').slideDown(300);

                        var i = 999;
                        jQuery.each(data.status, function(r,val) {

                            list = 
                                `
                                <div class="row list_s mt-2" id="list_status`+i+`">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group row p-0">
                                            <label for="status" class="col-sm-3 col-form-label">Nama Status</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input_status status" id="status`+i+`" name="status`+i+`" judul="status" placeholder="Contoh: Diproses.." value="`+val.status+`">
                                                <span class="text-danger" id="status`+i+`_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row p-0">
                                            <div class="col-sm-12" style="margin-top: 5px;">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+i+`"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                `;    

                            $('.list_baru_status').append(list);
                            $('#list_status'+i).hide().slideDown();
                            
                            i++;
                            
                        })
                        
                    } else {
                        $('#statusCheck').prop('checked', false);
                    }

                    if (data.produk.h_stok == 1) {
                        $('#stokCheck').prop('checked', true); 

                        $('.f_stok').slideDown(300);

                        $('.stok_p').val(data.stok.stok);
                        $('#id_stok').val(data.stok.id);
                        $('#satuan_stok').val(data.stok.id_satuan).trigger('change');

                        if (data.stok.h_expire_date == 1) {
                            $('#expiredCheck').prop('checked', true);

                            $('.f_expired').slideDown(300);

                            $('#id_expire').val(data.expire.id);
                            $('#tgl_expired').val(data.expire.expire_date);
                        } else {
                            $('#expiredCheck').prop('checked', false);
                        }
                        
                    } else {
                        $('#stokCheck').prop('checked', false);
                    }

                    if (data.produk.h_split == 1) {
                        $('#splitCheck').prop('checked', true); 

                        $('.f_split').slideDown(300);
                        $('.f_split_pertama').remove();
                        $('.list_baru_split').slideDown(300);

                        var a = 999;
                        jQuery.each(data.split, function(r,val) {

                            list = 
                                `
                                <div class="row list_p" id="list_split`+a+`">
                                    <div class="col-md-4 offset-md-2">
                                        <div class="form-group row p-0">
                                            <label for="split`+a+`" class="col-sm-12 col-form-label">Split</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control input_split input_split2 split" id="split`+a+`" name="split`+a+`" no="`+a+`" judul="nama split" placeholder="Contoh: Pemilik.." value="`+val.split+`">
                                                <span class="text-danger" id="split`+a+`_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row p-0">
                                            <label for="komisi`+a+`" class="col-sm-12 col-form-label">Komisi</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Rp. </span>
                                                    </div>
                                                    <input type="text" class="form-control number_separator numeric text-right komisi input_split2" id="komisi`+a+`" name="komisi`+a+`" no="`+a+`" judul="Komisi" placeholder="0" value="`+val.harga+`">
                                                </div>
                                                <span class="text-danger" id="komisi`+a+`_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row p-0">
                                            <div class="col-sm-12" style="margin-top: 35px;">
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+a+`"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                `;    

                            $('.list_baru_split').append(list);
                            $('#list_split'+a).hide().slideDown();

                            $('.number_separator').divide({
                                delimiter:'.',
                                divideThousand: true, // 1,000..9,999
                                delimiterRegExp: /[\.\,\s]/g
                            });

                            $('.numeric').numericOnly();

                            a++;
                            
                        })
                        
                    } else {
                        $('#splitCheck').prop('checked', false);
                    }

                    $('#modal_produk').modal('show');
                }
            })

            
            
        })

        // 10-12-2020
        $('#tabel_produk').on('click', '.detail_produk', function () {

            var id_produk = $(this).data('id');

            $('#aksi').val('Detail');

            $('.f_detail').html('');

            $.ajax({
                url     : "<?= base_url() ?>Produk/form_detail_produk",
                method  : "POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data    : {id_produk:id_produk},
                success : function (data) {
                    swal.close();

                    $('.f_detail').html(data);
                    $('#modal_detail').modal('show');

                }
            })
            
        })

        // 08-12-2020
        var drEvent = $('.dropify').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Apakah yakin akan menghapus foto: \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            // alert('File deleted');
            $('#status_foto').val('1');
        });

        // 29-11-2020
        $('input[name=s_discount]').on('click', function () {

            var isi         = $(this).val();
            var aksi        = $('#aksi').val();
            var discount    = $('#discount2').val();

            if (aksi == 'Tambah') {
                $('#discount').val('0');
                $('#nilai_diskon').val('0'); 
            } else {
                if (isi == 'persen') {
                    $('#discount').val('0');
                } else {
                    $('#discount').val(discount);
                }
            }

            $('#jenis').val(isi);
            
        })

        // 29-11-2020
        $('#discount').on('keyup', function () {

            var jenis       = $('#jenis').val();
            var value       = $('#discount').val().split('.').join('');
            var harga_jual  = $('#harga_jual').val().split('.').join('');

            var rp_diskon = 0;

            if (jenis == 'persen') {
                $('#discount').val(Math.max(Math.min(value, 100), -100));  

                if (value > 100) {
                    rp_diskon = harga_jual;
                } else {
                    rp_diskon = (value * harga_jual) / 100; 
                }
            } else {

                $('#discount').val(Math.max(Math.min(value, harga_jual), -harga_jual));  

                if (parseInt(value) > parseInt(harga_jual)) {
                    rp_diskon = harga_jual;
                } else {
                    rp_diskon = value;
                }
            }

            $('#nilai_diskon').val(rp_diskon);
        })

        // 20-11-2020
        $('#bhnbakuCheck').on('change', function () {

            if ($(this).is(':checked')) {
                $('.f_bahan').slideDown(300);
                $('.tambah_baru').fadeIn();
                $('.list_baru').slideDown(300);
            } else {
                $('.f_bahan').slideUp(300);
                $('.tambah_baru').fadeOut();
                $('.list_baru').slideUp(300);
            }
            
        })

        // 20-11-2020 && 26-11-2020
        $('.list_baru').on('change', '.bahan_baku', function () {

            var satuan  = $(this).find('option:selected').attr('satuan');
            var no      = $(this).attr('no');

            var t_satuan = '';
            if (satuan == '') {
                t_satuan = 'satuan';
            } else {
                t_satuan = satuan;
            }

            $('.t_satuan'+no).text(t_satuan);
            
        })

        // 25-11-2020
        $('#bahan_baku0').on('change', function () {

            var satuan  = $(this).find('option:selected').attr('satuan');

            var t_satuan = '';
            if (satuan == '') {
                t_satuan = 'satuan';
            } else {
                t_satuan = satuan;
            }

            $('.t_satuan0').text(t_satuan);

        })

        // 20-11-2020
        $('#tambah_bahan_baku_baru').on('click', function () {

            
            $('.f_bahan').slideUp(100);
            $('.c_bahan_baku').fadeOut(100);
            $('.f_bahan_baru').slideDown('slow');
            $('.ft_modal').fadeOut(100);
            $('.tambah_baru').fadeOut(100);
            $('.batal_baru').fadeIn(100);
            $('.list_baru').fadeOut(100);

            $('#nama_bahan').val('');
            $('#satuan2').val('').trigger('change');
            $('#stok_bahan').val(1);
            $('#harga_bahan').val('');  

            $('.input_bahan_baku').each(function () {
                
                var aksi  = $(this).attr('id');

                $("#"+aksi+"_error").attr('hidden', true);

            })

        })

        // 20-11-2020
        $('.batal_baru').on('click', function () {

            $('.batal_baru').fadeOut('fast');
            $('.f_bahan').slideDown(300);
            $('.c_bahan_baku').fadeIn();
            $('.f_bahan_baru').slideUp(300);
            $('.ft_modal').fadeIn();
            $('.tambah_baru').fadeIn();
            $('.list_baru').fadeIn();

        })
        var i = 1;

        // 23-11-2020
        $('#tambahkan_list_baru').on('click', function () {

            list = 
                `
                <div class="row bb" id="list`+i+`">
                    <div class="col-md-4 offset-md-2">
                        <div class="form-group row p-0">
                            <label for="bahan_baku`+i+`" class="col-sm-12 col-form-label">Bahan Baku</label>
                            <div class="col-sm-12">
                                <select name="bahan_baku`+i+`" id="bahan_baku`+i+`" judul="Bahan Baku" class="bahan_baku input_bahan form-control" no="`+i+`">
                                    <option value="" satuan="">Pilih Bahan Baku</option>
                                    <?php foreach ($bahan_baku as $b): ?>
                                        <option value="<?= $b['id'] ?>" satuan="<?= $b['satuan'] ?>"><?= $b['bahan_baku'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger" id="bahan_baku`+i+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row p-0">
                            <label for="takaran2" class="col-sm-12 col-form-label">Takaran</label>
                            <div class="col-sm-12">
                                
                                <div class="input-group">
                                    <input type="text" class="form-control numeric text-right input_bahan takaran" id="takaran`+i+`" name="takaran`+i+`" no="`+i+`" judul="Takaran" placeholder="0">
                                    <div class="input-group-append">
                                        <span class="input-group-text t_satuan`+i+`">satuan</span>
                                    </div>
                                </div>
                                <span class="text-danger" id="takaran`+i+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row p-0">
                            <div class="col-sm-12" style="margin-top: 35px;">
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+i+`"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                `;    

            $('.list_baru').append(list);
            $('#list'+i).hide().slideDown();

            $('.numeric').numericOnly();

            i++;

        })

        // 23-11-2020
        $('.list_baru').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list'+id).slideUp(function(){ $(this).remove();});

        });

        // 20-11-2020
        $('.tabel_list_bahanbaku').on('click', '.hapus-list', function () {

            var no              = $(this).attr('no');
            var id_bhn_baku     = $(this).attr('id_bhn_baku');
            var nm_bhn_baku     = $(this).attr('nm_bhn_baku');
            var satuan          = $(this).attr('satuan');

            $(".list_"+no).remove();

            $('#bahan_baku').append($("<option></option>")
                    .attr("value", id_bhn_baku)
                    .attr("satuan", satuan)
                    .text(nm_bhn_baku)); 
            
        })

        // 20-11-2020
        $('#simpan_bahan_baku').on('click', function () {

            var angka = -1;

            var i=1;
            $('.input_bahan_baku').each(function () {

                var aksi  = $(this).attr('id');
                var judul = $(this).attr('judul');
                var isi   = $(this).val();

                if (isi == '') {

                    $("#"+aksi+"_error").removeAttr('hidden');
                    
                    $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                    $(this).on('keyup change', function () {

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

                

            });
            
            if (angka == 9) {

                // var form_bahan_baru  = $('#form_bahan_baru').serialize();

                $('#simpan_bahan_baku').addClass('btn-progress disabled');

                $.ajax({
                    url     : "<?= base_url() ?>Produk/simpan_bahan_baku_baru",
                    type    : "POST",
                    data    : {
                        nama_bahan  : $('#nama_bahan').val(),
                        satuan      : $('#satuan2').val(),
                        stok_bahan  : $('#stok_bahan').val(),
                        harga_bahan : $('#harga_bahan').val()   
                    },
                    dataType: "JSON",
                    success : function (data) {

                        $('#simpan_bahan_baku').removeClass('btn-progress disabled');

                        if (data.status == 'sama') {
                            
                            swal({
                                title               : "Gagal",
                                text                : 'Bahan Baku sudah ada!',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
                            });

                        } else {
      
                            $('#form_bahan_baru').trigger("reset");

                            $('.batal_baru').fadeOut('fast');
                            $('.f_bahan').slideDown(300);
                            $('.c_bahan_baku').fadeIn();
                            $('.f_bahan_baru').slideUp(300);
                            $('.ft_modal').fadeIn();
                            $('.tambah_baru').fadeIn();
                            $('.list_baru').fadeIn();

                            $('.bahan_baku').html(data.option);
                            
                        }
                        
                    }
                })

                return false;

            }
            
        })

        // 20-11-2020
        $('#ukuranCheck').on('change', function () {

            if ($(this).is(':checked')) {
                $('.f_ukuran').slideDown(300);
                $('.list_baru_ukuran').slideDown(300);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $('.f_ukuran').slideDown('fast').slideUp(300);
                $('.list_baru_ukuran').slideUp(300);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 23-11-2020 && 26-11-2020
        $('#tambah_ukuran').on('click', function () {

            list = 
                `
                <div class="row list_u" id="list_ukuran`+i+`">
                    <div class="col-md-4 offset-md-2">
                        <div class="form-group row p-0">
                            <label for="ukuran" class="col-sm-12 col-form-label">Ukuran</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control input_ukuran ukuran" id="ukuran`+i+`" name="ukuran" judul="ukuran" placeholder="Contoh: Large..">
                                <span class="text-danger" id="ukuran`+i+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row p-0">
                            <label for="harga_ukuran" class="col-sm-12 col-form-label">Harga</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control number_separator numeric text-right input_ukuran harga_ukuran" id="harga_ukuran`+i+`" name="harga_ukuran" judul="Harga Ukuran" placeholder="0">
                                </div>
                                <span class="text-danger" id="harga_ukuran`+i+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row p-0">
                            <div class="col-sm-12" style="margin-top: 35px;">
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+i+`"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                `;    

            $('.list_baru_ukuran').append(list);
            $('#list_ukuran'+i).hide().slideDown();

            $('.number_separator').divide({
                delimiter:'.',
                divideThousand: true, // 1,000..9,999
                delimiterRegExp: /[\.\,\s]/g
            });

            $('.numeric').numericOnly();
            
            i++;
            
        })

        // 26-11-2020
        $('.input_ukuran').on('keyup', function () {
            
            var aksi  = $(this).attr('id');
            var judul = $(this).attr('judul');
            var isi   = $(this).val();

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_ukuran').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#tambah_ukuran').attr('disabled', false);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 26-11-2020
        $('.list_baru_ukuran').on('keyup', '.input_ukuran', function () {
            
            var aksi  = $(this).attr('id');
            var judul = $(this).attr('judul');
            var isi   = $(this).val();

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_ukuran').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#tambah_ukuran').attr('disabled', false);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 23-11-2020 && 26-11-2020
        $('.list_baru_ukuran').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_ukuran'+id).slideUp(function(){ $(this).remove();});

            $('#tambah_ukuran').attr('disabled', false);

            $('#simpan_produk').attr('disabled', false);

        });

        // 29-11-2020
        $('#statusCheck').on('change', function () {

            if ($(this).is(':checked')) {
                $('.f_status').slideDown(300);
                $('.list_baru_status').slideDown(300);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $('.f_status').slideDown('fast').slideUp(300);
                $('.list_baru_status').slideUp(300);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 29-11-2020
        $('#tambah_status').on('click', function () {

            list = 
                `
                <div class="row list_s" id="list_status`+i+`">
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group row p-0">
                            <label for="status" class="col-sm-3 col-form-label">Nama Status</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input_status status" id="status`+i+`" name="status`+i+`" judul="status" placeholder="Contoh: Diproses..">
                                <span class="text-danger" id="status`+i+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row p-0">
                            <div class="col-sm-12" style="margin-top: 5px;">
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+i+`"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                `;    

            $('.list_baru_status').append(list);
            $('#list_status'+i).hide().slideDown();

            i++;

        })

        // 29-11-2020
        $('.input_status').on('keyup', function () {
            
            var aksi  = $(this).attr('id');
            var judul = $(this).attr('judul');
            var isi   = $(this).val();

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_status').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#tambah_status').attr('disabled', false);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 29-11-2020
        $('.list_baru_status').on('keyup', '.input_status', function () {
            
            var aksi  = $(this).attr('id');
            var judul = $(this).attr('judul');
            var isi   = $(this).val();

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_status').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#tambah_status').attr('disabled', false);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 29-11-2020
        $('.list_baru_status').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_status'+id).slideUp(function(){ $(this).remove();});

            $('#tambah_status').attr('disabled', false);

            $('#simpan_produk').attr('disabled', false);

        });

        // 20-11-2020
        $('#toppingCheck').on('change', function () {

            if ($(this).is(':checked')) {
                $('.f_topping').slideDown(300);
                $('.list_baru_topping').slideDown(300);
            } else {
                $('.f_topping').slideUp(300);
                $('.list_baru_topping').slideUp(300);
            }

        })

        // 23-11-2020 && 26-11-2020
        $('#tambah_topping').on('click', function () {

            list = 
                `
                <div class="row list_t" id="list_topping`+i+`">
                    <div class="col-md-4 offset-md-2">
                        <div class="form-group row p-0">
                            <label for="topping`+i+`" class="col-sm-12 col-form-label">Topping</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control input_topping topping" id="topping`+i+`" name="topping`+i+`" no="`+i+`" judul="topping" placeholder="Contoh: Coklat..">
                                <span class="text-danger" id="topping`+i+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row p-0">
                            <label for="harga_topping`+i+`" class="col-sm-12 col-form-label">Harga</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control number_separator numeric text-right input_topping harga_topping" id="harga_topping`+i+`" name="harga_topping`+i+`" judul="Harga Topping" no="`+i+`" placeholder="0">
                                </div>
                                <span class="text-danger" id="harga_topping`+i+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row p-0">
                            <div class="col-sm-12" style="margin-top: 35px;">
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+i+`"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                `;    

            $('.list_baru_topping').append(list);
            $('#list_topping'+i).hide().slideDown();

            $('.number_separator').divide({
                delimiter:'.',
                divideThousand: true, // 1,000..9,999
                delimiterRegExp: /[\.\,\s]/g
            });

            $('.numeric').numericOnly();

            i++;

        })

        // 26-11-2020
        $('.input_topping').on('keyup', function () {
            
            var aksi  = $(this).attr('id');
            var judul = $(this).attr('judul');
            var isi   = $(this).val();

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_topping').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#tambah_topping').attr('disabled', false);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 26-11-2020
        $('.list_baru_topping').on('keyup', '.input_topping', function () {
            
            var aksi  = $(this).attr('id');
            var judul = $(this).attr('judul');
            var isi   = $(this).val();

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_topping').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#tambah_topping').attr('disabled', false);
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 23-11-2020 && 26-11-2020
        $('.list_baru_topping').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_topping'+id).slideUp(function(){ $(this).remove();});

            $('#tambah_topping').attr('disabled', false);

            $('#simpan_produk').attr('disabled', false);

        });

        // 20-11-2020
        $('#stokCheck').on('change', function () {

            if ($(this).is(':checked')) {
                $('.f_stok').slideUp('fast').slideDown(300);

                $('#simpan_produk').attr('disabled', true);
            } else {
                $('.f_stok').slideDown('fast').slideUp(300);

                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 26-11-2020
        $('#tambah_satuan').on('click', function () {

            $('.btn_tambah_sat').attr('hidden', true);
            $('.satuan_lama').attr('hidden', true);
            $('.btn_batal_sat').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.satuan_baru').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#status_satuan').val('baru');

            $('#nama_satuan').val('');
            // $('#satuan_stok').val(1).trigger('change');
            $("#nama_satuan_error").attr('hidden', false);
            $("#satuan_stok_error").attr('hidden', true);

            $('#expiredCheck').attr('disabled', true);

            $('#simpan_produk').attr('disabled', true);
        })

        // 26-11-2020
        $('#batal_satuan').on('click', function () {

            $('.btn_tambah_sat').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.satuan_lama').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.btn_batal_sat').attr('hidden', true);
            $('.satuan_baru').attr('hidden', true);
            $('#status_satuan').val('lama');

            $('#satuan_stok').val('').trigger('change');
            $("#nama_satuan_error").attr('hidden', true);
            $("#satuan_stok_error").attr('hidden', false);

            $('#expiredCheck').attr('disabled', true);

        })

        // 27-11-2020
        $('#satuan_stok').on('change', function () {

            var isi         = $(this).val();
            var status      = $('#status_satuan').val();
            var nama_satuan = $('#nama_satuan').val();

            if (isi == '') {
                $('#expiredCheck').attr('disabled', true);
            } else {
                $('#expiredCheck').attr('disabled', false);
            }
            
        })

        // 27-11-2020
        $('#nama_satuan').on('keyup', function () {

            var isi         = $(this).val();

            if (isi == '') {
                $('#expiredCheck').attr('disabled', true);
            } else {
                $('#expiredCheck').attr('disabled', false);
            }
            
        })

        // 26-11-2020
        $('.input_satuan').on('keyup change', function () {
            
            var aksi  = $(this).attr('id');
            var judul = $(this).attr('judul');
            var isi   = $(this).val();

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 20-11-2020
        $('#expiredCheck').on('change', function () {

            if ($(this).is(':checked')) {
                $('.f_expired').slideUp('fast').slideDown(300);
            } else {
                $('.f_expired').slideDown('fast').slideUp(300);
            }

        })

        // 20-11-2020
        $('#splitCheck').on('change', function () {

            if ($(this).is(':checked')) {
                $('.f_split').slideDown(300);
                $('.list_baru_split').slideDown(300);

                $('#simpan_produk').attr('disabled', true);
            } else {
                $('.f_split').slideUp(300);
                $('.list_baru_split').slideUp(300);

                $('#simpan_produk').attr('disabled', false);
            }

        })

        var a = 3;
        // 23-11-2020 && 26-11-2020
        $('#tambah_split').on('click', function () {

            list = 
                `
                <div class="row" id="list_split`+a+`">
                    <div class="col-md-4 offset-md-2">
                        <div class="form-group row p-0">
                            <label for="split`+a+`" class="col-sm-12 col-form-label">Split</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control input_split input_split2 split" id="split`+a+`" name="split`+a+`" no="`+a+`" judul="nama split" placeholder="Contoh: Pemilik..">
                                <span class="text-danger" id="split`+a+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row p-0">
                            <label for="komisi`+a+`" class="col-sm-12 col-form-label">Komisi</label>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp. </span>
                                    </div>
                                    <input type="text" class="form-control number_separator numeric text-right komisi input_split2" id="komisi`+a+`" name="komisi`+a+`" no="`+a+`" judul="Komisi" placeholder="0" value="0">
                                </div>
                                <span class="text-danger" id="komisi`+a+`_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row p-0">
                            <div class="col-sm-12" style="margin-top: 35px;">
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+a+`"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                `;    

            $('.list_baru_split').append(list);
            $('#list_split'+a).hide().slideDown();

            $('.number_separator').divide({
                delimiter:'.',
                divideThousand: true, // 1,000..9,999
                delimiterRegExp: /[\.\,\s]/g
            });

            $('.numeric').numericOnly();

            a++;

        })

        // 26-11-2020
        $('#komisi1').on('keyup', function () {

            var isi         = $(this).val().split('.').join('');
            var judul       = $(this).attr('judul');
            var harga_jual  = $('#harga_jual').val().split('.').join('');
            var sisa        = harga_jual - isi;

            $(this).val(Math.max(Math.min(isi, harga_jual), -harga_jual));

            if (isi == '') {
                $("#komisi1_error").attr('hidden', false);
                $("#komisi1_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_split').attr('disabled', true);
            } else {
                $("#komisi1_error").attr('hidden', true);

                $('#tambah_split').attr('disabled', false);
            }

            if (sisa < 0 || sisa == 0) {
                sisa = 0;
                $('#komisi1_nilai_error').attr('hidden', false);
                $('#komisi1_nilai_error').text('Nilai komisi harus kurang dari '+separator(harga_jual));

                $('#simpan_produk').attr('disabled', true);
                $('#tambah_split').attr('disabled', true);
            } else {
                sisa = sisa;
                $('#komisi1_nilai_error').attr('hidden', true);

                if (parseInt(harga_jual) == (parseInt(sisa) + parseInt(isi))) {
                    $('#tambah_split').attr('disabled', true);
                } else {
                    $('#tambah_split').attr('disabled', false);
                }
                $('#simpan_produk').attr('disabled', false);
                
            }

            $('#nilai_harga_jual').val(sisa);

            // $('#komisi2').val(separator(sisa));
        })

        // 26-11-2020
        $('#komisi2').on('keyup', function () {

            var isi         = $(this).val().split('.').join('');
            var judul       = $(this).attr('judul');
            var komisi1     = $("#komisi1").val().split('.').join('');
            var harga_jual  = $('#harga_jual').val().split('.').join('');

            var harga_a     = harga_jual - komisi1;
            var sisa        = harga_a - isi;

            $(this).val(Math.max(Math.min(isi, harga_a), -harga_a));

            if (sisa < 0) {
                sisa = 0;
                $('#komisi2_nilai_error').attr('hidden', false);
                $('#komisi2_nilai_error').text('Nilai komisi harus lebih dari '+separator(harga_a));

                $('#simpan_produk').attr('disabled', true);
                $('#tambah_split').attr('disabled', true);
            } else {
                sisa = sisa;
                $('#komisi12nilai_error').attr('hidden', true);
                $('#simpan_produk').attr('disabled', false);
                
                if (parseInt(harga_jual) == (parseInt(sisa) + parseInt(isi) + parseInt(komisi1))) {
                    $('#tambah_split').attr('disabled', true);
                } else {
                    $('#tambah_split').attr('disabled', false);
                }
            }

            if (isi == '' || isi == 0) {
                $("#komisi2_error").attr('hidden', false);
                $("#komisi2_error").text("Harap isi "+judul.toLowerCase());

                $('#simpan_produk').attr('disabled', true);
                $('#tambah_split').attr('disabled', true);
            } else {
                $("#komisi2_error").attr('hidden', true);
                $('#simpan_produk').attr('disabled', false);

                var k2 = $('#komisi2').val().split('.').join('');

                if (parseInt(harga_jual) == (parseInt(k2) + parseInt(komisi1))) {
                    $('#tambah_split').attr('disabled', true);
                } else {
                    $('#tambah_split').attr('disabled', false);
                }
            }

            $('#nilai_harga_jual').val(sisa);

        })

        // 26-11-2020
        $('.input_split').on('keyup change', function () {
            
            var aksi        = $(this).attr('id');
            var judul       = $(this).attr('judul');
            var isi         = $(this).val();
            var nilai_hg    = $('#nilai_harga_jual').val();

            var isi2   = $('#'+aksi).val().split('.').join('');

            if (isi2 == '' || isi2 == 0) {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_split').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                
                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 29-11-2020
        $('.list_baru_split').on('keyup', '.input_split2', function () {
            
            var aksi        = $(this).attr('id');
            var no          = $(this).attr('no');
            var judul       = $(this).attr('judul');
            var isi         = $(this).val().split('.').join('');
            var nilai_sisa  = $('#nilai_harga_jual').val();
            var isi3        = $('#komisi'+no).val().split('.').join('');

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_split').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                $('#komisi'+no).val(Math.max(Math.min(isi3, nilai_sisa), -nilai_sisa));

                var isi4 = 0;
                if (parseInt(isi3) > parseInt(nilai_sisa)) {
                    isi4 = nilai_sisa;
                } else {
                    isi4 = isi;
                }

                var a = nilai_sisa - isi4;

                console.log(a)

                if (a == '0') {
                    $('#tambah_split').attr('disabled', true);
                } else {
                    $('#tambah_split').attr('disabled', false);
                }

                if (!isNaN(a)) {
                   $('#nilai_harga_jual').val(a); 
                }

                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 26-11-2020
        $('.list_baru_split').on('keyup', '.input_split', function () {
            
            var aksi        = $(this).attr('id');
            var no          = $(this).attr('no');
            var judul       = $(this).attr('judul');
            var isi         = $(this).val();
            var nilai_sisa  = $('#nilai_harga_jual').val();
            var isi3        = $('#komisi'+no).val().split('.').join('');

            var isi2   = $('#'+aksi).val();

            if (isi2 == '') {
                $("#"+aksi+"_error").attr('hidden', false);
                $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                $('#tambah_split').attr('disabled', true);
                $('#simpan_produk').attr('disabled', true);
            } else {
                $("#"+aksi+"_error").attr('hidden', true);

                // $('#komisi'+no).val(Math.max(Math.min(isi3, nilai_sisa), -nilai_sisa));

                // if (parseInt(isi3) > parseInt(nilai_sisa)) {
                //     isi = nilai_sisa;
                // } else {
                //     isi = isi3;
                // }

                // var a = parseInt(nilai_sisa) - parseInt(isi);

                // if (a == '0') {
                //     $('#tambah_split').attr('disabled', true);
                // } else {
                //     $('#tambah_split').attr('disabled', false);
                // }

                // if (!isNaN(a)) {
                //    $('#nilai_harga_jual').val(a); 
                // }

                $('#simpan_produk').attr('disabled', false);
            }

        })

        // 23-11-2020
        $('.list_baru_split').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_split'+id).slideUp(function(){ $(this).remove();});

            $('#tambah_split').attr('disabled', false);

        });

        // 19-11-2020
        $('#kategori').on('change', function () {

            $('#tabel_produk tbody').empty();
            tabel_produk.ajax.reload(null, false);
            
        })

        // 19-11-2020
        $('input[name="status_tampil"]').on('click', function () {

            $('#tabel_produk tbody').empty();
            tabel_produk.ajax.reload(null, false);
            
        })

        // 19-11-2020
        $('#tambah_produk').on('click', function () {

            $('.title_produk').html("<i class='fa fa-plus mr-3'></i>Tambah Produk");
            $('#modal_produk').modal('show');

            $('.input_produk').each(function () {
                
                var aksi  = $(this).attr('id');

                $("#"+aksi+"_error").attr('hidden', true);

            })

            $('.btn_tambah').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.kat_lama').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.btn_batal').attr('hidden', true);
            $('.kat_baru').attr('hidden', true);
            $('#status_kategori').val('lama');

            $('#id_kategori').val('').trigger('change');
            $("#nama_kategori_error").attr('hidden', true);
            $("#id_kategori_error").attr('hidden', true);

        })

        // 19-11-2020
        $('.dropify').dropify({
	        messages: 
	        {
	            'default': 'Drag file atau klik di sini',
	            'replace': 'Drag file atau klik di sini',
	            'remove':  'Hapus',
	            'error':   'Maaf, ada kesalahan.'
	        }
        });

        // 19-11-2020 && 25-11-2020
        $('#tambah_kategori').on('click', function () {

            $('.btn_tambah').attr('hidden', true);
            $('.kat_lama').attr('hidden', true);
            $('.btn_batal').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.kat_baru').attr('hidden', false).fadeOut('fast').fadeIn();
            $('#status_kategori').val('baru');

            $('#nama_kategori').val('');
            $('#id_kategori').val(1).trigger('change');
            $("#nama_kategori_error").attr('hidden', false);
            $("#id_kategori_error").attr('hidden', true);
            
        })

        // 19-11-2020 && 25-11-2020
        $('#batal_kategori').on('click', function () {

            $('.btn_tambah').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.kat_lama').attr('hidden', false).fadeOut('fast').fadeIn();
            $('.btn_batal').attr('hidden', true);
            $('.kat_baru').attr('hidden', true);
            $('#status_kategori').val('lama');

            $('#id_kategori').val('').trigger('change');
            $("#nama_kategori_error").attr('hidden', true);
            $("#id_kategori_error").attr('hidden', false);

        })

        // 19-11-2020
        $('[data-toggle="tooltip"]').click(function () {
            $('[data-toggle="tooltip"]').tooltip("hide");
        });

        // 23-11-2020 && 24-11-2020 && 25-11-2020 && 27-11-2020 && 29-11-2020
        $('#simpan_produk').on('click', function () {

            var aksi            = $('#aksi').val();
            var id_produk       = $('#id_produk').val();
            var c_bahan_baku    = $('#bhnbakuCheck').is(':checked');
            var c_ukuran        = $('#ukuranCheck').is(':checked');
            var c_topping       = $('#toppingCheck').is(':checked');
            var c_status        = $('#statusCheck').is(':checked');
            var c_stok          = $('#stokCheck').is(':checked');
            var c_split         = $('#splitCheck').is(':checked');
            var c_expired       = $('#expiredCheck').is(':checked');
            var c_tampil        = $('#checkTampil').is(':checked');

            var id_umkm         = $('#id_umkm').val();
            var nama_produk     = $('#nama_produk').val();
            var id_kategori     = $('#id_kategori').val();
            var nama_kategori   = $('#nama_kategori').val();
            var harga_dasar     = $('#harga_dasar').val().split('.').join('');
            var harga_jual      = $('#harga_jual').val().split('.').join('');
            var discount        = $('#nilai_diskon').val();

            var sts_kategori    = $('#status_kategori').val();

            var status_stn      = $('#status_satuan').val();
            var isi_nama        = $('#nama_satuan').val();
            var isi_satuan      = $('#satuan_stok').val();

            var tgl_expired     = $('#tgl_expired').val();
            var stok            = $('.stok_p').val();

            var id_stok         = $('#id_stok').val();
            var id_expire       = $('#id_expire').val();

            var status_bahan_baku;
            if (c_bahan_baku) {
                status_bahan_baku = 1;
            } else {
                status_bahan_baku = 0;
            }
            var status_ukuran;
            if (c_ukuran) {
                status_ukuran = 1;
            } else {
                status_ukuran = 0;
            }
            var status_topping;
            if (c_topping) {
                status_topping = 1;
            } else {
                status_topping = 0;
            }
            var status_status;
            if (c_status) {
                status_status = 1;
            } else {
                status_status = 0;
            }
            var status_stok;
            if (c_stok) {
                status_stok = 1;
            } else {
                status_stok = 0;
            }
            var status_split;
            if (c_split) {
                status_split = 1;
            } else {
                status_split = 0;
            }
            var status_expired;
            if (c_expired) {
                status_expired = 1;
            } else {
                status_expired = 0;
            }
            var status_tampil;
            if (c_tampil) {
                status_tampil = 1;
            } else {
                status_tampil = 0;
            }

            var angka = -1;

            var i=1;
            $('.input_produk').each(function () {

                var aksi  = $(this).attr('id');
                var judul = $(this).attr('judul');
                var isi   = $(this).val();
                

                if (isi == '') {
                    
                    $("#"+aksi+"_error").removeAttr('hidden');
                    
                    $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                    if (sts_kategori == 'lama') {

                        if ($('#id_kategori').val() == '') {
                            $("#nama_kategori_error").attr('hidden', true);
                            $("#id_kategori_error").attr('hidden', false);
                        
                            $('#nama_kategori').val('a');
                            $("#id_kategori_error").text("Harap isi kategori");
                            
                            $('#status_simpan_produk_atas').val('no');
                        } else {
                            $("#nama_kategori_error").attr('hidden', true);
                            
                            $('#status_simpan_produk_atas').val('ok');
                        }
                        
                    } else {

                        if ($('#nama_kategori').val() == '') {
                            $("#id_kategori_error").attr('hidden', true);
                            $("#nama_kategori_error").attr('hidden', false);
                        
                            $('#id_kategori').val(1).trigger('change');
                            $("#nama_kategori_error").text("Harap isi kategori");

                            $('#status_simpan_produk_atas').val('no');
                        } else {
                            $("#id_kategori_error").attr('hidden', true);

                            $('#status_simpan_produk_atas').val('ok');
                        }

                        
                    }

                    $(this).on('keyup change', function () {

                        var isi2   = $('#'+aksi).val();

                        if (isi2 == '') {
                            
                            $("#"+aksi+"_error").attr('hidden', false);
                            $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                            if (sts_kategori == 'lama') {

                                if ($('#id_kategori').val() == '') {
                                    $("#nama_kategori_error").attr('hidden', true);
                                    $("#id_kategori_error").attr('hidden', false);
                                
                                    // $('#nama_kategori').val('a');
                                    $("#id_kategori_error").text("Harap isi kategori");

                                    $('#status_simpan_produk_atas').val('no');
                                }

                            } else {

                                if ($('#nama_kategori').val() == '') {
                                    $("#id_kategori_error").attr('hidden', true);
                                    $("#nama_kategori_error").attr('hidden', false);
                                
                                    // $('#id_kategori').val(1).trigger('change');
                                    $("#nama_kategori_error").text("Harap isi kategori");

                                    $('#status_simpan_produk_atas').val('no');
                                }
                                
                            }
                        } else {
                            $("#"+aksi+"_error").attr('hidden', true);

                            if (sts_kategori == 'lama') {
                                // $("#nama_kategori_error").attr('hidden', true);
                                if ($('#id_kategori').val() != '') {
                                    $("#id_kategori_error").attr('hidden', true);

                                    $('#status_simpan_produk_atas').val('no');
                                }
                                
                            
                                // $("#id_kategori_error").text("Harap isi kategori");
                            } else {
                                // $("#id_kategori_error").attr('hidden', true);
                                if ($('#nama_kategori').val() == '') {
                                    $("#nama_kategori_error").attr('hidden', true);

                                    $('#status_simpan_produk_atas').val('no');
                                }
                            
                                // $("#nama_kategori_error").text("Harap isi kategori");
                            }
                        }

                    })

                    $('#status_simpan_produk_atas').val('no');

                } else {
                    angka = angka + i;

                    $('#status_simpan_produk_atas').val('ok');

                    
                }i++;

            })

            if (status_ukuran == 1 || status_topping == 1 || status_status == 1 || status_split == 1 || status_stok == 1) {

                // 27-11-2020
                if (status_ukuran == 1) {
                    $('.input_ukuran').each(function () {
                            
                        var aksi  = $(this).attr('id');
                        var judul = $(this).attr('judul');
                        var isi   = $(this).val();

                        var isi2   = $('#'+aksi).val();

                        if (isi2 == '') {
                            $("#"+aksi+"_error").attr('hidden', false);
                            $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                            $('#tambah_ukuran').attr('disabled', true);
                            $('#simpan_produk').attr('disabled', true);

                            $('#status_simpan_produk').val('no');

                        } else {
                            $("#"+aksi+"_error").attr('hidden', true);

                            $('#tambah_ukuran').attr('disabled', false);
                            $('#simpan_produk').attr('disabled', false);

                            $('#status_simpan_produk').val('ok');
                            
                        }

                    })
                }   

                // 27-11-2020
                if (status_topping == 1) {
                    $('.input_topping').each(function () {
                            
                        var aksi  = $(this).attr('id');
                        var judul = $(this).attr('judul');
                        var isi   = $(this).val();

                        var isi2   = $('#'+aksi).val();

                        if (isi2 == '') {
                            $("#"+aksi+"_error").attr('hidden', false);
                            $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                            $('#tambah_topping').attr('disabled', true);
                            $('#simpan_produk').attr('disabled', true);

                            $('#status_simpan_produk').val('no');
                        } else {
                            $("#"+aksi+"_error").attr('hidden', true);

                            $('#tambah_topping').attr('disabled', false);
                            $('#simpan_produk').attr('disabled', false);

                            $('#status_simpan_produk').val('ok');
                        }

                    })
                }   

                // 29-11-2020
                if (status_status == 1) {
                    $('.input_status').each(function () {
                            
                        var aksi  = $(this).attr('id');
                        var judul = $(this).attr('judul');
                        var isi   = $(this).val();

                        var isi2   = $('#'+aksi).val();

                        if (isi2 == '') {
                            $("#"+aksi+"_error").attr('hidden', false);
                            $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                            $('#tambah_status').attr('disabled', true);
                            $('#simpan_produk').attr('disabled', true);

                            $('#status_simpan_produk').val('no');
                        } else {
                            $("#"+aksi+"_error").attr('hidden', true);

                            $('#tambah_status').attr('disabled', false);
                            $('#simpan_produk').attr('disabled', false);

                            $('#status_simpan_produk').val('ok');
                        }

                    })
                }  

                // 27-11-2020
                if (status_stok == 1) {
                
                    if (status_stn == 'lama') {
                        if (isi_satuan == '') {
                            $("#nama_satuan_error").attr('hidden', true);
                            $("#satuan_stok_error").attr('hidden', false);
                            $("#satuan_stok_error").text("Harap pilih satuan");

                            $('#simpan_produk').attr('disabled', true);

                            $('#status_simpan_produk').val('no');
                        } else {
                            $('#simpan_produk').attr('disabled', false);

                            $('#status_simpan_produk').val('ok');
                        }
                        
                    } else {
                        if (isi_nama == '') {
                            $("#satuan_stok_error").attr('hidden', true);
                            $("#nama_satuan_error").attr('hidden', false);
                            $("#nama_satuan_error").text("Harap isi nama satuan");

                            $('#simpan_produk').attr('disabled', true);

                            $('#status_simpan_produk').val('no');
                        } else {
                            $('#simpan_produk').attr('disabled', false);

                            $('#status_simpan_produk').val('ok');
                        }
                        
                    }

                }

                // 27-11-2020
                if (status_split == 1) {
                    $('.input_split2').each(function () {
                            
                        var aksi  = $(this).attr('id');
                        var judul = $(this).attr('judul');
                        var isi   = $(this).val();

                        var isi2   = $('#'+aksi).val();

                        if (isi2 == '') {
                            $("#"+aksi+"_error").attr('hidden', false);
                            $("#"+aksi+"_error").text("Harap isi "+judul.toLowerCase());

                            $('#tambah_ukuran').attr('disabled', true);
                            $('#simpan_produk').attr('disabled', true);

                            $('#status_simpan_produk').val('no');
                        } else {
                            $("#"+aksi+"_error").attr('hidden', true);

                            $('#tambah_ukuran').attr('disabled', false);
                            $('#simpan_produk').attr('disabled', false);

                            $('#status_simpan_produk').val('ok');
                        }

                    })
                }

                // 27-11-2020
                var ukuran  = [];
                $('.ukuran').each(function() { 
                    ukuran.push($(this).val()); 
                });

                var harga_ukuran  = [];
                $('.harga_ukuran').each(function() { 
                    harga_ukuran.push($(this).val().split('.').join('')); 
                });
                
                // 27-11-2020
                var topping  = [];
                $('.topping').each(function() { 
                    topping.push($(this).val()); 
                });

                var harga_topping  = [];
                $('.harga_topping').each(function() { 
                    harga_topping.push($(this).val().split('.').join('')); 
                });

                // 29-11-2020
                var status  = [];
                $('.status').each(function() { 
                    status.push($(this).val()); 
                });

                // 27-11-2020
                var split  = [];
                $('.split').each(function() { 
                    split.push($(this).val()); 
                });

                var komisi  = [];
                $('.komisi').each(function() { 
                    komisi.push($(this).val().split('.').join('')); 
                });
            
            } else {

                $('#status_simpan_produk').val('ok');

            }

            var c = $("input[type='file']").val();

            if (c) {
                sts_image = c;
            } else {
                sts_image = 'kosong';
            }

            if ($('#status_simpan_produk').val() == 'ok' && $('#status_simpan_produk_atas').val() == 'ok') {
                
                $('#simpan_produk').addClass('btn-progress disabled');

                $.ajax({
                    url     : "<?= base_url() ?>Produk/simpan_produk",
                    type    : "POST",
                    data    : {
                        aksi                : aksi,
                        id_produk           : id_produk,
                        id_umkm             : id_umkm,
                        nama_produk         : nama_produk,
                        id_kategori         : id_kategori,
                        nama_kategori       : nama_kategori,
                        harga_dasar         : harga_dasar,
                        harga_jual          : harga_jual,
                        discount            : discount,
                        status_kategori     : sts_kategori,
                        status_bahan_baku   : status_bahan_baku,
                        status_ukuran       : status_ukuran,
                        status_topping      : status_topping,
                        status_status       : status_status,
                        status_stok         : status_stok,
                        status_expired      : status_expired,
                        status_split        : status_split,
                        status_tampil       : status_tampil,
                        ukuran              : ukuran,
                        harga_ukuran        : harga_ukuran,
                        topping             : topping,
                        harga_topping       : harga_topping,
                        status              : status,
                        split               : split,
                        komisi              : komisi,
                        status_satuan       : status_stn,
                        isi_nama            : isi_nama,
                        isi_satuan          : isi_satuan,
                        tgl_expired         : tgl_expired,
                        stok                : stok,
                        id_stok             : id_stok,
                        id_expire           : id_expire
                    },
                    dataType: "JSON",
                    success : function (data) {

                        if (data.statusnya == false) {

                            if (data.status_satuan == false) {

                                swal({
                                    title               : "Gagal",
                                    text                : 'Satuan sudah ada, harap ganti',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'error',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });
                                
                            } else {

                                swal({
                                    title               : "Gagal",
                                    text                : 'Kategori sudah ada, harap ganti',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'error',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });

                            }

                            $('#simpan_produk').removeClass('btn-progress disabled');

                        } else {

                            if (sts_image != 'kosong') {
                                
                                $('#id_produk').val(data.id_produk);

                                $(".jml").text(data.jumlah+" Produk");

                                $.ajax({
                                    url         : "https://mitrabagja.com/be/updateProduk",
                                    type        : "POST",
                                    data        : new FormData($('#form_produk')[0]),
                                    processData : false,
                                    contentType : false,
                                    cache       : false,
                                    async       : false,
                                    dataType    : "JSON",
                                    success     : function (data2) {

                                        $('#simpan_produk').removeClass('btn-progress disabled');

                                        $('#modal_produk').modal('hide');

                                        swal({
                                            title               : "Berhasil",
                                            text                : 'Data sukses disimpan!',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        });
                                        
                                        tabel_produk.ajax.reload(null, false);

                                        location.reload();
                                    }
                                })

                                return false;

                            } else {

                                $('#simpan_produk').removeClass('btn-progress disabled');

                                $('#modal_produk').modal('hide');

                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data sukses disimpan!',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });
                                
                                tabel_produk.ajax.reload(null, false);

                                location.reload();
                                
                            }

                        }
                        
                    }
                })

                return false;
                
            }
            
        })

        // 25-11-2020
        $('#tabel_produk').on('click', '.delete_produk', function () {

            var id_produk   = $(this).data('id');
            var id_umkm     = $(this).attr('id_umkm');
            var produk      = $(this).attr('produk');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus produk '+produk+' ?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-success mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "https://mitrabagja.com/be/hapusProduk",
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
                        data        : {id:id_produk, id_umkm:id_umkm},
                        dataType    : "JSON",
                        success     : function (data) {

                            tabel_produk.ajax.reload(null,false); 
                            
                            $(".jml").text(data.jumlah+" Produk");

                            swal({
                                title               : 'Hapus',
                                text                : 'Produk Berhasil Dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 
                            
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
                            text                : 'Anda membatalkan hapus produk',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })

        })

        // 26-11-2020
        $('#harga_jual').on('keyup', function () {
            
            var isi = $(this).val();

            $('#nilai_harga_jual').val(isi.split('.').join(''));

            var aksi;
            if (isi == '') {
                aksi = true;
            } else {
                aksi = false;
            }
            
            $('#split-tab2').attr('hidden', aksi);
            $('#discount').attr('disabled', aksi);
            
        })

    })
</script>