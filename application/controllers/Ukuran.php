<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ukuran extends CI_Controller {

	public function read()
	{
		$list 	= $this->ukuran->read();
		$data 	= [];
		$no		= 1;
		foreach($list as $ukuran)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= $ukuran->ukuran;
            $row[] 	= 'Rp. '.number_format($ukuran->harga);
            $row[]  = '<a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="update_ukuran('."'".$ukuran->id."'".')"><i class="fas fa-edit"></i></a>
            			<a class="btn btn-xs btn-danger hapus" href="javascript:void(0)" title="Hapus" onclick="delete_ukuran('."'".$ukuran->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->ukuran->count_all(),
                    "recordsFiltered" 	=> $this->ukuran->count_filtered(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function get($id)
    {
        $data = $this->ukuran->get($id);
        echo json_encode($data);
    }

	public function create()
	{
		$this->_validate();
		$data = [
			'id_produk'		=> $this->input->post('id_produk'),
			'ukuran'		=> $this->input->post('ukuran'),
			'harga'			=> str_replace(',', '', $this->input->post('harga')),
			'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
		];
        $this->ukuran->create($data);
        echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate_update();
		$data = [
			'ukuran'		=> $this->input->post('ukuran'),
			'harga'			=> str_replace(',', '', $this->input->post('harga'))
		];
		$this->ukuran->update(['id' => $this->input->post('id')], $data);
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
    {
        $this->ukuran->delete($this->input->post('id'));
        echo json_encode(array("status" => TRUE));
    }

	private function _validate()
    {
        $data 	= array();
        $post 	= $this->input->post();
        $query	= $this->db->query("SELECT * FROM mst_ukuran WHERE ukuran = '$post[ukuran]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('ukuran') == '')
        {
            $data['inputerror'][] = 'ukuran';
            $data['error_string'][] = 'Ukuran belum Diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
		{
			$data['inputerror'][] = 'ukuran';
            $data['error_string'][] = 'Ukuran '.$post['ukuran'].' sudah Digunakan';
            $data['status'] = FALSE;
		}
        if($this->input->post('harga') == '')
        {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga belum Diisi';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_update()
    {
        $data = array();
        $post = $this->input->post();
        $query	= $this->db->query("SELECT * FROM mst_ukuran WHERE ukuran = '$post[ukuran]' AND id != '$post[id]' AND id_produk = '$post[id_produk]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('ukuran') == '')
        {
            $data['inputerror'][] = 'ukuran';
            $data['error_string'][] = 'Ukuran belum Diisi';
            $data['status'] = FALSE;
        }
        if($this->input->post('harga') == '')
        {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Harga belum Diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
		{
			$data['inputerror'][] = 'ukuran';
            $data['error_string'][] = 'Ukuran '.$post['ukuran'].' sudah Digunakan';
            $data['status'] = FALSE;
		}
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Ukuran.php */
/* Location: ./application/controllers/Ukuran.php */