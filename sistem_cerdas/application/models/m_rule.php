<?php

class M_rule extends CI_Model
{

    /**
     * Mengambil seluruh aturan dari tabel aturan dalam bentuk array
     */
    public function get_all_aturan()
    {
        $this->db->select("*");
        $this->db->from("tb_keputusan");
        $this->db->join("tb_opt", "tb_keputusan.kode_opt = tb_opt.kode_opt");
        $this->db->group_by("tb_keputusan.kode_opt");
        return $this->db->get()->result_array();
    }


    /**
     * Mengambil rule berdasarkan kode opt
     */
    public function check_opt($kode_opt)
    {
        return $this->db->get_where('tb_keputusan', ['kode_opt' => $kode_opt])->num_rows();
    }

    /**
     * Menambahkan OPT beserta Gejala kedalam tabel
     */
    public function insert_aturan($aturan)
    {
        // Menggunakan db transaction
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->insert('tb_keputusan', $aturan);

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
     * Mengubah OPT berserta gejala dalam tabel
     */
    public function update_aturan($kode_opt, $kode_gejala)
    {

        // Menggunakan db transcation
        $this->db->trans_begin();

        // Menjalankan query
        $this->db->where('kode_opt', $kode_opt);
        $this->db->update('tb_keputusan', $kode_gejala);

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
     * Mengambil aturan berdasarkan kode opt nya
     */
    public function get_rule($data)
    {
        $this->db->select('*');
        $this->db->from('tb_keputusan');
        $this->db->join("tb_opt", "tb_keputusan.kode_opt = tb_opt.kode_opt");
        $this->db->where($data);
        return $this->db->get()->result_array();
    }

    /**
     * Mengambil gejala dari tabel gejala berdasarkan rule dan kode opt
     */
    public function get_gejala_rule($kode)
    {
        $this->db->select('*');
        return $this->db->get_where('tb_gejala', ['kode_gejala' => $kode])->result_array();
    }

    /**
     * Menghapus aturan dalam tabel aturan berdasarkan kode opt
     */
    public function delete_rule($kode_opt)
    {
        // Menggunakan db transaction

        // Memulai transaksi
        $this->db->trans_begin();

        // menjalankan query
        $this->db->where('kode_opt', $kode_opt);
        $this->db->delete('tb_keputusan');

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
