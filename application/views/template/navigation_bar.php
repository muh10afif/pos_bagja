<?php 

    if ($this->uri->segment(3) == 'on') {
        $hid = 'hidden';
    } else {
        $hid = '';
    }
    
?>
<body class="body <?= ($this->uri->segment(3) == 'on') ? 'sidebar-mini' : '' ?>">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg bg-warning"></div>
      <nav class="navbar navbar-expand-lg main-navbar bg-warning">
        <div class="mr-auto" >
            <ul class="navbar-nav mr-3" <?= $hid ?>>
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <?php if ($this->session->userdata('nama') == 'Bagja') : ?>
            <li class="dropdown dropdown-list-toggle mr-2">
                <label class="custom-switch mt-1">
                    <span class="custom-switch-description font-weight-bold text-white mr-2">Breakdown <span id="t_breakdown"><?= ($this->uri->segment(3) == 'on' || $this->session->userdata('hal') == 'detail off') ? 'ON' : 'OFF' ?></span></span> 
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input breakdown" <?= ($this->uri->segment(3) == 'on' || $this->session->userdata('hal') == 'detail off') ? 'checked' : '' ?>>
                    <span class="custom-switch-indicator"></span>
                </label>
            </li>
            <?php endif; ?>
          <li class="dropdown">
            <a href="javascript:;" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?php echo base_url() ?>assets/template/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi <?= ($this->session->userdata('nama') == 'Bagja') ? 'Admin' : 'Owner'  ?>, <span class="ses_nama"><?php echo ucfirst($this->session->userdata('nama')); ?></span></div>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right" style="width: 50%;">
            
                <?php if ($this->session->userdata('nama') != 'Bagja') : ?>
                <a href="<?= base_url('Pengaturan') ?>" class="dropdown-item has-icon mt-2">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
                <div class="dropdown-divider"></div>
                <?php endif; ?>
                
                <a href="<?php echo base_url('Login/logout') ?>" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

            </div>
          </li>
        </ul>
      </nav>
      
      <div class="main-sidebar sidebar-style-2 shadow">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url() ?>">Bagja Lite</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url() ?>"><img src="<?= base_url('assets/img/logo.png') ?>" width="30px"></a>
          </div>
          <ul class="sidebar-menu">
            <?php if ($this->session->userdata('hal') == 'detail off') : ?>
                <li class="p-1" <?= $hid ?>>
                    <a href="<?= base_url('Home/page/on') ?>"><button class="btn btn-lg btn-warning btn-block font-weight-bold" style="font-size: 20px;"><i class="fa fa-angle-double-left fa-lg mr-2"></i>HOME</button></a>
                </li>
            <?php endif ?>
            <li class="<?php if($this->uri->total_segments() < 1 || $this->uri->segment(1) == 'Home' || $this->uri->segment(1) == 'Home' && empty($this->uri->segment(2))) { echo 'active'; } else { echo null; } ?>" <?= $hid ?>>
                <?php if ($this->session->userdata('hal') == 'detail off') {
                    $idk = $this->session->userdata('id_umkm');
                    
                    $href = base_url()."Home/page/off/$idk/detail_off";
                } else {
                    $href = base_url('Home');
                } ?>
                    
              <a class="nav-link" href="<?= $href ?>">
                <i class="fas fa-home"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="nav-item dropdown <?php echo $this->uri->segment(1) == 'Laporan' ? 'active' : null ?>" <?= $hid ?>>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-file-alt"></i> <span>Laporan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ($this->uri->segment(2) == 'penjualan' || $this->uri->segment(2) == 'detail_umkm') ? 'active' : null ?>">
                        <a class="nav-link" href="<?php echo base_url('Laporan/penjualan') ?>">Laporan Penjualan</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(2) == 'piutang' || $this->uri->segment(2) == 'detail_umkm_pi') ? 'active' : null ?>">
                        <a class="nav-link" href="<?php echo base_url('Laporan/piutang') ?>">Laporan Piutang</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(2) == 'pengeluaran' || $this->uri->segment(2) == 'detail_umkm_peng') ? 'active' : null ?>">
                        <a class="nav-link" href="<?php echo base_url('Laporan/pengeluaran') ?>">Laporan Pengeluaran</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(2) == 'split' || $this->uri->segment(2) == 'detail_umkm_split') ? 'active' : null ?>">
                        <a class="nav-link" href="<?php echo base_url('Laporan/split') ?>">Laporan Split</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(2) == 'laba_rugi') ? 'active' : null ?>">
                        <a class="nav-link" href="<?php echo base_url('Laporan/laba_rugi') ?>">Laporan Laba/Rugi</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown <?php echo $this->uri->segment(1) == 'Produk' || $this->uri->segment(1) == 'Kategori' ? 'active' : null ?>" <?= $hid ?>>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-th-large"></i> <span>Produk</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $this->uri->segment(1) == 'Kategori' ? 'active' : null ?>">
                        <a class="nav-link" href="<?php echo base_url('Kategori') ?>">Daftar Kategori</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(1) == 'Produk' ? 'active' : null ?>">
                        <a class="nav-link" href="<?php echo base_url('Produk') ?>">Daftar Produk</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" hidden>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-warehouse"></i> <span>Kelola Stock</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="index-0.html">Daftar Stock</a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.html">Stock Masuk</a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.html">Stock Opname</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" hidden>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-shopping-cart"></i> <span>Belanja</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="index-0.html">Daftar Supplier</a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.html">Beli Stock</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $this->uri->segment(1) == 'Pelanggan' ? 'active' : '' ?>" <?= $hid ?>>
              <a class="nav-link" href="<?= base_url('Pelanggan') ?>">
                <i class="fas fa-users"></i> <span>Pelanggan</span>
              </a>
            </li>
            <!-- <li class="nav-item dropdown <?php echo $this->uri->segment(1) == 'Promosi' ? 'active' : '' ?>" <?= $hid ?>>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-bullhorn"></i> <span>Promosi</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $this->uri->segment(2) == 'per_total_pembelian' ? 'active' : '' ?>" hidden>
                        <a class="nav-link" href="<?= base_url('Promosi/per_total_pembelian') ?>">Per Total Pembelian</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(2) == 'per_produk' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Promosi/per_produk') ?>">Per Produk</a>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item dropdown <?php echo $this->uri->segment(1) == 'Transaksi' ? 'active' : '' ?>" <?= $hid ?>>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-shopping-bag"></i> <span>Transaksi</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ($this->uri->segment(2) == 'penjualan' || $this->uri->segment(2) == 'halaman_tambah_transaksi' || $this->uri->segment(2) == 'detail_umkm'
                    ) ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Transaksi/penjualan') ?>">Penjualan</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(2) == 'pengeluaran' || $this->uri->segment(2) == 'detail_umkm_peng') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Transaksi/pengeluaran') ?>">Pengeluaran</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $this->uri->segment(1) == 'Piutang' ? 'active' : '' ?>" <?= $hid ?>>
              <a class="nav-link" href="<?= base_url('Piutang') ?>">
                <i class="fas fa-money-check"></i> <span>Piutang</span>
              </a>
            </li>
            <li class="nav-item dropdown <?php echo $this->uri->segment(1) == 'Keuangan' ? 'active' : '' ?>" hidden>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-dollar-sign"></i> <span>Keuangan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $this->uri->segment(2) == 'buku_kas' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Keuangan/buku_kas') ?>">Buku Kas</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(2) == 'daftar_penerimaan' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Keuangan/daftar_penerimaan') ?>">Daftar Penerimaan</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(2) == 'daftar_pengeluaran' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Keuangan/daftar_pengeluaran') ?>">Daftar Pengeluaran</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(2) == 'daftar_tagihan_rutin' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Keuangan/daftar_tagihan_rutin') ?>">Daftar Tagihan Rutin</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(2) == 'laporan_rugi_laba' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Keuangan/laporan_rugi_laba') ?>">Laporan Rugi Laba</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown <?php echo $this->uri->segment(1) == 'Akun' ? 'active' : '' ?>" hidden>
                <a href="javascript:;" class="nav-link has-dropdown">
                    <i class="fas fa-book"></i> <span>Akun</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $this->uri->segment(2) == 'daftar_akun' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Akun/daftar_akun') ?>">Daftar Akun</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(2) == 'jurnal_umum' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('Akun/jurnal_umum') ?>">Jurnal Umum</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo $this->uri->segment(1) == 'Tracking' ? 'active' : '' ?>" hidden>
              <a class="nav-link" href="<?= base_url('Tracking') ?>">
                <i class="fas fa-map-marker-alt"></i> <span>Tracking</span>
              </a>
            </li>
            <li class="<?php echo $this->uri->segment(1) == 'Angsuran' ? 'active' : '' ?>" hidden>
              <a class="nav-link" href="<?= base_url('Angsuran') ?>">
                <i class="fas fa-hand-holding-usd"></i> <span>Angsuran</span>
              </a>
            </li>
            <li class="<?php echo $this->uri->segment(1) == 'Pengaturan' ? 'active' : '' ?>" hidden>
              <a class="nav-link" href="<?= base_url('Pengaturan') ?>">
                <i class="fas fa-cogs"></i> <span>Pengaturan</span> 
              </a>
            </li>
            <?php if ($this->session->userdata('nama') == 'Bagja' && $this->session->userdata('hal') == '') : ?>
            <li class="<?php echo $this->uri->segment(1) == 'User' ? 'active' : '' ?>" <?= $hid ?>>
              <a class="nav-link" href="<?= base_url('User') ?>">
                <i class="fa fa-user-circle"></i> <span>User</span>
              </a>
            </li>
            <?php endif; ?>
           </ul>
        </aside>
    </div>

    <script>
        $(document).ready(function () {

            $('.breakdown').on('change', function () {
                var isi = $(this).is(':checked');
                
                if (isi == true) {
                    $('#t_breakdown').text('ON');

                    var url = "<?= base_url('Home/page/on') ?>";
                    window.location.href = url;

                    $(this).prop('checked', true);

                } else {
                    $('#t_breakdown').text('OFF');

                    var url = "<?= base_url('Home/page/off') ?>";
                    window.location.href = url;

                    $(this).prop('checked', false);
                }
            })
            
        })
    </script>