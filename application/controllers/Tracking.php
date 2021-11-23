<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

    // 24-08-2020

    public function __construct()
    {
        parent::__construct();
        $this->cek_login_lib->logged_in_false();
    }
    
    public function index()
    {
        $data 	= [
			'title'	=> 'Tracking',
			'isi'	=> 'tracking/V_tracking'
        ];
        
		$this->load->view('template/wrapper', $data);
    }

}

/* End of file Tracking.php */
