<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jeniscuti_Model extends CI_Model {

	/**
	 * @author : M. Hadiansyah
	 * @web : http://mhadiansyah.web.id
	 * @keterangan : Model untuk menangani semua query pada tabel Master Cuti
	 **/

    public function getCode()
    {
        $now = date("y.m");

        $query = $this->db->query("SELECT max(kode_cuti) AS last FROM ms_cuti WHERE kode_cuti LIKE '%$now%'");

        $last = $query->result();

        $lastCode = $last[0]->last;
        $urutan = substr($lastCode, 12, 3);
        $nextUrutan = $urutan + 1;

        $nextCode = "JC.03.".$now.".".sprintf('%03s',$nextUrutan);

        return $nextCode;
    }

    public function getByCode($code)
    {
        $this->db->where('kode_cuti',$code);
        $query = $this->db->get('ms_cuti');
        return $query->result();
    }

    public function getAll()
    {
        $this->db->order_by('kode_cuti','desc');
        $query = $this->db->get('ms_cuti');
        return $query->result();
    }

    public function save($data)
    {
        $dt = $this->getByCode($data['kode_cuti']);
        if(count($dt) == 0){
            $this->db->trans_start();
            $query = $this->db->insert('ms_cuti',$data);
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
        $dt = $this->getByCode($code);
        if(count($dt) > 0){
            $this->db->trans_start();
            $this->db->where('kode_cuti',$code);
            $query = $this->db->update('ms_cuti',$data);
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
        $dt = $this->getByCode($code);
        if(count($dt) > 0){
            $this->db->trans_start();
            $this->db->where('kode_cuti',$code);
            $query = $this->db->delete('ms_cuti');
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
	
/* End of file Jeniscuti_Model.php */
/* Location: ./application/models/Jeniscuti_Model.php */