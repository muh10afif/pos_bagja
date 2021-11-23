<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Promosi extends CI_Controller {

    // 24-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();
    }
    
    public function index()
    {
        $this->per_total_pembelian();   
    }

    public function per_total_pembelian()
    {
        $data 	= [
            'title' => 'Promosi',
            'jenis' => 'Per Total Pembelian',
			'isi'   => 'promosi/V_promosi'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function per_produk()
    {
        $data 	= [
            'title' => 'Promosi',
            'jenis' => 'Per Produk',
			'isi'   => 'promosi/per_produk'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function read_per_produk()
    {
        $list   = $this->promosi_per_produk->read();
        $data   = [];
        $no     = 1;
        foreach($list as $promosi_per_produk)
        {
            $row    = [];
            $row[]  = $no++.'.';
            $row[]  = $promosi_per_produk->nama;
            $row[]  = $promosi_per_produk->kategori;
            $row[]  = 'Rp. '.number_format($promosi_per_produk->discount);
            $row[]  = '<a href="javascript:void(0)" class="btn btn-success mr-2" onClick="update_data('."'".$promosi_per_produk->id."'".')"><i class="far fa-edit"></i></a>
                        <a class="btn btn-danger hapus" href="javascript:void(0)" title="Hapus" onClick="delete_data('."'".$promosi_per_produk->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = [
                    "recordsTotal"      => $this->promosi_per_produk->count_all(),
                    "recordsFiltered"   => $this->promosi_per_produk->count_filtered(),
                    "data"              => $data,
                  ];
        echo json_encode($output);
    }

    public function get_produk_tanpa_diskon()
    {
        $data = $this->promosi_per_produk->get();
        echo json_encode($data);
    }

    public function update()
    {
        $this->_validate();
        $data = [
            'discount'      => str_replace(',', '', $this->input->post('discount'))
        ];
        $this->produk->update(['id' => $this->input->post('id')], $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $data = [
            'discount'      => 0
        ];
        $this->produk->update(['id' => $this->input->post('id')], $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data   = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('id') == '')
        {
            $data['inputerror'][] = 'id';
            $data['error_string'][] = 'Mohon pilih Produk';
            $data['status'] = FALSE;
        }
        if($this->input->post('discount') == '')
        {
            $data['inputerror'][] = 'discount';
            $data['error_string'][] = 'Nilai Diskon belum Diisi';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Promosi.php */
