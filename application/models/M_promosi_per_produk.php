<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_promosi_per_produk extends CI_Model {

	var $table 		= 'mst_produk';
	var $material 	= 'mst_kategori';
	var $yugo 		= 'mst_kategori.id = mst_produk.id_kategori';

	public function get()
    {
        $this->db->from($this->table)
        ->where('id_umkm', $this->session->userdata('id_umkm'))
        ->where('discount < 1');
        $query = $this->db->get();
        return $query->result();
    }

    public function read()
    {
    	$this->db->select('mst_produk.*, mst_kategori.kategori')
    	->from($this->table)
    	->join($this->material, $this->yugo)
    	->where('id_umkm', $this->session->userdata('id_umkm'))
        ->where('discount > 0');
    	$query = $this->db->get();
    	return $query->result();
    }

    public function count_filtered()
    {
        $this->db->from($this->table)
    	->join($this->material, $this->yugo)
    	->where('id_umkm', $this->session->userdata('id_umkm'))
        ->where('discount > 0');
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table)
    	->join($this->material, $this->yugo)
    	->where('id_umkm', $this->session->userdata('id_umkm'))
        ->where('discount > 0');
        $query = $this->db->get();
        return $this->db->count_all_results();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

}

/* End of file M_promosi_per_produk.php */
/* Location: ./application/models/M_promosi_per_produk.php */