<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_gejala extends CI_Model
{

    /**
     * Mengambil seluruh gejala dari tabel gejala dalam bentuk array
     */
    public function get_all_gejala()
    {
        return $this->db->get("tb_gejala")->result_array();
    }

    /**
     * Melakukan Alter Tabel Untuk tabel keputusan
     */
    private function add_gejala_keputusan($kode)
    {
        $this->load->dbforge();
        $column = [
            $kode => [
                'type' => 'VARCHAR',
                'constraint' => 6
            ]
        ];
        $this->dbforge->add_column('tb_keputusan', $column);
    }

    /**
     * Melakukan Alter Tabel Untuk tabel keputusan
     */
    private function remove_gejala_keputusan($kode)
    {
        $this->load->dbforge();
        $this->dbforge->drop_column('tb_keputusan', $kode);
    }

    /**
     * Mengambil id terakhir dari gejala dalam table gejala
     */
    public function get_last_kode_gejala()
    {
        // Mengambil id terakhir dari database
        $this->db->order_by('kode_gejala', 'DESC');
        return $this->db->get('tb_gejala')->row_array();
    }

    /**
     * Membuat penambahan terhadap id terakhir yang diambil dari table gejala
     */
    private function generate_kode_gejala()
    {

        $kode = $this->get_last_kode_gejala()['kode_gejala'];

        // mengambil karakter huruf dari kode
        $char_kode = substr($kode, 0, 2);

        // mengambil angka dari kode
        $num_kode = substr($kode, 2, 2);

        // menambahkan angka dari kode
        $num_kode += 1;

        // Mengubah angka kedalam format 001
        $format_kode = str_repeat("0", 2 - strlen($num_kode)) . $num_kode;

        // Menggabungkan karakter huruf dengan angka dari kode
        $new_kode = $char_kode . $format_kode;

        // Mengembalikan kode baru
        return $new_kode;
    }

    /**
     * Menambahkan gejala kedalam tabel gejala
     */
    public function insert_gejala($gejala)
    {

        // membuat array untuk memudahkan insert
        $data = [
            'kode_gejala' => $this->generate_kode_gejala(),
            'gejala' => $gejala
        ];

        // Menggunakan db transaction

        // Memulai Transaksi
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->insert('tb_gejala', $data);

        // Memeriksa apakah query berhasil dijalankan atau tidak
        if ($this->db->trans_status() === false) {
            // Jika transaksi database gagal dilakukan

            // rollback query yang dilakukan
            $this->db->trans_rollback();

            // mengembalikan false
            return false;
        } else {
            // Jika transaksi database berhasil dilakukan

            // commit perubahan yang dilakukan oleh query
            $this->db->trans_commit();

            // Melakukan alter tabel di tabel keputusan
            $this->add_gejala_keputusan($data['kode_gejala']);

            // mengembalikan true
            return true;
        }
    }

    /**
     * Mengambil data gejala dari tabel gejala berdasarkan kode
     */
    public function get_gejala($data)
    {
        return $this->db->get_where('tb_gejala', $data)->row_array();
    }

    /**
     * Mengubah data gejala dalam tabel gejala berdasarkan kode
     */
    public function update_gejala($kode, $data)
    {
        // Menggunakan db transaction

        // Memulai transaksi
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->where('kode_gejala', $kode);
        $this->db->update('tb_gejala', $data);

        // Memeriksa apakah query berhasil dijalankan atau tidak
        if ($this->db->trans_status() == false) {
            // Jika transaksi database gagal dilakukan

            // Rollback query yang dilakukan
            $this->db->trans_rollback();

            // mengembalikan false
            return false;
        } else {
            // Jika transaksi database berhasil dilakukan

            // Commit perubahan yang dilakukan oleh query
            $this->db->trans_commit();

            // mengembalikan true
            return true;
        }
    }

    /**
     * Menghapus data gejala dalam tabel gejala berdasarkan kode
     */
    public function delete_gejala($kode)
    {
        // Menggunakan db transaction

        // Memulai transaksi
        $this->db->trans_begin();

        // menjalankan query
        $this->db->where('kode_gejala', $kode);
        $this->db->delete('tb_gejala');

        // memeriksa apakah query berhasil dijalankan atau tidak
        if ($this->db->trans_status() == false) {
            // Jika transaksi database gagal dilakukan

            // Rollback query yang dilakukan
            $this->db->trans_rollback();

            // mengembalikan false
            return false;
        } else {
            // Jika transaksi database berhasil dilakukan

            // Commit perubahan yang dilakukan oleh query
            $this->db->trans_commit();

            // Melakukan alter table
            $this->remove_gejala_keputusan($kode);

            // mengembalikan true
            return true;
        }
    }
}
