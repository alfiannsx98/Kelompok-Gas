<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opt extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_opt');
        $this->load->model('m_dashboard');
        $this->load->library('form_validation');
    }

    public function index()
    {

        // Preparasi halaman
        $data['title'] = 'Organisme Pengganggu Tanaman';
        $data['title1'] = 'Data User Aktif';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['jml_aktif'] = $this->m_dashboard->select_by_user();
        $data['aktif'] = $this->m_dashboard->select_by_role();
        $data['opt'] = $this->m_opt->get_all_opt();


        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('opt/index');
        $this->load->view('templates/footer');
    }
    public function simpan()
    {
        print_r($this->input->post('kategori'));
    }
    public function insert()
    {
        $nama_opt = $this->input->post("nama_opt");
        $nama_inggris = $this->input->post("nama_inggris");
        $kategori = $this->input->post('kategori');

        // $query = $this->db->query("SELECT MAX(id_user) as iduser from user");
        // $tabel1 = $query->row();
        // $no =  substr($tabel1->iduser, 4, 5) + 1;
        // $kode = "ID-U" . $no;

        // Membuat rules
        $this->form_validation->set_rules('nama_opt', 'Nama OPT', 'required|trim|regex_match[/^[a-zA-Z0-9\s.-\/]+$/]');
        $this->form_validation->set_rules('nama_inggris', 'Nama Inggris', 'required|trim|regex_match[/^[a-zA-Z0-9\s.-\/]+$/]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        // Membuat pesan
        $this->form_validation->set_message('required', 'Kolom {field} tidak boleh kosong.');
        $this->form_validation->set_message('regex_match', 'Kalimat mengandung karakter terlarang.');

        // Menjalankan form_validation
        if ($this->form_validation->run() == false) {
            // Jika form_validation mengembalikan nilai error
            $this->index();
        } else {
            switch ($kategori) {
                case "penyakit":
                    $query = $this->db->query("SELECT MAX(kode_opt) as idopt from tb_opt where kode_opt LIKE '%PN%'");
                    $tabel1 = $query->row();
                    $no =  substr($tabel1->idopt, 2, 2) + 1;
                    $kode = "PN" . $no;
                    $data = [
                        'kode_opt' => $kode,
                        'nama_opt' => $nama_opt,
                        'nama_inggris' => $nama_inggris
                    ];
                    $result = $this->m_opt->simpan_opt($data);
                    break;
                case "hama":
                    $query = $this->db->query("SELECT MAX(kode_opt) as idopt from tb_opt where kode_opt LIKE '%HM%'");
                    $tabel1 = $query->row();
                    $no =  substr($tabel1->idopt, 2, 2) + 1;
                    $kode = "HM" . $no;
                    $data = [
                        'kode_opt' => $kode,
                        'nama_opt' => $nama_opt,
                        'nama_inggris' => $nama_inggris
                    ];
                    $result = $this->m_opt->simpan_opt($data);
                    break;
                case "hara":
                    $query = $this->db->query("SELECT MAX(kode_opt) as idopt from tb_opt where kode_opt LIKE '%HR%'");
                    $tabel1 = $query->row();
                    $no =  substr($tabel1->idopt, 2, 2) + 1;
                    $kode = "HR" . $no;
                    $data = [
                        'kode_opt' => $kode,
                        'nama_opt' => $nama_opt,
                        'nama_inggris' => $nama_inggris
                    ];
                    $result = $this->m_opt->simpan_opt($data);
                    break;
            }
            // memeriksa apakah query berhasil dijalankan atau tidak
            if ($result == false) {
                // Jika query gagal dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('opt');
            } else {
                // Jika query berhasil dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Ditambahkan"]);

                // Mengembalikan ke halaman index
                redirect('opt');
            }
        }
    }

    public function retrieve()
    {
        // Membuat array
        $data = [
            'kode_opt' => $this->input->get('id')
        ];

        // Mengambil data
        $result = $this->m_opt->get_opt($data);

        // mencetak data dalam bentuk json
        echo json_encode($result);
    }

    public function ubah()
    {
        $nama_opt = $this->input->post("nama_opt_ubah");
        $nama_inggris = $this->input->post("nama_inggris_ubah");

        // Membuat rules
        $this->form_validation->set_rules('nama_opt_ubah', 'Nama OPT', 'required|trim|regex_match[/^[a-zA-Z0-9\s\.\-\/]+$/]');
        $this->form_validation->set_rules('nama_inggris_ubah', 'Nama Inggris', 'required|trim|regex_match[/^[a-zA-Z0-9\s\.\-\/]+$/]');

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
                'nama_opt' => $nama_opt,
                'nama_inggris' => $nama_inggris
            ];

            $kode = $this->input->post('kd_opt_ubah');
            // Menjalankan model
            $result = $this->m_opt->update_opt($kode, $data);

            // memeriksa apakah query berhasil dijalankan atau tidak
            if ($result == false) {
                // Jika query gagal dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Diubah"]);

                // Mengembalikan ke halaman index
                redirect('opt');
            } else {
                // Jika query berhasil dijalankan
                $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Diubah"]);

                // Mengembalikan ke halaman index
                redirect('opt');
            }
        }
    }

    public function hapus()
    {
        // Menerima data dari javascript
        $kode = $this->input->post('kode_hapus');

        // menjalankan model
        $result = $this->m_opt->delete_opt($kode);

        // memeriksa apakah query berhasil dijalankan atau tidak
        if ($result == false) {
            // Jika query gagal dijalankan
            $this->session->set_flashdata('error_message', ["error_status" => true, "message" => "Data Gagal Dihapus"]);
        } else {
            // Jika query berhasil dijalankan
            $this->session->set_flashdata('error_message', ["error_status" => false, "message" => "Data Berhasil Dihapus"]);
        }
        redirect('opt');
    }
}
