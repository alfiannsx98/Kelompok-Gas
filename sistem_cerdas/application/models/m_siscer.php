<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siscer extends CI_Model
{

    /**
     * Mengambil kode_penyakit dari tabel keputusan
     */
    public function get_kode_penyakit($kode_penyakit)
    {
        $this->db->select('kode_opt');
        $this->db->from('tb_keputusan');
        foreach ($kode_penyakit['gejala'] as $kode) {
            $this->db->where($kode, 1);
        }
        return $this->db->get()->result_array();
    }

    /**
     * Mengambil seluruh rule dari database
     */
    public function get_all_rule()
    {
        return $this->db->get('tb_keputusan')->result_array();
    }

    /**
     * Mengambil seluruh obat berdasarkan kode penyakit
     */
    public function get_all_obat_penyakit()
    {
        $this->db->select('*');
        $this->db->from('tb_relasi_obt');
        $this->db->join('tb_opt', 'tb_relasi_obt.kode_opt = tb_opt.kode_opt');
        $this->db->join('tb_obat', 'tb_relasi_obt.kode_obat = tb_obat.kode_obat');
        $this->db->group_by('tb_relasi_obt.kode_opt');
        return $this->db->get()->result_array();
    }

    /**
     * Memasukkan data kedalam database
     */
    public function assign_obat($kode_opt, $kode_obat)
    {
        // Menggunakan db transaction
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->insert('tb_relasi_obt', ['kode_opt' => $kode_opt, 'kode_obat' => $kode_obat]);

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
}
