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
        $this->load->model('m_rule');
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


    /**
     * Manajemen Tabel Keputusan
     */
    public function rule()
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

    public function insert_rule()
    {
        // Mengambil input dari user
        $kode_opt = $this->input->post('kode_opt');
        $gejala_opt = $this->input->post('gejala_opt');

        // Membuat rules
        $this->form_validation->set_rules('kode_opt', 'Organisme Penyerang Tanaman', 'required');
        $this->form_validation->set_rules('gejala_opt[]', 'Gejala Organisme Penyerang Tanaman', 'required');

        //  Membuat pesan error
        $this->form_validation->set_message('required', 'Kolom {field} tidak boleh kosong.');

        // Menjalankan form validation
        if ($this->form_validation->run() == false) {
            // Jika form_validation mengembalikan nilai error
            $this->rule();
        } else {

            // memeriksa apakah sudah terdapat rule untuk opt yang dipilih user atau belum
            $jumlah_opt = $this->m_rule->check_opt($kode_opt);

            if ($jumlah_opt > 0) {
                // Jika opt tersebut memiliki rule

                // Membuat array untuk dikirim kedalam model
                $data_gejala = [];

                foreach ($gejala_opt as $gejala) {
                    $data_gejala[$gejala] = 1;
                }

                // Melakukan perubahan rule 
                $result = $this->m_rule->update_aturan($kode_opt, $data_gejala);

                // Memeriksa apakah data berhasil diubah atau tidak
                if ($result) {
                    // Jika seluruh data berhasil diubah
                    $this->session->set_flashdata('error_message', ['error_status' => false, 'message' => "Data berhasil diubah"]);

                    // Mengembalikan ke halaman index
                    redirect('siscer/rule');
                } else {
                    // Jika seluruh data gagal diubah
                    $this->session->set_flashdata('error_message', ['error_status' => true, 'message' => "Data gagal diubah"]);

                    // Mengembalikan ke halaman index
                    redirect('siscer/rule');
                }
            } else {
                // Jika opt tersebut tidak memiliki rule

                // Membuat array untuk dikirim kedalam model
                $data_gejala = [
                    'kode_opt' => $kode_opt
                ];

                foreach ($gejala_opt as $gejala) {
                    $data_gejala[$gejala] = 1;
                }

                // Melakukan perubahan rule 
                $result = $this->m_rule->insert_aturan($data_gejala);

                // Memeriksa apakah data berhasil ditambahkan atau tidak
                if ($result) {
                    // Jika seluruh data berhasil ditambahkan
                    $this->session->set_flashdata('error_message', ['error_status' => false, 'message' => "Data berhasil ditambahkan"]);

                    // Mengembalikan ke halaman index
                    redirect('siscer/rule');
                } else {
                    // Jika seluruh data gagal ditambahkan
                    $this->session->set_flashdata('error_message', ['error_status' => true, 'message' => "Data gagal ditambahkan"]);

                    // Mengembalikan ke halaman index
                    redirect('siscer/rule');
                }
            }
        }
    }

    public function delete_rule()
    {
        // Menerima data dari ajax
        $kode = $this->input->post('kode_opt');

        // Menjalankan model
        $result = $this->m_rule->delete_rule($kode);

        // memeriksa apakah query berhasil dijalankan atau tidak
        if ($result == false) {
            // Jika query gagal dijalankan
            $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Dihapus"]);

            // Mengembalikan ke halaman index
            redirect('siscer/rule');
        } else {
            // Jika query berhasil dijalankan
            $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Dihapus"]);

            // Mengembalikan ke halaman index
            redirect('siscer/rule');
        }
    }

    public function retrieve_rule()
    {
        // Membuat array
        $data = [
            'tb_keputusan.kode_opt' => $this->input->post('kode_opt')
        ];

        // Mengambil data
        $result = $this->m_rule->get_rule($data);

        // Mencari value yang memiliki nilai 1 dan disimpan kedalam array rule baru
        $rule = [];
        for ($i = 0; $i < sizeof($result); $i++) {
            $key = array_keys($result[$i]);
            $val = $result[$i];
            $sub_rule = [];

            for ($j = 2; $j < sizeof($key); $j++) {
                if ($val[$key[$j]] == 1) {
                    $sub_rule[] = $key[$j];
                }
            }

            $rule[] = $sub_rule;
        }

        // Mengambil value tersebut berdasarkan rule yang sesuai dari tabel gejala
        $hasil_gejala = [];

        for ($i = 0; $i < sizeof($rule[0]); $i++) {
            $result_gejala = $this->m_rule->get_gejala_rule($rule[0][$i])[0];
            $hasil_gejala[] = $result_gejala['gejala'];
        }

        $final_result = array(
            'nama_opt' => $result[0]['nama_opt'],
            'nama_inggris' => $result[0]['nama_inggris'],
            'gejala' => $hasil_gejala
        );

        // mencetak data dalam bentuk json
        echo json_encode($final_result);
    }

    public function ubah_rule()
    {
        // Load Halaman Untuk Ubah Rule
    }
}
