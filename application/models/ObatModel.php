<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ObatModel extends CI_Model {
    private $table = 'tb_obat';

    public function get_all()
    {
        $this->db->select('tb_obat.*, tb_pemasok.NamaPemasok, tb_jenisobat.JenisObat');
        $this->db->order_by('TanggalMasuk', 'DESC');
        $this->db->from($this->table);
        $this->db->join('tb_pemasok', 'tb_pemasok.idPemasok = tb_obat.idPemasok', 'inner');
        $this->db->join('tb_jenisobat', 'tb_jenisobat.idJenisObat = tb_obat.idJenisObat', 'inner');
        return $this->db->get()->result();
    }
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['idObat' => $id])->row();
    }

    public function updateStock($idObat, $quantity) {
        $this->db->set('StokObat', 'StokObat - ' . $quantity, FALSE);
        $this->db->where('idObat', $idObat);
        return $this->db->update($this->table);
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function update($id, $data) {
        $this->db->where('idObat', $id);
        return $this->db->update('tb_obat', $data);
    }
    
    public function delete($id) {
        return $this->db->delete($this->table, ['idObat' => $id]);
    }
    public function get_foto_by_id($id) {
        $this->db->select('FotoObat');
        $this->db->where('idObat', $id);
        return $this->db->get($this->table)->row();
    }
    public function search($term) {
        $this->db->select('tb_obat.*, tb_jenisobat.JenisObat, tb_pemasok.NamaPemasok');
        $this->db->from('tb_obat');
        $this->db->join('tb_jenisobat', 'tb_jenisobat.idJenisObat = tb_obat.idJenisObat', 'left');
        $this->db->join('tb_pemasok', 'tb_pemasok.idPemasok = tb_obat.idPemasok', 'left');
        $this->db->where("(tb_obat.NamaObat LIKE '%$term%' OR tb_obat.KodeObat LIKE '%$term%')");
        return $this->db->get()->result();
    }
    public function get_laporan_stok($bulan = null, $tahun = null) {
        $this->db->select('tb_obat.*, tb_pemasok.NamaPemasok, tb_jenisobat.JenisObat');
        $this->db->from($this->table);
        $this->db->join('tb_pemasok', 'tb_pemasok.idPemasok = tb_obat.idPemasok', 'left');
        $this->db->join('tb_jenisobat', 'tb_jenisobat.idJenisObat = tb_obat.idJenisObat', 'left');
        
        if ($bulan && $tahun) {
            $this->db->where('MONTH(TanggalMasuk)', $bulan);
            $this->db->where('YEAR(TanggalMasuk)', $tahun);
        }
        
        $this->db->order_by('NamaObat', 'ASC');
        return $this->db->get()->result();
    }

    // public function get_total_nilai_stok() {
    //     $this->db->select_sum('StokObat * HargaSatuan', 'total_nilai');
    //     return $this->db->get($this->table)->row()->total_nilai;
    // }
}