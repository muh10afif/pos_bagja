<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

    // 03-12-2020
    public function get_data_umkm()
    {
        $this->_get_datatables_query_umkm();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm = [null, 'nama', 'jumlah_pelanggan'];
    var $kolom_cari_umkm  = ['LOWER(nama)'];
    var $order_umkm       = ['nama' => 'asc'];

    public function _get_datatables_query_umkm()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_pelanggan FROM mst_pelanggan as k WHERE k.idumkm = m.id) as jumlah_pelanggan');
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
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_pelanggan FROM mst_pelanggan as k WHERE k.idumkm = m.id) as jumlah_pelanggan');
        $this->db->from('mst_umkm as m'); 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm()
    {
        $this->_get_datatables_query_umkm();

        return $this->db->get()->num_rows();
        
    }

    // 14-12-2020
    public function count_pelanggan()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_pelanggan FROM mst_pelanggan as k WHERE k.idumkm = m.id) as jumlah_pelanggan');
        $this->db->from('mst_umkm as m'); 

        return $this->db->get();
    }

    // 25-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
    }

    var $table = 'mst_pelanggan';

    public function get($id = null)
    {
        $this->db->from($this->table)
        ->where('idumkm', $this->session->userdata('id_umkm'));
        if($id)
        {
            $this->db->where('id', $id);
        }
        $this->db->order_by('nama', 'asc');
        $query = $this->db->get();
        return $query;
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

    // Menampilkan list pelanggan
    public function get_data_pelanggan()
    {
        $this->_get_datatables_query_pelanggan();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_pelanggan = [null, 'nama', 'telp'];
    var $kolom_cari_pelanggan  = ['LOWER(nama)', 'telp'];
    var $order_pelanggan       = ['id' => 'desc'];

    public function _get_datatables_query_pelanggan()
    {
        $this->db->select('id, nama, telp');
        $this->db->from('mst_pelanggan'); 
        // $this->db->where('idumkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('idumkm', $this->input->post('id_umkm'));
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_pelanggan;

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

            $kolom_order = $this->kolom_order_pelanggan;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_pelanggan)) {
            
            $order = $this->order_pelanggan;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_pelanggan()
    {
        $this->db->select('id, nama, telp');
        $this->db->from('mst_pelanggan'); 
        // $this->db->where('idumkm', $this->id_umkm);
        if ($this->input->post('id_umkm') != 0) {
            $this->db->where('idumkm', $this->input->post('id_umkm'));
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_pelanggan()
    {
        $this->_get_datatables_query_pelanggan();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_pelanggan.php */
