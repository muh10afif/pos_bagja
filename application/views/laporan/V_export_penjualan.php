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
    
    <h6 style="font-weight: bold; margin: 5px;">Report Penjualan</h6>
    <h6 style="font-weight: bold; margin: 5px;">Periode Tanggal Awal <?= nice_date($tgl_awal, 'd F Y') ?> s/d <?= nice_date($tgl_akhir, 'd F Y') ?></h6>
    <br><br>

    <?php $no=1; foreach ($transaksi as $d): ?>

        <?php 
            
            $nm_p = $this->laporan->cari_data('mst_pelanggan', ['id' => $d['id_pelanggan']])->row_array(); 
            
        ?>

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
                <?php if ($nm_p['nama']) : ?>
                <tr>
                    <th></th>
                    <th align="left">Atas Nama</th>
                    <th align="left">: <?= $nm_p['nama'] ?></th>
                </tr> 
                <?php endif; ?>
            </tbody>
        </table>

        <?php 
        
        $dt = $this->transaksi->cari_data('trn_detail_pemasukan', ['id_transaksi' => $d['id']])->result_array();
        $ct = $this->transaksi->cari_data('trn_piutang', ['idtransaksi' => $d['id']])->row_array();
        
        ?>

        <table border="1" cellspacing="0" width="100%" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                $i=1; 

                foreach ($dt as $t): 
                
                    $q = ($t['harga'] * $t['qty']) - $t['sub_discount'];
                    $m = $t['sub_total'] - $q;
                    $n = $m / $t['qty']; 

                    // cari kategori
                    $kat = $this->laporan->cari_kategori($t['id_produk'])->row_array();
                
                ?>

                <tr>
                    <td align="center"><?= $i ?>.</td>
                    <td align="left"><?= $t['nama_produk'] ?></td>
                    <td align="left"><?= $kat['kategori'] ?></td>
                    <td align="right">Rp. <?= number_format($t['harga'] + $n,0,'.','.') ?></td>
                    <td align="center"><?= $t['qty'] ?></td>
                    <td align="right">Rp. <?= number_format($t['sub_discount'],0,'.','.') ?></td>
                    <td align="right">Rp. <?= number_format($t['sub_total'],0,'.','.') ?></td>
                </tr>
                <?php 

                $i++; 

                endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" align="right">Total Diskon</th>
                    <th align="right">Rp. <?= number_format($d['total_discount'],0,'.','.') ?></th>
                </tr>
                <tr>
                    <th colspan="6" align="right">Total Transaksi</th>
                    <th align="right">Rp. <?= number_format($d['total_transaksi'],0,'.','.') ?></th>
                </tr>
                <?php if ($ct['piutang']) : ?>
                    <tr>
                        <th colspan="6" align="right">Bayar</th>
                        <th align="right">Rp. <?= number_format($ct['bayar'],0,'.','.') ?></th>
                    </tr>
                    <tr>
                        <th colspan="6" align="right">Piutang</th>
                        <th align="right">Rp. <?= number_format($ct['piutang'],0,'.','.') ?></th>
                    </tr>
                <?php endif; ?>
                
            </tfoot>
        </table>
    
        <br>

    <?php $no++; endforeach; ?>

</body>
</html>