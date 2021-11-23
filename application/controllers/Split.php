<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Split extends CI_Controller {

	public function get_bahan_hitung($id)
	{
		$data = $this->split->get_bahan_hitung($id);
		echo json_encode($data);
	}

	public function read()
	{
		$list 	= $this->split->read();
		$data 	= [];
		$no		= 1;
		foreach($list as $split)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= $split->split;
            $row[] 	= 'Rp. '.number_format($split->harga);
            $row[]  = '<a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="update_split('."'".$split->id."'".')"><i class="fas fa-edit"></i></a>
            			<a class="btn btn-xs btn-danger hapus" href="javascript:void(0)" title="Hapus" onclick="delete_split('."'".$split->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->split->count_all(),
                    "recordsFiltered" 	=> $this->split->count_filtered(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function get($id)
    {
        $data = $this->split->get($id);
        echo json_encode($data);
    }

	public function create()
	{
		$this->_validate();
		$post 	= $this->input->post();
		$i 		= 0;
		foreach($post['harga'] as $harga) 
		{
    		$data = [
				'id_produk'	=> $post['id_produk'],
				'split'		=> $post['split'][$i++],
				'harga'		=> $harga,
				'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
			];
			$this->split->create($data);
    	}
    	echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate_update();
		$data = [
			'split'	=> $this->input->post('split'),
			'harga'	=> str_replace(',', '', $this->input->post('harga'))
		];
		$this->split->update(['id' => $this->input->post('id')], $data);
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
    {
        $this->split->delete($this->input->post('id'));
        echo json_encode(array("status" => TRUE));
    }

	private function _validate()
    {
    	$post = $this->input->post();
    	$i = 0;
    	$x = 0;
        $data = array();
        $data['status'] = TRUE;
        foreach($post['split'] as $split) 
        {
            $query  = $this->db->query("SELECT * FROM mst_split WHERE split = '$split'");
            if($split == '')
            {
                $data['message']    = 'Mohon Masukan Nama Pihak';
                $data['status']     = FALSE;
                echo json_encode($data);
                exit();
            }
            if ($query->num_rows() > 0) 
            {
                $data['message']    = 'Pihak '.$split.' sudah Terdaftar';
                $data['status']     = FALSE;
            }
        }
    	foreach($post['harga'] as $harga) 
    	{
            if($harga == '')
            {
                $data['message']    = 'Mohon Masukan Nilai Harga';
                $data['status']     = FALSE;
                echo json_encode($data);
                exit();
            }
    		$x += $harga;
    	}
        if($x > $this->input->post('harga_asli'))
        {
        	$data['message'] 	= 'Jumlah nilai Split tidak boleh Melebihi Harga Jual!';
        	$data['status'] 	= FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_update()
    {
    	$harga_asli		= $this->input->post('harga_asli');
    	$harga_split	= $this->input->post('harga_split');
    	$harga 			= str_replace(',', '', $this->input->post('harga'));
    	$akumulasi 		= ($harga_split - $harga);
    	$nilai_sisa 	= ($harga_asli - $akumulasi);
        $post           = $this->input->post();
        $query  = $this->db->query("SELECT * FROM mst_split WHERE split = '$post[split]' AND id != '$post[id]' AND id_produk = '$post[id_produk]'");
        $data = array();
        $data['status'] = TRUE;
        if($this->input->post('split') == '')
        {
            $data['message']    = 'Mohon Masukan Nama Pihak';
            $data['status']     = FALSE;
            echo json_encode($data);
            exit();
        }
        if($this->input->post('harga') == '')
        {
            $data['message']    = 'Mohon Masukan Nilai Harga';
            $data['status']     = FALSE;
            echo json_encode($data);
            exit();
        }
        if($harga_split < $nilai_sisa)
        {
        	$data['message'] 	= 'Jumlah Nilai Split tidak boleh Melebihi Harga Jual!';
        	$data['status'] 	= FALSE;
            echo json_encode($data);
            exit();
        }
        if ($query->num_rows() > 0) 
        {
            $data['message']    = 'Pihak '.$post['split'].' sudah Terdaftar';
            $data['status']     = FALSE;
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Split.php */
/* Location: ./application/controllers/Split.php */