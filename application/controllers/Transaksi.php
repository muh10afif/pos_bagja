<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    // 26-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();

        $this->id_umkm  = $this->session->userdata('id_umkm');
        $this->nama     = $this->session->userdata('nama');
        $this->hal      = $this->session->userdata('hal');
    }

    public function index()
    {
        $this->penjualan();
    }

    // 30-11-2020
    public function penjualan()
    {
        if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'transaksi/penjualan/V_lihat_admin';
        } else {
            $isi = 'transaksi/penjualan/V_penjualan';
        }

        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

        $data 	= [
            'title'     => 'Transaksi',
            'isi'       => $isi,
            'id_umkm'   => $this->id_umkm,
            'user'      => $this->nama,
            'nama_umkm'	=> $nm['nama'],
            'hal'       => $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 30-11-2020
    public function tampil_umkm()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->transaksi->get_data_umkm($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

        $tot_transaksi = 0;
        $jml_transaksi = 0;

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $url = base_url()."Transaksi/detail_umkm/".$o['id_umkm'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_umkm'];
            $tbody[]    = "<span style='font-size:15px;' class='badge badge-light font-weight-bold'>".$o['jumlah_transaksi']."</span>";
            $tbody[]    = "<div align='right' class='font-weight-bold' style='font-size:16px;'>".number_format($o['total_transaksi'],0,'.','.')."</div>";
            $tbody[]    = "<a href='$url' class='btn btn-warning btn-sm detail_trn'>Detail</a>";

            $data[]     = $tbody;
        }

        $cr = $this->transaksi->count_penjualan($tgl_awal, $tgl_akhir)->result_array();

        foreach ($cr as $c) {
            $tot_transaksi += $c['total_transaksi'];
            $jml_transaksi += $c['jumlah_transaksi'];
        }

        $output = [ "draw"             => $_POST['draw'],
                    "date"             => count($date_rg),
                    "recordsTotal"     => $this->transaksi->jumlah_semua_umkm($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->transaksi->jumlah_filter_umkm($tgl_awal, $tgl_akhir),   
                    "data"             => $data,
                    "total_transaksi"  => number_format($tot_transaksi,0,'.','.'),
                    "jumlah_transaksi" => $jml_transaksi
                ];

        echo json_encode($output);
        
    }

    // 02-11-2020
    public function detail_umkm($id_umkm)
    {
        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data 	= [
            'title'     => 'Transaksi',
            'isi'       => 'transaksi/penjualan/V_penjualan',
            'id_umkm'   => $id_umkm,
            'user'      => $this->nama,
            'nama_umkm' => $nm['nama'],
            'hal'       => $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 30-11-2020
    public function pengeluaran()
    {
        if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'transaksi/pengeluaran/V_lihat_admin';
        } else {
            $isi = 'transaksi/pengeluaran/V_pengeluaran';
        }

        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

        $data 	= [
            'title'     => 'Transaksi',
            'isi'       => $isi,
            'id_umkm'   => $this->id_umkm,
            'user'      => $this->nama,
            'nama_umkm'	=> $nm['nama'],
            'hal'       => $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 30-11-2020
    public function tampil_umkm_pengeluaran()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->transaksi->get_data_umkm_p($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

        $tot_transaksi = 0;
        $jml_transaksi = 0;

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $url = base_url()."Transaksi/detail_umkm_peng/".$o['id_umkm'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_umkm'];
            $tbody[]    = "<span style='font-size:15px;' class='badge badge-light font-weight-bold'>".$o['jumlah_transaksi']."</span>";
            $tbody[]    = "<div align='right' class='font-weight-bold' style='font-size:16px;'>".number_format($o['total_transaksi'],0,'.','.')."</div>";
            $tbody[]    = "<a href='$url' class='btn btn-warning btn-sm detail_trn'>Detail</a>";

            $data[]     = $tbody;

            
        }

        $cr = $this->transaksi->count_pengeluaran($tgl_awal, $tgl_akhir)->result_array();

        foreach ($cr as $c) {
            $tot_transaksi += $c['total_transaksi'];
            $jml_transaksi += $c['jumlah_transaksi'];
        }

        $output = [ "draw"             => $_POST['draw'],
                    "date"             => count($date_rg),
                    "recordsTotal"     => $this->transaksi->jumlah_semua_umkm_p($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->transaksi->jumlah_filter_umkm_p($tgl_awal, $tgl_akhir),   
                    "data"             => $data,
                    "total_transaksi"  => number_format($tot_transaksi,0,'.','.'),
                    "jumlah_transaksi" => $jml_transaksi
                ];

        echo json_encode($output);
        
    }

    // 02-11-2020
    public function detail_umkm_peng($id_umkm)
    {
        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data 	= [
            'title'     => 'Transaksi',
            'isi'       => 'transaksi/pengeluaran/V_pengeluaran',
            'id_umkm'   => $id_umkm,
            'user'      => $this->nama,
            'nama_umkm' => $nm['nama'],
            'hal'       => $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function tes()
    {
        $ck = $this->transaksi->list_produk($this->id_umkm)->result_array();

        echo "<pre>";
        print_r($ck);
        echo "</pre>";
    }

    public function halaman_tambah_transaksi($id_umkm)
    {
        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode data_transaksi.json
        $data_checkout = json_decode($dt, true);

        if ($data_checkout == '') {
            $t_qty  = 0;
            $id_pro = [];
        } else {
            $id_pro = [];
            $t_qty  = 0;
            foreach ($data_checkout as $v) {
                $t_qty += $v['qty'];
                array_push($id_pro, $v['id_produk']);
            }
        }

        $result = [];
        foreach($data_checkout as $row){  
            
            if(!isset($result[$row['id_produk']])){  
                $result[$row['id_produk']]=$row;     
            }else{                                    
                $result[$row['id_produk']]['qty'] += $row['qty'];  
            }
        }

        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data_checkout = array_values($result);
        
        $data 	= [
            'title'     => 'Transaksi',
            'isi'       => 'transaksi/penjualan/V_tambah_transaksi',
            'produk'    => $this->transaksi->list_produk($id_umkm)->result_array(),
            'kategori'  => $this->transaksi->list_kategori($id_umkm)->result_array(),
            'qty'       => $t_qty,
            'id_produk' => $id_pro,
            'list'      => $data_checkout,
            'nama_umkm' => $nm['nama'],
            'user'      => $this->nama,
            'id_umkm'   => $id_umkm
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 03-09-2020
    public function tampil_penjualan()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->transaksi->get_data_penjualan($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');
        $total_transaksi    = 0;
        $total_piutang      = 0;

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            // cari data di trn_piutang
            $cp = $this->pelanggan->cari_data('trn_piutang', ['idtransaksi' => $o['id']]);

            $pi = $cp->row_array();

            if ($cp->num_rows() > 0) {
                $st     = "<span class='badge badge-danger'>Piutang</span>";
            } else {
                $st     = "";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = nice_date($o['created_at'], 'd-m-Y');
            $tbody[]    = $o['code_trn'];
            $tbody[]    = $o['atas_nama'];
            $tbody[]    = number_format($o['total_transaksi'],0,'.','.');
            $tbody[]    = number_format($o['tunai'],0,'.','.');
            $tbody[]    = $st;
            $tbody[]    = "<button class='btn btn-warning btn-sm detail_trn' id_trn='".$o['id']."'>Detail</button>";

            $data[]     = $tbody;

        }

        $cr = $this->transaksi->count_detail_penjualan($tgl_awal, $tgl_akhir)->result_array();

        foreach ($cr as $c) {
            $cp2 = $this->pelanggan->cari_data('trn_piutang', ['idtransaksi' => $c['id']]);

            $pi2 = $cp2->row_array();

            $total_transaksi    += $c['total_transaksi'];
            $total_piutang      += $pi2['piutang'];
        }

        $output = [ "draw"             => $_POST['draw'],
                    "date"             => count($date_rg),
                    "recordsTotal"     => $this->transaksi->jumlah_semua_penjualan($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->transaksi->jumlah_filter_penjualan($tgl_awal, $tgl_akhir),   
                    "data"             => $data,
                    "total"            => $total_transaksi - $total_piutang,
                    "jumlah"           => count($cr),
                    "total_piutang"    => $total_piutang
                ];

        echo json_encode($output);
        
    }

    // 04-09-2020
    public function tampil_pengeluaran()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->transaksi->get_data_pengeluaran($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

        $total_transaksi = 0;
        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = nice_date($o['tanggal'], 'd-m-Y');
            $tbody[]    = $o['code_trn'];
            $tbody[]    = number_format($o['total_transaksi'],0,'.','.');
            // $tbody[]    = "<button class='btn btn-warning btn-sm detail_trn' id_trn='".$o['id']."'>Detail</button>";

            $tbody[]    = "<a href='javascript:;' class='btn btn-icon btn-success mr-2 edit' data-id='".$o['id_tr']."' id_tr='".$o['id_transaksi']."' tanggal='".$o['tanggal']."' nama='".$o['nama']."' qty='".$o['qty']."' harga='".$o['harga']."' satuan='".$o['satuan']."' sub_total='".$o['sub_total']."'><i class='far fa-edit'></i></a><a href='javascript:;' class='btn btn-icon btn-danger mr-2 hapus' data-id='".$o['id_tr']."'><i class='fa fa-trash'></i></a><a href='javascript:;' class='btn btn-warning mr-2 detail_trn' id_trn='".$o['id_transaksi']."'><i class='fa fa-info-circle'></i></a>";

            $data[]     = $tbody;
        }

        $cr = $this->transaksi->count_detail_pengeluaran($tgl_awal, $tgl_akhir)->result_array();

        foreach ($cr as $c) {
            $total_transaksi += $c['total_transaksi'];
        }

        $output = [ "draw"             => $_POST['draw'],
                    "date"             => count($date_rg),
                    "recordsTotal"     => $this->transaksi->jumlah_semua_pengeluaran($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->transaksi->jumlah_filter_pengeluaran($tgl_awal, $tgl_akhir),   
                    "data"             => $data,
                    "total"            => $total_transaksi,
                    "jumlah"           => count($cr)
                ];

        echo json_encode($output);
        
    }

    // 03-09-2020 , 04-09-2020
    public function ambil_total()
    {
        $date_rg    = $this->input->post('date_range');
        $aksi       = $this->input->post('aksi');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->transaksi->get_total($tgl_awal, $tgl_akhir, $aksi)->row_array();

        echo json_encode(['total' => ($list['total'] == null) ? '0' : $list['total']]);
    }

    // 04-09-2020
    public function simpan_data_pengeluaran()
    {
        $id_umkm        = $this->input->post('id_umkm');
        $aksi           = $this->input->post('aksi');
        $aksi_tambah    = $this->input->post('aksi_tambah');
        $nama_produk    = $this->input->post('nama_produk');
        $qty            = $this->input->post('qty');
        $tgl_bayar      = $this->input->post('tgl_bayar');
        $tgl_bayar2     = $this->input->post('tgl_bayar2');
        $satuan         = $this->input->post('satuan');
        $id_trn_kedua   = $this->input->post('id_transaksi_kedua');
        $id_tr          = $this->input->post('id_tr');
        $id_trn2        = $this->input->post('id_trn2');
        $jml_data       = $this->input->post('jml_data');
        $harga          = str_replace(".",'',$this->input->post('harga'));
        $sub_total      = str_replace(".",'',$this->input->post('sub_total'));
        $id_detail      = $this->input->post('id_detail');
        

        $kode           = bin2hex(random_bytes(4));
        $tgl_kode       = date("dYm", now('Asia/Jakarta'));

        // if ($aksi_tambah == 'baru_pertama') {

        //     $data_trn    = ['id_umkm'           => $id_umkm,
        //                     'code_trn'          => "TRNO$kode$tgl_kode",
        //                     'total_transaksi'   => $sub_total,
        //                     'jenis'             => 'Pengeluaran',
        //                     'created_at'        => date("Y-m-d H:i:s", now('Asia/Jakarta'))
        //                 ];

        //     // input trn transaksi 
        //     $this->transaksi->input_data('trn_transaksi', $data_trn);
        //     $id_trn = $this->db->insert_id();

        //     // input trn detail pengeluaran
        //     $data_trn_det = [   'id_transaksi'     => $id_trn,
        //                         'tanggal'          => $tgl_bayar,
        //                         'nama'             => $nama_produk,
        //                         'qty'              => $qty,
        //                         'satuan'           => $satuan,
        //                         'harga'            => $harga,
        //                         'sub_total'        => $sub_total,
        //                         'created_at'       => date("Y-m-d H:i:s", now('Asia/Jakarta'))     
        //                     ];

        //     $this->transaksi->input_data('trn_detail_pengeluaran', $data_trn_det);

        //     echo json_encode(['status' => TRUE, 'id_trn' => $id_trn]);

        // } elseif ($aksi_tambah == 'baru_kedua') {

        //     // input trn detail pengeluaran
        //     $data_trn_det = [   'id_transaksi'     => $id_trn_kedua,
        //                         'tanggal'          => $tgl_bayar2,
        //                         'nama'             => $nama_produk,
        //                         'qty'              => $qty,
        //                         'satuan'           => $satuan,
        //                         'harga'            => $harga,
        //                         'sub_total'        => $sub_total,
        //                         'created_at'       => date("Y-m-d H:i:s", now('Asia/Jakarta'))     
        //                     ];
            
        //     $this->transaksi->input_data('trn_detail_pengeluaran', $data_trn_det);

        //     // update total transaksi
        //     $sum = $this->transaksi->cari_sum_total_bayar($id_trn_kedua)->row_array();

        //     $data_tot = ['total_transaksi'  => $sum['sub_total']];

        //     $this->transaksi->ubah_data('trn_transaksi', $data_tot, ['id' => $id_trn_kedua]);

        //     echo json_encode(['status' => TRUE, 'id_trn' => $id_trn_kedua]);

        // }


        if ($aksi == 'Tambah') {

            $data_trn    = ['id_umkm'           => $id_umkm,
                            'code_trn'          => "TRNO$kode$tgl_kode",
                            'total_transaksi'   => $sub_total,
                            'jenis'             => 'Pengeluaran',
                            'id_pelanggan'      => 0,
                            'created_at'        => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                        ];

            // input trn transaksi 
            $this->transaksi->input_data('trn_transaksi', $data_trn);
            $id_trn = $this->db->insert_id();

            // input trn detail pengeluaran
            $data_trn_det = [   'id_transaksi'     => $id_trn,
                                'tanggal'          => $tgl_bayar,
                                'nama'             => $nama_produk,
                                'qty'              => $qty,
                                'satuan'           => $satuan,
                                'harga'            => $harga,
                                'sub_total'        => $sub_total,
                                'created_at'       => date("Y-m-d H:i:s", now('Asia/Jakarta'))     
                            ];

            $this->transaksi->input_data('trn_detail_pengeluaran', $data_trn_det);

            echo json_encode(['status' => TRUE]);
        
        }

        if ($aksi == 'Ubah') {

            $this->db->trans_start(); 
            $this->db->trans_strict(FALSE);
            
            $data_trn_det = [   'tanggal'          => $tgl_bayar,
                                'nama'             => $nama_produk,
                                'qty'              => $qty,
                                'satuan'           => $satuan,
                                'harga'            => $harga,
                                'sub_total'        => $sub_total,
                                'created_at'       => date("Y-m-d H:i:s", now('Asia/Jakarta'))     
                            ];

            $this->transaksi->ubah_data('trn_detail_pengeluaran', $data_trn_det, ['id_transaksi' => $id_tr]);
            $this->transaksi->ubah_data('trn_transaksi', ['total_transaksi' => $sub_total], ['id' => $id_tr]);
            
            $this->db->trans_complete(); 

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo json_encode(['status' => false]);
            } 
            else {
                $this->db->trans_commit();
                echo json_encode(['status' => true]);
            }
        }

        if ($aksi == 'Hapus') {

            $this->db->trans_start(); 
            $this->db->trans_strict(FALSE);

            $this->transaksi->hapus_data('trn_detail_pengeluaran', ['id_transaksi' => $id_detail]);
            $this->transaksi->hapus_data('trn_transaksi', ['id' => $id_detail]);

            $this->db->trans_complete(); 

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo json_encode(['status' => false]);
            } 
            else {
                $this->db->trans_commit();
                echo json_encode(['status' => true]);
            }
            
            // if ($jml_data == 1) {

            //     $this->transaksi->hapus_data('trn_detail_pengeluaran', ['id' => $id_trn_kedua]);
            //     $this->transaksi->hapus_data('trn_transaksi', ['id' => $id_trn2]);

            //     $id_trn2 = 0;

            // } else {
            //     $this->transaksi->hapus_data('trn_detail_pengeluaran', ['id' => $id_trn_kedua]);

            //     // update total transaksi
            //     $sum = $this->transaksi->cari_sum_total_bayar($id_trn2)->row_array();

            //     $data_tot = ['total_transaksi'  => $sum['sub_total']];

            //     $this->transaksi->ubah_data('trn_transaksi', $data_tot, ['id' => $id_trn2]);

            //     $id_trn2 = $id_trn2;

            // }
            
            // echo json_encode(['status' => TRUE, 'id_trn' => $id_trn2]);
            
        }
       
    }

    // 27-08-2020
    public function ambil_data_produk($aksi_tambah, $id_produk)
    {
        $data = ['pro'          => $this->transaksi->list_pro($id_produk)->row_array(),
                 'ukuran'       => $this->transaksi->cari_data('mst_ukuran', ['id_produk' => $id_produk])->result_array(),
                 'topping'      => $this->transaksi->cari_data('mst_topping', ['id_produk' => $id_produk])->result_array(),
                 'aksi_tambah'  => $aksi_tambah
                ];

        $this->load->view('transaksi/penjualan/V_form_tambah', $data);
    }

    // 31-08-2020
    public function ambil_data_tambah_produk($id_produk)
    {
        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode data_transaksi.json
        $data_pro = json_decode($dt, true);

        // masukkan key id_produk ke array
        $b = [] ;
        foreach ($data_pro as $key => $value) {
            if ($value['id_produk'] != $id_produk) {     
                array_push($b, $key);
            }
        }

        // membuat array key produk
        $a = [];
        foreach ($b as $bl) {
            $a += [$bl => ""];
        }

        // mengapus multi element
        $array = array_diff_key($data_pro, $a);

        $data = ['list'     => $array,
                 'id_produk'=> $id_produk
                ];

        $this->load->view('transaksi/penjualan/V_form_tambah_dua', $data);
    }

    public function ambil_data_tambah_produk_kedua($id_produk, $key)
    {
        // $data = ['pro'      => $this->transaksi->list_pro($id_produk)->row_array(),
        //          'ukuran'   => $this->transaksi->cari_data('mst_ukuran', ['id_produk' => $id_produk])->result_array(),
        //          'topping'  => $this->transaksi->cari_data('mst_topping', ['id_produk' => $id_produk])->result_array()
        //         ];

        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode data_transaksi.json
        $data_pro = json_decode($dt, true);

        // masukkan key id_produk ke array
        $b = [] ;
        foreach ($data_pro as $key => $value) {
            if ($value['id_produk'] != $id_produk) {     
                array_push($b, $key);
            }
        }

        // membuat array key produk
        $a = [];
        foreach ($b as $bl) {
            $a += [$bl => ""];
        }

        // mengapus multi element
        $array = array_diff_key($data_pro, $a);

        $c = [];
        foreach ($array as $y) {
            $c += $y;
        }

        $data = ['produk'   => $c,
                 'pro'      => $this->transaksi->list_pro($id_produk)->row_array(),
                 'ukuran'   => $this->transaksi->cari_data('mst_ukuran', ['id_produk' => $id_produk])->result_array(),
                 'topping'  => $this->transaksi->cari_data('mst_topping', ['id_produk' => $id_produk])->result_array()
                ];
        
        // echo"<pre>";
        // print_r($c);
        // echo"</pre>";

        $this->load->view('transaksi/penjualan/V_form_tambah_tr_kedua', $data);
    }

    // 02-09-2020
    public function ambil_halaman_topping()
    {
        $id_produk      = $this->input->post('id_produk');
        $key            = $this->input->post('key');
        $status_edit    = $this->input->post('status_edit');
        $aksi_tambah    = $this->input->post('aksi_tambah');

        $data_pro = $this->get_file_json();

        $data = ['produk'       => $data_pro[$key],
                 'pro'          => $this->transaksi->list_pro($id_produk)->row_array(),
                 'aksi_tambah'  => $aksi_tambah,
                 'key'          => $key,
                 'status_edit'  => $status_edit,
                 'ukuran'       => $this->transaksi->cari_data('mst_ukuran', ['id_produk' => $id_produk])->result_array(),
                 'topping'      => $this->transaksi->cari_data('mst_topping', ['id_produk' => $id_produk])->result_array()
                ];

        // echo"<pre>";
        // print_r($data_pro[$key]);
        // echo"</pre>";

        $this->load->view('transaksi/penjualan/V_form_edit_tr_kedua', $data);
        
    }

    // 03-09-2020
    public function tampilan_detail_transaksi()
    {
        $id_tr = $this->input->post('id_tr');
        $aksi  = $this->input->post('aksi');

        $li = $this->transaksi->cari_data('trn_transaksi', ['id' => $id_tr])->row_array();
        $ct = $this->transaksi->cari_data('trn_piutang', ['idtransaksi' => $id_tr])->row_array();

        $data   = ['id_tr'       => $id_tr,
                   'trn'         => $li,
                   'list'        => $this->transaksi->cari_data('trn_detail_pemasukan', ['id_transaksi' => $id_tr])->result_array(),
                   'nama_plg'    => $this->transaksi->cari_data('mst_pelanggan', ['id' => $li['id_pelanggan']])->row_array(),
                   'aksi'        => $aksi,
                   'cr_piutang'	 => $ct
                  ];

        $this->load->view('transaksi/penjualan/V_detail_transaksi', $data);
    }

    // 04-09-2020
    public function tampilan_detail_transaksi_pengeluaran()
    {
        $id_tr          = $this->input->post('id_tr');
        $aksi_tambah    = $this->input->post('aksi_tambah');
        $id_umkm        = $this->input->post('id_umkm');

        $data   = ['id_tr'       => $id_tr,
                   'aksi_tambah' => $aksi_tambah,
                   'id_umkm'     => $id_umkm,
                   'trn'         => $this->transaksi->cari_data('trn_transaksi', ['id' => $id_tr])->row_array(),
                   'list'        => $this->transaksi->cari_data('trn_detail_pengeluaran', ['id_transaksi' => $id_tr])->result_array()
                  ];

        $this->load->view('transaksi/pengeluaran/V_detail_transaksi', $data);
    }

    // 28-08-2020
    public function simpan_list_transaksi()
    {
        $total          = $this->input->post('total');
        $qty            = $this->input->post('qty');
        $harga_ukuran   = $this->input->post('harga_ukuran');
        $id_ukuran      = $this->input->post('id_ukuran');
        $id_produk      = $this->input->post('id_produk');
        $id_topping     = $this->input->post('id_topping');
        $diskon         = $this->input->post('diskon');

        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode anggota.json
        $data = json_decode($dt, true);

        $data[] = ['total'          => $total,
                   'qty'            => $qty, 
                   'harga_ukuran'   => $harga_ukuran,
                   'id_ukuran'      => $id_ukuran,
                   'id_produk'      => $id_produk,
                   'id_topping'     => $id_topping,
                   'diskon'         => $diskon
                ];

        // membuat file json
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents('data_transaksi.json', $jsonfile);

        // unlink("data_transaksi.json");

        // $t_qty = 0;
        // foreach ($data as $v) {
        //     $t_qty += $v['qty'];
        // }
        
        $data_pro = $this->get_file_json();

        $b = [] ;
        foreach ($data_pro as $key => $value) {
            if ($value['id_produk'] != $id_produk) {     
                array_push($b, $key);
            }
        }

        // membuat array key produk
        $a = [];
        foreach ($b as $bl) {
            $a += [$bl => ""];
        }

        // mengapus multi element
        $array = array_diff_key($data_pro, $a);

        $t_qty = 0;
        foreach ($array as $v) {
            $t_qty += $v['qty'];
        }

        $tot_qty = 0;
        foreach ($data_pro as $p) {
            $tot_qty += $p['qty'];
        }

        echo json_encode(['tot_qty' => $tot_qty, 'qty' => $t_qty]);
    }

    // 01-09-2020
    public function get_file_json()
    {
        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode anggota.json
        $data = json_decode($dt, true);

        return $data;
    }

    public function put_file_json($data)
    {
        // membuat file json
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents('data_transaksi.json', $jsonfile);
    }

    // 31-08-2020
    public function simpan_ubah_list_transaksi()
    {
        $total          = $this->input->post('total');
        $qty            = $this->input->post('qty');
        $harga_ukuran   = $this->input->post('harga_ukuran');
        $id_ukuran      = $this->input->post('id_ukuran');
        $id_produk      = $this->input->post('id_produk');
        $id_topping     = $this->input->post('id_topping');
        $diskon         = $this->input->post('diskon');
        $no_key         = $this->input->post('key');

        $data = $this->get_file_json();

        if ($total == 0) {
            
            if ($no_key != '') {

                foreach ($data as $key => $d) {
                    // Perbarui data kedua
                    if ($key === $no_key) {
                        array_splice($data, $key, 1);
                    }
                }

            } else {
                foreach ($data as $key => $d) {
                    // Perbarui data kedua
                    if ($d['id_produk'] === $id_produk) {
                        array_splice($data, $key, 1);
                    }
                }
            }
            
        
        } else {

            if ($no_key != '') {
                foreach ($data as $key => $d) {
                    // Perbarui data kedua
                    if ($key === $no_key) {
                        $data[$key]['total']        = $total;
                        $data[$key]['qty']          = $qty;
                        $data[$key]['harga_ukuran'] = $harga_ukuran;
                        $data[$key]['id_ukuran']    = $id_ukuran;
                        $data[$key]['id_topping']   = $id_topping;
                        $data[$key]['diskon']       = $diskon;
                    }
                }  
            } else {
                foreach ($data as $key => $d) {
                    // Perbarui data kedua
                    if ($d['id_produk'] === $id_produk) {
                        $data[$key]['total']        = $total;
                        $data[$key]['qty']          = $qty;
                        $data[$key]['harga_ukuran'] = $harga_ukuran;
                        $data[$key]['id_ukuran']    = $id_ukuran;
                        $data[$key]['id_topping']   = $id_topping;
                        $data[$key]['diskon']       = $diskon;
                    }
                }  
            }

            
        }

        $this->put_file_json($data);

        $t_qty = 0;
        foreach ($data as $v) {
            $t_qty += $v['qty'];
        }

        echo json_encode(['tot_qty' => $t_qty, 'pro_qty' => $qty]);
    }
    public function simpan_ubah_list_transaksi2()
    {
        $total          = $this->input->post('total');
        $qty            = $this->input->post('qty');
        $harga_ukuran   = $this->input->post('harga_ukuran');
        $id_ukuran      = $this->input->post('id_ukuran');
        $id_produk      = $this->input->post('id_produk');
        $id_topping     = $this->input->post('id_topping');
        $diskon         = $this->input->post('diskon');
        $no_key         = $this->input->post('key');

        $data = $this->get_file_json();

        if ($total == 0) {
            
            foreach ($data as $key => $d) {
                // Perbarui data kedua
                if ($key == $no_key) {
                    array_splice($data, $no_key, 1);
                }
            }
            
        
        } else {

            foreach ($data as $key => $d) {
                // Perbarui data kedua
                if ($key == $no_key) {
                    $data[$no_key]['total']        = $total;
                    $data[$no_key]['qty']          = $qty;
                    $data[$no_key]['harga_ukuran'] = $harga_ukuran;
                    $data[$no_key]['id_ukuran']    = $id_ukuran;
                    $data[$no_key]['id_topping']   = $id_topping;
                    $data[$no_key]['diskon']       = $diskon;
                }
            }  
            
        }

        $this->put_file_json($data);

        $t_qty = 0;
        foreach ($data as $v) {
            $t_qty += $v['qty'];
        }

        echo json_encode(['tot_qty' => $t_qty, 'pro_qty' => $qty]);
    }

    function super_unique($array,$key)
    {
       $temp_array = [];
       foreach ($array as &$v) {
           if (!isset($temp_array[$v[$key]]))
           $temp_array[$v[$key]] =& $v;
       }
       $array = array_values($temp_array);
       return $array;

    }

    // 01-09-2020
    public function hapus_list_transaksi()
    {
        $id_key     = $this->input->post('key');
        $id_produk  = $this->input->post('id_produk');
        
        $data_pro = $this->get_file_json();

        foreach ($data_pro as $key => $d) {
            if ($key == $id_key) {
                array_splice($data_pro, $id_key, 1);
            }
        }

        $this->put_file_json($data_pro);

        $b = [] ;
        foreach ($data_pro as $key => $value) {
            if ($value['id_produk'] != $id_produk) {     
                array_push($b, $key);
            }
        }

        // membuat array key produk
        $a = [];
        foreach ($b as $bl) {
            $a += [$bl => ""];
        }

        // mengapus multi element
        $array = array_diff_key($data_pro, $a);

        $data = ['list'     => $array,
                 'id_produk'=> $id_produk,
                 'key'      => $key
                ];

        $this->load->view('transaksi/penjualan/V_form_tambah_dua', $data);

    }

    public function ambil_kondisi_produk()
    {
        $id_produk = $this->input->post('id_produk');
        
        $data_pro = $this->get_file_json();

        foreach ($data_pro as $key => $value) {
            if($value['qty'] == 0) {
                array_splice($data_pro, $key, 1);
            } 
        }

        $b = [] ;
        foreach ($data_pro as $key => $value) {
            if ($value['id_produk'] != $id_produk) {     
                array_push($b, $key);
            }
        }

        // membuat array key produk
        $a = [];
        foreach ($b as $bl) {
            $a += [$bl => ""];
        }

        // mengapus multi element
        $array = array_diff_key($data_pro, $a);

        $t_qty = 0;
        foreach ($array as $v) {
            $t_qty += $v['qty'];
        }

        $tot_qty = 0;
        foreach ($data_pro as $p) {
            $tot_qty += $p['qty'];
        }

        $data = ['jumlah_pro' => count($array),
                 'jml_pro'    => count($data_pro),
                 'qty'        => $t_qty,
                 'tot_qty'    => $tot_qty
                ];

        echo json_encode($data);
    }

    public function tes_file()
    {
        // $data[] = [
        //     'total'          => 0,
        //     'qty'            => 0, 
        //     'harga_ukuran'   => 0,
        //     'id_ukuran'      => 0,
        //     'id_produk'      => 0,
        //     'id_topping'     => null,
        //     'diskon'         => 0
        // ];

        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode anggota.json
        $data = json_decode($dt, true);

        foreach ($data as $key => $value) {
            if($value['qty'] == 0) {
                array_splice($data, $key, 1);
            } 
        }

        $result = [];
        foreach($data as $row){  // iterate all rows
            
            if(!isset($result[$row['id_ukuran']])){  // if first occurrence of day...
                $result[$row['id_ukuran']] = $row;     // save the full row with day as the temporary key
            }else{                                    // if not the first occurrence of day...
                $result[$row['id_ukuran']]['qty']           += $row['qty'];  // add movements value
                $result[$row['id_ukuran']]['total']         += $row['total'];  // add movements value
                $result[$row['id_ukuran']]['diskon']        += $row['diskon'];  // add movements value
                $result[$row['id_ukuran']]['harga_ukuran']  += $row['harga_ukuran'];  // add movements value
            }
        }
        
        echo "<pre>";
        // print_r($final_array);
        print_r(array_values($result));
        echo "</pre>";

        // echo "<pre>";
        // // print_r(print_r($this->super_unique($data,'id_produk')));
        // // print_r(array_unique(array_column($data, 'id_produk')));
        // print_r($dup_items);
        // echo "</pre>";

    }

    public function cek_data()
    {
        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode data_transaksi.json
        $data = json_decode($dt, true);

        $b = [] ;
        foreach ($data as $key => $value) {

            if ($value['id_produk'] != 10) {     
                array_push($b, $key);
            }

        }

        $a = [];
        foreach ($b as $bl) {
            $a += [$bl => ""];
        }

        $array = array_diff_key($data, $a);

        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    // 29-08-2020
    public function halaman_checkout($id_umkm)
    {
        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode data_transaksi.json
        $data_checkout = json_decode($dt, true);

        $tot_belanja = 0;
        $tot_diskon = 0;
        foreach ($data_checkout as $key => $v) {
            if ($v['qty'] == 0) {
                array_splice($data_checkout, $key, 1);
            }
            $tot_belanja += $v['total'];
            $tot_diskon  += $v['diskon'];
        }

        $data = ['list'       => $data_checkout,
                 'atas_nama'  => $this->transaksi->cari_data('mst_pelanggan', ['idumkm' => $id_umkm])->result_array(),
                 'tot_belanja'=> $tot_belanja,
                 'tot_diskon' => $tot_diskon,
                 'id_umkm'    => $id_umkm
                ];

        $this->load->view('transaksi/penjualan/V_list_checkout', $data);
        
    }

    public function hapus_produk()
    {
        $id_produk      = $this->input->post('id_produk');
        $no_key         = $this->input->post('key');

        $data_checkout = $this->get_file_json();

        foreach ($data_checkout as $key => $d) {
            // Perbarui data kedua
            if ($key == $no_key) {
                array_splice($data_checkout, $no_key, 1);
            }
        }

        $this->put_file_json($data_checkout);

        $t_qty          = 0;
        $tot_belanja    = 0;
        $tot_diskon     = 0;

        foreach ($data_checkout as $key => $v) {

            if ($v['qty'] == 0) {
                array_splice($data_checkout, $key, 1);
            }

            $tot_belanja += $v['total'];
            $tot_diskon  += $v['diskon'];
            $t_qty       += $v['qty'];
        }

        $data = ['list'       => $data_checkout,
                 'atas_nama'  => $this->transaksi->cari_data('mst_pelanggan', ['idumkm' => $this->id_umkm])->result_array(),
                 'tot_belanja'=> $tot_belanja,
                 'tot_diskon' => $tot_diskon
                ];

        $this->load->view('transaksi/penjualan/V_list_checkout', $data);
    }

    // 02-09-2020
    public function tampil_produk()
    {
        $data_checkout = $this->get_file_json();

        $t_qty          = 0;
        $tot_belanja    = 0;
        $tot_diskon     = 0;

        foreach ($data_checkout as $key => $v) {

            if ($v['qty'] == 0) {
                array_splice($data_checkout, $key, 1);
            }

            $tot_belanja += $v['total'];
            $tot_diskon  += $v['diskon'];
            $t_qty       += $v['qty'];
        }

        $data = ['list'       => $data_checkout,
                 'atas_nama'  => $this->transaksi->cari_data('mst_pelanggan', ['idumkm' => $this->id_umkm])->result_array(),
                 'tot_belanja'=> $tot_belanja,
                 'tot_diskon' => $tot_diskon
                ];

        $this->load->view('transaksi/penjualan/V_list_checkout', $data);
    }

    public function ttes()
    {
        echo bin2hex(random_bytes(4));
    }

    public function simpan_transaksi($id_umkm)
    {
        // File json yang akan dibaca
        $file = "data_transaksi.json";

        // Mendapatkan file json
        $dt = file_get_contents($file);

        // Mendecode data_transaksi.json
        $data_tr = json_decode($dt, true);

        $id_pelanggan       = $this->input->post('atas_nama');
        $status_atas_nama   = $this->input->post('status_atas_nama');
        $t_atas_nama        = $this->input->post('t_atas_nama');
        $telp_an            = $this->input->post('telp_an');
        $diskon_tr          = $this->input->post('diskon_tr');
        $total_belanja      = str_replace('.','', $this->input->post('total_belanja'));

        $aksi               = $this->input->post('aksi');
        $p_nominal_piutang  = str_replace('.','', $this->input->post('p_nominal_piutang'));
        $tot_piutang        = str_replace('.','', $this->input->post('tot_piutang'));
        $tunai              = str_replace('.','', $this->input->post('tunai'));

        $tgl                = date("Y-m-d H:i:s", now('Asia/Jakarta'));

        if ($status_atas_nama == 'baru') {
            // simpan ke master pelanggan
            $dt_pel = [ 'idumkm'        => $id_umkm,
                        'nama'          => $t_atas_nama,
                        'telp'          => $telp_an,
                        'tot_piutang'   => 0,
                        'created_at'    => $tgl
                      ];

            $this->transaksi->input_data('mst_pelanggan', $dt_pel);
            $id_pelanggan = $this->db->insert_id();
        } else {
            $id_pelanggan = $id_pelanggan;
        }

        $tot_belanja = 0;
        $tot_diskon  = 0;

        foreach ($data_tr as $r) {
            $tot_belanja += $r['total'];
            $tot_diskon  += $r['diskon'];
        }
        
        // kode acak
        $kode = bin2hex(random_bytes(4));

        $tgl_kode   = date("dYm", now('Asia/Jakarta'));

        // simpan ke table tr_transaksi
        $data_tabel_tr = ['id_umkm'         => $id_umkm,
                          'code_trn'        => "TRNI$kode$tgl_kode",
                          'total_transaksi' => $total_belanja,
                          'total_discount'  => $tot_diskon + ($diskon_tr == '' ? 0 : $diskon_tr),
                          'jenis'           => 'Pemasukan',
                          'created_at'      => $tgl,
                          'id_pelanggan'    => $id_pelanggan,
                          'tunai'           => $tunai
                         ];

        $this->transaksi->input_data('trn_transaksi', $data_tabel_tr);
        $id_tr = $this->db->insert_id();
        
        foreach ($data_tr as $d) {
            
            // cari data produk
            $pro = $this->transaksi->cari_data('mst_produk', ['id' => $d['id_produk']])->row_array();

            // cari data ukuran
            $uk = $this->transaksi->cari_data('mst_ukuran', ['id' => $d['id_ukuran']])->row_array();  

            if ($d['id_topping'] != null) {
                $tpi = '';
                // cari data topping
                foreach ($d['id_topping'] as $t) {
                    $i = $this->transaksi->cari_data('mst_topping', ['id' => $t])->row_array();
                    $tpi .= $i['topping']." ";
                }
            } else {
                $tpi = "";
            }

            if ($d['id_ukuran'] != null) {
                $idu = "(".$uk['ukuran'].")";
            } else {
                $idu = "";
            }

            $data_tr_detail = [ 'id_transaksi'  => $id_tr,
                                'id_produk'     => $d['id_produk'],
                                'nama_produk'   => $pro['nama']." ".$tpi." ".$idu." ",
                                'qty'           => $d['qty'],
                                'harga'         => $pro['harga'],
                                'sub_total'     => $d['total'],
                                'sub_discount'  => $d['diskon'],
                                'created_at'    => $tgl
                              ];

            if ($d['qty'] != 0) {
                $this->transaksi->input_data('trn_detail_pemasukan', $data_tr_detail);
            }
            
        }

        // untuk piutang
        if ($aksi == 'piutang') {
            
            $this->transaksi->ubah_data('mst_pelanggan', ['tot_piutang' => $tot_piutang], ['id' => $id_pelanggan]);

            $input_piutang = ['idpelanggan' => $id_pelanggan,
                              'idtransaksi' => $id_tr,
                              'bayar'       => $tunai,
                              'piutang'     => $p_nominal_piutang,
                              'created_at'  => $tgl
                             ];
            
            $this->transaksi->input_data('trn_piutang', $input_piutang);

        }

        unlink("data_transaksi.json");

        $data[] = [
            'total'          => 0,
            'qty'            => 0, 
            'harga_ukuran'   => 0,
            'id_ukuran'      => 0,
            'id_produk'      => 0,
            'id_topping'     => null,
            'diskon'         => 0
        ];

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents('data_transaksi.json', $jsonfile);

        echo json_encode(['status' => 'berhasil', 'id_transaksi' => $id_tr]);

    }

}

/* End of file Transaksi.php */
