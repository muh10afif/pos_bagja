<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    // 24-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();

        $this->id_umkm  = $this->session->userdata('id_umkm');
        $this->nama     = $this->session->userdata('nama');
        $this->hal      = $this->session->userdata('hal');
    }
    
    public function index()
    {
        if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'pelanggan/V_lihat_admin';
        } else {
            $isi = 'pelanggan/V_tampil';
        }

        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

        $data 	= [
			'title'     => 'Pelanggan',
            'isi'       => $isi,
            'user'      => $this->nama,
            'id_umkm'   => $this->id_umkm,
            'nama_umkm'	=> $nm['nama'],
            'hal'       => $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 03-12-2020
    public function tampil_data_umkm()
    {
        $list = $this->pelanggan->get_data_umkm();

        $data = array();

        $no   = $this->input->post('start');

        $jml_pel = 0;
        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $href = base_url()."Pelanggan/detail_umkm/".$o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_umkm'];
            $tbody[]    = "<span style='font-size:15px;' class='badge badge-light font-weight-bold'>".$o['jumlah_pelanggan']."</span>";
            $tbody[]    = "<a href='$href' class='btn btn-icon btn-warning mr-2'>Detail</a>";
            $data[]     = $tbody;

            
        }

        $cr = $this->pelanggan->count_pelanggan()->result_array();

        foreach ($cr as $c) {
            $jml_pel    += $c['jumlah_pelanggan'];
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->pelanggan->jumlah_semua_umkm(),
                    "recordsFiltered"  => $this->pelanggan->jumlah_filter_umkm(),   
                    "data"             => $data,
                    "jml_pelanggan"    => $jml_pel
                ];

        echo json_encode($output);
    }

    // 03-12-2020
    public function detail_umkm($id_umkm)
    {
        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data 	= [
            'title'     => 'Pelanggan',
            'isi'       => 'pelanggan/V_tampil',
            'id_umkm'   => $id_umkm,
            'user'      => $this->nama,
            'nama_umkm' => $nm['nama'],
            'hal'       => $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 25-08-2020
    public function simpan_data_pelanggan()
    {
        $aksi       = $this->input->post('aksi');
        $nama       = $this->input->post('nama');
        $id_umkm    = $this->input->post('id_umkm');
        $telp       = $this->input->post('telp');
        $id         = $this->input->post('id_pelanggan');

        $data = ['idumkm'       => $id_umkm,
                 'nama'         => $nama,
                 'telp'         => $telp,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];
        
        if ($aksi == 'Tambah') {
            $this->pelanggan->input_data('mst_pelanggan', $data);
        } elseif ($aksi == 'Ubah') {
            $this->pelanggan->ubah_data('mst_pelanggan', $data, ['id' => $id]);
        } else {
            $this->pelanggan->hapus_data('mst_pelanggan', ['id' => $id]);
        }
        
        echo json_encode($data);
    }

    public function ambil_data_pelanggan($id)
    {
        $data = $this->pelanggan->cari_data('mst_pelanggan', ['id' => $id])->row_array();

        echo json_encode($data);
    }

    public function tampil_data_pelanggan()
    {
        $list = $this->pelanggan->get_data_pelanggan();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = $o['telp'];
            $tbody[]    = "<a href='javascript:;' class='btn btn-icon btn-success mr-2 edit-pelanggan' data-id='".$o['id']."'><i class='far fa-edit'></i></a><a href='javascript:;' class='btn btn-icon btn-danger mr-2 hapus-pelanggan' data-id='".$o['id']."' nama='".$o['nama']."'><i class='fa fa-trash'></i></a>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->pelanggan->jumlah_semua_pelanggan(),
                    "recordsFiltered"  => $this->pelanggan->jumlah_filter_pelanggan(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

}

/* End of file Pelanggan.php */
