<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm  = $this->session->userdata('id_umkm');
        $this->nama     = $this->session->userdata('nama');
    }

	var $table = 'mst_kategori';

	public function get($id = null)
	{
		$this->db->from($this->table)
		->where('idumkm', $this->session->userdata('id_umkm'));
		if($id)
		{
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

    public function read()
    {
    	$this->db->from($this->table)
    	->where('idumkm', $this->session->userdata('id_umkm'))
    	->order_by('created_at', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }

    public function read2($id)
    {
    	$this->db->from($this->table)
    	->where('idumkm', $id)
    	->order_by('kategori', 'asc');
    	$query = $this->db->get();
    	return $query->result_array();
    }

    public function count_filtered()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    // 12-11-2020
    public function get_kategori()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_kategori FROM mst_kategori as k WHERE k.idumkm = m.id) as jumlah_kategori');
        $this->db->from('mst_umkm as m'); 
        if ($this->nama != 'Bagja') {
            $this->db->where('id', $this->id_umkm);
        }
        return $this->db->get();
    }

    // 12-11-2020
    public function get_data_umkm()
    {
        $this->_get_datatables_query_umkm();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm = [null, 'nama', 'jumlah_kategori'];
    var $kolom_cari_umkm  = ['LOWER(nama)'];
    var $order_umkm       = ['nama' => 'asc'];

    public function _get_datatables_query_umkm()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_kategori FROM mst_kategori as k WHERE k.idumkm = m.id) as jumlah_kategori');
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
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_kategori FROM mst_kategori as k WHERE k.idumkm = m.id) as jumlah_kategori');
        $this->db->from('mst_umkm as m'); 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm()
    {
        $this->_get_datatables_query_umkm();

        return $this->db->get()->num_rows();
        
    }

    // 18-11-2020
    public function tampil_produk($id_kat)
    {
        $this->db->from('mst_produk');
        $this->db->where('id_kategori', $id_kat);
        $this->db->order_by('nama', 'asc');
        
        return $this->db->get();
    }

}

/* End of file M_user.php */
