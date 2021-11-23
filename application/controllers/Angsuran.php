<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Angsuran extends CI_Controller {

    // 24-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();
    }
    
    public function index()
    {
        $data 	= [
			'title'	=> 'Angsuran',
			'isi'	=> 'angsuran/V_angsuran'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

}

/* End of file Angsuran.php */
