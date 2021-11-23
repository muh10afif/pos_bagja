<div class="modal-header bg-warning text-white">
    <h5 class="modal-title mb-3" id="my-modal-title">Detail Laba & Rugi</h5>
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
                    <th scope="row" width="35%">UMKM</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= $umkm ?></td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Awal</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= date("d F Y", strtotime($tgl_awal)) ?></td>
                </tr>
                <tr>
                    <th scope="row">Tanggal Akhir</th>
                    <td class="font-weight-bold" width="5%">:</td>
                    <td class="text-right font-weight-bold" ><?= date("d F Y", strtotime($tgl_akhir)) ?></td>
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

            <table class="table table-hover table-sm">
                <tbody>
                    <tr>
                        <th class="font-weight-bold" colspan="2">Pendapatan</th>
                    </tr>
                    <tr>
                        <th><span class="ml-3">Pendapatan</span></th>
                        <th class="text-right font-weight-bold"><?= number_format($data['total_pendapatan'],0,'.','.') ?></th>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Total Pendapatan</th>
                        <th class="text-right font-weight-bold"><?= number_format($data['total_pendapatan'],0,'.','.') ?></th>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="col-md-12 table-responsive mt-2">

            <table class="table table-hover table-sm">
                <tbody>
                    <tr>
                        <th class="font-weight-bold" colspan="2">Harga Pokok Penjualan</th>
                    </tr>
                    <tr>
                        <th><span class="ml-3">Harga Pokok Penjualan</span></th>
                        <th class="text-right font-weight-bold"><?= number_format($data['total_hpp'],0,'.','.') ?></th>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Total Harga Pokok Penjualan</th>
                        <th class="text-right font-weight-bold">(<?= number_format($data['total_hpp'],0,'.','.') ?>)</th>
                    </tr>
                </tbody>
            </table>
            
        </div>

        <div class="col-md-12 table-responsive mt-2">

            <table class="table table-hover table-sm">
                <tbody class="thead-light">
                    <tr>
                        <th class="font-weight-bold" style="color: black; font-size: 17px;">LABA KOTOR</th>
                        <th class="text-right font-weight-bold" style="color: black; font-size: 17px;"><?= number_format($data['laba_kotor'],0,'.','.') ?></th>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="col-md-12 table-responsive mt-2">

            <table class="table table-hover table-sm">
                <tbody>
                    <tr>
                        <th class="font-weight-bold" colspan="2">Pengeluaran</th>
                    </tr>
                    <tr>
                        <th><span class="ml-3">Biaya Pengeluaran</span></th>
                        <th class="text-right font-weight-bold"><?= number_format($data['total_pengeluaran'],0,'.','.') ?></th>
                    </tr>
                    <tr>
                        <th class="font-weight-bold">Total Pengeluaran</th>
                        <th class="text-right font-weight-bold">(<?= number_format($data['total_pengeluaran'],0,'.','.') ?>)</th>
                    </tr>
                </tbody>
            </table>
            
        </div>

        <div class="col-md-12 table-responsive mt-2">

            <table class="table table-hover table-sm">
                <tbody class="thead-light">
                    <tr>
                        <th class="font-weight-bold" style="color: black; font-size: 17px;">LABA BERSIH</th>
                        <th class="text-right font-weight-bold" style="color: black; font-size: 17px;"><?= number_format($data['laba_bersih'],0,'.','.') ?></th>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="container-fluid">
        <form action="<?= base_url('laporan/download_file_laba_rugi') ?>" method="post">
            <input type="hidden" id="jenis" name="jenis">
            <input type="hidden" name="aksi" value="detail">
            <input type="hidden" name="id_umkm" value="<?= $id_umkm ?>">
            <input type="hidden" name="tgl_awal" value="<?= $tgl_awal ?>">
            <input type="hidden" name="tgl_akhir" value="<?= $tgl_akhir ?>">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="btn-group mb-0 mt-1" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-info btn-lg" name="export" data="excel">Excel</button>
                        <button type="submit" class="btn btn-success btn-lg" name="export" data="pdf">PDF</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('button[name="export"]').on('click', function () {
            var jns = $(this).attr('data');

            $('#jenis').val(jns);
        })

    })
</script>