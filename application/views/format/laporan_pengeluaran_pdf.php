<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<h1><?php echo $judul; ?></h1>
  <?php foreach($laporan as $row) { 
    $detil = $this->laporan->get_detail_transaksi_pengeluaran($row->id);
  ?>
    <h3><b>Kode Transaksi: <?php echo $row->code_trn ?></b></h3>
    <h3><b>Tanggal: <?php echo date('d-m-Y', strtotime($row->created_at)) ?></b></h3>
    <hr>
    <?php
    $i = 1;
    $total = 0;
    ?>
    <table class="table table-hover table_detail" style="width: 100%; border: 1px #000 solid;">
      <thead class="text-center" style="border: 1px #000 solid;">
        <tr class="font-weight-bold">
          <th class="font-weight-bold" style="border-right: 1px #000 solid;">No.</th>
          <th class="font-weight-bold" style="border-right: 1px #000 solid;">Nama Produk</th>
          <th class="font-weight-bold" style="border-right: 1px #000 solid;">Qty</th>
          <th class="font-weight-bold" style="border-right: 1px #000 solid;">Harga</th>
        </tr>
      </thead>
      <tbody style="border: 1px #000 solid;">
        <?php foreach($detil as $row2) {
          ?>
          <tr>
            <td align='center' style="border-right: 1px #000 solid;"><?php echo $i++; ?></td>
            <td style="border-right: 1px #000 solid;"><?php echo $row2->nama ?></td>
            <td  align='center' style="border-right: 1px #000 solid;"><?php echo $row2->qty ?></td>
            <td style="border-right: 1px #000 solid;">Rp. <?php echo number_format($row2->harga) ?></td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
          <tr>
              <td colspan="3" align="center" style="border-right: 1px #000 solid;"><b>TOTAL PENGELUARAN</b></td>
              <td>Rp. <?php echo number_format($detil[0]->total_transaksi) ?></td>
          </tr>
      </tfoot>
    </table>
  <?php } ?>
</body>
</html>