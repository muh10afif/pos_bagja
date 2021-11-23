<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_split extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
    }

	var $table = 'mst_split';

	public function get($id = null)
	{
		$this->db->from($this->table);
		if($id)
		{
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query->row();
	}

	public function get_bahan_hitung($id)
	{
		$this->db->select('sum(mst_split.harga) as nilai_split, mst_produk.harga')
		->from($this->table)
		->join('mst_produk', 'mst_produk.id = mst_split.id_produk')
		->where('mst_split.id_produk', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function read()
    {
    	$this->db->from($this->table)
    	->where('id_produk', $this->input->post('id'));
    	$this->db->order_by('created_at', 'asc');
    	$query = $this->db->get();
    	return $query->result();
    }

    public function count_filtered()
    {
        $this->db->from($this->table)
    	->where('id_produk', $this->input->post('id'));
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table)
    	->where('id_produk', $this->input->post('id'));
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

/* End of file M_split.php */
/* Location: ./application/models/M_split.php */