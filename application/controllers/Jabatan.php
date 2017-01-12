 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jabatan_model');
	}

	public function index()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
			if(isset($_GET['id']) && $_GET['id'] <> '')
			{
				$jbt = $this->Jabatan_model->getByCode($_GET['id']);
				$data['edit'] = 1;
				$data['kode'] = $jbt[0]->kode_jabatan;
				$data['nama'] = $jbt[0]->nama_jabatan;
				$data['inisial'] = $jbt[0]->inisial_jabatan;
                $data['prioritas'] = $jbt[0]->prioritas_jabatan;
				$data['status'] = $jbt[0]->status_jabatan;
			}
			$data['title'] = 'Data Jabatan';
			$data['jabatan'] = $this->Jabatan_model->getAll();
			$data['content'] = $this->load->view('jabatan', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function create()
	{
		$post = $this->input->post();

        $lastCode = $this->Jabatan_model->getCode();

        $data = array(
        	'kode_jabatan' => $lastCode,
        	'nama_jabatan' => $post['nama_jabatan'],
        	'inisial_jabatan' => $post['inisial_jabatan'],
            'prioritas_jabatan' => 0,
        	'status_jabatan' => 1
        );

        $proceed = $this->Jabatan_model->saveJabatan($data);

        if($proceed){
            $message = " New Jabatan Has Been Added. ";
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('jabatan');
	}

	public function edit()
	{
		$post = $this->input->post();

        $id = $post['kode_jabatan'];

        $data = array(
        	'nama_jabatan' => $post['nama_jabatan'],
        	'inisial_jabatan' => $post['inisial_jabatan'],
            'prioritas_jabatan' => $post['prioritas_jabatan'],
        	'status_jabatan' => $post['status_jabatan']
        );

        $proceed = $this->Jabatan_model->updateJabatan($data,$id);

        if($proceed){
            $message = " Jabatan Has Been Updated. ";
            if($proceed <> 1)
            {
                $message = $proceed;
            }
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('jabatan');
	}

	public function delete()
	{
		$id = $this->input->get('id');

        $proceed = $this->Jabatan_model->deleteJabatan($id);

        if($proceed){
            $message = " Jabatan Has Been Deleted. ";
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('jabatan');
	}
}
