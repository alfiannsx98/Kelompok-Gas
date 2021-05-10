<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_obat');
        $this->load->model('m_dashboard');
        $this->load->library('form_validation');
    }

    public function index()
    {

        // Preparasi halaman
        $data['title'] = 'Obat Tanaman';
        $data['title1'] = 'Data User Aktif';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['jml_aktif'] = $this->m_dashboard->select_by_user();
        $data['aktif'] = $this->m_dashboard->select_by_role();
        $data['obat'] = $this->m_obat->get_all_obat();


        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('obat/index');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $nama_bahan = $this->input->post("nama_bahan");
        $nama_dagang = $this->input->post("nama_dagang");

        // Membuat rules
        $this->form_validation->set_rules('nama_bahan', 'Nama Bahan Aktif', 'required|trim|regex_match[/^[a-zA-Z0-9\s.-\/]+$/]');
        $this->form_validation->set_rules('nama_dagang', 'Nama Dagang', 'required|trim|regex_match[/^[a-zA-Z0-9\s.-\/]+$/]');

        // Membuat pesan
        $this->form_validation->set_message('required', 'Kolom {field} tidak boleh kosong.');
        $this->form_validation->set_message('regex_match', 'Kalimat mengandung karakter terlarang.');

        // Menjalankan form_validation
        if ($this->form_validation->run() == false) {
            // Jika form_validation mengembalikan nilai error
            $this->index();
        } else {
            // Menjalankan model
            $result = $this->m_obat->insert_obat($nama_bahan, $nama_dagang);

            // memeriksa apakah query berhasil dijalankan atau tidak
            if ($result == false) {
                // Jika query gagal dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('obat');
            } else {
                // Jika query berhasil dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('obat');
            }
        }
    }

    public function retrieve()
    {
        // Membuat array
        $data = [
            'kode_obat' => $this->input->post('kode_obat')
        ];

        // Mengambil data
        $result = $this->m_obat->get_obat($data);

        // mencetak data dalam bentuk json
        echo json_encode($result);
    }

    public function ubah()
    {
        $nama_bahan = $this->input->post("nama_bahan_ubah");
        $nama_dagang = $this->input->post("nama_dagang_ubah");

        // Membuat rules
        $this->form_validation->set_rules('nama_bahan_ubah', 'Nama Bahan Aktif', 'required|trim|regex_match[/^[a-zA-Z0-9\s\.\-\/]+$/]');
        $this->form_validation->set_rules('nama_dagang_ubah', 'Nama Dagang', 'required|trim|regex_match[/^[a-zA-Z0-9\s\.\-\/]+$/]');

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
                'nama_bahan_aktif' => $nama_bahan,
                'nama_dagang' => $nama_dagang
            ];

            $kode = 'OB' . $this->input->post('kd_obt_ubah');

            // Menjalankan model
            $result = $this->m_obat->update_obat($kode, $data);

            // memeriksa apakah query berhasil dijalankan atau tidak
            if ($result == false) {
                // Jika query gagal dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Diubah"]);

                // Mengembalikan ke halaman index
                redirect('obat');
            } else {
                // Jika query berhasil dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Diubah"]);

                // Mengembalikan ke halaman index
                redirect('obat');
            }
        }
    }

    public function hapus()
    {
        // Menerima data dari javascript
        $kode = $this->input->post('kode_obat');

        // menjalankan model
        $result = $this->m_obat->delete_obat($kode);

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
