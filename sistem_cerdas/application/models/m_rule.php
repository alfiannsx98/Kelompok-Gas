<?php

class M_rule extends CI_Model
{

    /**
     * Mengambil seluruh aturan dari tabel aturan dalam bentuk array
     */
    public function get_all_aturan()
    {
        $this->db->select("*");
        $this->db->from("tb_rule");
        $this->db->join("tb_opt", "tb_rule.kode_opt = tb_opt.kode_opt");
        $this->db->join("tb_gejala", "tb_rule.kode_gejala = tb_gejala.kode_gejala");
        $this->db->group_by("tb_rule.kode_opt");
        return $this->db->get()->result_array();
    }

    /**
     * Menambahkan OPT beserta Gejala kedalam tabel
     */
    public function insert_aturan($kode_opt, $kode_gejala)
    {
        $data = [
            'kode_opt' => $kode_opt,
            'kode_gejala' => $kode_gejala
        ];

        // Menggunakan db transaction

        // Memulai Transaksi
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->insert('tb_rule', $data);

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
