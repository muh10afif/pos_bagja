<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
    }
    
    // 10-12-2020
    public function cari_stok($id_produk)
    {
        $this->db->select('e.expire_date, t.satuan, s.stok');
        $this->db->from('mst_stok as s');
        $this->db->join('mst_expire_date as e', 'e.id_stok = s.id', 'left');
        $this->db->join('mst_satuan as t', 't.id = s.id_satuan', 'left');
        $this->db->where('s.id_produk', $id_produk);
        
        return $this->db->get();
    }

	var $table = 'mst_produk';

	public function get($id = null)
	{
		$this->db->from($this->table)
		->where('id_umkm', $this->session->userdata('id_umkm'));
		if($id)
		{
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

    public function get_tanpa_kategori()
    {
        $this->db->from($this->table)
        ->where('id_umkm', $this->session->userdata('id_umkm'))
        ->where('id_kategori', null);
        $query = $this->db->get();
        return $query;
    }

    // 13-11-2020
    public function get_tanpa_kategori2($id)
    {
        $this->db->from($this->table)
        ->where('id_umkm', $id)
        ->where('id_kategori', 0);
        $query = $this->db->get();
        return $query;
    }

    // 18-11-2020
    public function get_data_umkm_2()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_produk FROM mst_produk as k WHERE k.id_umkm = m.id) as jumlah_produk');
        $this->db->from('mst_umkm as m'); 

        return $this->db->get();
    }

    // 18-11-2020
    public function get_data_umkm()
    {
        $this->_get_datatables_query_umkm();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_umkm = [null, 'nama', 'jumlah_produk'];
    var $kolom_cari_umkm  = ['LOWER(nama)'];
    var $order_umkm       = ['nama' => 'asc'];

    public function _get_datatables_query_umkm()
    {
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_produk FROM mst_produk as k WHERE k.id_umkm = m.id) as jumlah_produk');
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
        $this->db->select('m.id, m.nama as nama_umkm, (SELECT COUNT(k.id) as jml_produk FROM mst_produk as k WHERE k.id_umkm = m.id) as jumlah_produk');
        $this->db->from('mst_umkm as m'); 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_umkm()
    {
        $this->_get_datatables_query_umkm();

        return $this->db->get()->num_rows();
        
    }

    // 19-11-2020
    public function get_produk()
    {
        $id_umkm    = $this->input->post('id_umkm');
        $id_kat     = $this->input->post('id_kategori');
        $status     = $this->input->post('status_tampil');
        
        $this->db->select('*');
        $this->db->from('mst_produk');
        $this->db->where('id_umkm', $id_umkm);
        $this->db->where('status_tampil', $status);
        
        if ($id_kat != '') {
            $this->db->where('id_kategori', $id_kat);
        }
        
        return $this->db->get();
    }

    // 19-11-2020
    public function cari_kategori_produk($id_umkm)
    {
        // $this->db->select('k.id, k.kategori');
        // $this->db->from('mst_produk as p');
        // $this->db->join('mst_kategori as k', 'k.id = p.id_kategori', 'inner');
        // $this->db->where('p.id_umkm', $id_umkm);
        // $this->db->where('k.status', 1);
        
        // $this->db->group_by('k.id');

        $this->db->select('k.id, k.kategori');
        $this->db->from('mst_kategori as k');
        $this->db->where('k.idumkm', $id_umkm);
        $this->db->where('k.status', 1);
        
        return $this->db->get();
        
    }

    // 20-11-2020
    public function get_bahan_baku()
    {
        $this->db->select('b.*, t.satuan');
        $this->db->from('mst_bahan_baku as b');
        $this->db->join('mst_satuan as t', 't.id = b.satuan', 'inner');
        $this->db->order_by('b.bahan_baku', 'asc');
        
        return $this->db->get();
    }

    // 22-09-2020
    public function cari_kategori()
    {
        $this->db->select('mst_kategori.id, mst_kategori.kategori');
        $this->db->from($this->table)
        ->join('mst_kategori', "mst_kategori.id = $this->table.id_kategori")
    	->where('id_umkm', $this->session->userdata('id_umkm'));
        $this->db->order_by('nama', 'asc');
        $this->db->group_by('mst_kategori.id');
        
    	return $this->db->get();
    }

	public function read()
    {
    	$this->db->from($this->table)
    	->where('id_umkm', $this->session->userdata('id_umkm'));
    	if($this->input->post('kategori_filter') != 'all')
    	{
    		$this->db->where('id_kategori', $this->input->post('kategori_filter'));
    	}
    	$this->db->order_by('nama', 'asc');
    	$query = $this->db->get();
    	return $query->result();
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

	public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

	public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}

/* End of file M_produk.php */
/* Location: ./application/models/M_produk.php */