<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_cuti extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jeniscuti_model');
	}

	public function index()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
			if(isset($_GET['id']) && $_GET['id'] <> '')
			{
				$dt = $this->Jeniscuti_model->getByCode($_GET['id']);
				$data['edit'] = 1;
				$data['kode'] = $dt[0]->kode_cuti;
				$data['nama'] = $dt[0]->nm_cuti;
				$data['jumlah_max'] = $dt[0]->jumlah_max;
                $data['status'] = $dt[0]->status;
                switch ($dt[0]->grup) {
                    case 1: $dt[0]->grup = "Pria"; break;
                    case 2: $dt[0]->grup = "Wanita"; break;
                    default: $dt[0]->grup = "Semua"; break;
                }
                $data['grup'] = $dt[0]->grup;
			}
			$data['title'] = 'Data Jenis Cuti';
			$data['list'] = $this->Jeniscuti_model->getAll();
			$data['content'] = $this->load->view('jenis_cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function create()
	{
		$post = $this->input->post();

        $lastCode = $this->Jeniscuti_model->getCode();

        $data = array(
        	'kode_cuti' => $lastCode,
        	'nm_cuti' => $post['nm_cuti'],
        	'jumlah_max' => $post['jumlah_max'],
            'grup' => $post['grup'],
        	'status' => 1
        );

        $proceed = $this->Jeniscuti_model->save($data);

        if($proceed){
            $message = " New Jenis Cuti Has Been Added. ";
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('jenis_cuti');
	}

	public function edit()
	{
		$post = $this->input->post();

        $id = $post['kode_cuti'];
        if($post['status'] == "")
        {
            $data = array(
                'nm_cuti' => $post['nm_cuti'],
                'jumlah_max' => $post['jumlah_max'],
                'grup' => $post['grup']
            );
        }else{
            $data = array(
                'nm_cuti' => $post['nm_cuti'],
                'jumlah_max' => $post['jumlah_max'],
                'grup' => $post['grup'],
                'status' => $post['status']
            );
        }

        $proceed = $this->Jeniscuti_model->update($data,$id);

        if($proceed){
            $message = " Jenis Cuti Has Been Updated. ";
            if($proceed <> 1)
            {
                $message = $proceed;
            }
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('jenis_cuti');
	}

	public function delete()
	{
		$id = $this->input->get('id');

        $proceed = $this->Jeniscuti_model->delete($id);

        if($proceed){
            $message = " Jenis Cuti Has Been Deleted. ";
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('jenis_cuti');
	}
}
