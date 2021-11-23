<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_piutang extends CI_Model {

    // 05-09-2020

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
    }

    // 03-12-2020
    public function get_data_umkm()
    {
        $this->_get_datatables_query_umkm();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm = [null, 'nama', 'tot_piutang'];
    var $kolom_cari_umkm  = ['LOWER(nama)'];
    var $order_umkm       = ['nama' => 'asc'];

    public function _get_datatables_query_umkm()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT sum(k.tot_piutang) as tot_piutang FROM mst_pelanggan as k WHERE k.idumkm = m.id) as tot_piutang');
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

    public function jumlah_semua_umkm()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT sum(k.tot_piutang) as tot_piutang FROM mst_pelanggan as k WHERE k.idumkm = m.id) as tot_piutang');
        $this->db->from('mst_umkm as m'); 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm()
    {
        $this->_get_datatables_query_umkm();

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_piutang()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT sum(k.tot_piutang) as tot_piutang FROM mst_pelanggan as k WHERE k.idumkm = m.id) as tot_piutang');
        $this->db->from('mst_umkm as m'); 

        return $this->db->get();
    }

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    public function get_data_order($tabel, $field, $order)
    {
        $this->db->order_by($field, $order);
        
        return $this->db->get($tabel);
    }

    public function input_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function ubah_data($tabel, $data, $where)
    {
        return $this->db->update($tabel, $data, $where);
    }

    public function hapus_data($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }

    // 05-09-2020

    // Menampilkan list piutang
    public function get_data_piutang()
    {
        $this->_get_datatables_query_piutang();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_piutang = [null, 'nama', 'tot_piutang'];
    var $kolom_cari_piutang  = ['LOWER(nama)', 'tot_piutang'];
    var $order_piutang       = ['id' => 'desc'];

    public function _get_datatables_query_piutang()
    {
        $this->db->select('id, nama, tot_piutang');
        $this->db->from('mst_pelanggan'); 
        // $this->db->where('idumkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('idumkm', $this->input->post('id_umkm'));
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
        $this->db->select('id, nama, tot_piutang');
        $this->db->from('mst_pelanggan'); 
        // $this->db->where('idumkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('idumkm', $this->input->post('id_umkm'));
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_piutang()
    {
        $this->_get_datatables_query_piutang();

        return $this->db->get()->num_rows();
        
    }

    // 07-09-2020

    // Menampilkan list piutang
    public function get_data_detail_piutang($id_pelanggan)
    {
        $this->_get_datatables_query_detail_piutang($id_pelanggan);

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_detail_piutang = [null, 'tanggal', 'bayar', 'sisa_piutang'];
    var $kolom_cari_detail_piutang  = ['tanggal', 'bayar', 'sisa_piutang'];
    var $order_detail_piutang       = ['id' => 'desc'];

    public function _get_datatables_query_detail_piutang($id_pelanggan)
    {
        $this->db->select('id, tanggal, bayar, sisa_piutang');
        $this->db->from('trn_bayar_piutang'); 
        $this->db->where('idpelanggan', $id_pelanggan);
        $this->db->order_by('created_at', 'desc');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_detail_piutang;

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

            $kolom_order = $this->kolom_order_detail_piutang;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_detail_piutang)) {
            
            $order = $this->order_detail_piutang;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_detail_piutang($id_pelanggan)
    {
        $this->db->select('id, tanggal, bayar, sisa_piutang');
        $this->db->from('trn_bayar_piutang'); 
        $this->db->where('idpelanggan', $id_pelanggan);
        $this->db->order_by('created_at', 'desc');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_detail_piutang($id_pelanggan)
    {
        $this->_get_datatables_query_detail_piutang($id_pelanggan);

        return $this->db->get()->num_rows();
        
    }

    // 05-09-2020
    
    public function cari_pelanggan()
    {
        $this->db->select('id, nama, tot_piutang');
        $this->db->from('mst_pelanggan');
        // $this->db->where('idumkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('idumkm', $this->input->post('id_umkm'));
        }
        $this->db->where('tot_piutang !=', 0);
        
        return $this->db->get();
    }

}

/* End of file M_piutang.php */
