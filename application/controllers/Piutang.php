<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {

    // 05-09-2020

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
        if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'piutang/V_lihat_admin';
        } else {
            $isi = 'piutang/V_tampil';
        }

        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

        $data 	= [ 'title'     => 'Piutang',
                    'list_nama' => $this->piutang->cari_pelanggan()->result_array(),
                    'isi'       => $isi,
                    'user'      => $this->nama,
                    'id_umkm'   => $this->id_umkm,
                    'nama_umkm'	=> $nm['nama'],
                    'hal'       => $this->hal
                ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 03-12-2020
    public function tampil_data_umkm()
    {
        $list = $this->piutang->get_data_umkm();

        $data = array();

        $no   = $this->input->post('start');

        $tot_piutang = 0;
        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $href = base_url()."Piutang/detail_umkm/".$o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_umkm'];
            $tbody[]    = "<div class='text-right'><span style='font-size:15px;' class='badge badge-light font-weight-bold'>".number_format($o['tot_piutang'],0,'.','.')."</span></div>";
            $tbody[]    = "<a href='$href' class='btn btn-icon btn-warning mr-2'>Detail</a>";
            $data[]     = $tbody;

        }

        $cr = $this->piutang->count_piutang()->result_array();

        foreach ($cr as $c) {
            $tot_piutang    += $c['tot_piutang'];
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->piutang->jumlah_semua_umkm(),
                    "recordsFiltered"  => $this->piutang->jumlah_filter_umkm(),   
                    "data"             => $data,
                    "tot_piutang"      => number_format($tot_piutang,0,'.','.')
                ];

        echo json_encode($output);
    }

    // 03-12-2020
    public function detail_umkm($id_umkm)
    {
        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data 	= [
            'title'     => 'Piutang',
            'isi'       => 'piutang/V_tampil',
            'id_umkm'   => $id_umkm,
            'user'      => $this->nama,
            'nama_umkm' => $nm['nama'],
            'hal'       => $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 05-09-2020
    public function tampil_data_piutang()
    {
        $list = $this->piutang->get_data_piutang();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = "<div align='right'>".number_format($o['tot_piutang'],0,'.','.')."</div>";
            $tbody[]    = "<button class='btn btn-sm btn-icon btn-warning mr-2 detail-piutang' data-id='".$o['id']."' nama='".$o['nama']."'>History Bayar</button>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->piutang->jumlah_semua_piutang(),
                    "recordsFiltered"  => $this->piutang->jumlah_filter_piutang(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 07-09-2020
    public function tampil_data_detail_piutang()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        
        $list = $this->piutang->get_data_detail_piutang($id_pelanggan);

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = "<div align='center'>".nice_date($o['tanggal'], 'd M Y')."</div>";
            $tbody[]    = "<div align='right'>".number_format($o['bayar'],0,'.','.')."</div>";
            $tbody[]    = "<div align='right'>".number_format($o['sisa_piutang'],0,'.','.')."</div>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->piutang->jumlah_semua_detail_piutang($id_pelanggan),
                    "recordsFiltered"  => $this->piutang->jumlah_filter_detail_piutang($id_pelanggan),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 05-09-2020
    public function simpan_data_piutang()
    {
        $tgl_bayar      = $this->input->post('tgl_bayar');
        $idpelanggan    = $this->input->post('idpelanggan');
        $nama_pel       = $this->input->post('nama_pel');
        $id_umkm        = $this->input->post('id_umkm');
        $bayar          = str_replace('.','',$this->input->post('bayar'));
        $tot_piutang    = str_replace('.','',$this->input->post('tot_piutang'));

        $t_p = ($bayar) - ($tot_piutang);
        
        $data = ['idumkm'       => $id_umkm,
                 'idpelanggan'  => $idpelanggan,
                 'tanggal'      => $tgl_bayar,
                 'bayar'        => $bayar,
                 'sisa_piutang' => ($tot_piutang) - ($bayar),
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        $this->db->trans_start(); 
        $this->db->trans_strict(FALSE);

        // input trn bayar piutang
        $this->piutang->input_data('trn_bayar_piutang', $data);

        // ubah data tot piutang
        $this->piutang->ubah_data('mst_pelanggan', ['tot_piutang' => ($tot_piutang) - ($bayar)], ['id' => $idpelanggan]);

        // kode acak
        $kode = bin2hex(random_bytes(4));

        $tgl_kode   = date("dYm", now('Asia/Jakarta'));

        // 03-12-2020
        // simpan ke table tr_transaksi
        $data_tabel_tr = ['id_umkm'         => $id_umkm,
                          'code_trn'        => "TRNI$kode$tgl_kode",
                          'total_transaksi' => $bayar,
                          'total_discount'  => 0,
                          'jenis'           => 'Bayar Piutang',
                          'created_at'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'id_pelanggan'    => $idpelanggan,
                          'tunai'           => $bayar
                         ];

        $this->transaksi->input_data('trn_transaksi', $data_tabel_tr);
        $id_tr = $this->db->insert_id();

        $data_tr_detail = [ 'id_transaksi'  => $id_tr,
                            'id_produk'     => 0,
                            'nama_produk'   => "Pembayaran Piutang ".ucwords($nama_pel),
                            'qty'           => 1,
                            'harga'         => $bayar,
                            'sub_total'     => $bayar,
                            'sub_discount'  => 0,
                            'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                            ];

        $this->transaksi->input_data('trn_detail_pemasukan', $data_tr_detail);

        $this->db->trans_complete(); 

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } 
        else {
            $this->db->trans_commit();
        }

        // 07-09-2020
        // cari data pelanggan
        $pl = $this->piutang->cari_pelanggan()->result_array();

        $option = "";

        $option = "<option value='' tot_piutang=''>Pilih Pelanggan</option>";

        foreach ($pl as $d) {
            $option .= "<option value='".$d['id']."' tot_piutang='".$d['tot_piutang']."'>".$d['nama']."</option>";
        }

        echo json_encode(['status' => true, 'sisa_piutang' => $t_p, 'list_pl' => $option]);
    }

    // 07-09-2020
    public function ambil_list_pelanggan()
    {
        $pl = $this->piutang->cari_pelanggan()->result_array();

        $option = "";

        $option = "<option value='' tot_piutang=''>Pilih Pelanggan</option>";

        foreach ($pl as $d) {
            $option .= "<option value='".$d['id']."' tot_piutang='".$d['tot_piutang']."'>".$d['nama']."</option>";
        }

        echo json_encode(['status' => true, 'list_pl' => $option]);

    }

}

/* End of file Piutang.php */
