<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posisi_Model extends CI_Model {

    /**
     * @author : M. Hadiansyah
     * @web : http://mhadiansyah.web.id
     * @keterangan : Model untuk menangani semua query pada tabel Master Posisi Karyawan
     **/

    public function getByCode($code)
    {
        $query = $this->db->query('SELECT a.*,b.*,(select nama_jabatan FROM ms_jabatan WHERE a.kode_jabatan=kode_jabatan) as jabatan,(select nama_jabatan FROM ms_jabatan WHERE a.atasan_1=kode_jabatan) as atasan_langsung FROM ms_posisi_karyawan a LEFT JOIN ms_karyawan b ON b.nik = a.nik LEFT JOIN ms_jabatan c ON c.kode_jabatan = a.kode_jabatan WHERE a.no_kontrak="'.$code.'" ORDER BY a.tgl_kontrak');
        return $query->result();
    }

    public function getByNIK($code)
    {
        $query = $this->db->query('SELECT a.*,b.*,(select nama_jabatan FROM ms_jabatan WHERE a.kode_jabatan=kode_jabatan) as jabatan,(select nama_jabatan FROM ms_jabatan WHERE a.atasan_1=kode_jabatan) as atasan_langsung FROM ms_posisi_karyawan a LEFT JOIN ms_karyawan b ON b.nik = a.nik LEFT JOIN ms_jabatan c ON c.kode_jabatan = a.kode_jabatan WHERE a.nik="'.$code.'" ORDER BY a.tgl_kontrak DESC');
        return $query->result();
    }

    public function getAll()
    {
        $query = $this->db->query('SELECT * FROM ms_posisi_karyawan a LEFT JOIN ms_karyawan b ON b.nik = a.nik LEFT JOIN ms_departemen c ON c.kode_dptm = a.department WHERE b.status_karyawan=1 ORDER BY a.tgl_kontrak');
        return $query->result();
    }

    public function save($data)
    {
        $dt = $this->getByCode($data['no_kontrak']);
        if(count($dt) == 0){
            $this->db->trans_start();
            $query = $this->db->insert('ms_posisi_karyawan',$data);
            $affected_rows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affected_rows){
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }

    public function delete($code)
    {
        $dt = $this->getByCode($code);
        if(count($dt) > 0){
            $this->db->trans_start();
            $this->db->where('no_kontrak',$code);
            $query = $this->db->delete('ms_posisi_karyawan');
            $affected_rows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affected_rows){
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }

}
    
/* End of file Posisi_Model.php */
/* Location: ./application/models/Posisi_Model.php */