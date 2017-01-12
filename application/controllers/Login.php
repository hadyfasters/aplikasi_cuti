 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		if(empty($this->session->userdata('logged_in'))) {
			$data['title'] = 'Login';
			$this->load->view('login',$data);
		}else{
			redirect('/');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}

	public function doLogin()
	{
		$post = $this->input->post();

		// Admin Login
		$email = $post['email'];
		$password = MD5($post['password']);
		$qry = "SELECT * FROM ms_karyawan WHERE email='".$email."' AND password='".$password."'";
		$res = $this->apps_model->manualQuery($qry);
		$dtk = $res->result();
		if(count($dtk) > 0)
		{
			$j = $this->apps_model->manualQuery("SELECT * FROM ms_jabatan WHERE kode_jabatan='".$dtk[0]->jabatan."'");
			$dtj = $j->result();
			$sess_data['logged_in'] = 'loginaskaryawan';
			if($dtj[0]->prioritas_jabatan==1)
			{
				$sess_data['logged_in'] = 'loginasadmin';
			}

			$getboss = $this->apps_model->manualQuery("SELECT * FROM ms_posisi_karyawan WHERE atasan_1='".$dtk[0]->jabatan."'");
			$dtBoss = $getboss->result();

			$sess_data['nama'] = $dtk[0]->nm_lengkap;
			$sess_data['email'] = $dtk[0]->email;
			$sess_data['nik'] = $dtk[0]->nik;
			$sess_data['prioritas'] = $dtj[0]->prioritas_jabatan;
			$sess_data['divisi'] = $dtk[0]->departemen;
			$sess_data['isTheBoss'] = count($dtBoss);
			$sess_data['login_time'] = $this->qm->Hari_Bulan_Indo().", ".$this->qm->tgl_now_indo()." ".$this->qm->Jam_Now();
			$this->session->set_userdata($sess_data);
		}
		redirect("/");
	}
}