<?php

class Rule extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_rule');
        $this->load->model('m_opt');
        $this->load->model('m_gejala');
        $this->load->model('m_dashboard');
        $this->load->library('form_validation');
    }

    public function index()
    {

        // Preparasi halaman
        $data['title'] = 'Tabel Aturan';
        $data['title1'] = 'Data User Aktif';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['jml_aktif'] = $this->m_dashboard->select_by_user();
        $data['aktif'] = $this->m_dashboard->select_by_role();
        $data['aturan'] = $this->m_rule->get_all_aturan();
        $data['opt'] = $this->m_opt->get_all_opt();
        $data['gejala'] = $this->m_gejala->get_all_gejala();


        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('rule/index');
        $this->load->view('templates/footer');
    }
}
