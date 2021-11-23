<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	var $url = 'https://mitrabagja.com/be/authLogin';

	function index() {

		$this->load->library('Cek_login_lib');
		$this->cek_login_lib->logged_in_true();
		$this->load->view('V_login');
		
	}

	public function tes()
	{
		$kode = bin2hex(random_bytes(16));

		$k1 = substr($kode,0,12);
		$k2 = substr($kode,21,32);

		$a1 = $k1."skdbearer".$k2;

		$encrypter = new \Illuminate\Encryption\Encrypter('409689df1701skdbearer794aea726d5', 'AES-256-CBC');
		// $pwd = $encrypter->encrypt('afif');
		$v = "eyJpdiI6IkdkYXhzM3lwdEppV1dVL1dWemIwNnc9PSIsInZhbHVlIjoiRS9Ia0NFVDlKMUs4Z3ErUkVQd0FJUT09IiwibWFjIjoiN2EwOWQxMzkxYjYzOTM5ZjMxOTVhYjQxYWI4NzNkN2Q4MmU3MzU1MGE3Y2NiMjBiMTZkMDg2MGViYTRjNDI4ZiJ9";
		$pwd = $encrypter->decrypt($v);
		echo $pwd;
	}

	// 17-09-2020
	public function buat_session()
	{
		$umkm2 = $this->input->post('umkm');
		// $umkm = json_decode($umkm2);
		
		foreach ($umkm2 as $u) {

			$data_session = array(

				'nama' 	  		=> $u['userumkm'],
				'id_umkm'		=> $u['idumkm'],
				'id_user'		=> $u['iduser'],
				'masuk'   		=> 'bagja_lite'
			);

			$this->session->set_userdata($data_session);
			
		}

		echo json_encode(['pesan' => "sukses"]);
	}
  
  	// 22-08-2020
	public function cek_login()
	{
		$decode = json_decode($this->curl_post());
		if(count(get_object_vars($decode)) > 1)
		{
			$data 	= $decode->umkm;
			$data_session = array(

				'nama' 	  		=> $data->{'userumkm'},
				'id_umkm'		=> $data->{'idumkm'},
				'masuk'   		=> 'bagja_lite'
			);
			$this->session->set_userdata($data_session);
			echo json_encode(['hasil' => 2]);
		}
		else
		{
			$message = $decode->message;
			echo json_encode([
				'hasil'		=> 0,
				'message'	=> $message
			]);
		}

		// $data_session = array(

		// 	'nama' 	  		=> 'Afif',
		// 	'id_umkm'		=> 3,
		// 	'masuk'   		=> 'bagja_lite'
		// );
		// $this->session->set_userdata($data_session);
		// echo json_encode(['hasil' => 2]);

	}

	// 29-11-2020
	public function cek_masuk()
	{
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

		$this->db->select('s.id, s.id_umkm, u.nama, s.password');
		$this->db->from('mst_user as s');
		$this->db->join('mst_umkm as u', 'u.id = s.id_umkm', 'left');
		$this->db->where('s.username', $username);
		
		$user = $this->db->get();

		$u 	  = $user->row_array();

		if($user->num_rows() != 0)
		{
			if(password_verify($password, $u['password']))
			{
				if ($u['id_umkm'] == 0) {
					$array = array(
						'nama' 	  		=> 'Bagja',
						'id_umkm'		=> 0,
						'id_user'		=> 0,
						'masuk'   		=> 'bagja_lite'
					);
				} else {
					$array = array(
						'nama' 	  		=> $u['nama'],
						'id_umkm'		=> $u['id_umkm'],
						'id_user'		=> $u['id'],
						'masuk'   		=> 'bagja_lite'
					);
				}
				
				$this->session->set_userdata( $array );

				echo json_encode(['status' => 1, 'pesan' => 'Berhasil']);
			}
			else
			{
				echo json_encode(['status' => 2, 'pesan' => 'Password Salah']);
			}
		}
		else
		{
			echo json_encode(['status' => 0, 'pesan' => 'Username Tidak Ditemukan']);
		}

	}

	public function curl_post()
	{
		$data			= [
    		'username' 	=> $this->input->post('username'),
    		'password' 	=> $this->input->post('password')
    	];
		$ch 			= curl_init();
	    curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    $output = curl_exec($ch); 
	    curl_close($ch);
	    return $output;
	}
  
	// aksi keluar
	function logout(){
		$us = $this->session->userdata('masuk');
		
		if ($us == 'bagja_lite') {
			$this->session->sess_destroy();
			redirect(base_url());  
		} else {
			redirect(base_url());  
		}
	}

}

/* End of file Login.php */
