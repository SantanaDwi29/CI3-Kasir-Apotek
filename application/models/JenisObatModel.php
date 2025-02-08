<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisObatModel extends CI_Model {
    
    private $table = 'tb_jenisobat'; 
    
    public function get_all() {
        $this->db->select('idJenisObat, JenisObat, Keterangan');
        $this->db->order_by('JenisObat', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['idJenisObat' => $id])->row();
    }
    
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
    
    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['idJenisObat' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete($this->table, ['idJenisObat' => $id]);
    }
}