<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuti_Model extends CI_Model {

	/**
	 * @author : M. Hadiansyah
	 * @web : http://mhadiansyah.web.id
	 * @keterangan : Model untuk menangani semua query pada tabel Cuti
	 **/

    public function getCode()
    {
        $now = date("y.m");

        $query = $this->db->query("SELECT max(no_pengajuan) AS last FROM dt_pengajuan_cuti WHERE no_pengajuan LIKE '%$now%'");

        $last = $query->result();

        $lastCode = $last[0]->last;
        $urutan = substr($lastCode, 11, 3);
        $nextUrutan = $urutan + 1;

        $nextCode = "ISC.04.".$now.".".sprintf('%03s',$nextUrutan);

        return $nextCode;
    }

    public function getByCode($code)
    {
        $this->db->where('no_pengajuan',$code);
        $query = $this->db->get('dt_pengajuan_cuti');
        return $query->result();
    }

    public function getAll()
    {
        $sq = "SELECT a.no_pengajuan,a.nik,b.nm_lengkap,c.nm_cuti,d.nama_jabatan,e.nm_dptm,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_karyawan b ON b.nik=a.nik LEFT JOIN ms_cuti c ON c.kode_cuti=a.cuti LEFT JOIN ms_jabatan d ON d.kode_jabatan=b.jabatan LEFT JOIN ms_departemen e ON e.kode_dptm=b.departemen";
        $query = $this->db->query($sq);
        return $query->result();
    }

    public function getAllApproved()
    {
        $sq = "SELECT a.no_pengajuan,a.nik,b.nm_lengkap,c.nm_cuti,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_karyawan b ON b.nik=a.nik LEFT JOIN ms_cuti c ON c.kode_cuti=a.cuti WHERE a.approval=1";
        $query = $this->db->query($sq);
        return $query->result();
    }

    public function getSisaCuti($nik,$cuti)
    {
        $sq = "SELECT a.no_pengajuan,a.nik,a.cuti,b.nm_cuti,b.jumlah_max,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_cuti b ON b.kode_cuti=a.cuti WHERE a.nik='".$nik."' AND a.cuti='".$cuti."' AND YEAR(tgl_pengajuan)='".date('Y')."'";
        $query = $this->db->query($sq);
        return $query->result();
    }

    public function getByNIK($code)
    {
        $sq = "SELECT a.no_pengajuan,b.nm_lengkap,c.nm_cuti,a.tgl_awal,a.tgl_akhir,a.jumlah,a.tgl_pengajuan,a.approval,a.validasi,a.keterangan FROM dt_pengajuan_cuti a LEFT JOIN ms_karyawan b ON b.nik=a.nik LEFT JOIN ms_cuti c ON c.kode_cuti=a.cuti WHERE a.nik='".$code."'";
        $query = $this->db->query($sq);
        return $query->result();
    }

    public function save($data)
    {
        $dtc = $this->getByCode($data['no_pengajuan']);
        if(count($dtc) == 0){
            $this->db->trans_start();
            $query = $this->db->insert('dt_pengajuan_cuti',$data);
            $affected_rows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affected_rows){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    public function update($data,$code)
    {
        $dtc = $this->getByCode($code);
        if(count($dtc) > 0){
            $this->db->trans_start();
            $this->db->where('no_pengajuan',$code);
            $query = $this->db->update('dt_pengajuan_cuti',$data);
            $affected_rows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affected_rows){
                return TRUE;
            }else{
                $message = " Nothing Changes. ";
                return $message;
            }
        }else{
            return FALSE;
        }
    }

    public function delete($code)
    {
        $dptm = $this->getByCode($code);
        if(count($dptm) > 0){
            $this->db->trans_start();
            $this->db->where('no_pengajuan',$code);
            $query = $this->db->delete('dt_pengajuan_cuti');
            $affected_rows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affected_rows){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

}
	
/* End of file Cuti_model.php */
/* Location: ./application/models/Cuti_model.php */