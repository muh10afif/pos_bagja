<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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

	public function penjualan()
	{
		if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'laporan/penjualan/V_lihat_admin';
        } else {
            $isi = 'laporan/penjualan/V_penjualan';
		}

		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();
		
		$pendapatan			= $this->laporan->get_total_penjualan();
		$pengeluaran 		= $this->laporan->get_total_pengeluaran();
		$data 	= [
			'title'			=> 'Laporan Penjualan',
			'crumb'			=> 'Laporan',
			'pendapatan'	=> $pendapatan,
			'pengeluaran'	=> $pengeluaran,
			'belanja'		=> $this->laporan->get_transaksi_penjualan()->num_rows(),
			'row'			=> $this->laporan->get_transaksi_penjualan()->result(),
			'isi'			=> $isi,
			'id_umkm'   	=> $this->id_umkm,
			'user'      	=> $this->nama,
			'nama_umkm'		=> $nm['nama'],
			'hal'			=> $this->hal
		];

		$this->load->view('template/wrapper', $data);
	}

	// 03-12-2020
    public function tampil_umkm_penjualan()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->laporan->get_data_umkm_penjualan($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
			$tbody = array();
			
            $url = base_url()."Laporan/detail_umkm/".$o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = "<div align='right' class='font-weight-bold'><span style='font-size:15px;' class=' font-weight-bold'>".number_format($o['total_pendapatan'],0,'.','.')."</span></div>";
            // $tbody[]    = "<div align='right' class='font-weight-bold'><span style='font-size:15px;' class=' font-weight-bold'>".number_format($o['total_pengeluaran'],0,'.','.')."</span></div>";
            $tbody[]    = "<div align='right' class='font-weight-bold'><span style='font-size:15px;' class=' font-weight-bold'>".number_format($o['keuntungan'],0,'.','.')."</span></div>";
            $tbody[]    = "<a href='$url' class='btn btn-warning'>Detail</a>";

            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->laporan->jumlah_semua_umkm_penjualan($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->laporan->jumlah_filter_umkm_penjualan($tgl_awal, $tgl_akhir),   
                    "data"             => $data
                ];

        echo json_encode($output);
        
	}
	
	// 03-12-2020
	public function detail_umkm($id_umkm)
	{
		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data 	= [
            'title'     => 'Laporan Penjualan',
            'isi'       => 'laporan/penjualan/V_penjualan',
            'id_umkm'   => $id_umkm,
            'user'      => $this->nama,
			'nama_umkm' => $nm['nama'],
			'hal'		=> $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
	}

	// 09-09-2020 & 03-12-2020 & 04-12-2020
	public function tampil_penjualan()
	{
		$date_rg    	= $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = "";
            $tgl_akhir = "";
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
		}
		
        $list = $this->laporan->get_data_penjualan($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

		$pendapatan = 0;

        foreach ($list as $o) {
            $no++;
			$tbody = array();

			$tbody[]    = "<div align='center'>".$no.".</div>";
			$tbody[]	= nice_date($o['created_at'], 'd-m-Y');
            $tbody[]    = $o['code_trn'];
            $tbody[]    = "<div align='right'>".number_format($o['total'],0,'.','.')."</div>";
            $tbody[]    = "<button class='btn btn-warning btn-sm detail_trn' id_trn='".$o['id']."'>Detail</button>";

			$data[]     = $tbody;
			
		}

		$cr = $this->laporan->count_detail_penjualan($tgl_awal, $tgl_akhir)->result_array();

		foreach ($cr as $c) {
			$pendapatan += $c['total'];
		}
		
		// cari pengeluaran
		$cr_p = $this->laporan->cari_pengeluaran($tgl_awal, $tgl_akhir)->row_array();

		$keuntungan = $pendapatan - $cr_p['total_tr_peng'];

        $output = [ "draw"             	=> $_POST['draw'],
                    "recordsTotal"     	=> $this->laporan->jumlah_semua_penjualan($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  	=> $this->laporan->jumlah_filter_penjualan($tgl_awal, $tgl_akhir),   
					"data"             	=> $data,
					"transaksi"			=> count($list),
					"pendapatan"		=> number_format($pendapatan,0,'.','.'),
					"keuntungan"		=> number_format($keuntungan,0,'.','.')
                   ];

        echo json_encode($output);
	}

	// 09-09-2020

	public function ambil_total_penjualan()
	{
		$date_rg    	= $this->input->post('tanggal');

        if (count($date_rg) == 1) {
            $tgl_awal  = "";
            $tgl_akhir = "";
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
		}

		// hitung sisa piutang
		$pl = $this->laporan->get_tot_transaksi($tgl_awal, $tgl_akhir)->result_array();

		$tot_sisa_piutang = 0;

		foreach ($pl as $p) {
			
			// cari sisa piutang
			$sisa  = $this->laporan->get_sisa_piutang($tgl_awal, $tgl_akhir, $p['id_pelanggan'])->row_array();

			$tot_sisa_piutang += $sisa['sisa_piutang'];

		}

		$tt_pendapatan	= $this->laporan->get_tot_pendapatan($tgl_awal, $tgl_akhir);
		$tt_pengeluaran = $this->laporan->get_tot_pengeluaran($tgl_awal, $tgl_akhir);

		$pendapatan = $tt_pendapatan - $tot_sisa_piutang;
		$keuntungan = $pendapatan - $tt_pengeluaran;

		$data = [
				'tot_transaksi'		=> $this->laporan->get_tot_transaksi($tgl_awal, $tgl_akhir)->num_rows(),
				'tot_pendapatan'	=> $pendapatan,
				'tot_keuntungan'	=> $keuntungan
				];
				
		echo json_encode($data);
	}

	// 10-09-2020

	public function tampilan_detail_transaksi()
    {
        $id_tr = $this->input->post('id_tr');

		$li = $this->transaksi->cari_data('trn_transaksi', ['id' => $id_tr])->row_array();
		$ct = $this->transaksi->cari_data('trn_piutang', ['idtransaksi' => $id_tr])->row_array();

        $data   = ['id_tr'       => $id_tr,
                   'trn'         => $li,
                   'list'        => $this->transaksi->cari_data('trn_detail_pemasukan', ['id_transaksi' => $id_tr])->result_array(),
				   'nama_plg'    => $this->transaksi->cari_data('mst_pelanggan', ['id' => $li['id_pelanggan']])->row_array(),
				   'cr_piutang'	 => $ct
                  ];

        $this->load->view('laporan/V_detail_penjualan', $data);
	}
	
	// 10-09-2020

	public function download_file_penjualan()
	{
		$tanggal_range 	= $this->input->post('tanggal_range');
		$jenis 			= $this->input->post('jenis');
		$id_umkm 		= $this->input->post('id_umkm');

		// cari tanggal sejak awal penjualan
		$tgl_awal_penjualan = $this->laporan->cari_tanggal_awal('Pemasukan', $id_umkm)->row_array();

		if ($tanggal_range == '') {

			$tgl_awal	= $tgl_awal_penjualan['tanggal'];
			$tgl_akhir	= date("Y-m-d", now('Asia/Jakarta'));

		} else {

			$tgl_r = explode(" - ", $tanggal_range);

			$tgl_awal	= $tgl_r[0];
			$tgl_akhir 	= $tgl_r[1];

		}

		$data   = [ 'report'        => 'Report Penjualan',
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
                    'jenis'         => $jenis,
                    'judul'         => 'Report Penjualan',
                    'transaksi'     => $this->laporan->get_transaksi_cetak($tgl_awal, $tgl_akhir, 'Pemasukan', $id_umkm)->result_array()
                  ]; 

        if ($jenis == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", 'laporan/V_export_penjualan', $data);

        } else {

			ob_start();
            $this->load->view('laporan/V_export_penjualan', $data);
            $html = ob_get_contents();
            // var_dump($html);die();
                ob_end_clean();
                require_once('./assets/html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
            $pdf->WriteHTML($html);
            $pdf->Output('Laporan Penjualan.pdf', 'FI');

		}
	}

	public function read_penjualan()
	{
		$list 	= $this->laporan->read_penjualan();
		$data 	= [];
		$no		= 1;
		foreach($list as $laporan)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= date('d-m-Y', strtotime($laporan->created_at));
            $row[]	= $laporan->code_trn;
            $row[]	= 'Rp. '.number_format($laporan->bayar);
            $row[]  = '<a href="javascript:;" class="btn btn-xs btn-info" data-toggle="modal" data-target="#detail'.$laporan->id.'"><i class="fas fa-info-circle"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->laporan->count_all_penjualan(),
                    "recordsFiltered" 	=> $this->laporan->count_filtered_penjualan(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function piutang()
	{
		if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'laporan/piutang/V_lihat_admin';
        } else {
            $isi = 'laporan/piutang/V_piutang';
		}

		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

		$data 	= [
			'title'		=> 'Laporan Piutang',
			'crumb'		=> 'Laporan',
			'pelanggan'	=> $this->laporan->cari_data('mst_pelanggan', ['idumkm'	=> $this->id_umkm])->result_array(),
			'isi'		=> $isi,
			'id_umkm'   => $this->id_umkm,
			'user'      => $this->nama,
			'nama_umkm'	=> $nm['nama'],
			'hal'		=> $this->hal
		];
		$this->load->view('template/wrapper', $data);
	}

	// 03-12-2020
    public function tampil_umkm_piutang()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->laporan->get_data_umkm_piutang($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
			$tbody = array();
			
            $url = base_url()."Laporan/detail_umkm_pi/".$o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = "<div align='right' class='font-weight-bold'><span style='font-size:15px;' class=' badge badge-light font-weight-bold'>".number_format($o['total_piutang'],0,'.','.')."</span></div>";
            $tbody[]    = "<a href='$url' class='btn btn-warning'>Detail</a>";

            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->laporan->jumlah_semua_umkm_piutang($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->laporan->jumlah_filter_umkm_piutang($tgl_awal, $tgl_akhir),   
                    "data"             => $data
                ];

        echo json_encode($output);
        
	}

	// 04-12-2020
	public function detail_umkm_pi($id_umkm)
	{
		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data 	= [
            'title'     => 'Laporan Piutang',
            'isi'       => 'laporan/piutang/V_piutang',
            'id_umkm'   => $id_umkm,
            'user'      => $this->nama,
			'nama_umkm' => $nm['nama'],
			'hal'		=> $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
	}

	// 08-09-2020

	public function tampil_piutang()
	{
		// $date_rg    	= $this->input->post('date_range');
		// $id_pelanggan   = $this->input->post('id_pelanggan');

        // if (count($date_rg) == 1) {
        //     $tgl_awal  = "";
        //     $tgl_akhir = "";
        // } else {
        //     $tgl_awal   = $date_rg[0]; 
        //     $tgl_akhir  = $date_rg[1]; 

        //     $tgl_awal  = $tgl_awal;
        //     $tgl_akhir = $tgl_akhir;
		// }
		
        $list = $this->laporan->get_data_piutang();

        $data = array();

		$no   = $this->input->post('start');
		
		$bayar = 0;
        foreach ($list as $o) {
            $no++;
            $tbody = array();

			$tbody[]    = "<div align='center'>".$no.".</div>";
			$tbody[]	= $o['nama'];
            $tbody[]    = nice_date($o['tanggal'], 'd-m-Y');
            $tbody[]    = "<div align='right'>".number_format($o['bayar'],0,'.','.')."</div>";
            $tbody[]    = "<div align='right'>".number_format($o['sisa_piutang'],0,'.','.')."</div>";

			$data[]     = $tbody;
			
			
		}

		$cr = $this->laporan->count_piutang()->result_array();

		foreach ($cr as $c) {
			$bayar 		+= $c['bayar'];
		}
		
		// cari piutang
		$cr = $this->laporan->cari_piutang()->row_array();

		$sisa = number_format($cr['piutang'] - $bayar,0,'.','.');

		// cari pelanggan
		$cp = $this->laporan->cari_pelanggan()->result_array();

		$list_plg = "<option value=''>Pilih Pelanggan</option>";

		foreach ($cp as $p) {
			$list_plg .= "<option value='".$p['id']."'>".$p['nama']."</option>";
		}

        $output = [ "draw"             	=> $_POST['draw'],
                    "recordsTotal"     	=> $this->laporan->jumlah_semua_piutang(),
                    "recordsFiltered"  	=> $this->laporan->jumlah_filter_piutang(),   
					"data"             	=> $data,
					"jumlah"			=> count($cp),
					"bayar"				=> number_format($bayar,0,'.','.'),
					"piutang"			=> number_format($cr['piutang'],0,'.','.'),
					"sisa"				=> $sisa,
					"list_plg"			=> $list_plg
                ];

        echo json_encode($output);
	}

	// 08-09-2020

	public function ambil_total()
	{
		$date_rg    	= $this->input->post('tanggal');
		$id_pelanggan   = $this->input->post('id_pelanggan');

        if (count($date_rg) == 1) {
            $tgl_awal  = "";
            $tgl_akhir = "";
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
		}

		$pl = $this->laporan->get_tot_pelanggan($tgl_awal, $tgl_akhir, $id_pelanggan)->result_array();

		$tot_sisa_piutang = 0;
		$tot_piutang 	  = 0;

		$list_plg = "<option value=''>Pilih Pelanggan</option>";

		foreach ($pl as $p) {
			
			// cari sisa piutang
			$sisa  = $this->laporan->get_sisa_piutang($tgl_awal, $tgl_akhir, $p['id'])->row_array();

			$tot_sisa_piutang += $sisa['sisa_piutang'];

			// cari tot piutang
			$tot_p = $this->laporan->get_tot_piutang($p['id'])->row_array();

			$tot_piutang += $tot_p['piutang'];

			// list pelanggan
			$list_plg .= "<option value='".$p['id']."'>".$p['nama']."</option>";

		}

		$data = [
				'tot_pelanggan'		=> $this->laporan->get_tot_pelanggan($tgl_awal, $tgl_akhir, $id_pelanggan)->num_rows(),
				'tot_bayar'			=> $this->laporan->get_tot_bayar($tgl_awal, $tgl_akhir, $id_pelanggan),
				'tot_sisa_piutang'	=> $tot_sisa_piutang,
				'tot_piutang'		=> $tot_piutang,
				'list_plg'			=> $list_plg
				];
				
		echo json_encode($data);

	}

	// 09-09-2020

	public function download_file_piutang()
	{
		$tanggal_range 	= $this->input->post('tanggal_range');
		$id_pelanggan  	= $this->input->post('id_pelanggan');
		$jenis 			= $this->input->post('jenis');
		$id_umkm 		= $this->input->post('id_umkm');

		// cari tanggal sejak awal bayar piutang
		$tgl_awal_piutang = $this->laporan->cari_tanggal_awal_piutang($id_umkm)->row_array();

		if ($tanggal_range == '') {

			$tgl_awal	= $tgl_awal_piutang['tanggal'];
			$tgl_akhir	= date("Y-m-d", now('Asia/Jakarta'));

		} else {

			$tgl_r = explode(" - ", $tanggal_range);

			$tgl_awal	= $tgl_r[0];
			$tgl_akhir 	= $tgl_r[1];

		}

		$data   = [ 'report'        => 'Report Piutang',
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
                    'jenis'         => $jenis,
                    'judul'         => 'Report Piutang',
                    'nama_plg'      => $this->laporan->get_tot_pelanggan($tgl_awal, $tgl_akhir, $id_pelanggan, $id_umkm)->result_array()
                  ]; 

        if ($jenis == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", 'laporan/V_export_piutang', $data);

        } else {

			ob_start();
            $this->load->view('laporan/V_export_piutang', $data);
            $html = ob_get_contents();
            // var_dump($html);die();
                ob_end_clean();
                require_once('./assets/html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
            $pdf->WriteHTML($html);
            $pdf->Output('Laporan Piutang.pdf', 'FI');

		}
		
	}

	public function read_piutang()
	{
		$list 	= $this->laporan->read_piutang();
		$data 	= [];
		$no		= 1;
		var_dump($list);die();
		foreach($list as $laporan)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
			$row[] 	= date('d-m-Y', strtotime($laporan->created_at));
            $row[] 	= $laporan->nama_pelanggan;
            $row[]	= 'Rp. '.number_format($laporan->tot_piutang);
            $row[]	= 'Rp. '.($laporan->tot_piutang - $laporan->bayar) > 0 ? number_format(($laporan->tot_piutang - $laporan->bayar)) : 0;
            $row[]  = '<a href="javascript:;" class="btn btn-xs btn-info" data-toggle="modal" data-target="#detail'.$laporan->id.'"><i class="fas fa-info-circle"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->laporan->count_all_piutang(),
                    "recordsFiltered" 	=> $this->laporan->count_filtered_piutang(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function pengeluaran()
	{
		if ($this->nama == 'Bagja' && $this->hal == '') {
            $isi = 'laporan/pengeluaran/V_lihat_admin';
        } else {
            $isi = 'laporan/pengeluaran/V_pengeluaran';
		}

		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

		$pendapatan			= $this->laporan->get_total_penjualan();
		$pengeluaran 		= $this->laporan->get_total_pengeluaran();
		$data 	= [
			'title'			=> 'Laporan Pengeluaran',
			'crumb'			=> 'Laporan',
			'pendapatan'	=> $pendapatan,
			'total_belanja'	=> $pengeluaran,
			'transaksi'		=> $this->laporan->get_transaksi_pengeluaran()->num_rows(),
			'row'			=> $this->laporan->get_transaksi_pengeluaran()->result(),
			'isi'			=> $isi,
			'id_umkm'   	=> $this->id_umkm,
			'user'      	=> $this->nama,
			'nama_umkm'		=> $nm['nama'],
			'hal'			=> $this->hal
		];
		$this->load->view('template/wrapper', $data);
	}

	// 06-12-2020
	public function tampil_umkm_pengeluaran()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->laporan->get_data_umkm_pengeluaran($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
			$tbody = array();
			
            $url = base_url()."Laporan/detail_umkm_peng/".$o['id'];

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = "<div align='right' class='font-weight-bold'><span style='font-size:15px;' class=' font-weight-bold'>".number_format($o['total_pengeluaran'],0,'.','.')."</span></div>";
            $tbody[]    = "<a href='$url' class='btn btn-warning'>Detail</a>";

            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->laporan->jumlah_semua_umkm_pengeluaran($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->laporan->jumlah_filter_umkm_pengeluaran($tgl_awal, $tgl_akhir),   
                    "data"             => $data
                ];

        echo json_encode($output);
        
	}

	// 06-12-2020
	public function detail_umkm_peng($id_umkm)
	{
		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();

        $data 	= [
            'title'     => 'Laporan Pengeluaran',
            'isi'       => 'laporan/pengeluaran/V_pengeluaran',
            'id_umkm'   => $id_umkm,
            'user'      => $this->nama,
			'nama_umkm' => $nm['nama'],
			'hal'		=> $this->hal
        ];
        
		$this->load->view('template/wrapper', $data);
	}

	// 10-09-2020

	public function tampil_pengeluaran()
	{
		$date_rg    	= $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = "";
            $tgl_akhir = "";
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
		}
		
        $list = $this->laporan->get_data_pengeluaran($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

		$total = 0;
        foreach ($list as $o) {
            $no++;
            $tbody = array();

			$tbody[]    = "<div align='center'>".$no.".</div>";
			$tbody[]	= nice_date($o['created_at'], 'd-m-Y');
            $tbody[]    = $o['code_trn'];
            $tbody[]    = "<div align='right'>".number_format($o['total_transaksi'],0,'.','.')."</div>";
            $tbody[]    = "<button class='btn btn-warning btn-sm detail_trn' id_trn='".$o['id']."'>Detail</button>";

			$data[]     = $tbody;
			
		}
		
		$cr = $this->laporan->count_pengeluaran($tgl_awal, $tgl_akhir)->result_array();

		foreach ($cr as $c) {
			$total 		+= $c['total_transaksi'];
		}

        $output = [ "draw"             	=> $_POST['draw'],
                    "recordsTotal"     	=> $this->laporan->jumlah_semua_pengeluaran($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  	=> $this->laporan->jumlah_filter_pengeluaran($tgl_awal, $tgl_akhir),   
					"data"             	=> $data,
					"jumlah"			=> count($cr),
					"total"				=> number_format($total,0,'.','.')
                ];

        echo json_encode($output);
	}

	// 10-09-2020

	public function ambil_total_pengeluaran()
	{
		$date_rg  = $this->input->post('tanggal');

        if (count($date_rg) == 1) {
            $tgl_awal  = "";
            $tgl_akhir = "";
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
		}

		$data = [
				'tot_transaksi'	=> $this->laporan->get_tot_transaksi_pgl($tgl_awal, $tgl_akhir)->num_rows(),
				'tot_belanja'	=> $this->laporan->get_total_belanja($tgl_awal, $tgl_akhir),
				];
				
		echo json_encode($data);
	}

	// 10-09-2020

	public function tampilan_detail_pengeluaran()
    {
        $id_tr = $this->input->post('id_tr');

		$li = $this->transaksi->cari_data('trn_transaksi', ['id' => $id_tr])->row_array();

        $data   = ['id_tr'       => $id_tr,
                   'trn'         => $li,
                   'list'        => $this->transaksi->cari_data('trn_detail_pengeluaran', ['id_transaksi' => $id_tr])->result_array(),
				   'nama_plg'    => $this->transaksi->cari_data('mst_pelanggan', ['id' => $li['id_pelanggan']])->row_array()
                  ];

        $this->load->view('laporan/V_detail_pengeluaran', $data);
	}

	// 10-09-2020

	public function download_file_pengeluaran()
	{
		$tanggal_range 	= $this->input->post('tanggal_range');
		$jenis 			= $this->input->post('jenis');
		$id_umkm 		= $this->input->post('id_umkm');

		// cari tanggal sejak awal pengeluaran
		$tgl_awal_pengeluaran = $this->laporan->cari_tanggal_awal('Pengeluaran', $id_umkm)->row_array();

		if ($tanggal_range == '') {

			$tgl_awal	= $tgl_awal_pengeluaran['tanggal'];
			$tgl_akhir	= date("Y-m-d", now('Asia/Jakarta'));

		} else {

			$tgl_r = explode(" - ", $tanggal_range);

			$tgl_awal	= $tgl_r[0];
			$tgl_akhir 	= $tgl_r[1];

		}

		$data   = [ 'report'        => 'Report Pengeluran',
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
                    'jenis'         => $jenis,
                    'judul'         => 'Report Pengeluran',
                    'transaksi'     => $this->laporan->get_transaksi_cetak($tgl_awal, $tgl_akhir, 'Pengeluaran', $id_umkm)->result_array()
                  ]; 

        if ($jenis == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", 'laporan/V_export_pengeluaran', $data);

        } else {

			ob_start();
            $this->load->view('laporan/V_export_pengeluaran', $data);
            $html = ob_get_contents();
            // var_dump($html);die();
                ob_end_clean();
                require_once('./assets/html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
            $pdf->WriteHTML($html);
            $pdf->Output('Laporan Pengeluaran.pdf', 'FI');

		}
	}

	// 06-12-2020
	public function split()
	{
		// if ($this->nama == 'Bagja') {
        //     $isi = 'laporan/split/V_lihat_admin';
        // } else {
        //     $isi = 'laporan/V_split';
		// }

		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();

		$data 	= [
			'title'			=> 'Laporan Split',
			'crumb'			=> 'Laporan',
			'isi'			=> 'laporan/split/V_split',
			'id_umkm'   	=> $this->id_umkm,
			'user'      	=> $this->nama,
			'hal'			=> $this->hal,
			'nama_umkm' 	=> $nm['nama']
			// 'umkm'			=> $this->laporan->cari_umkm()->result_array()
		];
		$this->load->view('template/wrapper', $data);
	}

	// 06-12-2020
	public function tampil_umkm_split()
    {
        $date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
		}
		
		$id_umkm = $this->input->post('id_umkm');

        $list = $this->laporan->get_data_umkm_split($tgl_awal, $tgl_akhir, $id_umkm);

        $data = array();

		$no   = $this->input->post('start');
		
		$list_umkm = "<option value=''>Pilih UMKM</option>";

        foreach ($list as $o) {
            $no++;
			$tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = ucwords($o['nama']);
            $tbody[]    = "<div align='center' class='font-weight-bold'><span style='font-size:15px;' class='badge badge-light font-weight-bold'>".$o['qty']."</span></div>";
            $tbody[]    = "<button class='btn btn-warning detail' nama_produk='".$o['nama']."' id_produk='".$o['id']."' id_umkm='".$o['id_umkm']."' qty='".$o['qty']."'>Detail</button>";

			$data[]     = $tbody;
		}
		
		$cr = $this->laporan->get_list_umkm($tgl_awal, $tgl_akhir, $id_umkm)->result_array();

		foreach ($cr as $p) {

			if ($p['id_umkm'] == $id_umkm) {
				$sel = 'selected';
			} else {
				$sel = '';
			}

			$list_umkm .= "<option value='".$p['id_umkm']."' $sel>".$p['umkm']."</option>";
		}

        $output = [ "draw"             	=> $_POST['draw'],
                    "recordsTotal"     	=> $this->laporan->jumlah_semua_umkm_split($tgl_awal, $tgl_akhir, $id_umkm),
                    "recordsFiltered"  	=> $this->laporan->jumlah_filter_umkm_split($tgl_awal, $tgl_akhir, $id_umkm),   
					"data"             	=> $data,
					"list_umkm"			=> $list_umkm,
					"jumlah"			=> count($list)
                ];

        echo json_encode($output);
        
	}

	// 07-12-2020
	public function tampilan_detail_split()
	{
		$id_produk 		= $this->input->post('id_produk');
		$id_umkm 		= $this->input->post('id_umkm');
		$qty 			= $this->input->post('qty');
		$nama_produk	= $this->input->post('nama_produk');

		$data		= [ 'nama_produk'	=> $nama_produk,
						'qty'			=> $qty,
						'list'			=> $this->laporan->cari_data_split($id_produk)->result_array()
					  ];

		$this->load->view('laporan/split/V_detail_split', $data);
		
	}

	// 07-12-2020
	public function download_file_split()
	{
		$tanggal_range 	= $this->input->post('tanggal_range');
		$jenis 			= $this->input->post('jenis');
		$id_umkm 		= $this->input->post('id_umkm');

		if ($id_umkm != '') {
			$cd = $this->laporan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();
		}

		$tgl_r = explode(" - ", $tanggal_range);

		$tgl_awal	= $tgl_r[0];
		$tgl_akhir 	= $tgl_r[1];

		$data   = [ 'report'        => 'Report Split',
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
					'jenis'         => $jenis,
					'id_umkm'		=> $id_umkm,
					'nm_umkm'		=> $cd['nama'],
                    'judul'         => 'Report Split',
                    'list'     		=> $this->laporan->get_split_cetak($tgl_awal, $tgl_akhir, $id_umkm)->result_array()
                  ]; 

        if ($jenis == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", 'laporan/split/V_export_split', $data);

        } else {

			ob_start();
            $this->load->view('laporan/split/V_export_split', $data);
            $html = ob_get_contents();
            // var_dump($html);die();
                ob_end_clean();
                require_once('./assets/html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
            $pdf->WriteHTML($html);
            $pdf->Output('Laporan Split.pdf', 'FI');

		}
	}

	// 11-12-2020
	public function laba_rugi()
	{
		if ($this->nama == 'Bagja' && $this->hal == '') {
            $id_umkm = 0;
        } else {
            $id_umkm = $this->id_umkm;
		}

		$nm = $this->pelanggan->cari_data('mst_umkm', ['id' => $this->id_umkm])->row_array();
		
		$data 	= [
			'title'			=> 'Laporan Laba/Rugi',
			'crumb'			=> 'Laporan',
			'isi'			=> 'laporan/laba_rugi/V_laba_rugi',
			'id_umkm'   	=> $id_umkm,
			'user'      	=> $this->nama,
			'nama_umkm'		=> $nm['nama'],
			'hal'			=> $this->hal
		];

		$this->load->view('template/wrapper', $data);
	}

	// 11-12-2020
	public function tampil_umkm_laba_rugi()
	{
		$date_rg    = $this->input->post('date_range');

        if (count($date_rg) == 1) {
            $tgl_awal  = date("Y-m-d", now('Asia/Jakarta'));
            $tgl_akhir = date("Y-m-d", now('Asia/Jakarta'));
        } else {
            $tgl_awal   = $date_rg[0]; 
            $tgl_akhir  = $date_rg[1]; 

            $tgl_awal  = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $list = $this->laporan->get_data_umkm_laba_rugi($tgl_awal, $tgl_akhir);

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
			$tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = "<div align='right' class='font-weight-bold'><span style='font-size:15px;' class=' font-weight-bold'>".number_format($o['laba_kotor'],0,'.','.')."</span></div>";
            $tbody[]    = "<div align='right' class='font-weight-bold'><span style='font-size:15px;' class=' font-weight-bold'>".number_format($o['laba_bersih'],0,'.','.')."</span></div>";
            $tbody[]    = "<button class='btn btn-warning detail' tgl_awal='$tgl_awal' tgl_akhir='$tgl_akhir' id_umkm='".$o['id']."' umkm='".$o['nama']."'>Detail</button>";

            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->laporan->jumlah_semua_umkm_laba_rugi($tgl_awal, $tgl_akhir),
                    "recordsFiltered"  => $this->laporan->jumlah_filter_umkm_laba_rugi($tgl_awal, $tgl_akhir),   
                    "data"             => $data
                ];

        echo json_encode($output);
	}

	// 11-12-2020
	public function tampilan_detail_laba_rugi()
	{
		$id_umkm 	= $this->input->post('id_umkm');
		$tgl_awal 	= $this->input->post('tgl_awal');
		$tgl_akhir 	= $this->input->post('tgl_akhir');
		$umkm 		= $this->input->post('umkm');

		$data		= [ 'umkm'		=> $umkm,
						'tgl_awal'	=> $tgl_awal,
						'tgl_akhir'	=> $tgl_akhir,
						'id_umkm'	=> $id_umkm,
						'data'		=> $this->laporan->get_detail_laba_rugi($id_umkm, $tgl_awal, $tgl_akhir)->row_array()
					  ];
		
		$this->load->view('laporan/laba_rugi/detail', $data);
	}

	// 11-12-2020
	public function download_file_laba_rugi()
	{
		$tanggal_range 	= $this->input->post('tanggal_range');
		$jenis 			= $this->input->post('jenis');
		$id_umkm 		= $this->input->post('id_umkm');
		$tgl_awal 		= $this->input->post('tgl_awal');
		$tgl_akhir 		= $this->input->post('tgl_akhir');
		$aksi 			= $this->input->post('aksi');

		if ($id_umkm != 0) {
			$cd = $this->laporan->cari_data('mst_umkm', ['id' => $id_umkm])->row_array();
		}

		if ($aksi == 'awal') {
			$tgl_r = explode(" - ", $tanggal_range);

			$tgl_awal	= $tgl_r[0];
			$tgl_akhir 	= $tgl_r[1];
		} else {
			$tgl_awal	= $tgl_awal;
			$tgl_akhir 	= $tgl_akhir;
		}

		$data   = [ 'report'        => 'Report Laba Rugi',
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
					'jenis'         => $jenis,
					'id_umkm'		=> $id_umkm,
					'nm_umkm'		=> $cd['nama'],
                    'judul'         => 'Report Laba Rugi',
					'list'     		=> $this->laporan->get_laba_rugi_cetak($tgl_awal, $tgl_akhir, $id_umkm)->result_array(),
					'data'			=> $this->laporan->get_detail_laba_rugi($id_umkm, $tgl_awal, $tgl_akhir)->row_array()
				  ]; 
				  
		if ($aksi == 'awal') {
			$v = 'V_export_laba_rugi';
		} else {
			$v = 'V_export_detail_laba_rugi';
		}

        if ($jenis == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", "laporan/laba_rugi/$v", $data);

        } else {

			ob_start();
            $this->load->view("laporan/laba_rugi/$v", $data);
            $html = ob_get_contents();
            // var_dump($html);die();
                ob_end_clean();
                require_once('./assets/html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
            $pdf->WriteHTML($html);
            $pdf->Output('LaporanLabaRugi.pdf', 'FI');

		}
	}

	public function read_pengeluaran()
	{
		$list 	= $this->laporan->read_pengeluaran();
		$data 	= [];
		$no		= 1;
		foreach($list as $laporan)
		{
			$row 	= [];
			$row[] 	= $no++.'.';
            $row[] 	= date('d-m-Y', strtotime($laporan->created_at));
            $row[]	= $laporan->code_trn;
            $row[]	= 'Rp. '.number_format($laporan->total_transaksi);
            $row[]  = '<a href="javascript:;" class="btn btn-xs btn-info" data-toggle="modal" data-target="#detail'.$laporan->id.'"><i class="fas fa-info-circle"></i></a>';
            $data[] = $row;
		}
		$output = [
                    "recordsTotal" 		=> $this->laporan->count_all_pengeluaran(),
                    "recordsFiltered" 	=> $this->laporan->count_filtered_pengeluaran(),
                    "data" 				=> $data,
		          ];
        echo json_encode($output);
	}

	public function cetak()
	{
		if(empty($this->input->post('periode')))
		{
			$jenis = $this->input->post('jenis');
			$url = 'Laporan/cetak_laporan/'.$jenis;
		}
		else
		{
			$jenis = $this->input->post('jenis');
			$periode = $this->input->post('periode');
			$url = 'Laporan/cetak_laporan/'.$jenis.'/'.$periode;
		}
		redirect($url,'refresh');
	}

	public function cetak_laporan($x)
	{
		if($this->uri->segment(3) == 'Pemasukan')
		{
			if($this->uri->segment(3) && empty($this->uri->segment(4)))
			{
				$judul 		= 'Laporan Pendapatan Keseluruhan';
				$laporan 	= $this->laporan->get_transaksi_penjualan()->result();
				$filename	= 'Laporan Pendapatan Keseluruhan.pdf';
				$view 		= 'format/laporan_penjualan_pdf';
			}
			else
			{
				$periode	= $this->uri->segment(4);
				$judul 		= 'Laporan Pendapatan Tanggal '.$periode;
				$laporan 	= $this->laporan->get_data_laporan_penjualan_per_tanggal($periode);
				$filename	= 'Laporan Pendapatan Tanggal '.$periode.'.pdf';
				$view 		= 'format/laporan_penjualan_pdf';
			}
		}
		else
		{
			if($this->uri->segment(3) && empty($this->uri->segment(4)))
			{
				$jenis 		= $this->uri->segment(3);
				$judul 		= 'Laporan Pengeluaran Keseluruhan';
				$laporan 	= $this->laporan->get_data_laporan_per_jenis($jenis);
				$filename	= 'Laporan Pengeluaran Keseluruhan.pdf';
				$view 		= 'format/laporan_pengeluaran_pdf';
			}
			else
			{
				$jenis 		= $this->uri->segment(3);
				$periode	= $this->uri->segment(4);
				$judul 		= 'Laporan Pengeluaran Tanggal '.$periode;
				$laporan 	= $this->laporan->get_data_laporan_per_tanggal($jenis, $periode);
				$filename	= 'Laporan Pengeluaran Tanggal '.$periode.'.pdf';
				$view 		= 'format/laporan_pengeluaran_pdf';
			}
		}
		$data['judul'] 		= $judul;
        $data['laporan']	= $laporan;
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = $filename;
        $this->pdf->load_view($view, $data);
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */