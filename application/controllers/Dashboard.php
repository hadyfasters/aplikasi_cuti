 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Karyawan_model');
		$this->load->model('Departemen_model');
		$this->load->model('Jabatan_model');
		$this->load->model('Posisi_model');
		$this->load->model('Cuti_model');
		$this->load->model('Jeniscuti_model');
	}

	public function index()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['title'] = 'Home';
			$data['cuti'] = $this->Cuti_model->getAll();
			$data['ultah'] = $this->Karyawan_model->getUltah();
			$data['content'] = $this->load->view('dashboard', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function profil()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['title'] = 'Profil Perusahaan';
			$data['content'] = $this->load->view('profil_perusahaan', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}
}
