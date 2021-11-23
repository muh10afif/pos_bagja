<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    // 22-08-2020
    public function cek_user_login($username)
    {
        return $this->db->get_where('mst_user', ['username' => $username]);
    }

    // 16-11-2020
    // Menampilkan list user_umkm
    public function get_data_user_umkm()
    {
        $this->_get_datatables_query_user_umkm();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_user_umkm = [null, 'nama', 'username', 'email', 'status'];
    var $kolom_cari_user_umkm  = ['LOWER(nama)', 'LOWER(username)', 'LOWER(email)'];
    var $order_user_umkm       = ['nama' => 'asc'];

    public function _get_datatables_query_user_umkm()
    {
        $this->db->select('k.nama, u.username, u.email, u.id, u.status, u.password, u.id_umkm');
        $this->db->from('mst_user as u'); 
        $this->db->join('mst_umkm as k', 'k.id = u.id_umkm', 'left');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_user_umkm;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_user_umkm;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_user_umkm)) {
            
            $order = $this->order_user_umkm;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_user_umkm()
    {
        $this->db->select('k.nama, u.username, u.email, u.id, u.status, u.password, u.id_umkm');
        $this->db->from('mst_user as u'); 
        $this->db->join('mst_umkm as k', 'k.id = u.id_umkm', 'left');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_user_umkm()
    {
        $this->_get_datatables_query_user_umkm();

        return $this->db->get()->num_rows();
        
    }

    // 17-11-2020
    public function get_data_user_investor()
    {
        $this->_get_datatables_query_user_investor();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_user_investor = [null, 'username', 'email', 'status'];
    var $kolom_cari_user_investor  = ['LOWER(username)', 'LOWER(email)'];
    var $order_user_investor       = ['username' => 'asc'];

    public function _get_datatables_query_user_investor()
    {
        $this->db->from('mst_investor'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_user_investor;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_user_investor;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_user_investor)) {
            
            $order = $this->order_user_investor;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_user_investor()
    {
        $this->db->from('mst_investor'); 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_user_investor()
    {
        $this->_get_datatables_query_user_investor();

        return $this->db->get()->num_rows();
        
    }

    // 17-11-2020
    public function get_list_umkm_belum()
    {
        $this->db->select('*');
        $this->db->from('mst_user');
        // $this->db->where('status', 1);
        
        $a = $this->db->get()->result_array();

        $ay = array();
        foreach ($a as $b) {
            $ay[] = $b['id_umkm'];
        }

        $im         = implode(',',$ay);
        $id_umkm    = explode(',',$im); 

        $this->db->select('*');
        $this->db->from('mst_umkm');
        
        if ($id_umkm[0] != "") {
            $this->db->where_not_in('id', $id_umkm);
        }

        return $this->db->get();
        
    }

    // 17-11-2020
    public function get_list_umkm_belum_investor()
    {
        $this->db->select('*');
        $this->db->from('mst_umkm');
        $this->db->where('id_investor', 0);
        
        return $this->db->get();
    }

    // 17-11-2020
    public function get_list_umkm_belum_investor_id($id)
    {
        $this->db->select('*');
        $this->db->from('mst_umkm');
        $this->db->where('id_investor', $id);
        
        return $this->db->get();
    }

    // 17-11-2020
    public function get_data_umkm()
    {
        $id_investor = $this->input->post('id_investor');
        
        return $this->db->get_where('mst_umkm', ['id_investor' => $id_investor]);
    }

}

/* End of file M_user.php */
