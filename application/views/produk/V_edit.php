<form id="form_produk_2" autocomplete="off">
    <div class="modal-content">
        <div class="modal-header bg-warning">
            <h5 class="modal-title font-weight-bold text-white mb-3 title_produk2">Edit Produk</h5>
            <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-dark">&times;</span>
            </button>
        </div>
    
        <input type="hidden" name="id_umkm" id="id_umkm_2" value="<?= $id_umkm ?>">
        <input type="hidden" id="aksi_2" name="aksi" value="Tambah">
        <input type="hidden" name="id" id="id_produk_2" class="form-control">
        <input type="hidden" id="status_simpan_produk_2" value="no">
        <input type="hidden" id="status_simpan_produk_atas_2" value="no">
        <input type="hidden" id="status_foto2" value="0">

        <div class="modal-body">

            <div class="row p-3">
                <div class="col-md-5">
                    <div class="form-group row p-1 mt-3">
                        <label for="gambar" class="col-sm-12 col-form-label">Gambar</label>
                        <div class="col-sm-12">

                            <?php if ($pro['image'] == null) {
                                $img = "";
                            } else {
                                $img = "https://mitrabagja.com/upload/produk/".$pro['image'];
                            } ?>

                            <input name="image2" id="image_2" type="file" class="dropify2" data-max-file-size="5M" data-show-errors="true" data-default-file="<?= $img ?>" data-allowed-file-extensions="jpg png jpeg"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group row p-0">
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input_produk" name="nama_produk" id="nama_produk_2" judul="Nama Produk" placeholder="Contoh: Nasi Goreng.." value="<?= $pro['nama'] ?>">
                            <span class="text-danger" id="nama_produk_2_error"></span>
                        </div>
                    </div>
                    <div class="form-group row p-0 mt-0">
                        <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <div class="row no-gutters">
                                <div class="col-md-9 kat_lama">
                                    <select name="id_kategori" id="id_kategori_2" class="form-control input_produk select2 shadow" judul="Kategori" style="width: 100%;">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategori as $k): ?>
                                            <option value="<?= $k['id'] ?>" <?= ($k['id'] == $pro['id_kategori']) ? 'selected' : ''  ?>><?= $k['kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-9 kat_baru" hidden>
                                    <input type="text" class="form-control input_produk" placeholder="Contoh: Makanan.." id="nama_kategori_2" name="nama_kategori" judul="Kategori" value="produk">
                                </div>
                                <div class="col-md-2 mt-1 ml-3 btn_tambah">
                                    <button type="button" data-toggle="tooltip" data-placement="top" title="Tambah Kategori baru" class="btn btn-block btn-success" id="tambah_kategori_2"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-2 mt-1 ml-3 btn_batal" hidden>
                                    <button type="button" data-toggle="tooltip" data-placement="top" title="Batal Menambahkan" class="btn btn-block btn-danger" id="batal_kategori_2"><i class="fa fa-undo"></i></button>
                                </div>
                                <span class="text-danger" id="id_kategori_2_error"></span>
                                <span class="text-danger" id="nama_kategori_2_error"></span>
                                <input type="hidden" name="status_kategori" id="status_kategori_2" class="form-control" value="lama">
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
                                <input type="text" name="harga_dasar" id="harga_dasar_2" judul="Harga Dasar" class="form-control text-right numeric number_separator input_produk" placeholder="0" value="<?= number_format($pro['hpp'],0,'.','.') ?>">
                            </div>
                            <span class="text-danger" id="harga_dasar_2_error"></span>
                        </div>
                    </div>
                    <div class="form-group row p-0">
                        <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" name="harga_jual" id="harga_jual_2" judul="Harga Jual" class="form-control text-right numeric number_separator input_produk" placeholder="0" value="<?= number_format($pro['harga'],0,'.','.') ?>">
                            </div>
                            <span class="text-danger" id="harga_jual_2_error"></span>
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
                                        <span class="selectgroup-button p-1" id="s_rp_2" style="font-size: 15px; font-weight: bold; height:100%" >Rp. </span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="s_discount" value="persen" class="selectgroup-input">
                                            <span class="selectgroup-button p-1" id="s_persen_2" style="font-size: 15px; font-weight: bold; height:100%">%</span>
                                        </label>
                                    </div>
                                </div>
                                <input type="text" name="discount" id="discount_2" judul="discount" class="form-control text-right numeric number_separator" placeholder="0" value="<?= number_format($pro['discount'],0,'.','.') ?>">
                            </div>
                            <input type="hidden" id="nilai_diskon_2" class="form-control">
                            <input type="hidden" id="jenis_2" class="form-control" value="rp">
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
                                <div class="col-md-12 mt-3 f_ukuran" style="display: none">
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
                                <div class="col-md-12 mt-3 f_topping" style="display: none">
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
                                <div class="col-md-12 mt-3 f_status" style="display: none">
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
                                <div class="col-md-12 mt-3 f_split" style="display: none">
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
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class='fas fa-times mr-2'></i>Batal</button>
                        <button type="button" class="btn btn-warning" id="simpan_produk_2"><i class='fas fa-check mr-2'></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- select2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/modules/select2/dist/css/select2.css">
<!-- select2 -->
<script src="<?php echo base_url(); ?>assets/template/modules/select2/dist/js/select2.full.min.js"></script>

<script>
    $(document).ready(function () {

        // 08-12-2020
        $('#id_kategori_2').select2();

        // 08-12-2020
        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        // 08-12-2020
        $('.numeric').numericOnly();

        // 08-12-2020
        $('.dropify').dropify({
	        messages: 
	        {
	            'default': 'Drag file atau klik di sini',
	            'replace': 'Drag file atau klik di sini',
	            'remove':  'Hapus',
	            'error':   'Maaf, ada kesalahan.'
	        }
        });

        // 08-12-2020
        var dropifyElements = {};
        $('.dropify').each(function() {
            dropifyElements[this.id] = true;
        });

        // 08-12-2020
        var drEvent = $('.dropify').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            // id = event.target.id;
            // if(dropifyElements[id]) {

            //     swal({   
            //         title               : "Peringatan!!",   
            //         text                : "Apakah yakin akan hapus "+element.file.name+" ?",   
            //         type                : "warning",   
            //         showCancelButton    : true,   
            //         buttonsStyling      : false,
            //         confirmButtonClass  : "btn btn-danger",
            //         cancelButtonClass   : "btn btn-success mr-3",  
            //         cancelButtonText    : "Batal",   
            //         confirmButtonText   : "Ya, hapus",   
            //         closeOnConfirm      : false,   
            //         closeOnCancel       : false,
            //         reverseButtons      : true
            //     }).then((result) => {
            //         if (result.value) {
                        
            //             $('#status_foto').val('1');

            //         } else if (result.dismiss === swal.DismissReason.cancel) {

            //             swal({
            //                     title               : 'Batal',
            //                     text                : 'Anda membatalkan hapus foto',
            //                     buttonsStyling      : false,
            //                     confirmButtonClass  : "btn btn-primary",
            //                     type                : 'error',
            //                     showConfirmButton   : false,
            //                     timer               : 1000
            //                 }); 
            //         }
            //     })

            //     return false;

            // }
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            // alert('File deleted');
            $('#status_foto').val('1');
        });

        // 08-12-2020
        $('#simpan_produk_2').on('click', function () {

            
            
        })

    })
</script>