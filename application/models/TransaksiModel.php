<?php
class TransaksiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_obat()
    {
        $this->db->where('StokObat >=', 0);
        $this->db->order_by('NamaObat', 'ASC');
        return $this->db->get('tb_obat')->result();
    }

    // public function search_obat($keyword)
    // {
    //     $this->db->like('NamaObat', $keyword);
    //     $this->db->or_like('KodeObat', $keyword);
    //     $this->db->where('StokObat >', 0);
    //     $this->db->where('ExpObat >=', date('Y-m-d'));
    //     return $this->db->get('tb_obat')->result();
    // }
    public function cek_obat_kadaluarsa($idObat)
    {
        $this->db->where('idObat', $idObat);
        $this->db->where('ExpObat <', date('Y-m-d'));
        $query = $this->db->get('tb_obat');
        return $query->num_rows() > 0;
    }
    public function get_active_resep()
    {
        $this->db->where('Status', 0);
        return $this->db->get('tb_resep')->result();
    }

    public function get_resep_by_id($idResep)
    {
        $this->db->where('idResep', $idResep);
        $query = $this->db->get('tb_resep');
        return $query->row();
    }
    public function get_obat_by_id($idObat)
    {
        return $this->db->get_where('tb_obat', ['idObat' => $idObat])->row();
    }

    public function insert_transaksi($data)
    {
        $this->db->insert('tb_transaksi', $data);
        return $this->db->insert_id(); 
    }

    public function update_stok_obat($idObat, $jumlahDibeli)
    {
        $this->db->where('idObat', $idObat);
        $this->db->set('StokObat', 'StokObat - ' . $jumlahDibeli, FALSE);
        return $this->db->update('tb_obat');
    }

    public function update_resep_status($idResep, $status)
    {
        $this->db->where('idResep', $idResep);
        return $this->db->update('tb_resep', ['Status' => $status]);
    }

    public function get_all_transaksi()
    {
        $this->db->select('t.*, o.NamaObat,o.KodeObat, r.NamaDokter, r.NamaPelanggan');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_obat o', 't.idObat = o.idObat');
        $this->db->join('tb_resep r', 't.idResep = r.idResep', 'left');
        $this->db->order_by('t.TanggalTransaksi', 'DESC');
        return $this->db->get()->result();
    }
    public function get_transaksi_by_id($idTransaksi)
    {
        $this->db->select('t.*, o.NamaObat, o.KodeObat, r.NamaDokter, r.NamaPelanggan, r.AlamatPelanggan');
        $this->db->from('tb_transaksi t');
        $this->db->join('tb_obat o', 't.idObat = o.idObat');
        $this->db->join('tb_resep r', 't.idResep = r.idResep', 'left');
        $this->db->where('t.idTransaksi', $idTransaksi);
        return $this->db->get()->row();
    }
    public function get_latest_transaction()
    {
        $this->db->select('t.*, t.JumlahDibeli, o.KodeObat, o.NamaObat, r.NamaDokter, r.NamaPelanggan, r.AlamatPelanggan')
            ->from('tb_transaksi t')
            ->join('tb_obat o', 't.idObat = o.idObat')
            ->join('tb_resep r', 't.idResep = r.idResep', 'left')
            ->where('t.Status', 'Lunas')
            ->order_by('t.TanggalTransaksi', 'DESC')
            ->limit(1);
        return $this->db->get()->row();
    }
    public function get_transactions_by_group($noTransaksi)
    {
        return $this->db
            ->select('t.*, o.KodeObat, o.NamaObat, o.HargaJual as HargaSatuan, 
                t.JumlahDibeli, t.JumlahBayar, t.Kembalian')
            ->from('tb_transaksi t')
            ->join('tb_obat o', 't.idObat = o.idObat')
            ->where('t.NoTransaksi', $noTransaksi)
            ->get()
            ->result();
    }
    public function get_penjualan_harian($hari = 7)
    {
        $query = $this->db->query("
        SELECT 
            DATE(TanggalTransaksi) as tanggal,
            SUM(TotalHarga) as total_penjualan,
            COUNT(*) as jumlah_transaksi
        FROM tb_transaksi 
        WHERE TanggalTransaksi >= DATE_SUB(CURRENT_DATE(), INTERVAL ? DAY)
        GROUP BY DATE(TanggalTransaksi)
        ORDER BY tanggal ASC
    ", [$hari]);

        return $query->result();
    }

    public function get_penjualan_mingguan($minggu = 4)
    {
        $query = $this->db->query("
        SELECT 
            YEARWEEK(TanggalTransaksi) as minggu,
            MIN(DATE(TanggalTransaksi)) as awal_minggu,
            MAX(DATE(TanggalTransaksi)) as akhir_minggu,
            SUM(TotalHarga) as total_penjualan,
            COUNT(*) as jumlah_transaksi
        FROM tb_transaksi
        WHERE TanggalTransaksi >= DATE_SUB(CURRENT_DATE(), INTERVAL ? WEEK)
        GROUP BY YEARWEEK(TanggalTransaksi)
        ORDER BY minggu ASC
    ", [$minggu]);

        return $query->result();
    }
    public function get_total_transaksi_hari_ini()
    {
        $today = date('Y-m-d');
        $this->db->select_sum('TotalHarga');
        $this->db->from('tb_transaksi');
        $this->db->where('DATE(TanggalTransaksi)', $today);
        $this->db->where('Status', 'Lunas');

        $result = $this->db->get()->row();
        return isset($result->TotalHarga) ? $result->TotalHarga : 0;
        //proses untuk tampilan dashboard untuk total penjualan hari ini jika untuk besok maka ke reset ke 0
    }
    public function get_laporan_transaksi($bulan, $tahun)
    {
        $this->db->select('
        tb_transaksi.NoTransaksi,
        tb_transaksi.TanggalTransaksi,
        tb_resep.NamaPelanggan,
        tb_obat.NamaObat,
        tb_transaksi.JumlahDibeli,
        tb_obat.HargaJual,
        (tb_transaksi.JumlahDibeli * tb_obat.HargaJual) AS TotalHarga, 
        tb_transaksi.Status
    ');// Perkalian jumlah dibeli dengan harga jual
        $this->db->from('tb_transaksi');
        $this->db->join('tb_resep', 'tb_transaksi.idResep = tb_resep.idResep', 'left');
        $this->db->join('tb_obat', 'tb_transaksi.idObat = tb_obat.idObat', 'left');
        $this->db->where('MONTH(tb_transaksi.TanggalTransaksi)', $bulan);
        $this->db->where('YEAR(tb_transaksi.TanggalTransaksi)', $tahun);
        $query = $this->db->get();
        return $query->result();
    }
    
}
