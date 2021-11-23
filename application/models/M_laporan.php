<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    // 03-12-2020
    public function get_data_umkm_penjualan($awal, $akhir)
    {
        $this->_get_datatables_query_umkm_penjualan($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm_penjualan = [null, 'm.nama', 'total_pendapatan', 'total_pengeluaran', 'keuntungan'];
    var $kolom_cari_umkm_penjualan  = ['LOWER(m.nama)'];
    var $order_umkm_penjualan       = ['m.nama' => 'asc'];

    public function _get_datatables_query_umkm_penjualan($tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal == '') {
            $tgl_awal = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal = $tgl_awal;
        }

        if ($tgl_akhir == '') {
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_akhir = $tgl_akhir;
        } 

        $this->db->select("m.id, m.nama, 
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) -
        COALESCE( (SELECT sum(p.piutang) as tot_bayar FROM trn_transaksi as t JOIN trn_piutang as p ON p.idtransaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) as total_pendapatan, COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as total_pengeluaran, 
        COALESCE( COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) -
        COALESCE( (SELECT sum(p.piutang) as tot_bayar FROM trn_transaksi as t JOIN trn_piutang as p ON p.idtransaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) ,0) - 
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as keuntungan");
        $this->db->from('mst_umkm as m');   
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_umkm_penjualan;

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

            $kolom_order = $this->kolom_order_umkm_penjualan;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_umkm_penjualan)) {
            
            $order = $this->order_umkm_penjualan;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_umkm_penjualan($tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal == '') {
            $tgl_awal = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal = $tgl_awal;
        }

        if ($tgl_akhir == '') {
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_akhir = $tgl_akhir;
        } 

        $this->db->select("m.id, m.nama, 
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) -
        COALESCE( (SELECT sum(p.piutang) as tot_bayar FROM trn_transaksi as t JOIN trn_piutang as p ON p.idtransaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) as total_pendapatan, COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as total_pengeluaran, 
        COALESCE( COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) -
        COALESCE( (SELECT sum(p.piutang) as tot_bayar FROM trn_transaksi as t JOIN trn_piutang as p ON p.idtransaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) ,0) - 
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as keuntungan");
        $this->db->from('mst_umkm as m');   

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm_penjualan($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_umkm_penjualan($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 06-12-2020
    public function get_data_umkm_pengeluaran($awal, $akhir)
    {
        $this->_get_datatables_query_umkm_pengeluaran($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm_pengeluaran = [null, 'm.nama', 'total_pengeluaran'];
    var $kolom_cari_umkm_pengeluaran  = ['LOWER(m.nama)'];
    var $order_umkm_pengeluaran       = ['m.nama' => 'asc'];

    public function _get_datatables_query_umkm_pengeluaran($tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal == '') {
            $tgl_awal = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal = $tgl_awal;
        }

        if ($tgl_akhir == '') {
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_akhir = $tgl_akhir;
        } 

        $this->db->select("m.id, m.nama,
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as total_pengeluaran");
        $this->db->from('mst_umkm as m');   
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_umkm_pengeluaran;

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

            $kolom_order = $this->kolom_order_umkm_pengeluaran;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_umkm_pengeluaran)) {
            
            $order = $this->order_umkm_pengeluaran;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_umkm_pengeluaran($tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal == '') {
            $tgl_awal = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal = $tgl_awal;
        }

        if ($tgl_akhir == '') {
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_akhir = $tgl_akhir;
        } 

        $this->db->select("m.id, m.nama,
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as total_pengeluaran");
        $this->db->from('mst_umkm as m');   

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_umkm_pengeluaran($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 06-12-2020
    public function get_data_umkm_piutang($awal, $akhir)
    {
        $this->_get_datatables_query_umkm_piutang($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm_piutang = [null, 'm.nama', 'total_piutang'];
    var $kolom_cari_umkm_piutang  = ['LOWER(m.nama)'];
    var $order_umkm_piutang       = ['m.nama' => 'asc'];

    public function _get_datatables_query_umkm_piutang($tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal == '') {
            $tgl_awal = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal = $tgl_awal;
        }

        if ($tgl_akhir == '') {
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_akhir = $tgl_akhir;
        } 

        $this->db->select("m.id, m.nama, COALESCE( (SELECT sum(p.tot_piutang) as tot FROM mst_pelanggan as p WHERE p.idumkm = m.id) ,0) as total_piutang");
        $this->db->from('mst_umkm as m');   
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_umkm_piutang;

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

            $kolom_order = $this->kolom_order_umkm_piutang;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_umkm_piutang)) {
            
            $order = $this->order_umkm_piutang;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_umkm_piutang($tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal == '') {
            $tgl_awal = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal = $tgl_awal;
        }

        if ($tgl_akhir == '') {
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_akhir = $tgl_akhir;
        } 

        $this->db->select("m.id, m.nama, COALESCE( (SELECT sum(p.tot_piutang) as tot FROM mst_pelanggan as p WHERE p.idumkm = m.id) ,0) as total_piutang");
        $this->db->from('mst_umkm as m');     

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm_piutang($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_umkm_piutang($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 06-12-2020
    public function get_data_umkm_split($awal, $akhir, $id_umkm)
    {
        $this->_get_datatables_query_umkm_split($awal, $akhir, $id_umkm);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm_split = [null, 't.nama', 'qty'];
    var $kolom_cari_umkm_split  = ['LOWER(t.nama)'];
    var $order_umkm_split       = ['t.nama' => 'asc'];

    public function _get_datatables_query_umkm_split($tgl_awal, $tgl_akhir, $id_umkm)
    {
        // SELECT t.id, t.nama,
        // (SELECT sum(d.qty) as tot FROM trn_detail_pemasukan as d JOIN mst_produk as r ON r.id = d.id_produk WHERE r.h_split = 1 and r.id_umkm = 2 and d.id_produk = t.id and DATE_FORMAT(d.created_at, '%Y-%m-%d')  BETWEEN '2020-12-06' and '2020-12-06') as total_qty
        // FROM trn_detail_pemasukan as p 
        // JOIN mst_produk as t ON t.id = p.id_produk 
        // WHERE t.h_split = 1 and t.id_umkm = 2 and DATE_FORMAT(p.created_at, '%Y-%m-%d')  BETWEEN '2020-12-06' and '2020-12-06' GROUP BY t.id

        if ($id_umkm == 0) {
            $id_umkm2 = "";
        } else {
            $id_umkm2 = "and r.id_umkm = '$id_umkm'"; 
        }

        $this->db->select("t.id, t.nama, u.id as id_umkm, u.nama as umkm, (SELECT sum(d.qty) as tot FROM trn_detail_pemasukan as d JOIN mst_produk as r ON r.id = d.id_produk WHERE r.h_split = 1 $id_umkm2 and d.id_produk = t.id and DATE_FORMAT(d.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as qty");
        $this->db->from('trn_detail_pemasukan as p');
        $this->db->join('mst_produk as t', 't.id = p.id_produk', 'inner');
        $this->db->join('mst_umkm as u', 'u.id = t.id_umkm', 'inner');
        $this->db->where('t.h_split', 1);
        if ($id_umkm != 0) {
            $this->db->where('t.id_umkm', $id_umkm);
        }
        $this->db->where("DATE_FORMAT(p.created_at, '%Y-%m-%d')  BETWEEN '$tgl_awal' and '$tgl_akhir'");
        $this->db->group_by('t.id');

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_umkm_split;

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

            $kolom_order = $this->kolom_order_umkm_split;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_umkm_split)) {
            
            $order = $this->order_umkm_split;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_umkm_split($tgl_awal, $tgl_akhir, $id_umkm)
    {
        if ($id_umkm == 0) {
            $id_umkm2 = "";
        } else {
            $id_umkm2 = "and r.id_umkm = '$id_umkm'"; 
        }

        $this->db->select("t.id, t.nama, u.id as id_umkm, u.nama as umkm, (SELECT sum(d.qty) as tot FROM trn_detail_pemasukan as d JOIN mst_produk as r ON r.id = d.id_produk WHERE r.h_split = 1 $id_umkm2 and d.id_produk = t.id and DATE_FORMAT(d.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as qty");
        $this->db->from('trn_detail_pemasukan as p');
        $this->db->join('mst_produk as t', 't.id = p.id_produk', 'inner');
        $this->db->join('mst_umkm as u', 'u.id = t.id_umkm', 'inner');
        $this->db->where('t.h_split', 1);
        if ($id_umkm != 0) {
            $this->db->where('t.id_umkm', $id_umkm);
        }
        $this->db->where("DATE_FORMAT(p.created_at, '%Y-%m-%d')  BETWEEN '$tgl_awal' and '$tgl_akhir'");
        $this->db->group_by('t.id');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm_split($tgl_awal, $tgl_akhir, $id_umkm)
    {
        $this->_get_datatables_query_umkm_split($tgl_awal, $tgl_akhir, $id_umkm);

        return $this->db->get()->num_rows();
        
    }

    // 06-12-2020
    public function get_list_umkm($tgl_awal, $tgl_akhir, $id_umkm)
    {
        $this->db->select("u.id as id_umkm, u.nama as umkm");
        $this->db->from('trn_detail_pemasukan as p');
        $this->db->join('mst_produk as t', 't.id = p.id_produk', 'inner');
        $this->db->join('mst_umkm as u', 'u.id = t.id_umkm', 'inner');
        $this->db->where('t.h_split', 1);
        // if ($id_umkm != '') {
        //     $this->db->where('t.id_umkm', $id_umkm);
        // }
        $this->db->where("DATE_FORMAT(p.created_at, '%Y-%m-%d')  BETWEEN '$tgl_awal' and '$tgl_akhir'");
        $this->db->group_by('u.id');

        return $this->db->get();
        
    }

    // 07-12-2020
    public function cari_umkm()
    {
        
        $this->db->select("u.id as id_umkm, u.nama as umkm");
        $this->db->from('trn_detail_pemasukan as p');
        $this->db->join('mst_produk as t', 't.id = p.id_produk', 'inner');
        $this->db->join('mst_umkm as u', 'u.id = t.id_umkm', 'inner');
        $this->db->where('t.h_split', 1);

        return $this->db->get();
    }

    // 07-12-2020
    public function cari_data_split($id_produk)
    {
        $this->db->select('*');
        $this->db->from('mst_split');
        $this->db->where('id_produk', $id_produk);
        $this->db->order_by('id', 'asc');

        return $this->db->get();
    }

    // 07-12-2020
    public function get_split_cetak($tgl_awal, $tgl_akhir, $id_umkm)
    {
        if ($id_umkm == '') {
            $id_umkm2 = "";
        } else {
            $id_umkm2 = "and r.id_umkm = '$id_umkm'"; 
        }

        $this->db->select("t.id, t.nama, u.id as id_umkm, u.nama as umkm, (SELECT sum(d.qty) as tot FROM trn_detail_pemasukan as d JOIN mst_produk as r ON r.id = d.id_produk WHERE r.h_split = 1 $id_umkm2 and d.id_produk = t.id and DATE_FORMAT(d.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as qty");
        $this->db->from('trn_detail_pemasukan as p');
        $this->db->join('mst_produk as t', 't.id = p.id_produk', 'inner');
        $this->db->join('mst_umkm as u', 'u.id = t.id_umkm', 'inner');
        $this->db->where('t.h_split', 1);
        if ($id_umkm != "") {
            $this->db->where('t.id_umkm', $id_umkm);
        }
        $this->db->where("DATE_FORMAT(p.created_at, '%Y-%m-%d')  BETWEEN '$tgl_awal' and '$tgl_akhir'");
        $this->db->group_by('t.id');

        return $this->db->get();
    }

    // 11-12-2020
    public function get_data_umkm_laba_rugi($awal, $akhir)
    {
        $this->_get_datatables_query_umkm_laba_rugi($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm_laba_rugi = [null, 'm.nama', 'laba_kotor', 'laba_bersih'];
    var $kolom_cari_umkm_laba_rugi  = ['LOWER(m.nama)'];
    var $order_umkm_laba_rugi       = ['m.nama' => 'asc'];

    public function _get_datatables_query_umkm_laba_rugi($tgl_awal, $tgl_akhir)
    {
        $this->db->select("m.id, m.nama, 
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE( (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) as laba_kotor,
        COALESCE( COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE(
        (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) , 0) - 
        COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as laba_bersih");
        $this->db->from('mst_umkm as m');  
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('m.id', $this->input->post('id_umkm'));
        } 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_umkm_laba_rugi;

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

            $kolom_order = $this->kolom_order_umkm_laba_rugi;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_umkm_laba_rugi)) {
            
            $order = $this->order_umkm_laba_rugi;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_umkm_laba_rugi($tgl_awal, $tgl_akhir)
    {
        $this->db->select("m.id, m.nama, 
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE( (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) as laba_kotor,
        COALESCE( COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE(
        (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) , 0) - 
        COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as laba_bersih");
        $this->db->from('mst_umkm as m');  
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('m.id', $this->input->post('id_umkm'));
        } 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm_laba_rugi($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_umkm_laba_rugi($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 11-12-2020
    public function get_detail_laba_rugi($id_umkm, $tgl_awal, $tgl_akhir)
    {
        $this->db->select("m.id, m.nama, 
        COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as total_pendapatan,
        COALESCE(
        (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) as total_hpp,
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE( (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) as laba_kotor,
        COALESCE( COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE(
        (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) , 0) - 
        COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as laba_bersih,
        COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as total_pengeluaran,
        COALESCE( (SELECT sum(p.tot_piutang) as tot FROM mst_pelanggan as p WHERE p.idumkm = m.id) ,0) as piutang,
        COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Bayar Piutang' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as total_bayar_piutang,");
        $this->db->from('mst_umkm as m'); 
        $this->db->where('m.id', $id_umkm);
        
        return $this->db->get();
        
    } 

    // 11-12-2020
    public function get_laba_rugi_cetak($tgl_awal, $tgl_akhir, $id_umkm)
    {
        $this->db->select("m.id, m.nama, 
        COALESCE( (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE( (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) as laba_kotor,
        COALESCE( COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) - 
        COALESCE(
        (SELECT sum(p.hpp * d.qty) as total_hpp FROM trn_transaksi as t INNER JOIN trn_detail_pemasukan as d ON d.id_transaksi = t.id INNER JOIN mst_produk as p ON p.id = d.id_produk WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'), 0) , 0) - 
        COALESCE( 
        (SELECT sum(t.total_transaksi) as total_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as r ON r.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') ,0) as laba_bersih");
        $this->db->from('mst_umkm as m');  
        if ($id_umkm != 0) {
            $this->db->where('m.id', $id_umkm);
        } 

        return $this->db->get();
        
    }

      ######    #######   ##    #######
    ##     ##   ##        ##    ##
    #########   #####     ##    ####
    ##     ##   ##        ##    ##
    ##     ##   ##        ##    ##

    // 08-09-2020

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
        $this->nama     = $this->session->userdata('nama');
    }

    // 08-09-2020

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    // 08-09-2020

    public function get_data_piutang()
    {
        $this->_get_datatables_query_piutang();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_piutang = [null, 'g.nama', 'p.tanggal', 'p.bayar', 'p.sisa_piutang'];
    var $kolom_cari_piutang  = ['LOWER(g.nama)', 'p.tanggal', 'p.bayar', 'p.sisa_piutang'];
    var $order_piutang       = ['p.created_at' => 'desc'];

    public function _get_datatables_query_piutang()
    {
        // $date_rg    	= $this->input->post('date_range');
		// $id_pelanggan   = $this->input->post('id_pelanggan');

        // if (count($date_rg) == 1) {
        //     $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
        //     $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        // } else {
        //     $tgl_awal   = $date_rg[0]; 
        //     $tgl_akhir  = $date_rg[1]; 

        //     $tgl_awal  = $tgl_awal;
        //     $tgl_akhir = $tgl_akhir;
        // }

        // $this->db->select('t.id, t.code_trn, t.total_transaksi, t.tunai, t.created_at, p.nama as atas_nama');
        // $this->db->from('trn_transaksi as t');
        // $this->db->join('mst_pelanggan as p', 'p.id = t.id_pelanggan', 'inner');
        // $this->db->where('t.jenis', "Pemasukan");
        // $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);

        $this->db->select('tanggal as tgl_awal');
        $this->db->from('trn_bayar_piutang');
        $this->db->where('idumkm', $this->input->post('id_umkm'));
        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('idpelanggan', $this->input->post('id_pelanggan'));
        }
        $this->db->order_by('tanggal', 'asc');
        
        $dt = $this->db->get()->row_array();

        $tgl_awal   = $dt['tgl_awal'];
        $tgl_akhir  = $this->input->post('tanggal');
        

        $this->db->select('p.id, g.nama, p.tanggal, p.bayar, p.sisa_piutang, p.created_at');
        $this->db->from('trn_bayar_piutang as p');
        $this->db->join('mst_pelanggan as g', 'g.id = p.idpelanggan', 'inner');

        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('p.idumkm', $this->input->post('id_umkm'));
        }
        
        $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        // $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('g.id', $this->input->post('id_pelanggan'));
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_piutang;

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

            $kolom_order = $this->kolom_order_piutang;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_piutang)) {
            
            $order = $this->order_piutang;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_piutang()
    {
        // $date_rg    	= $this->input->post('date_range');
		// $id_pelanggan   = $this->input->post('id_pelanggan');

        // if (count($date_rg) == 1) {
        //     $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
        //     $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        // } else {
        //     $tgl_awal   = $date_rg[0]; 
        //     $tgl_akhir  = $date_rg[1]; 

        //     $tgl_awal  = $tgl_awal;
        //     $tgl_akhir = $tgl_akhir;
        // }

        // $this->db->select('t.id, t.code_trn, t.total_transaksi, t.tunai, t.created_at, p.nama as atas_nama');
        // $this->db->from('trn_transaksi as t');
        // $this->db->join('mst_pelanggan as p', 'p.id = t.id_pelanggan', 'inner');
        // $this->db->where('t.jenis', "Pemasukan");
        // $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);

        $this->db->select('tanggal as tgl_awal');
        $this->db->from('trn_bayar_piutang');
        $this->db->where('idumkm', $this->input->post('id_umkm'));
        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('idpelanggan', $this->input->post('id_pelanggan'));
        }
        $this->db->order_by('tanggal', 'asc');
        
        $dt = $this->db->get()->row_array();

        $tgl_awal   = $dt['tgl_awal'];
        $tgl_akhir  = $this->input->post('tanggal');
        

        $this->db->select('p.id, g.nama, p.tanggal, p.bayar, p.sisa_piutang, p.created_at');
        $this->db->from('trn_bayar_piutang as p');
        $this->db->join('mst_pelanggan as g', 'g.id = p.idpelanggan', 'inner');

        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('p.idumkm', $this->input->post('id_umkm'));
        }
        
        $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        // $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('g.id', $this->input->post('id_pelanggan'));
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_piutang()
    {
        $this->_get_datatables_query_piutang();

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_piutang()
    {
        $this->db->select('tanggal as tgl_awal');
        $this->db->from('trn_bayar_piutang');
        $this->db->where('idumkm', $this->input->post('id_umkm'));
        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('idpelanggan', $this->input->post('id_pelanggan'));
        }
        $this->db->order_by('tanggal', 'asc');
        
        $dt = $this->db->get()->row_array();

        $tgl_awal   = $dt['tgl_awal'];
        $tgl_akhir  = $this->input->post('tanggal');
        

        $this->db->select('p.id, g.nama, p.tanggal, p.bayar, p.sisa_piutang, p.created_at');
        $this->db->from('trn_bayar_piutang as p');
        $this->db->join('mst_pelanggan as g', 'g.id = p.idpelanggan', 'inner');

        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('p.idumkm', $this->input->post('id_umkm'));
        }
        
        $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        // $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('g.id', $this->input->post('id_pelanggan'));
        }

        return $this->db->get();
    }

    // 06-12-2020
    public function cari_piutang()
    {
        $this->db->select_sum('t.piutang');
        $this->db->from('mst_pelanggan as p');
        $this->db->join('trn_piutang as t', 't.idpelanggan = p.id', 'inner');
        $this->db->where('p.idumkm', $this->input->post('id_umkm'));

        return $this->db->get();
    }

    // 06-12-2020
    public function cari_pelanggan()
    {
        $this->db->select('tanggal as tgl_awal');
        $this->db->from('trn_bayar_piutang');
        $this->db->where('idumkm', $this->input->post('id_umkm'));
        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('idpelanggan', $this->input->post('id_pelanggan'));
        }
        $this->db->order_by('tanggal', 'asc');
        
        $dt = $this->db->get()->row_array();

        $tgl_awal   = $dt['tgl_awal'];
        $tgl_akhir  = $this->input->post('tanggal');
        

        $this->db->select('p.id, g.id, g.nama, p.tanggal, p.bayar, p.sisa_piutang, p.created_at');
        $this->db->from('trn_bayar_piutang as p');
        $this->db->join('mst_pelanggan as g', 'g.id = p.idpelanggan', 'inner');

        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('p.idumkm', $this->input->post('id_umkm'));
        }
        
        $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        // $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        if ($this->input->post('id_pelanggan') != '') {
            $this->db->where('g.id', $this->input->post('id_pelanggan'));
        }

        $this->db->group_by('g.id');

        return $this->db->get();
    }

    // 09-08-2020

    public function get_tot_pelanggan($tgl_awal, $tgl_akhir, $id_pelanggan, $id_umkm)
    {
        $this->db->select('g.id, g.nama');
        $this->db->from('trn_bayar_piutang as p');
        $this->db->join('mst_pelanggan as g', 'g.id = p.idpelanggan', 'inner');
        $this->db->where('p.idumkm', $this->input->post('id_umkm'));
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        if ($id_pelanggan != '') {
            $this->db->where('g.id', $id_pelanggan);
        }

        $this->db->group_by('g.nama');

        return $this->db->get();
    }

    // 09-08-2020
    
    public function get_tot_bayar($tgl_awal, $tgl_akhir, $id_pelanggan)
    {
        $this->db->select_sum('p.bayar');
        $this->db->from('trn_bayar_piutang as p');
        $this->db->join('mst_pelanggan as g', 'g.id = p.idpelanggan', 'inner');

        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('p.idumkm', $this->input->post('id_umkm'));
        }
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        // $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        if ($id_pelanggan != '') {
            $this->db->where('g.id', $id_pelanggan);
        }

        $a =  $this->db->get()->row_array();

        return ($a['bayar'] == null) ? 0 : $a['bayar'];
    }

    // 09-08-2020

    public function get_sisa_piutang($tgl_awal, $tgl_akhir, $id_pelanggan)
    {
        $this->db->select('p.sisa_piutang');
        $this->db->from('trn_bayar_piutang as p');
        
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('p.idumkm', $this->input->post('id_umkm'));
        }
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        if ($id_pelanggan != '') {
            $this->db->where('p.idpelanggan', $id_pelanggan);
        }

        $this->db->order_by('p.created_at', 'desc');

        return $this->db->get();
    }

    // 08-09-2020

    public function get_tot_piutang($id_pelanggan)
    {
        $this->db->select_sum('piutang');
        $this->db->from('trn_piutang');
        $this->db->where('idpelanggan', $id_pelanggan);
        
        return $this->db->get();
    }

    // 09-09-2020

    public function cari_tanggal_awal_piutang($id_umkm)
    {
        $this->db->select("tanggal");
        $this->db->from('trn_bayar_piutang');
        $this->db->where('idumkm', $id_umkm);
        $this->db->order_by('tanggal', 'asc');
        $this->db->limit(1);
        
        return $this->db->get();
    }

    public function get_detail_pelanggan($tgl_awal, $tgl_akhir, $id_pelanggan)
    {
        $this->db->select('p.id, g.nama, p.tanggal, p.bayar, p.sisa_piutang, p.created_at');
        $this->db->from('trn_bayar_piutang as p');
        $this->db->join('mst_pelanggan as g', 'g.id = p.idpelanggan', 'inner');

        if ($this->nama != 'Bagja') {
            $this->db->where('p.idumkm', $this->id_umkm);
        }
        
        $this->db->where("p.tanggal BETWEEN '$tgl_awal' and '$tgl_akhir'");

        $this->db->where('g.id', $id_pelanggan);

        return $this->db->get();

    }

    // 04-12-2020
    public function cari_pengeluaran($tgl_awal, $tgl_akhir) 
    {
        if ($tgl_awal == '') {
            $tgl_awal = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal = $tgl_awal;
        }

        if ($tgl_akhir == '') {
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_akhir = $tgl_akhir;
        } 

        $this->db->select('COALESCE(sum(t.total_transaksi), 0)  as total_tr_peng');
        $this->db->from('trn_transaksi as t');
        $this->db->join('trn_detail_pengeluaran as r', 'r.id_transaksi = t.id ', 'inner');
        
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('t.jenis', 'Pengeluaran');
        $this->db->where("DATE_FORMAT(r.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");

        return $this->db->get();
        
    }

    // penjualan

    // 09-09-2020

    public function get_data_penjualan($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_penjualan($tgl_awal, $tgl_akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_penjualan = ['t.code_trn', 'total', 'CAST(t.created_at as DATE)'];
    var $kolom_cari_penjualan  = ['LOWER(t.code_trn)', "CAST(t.created_at as DATE)"];
    var $order_penjualan       = ['t.id' => 'desc'];

    public function _get_datatables_query_penjualan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('t.id, t.code_trn, t.total_transaksi, t.created_at, t.total_transaksi - COALESCE( (SELECT p.piutang FROM trn_piutang as p WHERE p.idtransaksi = t.id) ,0) as total');
        $this->db->from('trn_transaksi as t');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('t.jenis', 'Pemasukan');
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_penjualan;

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

            $kolom_order = $this->kolom_order_penjualan;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_penjualan)) {
            
            $order = $this->order_penjualan;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_penjualan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('t.id, t.code_trn, t.total_transaksi, t.created_at, t.total_transaksi - COALESCE( (SELECT p.piutang FROM trn_piutang as p WHERE p.idtransaksi = t.id) ,0) as total');
        $this->db->from('trn_transaksi as t');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('t.jenis', 'Pemasukan');
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_penjualan($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_penjualan($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_detail_penjualan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('t.id, t.code_trn, t.total_transaksi, t.created_at, t.total_transaksi - COALESCE( (SELECT p.piutang FROM trn_piutang as p WHERE p.idtransaksi = t.id) ,0) as total');
        $this->db->from('trn_transaksi as t');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('t.jenis', 'Pemasukan');
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        return $this->db->get();
    }

    // 09-09-2020

    public function get_tot_transaksi($tgl_awal, $tgl_akhir)
    {
        $this->db->select('code_trn, id_pelanggan');
        $this->db->from('trn_transaksi');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('jenis', 'Pemasukan');

        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        $this->db->group_by('code_trn');

        return $this->db->get();
    }

    public function get_tot_pendapatan($tgl_awal, $tgl_akhir)
    {
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('jenis', 'Pemasukan');

        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        $a = $this->db->get()->row_array();

        return $a['total_transaksi'];
        
    }

    // 09-09-2020

    public function get_tot_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('jenis', 'Pengeluaran');

        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        $b = $this->db->get()->row_array();

        return $b['total_transaksi'];
    }

    // 09-09-2020

    public function get_tot_piutang_tr()
    {
        $this->db->select_sum('p.piutang');
        $this->db->from('trn_piutang as p');
        $this->db->join('trn_transaksi as t', 't.id = p.idtransaksi', 'inner');
        if ($this->nama != 'Bagja') {
            $this->db->where('t.id_umkm', $this->id_umkm);
        }
        
        return $this->db->get();
        
    }

    // 10-09-2020

    public function cari_tanggal_awal($jenis, $id_umkm)
    {
        $this->db->select("DATE_FORMAT(created_at, '%Y-%m-%d') as tanggal");
        $this->db->from('trn_transaksi');
        $this->db->where('jenis', $jenis);
        $this->db->where('id_umkm', $id_umkm);
        $this->db->order_by('created_at', 'asc');
        $this->db->limit(1);
        
        return $this->db->get();
    }

    // 10-09-2020

    public function get_transaksi_cetak($tgl_awal, $tgl_akhir, $jenis, $id_umkm)
    {
        $this->db->select('id, code_trn, total_transaksi, total_discount, created_at, id_pelanggan, tunai');
        $this->db->from('trn_transaksi');
        $this->db->where('id_umkm', $id_umkm);
        $this->db->where('jenis', $jenis);
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        return $this->db->get();
        
    }

    // 10-09-2020

    public function cari_kategori($id_produk)
    {
        $this->db->select('k.kategori');
        $this->db->from('mst_produk as p');
        $this->db->join('mst_kategori as k', 'k.id = p.id_kategori', 'inner');
        $this->db->where('p.id', $id_produk);
        
        return $this->db->get();
    }

    // pengeluaran

    // 09-10-2020

    public function get_data_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_pengeluaran($tgl_awal, $tgl_akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_pengeluaran = [null, 'code_trn', 'total_transaksi', 'created_at'];
    var $kolom_cari_pengeluaran  = ['LOWER(code_trn)', 'total_transaksi', 'created_at'];
    var $order_pengeluaran       = ['id' => 'desc'];

    public function _get_datatables_query_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->db->select('id, code_trn, total_transaksi, created_at');
        $this->db->from('trn_transaksi');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('jenis', 'Pengeluaran');
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_pengeluaran;

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

            $kolom_order = $this->kolom_order_pengeluaran;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_pengeluaran)) {
            
            $order = $this->order_pengeluaran;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->db->select('id, code_trn, total_transaksi, created_at');
        $this->db->from('trn_transaksi');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('jenis', 'Pengeluaran');
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_pengeluaran($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->db->select('id, code_trn, total_transaksi, created_at');
        $this->db->from('trn_transaksi');
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('id_umkm', $this->input->post('id_umkm'));
        }
        $this->db->where('jenis', 'Pengeluaran');
        
        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        return $this->db->get();
    }

    // 10-09-20

    public function get_tot_transaksi_pgl($tgl_awal, $tgl_akhir)
    {
        $this->db->select('code_trn, id_pelanggan');
        $this->db->from('trn_transaksi');
        if ($this->nama != 'Bagja') {
            $this->db->where('id_umkm', $this->id_umkm);
        }
        $this->db->where('jenis', 'Pengeluaran');

        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        $this->db->group_by('code_trn');

        return $this->db->get();
    }

    // 10-09-2020

    public function get_total_belanja($tgl_awal, $tgl_akhir)
    {
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        if ($this->nama != 'Bagja') {
            $this->db->where('id_umkm', $this->id_umkm);
        }
        $this->db->where('jenis', 'Pengeluaran');

        if ($tgl_awal != "" && $tgl_akhir != "") {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        }

        $a = $this->db->get()->row_array();

        return $a['total_transaksi'];
    }

      ######    #######   ##    #######
    ##     ##   ##        ##    ##
    #########   #####     ##    ####
    ##     ##   ##        ##    ##
    ##     ##   ##        ##    ##

	var $table = 'trn_transaksi';

	public function get_transaksi_penjualan()
	{
        $this->db->select('trn_transaksi.*, trn_piutang.bayar')
		->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
		->where('jenis', 'Pemasukan')
    	->where('id_umkm', $this->session->userdata('id_umkm'));
    	$query = $this->db->get();
    	return $query;
	}

    public function get_transaksi_pengeluaran()
    {
        $this->db->from($this->table)
        ->where('jenis', 'Pengeluaran')
        ->where('id_umkm', $this->session->userdata('id_umkm'));
        $query = $this->db->get();
        return $query;
    }

	public function get_total_penjualan()
	{
		$this->db->select('sum(trn_piutang.bayar) as total')
		->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
		->where('trn_transaksi.id_umkm', $this->session->userdata('id_umkm'));
    	$query 	= $this->db->get();
    	$row 	= $query->row();
    	return $row->total;
	}

    public function get_total_pengeluaran()
    {
        $this->db->select('sum(total_transaksi) as total')
        ->from($this->table)
        ->where('jenis', 'Pengeluaran')
        ->where('id_umkm', $this->session->userdata('id_umkm'));
        $query  = $this->db->get();
        $row    = $query->row();
        return $row->total;
    }

    public function get_data_laporan_penjualan_per_tanggal($tanggal)
    {
        $this->db->select('trn_transaksi.*, trn_piutang.bayar')
        ->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
        ->where('jenis', 'Pemasukan')
        ->where("DATE_FORMAT(trn_transaksi.created_at, '%d-%m-%Y') = '".$tanggal."'")
        ->where('id_umkm', $this->session->userdata('id_umkm'));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data_laporan_per_jenis($jenis)
    {
        $this->db->from($this->table)
        ->where('jenis', $jenis)
        ->where('id_umkm', $this->session->userdata('id_umkm'));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data_laporan_per_tanggal($jenis, $tanggal)
    {
        $this->db->from($this->table)
        ->where('jenis', $jenis)
        ->where('id_umkm', $this->session->userdata('id_umkm'))
        ->where("DATE_FORMAT(created_at, '%d-%m-%Y') = '".$tanggal."'");
        $query = $this->db->get();
        return $query->result();
    }

	function get_detail_transaksi_penjualan($id)
	{
		$this->db->select('trn_transaksi.*, mst_produk.nama as nama_produk, mst_produk.harga, mst_produk.discount, mst_kategori.kategori, trn_detail_pemasukan.qty, trn_detail_pemasukan.sub_total, trn_detail_pemasukan.sub_discount, mst_pelanggan.nama as nama_pelanggan, trn_piutang.bayar, trn_piutang.piutang')
		->from($this->table)
		->join('trn_detail_pemasukan', 'trn_detail_pemasukan.id_transaksi = trn_transaksi.id')
		->join('mst_produk', 'mst_produk.id = trn_detail_pemasukan.id_produk')
		->join('mst_kategori', 'mst_kategori.id = mst_produk.id_kategori')
		->join('mst_pelanggan', 'mst_pelanggan.id = trn_transaksi.id_pelanggan')
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
		->where('trn_transaksi.id', $id);
		$query = $this->db->get();
		return $query->result();
	}

    function get_detail_transaksi_pengeluaran($id)
    {
        $this->db->select('trn_detail_pengeluaran.*, trn_transaksi.total_transaksi')
        ->from($this->table)
        ->join('trn_detail_pengeluaran', 'trn_detail_pengeluaran.id_transaksi = trn_transaksi.id')
        ->where('trn_transaksi.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

	public function read_penjualan()
    {
        $this->db->select('trn_transaksi.*, trn_piutang.bayar')
        ->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
    	->where('jenis', 'Pemasukan')
    	->where('id_umkm', $this->session->userdata('id_umkm'));
    	if($this->input->post('periode'))
    	{
            $periode = $this->input->post('periode');
    		$this->db->where("DATE_FORMAT(trn_transaksi.created_at, '%d-%m-%Y') = '".$periode."'");
    	}
    	$this->db->order_by('trn_transaksi.created_at', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }

    public function read_pengeluaran()
    {
        $this->db->from($this->table)
        ->where('jenis', 'Pengeluaran')
        ->where('id_umkm', $this->session->userdata('id_umkm'));
        if($this->input->post('periode'))
        {
            $periode = $this->input->post('periode');
            $this->db->where("DATE_FORMAT(created_at, '%d-%m-%Y') = '".$periode."'");
        }
        $this->db->order_by('created_at', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function read_piutang()
    {
        $this->db->select('mst_pelanggan.nama as nama_pelanggan, mst_pelanggan.tot_piutang, trn_bayar_piutang.bayar, trn_piutang.bayar as tunai, trn_transaksi.id, trn_transaksi.created_at')
        ->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
        ->join('mst_pelanggan', 'mst_pelanggan.id = trn_transaksi.id_pelanggan')
        ->join('trn_bayar_piutang', 'trn_bayar_piutang.idpelanggan = mst_pelanggan.id');
        if($this->input->post('periode'))
        {
            $periode = $this->input->post('periode');
            $this->db->where("DATE_FORMAT(trn_transaksi.created_at, '%d-%m-%Y') = '".$periode."'");
        }
        if($this->input->post('pelanggan'))
        {
            $pelanggan = $this->input->post('pelanggan');
            $this->db->where('mst_pelanggan.id', $pelanggan);
        }
        $this->db->group_by('mst_pelanggan.nama');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_penjualan()
    {
        $this->db->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
        ->where('jenis', 'Pemasukan')
    	->where('id_umkm', $this->session->userdata('id_umkm'));
    	if($this->input->post('periode'))
    	{
            $periode = $this->input->post('periode');
    		$this->db->where("DATE_FORMAT(trn_transaksi.created_at, '%d-%m-%Y') = '".$periode."'");
    	}
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_filtered_pengeluaran()
    {
        $this->db->from($this->table)
        ->where('jenis', 'Pengeluaran')
        ->where('id_umkm', $this->session->userdata('id_umkm'));
        if($this->input->post('periode'))
        {
            $periode = $this->input->post('periode');
            $this->db->where("DATE_FORMAT(created_at, '%d-%m-%Y') = '".$periode."'");
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_filtered_piutang()
    {
        $this->db->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
        ->join('mst_pelanggan', 'mst_pelanggan.id = trn_transaksi.id_pelanggan')
        ->join('trn_bayar_piutang', 'trn_bayar_piutang.idpelanggan = mst_pelanggan.id');
        if($this->input->post('periode'))
        {
            $periode = $this->input->post('periode');
            $this->db->where("DATE_FORMAT(trn_transaksi.created_at, '%d-%m-%Y') = '".$periode."'");
        }
        if($this->input->post('pelanggan') != null)
        {
            $pelanggan = $this->input->post('pelanggan');
            $this->db->where('mst_pelanggan.id', $pelanggan);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_penjualan()
    {
        $this->db->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
        ->where('jenis', 'Pemasukan')
    	->where('id_umkm', $this->session->userdata('id_umkm'));
    	if($this->input->post('periode'))
    	{
            $periode = $this->input->post('periode');
    		$this->db->where("DATE_FORMAT(trn_transaksi.created_at, '%d-%m-%Y') = '".$periode."'");
    	}
        return $this->db->count_all_results();
    }

    public function count_all_pengeluaran()
    {
        $this->db->from($this->table)
        ->where('jenis', 'Pengeluaran')
        ->where('id_umkm', $this->session->userdata('id_umkm'));
        if($this->input->post('periode'))
        {
            $periode = $this->input->post('periode');
            $this->db->where("DATE_FORMAT(created_at, '%d-%m-%Y') = '".$periode."'");
        }
        return $this->db->count_all_results();
    }

    public function count_all_piutang()
    {
        $this->db->from($this->table)
        ->join('trn_piutang', 'trn_piutang.idtransaksi = trn_transaksi.id')
        ->join('mst_pelanggan', 'mst_pelanggan.id = trn_transaksi.id_pelanggan')
        ->join('trn_bayar_piutang', 'trn_bayar_piutang.idpelanggan = mst_pelanggan.id');
        if($this->input->post('periode'))
        {
            $periode = $this->input->post('periode');
            $this->db->where("DATE_FORMAT(trn_transaksi.created_at, '%d-%m-%Y') = '".$periode."'");
        }
        if($this->input->post('pelanggan') != null)
        {
            $pelanggan = $this->input->post('pelanggan');
            $this->db->where('mst_pelanggan.id', $pelanggan);
        }
        $query = $this->db->get();
        return $this->db->count_all_results();
    }

}

/* End of file M_laporan.php */
/* Location: ./application/models/M_laporan.php */