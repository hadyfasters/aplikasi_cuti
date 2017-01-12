<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departemen_Model extends CI_Model {

	/**
	 * @author : M. Hadiansyah
	 * @web : http://mhadiansyah.web.id
	 * @keterangan : Model untuk menangani semua query pada tabel Departemen
	 **/

    public function getCode()
    {
        $now = date("y.m");

        $query = $this->db->query("SELECT max(kode_dptm) AS last FROM ms_departemen WHERE kode_dptm LIKE '%$now%'");

        $last = $query->result();

        $lastCode = $last[0]->last;
        $urutan = substr($lastCode, 11, 3);
        $nextUrutan = $urutan + 1;

        $nextCode = "D.01.".$now.".".sprintf('%03s',$nextUrutan);

        return $nextCode;
    }

    public function getByCode($code)
    {
        $this->db->where('kode_dptm',$code);
        $query = $this->db->get('ms_departemen');
        return $query->result();
    }

    public function getAll()
    {
        $this->db->order_by('nm_dptm','asc');
        $query = $this->db->get('ms_departemen');
        return $query->result();
    }

    public function saveDepartemen($data)
    {
        $dptm = $this->getByCode($data['kode_dptm']);
        if(count($dptm) == 0){
            $this->db->trans_start();
            $query = $this->db->insert('ms_departemen',$data);
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

    public function updateDepartemen($data,$code)
    {
        $dptm = $this->getByCode($code);
        if(count($dptm) > 0){
            $this->db->trans_start();
            $this->db->where('kode_dptm',$code);
            $query = $this->db->update('ms_departemen',$data);
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

    public function deleteDepartemen($code)
    {
        $dptm = $this->getByCode($code);
        if(count($dptm) > 0){
            $this->db->trans_start();
            $this->db->where('kode_dptm',$code);
            $query = $this->db->delete('ms_departemen');
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
	
/* End of file Departemen_model.php */
/* Location: ./application/models/Departemen_model.php */