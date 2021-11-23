<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('masuk'))) {
			redirect('Login','refresh');
		}

		$this->id_umkm 	= $this->session->userdata('id_umkm');
		$this->nama		= $this->session->userdata('nama');
		$this->hal		= $this->session->userdata('hal');
	}

	// 11-09-2020

	public function index()
	{
		$this->page('off');
	}

	public function simpan_data_umkm()
	{
		$aksi 			= $this->input->post('aksi');
		$nama_umkm 		= $this->input->post('nama_umkm');
		$nama_owner 	= $this->input->post('nama_owner');
		$telp 			= $this->input->post('telp');
		$alamat 		= $this->input->post('alamat');
		$id   			= $this->input->post('id_umkm');
		$id_investor	= $this->input->post('id_investor');
		$id_kat_usaha	= $this->input->post('jns_usaha');

		$data = ['nama'         => $nama_umkm,
				 'namaowner'	=> $nama_owner,
				 'alamat'       => $alamat,
				 'telp'         => $telp,
				 'id_investor'  => 0,
				 'idkategori'	=> $id_kat_usaha,
				 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
				];
		
		if ($aksi == 'Tambah') {
			$this->pelanggan->input_data('mst_umkm', $data);
		} elseif ($aksi == 'Ubah') {
			$this->pelanggan->ubah_data('mst_umkm', $data, ['id' => $id]);
		} else {
			$this->pelanggan->hapus_data('mst_umkm', ['id' => $id]);
		}
		
		echo json_encode($data);
	}

	public function ambil_data_umkm($id)
	{
		$data = $this->pelanggan->cari_data('mst_umkm', ['id' => $id])->row_array();

		echo json_encode($data);
	}

	public function tampil_data_umkm()
	{
		$list = $this->home->get_data_umkm();

		$data = array();

		$no   = $this->input->post('start');

		foreach ($list as $o) {
			$no++;
			$tbody = array();

			$href = base_url()."Home/page/off/".$o['id']."/detail_off";

			$a = $this->pelanggan->cari_data('mst_kat_usaha', ['id' => $o['idkategori']])->row_array();

			$tbody[]    = "<div align='center'>".$no.".</div>";
			$tbody[]    = $o['nama'];
			$tbody[]    = $o['namaowner'];
			$tbody[]    = $o['telp'];
			$tbody[]    = $o['alamat'];
			$tbody[]    = "<a href='javascript:;' class='btn btn-icon btn-success mr-2 edit-umkm' data-id='".$o['id']."' jenis='".$a['jenis']."' id_kat='".$o['idkategori']."'><i class='far fa-edit'></i></a><a href='javascript:;' class='btn btn-icon btn-danger mr-2 hapus-umkm' data-id='".$o['id']."' umkm='".$o['nama']."'><i class='fa fa-trash'></i></a><a href='$href' class='btn btn-icon btn-info mr-2 detail-umkm' data-id='".$o['id']."'><i class='fas fa-angle-double-right'></i></a>";
			$data[]     = $tbody;
		}

		$output = [ "draw"             => $_POST['draw'],
					"recordsTotal"     => $this->home->jumlah_semua_umkm(),
					"recordsFiltered"  => $this->home->jumlah_filter_umkm(),   
					"data"             => $data
				];

		echo json_encode($output);
	}

	// 11-11-2020
	public function page($aksi = 'off', $id = '', $hal = '')
	{
		if ($aksi == 'on' && $id == '') {
			$this->page_on();
		} else {
			if ($hal == '') {
				$t_hal 	= '';
				if ($this->nama == 'Bagja') {
					$idk 	= 0;
				} else {
					$idk	= $this->id_umkm;
				}
			} else {
				$t_hal 	= 'detail off';
				$idk 	= $id;
			}

			$array = array(
				'page' 		=> 'off',
				'hal'		=> $t_hal,
				'user'		=> 'admin',
				'id_umkm' 	=> $idk
			);
			
			$this->session->set_userdata( $array );

			$this->page_off($idk);
		}
	}

	// 11-11-2020
	public function page_on()
	{
		
		$array = array(
			'page' 	=> 'off',
			'user'	=> 'admin'
		);
		
		$this->session->set_userdata( $array );

		$data 	= [	'title'		=> 'Home',
					'isi'		=> 'home_page_off',
					'investor'	=> $this->pelanggan->get_data_order('mst_investor', 'username', 'asc')->result_array(),
					'kat_usaha'	=> $this->home->get_kat_usaha()->result_array()
				  ];

		$this->load->view('template/wrapper', $data);
		
	}

	// 11-11-2020
	public function page_off($id)
	{
		$array = array(
			'page' 		=> 'on',
		);
		
		$this->session->set_userdata( $array );

		$bln = array();
		$day = array();

        $skrg 	= date("Y-m", now('Asia/Jakarta'));
        $skrg_t = date("Y-m-d", now('Asia/Jakarta'));

        for ($i=4; $i >= 1; $i--) { 

            $a = date('Y-m', strtotime("$skrg -$i months"));
			array_push($bln, nice_date($a, 'M Y'));
			
            $b = date('Y-m-d', strtotime("$skrg_t -$i days"));
			array_push($day, nice_date($b, 'd-M-Y'));
			
		}

		array_push($bln, nice_date($skrg, 'M Y'));
		array_push($day, nice_date($skrg_t, 'd-M-Y'));

		// foreach ($bln as $b) {
		// 	$bulan[] = $b;
		// }
		// foreach ($day as $d) {
		// 	$hari[] = $d;
		// }

		// hari

		$pendapatan_h 	= array();
		$keuntungan_h 	= array();
		$pengeluaran_h 	= array();

		foreach ($day as $d) {

			$tgl = nice_date($d, 'Y-m-d');

			// hitung sisa piutang
			$pl = $this->home->get_tot_transaksi($tgl, $id)->result_array();

			$tot_sisa_piutang = 0;

			foreach ($pl as $p) {
				
				// cari sisa piutang
				$sisa  = $this->home->get_sisa_piutang($tgl, $p['id_pelanggan'], $id)->row_array();

				$tot_sisa_piutang += $sisa['sisa_piutang'];

			}

			$tt_pendapatan	= $this->home->get_tot_pendapatan_pengeluran($tgl, 'Pemasukan', $id);
			$tt_pengeluaran = $this->home->get_tot_pendapatan_pengeluran($tgl, 'Pengeluaran', $id);

			$pendapatan = $tt_pendapatan - $tot_sisa_piutang;
			$keuntungan = $pendapatan - $tt_pengeluaran;

			array_push($pendapatan_h, $pendapatan);
			array_push($keuntungan_h, $keuntungan);
			array_push($pengeluaran_h, ($tt_pengeluaran == null) ? 0 : $tt_pengeluaran);
		}

		// bulan

		$pendapatan_b 	= array();
		$keuntungan_b 	= array();
		$pengeluaran_b 	= array();

		foreach ($bln as $b) {

			$month = nice_date($b, 'Y-m');

			// hitung sisa piutang
			$pl = $this->home->get_tot_transaksi_bulan($month, $id)->result_array();

			$tot_sisa_piutang_bln = 0;

			foreach ($pl as $p) {
				
				// cari sisa piutang
				$sisa  = $this->home->get_sisa_piutang_bulan($month, $p['id_pelanggan'], $id)->row_array();

				$tot_sisa_piutang_bln += $sisa['sisa_piutang'];

			}

			$tt_pendapatan_bln	= $this->home->get_tot_pendapatan_pengeluran_bulan($month, 'Pemasukan', $id);
			$tt_pengeluaran_bln = $this->home->get_tot_pendapatan_pengeluran_bulan($month, 'Pengeluaran', $id);

			$pendapatan_bln = $tt_pendapatan_bln - $tot_sisa_piutang_bln;
			$keuntungan_bln = $pendapatan_bln - $tt_pengeluaran_bln;

			array_push($pendapatan_b, $pendapatan_bln);
			array_push($keuntungan_b, $keuntungan_bln);
			array_push($pengeluaran_b, ($tt_pengeluaran_bln == null) ? 0 : $tt_pengeluaran_bln);
		}

		// echo "<pre>";
		// print_r($pengeluaran_a);
		// echo "</pre>";
		// die();

		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id])->row_array();

		$data 	= [
			'title'				=> 'Dashboard',
			'isi'				=> 'home',
			'bln'				=> $bln,
			'day'				=> $day,
			'pendapatan_h'		=> $pendapatan_h,
			'keuntungan_h'		=> $keuntungan_h,
			'pengeluaran_h'		=> $pengeluaran_h,
			'tot_pendapatan_h'	=> array_sum($pendapatan_h),
			'tot_keuntungan_h'	=> array_sum($keuntungan_h),
			'tot_pengeluaran_h'	=> array_sum($pengeluaran_h),
			'pendapatan_b'		=> $pendapatan_b,
			'keuntungan_b'		=> $keuntungan_b,
			'pengeluaran_b'		=> $pengeluaran_b,
			'tot_pendapatan_b'	=> array_sum($pendapatan_b),
			'tot_keuntungan_b'	=> array_sum($keuntungan_b),
			'tot_pengeluaran_b'	=> array_sum($pengeluaran_b),
			'umkm'				=> $this->pelanggan->get_data_order('mst_umkm', 'nama', 'asc')->result_array(),
			'user'      		=> $this->nama,
			'nama_umkm' 		=> $nm['nama'],
			'hal'				=> $this->hal,
			'id_umkm'			=> $id
		];

		$this->load->view('template/wrapper', $data);
	}

	// 07-12-2020
	public function tampil_filter_home()
	{
		$id = $this->input->post('id_umkm');
		
		$bln = array();
		$day = array();

        $skrg 	= date("Y-m", now('Asia/Jakarta'));
        $skrg_t = date("Y-m-d", now('Asia/Jakarta'));

        for ($i=4; $i >= 1; $i--) { 

            $a = date('Y-m', strtotime("$skrg -$i months"));
			array_push($bln, nice_date($a, 'M Y'));
			
            $b = date('Y-m-d', strtotime("$skrg_t -$i days"));
			array_push($day, nice_date($b, 'd-M-Y'));
			
		}

		array_push($bln, nice_date($skrg, 'M Y'));
		array_push($day, nice_date($skrg_t, 'd-M-Y'));

		// foreach ($bln as $b) {
		// 	$bulan[] = $b;
		// }
		// foreach ($day as $d) {
		// 	$hari[] = $d;
		// }

		// hari

		$pendapatan_h 	= array();
		$keuntungan_h 	= array();
		$pengeluaran_h 	= array();

		foreach ($day as $d) {

			$tgl = nice_date($d, 'Y-m-d');

			// hitung sisa piutang
			$pl = $this->home->get_tot_transaksi($tgl, $id)->result_array();

			$tot_sisa_piutang = 0;

			foreach ($pl as $p) {
				
				// cari sisa piutang
				$sisa  = $this->home->get_sisa_piutang($tgl, $p['id_pelanggan'], $id)->row_array();

				$tot_sisa_piutang += $sisa['sisa_piutang'];

			}

			$tt_pendapatan	= $this->home->get_tot_pendapatan_pengeluran($tgl, 'Pemasukan', $id);
			$tt_pengeluaran = $this->home->get_tot_pendapatan_pengeluran($tgl, 'Pengeluaran', $id);

			$pendapatan = $tt_pendapatan - $tot_sisa_piutang;
			$keuntungan = $pendapatan - $tt_pengeluaran;

			array_push($pendapatan_h, $pendapatan);
			array_push($keuntungan_h, $keuntungan);
			array_push($pengeluaran_h, ($tt_pengeluaran == null) ? 0 : $tt_pengeluaran);
		}

		// bulan

		$pendapatan_b 	= array();
		$keuntungan_b 	= array();
		$pengeluaran_b 	= array();

		foreach ($bln as $b) {

			$month = nice_date($b, 'Y-m');

			// hitung sisa piutang
			$pl = $this->home->get_tot_transaksi_bulan($month, $id)->result_array();

			$tot_sisa_piutang_bln = 0;

			foreach ($pl as $p) {
				
				// cari sisa piutang
				$sisa  = $this->home->get_sisa_piutang_bulan($month, $p['id_pelanggan'], $id)->row_array();

				$tot_sisa_piutang_bln += $sisa['sisa_piutang'];

			}

			$tt_pendapatan_bln	= $this->home->get_tot_pendapatan_pengeluran_bulan($month, 'Pemasukan', $id);
			$tt_pengeluaran_bln = $this->home->get_tot_pendapatan_pengeluran_bulan($month, 'Pengeluaran', $id);

			$pendapatan_bln = $tt_pendapatan_bln - $tot_sisa_piutang_bln;
			$keuntungan_bln = $pendapatan_bln - $tt_pengeluaran_bln;

			array_push($pendapatan_b, $pendapatan_bln);
			array_push($keuntungan_b, $keuntungan_bln);
			array_push($pengeluaran_b, ($tt_pengeluaran_bln == null) ? 0 : $tt_pengeluaran_bln);
		}

		$data 	= [
			'title'				=> 'Dashboard',
			'isi'				=> 'home',
			'bln'				=> $bln,
			'day'				=> $day,
			'pendapatan_h'		=> $pendapatan_h,
			'keuntungan_h'		=> $keuntungan_h,
			'pengeluaran_h'		=> $pengeluaran_h,
			'tot_pendapatan_h'	=> array_sum($pendapatan_h),
			'tot_keuntungan_h'	=> array_sum($keuntungan_h),
			'tot_pengeluaran_h'	=> array_sum($pengeluaran_h),
			'pendapatan_b'		=> $pendapatan_b,
			'keuntungan_b'		=> $keuntungan_b,
			'pengeluaran_b'		=> $pengeluaran_b,
			'tot_pendapatan_b'	=> array_sum($pendapatan_b),
			'tot_keuntungan_b'	=> array_sum($keuntungan_b),
			'tot_pengeluaran_b'	=> array_sum($pengeluaran_b),
			'umkm'				=> $this->pelanggan->get_data_order('mst_umkm', 'nama', 'asc')->result_array()
		];

		$this->load->view('home_filter', $data);
	}

	// 12-11-2020
	public function ambil_list_nama_kategori()
	{
		$jenis 	= $this->input->post('jenis');
		$id_kat = $this->input->post('id_kategori');

		$option = "";
		if ($jenis != '') {

			$pl = $this->pelanggan->cari_data('mst_kat_usaha', ['jenis' => $jenis])->result_array();

			$option = "<option value=''>Pilih Jenis</option>";

			foreach ($pl as $d) {

				if ($id_kat == $d['id']) {
					$sel = 'selected';
				} else {
					$sel = '';
				}

				$option .= "<option value='".$d['id']."' $sel>".$d['nama']."</option>";
			}
		} else {
			$option = "<option value=''>Pilih Jenis</option>";
		}
		
        echo json_encode(['status' => true, 'list_nama_kategori' => $option, 'id_kat' => $id_kat]);
	}

	public function tes()
	{
		$bln = array();
		$day = array();

        $skrg 	= date("Y-m", now('Asia/Jakarta'));
        $skrg_t = date("Y-m-d", now('Asia/Jakarta'));

        for ($i=5; $i >= 1; $i--) { 

            $a = date('Y-m', strtotime("$skrg -$i months"));
			array_push($bln, nice_date($a, 'M Y'));
			
            $b = date('Y-m-d', strtotime("$skrg_t -$i days"));
			array_push($day, nice_date($b, 'd-M-Y'));
			
		}

		foreach ($bln as $b) {
			$bulan[] = $b;
		}
		foreach ($day as $d) {
			$hari[] = $d;
		}
		
		echo json_encode($hari);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */