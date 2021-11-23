<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Penjualan</title>

    <style>

    #ad thead tr th {
      vertical-align: middle;
      text-align: center;
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
    </style>

</head>
<body style="margin: 20px;">
    
    <h6 style="font-weight: bold; margin: 5px;">Report Split</h6>
    <h6 style="font-weight: bold; margin: 5px;">Periode Tanggal Awal <?= date('d-F-Y', strtotime($tgl_awal)) ?> s/d <?= date('d F Y', strtotime($tgl_akhir)) ?></h6>
    <?php if ($id_umkm != ''): ?>
        <h6 style="font-weight: bold; margin: 5px;">UMKM <?= ucwords($nm_umkm) ?></h6>
    <?php endif; ?>
    <br><br>

    <?php $no=1; foreach ($list as $d): ?>

        <table border="0" cellspacing="0">
            <tbody>
                <tr>
                    <th><?= $no ?>.</th>
                    <th align="left">Nama Produk</th>
                    <th align="left">: <?= ucwords($d['nama']) ?></th>
                </tr>
                <tr>
                    <th></th>
                    <th align="left">Total Qty</th>
                    <th align="left">: <?= $d['qty'] ?></th>
                </tr>
                <tr>
                    <th></th>
                    <th align="left">Split Dana</th>
                    <th align="left"></th>
                </tr>
                <?php 
        
                    $dt = $this->laporan->cari_data_split($d['id'])->result_array();
                    
                ?>
                <?php foreach ($dt as $t): ?>
                    <tr>
                        <th></th>
                        <th align="left"><?= $t['split'] ?></th>
                        <th align="left">: <?= number_format($t['harga'] * $d['qty'], 0,'.','.') ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br>

        

       
        
            <!-- <table border="0" cellspacing="0">
            <tbody>
                <?php foreach ($dt as $t): ?>
                    <tr>
                        <th align="left"><?= $t['split'] ?></th>
                        <th align="left">: <?= number_format($t['harga'] * $d['qty'], 0,'.','.') ?></th>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <hr>
        <br> -->

    <?php $no++; endforeach; ?>

</body>
</html>