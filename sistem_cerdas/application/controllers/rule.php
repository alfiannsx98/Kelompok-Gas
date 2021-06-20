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

    public function insert()
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
            $this->index();
        } else {

            // menjalankan model
            $count_success_insert = 0;
            foreach ($gejala_opt as $gejala) {
                $result = $this->m_rule->insert_aturan($kode_opt, $gejala);

                // memeriksa apakah query berhasil dijalankan atau tidak
                if ($result == false) {
                    // Jika query gagal dijalankan
                    $count_success_insert += 0;
                } else {
                    // Jika query berhasil dijalankan
                    $count_success_insert += 1;
                }
            }

            // memeriksa apakah seluruh data berhasil ditambahkan atau tidak
            if ($count_success_insert == count($gejala_opt)) {
                // Jika seluruh data berhasil ditambahkan
                $this->session->set_flashdata('error_message', ['error_status' => false, 'message' => "Seluruh Data Berhasil Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('rule');
            } else {
                // Jika ada data yang gagal ditambahkan
                $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Ada Data Yang Gagal Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('rule');
            }
        }
    }

    public function retrieve()
    {
        // Membuat array
        $data = [
            'tb_rule.kode_opt' => $this->input->post('kode_opt')
        ];

        // Mengambil data
        $result = $this->m_rule->get_rule($data);

        // mencetak data dalam bentuk json
        echo json_encode($result);
    }
}
