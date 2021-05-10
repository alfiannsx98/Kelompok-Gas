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
     * Menambahkan obat kedalam tabel obat
     */
    public function insert_obat($data)
    {
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
        return $this->db->get_where('tb_obat', $data)->result_array();
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
