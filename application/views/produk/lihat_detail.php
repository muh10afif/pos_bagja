
<div class="modal-header bg-warning">
    <h5 class="modal-title font-weight-bold text-white mb-3 title_produk2"><i class='fa fa-info mr-3'></i>Detail Produk</h5>
    <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-dark">&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row p-3">
        <div class="col-md-5">
            <div class="form-group row p-1 mt-1">
                <label  class="col-sm-12 col-form-label">Gambar</label>
                <div class="col-sm-12 text-left">
                    <?php if($produk['image'] == null) {
                        $img = "<img class='' width='100%' src='".base_url('assets/template/img/news/img04.jpg')."'>";
                    } else {
                        $gb = $produk['image'];
                        $img = "<img class='' width='100%' src='https://mitrabagja.com/upload/produk/$gb'>";
                    } ?>
                    <?= $img ?>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group row p-0 ml-2">
                <label class="col-sm-4 col-form-label">Nama Produk</label>
                <div class="col-sm-8 mt-1">
                    : <?= $produk['nama'] ?>
                </div>
            </div>
            <div class="form-group row p-0 ml-2">
                <label class="col-sm-4 col-form-label">Kategori</label>
                <div class="col-sm-8 mt-1">
                    : <?= $kategori ?>
                </div>
            </div>
            <div class="form-group row p-0 ml-2">
                <label class="col-sm-4 col-form-label">Harga Dasar</label>
                <div class="col-sm-8 mt-1">
                    : <?= number_format($produk['hpp'],0,'.','.') ?>
                </div>
            </div>
            <div class="form-group row p-0 ml-2">
                <label class="col-sm-4 col-form-label">Harga Jual</label>
                <div class="col-sm-8 mt-1">
                    : <?= number_format($produk['harga'],0,'.','.') ?>
                </div>
            </div>
            <div class="form-group row p-0 ml-2">
                <label class="col-sm-4 col-form-label">Discount</label>
                <div class="col-sm-8 mt-1">
                    : <?= number_format($produk['discount'],0,'.','.') ?>
                </div>
            </div>
            
        </div>

        <div class="col-md-12 mt-2">
            <ul class="nav nav-tabs d-flex justify-content-center" id="myTab33" role="tablist">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" id="bhnbaku-tab23" data-toggle="tab" href="#bhnbaku_t3" role="tab" aria-controls="bhnbaku_t3" aria-selected="true" hidden>Komposisi</a>
                </li>
                <li class="nav-item">
                    <?php 

                        if ($produk['h_ukuran'] == 1) {
                            $act    = 'active';
                            $act2   = 'show active';
                        } else {
                            $act    = '';
                            $act2   = '';
                        }

                        if ($produk['h_ukuran'] == 0 && $produk['h_topping'] == 1) {
                            $act_topping    = 'active';
                            $act_topping2   = 'show active';
                        } else {
                            $act_topping    = '';
                            $act_topping2   = '';
                        }

                        if ($produk['h_ukuran'] == 0 && $produk['h_topping'] == 0 && $produk['h_status'] == 1) {
                            $act_status     = 'active';
                            $act_status2    = 'show active';
                        } else {
                            $act_status     = '';
                            $act_status2    = '';
                        }

                        if ($produk['h_ukuran'] == 0 && $produk['h_topping'] == 0 && $produk['h_status'] == 0 && $produk['h_stok'] == 1) {
                            $act_stok   = 'active';
                            $act_stok2  = 'show active';
                        } else {
                            $act_stok   = '';
                            $act_stok2  = '';
                        }

                        if ($produk['h_ukuran'] == 0 && $produk['h_topping'] == 0 && $produk['h_status'] == 0 && $produk['h_stok'] == 0 && $produk['h_split'] == 1) {
                            $act_split  = 'active';
                            $act_split2 = 'show active';
                        } else {
                            $act_split  = '';
                            $act_split2 = '';
                        }

                    ?>
                    <a class="nav-link <?= $act ?> font-weight-bold" id="ukuran-tab23" data-toggle="tab" href="#ukuran_t3" role="tab" aria-controls="ukuran_t3" aria-selected="false" <?= ($produk['h_ukuran'] == 0) ? 'hidden' : '' ?>>Ukuran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act_topping ?> font-weight-bold" id="topping-tab23" data-toggle="tab" href="#topping_t3" role="tab" aria-controls="topping_t3" aria-selected="false" <?= ($produk['h_topping'] == 0) ? 'hidden' : '' ?>>Topping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act_status ?> font-weight-bold" id="status-tab23" data-toggle="tab" href="#status_t3" role="tab" aria-controls="status_t3" aria-selected="false" <?= ($produk['h_status'] == 0) ? 'hidden' : '' ?>>Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act_stok ?> font-weight-bold" id="stok-tab23" data-toggle="tab" href="#stok_t3" role="tab" aria-controls="stok_t3" aria-selected="false" <?= ($produk['h_stok'] == 0) ? 'hidden' : '' ?>>Stok</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act_split ?> font-weight-bold" id="split-tab23" data-toggle="tab" href="#split_t3" role="tab" aria-controls="split3" aria-selected="false" <?= ($produk['h_split'] == 0) ? 'hidden' : '' ?>>Split</a>
                </li>
            </ul>
            <div class="tab-content" id="myTab33Content">
                <div class="tab-pane fade" id="bhnbaku_t3" role="tabpanel" aria-labelledby="bhnbaku-tab23">
                    <div class="row p-3">
                       sd 
                    </div>
                </div>
                <div class="tab-pane <?= $act2 ?> fade" id="ukuran_t3" role="tabpanel" aria-labelledby="ukuran-tab23">
                    <div class="row p-3">
                        <table class="table table-light mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($ukuran as $u): ?>
                                    <tr>
                                        <td><?= $u['ukuran'] ?></td>
                                        <td><?= number_format($u['harga'],0,'.','.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane <?= $act_topping2 ?> fade" id="topping_t3" role="tabpanel" aria-labelledby="topping-tab23">
                    <div class="row p-3">
                        <table class="table table-light mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th>Topping</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($topping as $t): ?>
                                    <tr>
                                        <td><?= $t['topping'] ?></td>
                                        <td><?= number_format($t['harga'],0,'.','.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane <?= $act_status2 ?> fade" id="status_t3" role="tabpanel" aria-labelledby="status-tab23">
                    <div class="row p-3">
                        <table class="table table-light mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($status as $s): ?>
                                    <tr>
                                        <td><?= $s['status'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane <?= $act_stok2 ?> fade" id="stok_t3" role="tabpanel" aria-labelledby="stok-tab23">
                    <div class="row p-3">
                        <table class="table table-light mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Expire Date</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td><?= $stok['stok'] ?></td>
                                    <td><?= $stok['satuan'] ?></td>
                                    <td><?= date("d-F-Y", strtotime($stok['expire_date'])) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane <?= $act_split2 ?> fade" id="split_t3" role="tabpanel" aria-labelledby="split-tab23">
                    <div class="row p-3">
                        <table class="table table-light mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th>Split</th>
                                    <th>Komisi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($split as $p): ?>
                                    <tr>
                                        <td><?= $p['split'] ?></td>
                                        <td><?= number_format($p['harga'],0,'.','.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>