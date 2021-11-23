<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('masuk'))) {
			redirect('Login','refresh');
        }
        
        $this->id_umkm  = $this->session->userdata('id_umkm');
        $this->nama     = $this->session->userdata('nama');
        $this->hal      = $this->session->userdata('hal');
	}

	public function index()
	{
        // 12-11-2020
        if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'kategori/lihat_admin';
        } else {
            $isi = 'kategori/detail_umkm';
        }

        $jml = $this->kategori->get_kategori()->result_array();

        $a = 0;
        foreach ($jml as $j) {
            $a += $j['jumlah_kategori'];
        }

        $jml = $this->pelanggan->cari_data('mst_kategori', ['idumkm' => $this->id_umkm])->num_rows();

        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

		$data 	= [
			'title'			=> 'Daftar Kategori',
            'produk'        => $this->produk->get_tanpa_kategori()->result(),
            'jml_kat'       => $jml,
            'isi'			=> $isi,
            'id_umkm'       => $this->id_umkm,
            'user'          => $this->nama,
            'umkm'		    => $nm['nama'],
            'hal'           => $this->hal
		];
		$this->load->view('template/wrapper', $data);
    }

    // 12-11-2020
    public function tampil_data_umkm()
    {
        $list = $this->kategori->get_data_umkm();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $href = base_url()."Kategori/detail_umkm/".$o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_umkm'];
            $tbody[]    = "<span style='font-size:15px;' class='badge badge-light font-weight-bold'>".$o['jumlah_kategori']."</span>";
            $tbody[]    = "<a href='$href' class='btn btn-icon btn-warning mr-2'>Detail</a>";
            $data[]     = $tbody;
        }

        $count_kat = $this->pelanggan->get_data_order('mst_kategori', 'id', 'asc')->num_rows();

        $output = [ "draw"              => $_POST['draw'],
                    "recordsTotal"      => $this->kategori->jumlah_semua_umkm(),
                    "recordsFiltered"   => $this->kategori->jumlah_filter_umkm(),   
                    "data"              => $data,
                    "jml_kategori"      => $count_kat
                ];

        echo json_encode($output);
    }

    // 13-11-2020
    public function detail_umkm($id)
    {
        $jml = $this->pelanggan->cari_data('mst_kategori', ['idumkm' => $id])->num_rows();

        $d = $this->pelanggan->cari_data('mst_umkm', ['id' => $id])->row_array();

        $data 	= [
			'title'     => 'Daftar Kategori',
            'isi'       => 'kategori/detail_umkm',
            'umkm'      => $d['nama'],
            'jml_kat'   => $jml,
            'id_umkm'   => $id,
            'produk'    => $this->produk->get_tanpa_kategori2($id)->result(),
            'user'      => $this->nama,
            'hal'       => $this->hal
		];
		$this->load->view('template/wrapper', $data);
    }

    // 13-11-2020 & 18-11-2020
    public function tampil_kategori($id)
    {
        $produk    = $this->produk->get_tanpa_kategori2($id)->num_rows();
		$list 	   = $this->kategori->read2($id);
		$data 	   = [];
		$no		   = 1;
		foreach($list as $k)
		{
            $row 	= [];
            
            if ($k['status'] == 1) {
                $st     = "<span class='badge badge-success'>Aktif</span>";
            } else {
                $st     = "<span class='badge badge-danger'>Non Aktif</span>";
            }

			$row[] 	= $no++.'.';
            $row[] 	= $k['kategori'];
            $row[] 	= $st;
            
            if($produk > 0)
            {
                $rw  = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Tetapkan Produk" class="btn btn-info set_produk mr-2" data-id="'.$k['id'].'" kategori="'.$k['kategori'].'"><i class="fa fa-check"></i></a>';
            }
            else
            {
                $rw = "";
            }

            $row[]  = $rw.'<a data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success edit_kategori mr-2" href="javascript:void(0)" data-id="'.$k['id'].'" kategori="'.$k['kategori'].'" status="'.$k['status'].'"><i class="fa fa-pencil-alt"></i></a><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger delete_kategori mr-2" data-id="'.$k['id'].'" id_umkm="'.$id.'" kategori="'.$k['kategori'].'"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="List Produk" class="btn btn-warning detail_produk" data-id="'.$k['id'].'" id_umkm="'.$id.'" kategori="'.$k['kategori'].'"><i class="fa fa-list-ol"></i></a>';
            $data[] = $row;
        }
        
        // cari 
        $cr_kategori = $this->pelanggan->cari_data('mst_kategori', ['idumkm' => $id])->num_rows();
        
        if ($list) {
            echo json_encode(array('data'=> $data, 'jml_kategori' => $cr_kategori));
        }else{
            echo json_encode(array('data'=> 0, 'jml_kategori' => 0));
        }
    }

    // 18-11-2020
    public function simpan_set_produk()
    {
        $id_kategori    = $this->input->post('id_kategori');
        $nama_produk    = json_decode(stripslashes($this->input->post('nama_produk')));

        foreach ($nama_produk as $d) {
            $this->pelanggan->ubah_data('mst_produk', ['id_kategori' => $id_kategori], ['id' => $d]);
        }
        
        echo json_encode(['status' => true]);
    }

    // 18-11-2020
    public function tampil_produk()
    {
        $id_kategori = $this->input->post('id_kategori');
        
		$list 	   = $this->kategori->tampil_produk($id_kategori)->result_array();
		$data 	   = [];
		$no		   = 1;
		foreach($list as $k)
		{
            $row 	= [];

            $m  = $k['image'];
            $id = $k['id'];
            
            if ($m == null) {
                $img = "<img class='' width='50%' src='".base_url('assets/template/img/news/img04.jpg')."'>";
            } else {
                $img = "<img class='' width='50%' src='http://apilite-tester.mitrabagja.com/upload/produk/$m'>";
            }

			$row[] 	= $no++.'.';
            $row[] 	= $img;
            $row[] 	= $k['nama'];
            $row[] 	= "Rp. ".number_format($k['harga'],0,'.','.');
            $row[]  = '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Remove" class="btn btn-danger remove_produk" id="remove'.$id.'" data-id="'.$k['id'].'"><i class="fa fa-times"></i></a>';
            $data[] = $row;
		}
        
        if ($list) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=> 0));
        }
    }

    // 18-11-2020
    public function remove_produk()
    {
        $id_produk = $this->input->post('id_produk');

        $this->pelanggan->ubah_data('mst_produk', ['id_kategori' => 0], ['id' => $id_produk]);

        echo json_encode(['status' => true]);
    }

    // 18-11-2020
    public function ambil_list_produk()
    {
        $id_umkm = $this->input->post('id_umkm');

        $produk    = $this->produk->get_tanpa_kategori2($id_umkm)->result_array();

        $option = "";

        foreach ($produk as $d) {
            $option .= "<option value='".$d['id']."'>".$d['nama']."</option>";
        }

        echo json_encode(['option' => $option, 'jml' => count($produk)]);
        
    }

    // 13-11-2020
    public function simpan_data_kategori()
    {
        $aksi       = $this->input->post('aksi');
        $id_umkm    = $this->input->post('id_umkm');
        $kategori   = $this->input->post('kategori');
        $status     = $this->input->post('status');
        $id         = $this->input->post('id_kategori');

        $data = ['idumkm'       => $id_umkm,
                 'kategori'     => $kategori,
                 'status'       => $status,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        $nm_kategori = trim(strtolower($kategori), " ");

        $kat1 = $this->pelanggan->cari_data('mst_kategori', ['idumkm' => $id_umkm])->result_array();

        $st = "";

        foreach ($kat1 as $k) {
            
            $nm_k = trim(strtolower($k['kategori']), " ");

            if ($nm_kategori == $nm_k) {
                $st = 'sama';
            } else {
                $st = 'beda';        
            }
        }
        
        if ($aksi == 'Tambah') {
            if ($st == 'beda' || $st == "") {
                $this->pelanggan->input_data('mst_kategori', $data);
            }
        } elseif ($aksi == 'Ubah') {
            if ($st == 'beda') {
                $this->pelanggan->ubah_data('mst_kategori', $data, ['id' => $id]);
            }
        } else {

            $this->pelanggan->hapus_data('mst_produk', ['id_kategori' => $id]);
            $this->pelanggan->hapus_data('mst_kategori', ['id' => $id]);

        }

        $tot = $this->pelanggan->cari_data('mst_kategori', ['idumkm' => $id_umkm])->num_rows();
        
        echo json_encode(['jumlah' => $tot, 'status' => $st]);
    }

    public function ambil_data_kategori($id)
    {
        $data = $this->pelanggan->cari_data('mst_kategori', ['id' => $id])->row_array();

        echo json_encode($data);
    }

	public function read()
	{
        $produk    = $this->produk->get_tanpa_kategori()->num_rows();
		$list 	   = $this->kategori->read();
		$data 	   = [];
		$no		   = 1;
		foreach($list as $kategori)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= $kategori->kategori;
            if($produk > 0)
            {
            $row[]  = '<a href="javascript:void(0)" class="btn btn-xs btn-info" data-toggle="modal" onclick="set_produk('."'".$kategori->id."'".')"><i class="fas fa-plus"></i> Tetapkan Produk</a>
            			<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$kategori->id."'".')"><i class="fa fa-trash"></i></a>';
            }
            else
            {
                $row[]  = '<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$kategori->id."'".')"><i class="fa fa-trash"></i></a>';
            }
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->kategori->count_all(),
                    "recordsFiltered" 	=> $this->kategori->count_filtered(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function create_kategori()
    {
        $this->_validate_kategori();
        $data  = [
        			'idumkm'		=> $this->session->userdata('id_umkm'),
                    'kategori'      => $this->input->post('kategori'),
                    'created_at'   	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
                ];
        $this->kategori->create($data);
        echo json_encode(array("status" => TRUE));
    }

    public function set_produk()
    {
        $id_produk  = $this->input->post('id_produk');
        foreach($id_produk as $id)
        {
            $data = [
                'id_kategori'   => $this->input->post('id_kategori')
            ];
            $this->produk->update(['id' => $id], $data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $data = $this->kategori->delete($id);
        echo json_encode($data);
    }

    private function _validate_kategori()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('kategori') == '')
        {
            $data['inputerror'][] = 'kategori';
            $data['error_string'][] = 'Nama kategori belum diisi';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */