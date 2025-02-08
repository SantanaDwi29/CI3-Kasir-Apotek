<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResepModel extends CI_Model {
    private $table = 'tb_resep';
    
    public function get_all() {
        $this->db->select('idResep, NamaDokter, TanggalResep, NamaPelanggan, AlamatPelanggan,Status');
        $this->db->order_by('TanggalResep', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        $this->db->select('idResep, NamaDokter, NamaPelanggan, AlamatPelanggan, TanggalResep,Status');
        return $this->db->get_where($this->table, ['idResep' => $id])->row();
    }
    
    
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['idResep' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete($this->table, ['idResep' => $id]);
    }
}