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
}
