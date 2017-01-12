<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_Model extends CI_Model {

	/**
	 * @author : M. Hadiansyah
	 * @web : http://mhadiansyah.web.id
	 * @keterangan : Model untuk menangani semua query pada tabel Master Karyawan
	 **/

    public function getCode($tgl_masuk,$tgl_lahir)
    {
        $tgl_1 = date("m.y",strtotime($tgl_masuk));
        $tgl_2 = date("m.d",strtotime($tgl_lahir));

        $rand = sprintf("%05d",rand("00001","99999"));

        $nextCode = $rand.".".$tgl_2.".".$tgl_1;

        return $nextCode;
    }

    public function getByCode($code)
    {
        $this->db->where('nik',$code);
        $query = $this->db->get('ms_karyawan');
        return $query->result();
    }

    public function getAll()
    {
        $this->db->order_by('tgl_masuk','desc');
        $query = $this->db->get('ms_karyawan');
        return $query->result();
    }

    public function getUltah()
    {
        $uq = "SELECT * FROM ms_karyawan a LEFT JOIN ms_departemen b ON b.kode_dptm=a.departemen LEFT JOIN ms_jabatan c ON c.kode_jabatan=a.jabatan WHERE a.tgl_lahir='".date('Y-m-d')."'";
        $query = $this->db->query($uq);
        return $query->result();
    }

    public function save($data)
    {
        $dt = $this->getByCode($data['nik']);
        if(count($dt) == 0){
            $this->db->trans_start();
            $query = $this->db->insert('ms_karyawan',$data);
            $affected_rows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affected_rows){
                return TRUE;
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
            $this->db->where('nik',$code);
            $query = $this->db->update('ms_karyawan',$data);
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
            $this->db->where('nik',$code);
            $query = $this->db->delete('ms_karyawan');
            $affected_rows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affected_rows){
                @unlink('./assets/files/'.$dt[0]->foto);
                @unlink('./assets/files/'.$dt[0]->ttd);
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }

}
	
/* End of file Karyawan_Model.php */
/* Location: ./application/models/Karyawan_Model.php */