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
    public function insert_aturan()
    {
    }
}
