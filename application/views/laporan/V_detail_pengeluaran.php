<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Detail Pengeluaran</h5>
    <button class="close p-3" data-dismiss="modal" aria-label="Close">
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
                    <td class="text-right font-weight-bold"><?= nice_date($trn['created_at'], 'd F Y H:i:s'); ?></td>
                    <input type="hidden" id="tgl_trn" value="<?= nice_date($trn['created_at'], 'Y-m-d'); ?>">
                </tr>
                <tr>
                    <th scope="row">Kode Transaksi</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $trn['code_trn'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 mt-2 mb-2">
            <div class="progress" data-height="5" style="height: 5px;">
                <div class="progress-bar bg-warning" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
        <div class="col-md-12 table-responsive mt-2">
            <input type="hidden" id="id_trn2" value="<?= $trn['id'] ?>">
            <table class="table table-hover table-sm">
                <tbody>
                    <?php $no=1; foreach ($list as $k): ?>
                        <tr class="font-weight-bold">
                            <th scope="row" colspan="2"><?= $k['nama'] ?></th>
                            <th width="20%">
                                
                            </th>
                        </tr>
                        <tr>
                            <td align="left"><?= $k['qty'] ?> x <?= number_format($k['harga'],0,'.','.') ?></td>
                            <td align="right"></td>
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
                        <th scope="row" width="35%">Total Bayar</th>
                        <td class="font-weight-bold">: Rp.</td>
                        <td class="text-right font-weight-bold"><?= number_format($trn['total_transaksi'],0,'.','.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class='fa fa-times-circle fa-lg mr-2'></i>Close</button>
            </div>
        </div>
    </div>
</div>
