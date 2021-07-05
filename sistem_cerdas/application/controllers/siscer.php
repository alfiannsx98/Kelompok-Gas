<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siscer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('model_admin');
        $this->load->model('m_dashboard');
        $this->load->model('m_data');
        $this->load->model('m_gejala');
        $this->load->model('m_siscer');
        $this->load->library('form_validation');
        $this->load->model('m_opt');
    }

    public function index()
    {
        // Preparasi halaman
        $data['title'] = 'Sistem Cerdas';
        $data['title1'] = 'Data User Aktif';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['gejala'] = $this->m_gejala->get_all_gejala();


        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siscer/index', $data);
        $this->load->view('templates/footer');
    }

    private function _hasil_proses($array)
    {
        // Preparasi halaman
        $data['title'] = 'Sistem Cerdas';
        $data['title1'] = 'Data User Aktif';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['hasil_proses'] = $array;

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('siscer/hasil_proses');
        $this->load->view('templates/footer');
    }

    public function proses()
    {
        // Mengambil input dari user
        $input_gejala = $this->input->post();

        // Memeriksa apakah ada input dari user
        if (sizeof($input_gejala) >= 1) {
            // Membuat rules
            $this->form_validation->set_rules('gejala', 'Gejala Penyakit', 'trim');

            // Menjalankan form validation
            if ($this->form_validation->run() == false) {
                // Jika form_validation mengembalikan nilai error
                $this->index();
            } else {

                // Mengambil kode opt berdasarkan gejala yang diinputkan
                $result_opt = $this->m_siscer->get_kode_penyakit($input_gejala);

                // Mengambil rule dari database
                $rule_db = $this->m_siscer->get_all_rule();

                // Mencari value yang memiliki nilai 1 dan disimpan kedalam array rule baru
                $rule = [];
                for ($i = 0; $i < sizeof($rule_db); $i++) {
                    $key = array_keys($rule_db[$i]);
                    $val = $rule_db[$i];
                    $sub_rule = [];

                    for ($j = 2; $j < sizeof($key); $j++) {
                        if ($val[$key[$j]] == 1) {
                            $sub_rule[] = $key[$j];
                        }
                    }

                    $rule[] = $sub_rule;
                }

                // Mencocokkan gejala yang diinputkan dengan rule yang telah ada
                $status = false;

                for ($i = 0; $i < sizeof($rule); $i++) {
                    $result_match = ($input_gejala['gejala'] == $rule[$i]);
                    if ($result_match) {
                        $status = true;
                    }
                }

                // JIka ditemukan rule yang tepat, maka ditampilkan informasi terkait penyakit tersebut
                if ($status == true) {
                    $kode_opt = [
                        'kode_opt' => $result_opt[0]['kode_opt']
                    ];

                    $result_get_opt = $this->m_opt->get_opt($kode_opt);

                    $this->_hasil_proses($result_get_opt);
                } else {
                    $kode_opt = [
                        'kode_opt' => 'HM00'
                    ];

                    $result_get_opt = $this->m_opt->get_opt($kode_opt);

                    $this->_hasil_proses($result_get_opt);
                }
            }
        } else {

            // Jika ada data yang gagal ditambahkan
            $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data yang dikirimkan kosong"]);
            $this->index();
            unset($_SESSION['error_message']);
        }
    }
}
