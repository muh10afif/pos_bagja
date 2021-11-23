<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Piutang</title>

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
    /* body {
      margin: 20px 20px 20px 20px;
      color: black;
    } */
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
    </style>

</head>
<body>
    
    <h6 style="font-weight: bold; margin: 5px;">Report Piutang</h6>
    <h6 style="font-weight: bold; margin: 5px;">Periode Bayar - Tanggal Awal <?= nice_date($tgl_awal, 'd F Y') ?> s/d <?= nice_date($tgl_akhir, 'd F Y') ?></h6>
    <br>

    <?php $no=1; foreach ($nama_plg as $d): ?>

        <?php $tot_p = $this->laporan->get_tot_piutang($d['id'])->row_array(); ?>

        <table border="0" cellspacing="0">
            <tbody>
                <tr>
                    <th><?= $no ?></th>
                    <th align="left">Nama</th>
                    <th align="left">: <?= $d['nama'] ?></th>
                </tr>
                <tr>
                    <th></th>
                    <th align="left">Total Piutang</th>
                    <th align="left">: Rp. <?= number_format($tot_p['piutang'],0,'.','.') ?></th>
                </tr>
            </tbody>
        </table>

        <?php 
        
        $dt     = $this->laporan->get_detail_pelanggan($tgl_awal, $tgl_akhir, $d['id'])->result_array(); 
        $sisa   = $this->laporan->get_sisa_piutang($tgl_awal, $tgl_akhir, $d['id'])->row_array();
        
        ?>

        <table border="1" cellspacing="0" width="100%" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Bayar</th>
                    <th>Nominal Bayar</th>
                    <th>Sisa Piutang</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                $i=1; 
                $tot_bayar = 0;

                foreach ($dt as $t): ?>
                <tr>
                    <td align="center"><?= $i ?>.</td>
                    <td align="center"><?= nice_date($t['tanggal'], 'd-m-Y') ?></td>
                    <td align="right">Rp. <?= number_format($t['bayar'],0,'.','.') ?></td>
                    <td align="right">Rp. <?= number_format($t['sisa_piutang'],0,'.','.') ?></td>
                </tr>
                <?php 

                $i++; 
                $tot_bayar += $t['bayar'];

                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                <th colspan="2" align="right">Total</th>
                <th align="right">Rp. <?= number_format($tot_bayar,0,'.','.') ?></th>
                <th align="right">Rp. <?= number_format($sisa['sisa_piutang'],0,'.','.') ?></th>
                </tr>
            </tfoot>
        </table>
    
        <br>

    <?php $no++; endforeach; ?>

</body>
</html>