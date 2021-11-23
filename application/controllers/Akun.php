<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

    // 24-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();
    }
    
    public function index()
    {
        $this->daftar_akun();
    }

    public function daftar_akun()
    {
        $data 	= [
			'title'			=> 'Akun',
			'isi'			=> 'akun/daftar_akun/V_daftar_akun'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

    public function jurnal_umum()
    {
        $data 	= [
			'title'			=> 'Akun',
			'isi'			=> 'akun/jurnal_umum/V_jurnal_umum'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

}

/* End of file Akun.php */
