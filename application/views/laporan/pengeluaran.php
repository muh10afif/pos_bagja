<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1><i class="fa fa-file-alt mr-3"></i><?php echo $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Bagja</a></div>
                <div class="breadcrumb-item"><?= $crumb ?></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
    </section>
    <!-- Filter & Download -->
    <form action="<?php echo base_url('Laporan/cetak') ?>" method="POST" target="_blank">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-xs-8"></div>
            <input type="hidden" name="jenis" value="Pengeluaran">
            <div class="col-lg-2 col-md-2 col-xs-2">
                <div class="input-group">
                    <a href="javascript:;" id="reset" data-toogle="tooltip" data-placement="top" title="Reset">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                    </a>
                    <input type="text" class="form-control" id="periode" name="periode" placeholder="Periode" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-xs-2">
                <button type="submit" class="btn btn-secondary btn-block">
                    <i class="fas fa-file"></i> Download Laporan
                </button>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 bg-secondary mt-2">
                <h3 id="banner" class="m-2">Detail Pengeluaran</h3>
            </div>
        </div>
    </form>
    <!-- Cards -->
    <div class="row mt-2">
        <div class="col-lg-3 col-md-3 col-xs-3"></div>
        <div class="col-lg-3 col-md-3 col-xs-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Belanja</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $transaksi; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-3">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Belanja</h4>
                    </div>
                    <div class="card-body">
                        Rp. <?php echo number_format($total_belanja) ?>
                    </div>
                </div>
            </div>
        </div>
<!--         <div class="col-lg-2 col-md-2 col-xs-2">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Supplier</h4>
                    </div>
                    <div class="card-body">
                        Rp.50.000
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- Tabel -->
    <div class="row mt-2">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="table-responsive">
                <table id="table" class="table table-hover table-striped table-bordered w-100">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Tanggal</th>
                            <th>Kode Pengeluaran</th>
                            <th>Pengeluaran</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php foreach($row as $row) { ?>
<div class="modal fade" id="detail<?php echo $row->id ?>" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title font-weight-bold text-white">Detail Belanja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="card shadow">
              <div class="card-body">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td width="20%"><b>Kode Pengeluaran</b></td>
                      <td><b>: <?php echo $row->code_trn ?></b></td>
                    </tr>
                    <tr>
                      <td width="10%"><b>Tanggal</b></td>
                      <td><b>: <?php echo date('d-m-Y', strtotime($row->created_at)) ?></b></td>
                    </tr>
                  </tbody>
                </table>
                <hr>
                <?php  
                $detil = $this->laporan->get_detail_transaksi_pengeluaran($row->id);
                $i = 1;
                $total = 0;
                ?>
                <div class="table-responsive">
                  <table class="table table-hover table_detail">
                    <thead class="text-center">
                      <tr class="font-weight-bold">
                        <th class="font-weight-bold">No.</th>
                        <th class="font-weight-bold">Nama Produk</th>
                        <th class="font-weight-bold">Qty</th>
                        <th class="font-weight-bold">Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($detil as $row2) {
                        ?>
                        <tr>
                          <td align='center'><?php echo $i++; ?></td>
                          <td><?php echo $row2->nama ?></td>
                          <td  align='center'><?php echo $row2->qty ?></td>
                          <td>Rp. <?php echo number_format($row2->harga) ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align="right"><b>TOTAL PENGELUARAN</b></td>
                            <td>Rp. <?php echo number_format($detil[0]->total_transaksi) ?></td>
                        </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>
<?php } ?>
<script>
    $(function() {
        // Date Picker
        $('#periode').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
        });
        $('.prev i').removeClass();
        $('.prev i').addClass("fa fa-chevron-left");
        $('.next i').removeClass();
        $('.next i').addClass("fa fa-chevron-right");
        // tooltip
        $('[data-toggle="tooltip"]').tooltip();
        // Data Table
        var table = $('#table').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Laporan/read_pengeluaran')?>",
                "type": "POST",
                "data": function (data) {
                    data.periode     = $('#periode').val();
                },
            },
            "columnDefs": [{
                "targets": [0, 4],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });
        $('.table_detail').DataTable({
            "bFilter": false,
            "bInfo": false,
            "bLengthChange": false,
            "bPaginate": false,
            "processing": true,
            "order": [],
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });
        // tombol reset
        $('#reset').click(function(event) {
            $('#periode').val('');
            $('#banner').text('Detail Pengeluaran');
            table.ajax.reload(null, false);
        });
        // Filter Tanggal
        $('#periode').change(function(event) {
            table.ajax.reload(null, false);
            var tanggal     = $(this).val().slice(0, 2);
            if(tanggal.charAt(0) < 1) {
                tanggal     = tanggal.charAt(1);
            }
            var nilai_bulan = $(this).val().slice(3, 5);
            var tahun       = $(this).val().slice(6, 10);
            var bulan       = lokalisasi_bulan(nilai_bulan);
            $('#banner').text('Detail Pengeluaran Tanggal '+tanggal+' '+bulan+' '+tahun);
        });
        // Penyesuaian Bulan
        function lokalisasi_bulan(x) {
            if(x == '01') {
                return x = 'Januari';
            }
            if(x == '02') {
                return x = 'Februari';
            }
            if(x == '03') {
                return x = 'Maret';
            }
            if(x == '04') {
                return x = 'April';
            }
            if(x == '05') {
                return x = 'Mei';
            }
            if(x == '06') {
                return x = 'Juni';
            }
            if(x == '07') {
                return x = 'Juli';
            }
            if(x == '08') {
                return x = 'Agustus';
            }
            if(x == '09') {
                return x = 'September';
            }
            if(x == '10') {
                return x = 'Oktober';
            }
            if(x == '11') {
                return x = 'November';
            }
            if(x == '12') {
                return x = 'Desember';
            }
        }
    });
</script>