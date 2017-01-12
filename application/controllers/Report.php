 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Karyawan_model');
		$this->load->model('Departemen_model');
		$this->load->model('Jabatan_model');
		$this->load->model('Posisi_model');
		$this->load->model('Cuti_model');
		$this->load->model('Jeniscuti_model');
		$this->load->model('Report_model');
	}

	public function index()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');

			$data['title'] = 'Rekapitulasi Cuti';

			$data['list'] = $this->Report_model->getAllReport(); 
			
			if(isset($_GET['month']) && $_GET['month']<>'')
			{
				$data['list'] = $this->Report_model->getAllReportByMonth($_GET['month']);
			}

			if(isset($_GET['year']) && $_GET['year']<>'')
			{
				$data['list'] = $this->Report_model->getAllReportByYear($_GET['year']);
			}

			if(isset($_GET['year']) && $_GET['year']<>'' && isset($_GET['month']) && $_GET['month']<>'')
			{
				$data['list'] = $this->Report_model->getAllReportByMY($_GET['month'],$_GET['year']);
			}


			$data['content'] = $this->load->view('report', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	function download() 
	{ 
		$post = $this->input->post();

		define('FPDF_FONTPATH',$this->config->item('fonts_path')); 

		if($this->session->userdata('divisi') == 'D.01.16.11.002')
		{
			$data['hasil'] = $this->Report_model->getAllReport(); 
		}else{
			$data['hasil'] = $this->Report_model->getAllReportByDivisi($this->session->userdata('divisi')); 
		}
		
		$data['date'] = "";
		if($post['month']<>'')
		{
			$bln = $this->apps_model->getBulan($post['month']);
			$data['hasil'] = $this->Report_model->getAllReportByMonth($post['month']);
			$data['date'] = 'Bulan '.$bln;
		}
		if($post['year']<>'')
		{
			$bln = $this->apps_model->getBulan($post['month']);
			$data['hasil'] = $this->Report_model->getAllReportByYear($post['year']);
			$data['date'] = 'Tahun '.$post['year'];
		}
		if($post['month']<>'' && $post['year']<>'')
		{
			$bln = $this->apps_model->getBulan($post['month']);
			$data['hasil'] = $this->Report_model->getAllReportByMY($post['month'],$post['year']);
			$data['date'] = $bln." ".$post['year'];
		}

		$this->load->view('page_laporan', $data); 
	}
}
