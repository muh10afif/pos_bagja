<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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
        if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'produk/lihat_admin';
        } else {
            $isi = 'produk/detail_umkm';
        }

        $list = $this->produk->get_data_umkm_2()->result_array();

        $tot_produk = 0;
        foreach ($list as $k) {
            $tot_produk += $k['jumlah_produk'];
        }

        $jml    = $this->pelanggan->cari_data('mst_produk', ['id_umkm' => $this->id_umkm]);

        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

		$data 	= [
			'title'			=> 'Daftar Produk',
			'kategori'		=> $this->produk->cari_kategori()->result(),
            'isi'			=> $isi,
            'tot_produk'    => $tot_produk,
            'jml_produk'    => $jml->num_rows(),
            'id_umkm'       => $this->id_umkm,
            'user'          => $this->nama,
            'kategori'      => $this->produk->cari_kategori_produk($this->id_umkm)->result_array(),
            'bahan_baku'    => $this->produk->get_bahan_baku()->result_array(),
            'satuan'        => $this->pelanggan->get_data_order('mst_satuan', 'satuan', 'asc')->result_array(),
            'umkm'		    => $nm['nama'],
            'hal'           => $this->hal
		];
		$this->load->view('template/wrapper', $data);
    }
    
    // 18-11-2020
    public function tampil_data_umkm()
    {
        $list = $this->produk->get_data_umkm();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $href = base_url()."Produk/detail_umkm/".$o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_umkm'];
            $tbody[]    = "<span style='font-size:15px;' class='badge badge-light font-weight-bold'>".$o['jumlah_produk']."</span>";
            $tbody[]    = "<a href='$href' class='btn btn-icon btn-warning mr-2'>Detail</a>";
            $data[]     = $tbody;
        }

        $count_pro = $this->pelanggan->get_data_order('mst_produk', 'id', 'asc')->num_rows();

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->produk->jumlah_semua_umkm(),
                    "recordsFiltered"  => $this->produk->jumlah_filter_umkm(),   
                    "data"             => $data,
                    "jml_produk"       => $count_pro
                ];

        echo json_encode($output);
    }

    // 18-11-2020
    public function detail_umkm($id)
    {
        $jml    = $this->pelanggan->cari_data('mst_produk', ['id_umkm' => $id]);

        $d      = $this->pelanggan->cari_data('mst_umkm', ['id' => $id])->row_array();
        
        $nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id])->row_array();

        $data 	= [
			'title'         => 'Daftar Produk',
            'isi'           => 'produk/detail_umkm',
            'umkm'          => $d['nama'],
            'jml_produk'    => $jml->num_rows(),
            'id_umkm'       => $id,
            'kategori'      => $this->produk->cari_kategori_produk($id)->result_array(),
            'bahan_baku'    => $this->produk->get_bahan_baku()->result_array(),
            'satuan'        => $this->pelanggan->get_data_order('mst_satuan', 'satuan', 'asc')->result_array(),
            'umkm'		    => $nm['nama'],
            'hal'           => $this->hal,
            'user'          => $this->nama,
		];
		$this->load->view('template/wrapper', $data);
    }

    // 19-11-2020
    public function tampil_produk()
    {
        $list 	    = $this->produk->get_produk()->result_array();
        $id_umkm    = $this->input->post('id_umkm');
        
		$data 	    = [];
        $no		    = 1;
        
		foreach($list as $k)
		{
            $row 	= [];

            $m  = $k['image'];
            
            if ($m == null) {
                $img = "<img class='' width='50%' src='".base_url('assets/template/img/news/img04.jpg')."'>";
                
                $url = "";
            } else {
                // $img = "<img class='' width='50%' src='https://mitrabagja.com/upload/produk/$m'>";
                $url = "https://mitrabagja.com/upload/produk/$m";

                $img = "<img class='' width='50%' src='".base_url('upload/').$m."'>";
            }

			$row[] 	= $no++.'.';
            $row[] 	= $img;
            $row[] 	= $k['nama'];
            $row[] 	= "<div class='text-right'>".number_format($k['hpp'],0,',',',')."</div>";
            $row[] 	= "<div class='text-right'>".number_format($k['harga'],0,',',',')."</div>";
            $row[]  = '<a data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success edit_produk mr-2" href="javascript:void(0)" data-id="'.$k['id'].'" produk="'.$k['nama'].'" id_umkm="'.$id_umkm.'" harga_dasar="'.$k['hpp'].'" harga_jual="'.$k['harga'].'" id_kategori="'.$k['id_kategori'].'" discount="'.$k['discount'].'" image="'.$url.'" status_tampil="'.$k['status_tampil'].'"><i class="fa fa-pencil-alt"></i></a><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger delete_produk mr-2" data-id="'.$k['id'].'" id_umkm="'.$id_umkm.'" produk="'.$k['nama'].'"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-info detail_produk" data-id="'.$k['id'].'" id_umkm="'.$id_umkm.'" produk="'.$k['nama'].'"><i class="fa fa-info-circle"></i></a>';
            $data[] = $row;
        }
        
        $cr_produk = $this->pelanggan->cari_data('mst_produk', ['id_umkm' => $id_umkm])->num_rows();
        
        if ($list) {
            echo json_encode(array('data'=> $data, 'jumlah' => $cr_produk));
        }else{
            echo json_encode(array('data'=> 0, 'jumlah' => 0));
        }
    }

    // 10-12-2020
    public function ambil_detail_produk()
    {
        $id_produk = $this->input->post('id_produk');
        
        // cari data detail
        $cari_produk    = $this->pelanggan->cari_data('mst_produk', ['id' => $id_produk])->row_array();
        $cari_ukuran    = $this->pelanggan->cari_data('mst_ukuran', ['id_produk' => $id_produk])->result_array();
        $cari_topping   = $this->pelanggan->cari_data('mst_topping', ['id_produk' => $id_produk])->result_array();
        $cari_status    = $this->pelanggan->cari_data('mst_status', ['id_produk' => $id_produk])->result_array();
        $cari_split     = $this->pelanggan->cari_data('mst_split', ['id_produk' => $id_produk])->result_array();
        $cari_stok      = $this->pelanggan->cari_data('mst_stok', ['id_produk' => $id_produk])->row_array();
        $cari_expire    = $this->pelanggan->cari_data('mst_expire_date', ['id_stok' => $cari_stok['id']])->row_array();

        $dt = [ 'produk'    => $cari_produk,
                'ukuran'    => $cari_ukuran,
                'topping'   => $cari_topping,
                'status'    => $cari_status,
                'split'     => $cari_split,
                'stok'      => $cari_stok,
                'expire'    => $cari_expire
              ];
        
        echo json_encode($dt);
    }

    // 10-12-2020
    public function form_detail_produk()
    {
        $id_produk = $this->input->post('id_produk');
        
        // cari data detail
        $cari_produk    = $this->pelanggan->cari_data('mst_produk', ['id' => $id_produk])->row_array();
        $cari_ukuran    = $this->pelanggan->cari_data('mst_ukuran', ['id_produk' => $id_produk])->result_array();
        $cari_topping   = $this->pelanggan->cari_data('mst_topping', ['id_produk' => $id_produk])->result_array();
        $cari_status    = $this->pelanggan->cari_data('mst_status', ['id_produk' => $id_produk])->result_array();
        $cari_split     = $this->pelanggan->cari_data('mst_split', ['id_produk' => $id_produk])->result_array();
        $cari_stok      = $this->pelanggan->cari_data('mst_stok', ['id_produk' => $id_produk])->row_array();
        $cari_expire    = $this->pelanggan->cari_data('mst_expire_date', ['id_stok' => $cari_stok['id']])->row_array();
        $cari_kat       = $this->pelanggan->cari_data('mst_kategori', ['id' => $cari_produk['id_kategori']])->row_array();

        $cari_stok2     = $this->produk->cari_stok($id_produk)->row_array();

        $data = [   'produk'    => $cari_produk,
                    'ukuran'    => $cari_ukuran,
                    'topping'   => $cari_topping,
                    'status'    => $cari_status,
                    'split'     => $cari_split,
                    'stok'      => $cari_stok2,
                    'expire'    => $cari_expire,
                    'kategori'  => $cari_kat['kategori']
                ];

        $this->load->view('produk/lihat_detail', $data);
        
    }

    // 08-12-2020
    public function tampilan_edit_produk()
    {
        $id_produk  = $this->input->post('id_produk'); 
        $id_umkm    = $this->input->post('id_umkm'); 

        $data = ['id_umkm'      => $id_umkm,
                 'pro'          => $this->pelanggan->cari_data('mst_produk', ['id' => $id_produk])->row_array(),
                 'kategori'     => $this->produk->cari_kategori_produk($id_umkm)->result_array()
                ];
        
        $this->load->view('produk/V_edit', $data);
    }

    // 20-11-2020
    public function simpan_bahan_baku_baru()
    {
        $nama_bahan     = $this->input->post('nama_bahan');
        $satuan         = $this->input->post('satuan');
        $stok_bahan     = $this->input->post('stok_bahan');
        $harga_bahan    = str_replace(".","",$this->input->post('harga_bahan'));

        $data = ['bahan_baku'   => $nama_bahan,
                 'satuan'       => $satuan,
                 'stok'         => $stok_bahan,
                 'harga'        => $harga_bahan,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        $nm_bahan = trim(strtolower($nama_bahan), " ");

        $bhn = $this->pelanggan->get_data_order('mst_bahan_baku', 'bahan_baku', 'asc')->result_array();

        if (empty($bhn)) {
            $st = 'beda';
        } else {
            foreach ($bhn as $k) {
                
                $nm_b = trim(strtolower($k['bahan_baku']), " ");

                if ($nm_bahan == $nm_b) {
                    $st = 'sama';
                } else {
                    $st = 'beda';        
                }
            } 
        }

        if ($st == 'beda') {
            $this->pelanggan->input_data('mst_bahan_baku', $data);
        }

        $bhn2 = $this->pelanggan->get_data_order('mst_bahan_baku', 'bahan_baku', 'asc')->result_array();

        $option = "";

        $option .= "<option value=''>Pilih Bahan Baku</option>";

        foreach ($bhn2 as $d) {
            $option .= "<option value='".$d['id']."'>".$d['bahan_baku']."</option>";
        }

        echo json_encode(['status' => $st, 'option' => $option]);
          
    }

    // 25-11-2020 && 27-11-2020
    public function simpan_produk()
    {
        $aksi               = $this->input->post('aksi');                              
        $id_produk          = $this->input->post('id_produk');   

        $id_umkm            = $this->input->post('id_umkm');                              
        $id_kategori        = $this->input->post('id_kategori');                              
        $nama_produk        = $this->input->post('nama_produk');                              
        $nama_kategori      = $this->input->post('nama_kategori');                            
        $harga_dasar        = $this->input->post('harga_dasar');                              
        $harga_jual         = $this->input->post('harga_jual');                           
        $discount           = $this->input->post('discount');                           
        $status_kategori    = $this->input->post('status_kategori');                             
        $status_bahan_baku  = $this->input->post('status_bahan_baku');                            
        $status_ukuran      = $this->input->post('status_ukuran');                            
        $status_topping     = $this->input->post('status_topping');                           
        $status_status      = $this->input->post('status_status');                           
        $status_stok        = $this->input->post('status_stok');                              
        $status_expired     = $this->input->post('status_expired');                              
        $status_split       = $this->input->post('status_split');             
        $status_tampil      = $this->input->post('status_tampil'); 
        
        $ukuran             = $this->input->post('ukuran');
        $harga_ukuran       = $this->input->post('harga_ukuran');           
        $topping            = $this->input->post('topping');
        $harga_topping      = $this->input->post('harga_topping');
        $status_s           = $this->input->post('status');
        $split              = $this->input->post('split');
        $komisi             = $this->input->post('komisi');
        $status_satuan      = $this->input->post('status_satuan');
        $isi_nama           = $this->input->post('isi_nama');
        $isi_satuan         = $this->input->post('isi_satuan');
        $tgl_expired        = $this->input->post('tgl_expired');
        $stok               = $this->input->post('stok');

        $id_stok            = $this->input->post('id_stok');
        $id_expire          = $this->input->post('id_expire');
        
        if ($status_kategori == 'lama') {

            $id_kategori = $id_kategori;

        } else {

            // cek kategori
            $cr_kat = $this->pelanggan->cari_data('mst_kategori', ['idumkm' => $id_umkm])->result_array();

            $nm_kat = strtolower(trim($nama_kategori));

            foreach ($cr_kat as $k) {

                $nm_kat2 = strtolower(trim($k['kategori']));

                if ($nm_kat2 == $nm_kat) {
                    $status = 'sama';
                    break;
                } else {
                    $status = 'beda';
                }
                
            }

            if ($status == 'beda') {
                // simpan kategori
                $data_k = [ 'idumkm'        => $id_umkm,
                            'kategori'      => $nama_kategori,
                            'status'        => 1,
                            'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                        ];

                $this->pelanggan->input_data('mst_kategori', $data_k);

                $id_kategori = $this->db->insert_id();
            } else {
                echo json_encode(['statusnya' => false, 'status_satuan' => true]);
                exit();
            }

        }

        $data = ['id_umkm'      => $id_umkm,
                 'nama'         => $nama_produk,
                 'hpp'          => $harga_dasar,
                 'harga'        => $harga_jual,
                 'id_kategori'  => $id_kategori,
                 'h_stok'       => $status_stok,
                 'h_split'      => $status_split,
                 'h_status'     => $status_status,
                 'h_topping'    => $status_topping,
                 'h_ukuran'     => $status_ukuran,
                 'h_resep'      => $status_bahan_baku,
                 'discount'     => $discount,
                 'image'        => null,
                 'status_tampil'=> $status_tampil,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->pelanggan->input_data('mst_produk', $data);

            $id_produk = $this->db->insert_id();
        } else {
            $this->pelanggan->ubah_data('mst_produk', $data, ['id' => $id_produk]);

            $id_produk = $id_produk;
        }

        if ($status_ukuran == 1) {

            if ($aksi == 'Ubah') {
                $this->pelanggan->hapus_data('mst_ukuran', ['id_produk' => $id_produk]);
            }

            for ($i=0; $i < count($ukuran); $i++) { 

                $data_ukuran = ['id_produk'     => $id_produk,
                                'ukuran'        => $ukuran[$i],
                                'harga'         => $harga_ukuran[$i],
                                'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_ukuran', $data_ukuran);
                
            }
        
        }

        if ($status_topping == 1) {

            if ($aksi == 'Ubah') {
                $this->pelanggan->hapus_data('mst_topping', ['id_produk' => $id_produk]);
            }

            for ($i=0; $i < count($topping); $i++) { 

                $data_topping = ['id_produk'    => $id_produk,
                                 'topping'      => $topping[$i],
                                 'harga'        => $harga_topping[$i],
                                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_topping', $data_topping);
                
            }
        
        }

        // 29-11-2020
        if ($status_status == 1) {

            if ($aksi == 'Ubah') {
                $this->pelanggan->hapus_data('mst_status', ['id_produk' => $id_produk]);
            }

            for ($i=0; $i < count($status_s); $i++) { 

                $data_status = [ 'id_produk'    => $id_produk,
                                 'status'       => $status_s[$i],
                                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_status', $data_status);
                
            }
        
        }

        // 27-11-2020
        if ($status_stok == 1) {

            if ($status_satuan == 'lama') {
                $id_satuan = $isi_satuan;

            } else {

                // cari satuan
                $cr_sat = $this->pelanggan->get_data_order('mst_satuan', 'id', 'asc')->result_array();

                $nm_sat = strtolower(trim($isi_nama));

                foreach ($cr_sat as $s) {

                    $nm_sat2 = strtolower(trim($s['satuan']));

                    if ($nm_sat2 == $nm_sat) {
                        $status_sat = 'sama';
                        break;
                    } else {
                        $status_sat = 'beda';
                    }
                    
                }

                if ($status_sat == 'beda') {
                    // simpan satuan
                    $data_satuan = [ 'satuan'        => $isi_nama,
                                     'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                   ];
    
                    $this->pelanggan->input_data('mst_satuan', $data_satuan);
    
                    $id_satuan = $this->db->insert_id();
                } else {
                    echo json_encode(['statusnya' => false, 'status_satuan' => false]);
                    exit();
                }
                
            }

            $data_stok = ['id_produk'       => $id_produk,
                          'stok'            => $stok,
                          'id_satuan'       => $id_satuan,
                          'h_expire_date'   => $status_expired,
                          'created_at'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                         ];

            if ($aksi == 'Tambah') {
                $this->pelanggan->input_data('mst_stok', $data_stok);
                $id_stok = $this->db->insert_id();
            } else {
                $this->pelanggan->ubah_data('mst_stok', $data_stok, ['id' => $id_stok]);
            }

            if ($status_expired == 1) {

                $data_expired = ['id_stok'      => $id_stok,
                                 'expire_date'  => $tgl_expired,
                                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                ];

                if ($aksi == 'Tambah') {
                    $this->pelanggan->input_data('mst_expire_date', $data_expired);
                } else {
                    $this->pelanggan->ubah_data('mst_expire_date', $data_expired, ['id' => $id_expire]);
                }
                
            }
            
        }

        // 27-11-2020
        if ($status_split == 1) {

            if ($aksi == 'Ubah') {
                $this->pelanggan->hapus_data('mst_split', ['id_produk' => $id_produk]);
            }

            for ($i=0; $i < count($split); $i++) { 

                $data_split = [ 'id_produk'     => $id_produk,
                                'split'         => $split[$i],
                                'harga'         => $komisi[$i],
                                'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_split', $data_split);
                
            }
        
        }

        $list_produk = $this->pelanggan->cari_data('mst_produk', ['id_umkm' => $id_umkm])->result_array();

        echo json_encode(['statusnya' => true,'id_produk' => $id_produk, 'jumlah' => count($list_produk)]);
    }

    // simpan
    public function simpan_produk_2()
    {
        $id_umkm            = $this->input->post('id_umkm');                              
        $id_kategori        = $this->input->post('id_kategori');                              
        $nama_produk        = $this->input->post('nama_produk');                              
        $nama_kategori      = $this->input->post('nama_kategori');                            
        $harga_dasar        = $this->input->post('harga_dasar');                              
        $harga_jual         = $this->input->post('harga_jual');                           
        $discount           = $this->input->post('discount');                           
        $status_kategori    = $this->input->post('status_kategori');                             
        $status_bahan_baku  = $this->input->post('status_bahan_baku');                            
        $status_ukuran      = $this->input->post('status_ukuran');                            
        $status_topping     = $this->input->post('status_topping');                           
        $status_status      = $this->input->post('status_status');                           
        $status_stok        = $this->input->post('status_stok');                              
        $status_expired     = $this->input->post('status_expired');                              
        $status_split       = $this->input->post('status_split');             
        $status_tampil      = $this->input->post('status_tampil'); 
        
        $ukuran             = $this->input->post('ukuran');
        $harga_ukuran       = $this->input->post('harga_ukuran');           
        $topping            = $this->input->post('topping');
        $harga_topping      = $this->input->post('harga_topping');
        $status_s           = $this->input->post('status');
        $split              = $this->input->post('split');
        $komisi             = $this->input->post('komisi');
        $status_satuan      = $this->input->post('status_satuan');
        $isi_nama           = $this->input->post('isi_nama');
        $isi_satuan         = $this->input->post('isi_satuan');
        $tgl_expired        = $this->input->post('tgl_expired');
        $stok               = $this->input->post('stok');
        
        if ($status_kategori == 'lama') {

            $id_kategori = $id_kategori;

        } else {

            // cek kategori
            $cr_kat = $this->pelanggan->cari_data('mst_kategori', ['idumkm' => $id_umkm])->result_array();

            $nm_kat = strtolower(trim($nama_kategori));

            foreach ($cr_kat as $k) {

                $nm_kat2 = strtolower(trim($k['kategori']));

                if ($nm_kat2 == $nm_kat) {
                    $status = 'sama';
                    break;
                } else {
                    $status = 'beda';
                }
                
            }

            if ($status == 'beda') {
                // simpan kategori
                $data_k = [ 'idumkm'        => $id_umkm,
                            'kategori'      => $nama_kategori,
                            'status'        => 1,
                            'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                        ];

                $this->pelanggan->input_data('mst_kategori', $data_k);

                $id_kategori = $this->db->insert_id();
            } else {
                echo json_encode(['statusnya' => false, 'status_satuan' => true]);
                exit();
            }

        }

        $data = ['id_umkm'      => $id_umkm,
                 'nama'         => $nama_produk,
                 'hpp'          => $harga_dasar,
                 'harga'        => $harga_jual,
                 'id_kategori'  => $id_kategori,
                 'h_stok'       => $status_stok,
                 'h_split'      => $status_split,
                 'h_status'     => $status_status,
                 'h_topping'    => $status_topping,
                 'h_ukuran'     => $status_ukuran,
                 'h_resep'      => $status_bahan_baku,
                 'discount'     => $discount,
                 'image'        => null,
                 'status_tampil'=> $status_tampil,
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        $this->pelanggan->input_data('mst_produk', $data);

        $id_produk = $this->db->insert_id();

        if ($status_ukuran == 1) {

            for ($i=0; $i < count($ukuran); $i++) { 

                $data_ukuran = ['id_produk'     => $id_produk,
                                'ukuran'        => $ukuran[$i],
                                'harga'         => $harga_ukuran[$i],
                                'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_ukuran', $data_ukuran);
                
            }
        
        }

        if ($status_topping == 1) {

            for ($i=0; $i < count($topping); $i++) { 

                $data_topping = ['id_produk'    => $id_produk,
                                 'topping'      => $topping[$i],
                                 'harga'        => $harga_topping[$i],
                                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_topping', $data_topping);
                
            }
        
        }

        // 29-11-2020
        if ($status_status == 1) {

            for ($i=0; $i < count($status_s); $i++) { 

                $data_status = [ 'id_produk'    => $id_produk,
                                 'status'       => $status_s[$i],
                                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_status', $data_status);
                
            }
        
        }

        // 27-11-2020
        if ($status_stok == 1) {

            if ($status_satuan == 'lama') {
                $id_satuan = $isi_satuan;

            } else {

                // cari satuan
                $cr_sat = $this->pelanggan->get_data_order('mst_satuan', 'id', 'asc')->result_array();

                $nm_sat = strtolower(trim($isi_nama));

                foreach ($cr_sat as $s) {

                    $nm_sat2 = strtolower(trim($s['satuan']));

                    if ($nm_sat2 == $nm_sat) {
                        $status_sat = 'sama';
                        break;
                    } else {
                        $status_sat = 'beda';
                    }
                    
                }

                if ($status_sat == 'beda') {
                    // simpan satuan
                    $data_satuan = [ 'satuan'        => $isi_nama,
                                     'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                   ];
    
                    $this->pelanggan->input_data('mst_satuan', $data_satuan);
    
                    $id_satuan = $this->db->insert_id();
                } else {
                    echo json_encode(['statusnya' => false, 'status_satuan' => false]);
                    exit();
                }
                
            }

            $data_stok = ['id_produk'       => $id_produk,
                          'stok'            => $stok,
                          'id_satuan'       => $id_satuan,
                          'h_expire_date'   => $status_expired,
                          'created_at'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                         ];
                        
            $this->pelanggan->input_data('mst_stok', $data_stok);
            $id_stok = $this->db->insert_id();

            if ($status_expired == 1) {

                $data_expired = ['id_stok'      => $id_stok,
                                 'expire_date'  => $tgl_expired,
                                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                ];
                
                $this->pelanggan->input_data('mst_expire_date', $data_expired);
            }
            
        }

        // 27-11-2020
        if ($status_split == 1) {

            for ($i=0; $i < count($split); $i++) { 

                $data_split = [ 'id_produk'     => $id_produk,
                                'split'         => $split[$i],
                                'harga'         => $komisi[$i],
                                'created_at'    => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                               ];

                $this->pelanggan->input_data('mst_split', $data_split);
                
            }
        
        }

        $list_produk = $this->pelanggan->cari_data('mst_produk', ['id_umkm' => $id_umkm])->result_array();

        echo json_encode(['statusnya' => true,'id_produk' => $id_produk, 'jumlah' => count($list_produk)]);
    }

    // 25-11-2020
    public function hapus_produk()
    {
        $id_produk = $this->input->post('id_produk');

        $this->db->trans_start(); 
        $this->db->trans_strict(FALSE);

        $this->pelanggan->hapus_data('mst_produk', ['id' => $id_produk]);
        $this->pelanggan->hapus_data('mst_split', ['id_produk' => $id_produk]);
        $this->pelanggan->hapus_data('mst_status', ['id_produk' => $id_produk]);
        $this->pelanggan->hapus_data('mst_stok', ['id_produk' => $id_produk]);
        $this->pelanggan->hapus_data('mst_topping', ['id_produk' => $id_produk]);
        $this->pelanggan->hapus_data('mst_ukuran', ['id_produk' => $id_produk]);
        $this->pelanggan->hapus_data('trn_resep', ['id_produk' => $id_produk]);

        $this->db->trans_complete(); 

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(['status' => false]);
        } 
        else {
            $this->db->trans_commit();
            echo json_encode(['status' => true]);
        }
        
    }

	public function detail($id, $tab = null)
	{
		$produk = $this->produk->get($id)->row();
		$data 	= [
			'title'			=> $produk->nama,
			'row'			=> $this->produk->get($id)->row(),
            'tab'           => $tab,
            'kategori'      => $this->kategori->get()->result(),
            'isi'			=> 'produk/detail'
		];
		$this->load->view('template/wrapper', $data);
	}

	public function read()
	{
		$list 	= $this->produk->read();
		$data 	= [];
		$no		= 1;
		foreach($list as $produk)
		{
            $this->db->select('stok');
            $this->db->from('mst_stok');
            $this->db->where('id_produk', $produk->id);
            
            $st = $this->db->get()->row_array();
            
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= $produk->nama;
            $row[]	= ($st['stok'] == null) ? 0 : $st['stok'];
            $row[] 	= 'Rp. '.number_format($produk->hpp);
            $row[] 	= 'Rp. '.number_format($produk->harga);
            $row[]  = '<a href="'.base_url('Produk/detail/'.$produk->id).'" class="mr-2 btn btn-info"><i class="fas fa-info-circle"></i></a>
            			<a href="javascript:void(0)" class="mr-2 btn btn-success" onClick="update_data('."'".$produk->id."'".')"><i class="far fa-edit"></i></a>
            			<a class="mr-2 btn btn-danger hapus" href="javascript:void(0)" title="Hapus" onClick="delete_data('."'".$produk->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->produk->count_all(),
                    "recordsFiltered" 	=> $this->produk->count_filtered(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function get($id)
    {
        $data = $this->produk->get($id)->row();
        echo json_encode($data);
    }

    public function get_detail($id)
    {
        $data = $this->produk->get_detail($id);
        echo json_encode($data);
    }

    public function get_detail_tanpa_stok($id)
    {
        $data = $this->produk->get_detail_tanpa_stok($id);
        echo json_encode($data);
    }

	public function create()
	{
		$this->_validate();
		$data = [
			'id_umkm'		=> $this->session->userdata('id_umkm'),
			'nama'			=> $this->input->post('nama'),
			'hpp'			=> str_replace(',', '', $this->input->post('hpp')),
			'harga'			=> str_replace(',', '', $this->input->post('harga')),
			'id_kategori'	=> $this->input->post('id_kategori'),
			'h_stok'		=> $this->input->post('h_stok') ? $this->input->post('h_stok') : 0,
			'h_topping'		=> $this->input->post('h_topping') ? $this->input->post('h_topping') : 0,
			'h_ukuran'		=> $this->input->post('h_ukuran') ? $this->input->post('h_ukuran') : 0,
			'h_split'		=> $this->input->post('h_split') ? $this->input->post('h_split') : 0,
			'h_status'		=> $this->input->post('h_status') ? $this->input->post('h_status') : 0,
			'discount'		=> $this->input->post('discount') ? str_replace(',', '', $this->input->post('discount')) : null,
			'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
		];
		// if(!empty($_FILES['image']['name']))
        // {
        //     $upload = $this->_do_upload();
        //     $data['image'] = $upload;
        // }
        $id = $this->produk->create($data);
        if($this->input->post('h_stok') > 0)
        {
        	$data_stok = [
        		'id_produk'		=> $id,
        		'stok'			=> 0,
        		'created_at'	=> date("Y-m-d h:i:s", now('Asia/Jakarta'))
        	];
        	$this->db->insert('mst_stok', $data_stok);
        }
        echo json_encode(array("status" => TRUE, "id_produk" => $id));
	}

	public function update()
	{
		$this->_validate_update();
		$produk 	= $this->produk->get($this->input->post('id'))->row();
		$data = [
			'nama'			=> $this->input->post('nama'),
			'hpp'			=> str_replace(',', '', $this->input->post('hpp')),
			'harga'			=> str_replace(',', '', $this->input->post('harga')),
			'id_kategori'	=> $this->input->post('id_kategori'),
			'h_stok'		=> $this->input->post('h_stok') ? $this->input->post('h_stok') : 0,
			'h_topping'		=> $this->input->post('h_topping') ? $this->input->post('h_topping') : 0,
			'h_ukuran'		=> $this->input->post('h_ukuran') ? $this->input->post('h_ukuran') : 0,
			'h_split'		=> $this->input->post('h_split') ? $this->input->post('h_split') : 0,
			'h_status'		=> $this->input->post('h_status') ? $this->input->post('h_status') : 0,
			'discount'		=> $this->input->post('discount') ? str_replace(',', '', $this->input->post('discount')) : null
		];
		// if(!empty($_FILES['image']['name']))
        // {
        //     $upload = $this->_do_upload();
        //     if($produk->image)
        //     {
        //         unlink('assets/img/upload/produk/'.$produk->image); 
        //     }
        //     $data['image'] = $upload;
        // }
        $this->produk->update(['id' => $this->input->post('id')], $data);
        echo json_encode(array("status" => TRUE, "id_produk" => $this->input->post('id')));
		
	}

    public function proses_update()
    {
        $produk     = $this->produk->get($this->input->post('id'))->row();
        $data = [
            'nama'          => $this->input->post('nama'),
            'hpp'           => str_replace(',', '', $this->input->post('hpp')),
            'harga'         => str_replace(',', '', $this->input->post('harga')),
            'id_kategori'   => $this->input->post('id_kategori'),
            'h_stok'        => $this->input->post('h_stok') ? $this->input->post('h_stok') : 0,
            'h_topping'     => $this->input->post('h_topping') ? $this->input->post('h_topping') : 0,
            'h_ukuran'      => $this->input->post('h_ukuran') ? $this->input->post('h_ukuran') : 0,
            'h_split'       => $this->input->post('h_split') ? $this->input->post('h_split') : 0,
            'h_status'      => $this->input->post('h_status') ? $this->input->post('h_status') : 0,
            'discount'      => $this->input->post('discount') ? str_replace(',', '', $this->input->post('discount')) : null
        ];
        // if(!empty($_FILES['image']['name']))
        // {
        //     $upload = $this->_do_upload();
        //     if($produk->image)
        //     {
        //         unlink('assets/img/upload/produk/'.$produk->image); 
        //     }
        //     $data['image'] = $upload;
        // }
        $this->produk->update(['id' => $this->input->post('id')], $data);
        // $this->session->set_flashdata("sukses", '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Data Produk berhasil Disunting!</div></div>');
        // redirect('Produk/detail/'.$this->input->post('id'),'refresh');

        $t_berhasil = '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Data Produk berhasil Disunting!</div></div>';

        echo json_encode(['id_produk' => $this->input->post('id'), 't_berhasil' => $t_berhasil]);
    }

	public function delete()
    {
    	$produk 	= $this->produk->get($this->input->post('id'))->row();
    	if($produk->image)
        {
            unlink('assets/img/upload/produk/'.$produk->image); 
        }
        $this->produk->delete($this->input->post('id'));
        echo json_encode(array("status" => TRUE));
    }

	private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/upload/produk/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['file_name']            = str_replace(' ', '-', $this->input->post('nama')).'-'.date('dmY');
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('image'))
        {
            $data['inputerror'][] = 'image';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

	private function _validate()
    {
        $data   = array();
        $post   = $this->input->post();
        $query  = $this->db->query("SELECT * FROM mst_produk WHERE nama = '$post[nama]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Produk belum Diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Produk '.$post['nama'].' sudah Digunakan';
            $data['status'] = FALSE;
        }
        if($this->input->post('hpp') == '')
        {
            $data['inputerror'][] = 'hpp';
            $data['error_string'][] = 'HPP belum Diisi';
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
        $query	= $this->db->query("SELECT * FROM mst_produk WHERE nama = '$post[nama]' AND id != '$post[id]'");
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Produk belum Diisi';
            $data['status'] = FALSE;
        }
        if ($query->num_rows() > 0) 
		{
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Nama Produk '.$post['nama'].' sudah Digunakan';
            $data['status'] = FALSE;
		}
        if($this->input->post('hpp') == '')
        {
            $data['inputerror'][] = 'hpp';
            $data['error_string'][] = 'HPP belum Diisi';
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


}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */