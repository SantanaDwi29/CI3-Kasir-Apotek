<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemasokModel extends CI_Model {
    
    private $table = 'tb_pemasok';
    
    public function get_all() {
        $this->db->select('idPemasok, NamaPemasok, Alamat, Telepon, Email');
        $this->db->order_by('NamaPemasok', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['idPemasok' => $id])->row();
    }
    
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['idPemasok' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete($this->table, ['idPemasok' => $id]);
    }
}