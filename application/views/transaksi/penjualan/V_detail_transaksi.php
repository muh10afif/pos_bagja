<div class="modal-header bg-warning text-white">
    <?php

        if ($aksi == 'reload') {
            $rl = 'onclick="location.reload(); return false;"';
            $jd = "Transaksi Berhasil";
            $dt = date('d F Y H:i:s', now('Asia/Jakarta'));
        } else {
            $rl = 'data-dismiss="modal"';
            $jd = "Detail Transaksi";
            $dt = nice_date($trn['created_at'], 'd F Y H:i:s');
        }

    ?>
    <h5 class="modal-title mb-3" id="my-modal-title"><?= $jd ?></h5>
    <button class="close p-3" <?= $rl ?> aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-hover table-borderless table-sm">
                <tbody>
                <tr>
                    <th scope="row" width="35%">Tanggal</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $dt ?></td>
                </tr>
                <tr>
                    <th scope="row">Kode Transaksi</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $trn['code_trn'] ?></td>
                </tr>
                <?php if ($nama_plg['nama']): ?>
                    <tr>
                        <th scope="row">Atas Nama</th>
                        <td class="font-weight-bold" width="5%">:</td>
                        <td class="text-right font-weight-bold" ><?= $nama_plg['nama'] ?></td>
                    </tr>
                <?php endif; ?>
                
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2 mb-2">
            <div class="progress" data-height="5" style="height: 5px;">
                <div class="progress-bar bg-warning" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-12 table-responsive mt-2">

            <table class="table table-hover table-sm">
                <tbody>
                    <?php $no=1; foreach ($list as $k): ?>
                        <tr class="font-weight-bold">
                            <th scope="row" colspan="3"><?= $k['nama_produk'] ?></th>
                        </tr>
                        <tr>
                            <?php 
                                $q = ($k['harga'] * $k['qty']) - $k['sub_discount'];
                                $m = $k['sub_total'] - $q;
                                $n = $m / $k['qty']; 
                            ?>
                            <td align="left"><?= $k['qty'] ?> x <?= number_format($k['harga'] + $n,0,'.','.') ?></td>
                            <td align="right">(<?= number_format($k['sub_discount'],0,'.','.') ?>)</td>
                            <td align="right"><?= number_format($k['sub_total'],0,'.','.') ?></td>
                        </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2">
            <div class="progress" data-height="5" style="height: 5px;">
                <div class="progress-bar bg-warning" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-12 table-responsive mt-3 d-flex justify-content-center">
            <table class="table table-hover table-borderless table-sm">
                <tbody>
                <tr>
                    <th scope="row" width="35%">Total Diskon</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($trn['total_discount'],0,'.','.') ?></td>
                </tr>
                <tr>
                    <th scope="row">Total</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($trn['total_transaksi'],0,'.','.') ?></td>
                </tr>
                <tr>
                    <th scope="row">Tunai</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($trn['tunai'],0,'.','.') ?></td>
                </tr>
                <tr>
                    <th scope="row">Kembali</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($trn['tunai'] - $trn['total_transaksi'],0,'.','.') ?></td>
                </tr>
                <?php if ($cr_piutang) : ?>
                <tr>
                    <th scope="row">Piutang</th>
                    <td class="font-weight-bold">: Rp.</td>
                    <td class="text-right font-weight-bold"><?= number_format($cr_piutang['piutang'],0,'.','.') ?></td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button type="button" class="btn btn-primary btn-lg mr-3" hidden><i class='fa fa-print fa-lg mr-2'></i>Print</button>
                <button type="button" class="btn btn-warning btn-lg mr-3" hidden><i class='fa fa-envelope fa-lg mr-2'></i>Email</button>
                <button type="button" class="btn btn-danger btn-lg" <?= $rl ?>><i class='fa fa-times-circle fa-lg mr-2'></i>Close</button>
            </div>
        </div>
    </div>
</div>