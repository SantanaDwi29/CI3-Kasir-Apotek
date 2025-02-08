<?php
class PenggunaModel extends CI_Model {
    private $table = 'tb_login'; 

    public function get_all() {
        $this->db->select('idLogin, Username, Password, NamaLengkap,NoTelepon, Level');
        $this->db->order_by('Username', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['idLogin' => $id])->row();
    }
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['idLogin' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete($this->table, ['idLogin' => $id]);
    }
}