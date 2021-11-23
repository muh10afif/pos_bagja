<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

    // 24-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();
    }
    
    public function index()
    {
        $this->buku_kas();
    }

    public function buku_kas()
    {
        $data 	= [
			'title'			=> 'Keuangan',
			'isi'			=> 'keuangan/buku_kas/V_buku_kas'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function daftar_penerimaan()
    {
        $data 	= [
			'title'			=> 'Keuangan',
			'isi'			=> 'keuangan/daftar_penerimaan/V_daftar_penerimaan'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function daftar_pengeluaran()
    {
        $data 	= [
			'title'			=> 'Keuangan',
			'isi'			=> 'keuangan/daftar_pengeluaran/V_daftar_pengeluaran'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function daftar_tagihan_rutin()
    {
        $data 	= [
			'title'			=> 'Keuangan',
			'isi'			=> 'keuangan/daftar_tagihan_rutin/V_daftar_tagihan_rutin'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function laporan_rugi_laba()
    {
        $data 	= [
			'title'			=> 'Keuangan',
			'isi'			=> 'keuangan/laporan_rugi_laba/V_laporan_rugi_laba'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

}

/* End of file Keuangan.php */
