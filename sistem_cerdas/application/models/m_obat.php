<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_obat extends CI_Model
{

    /**
     * Mengambil seluruh obat dari tabel obat dalam bentuk array
     */
    public function get_all_obat()
    {
        return $this->db->get("tb_obat")->result_array();
    }


    /**
     * Mengambil id terakhir dari obat dalam table obat
     */
    public function get_last_kode_obat()
    {
        // Mengambil id terakhir dari database
        $this->db->order_by('kode_obat', 'DESC');
        return $this->db->get('tb_obat')->row_array();
    }

    /**
     * Membuat penambahan terhadap id terakhir yang diambil dari table obat
     */
    public function generate_kode_obat()
    {

        $kode = $this->get_last_kode_obat()['kode_obat'];

        // mengambil karakter huruf dari kode
        $char_kode = substr($kode, 0, 2);

        // mengambil angka dari kode
        $num_kode = substr($kode, 2, 3);

        // menambahkan angka dari kode
        $num_kode += 1;

        // Mengubah angka kedalam format 001
        $format_kode = str_repeat("0", 3 - strlen($num_kode)) . $num_kode;

        // Menggabungkan karakter huruf dengan angka dari kode
        $new_kode = $char_kode . $format_kode;

        // Mengembalikan kode baru
        return $new_kode;
    }

    /**
     * Menambahkan obat kedalam tabel obat
     */
    public function insert_obat($nama_bahan, $nama_dagang)
    {

        // membuat array untuk memudahkan insert
        $data = [
            'kode_obat' => $this->generate_kode_obat(),
            'nama_bahan_aktif' => $nama_bahan,
            'nama_dagang' => $nama_dagang
        ];

        // Menggunakan db transaction

        // Memulai Transaksi
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->insert('tb_obat', $data);

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
    public function get_obat($data)
    {
        return $this->db->get_where('tb_obat', $data)->row_array();
    }

    /**
     * Mengubah data obat dalam tabel obat berdasarkan kode
     */
    public function update_obat($kode, $data)
    {
        // Menggunakan db transaction

        // Memulai transaksi
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->where('kode_obat', $kode);
        $this->db->update('tb_obat', $data);

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
    public function delete_obat($kode)
    {
        // Menggunakan db transaction

        // Memulai transaksi
        $this->db->trans_begin();

        // menjalankan query
        $this->db->where('kode_obat', $kode);
        $this->db->delete('tb_obat');

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
}
