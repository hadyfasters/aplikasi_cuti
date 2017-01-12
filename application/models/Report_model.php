<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Model extends CI_Model {

	/**
	 * @author : M. Hadiansyah
	 * @web : http://mhadiansyah.web.id
	 * @keterangan : Model untuk menangani semua query pada modul Report
	 **/

    public function getAllReport()
    {
        $sq = "SELECT a.no_pengajuan,a.nik,b.nm_lengkap,c.nm_cuti,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_karyawan b ON b.nik=a.nik LEFT JOIN ms_cuti c ON c.kode_cuti=a.cuti";
        $query = $this->db->query($sq);
        return $query->result();
    }

    public function getAllReportByMonth($month)
    {
        $sq = "SELECT a.no_pengajuan,a.nik,b.nm_lengkap,c.nm_cuti,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_karyawan b ON b.nik=a.nik LEFT JOIN ms_cuti c ON c.kode_cuti=a.cuti WHERE MONTH(tgl_pengajuan)=".$month;
        $query = $this->db->query($sq);
        return $query->result();
    }

    public function getAllReportByYear($year)
    {
        $sq = "SELECT a.no_pengajuan,a.nik,b.nm_lengkap,c.nm_cuti,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_karyawan b ON b.nik=a.nik LEFT JOIN ms_cuti c ON c.kode_cuti=a.cuti WHERE YEAR(tgl_pengajuan)=".$year;
        $query = $this->db->query($sq);
        return $query->result();
    }

    public function getAllReportByMY($month,$year)
    {
        $sq = "SELECT a.no_pengajuan,a.nik,b.nm_lengkap,c.nm_cuti,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_karyawan b ON b.nik=a.nik LEFT JOIN ms_cuti c ON c.kode_cuti=a.cuti WHERE MONTH(tgl_pengajuan)=".$month." AND YEAR(tgl_pengajuan)=".$year;
        $query = $this->db->query($sq);
        return $query->result();
    }

}
	
/* End of file Cuti_model.php */
/* Location: ./application/models/Cuti_model.php */