<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topping extends CI_Controller {

	public function read()
	{
		$list 	= $this->topping->read();
		$data 	= [];
		$no		= 1;
		foreach($list as $topping)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= $topping->topping;
            $row[] 	= 'Rp. '.number_format($topping->harga);
            $row[]  = '<a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="update_topping('."'".$topping->id."'".')"><i class="fas fa-edit"></i></a>
            			<a class="btn btn-xs btn-danger hapus" href="javascript:void(0)" title="Hapus" onclick="delete_topping('."'".$topping->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->topping->count_all(),
                    "recordsFiltered" 	=> $this->topping->count_filtered(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function get($id)
    {
        $data = $this->topping->get($id);
        echo json_encode($data);
    }

	public function create()
	{
		$this->_validate();
		$data = [
			'id_produk'		=> $this->input->post('id_produk'),
			'topping'		=> $this->input->post('topping'),
			'harga'			=> str_replace(',', '', $this->input->post('harga')),
			'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
		];
        $this->topping->create($data);
        echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate_update();
		$data = [
			'topping'		=> $this->input->post('topping'),
			'harga'			=> str_replace(',', '', $this->input->post('harga'))
		];
		$this->topping->update(['id' => $this->input->post('id')], $data);
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
    {
        $this->topping->delete($this->input->post('id'));
        echo json_encode(array("status" => TRUE));
    }

	private function _validate()
    {
        $data   = array();
        $post   = $this->input->post();
        $query  = $this->db->query("SELECT * FROM mst_topping WHERE topping = '$post[topping]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('topping') == '')
        {
            $data['inputerror'][] = 'topping';
            $data['error_string'][] = 'Topping belum Diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
        {
            $data['inputerror'][] = 'topping';
            $data['error_string'][] = 'Topping '.$post['topping'].' sudah Digunakan';
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
        $query	= $this->db->query("SELECT * FROM mst_topping WHERE topping = '$post[topping]' AND id != '$post[id]' AND id_produk = '$post[id_produk]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('topping') == '')
        {
            $data['inputerror'][] = 'topping';
            $data['error_string'][] = 'Topping belum Diisi';
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
			$data['inputerror'][] = 'topping';
            $data['error_string'][] = 'Topping '.$post['topping'].' sudah Digunakan';
            $data['status'] = FALSE;
		}
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Topping.php */
/* Location: ./application/controllers/Topping.php */