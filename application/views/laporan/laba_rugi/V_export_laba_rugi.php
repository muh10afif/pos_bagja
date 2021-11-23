<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Laba Rugi</title>

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
            <thead>
                <tr>
                    <th>No.</th>
                    <th>UMKM</th>
                    <th>Laba Kotor</th>
                    <th>Laba Bersih</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($list as $t): ?>
                    <tr>
                        <th class="text-center"><?= $no ?>.</th>
                        <th align="left"><?= $t['nama'] ?></th>
                        <th align="right"><?= number_format($t['laba_kotor'], 0,'.','.') ?></th>
                        <th align="right"><?= number_format($t['laba_bersih'], 0,'.','.') ?></th>
                    </tr>
                <?php $no++; endforeach; ?>
            </tbody>
        </table>

</body>
</html>