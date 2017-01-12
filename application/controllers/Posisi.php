<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posisi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Karyawan_model');
        $this->load->model('Departemen_model');
        $this->load->model('Jabatan_model');
        $this->load->model('Posisi_model');
	}

    public function index()
    {
        if(!empty($this->session->userdata('logged_in'))) {
            $data['message'] = $this->session->flashdata('errors');
            $data['title'] = 'Data Posisi Karyawan';
            $data['list'] = $this->Posisi_model->getAll();
            $data['content'] = $this->load->view('posisi', $data, true);
            $this->load->view('template',$data);
        }else{
            redirect('login/logout');
        }
    }

    public function add()
    {
        if(!empty($this->session->userdata('logged_in'))) {
            $data['message'] = $this->session->flashdata('errors');
            if(isset($_GET['id']) && $_GET['id'] <> '')
            {
                $id = $this->input->get('id');
                $dt = $this->Karyawan_model->getByCode($id);
                $dpt = $this->Departemen_model->getByCode($dt[0]->departemen);
                $jbt = $this->Jabatan_model->getByCode($dt[0]->jabatan);
                $data['jabatan'] = $this->Jabatan_model->getAll();
                $data['departemen'] = $this->Departemen_model->getAll();
                $data['nik'] = $dt[0]->nik;
                $data['nm_lengkap'] = $dt[0]->nm_lengkap;
                $data['dptm'] = $dt[0]->departemen;
                $data['jbtn'] = $dt[0]->jabatan;
            }
            $data['title'] = 'Update Data Posisi';
            $data['content'] = $this->load->view('add_posisi', $data, true);
            $this->load->view('template',$data);
        }else{
            redirect('login/logout');
        }
    }

    public function create()
    {
        $post = $this->input->post();

        $tgl_kontrak = date("Y-m-d",strtotime($post['tgl_kontrak']));

        $id = $post['nik'];
        $data['nik'] = $post['nik'];
        $data['departemen'] = $post['departemen'];
        $data['kode_jabatan'] = $post['jabatan'];
        $data['atasan_1'] = $post['atasan_1'];
        $data['atasan_2'] = $post['atasan_2'];
        $data['no_kontrak'] = $post['no_kontrak'];
        $data['tgl_kontrak'] = $tgl_kontrak;

        // BERKAS UPLOADER
        if ($file['file_kontrak']['error'] === 0){   

            $filename = str_replace(".","",$id)."_FILE_KONTRAK";
            $dk = $this->Karyawan_model->getByCode($id);

            $config['upload_path'] = './assets/files/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = TRUE;
            $config['file_name'] = $filename;
            $this->upload->initialize($config);
            if($this->upload->do_upload('file_kontrak')){
                $upl = $this->upload->data();
                $data['file_kontrak'] = $upl['file_name'];
                
                @unlink($_FILES['file_kontrak']);
            }else{
                $message = $this->upload->display_errors('', '');
                $this->session->set_flashdata('errors', $message);
                redirect('posisi/edit_data?id='.$id);
            }

        }

        $proceed = $this->Posisi_model->save($data);

        if($proceed){
            $message = " New Posisi Has Been Added. ";
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('karyawan/view?id='.$post['nik']);
    }

	public function delete()
	{
		$id = $this->input->get('no');

        $dk = $this->Posisi_model->getByCode($id);
        if(count($dk) > 0)
        {
            $proceed = $this->Posisi_model->delete($id);

            if($proceed){
                $message = " Posisi Has Been Deleted. ";
                $this->session->set_flashdata('errors', $message);
            } else {
                $message = " There is something error. ";
                $this->session->set_flashdata('errors', $message);
            }
            redirect('karyawan/view?id='.$dk[0]->nik);
        }
        redirect('karyawan');
	}
}
