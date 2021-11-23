<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	public function read()
	{
		$list 	= $this->status->read();
		$data 	= [];
		$no		= 1;
		foreach($list as $status)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= $status->status;
            $row[]  = '<a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="update_status('."'".$status->id."'".')"><i class="fas fa-edit"></i></a>
            			<a class="btn btn-xs btn-danger hapus" href="javascript:void(0)" title="Hapus" onclick="delete_status('."'".$status->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->status->count_all(),
                    "recordsFiltered" 	=> $this->status->count_filtered(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}
	public function get($id)
    {
        $data = $this->status->get($id);
        echo json_encode($data);
    }

	public function create()
	{
		$this->_validate();
		$data = [
			'id_produk'		=> $this->input->post('id_produk'),
			'status'		=> $this->input->post('status'),
			'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
		];
        $this->status->create($data);
        echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$this->_validate_update();
		$data = [
			'status'		=> $this->input->post('status')
		];
		$this->status->update(['id' => $this->input->post('id')], $data);
        echo json_encode(array("status" => TRUE));
	}

	public function delete()
    {
        $this->status->delete($this->input->post('id'));
        echo json_encode(array("status" => TRUE));
    }

	private function _validate()
    {
        $data = array();
        $post = $this->input->post();
        $query	= $this->db->query("SELECT * FROM mst_status WHERE status = '$post[status]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status belum Diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
		{
			$data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status '.$post['status'].' sudah Digunakan';
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
        $query	= $this->db->query("SELECT * FROM mst_status WHERE status = '$post[status]' AND id != '$post[id]' AND id_produk = '$post[id_produk]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status belum Diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
		{
			$data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status '.$post['status'].' sudah Digunakan';
            $data['status'] = FALSE;
		}
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Status.php */
/* Location: ./application/controllers/Status.php */