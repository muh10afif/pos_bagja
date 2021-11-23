<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    // 16-11-2020
    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();

        $this->id_umkm = $this->session->userdata('id_umkm');
    }
    
    public function index()
    {
        $data 	= [
			'title'			=> 'User',
			'isi'			=> 'user/V_tampil'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    // 16-11-2020
    public function tampil_data_user_umkm()
    {
        $list = $this->user->get_data_user_umkm();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $id = $o['id'];

            if ($o['status'] == 1) {
                $st     = "<span class='badge badge-success'>Aktif</span>";
                $a_st   = "<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Non aktifkan' class='btn btn-icon btn-danger mr-2 status-user' id='status$id' data-id='".$o['id']."' status='0'><i class='fa fa-times'></i></a>";
            } else {
                $st     = "<span class='badge badge-danger'>Non Aktif</span>";
                $a_st   = "<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Aktifkan' class='btn btn-icon btn-info status-user' id='status$id' data-id='".$o['id']."' status='1'><i class='fa fa-check'></i></a>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = $o['username'];
            $tbody[]    = $o['email'];
            $tbody[]    = $st;
            $tbody[]    = "<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Edit' class='btn btn-icon btn-warning mr-2 edit-user' data-id='".$o['id']."' umkm='".$o['nama']."' username='".$o['username']."' email='".$o['email']."' password='".$o['password']."' id_umkm='".$o['id_umkm']."'><i class='fa fa-pencil-alt'></i></a>$a_st";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->user->jumlah_semua_user_umkm(),
                    "recordsFiltered"  => $this->user->jumlah_filter_user_umkm(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 16-11-2020
    public function tampil_data_user_investor()
    {
        $list = $this->user->get_data_user_investor();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $id = $o['id'];

            if ($o['status'] == 1) {
                $st     = "<span class='badge badge-success'>Aktif</span>";
                $a_st   = "<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Non aktifkan' class='btn btn-icon btn-danger mr-2 status-user' id='status_in$id' data-id='".$o['id']."' status='0'><i class='fa fa-times'></i></a>";
            } else {
                $st     = "<span class='badge badge-danger'>Non Aktif</span>";
                $a_st   = "<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Aktifkan' class='btn btn-icon btn-info status-user mr-2' id='status_in$id' data-id='".$o['id']."' status='1'><i class='fa fa-check'></i></a>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['username'];
            $tbody[]    = $o['email'];
            $tbody[]    = $st;
            $tbody[]    = "<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Edit' class='btn btn-icon btn-warning mr-2 edit-user' data-id='".$o['id']."' username='".$o['username']."' email='".$o['email']."' password='".$o['password']."'><i class='fa fa-pencil-alt'></i></a>$a_st<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='List UMKM' class='btn btn-icon btn-primary list-umkm' data-id='".$o['id']."' investor='".ucwords($o['username'])."'><i class='fa fa-list-ol'></i></a>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->user->jumlah_semua_user_investor(),
                    "recordsFiltered"  => $this->user->jumlah_filter_user_investor(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 17-11-2020
    public function tampil_data_umkm()
    {
        $list = $this->user->get_data_umkm()->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $id = $o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = $o['alamat'];
            $tbody[]    = $o['telp'];
            $tbody[]    = $o['namaowner'];
            $tbody[]    = "<a href='javascript:;' data-toggle='tooltip' data-placement='top' title='Remove' class='btn btn-icon btn-danger mr-2 remove-umkm' id='status_u$id' data-id='".$o['id']."' status='0'><i class='fa fa-times'></i></a>";
            $data[]     = $tbody;
        }

        if ($list) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=> 0));
        }
    }

    // 17-11-2020
    public function remove_umkm()
    {
        $id_umkm = $this->input->post('id_umkm');
        
        $this->pelanggan->ubah_data('mst_umkm', ['id_investor' => 0], ['id' => $id_umkm]);

        echo json_encode(['status' => true]);
    }

    // 17-11-2020
    public function ambil_list_umkm()
    {
        $list = $this->user->get_list_umkm_belum()->result_array();

        $option = "";

        $option = "<option value=''>Pilih UMKM</option>";

        foreach ($list as $d) {
            $option .= "<option value='".$d['id']."'>".$d['nama']."</option>";
        }

        echo json_encode(['option' => $option, 'jml' => count($list)]);
    }

    // 17-11-2020
    public function ambil_list_umkm_investor()
    {
        $list = $this->user->get_list_umkm_belum_investor()->result_array();

        $option = "";

        foreach ($list as $d) {
            $option .= "<option value='".$d['id']."'>".$d['nama']."</option>";
        }

        echo json_encode(['option' => $option, 'jml' => count($list)]);
    }

    // 17-11-2020
    public function ambil_list_umkm_investor_edit()
    {
        $id_investor = $this->input->post('id_investor');
        
        $list   = $this->user->get_list_umkm_belum_investor()->result_array();
        $list_2 = $this->user->get_list_umkm_belum_investor_id($id_investor)->result_array();

        $option = "";

        foreach ($list as $d) {
            $option .= "<option value='".$d['id']."'>".$d['nama']."</option>";
        }

        $arr = [];
        foreach ($list_2 as $e) {
            array_push($arr, $e['id']);
            $option .= "<option value='".$e['id']."'>".$e['nama']."</option>";
        }

        echo json_encode(['option' => $option, 'selected' => $arr]);
    }

    // 17-11-2020
    public function simpan_data_user()
    {
        $aksi       = $this->input->post('aksi_umkm');
        $id_umkm    = $this->input->post('nama_umkm');
        $id_umkm_e  = $this->input->post('id_umkm');
        $username   = $this->input->post('username_umkm');
        $password   = $this->input->post('password_umkm');
        $pass_lama  = $this->input->post('password_lama');
        $email      = $this->input->post('email_umkm');
        $id         = $this->input->post('id_user');

        if ($aksi == 'Tambah') {
            $pass = password_hash($password, PASSWORD_DEFAULT);

            $id_umkm = $id_umkm;
        } else if($aksi == 'Ubah') {
            if ($password != '') {
                $pass = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $pass = $pass_lama;
            }

            $id_umkm = $id_umkm_e;
        }

        $data = ['username'     => $username,
                 'password'     => $pass,
                 'email'        => $email,
                 'id_umkm'      => $id_umkm,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];
        
        if ($aksi == 'Tambah') {
            $this->pelanggan->input_data('mst_user', $data);
        } elseif ($aksi == 'Ubah') {
            $this->pelanggan->ubah_data('mst_user', $data, ['id' => $id]);
        } else {
            $this->pelanggan->hapus_data('mst_user', ['id' => $id]);
        }
        
        echo json_encode($data);
    }

    // 17-11-2020
    public function simpan_data_investor()
    {
        $aksi       = $this->input->post('aksi_investor');
        $id_umkm    = json_decode(stripslashes($this->input->post('nama_umkm2')));
        $username   = $this->input->post('username_investor');
        $password   = $this->input->post('password_investor');
        $pass_lama  = $this->input->post('password_lama_in');
        $email      = $this->input->post('email_investor');
        $id         = $this->input->post('id_investor');

        if ($aksi == 'Tambah') {
            $pass = password_hash($password, PASSWORD_DEFAULT);
        } else if($aksi == 'Ubah') {
            if ($password != '') {
                $pass = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $pass = $pass_lama;
            }
        }

        $data = ['username'     => $username,
                 'password'     => $pass,
                 'email'        => $email,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];
        
        if ($aksi == 'Tambah') {
            $this->pelanggan->input_data('mst_investor', $data);

            $id_investor = $this->db->insert_id();

            foreach ($id_umkm as $d) {
                $this->pelanggan->ubah_data('mst_umkm', ['id_investor' => $id_investor], ['id' => $d]); 
            }
            
        } elseif ($aksi == 'Ubah') {

            $list_2 = $this->user->get_list_umkm_belum_investor_id($id)->result_array();

            foreach ($list_2 as $k) {
                $this->pelanggan->ubah_data('mst_umkm', ['id_investor' => 0], ['id' => $k['id']]); 
            }

            foreach ($id_umkm as $d) {
                $this->pelanggan->ubah_data('mst_umkm', ['id_investor' => $id], ['id' => $d]); 
            }

            $this->pelanggan->ubah_data('mst_investor', $data, ['id' => $id]);
        } else {
            $this->pelanggan->hapus_data('mst_investor', ['id' => $id]);
        }
        
        echo json_encode($data);
    }

    // 17-11-2020
    public function ubah_status_user()
    {
        $id_user    = $this->input->post('id_user');
        $status     = $this->input->post('status');

        $this->pelanggan->ubah_data('mst_user', ['status' => $status], ['id' => $id_user]);

        echo json_encode(['status' => true]);
        
    }

    // 17-11-2020
    public function ubah_status_investor()
    {
        $id_investor    = $this->input->post('id_investor');
        $status         = $this->input->post('status');

        $this->pelanggan->ubah_data('mst_investor', ['status' => $status], ['id' => $id_investor]);

        echo json_encode(['status' => true]);
        
    }
}

/* End of file User.php */
