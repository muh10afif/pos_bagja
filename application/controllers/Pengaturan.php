<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    // 24-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();

        $this->id_umkm = $this->session->userdata('id_umkm');
        $this->id_user = $this->session->userdata('id_user');
    }

    // 17-09-2020
    
    public function index()
    {
        // cari id_umkm
        $umkm = $this->transaksi->cari_data('mst_user', ['id' => $this->id_user])->row_array();
        $user = $this->transaksi->cari_data('mst_umkm', ['id' => $umkm['id_umkm']])->row_array();

        $data 	= [
			'title'	=> 'Pengaturan',
            'isi'	=> 'pengaturan/V_pengaturan',
            'umkm'  => $user,
            'user'  => $umkm['username']
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 17-09-2020

    public function simpan_data_user()
    {
        $nama_umkm  = $this->input->post('nama_umkm');
        $alamat     = $this->input->post('alamat');
        $nama_owner = $this->input->post('nama_owner');
        $telp       = $this->input->post('telp');
        $username   = $this->input->post('username');

        $data_umkm = ['nama'        => $nama_umkm,
                      'alamat'      => $alamat,
                      'telp'        => $telp,
                      'namaowner'   => $nama_owner
                     ];

        $id_u = $this->transaksi->cari_data('mst_user', ['id' => $this->id_user])->row_array();

        // ubah umkm
        $this->transaksi->ubah_data('mst_umkm', $data_umkm, ['id' => $this->id_umkm]);

        
        $array = array(
            'nama' => $username
        );
        
        $this->session->set_userdata( $array );
        
        
        $data_user = ['username'    => $username];

        // ubah user
        $this->transaksi->ubah_data('mst_user', $data_user, ['id' => $id_u['id']]);
        
        echo json_encode(['status' => true]);

    }

}

/* End of file Pengaturan.php */
