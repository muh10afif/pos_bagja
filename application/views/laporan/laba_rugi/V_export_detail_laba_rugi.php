<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Detail Laba Rugi</title>

    <style>

    #ad thead tr th {
      vertical-align: middle;
    }

    th, td {
      padding: 5px;
      font-size: 10px;
    }

    /* th {
      text-align: center;
    } */

    /* tr th {
      background-color: #122E5D; color: white;
    } */
    .a tr td {
      font-weight: bold;
    }
    body {
      margin: 20px 20px 20px 20px;
      color: black;
    }
    h5, h6 {
      font-weight: bold;
      text-align: center;
      font-size: 15px;
    }
    #d th {
      background-color: #122E5D; color: white;
    }
    #tot {
      background-color: #d2e0f7; font-weight: bold;
    }
    #tot_1 {
      font-weight: bold;
    }
    * {
        font-size: 14pt;
    }
    table {
        width: 100%;
        text-align: center;
    }
    </style>

</head>
<body style="margin: 20px;">
    
    <h6 style="font-weight: bold; margin: 5px;">Report Laba & Rugi</h6>
    <h6 style="font-weight: bold; margin: 5px;">Periode Tanggal Awal <?= date('d F Y', strtotime($tgl_awal)) ?> s/d <?= date('d F Y', strtotime($tgl_akhir)) ?></h6>
    <?php if ($id_umkm != 0): ?>
        <h6 style="font-weight: bold; margin: 5px;">UMKM <?= ucwords($nm_umkm) ?></h6>
    <?php endif; ?>
    <br><br>

    <table border="1" cellspacing="0" width="100%">
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
            <tr>
                <th class="font-weight-bold" style="color: black; font-size: 17px;">LABA KOTOR</th>
                <th class="text-right font-weight-bold" style="color: black; font-size: 17px;"><?= number_format($data['laba_kotor'],0,'.','.') ?></th>
            </tr>
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
            <tr>
                <th class="font-weight-bold" style="color: black; font-size: 17px;">LABA BERSIH </th>
                <th class="text-right font-weight-bold" style="color: black; font-size: 17px;"><?= number_format($data['laba_bersih'],0,'.','.') ?></th>
            </tr>
        </tbody>
    </table>

</body>
</html>