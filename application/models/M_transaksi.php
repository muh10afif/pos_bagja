<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    // 27-08-2020
    
    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
    }

    // 30-11-2020
    public function get_data_umkm($awal, $akhir)
    {
        $this->_get_datatables_query_umkm($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm = [null, 'm.nama', 'jumlah_transaksi', 'total_transaksi'];
    var $kolom_cari_umkm  = ['LOWER(m.nama)'];
    var $order_umkm       = ['m.nama' => 'asc'];

    public function _get_datatables_query_umkm($tgl_awal, $tgl_akhir)
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

        $this->db->select("m.id as id_umkm, m.nama as nama_umkm, (SELECT count(t.id) as jml_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as jumlah_transaksi, (SELECT sum(r.total_transaksi) as tot_tr FROM trn_transaksi as r WHERE r.id_umkm = m.id and r.jenis = 'Pemasukan' and DATE_FORMAT(r.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as total_transaksi");
        $this->db->from('mst_umkm as m');   
        
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

    public function jumlah_semua_umkm($tgl_awal, $tgl_akhir)
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

        $this->db->select("m.id as id_umkm, m.nama as nama_umkm, (SELECT count(t.id) as jml_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as jumlah_transaksi, (SELECT sum(r.total_transaksi) as tot_tr FROM trn_transaksi as r WHERE r.id_umkm = m.id and r.jenis = 'Pemasukan' and DATE_FORMAT(r.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as total_transaksi");
        $this->db->from('mst_umkm as m');    

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_umkm($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_penjualan($tgl_awal, $tgl_akhir)
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

        $this->db->select("m.id as id_umkm, m.nama as nama_umkm, (SELECT count(t.id) as jml_tr FROM trn_transaksi as t WHERE t.id_umkm = m.id and t.jenis = 'Pemasukan' and DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as jumlah_transaksi, (SELECT sum(r.total_transaksi) as tot_tr FROM trn_transaksi as r WHERE r.id_umkm = m.id and r.jenis = 'Pemasukan' and DATE_FORMAT(r.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as total_transaksi");
        $this->db->from('mst_umkm as m');    

        return $this->db->get();
    }

    // 30-11-2020
    public function get_data_umkm_p($awal, $akhir)
    {
        $this->_get_datatables_query_umkm_p($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm_p = [null, 'm.nama', 'jumlah_transaksi', 'total_transaksi'];
    var $kolom_cari_umkm_p  = ['LOWER(m.nama)'];
    var $order_umkm_p       = ['m.nama' => 'asc'];

    public function _get_datatables_query_umkm_p($tgl_awal, $tgl_akhir)
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

        $this->db->select("m.id as id_umkm, m.nama as nama_umkm, (SELECT count(t.id) as jml_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as tp ON tp.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(tp.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as jumlah_transaksi, (SELECT sum(r.total_transaksi) as tot_tr FROM trn_transaksi as r JOIN trn_detail_pengeluaran as tp2 ON tp2.id_transaksi = r.id WHERE r.id_umkm = m.id and r.jenis = 'Pengeluaran' and DATE_FORMAT(tp2.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as total_transaksi");
        $this->db->from('mst_umkm as m');   
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_umkm_p;

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

            $kolom_order = $this->kolom_order_umkm_p;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_umkm_p)) {
            
            $order = $this->order_umkm_p;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_umkm_p($tgl_awal, $tgl_akhir)
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

        $this->db->select("m.id as id_umkm, m.nama as nama_umkm, (SELECT count(t.id) as jml_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as tp ON tp.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(tp.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as jumlah_transaksi, (SELECT sum(r.total_transaksi) as tot_tr FROM trn_transaksi as r JOIN trn_detail_pengeluaran as tp2 ON tp2.id_transaksi = r.id WHERE r.id_umkm = m.id and r.jenis = 'Pengeluaran' and DATE_FORMAT(tp2.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as total_transaksi");
        $this->db->from('mst_umkm as m');    

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm_p($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_umkm_p($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_pengeluaran($tgl_awal, $tgl_akhir)
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

        $this->db->select("m.id as id_umkm, m.nama as nama_umkm, (SELECT count(t.id) as jml_tr FROM trn_transaksi as t JOIN trn_detail_pengeluaran as tp ON tp.id_transaksi = t.id WHERE t.id_umkm = m.id and t.jenis = 'Pengeluaran' and DATE_FORMAT(tp.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as jumlah_transaksi, (SELECT sum(r.total_transaksi) as tot_tr FROM trn_transaksi as r JOIN trn_detail_pengeluaran as tp2 ON tp2.id_transaksi = r.id WHERE r.id_umkm = m.id and r.jenis = 'Pengeluaran' and DATE_FORMAT(tp2.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir') as total_transaksi");
        $this->db->from('mst_umkm as m');    

        return $this->db->get();
    }

    public function list_produk($id_umkm)
    {
        $this->db->select('t.id, t.nama, t.harga, t.image, k.kategori, t.discount, t.h_ukuran, t.h_topping');
        $this->db->from('mst_produk as t');
        $this->db->join('mst_kategori as k', 'k.id = t.id_kategori', 'inner');
        $this->db->where('t.id_umkm', $id_umkm);
        $this->db->order_by('t.nama', 'asc');
        
        return $this->db->get();
    }  

    // 14-12-2020
    public function list_produk_kategori($id_umkm, $id_kategori)
    {
        $this->db->select('t.id, t.nama, t.harga, t.image, k.kategori, t.discount, t.h_ukuran, t.h_topping');
        $this->db->from('mst_produk as t');
        $this->db->join('mst_kategori as k', 'k.id = t.id_kategori', 'inner');
        $this->db->where('t.id_umkm', $id_umkm);
        $this->db->where('k.id', $id_kategori);
        $this->db->order_by('t.nama', 'asc');
        
        return $this->db->get();
    }

    // 14-12-2020
    public function list_kategori($id_umkm)
    {
        $this->db->select('k.*');
        $this->db->from('mst_kategori as k');
        $this->db->join('mst_produk as p', 'p.id_kategori = k.id', 'inner');
        $this->db->where('k.idumkm', $id_umkm);
        $this->db->order_by('k.kategori', 'asc');
        $this->db->group_by('k.id');
        
        return $this->db->get();
    }
    
    // 27-08-2020
    public function list_pro($id_produk)
    {
        $this->db->select('t.id, t.nama, t.harga, t.image, k.kategori, t.image, t.discount, t.h_ukuran, t.h_topping');
        $this->db->from('mst_produk as t');
        $this->db->join('mst_kategori as k', 'k.id = t.id_kategori', 'inner');
        $this->db->where('t.id', $id_produk);
        $this->db->order_by('t.nama', 'asc');
        
        return $this->db->get();
    }

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    // 30-08-2020
    public function input_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    // 31-08-2020
    public function ubah_data($tabel, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($tabel, $data);
    }

    // 04-09-2020
    public function hapus_data($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }

    // 03-09-2020

    // Menampilkan list penjualan

    public function get_data_penjualan($awal, $akhir)
    {
        $this->_get_datatables_query_penjualan($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_penjualan = [null, 't.created_at', 't.code_trn', 'p.nama', 't.total_transaksi', 't.tunai'];
    var $kolom_cari_penjualan  = ['t.created_at', 'LOWER(t.code_trn)', 'LOWER(p.nama)', 't.total_transaksi', 't.tunai'];
    var $order_penjualan       = ['t.created_at' => 'desc'];

    public function _get_datatables_query_penjualan($tgl_awal, $tgl_akhir)
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

        $this->db->select('t.id, t.code_trn, t.total_transaksi, t.tunai, t.created_at, p.nama as atas_nama');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 'p.id = t.id_pelanggan', 'left');
        $this->db->where('t.jenis', "Pemasukan");
        $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
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

        $this->db->select('t.id, t.code_trn, t.total_transaksi, t.tunai, t.created_at, p.nama as atas_nama');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 'p.id = t.id_pelanggan', 'left');
        $this->db->where('t.jenis', "Pemasukan");
        $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
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

        $this->db->select('t.id, t.code_trn, t.total_transaksi, t.tunai, t.created_at, p.nama as atas_nama');
        $this->db->from('trn_transaksi as t');
        $this->db->join('mst_pelanggan as p', 'p.id = t.id_pelanggan', 'left');
        $this->db->where('t.jenis', "Pemasukan");
        $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
        }

        return $this->db->get();
    }

    // 03-09-2020
    public function get_total($tgl_awal, $tgl_akhir, $aksi)
    {
        $this->db->select('sum(t.total_transaksi) as total');
        $this->db->from('trn_transaksi as t');
        if ($aksi == 'Pemasukan') {
            $this->db->join('mst_pelanggan as p', 'p.id = t.id_pelanggan', 'left');
        }
        $this->db->where('t.jenis', $aksi);
        $this->db->where("DATE_FORMAT(t.created_at, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        $this->db->where('t.id_umkm', $this->id_umkm);

        return $this->db->get();
    }

    // 04-09-2020

    // Menampilkan list pengeluaran

    public function get_data_pengeluaran($awal, $akhir)
    {
        $this->_get_datatables_query_pengeluaran($awal, $akhir);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_pengeluaran = [null, 't.created_at', 't.code_trn', 't.total_transaksi'];
    var $kolom_cari_pengeluaran  = ['t.created_at', 'LOWER(t.code_trn)', 't.total_transaksi'];
    var $order_pengeluaran       = ['t.created_at' => 'desc'];

    public function _get_datatables_query_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->db->select('t.id as id_tr, t.code_trn, t.total_transaksi, p.tanggal, p.*');
        $this->db->from('trn_transaksi as t');
        $this->db->join('trn_detail_pengeluaran as p', 'p.id_transaksi = t.id', 'inner');
        $this->db->where('t.jenis', "Pengeluaran");
        $this->db->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
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
        $this->db->select('t.id as id_tr, t.code_trn, t.total_transaksi, p.tanggal, p.*');
        $this->db->from('trn_transaksi as t');
        $this->db->join('trn_detail_pengeluaran as p', 'p.id_transaksi = t.id', 'inner');
        $this->db->where('t.jenis', "Pengeluaran");
        $this->db->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_query_pengeluaran($tgl_awal, $tgl_akhir);

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_detail_pengeluaran($tgl_awal, $tgl_akhir)
    {
        $this->db->select('t.id, t.code_trn, t.total_transaksi, p.tanggal, p.*');
        $this->db->from('trn_transaksi as t');
        $this->db->join('trn_detail_pengeluaran as p', 'p.id_transaksi = t.id', 'inner');
        $this->db->where('t.jenis', "Pengeluaran");
        $this->db->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') BETWEEN '$tgl_awal' and '$tgl_akhir'");
        // $this->db->where('t.id_umkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('t.id_umkm', $this->input->post('id_umkm'));
        }

        return $this->db->get();
    }

    // 04-09-2020
    public function cari_sum_total_bayar($id_tr)
    {
        $this->db->select_sum('sub_total');
        $this->db->from('trn_detail_pengeluaran');
        $this->db->where('id_transaksi', $id_tr);
        
        return $this->db->get();
        
    }
}

/* End of file M_transaksi.php */
