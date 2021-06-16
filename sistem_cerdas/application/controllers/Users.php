<?php
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_admin');
        $this->load->library('form_validation');
        $this->load->helper('string');
    }
    public function index()
    {
        $data['title'] = 'User';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['list_user'] = $this->db->get('user')->result_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }
    public function simpan()
    {
        //buat kode user
        $query = $this->db->query("SELECT MAX(id_user) as iduser from user");
        $tabel1 = $query->row();
        $no =  substr($tabel1->iduser, 4, 5) + 1;
        $kode = "ID-U" . $no;
        // print_r($kode);
        $config = [
            'file_name' => random_string('alnum', 15),
            'upload_path' => './assets/dist/img/user',
            'allowed_types' => 'gif|jpg|png',
            // 'max_size' => 1000, 'max_width' => 1000,
            // 'max_height' => 1000
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', 'Gambar Harap Di Upload!!!');
            redirect(base_url('admin/anggota/'));
        } else {
            $file = $this->upload->data();
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $about = $this->input->post('about');
            $role = $this->input->post('role');
            $is_active = $this->input->post('status');
            $password = $this->input->post('password');
            $data = [
                'id_user' => $kode,
                'nama' => $nama,
                'email' => $email,
                'about' => $about,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => $role,
                'is_active' => $is_active,
                'image' => $file['file_name']
            ];
            $this->db->insert('user', $data);
            // $this->M_admin->insertdata('anggota', $data);
            redirect(base_url('users/'));
        }
    }
    public function getuser()
    {
        $id = $this->input->get('id');
        $data = $this->db->get_where('user', ['id_user' => $id])->row();
        echo json_encode($data);
    }
    public function update()
    {
        $kode = $this->input->post('id_user');
        $password = $this->input->post('password');
        if (empty($_FILES['gambar']['name']) && empty($password)) {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $about = $this->input->post('about');
            $role = $this->input->post('role');
            $is_active = $this->input->post('status');
            $data = [
                'nama' => $nama,
                'email' => $email,
                'about' => $about,
                'role_id' => $role,
                'is_active' => $is_active,
            ];
            $this->db->where('id_user', $kode)->update('user', $data);
            redirect(base_url('users/'));
        } elseif (empty($_FILES['gambar']['name']) && !empty($password)) {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $about = $this->input->post('about');
            $role = $this->input->post('role');
            $is_active = $this->input->post('status');
            $data = [
                'nama' => $nama,
                'email' => $email,
                'about' => $about,
                'role_id' => $role,
                'is_active' => $is_active,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            $this->db->where('id_user', $kode)->update('user', $data);
            redirect(base_url('users/'));
        } elseif (!empty($_FILES['gambar']['name']) && empty($password)) {
            $config = [
                'file_name' => random_string('alnum', 15),
                'upload_path' => './assets/dist/img/user',
                'allowed_types' => 'gif|jpg|png',
                // 'max_size' => 1000, 'max_width' => 1000,
                // 'max_height' => 1000
            ];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', 'Gambar Harap Di Upload!!!');
                redirect(base_url('users/'));
            } else {
                $file = $this->upload->data();
                $nama = $this->input->post('nama');
                $email = $this->input->post('email');
                $about = $this->input->post('about');
                $role = $this->input->post('role');
                $is_active = $this->input->post('status');
                $data = [
                    'nama' => $nama,
                    'email' => $email,
                    'about' => $about,
                    'role_id' => $role,
                    'is_active' => $is_active,
                    'image' => $file['file_name']
                ];
                $this->db->where('id_user', $kode)->update('user', $data);
                redirect(base_url('users/'));
            }
        } else {
            $config = [
                'file_name' => random_string('alnum', 15),
                'upload_path' => './assets/dist/img/user',
                'allowed_types' => 'gif|jpg|png',
                // 'max_size' => 1000, 'max_width' => 1000,
                // 'max_height' => 1000
            ];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', 'Gambar Harap Di Upload!!!');
                redirect(base_url('users/'));
            } else {
                $file = $this->upload->data();
                $nama = $this->input->post('nama');
                $email = $this->input->post('email');
                $about = $this->input->post('about');
                $role = $this->input->post('role');
                $is_active = $this->input->post('status');
                $data = [
                    'nama' => $nama,
                    'email' => $email,
                    'about' => $about,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role_id' => $role,
                    'is_active' => $is_active,
                    'image' => $file['file_name']
                ];
                $this->db->where('id_user', $kode)->update('user', $data);
                redirect(base_url('users/'));
            }
        }
    }
    public function hapus()
    {
        $kode = $this->input->post('id_hapus');
        $this->db->delete('user', ['id_user' => $kode]);
        redirect(base_url('users/'));
    }
}
