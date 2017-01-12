<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_Model extends CI_Model {

	/**
	 * @author : M. Hadiansyah
	 * @web : http://mhadiansyah.web.id
	 * @keterangan : Model untuk menangani semua query pada tabel Jabatan
	 **/

    public function getCode()
    {
        $now = date("y.m");

        $query = $this->db->query("SELECT max(kode_jabatan) AS last FROM ms_jabatan WHERE kode_jabatan LIKE '%$now%'");

        $last = $query->result();

        $lastCode = $last[0]->last;
        $urutan = substr($lastCode, 11, 3);
        $nextUrutan = $urutan + 1;

        $nextCode = "J.02.".$now.".".sprintf('%03s',$nextUrutan);

        return $nextCode;
    }

    public function getByCode($code)
    {
        $this->db->where('kode_jabatan',$code);
        $query = $this->db->get('ms_jabatan');
        return $query->result();
    }

    public function getAll()
    {
        $this->db->order_by('nama_jabatan','asc');
        $query = $this->db->get('ms_jabatan');
        return $query->result();
    }

    public function saveJabatan($data)
    {
        $jabatan = $this->getByCode($data['kode_jabatan']);
        if(count($jabatan) == 0){
            $this->db->trans_start();
            $query = $this->db->insert('ms_jabatan',$data);
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

    public function updateJabatan($data,$code)
    {
        $jabatan = $this->getByCode($code);
        if(count($jabatan) > 0){
            $this->db->trans_start();
            $this->db->where('kode_jabatan',$code);
            $query = $this->db->update('ms_jabatan',$data);
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

    public function deleteJabatan($code)
    {
        $jabatan = $this->getByCode($code);
        if(count($jabatan) > 0){
            $this->db->trans_start();
            $this->db->where('kode_jabatan',$code);
            $query = $this->db->delete('ms_jabatan');
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
	
/* End of file Jabatan_Model.php */
/* Location: ./application/models/Jabatan_Model.php */