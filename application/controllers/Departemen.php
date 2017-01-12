 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Departemen_model');
	}

	public function index()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
			if(isset($_GET['id']) && $_GET['id'] <> '')
			{
				$dptm = $this->Departemen_model->getByCode($_GET['id']);
				$data['edit'] = 1;
				$data['kode'] = $dptm[0]->kode_dptm;
				$data['nama'] = $dptm[0]->nm_dptm;
				$data['inisial'] = $dptm[0]->inisial_dptm;
				$data['status'] = $dptm[0]->status_dptm;
			}
			$data['title'] = 'Data Departemen';
			$data['departemen'] = $this->Departemen_model->getAll();
			$data['content'] = $this->load->view('departemen', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function create()
	{
		$post = $this->input->post();

        $lastCode = $this->Departemen_model->getCode();

        $data = array(
        	'kode_dptm' => $lastCode,
        	'nm_dptm' => $post['nm_dptm'],
        	'inisial_dptm' => $post['inisial'],
        	'status_dptm' => 1
        );

        $proceed = $this->Departemen_model->saveDepartemen($data);

        if($proceed){
            $message = " New Department Has Been Added. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('departemen');
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('departemen');
        }
	}

	public function edit()
	{
		$post = $this->input->post();

        $id = $post['kode_dptm'];

        $data = array(
        	'nm_dptm' => $post['nm_dptm'],
        	'inisial_dptm' => $post['inisial'],
        	'status_dptm' => $post['status_dptm']
        );

        $proceed = $this->Departemen_model->updateDepartemen($data,$id);

        if($proceed){
            $message = " Department Has Been Edited. ";
            if($proceed <> 1)
            {
                $message = $proceed;
            }
            $this->session->set_flashdata('errors', $message);
        	redirect('departemen');
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('departemen');
        }
	}

	public function delete()
	{
		$id = $this->input->get('id');

        $proceed = $this->Departemen_model->deleteDepartemen($id);

        if($proceed){
            $message = " Department Has Been Deleted. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('departemen');
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('departemen');
        }
	}
}
