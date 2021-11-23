<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Detail Split</h5>
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
                    <th scope="row" width="35%">Nama Produk</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= ucwords($nama_produk); ?></td>
                </tr>
                <tr>
                    <th scope="row">Total QTY</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $qty ?></td>
                </tr>
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
                    <?php foreach ($list as $s): ?>
                        <tr>
                            <th scope="row" width="35%"><?= ucwords($s['split']) ?></th>
                            <td class="font-weight-bold">: Rp.</td>
                            <td class="text-right font-weight-bold"><?= number_format($s['harga'] * $qty,0,'.','.') ?></td>
                        </tr>
                    <?php endforeach; ?>
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