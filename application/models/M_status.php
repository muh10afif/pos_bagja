<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_status extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->id_umkm = $this->session->userdata('id_umkm');
    }

	var $table = 'mst_status';

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

	public function read()
    {
    	$this->db->from($this->table)
    	->where('id_produk', $this->input->post('id'))
    	->order_by('created_at', 'asc');
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

/* End of file M_status.php */
/* Location: ./application/models/M_status.php */