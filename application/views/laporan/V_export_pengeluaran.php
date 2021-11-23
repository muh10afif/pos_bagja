<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report pengeluaran</title>

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
    
    <h6 style="font-weight: bold; margin: 5px;">Report Pengeluaran</h6>
    <h6 style="font-weight: bold; margin: 5px;">Periode Tanggal Awal <?= nice_date($tgl_awal, 'd F Y') ?> s/d <?= nice_date($tgl_akhir, 'd F Y') ?></h6>
    <br><br>

    <?php $no=1; foreach ($transaksi as $d): ?>

        <table border="0" cellspacing="0">
            <tbody>
                <tr>
                    <th><?= $no ?></th>
                    <th align="left">Kode Transaksi</th>
                    <th align="left">: <?= $d['code_trn'] ?></th>
                </tr>
                <tr>
                    <th></th>
                    <th align="left">Tanggal</th>
                    <th align="left">: <?= nice_date($d['created_at'], 'd F Y H:i:s') ?></th>
                </tr>
            </tbody>
        </table>

        <?php 
        
        $dt = $this->transaksi->cari_data('trn_detail_pengeluaran', ['id_transaksi' => $d['id']])->result_array();
        
        ?>

        <table border="1" cellspacing="0" style="width: 100%;" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($dt as $t): ?>

                <tr>
                    <td align="center"><?= $i ?>.</td>
                    <td align="left"><?= $t['nama'] ?></td>
                    <td align="center"><?= $t['qty'] ?></td>
                    <td align="center"><?= $t['satuan'] ?></td>
                    <td align="right">Rp. <?= number_format($t['harga'],0,'.','.') ?></td>
                </tr>

                <?php $i++; endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" align="right">Total Pengeluaran</th>
                    <th align="right">Rp. <?= number_format($d['total_transaksi'],0,'.','.') ?></th>
                </tr>
                
            </tfoot>
        </table>
    
        <br>

    <?php $no++; endforeach; ?>

</body>
</html>