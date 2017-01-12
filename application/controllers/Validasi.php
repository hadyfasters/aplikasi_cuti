 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

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
			$data['message'] = $this->session->flashdata('errors');
			$data['title'] = 'Data Cuti';
			if($this->session->userdata('logged_in') == "loginasadmin")
			{
				$data['list'] = $this->Cuti_model->getAll();
			}else{
				$data['list'] = $this->Cuti_model->getByNIK($this->session->userdata('nik'));
			}
			$data['content'] = $this->load->view('validasi', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function save()
	{
		$post = $this->input->post();

		$tgl_pengajuan = date("Ymd",strtotime($post['tgl_pengajuan']));

		$id = $post['no_pengajuan'];
		$data['no_pengajuan'] = $post['no_pengajuan'];
	    $data['validasi'] = $post['validasi'];

        $proceed = $this->Cuti_model->update($data,$id);

        if($proceed){
        	switch ($post['validasi']) {
        		case 1: $message = " New Data Cuti Has Been Approved. "; break;
        		case 2: $message = " New Data Cuti Has Been Rejected. "; break;
        		
        		default: $message = ""; break;
        	}
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('validasi');
	}

	public function approve()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
		
			if(isset($_GET['id']) && $_GET['id'] <> '')
			{
	            $dt = $this->Cuti_model->getByCode($_GET['id']);
	            $kry = $this->Karyawan_model->getByCode($dt[0]->nik);
	            $jnc = $this->Jeniscuti_model->getByCode($dt[0]->cuti);
	            $dpt = $this->Departemen_model->getByCode($kry[0]->departemen);
	            $jbt = $this->Jabatan_model->getByCode($kry[0]->jabatan);
	            $data['jabatan'] = $this->Jabatan_model->getAll();
	            $data['departemen'] = $this->Departemen_model->getAll();
	            $data['jenis_cuti'] = $this->Jeniscuti_model->getAll();
	            $data['no_pengajuan'] = $dt[0]->no_pengajuan;
	            $data['nik'] = $dt[0]->nik;
	            $data['nm_lengkap'] = $kry[0]->nm_lengkap;
	            $data['dptm'] = $kry[0]->departemen;
	            $data['nm_dptm'] = $dpt[0]->nm_dptm;
	            $data['jbtn'] = $kry[0]->jabatan;
	            $data['nm_jbtn'] = $jbt[0]->nama_jabatan;
	            $data['cuti'] = $dt[0]->cuti;
	            $data['nm_cuti'] = $jnc[0]->nm_cuti;
	            $data['tgl_awal'] = date('m/d/Y',strtotime($dt[0]->tgl_awal));
	            $data['tgl_akhir'] = date('m/d/Y',strtotime($dt[0]->tgl_akhir));
	            $data['tgl_pengajuan'] = date('m/d/Y',strtotime($dt[0]->tgl_pengajuan));
	            $data['jumlah'] = $dt[0]->jumlah;
	            $data['keterangan'] = $dt[0]->keterangan;
			}
			$data['title'] = "KODE : ".$this->input->get('id');
			$data['content'] = $this->load->view('valid_cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function reject()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
		
			if(isset($_GET['id']) && $_GET['id'] <> '')
			{
	            $dt = $this->Cuti_model->getByCode($_GET['id']);
	            $kry = $this->Karyawan_model->getByCode($dt[0]->nik);
	            $jnc = $this->Jeniscuti_model->getByCode($dt[0]->cuti);
	            $dpt = $this->Departemen_model->getByCode($kry[0]->departemen);
	            $jbt = $this->Jabatan_model->getByCode($kry[0]->jabatan);
	            $data['jabatan'] = $this->Jabatan_model->getAll();
	            $data['departemen'] = $this->Departemen_model->getAll();
	            $data['jenis_cuti'] = $this->Jeniscuti_model->getAll();
	            $data['no_pengajuan'] = $dt[0]->no_pengajuan;
	            $data['nik'] = $dt[0]->nik;
	            $data['nm_lengkap'] = $kry[0]->nm_lengkap;
	            $data['dptm'] = $kry[0]->departemen;
	            $data['nm_dptm'] = $dpt[0]->nm_dptm;
	            $data['jbtn'] = $kry[0]->jabatan;
	            $data['nm_jbtn'] = $jbt[0]->nama_jabatan;
	            $data['cuti'] = $dt[0]->cuti;
	            $data['nm_cuti'] = $jnc[0]->nm_cuti;
	            $data['tgl_awal'] = date('m/d/Y',strtotime($dt[0]->tgl_awal));
	            $data['tgl_akhir'] = date('m/d/Y',strtotime($dt[0]->tgl_akhir));
	            $data['tgl_pengajuan'] = date('m/d/Y',strtotime($dt[0]->tgl_pengajuan));
	            $data['jumlah'] = $dt[0]->jumlah;
	            $data['keterangan'] = $dt[0]->keterangan;
			}
			$data['title'] = "KODE : ".$this->input->get('id');
			$data['content'] = $this->load->view('invalid_cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function view()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
		
			if(isset($_GET['id']) && $_GET['id'] <> '')
			{
	            $dt = $this->Cuti_model->getByCode($_GET['id']);
	            $kry = $this->Karyawan_model->getByCode($dt[0]->nik);
	            $jnc = $this->Jeniscuti_model->getByCode($dt[0]->cuti);
	            $dpt = $this->Departemen_model->getByCode($kry[0]->departemen);
	            $jbt = $this->Jabatan_model->getByCode($kry[0]->jabatan);
	            $data['jabatan'] = $this->Jabatan_model->getAll();
	            $data['departemen'] = $this->Departemen_model->getAll();
	            $data['jenis_cuti'] = $this->Jeniscuti_model->getAll();
	            $data['no_pengajuan'] = $dt[0]->no_pengajuan;
	            $data['nik'] = $dt[0]->nik;
	            $data['nm_lengkap'] = $kry[0]->nm_lengkap;
	            $data['dptm'] = $kry[0]->departemen;
	            $data['nm_dptm'] = $dpt[0]->nm_dptm;
	            $data['jbtn'] = $kry[0]->jabatan;
	            $data['nm_jbtn'] = $jbt[0]->nama_jabatan;
	            $data['cuti'] = $dt[0]->cuti;
	            $data['nm_cuti'] = $jnc[0]->nm_cuti;
	            $data['tgl_awal'] = date('m/d/Y',strtotime($dt[0]->tgl_awal));
	            $data['tgl_akhir'] = date('m/d/Y',strtotime($dt[0]->tgl_akhir));
	            $data['tgl_pengajuan'] = date('m/d/Y',strtotime($dt[0]->tgl_pengajuan));
	            $data['jumlah'] = $dt[0]->jumlah;
	            $data['keterangan'] = $dt[0]->keterangan;
			}
			$data['title'] = "KODE : ".$this->input->get('id');
			$data['content'] = $this->load->view('approval_cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}
}
