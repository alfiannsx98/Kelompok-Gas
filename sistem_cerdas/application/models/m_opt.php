<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_opt extends CI_Model
{

    /**
     * Mengambil seluruh obat dari tabel obat dalam bentuk array
     */
    public function get_all_opt()
    {
        return $this->db->get("tb_opt")->result_array();
    }


    /**
     * Mengambil id terakhir dari obat dalam table obat
     */
    public function get_last_kode_opt()
    {
        // Mengambil id terakhir dari database
        $this->db->order_by('kode_opt', 'DESC');
        return $this->db->get('tb_opt')->row_array();
    }

    /**
     * Membuat penambahan terhadap id terakhir yang diambil dari table obat
     */
    public function generate_kode_opt()
    {

        $kode = $this->get_last_kode_opt()['kode_opt'];

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
     * Menambahkan obat kedalam tabel obat
     */
    public function insert_opt($nama_opt, $nama_inggris)
    {

        // membuat array untuk memudahkan insert
        $data = [
            'kode_opt' => $this->generate_kode_opt(),
            'nama_opt' => $nama_opt,
            'nama_inggris' => $nama_inggris
        ];

        // Menggunakan db transaction

        // Memulai Transaksi
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->insert('tb_opt', $data);

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

            // mengembalikan true
            return true;
        }
    }

    /**
     * Mengambil data obat dari tabel obat berdasarkan kode
     */
    public function get_opt($data)
    {
        return $this->db->get_where('tb_opt', $data)->row_array();
    }

    /**
     * Mengubah data obat dalam tabel obat berdasarkan kode
     */
    public function update_opt($kode, $data)
    {
        // Menggunakan db transaction

        // Memulai transaksi
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->where('kode_opt', $kode);
        $this->db->update('tb_opt', $data);

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
     * Menghapus data obat dalam tabel obat berdasarkan kode
     */
    public function delete_opt($kode)
    {
        // Menggunakan db transaction

        // Memulai transaksi
        $this->db->trans_begin();

        // menjalankan query
        $this->db->where('kode_opt', $kode);
        $this->db->delete('tb_opt');

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

            // mengembalikan true
            return true;
        }
    }
    public function simpan_opt($data)
    {
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->insert('tb_opt', $data);

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

            // mengembalikan true
            return true;
        }
    }
}
