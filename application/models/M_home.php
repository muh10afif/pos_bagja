<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

    // 11-09-2020

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm  = $this->session->userdata('id_umkm');
        $this->nama     = $this->session->userdata('nama');
    }

    // 11-09-2020

    public function get_tot_transaksi($tanggal, $id_umkm)
    {
        $this->db->select('code_trn, id_pelanggan');
        $this->db->from('trn_transaksi');
        if ($this->nama != 'Bagja') {
            $this->db->where('id_umkm', $id_umkm);
        } else {
            if ($id_umkm != 0) {
                $this->db->where('id_umkm', $id_umkm);
            }
        }
        $this->db->where('jenis', 'Pemasukan');

        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tanggal);

        $this->db->group_by('code_trn');

        return $this->db->get();
    }

    // 11-09-2020

    public function get_tot_transaksi_bulan($bulan, $id_umkm)
    {
        $this->db->select('code_trn, id_pelanggan');
        $this->db->from('trn_transaksi');
        if ($this->nama != 'Bagja') {
            $this->db->where('id_umkm', $id_umkm);
        } else {
            if ($id_umkm != 0) {
                $this->db->where('id_umkm', $id_umkm);
            }
        }
        $this->db->where('jenis', 'Pemasukan');

        $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $bulan);

        $this->db->group_by('code_trn');

        return $this->db->get();
    }

    // 11-09-2020

    public function get_sisa_piutang($tanggal, $id_pelanggan, $id_umkm)
    {
        $this->db->select('p.sisa_piutang');
        $this->db->from('trn_bayar_piutang as p');
        if ($this->nama != 'Bagja') {
            $this->db->where('p.idumkm', $id_umkm);
        } else {
            if ($id_umkm != 0) {
                $this->db->where('p.idumkm', $id_umkm);
            }
        }
        $this->db->where("DATE_FORMAT(p.created_at, '%Y-%m-%d') =", $tanggal);

        $this->db->where('p.idpelanggan', $id_pelanggan);

        $this->db->order_by('p.created_at', 'desc');

        return $this->db->get();
    }

    // 11-09-2020

    public function get_sisa_piutang_bulan($bulan, $id_pelanggan, $id_umkm)
    {
        $this->db->select('p.sisa_piutang');
        $this->db->from('trn_bayar_piutang as p');
        if ($this->nama != 'Bagja') {
            $this->db->where('p.idumkm', $id_umkm);
        } else {
            if ($id_umkm != 0) {
                $this->db->where('p.idumkm', $id_umkm);
            }
        }
        $this->db->where("DATE_FORMAT(p.created_at, '%Y-%m') =", $bulan);

        $this->db->where('p.idpelanggan', $id_pelanggan);

        $this->db->order_by('p.created_at', 'desc');

        return $this->db->get();
    }

    // 11-09-2020

    public function get_tot_pendapatan_pengeluran($tanggal, $jenis, $id_umkm)
    {
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        if ($this->nama != 'Bagja') {
            $this->db->where('id_umkm', $id_umkm);
        } else {
            if ($id_umkm != 0) {
                $this->db->where('id_umkm', $id_umkm);
            }
        }
        $this->db->where('jenis', $jenis);

        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tanggal);

        $a = $this->db->get()->row_array();

        return $a['total_transaksi'];
        
    }

    // 11-09-2020

    public function get_tot_pendapatan_pengeluran_bulan($bulan, $jenis, $id_umkm)
    {
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        if ($this->nama != 'Bagja') {
            $this->db->where('id_umkm', $id_umkm);
        } else {
            if ($id_umkm != 0) {
                $this->db->where('id_umkm', $id_umkm);
            }
        }
        $this->db->where('jenis', $jenis);

        $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $bulan);

        $a = $this->db->get()->row_array();

        return $a['total_transaksi'];
        
    }

    // 11-11-2020
    // Menampilkan list umkm
    public function get_data_umkm()
    {
        $this->_get_datatables_query_umkm();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm = [null, 'nama', 'namaowner', 'telp', 'alamat'];
    var $kolom_cari_umkm  = ['LOWER(nama)', 'LOWER(namaowner)', 'telp', 'LOWER(alamat)'];
    var $order_umkm       = ['nama' => 'asc'];

    public function _get_datatables_query_umkm()
    {
        $this->db->from('mst_umkm'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_umkm;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_umkm;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_umkm)) {
            
            $order = $this->order_umkm;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_umkm()
    {
        $this->db->from('mst_umkm'); 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm()
    {
        $this->_get_datatables_query_umkm();

        return $this->db->get()->num_rows();
        
    }

    // 12-11-2020
    public function get_kat_usaha()
    {
        $this->db->select('*');
        $this->db->from('mst_kat_usaha');
        $this->db->group_by('jenis');
        
        return $this->db->get();
        
    }

}

/* End of file M_home.php */
