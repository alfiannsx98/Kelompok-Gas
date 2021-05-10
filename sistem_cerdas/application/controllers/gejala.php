<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gejala extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_gejala');
        $this->load->model('m_dashboard');
        $this->load->library('form_validation');
    }

    public function index()
    {

        // Preparasi halaman
        $data['title'] = 'Gejala Penyakit';
        $data['title1'] = 'Data User Aktif';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['jml_aktif'] = $this->m_dashboard->select_by_user();
        $data['aktif'] = $this->m_dashboard->select_by_role();
        $data['gejala'] = $this->m_gejala->get_all_gejala();


        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('gejala/index');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $gejala = $this->input->post("gejala");

        // Membuat rules
        $this->form_validation->set_rules('gejala', 'Gejala Penyakit', 'required|trim|regex_match[/^[a-zA-Z0-9\s.-\/]+$/]');

        // Membuat pesan
        $this->form_validation->set_message('required', 'Kolom {field} tidak boleh kosong.');
        $this->form_validation->set_message('regex_match', 'Kalimat mengandung karakter terlarang.');

        // Menjalankan form_validation
        if ($this->form_validation->run() == false) {
            // Jika form_validation mengembalikan nilai error
            $this->index();
        } else {
            // Menjalankan model
            $result = $this->m_gejala->insert_gejala($gejala);

            // memeriksa apakah query berhasil dijalankan atau tidak
            if ($result == false) {
                // Jika query gagal dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('gejala');
            } else {
                // Jika query berhasil dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('gejala');
            }
        }
    }

    public function retrieve()
    {
        // Membuat array
        $data = [
            'kode_gejala' => $this->input->post('kode_gejala')
        ];

        // Mengambil data
        $result = $this->m_gejala->get_gejala($data);

        // mencetak data dalam bentuk json
        echo json_encode($result);
    }

    public function ubah()
    {
        $gejala = $this->input->post("gejala_ubah");

        // Membuat rules
        $this->form_validation->set_rules('gejala_ubah', 'Gejala Penyakit', 'required|trim|regex_match[/^[a-zA-Z0-9\s\.\-\/]+$/]');

        // Membuat pesan
        $this->form_validation->set_message('required', 'Kolom {field} tidak boleh kosong.');
        $this->form_validation->set_message('regex_match', 'Kalimat mengandung karakter terlarang.');

        // Menjalankan form_validation
        if ($this->form_validation->run() == false) {
            // Jika form_validation mengembalikan nilai error
            $this->index();
        } else {

            // Membuat array
            $data = [
                'gejala' => $gejala
            ];

            $kode = 'GJ' . $this->input->post('kd_gjl_ubah');

            // Menjalankan model
            $result = $this->m_gejala->update_gejala($kode, $data);

            // memeriksa apakah query berhasil dijalankan atau tidak
            if ($result == false) {
                // Jika query gagal dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Diubah"]);

                // Mengembalikan ke halaman index
                redirect('gejala');
            } else {
                // Jika query berhasil dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Diubah"]);

                // Mengembalikan ke halaman index
                redirect('gejala');
            }
        }
    }

    public function hapus()
    {
        // Menerima data dari javascript
        $kode = $this->input->post('kode_gejala');

        // menjalankan model
        $result = $this->m_gejala->delete_gejala($kode);

        // memeriksa apakah query berhasil dijalankan atau tidak
        if ($result == false) {
            // Jika query gagal dijalankan
            $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Dihapus"]);
        } else {
            // Jika query berhasil dijalankan
            $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Dihapus"]);
        }
    }
}
