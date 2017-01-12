 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti extends CI_Controller {

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
			if($this->session->userdata('logged_in') == "loginasadmin" && $this->session->userdata('divisi')=='D.01.16.11.002')
			{
				$data['list'] = $this->Cuti_model->getAll();
			}else{
				$data['list'] = $this->Cuti_model->getByNIK($this->session->userdata('nik'));
				if($this->session->userdata('isTheBoss') > 0) {
					$data['list'] = $this->Cuti_model->getByDivisi($this->session->userdata('divisi'));
				}
			}
			$data['content'] = $this->load->view('cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function add()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
			$data['title'] = 'Input Cuti';

			if(!empty($this->session->userdata('nik')))
			{
	            $id = $this->session->userdata('nik');
	            $dt = $this->Karyawan_model->getByCode($id);
	            $dpt = $this->Departemen_model->getByCode($dt[0]->departemen);
	            $jbt = $this->Jabatan_model->getByCode($dt[0]->jabatan);
	            $data['jabatan'] = $this->Jabatan_model->getAll();
	            $data['departemen'] = $this->Departemen_model->getAll();
	            $data['jenis_cuti'] = $this->Jeniscuti_model->getAll();
	            $data['nik'] = $dt[0]->nik;
	            $data['nm_lengkap'] = $dt[0]->nm_lengkap;
	            $data['dptm'] = $dt[0]->departemen;
	            $data['nm_dptm'] = $dpt[0]->nm_dptm;
	            $data['jbtn'] = $dt[0]->jabatan;
	            $data['nm_jbtn'] = $jbt[0]->nama_jabatan;
			}

			$data['content'] = $this->load->view('add_cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function edit_data()
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
			$data['title'] = 'Edit Data Cuti';
			$data['content'] = $this->load->view('edit_cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function create()
	{
		$post = $this->input->post();

		$tgl_pengajuan = date("Y-m-d",strtotime($post['tgl_pengajuan']));
		$tgl_awal = date("Y-m-d",strtotime($post['tgl_awal']));
		$tgl_akhir = date("Y-m-d",strtotime($post['tgl_akhir']));
		$no_pengajuan = $this->Cuti_model->getCode();

		$data['no_pengajuan'] = $no_pengajuan;
	    $data['nik'] = $post['nik'];
	    $data['tgl_pengajuan'] = $tgl_pengajuan;
	    $data['cuti'] = $post['cuti'];
	    $data['tgl_awal'] = $tgl_awal;
	    $data['tgl_akhir'] = $tgl_akhir;
	    $data['jumlah'] = $post['jumlah'];
	    $data['keterangan'] = $post['keterangan'];

        $proceed = $this->Cuti_model->save($data);

        if($proceed){
            $message = " New Data Cuti Has Been Added. ";
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('cuti');
	}

	public function edit()
	{
		$post = $this->input->post();

		$tgl_pengajuan = date("Y-m-d",strtotime($post['tgl_pengajuan']));
		$tgl_awal = date("Y-m-d",strtotime($post['tgl_awal']));
		$tgl_akhir = date("Y-m-d",strtotime($post['tgl_akhir']));

		$id = $post['no_pengajuan'];
		$data['no_pengajuan'] = $post['no_pengajuan'];
	    $data['nik'] = $post['nik'];
	    $data['tgl_pengajuan'] = $tgl_pengajuan;
	    $data['cuti'] = $post['cuti'];
	    $data['tgl_awal'] = $tgl_awal;
	    $data['tgl_akhir'] = $tgl_akhir;
	    $data['jumlah'] = $post['jumlah'];
	    $data['keterangan'] = $post['keterangan'];

        $proceed = $this->Cuti_model->update($data,$id);

        if($proceed){
            $message = " New Data Cuti Has Been Updated. ";
            if($proceed <> 1)
            {
                $message = $proceed;
            }
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('cuti');
	}

	public function delete()
	{
		$id = $this->input->get('id');

        $proceed = $this->Cuti_model->delete($id);

        if($proceed){
            $message = " Data Cuti Has Been Deleted. ";
            $this->session->set_flashdata('errors', $message);
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        }
        redirect('cuti');
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
				switch ($dt[0]->approval) {
					case 1: $approval = "<span class='label label-success'>Approved</span>"; break;
					case 2: $approval = "<span class='label label-danger'>Rejected</span>"; break;
					
					default: $approval = "<span class='label label-default'>Pending</span>"; break;
				} 
			}
			$data['title'] = 'Data Cuti ['.$approval.']';
			$data['content'] = $this->load->view('view_cuti', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function print_out()
	{
		$no = $this->input->get('no');

		define('FPDF_FONTPATH',$this->config->item('fonts_path')); 

		if(isset($_GET['no']) && $_GET['no'] <> '')
		{
            $dt = $this->Cuti_model->getByCode($no);
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
            $data['max_cuti'] = $jnc[0]->jumlah_max;
            $data['tgl_awal'] = date('d M Y',strtotime($dt[0]->tgl_awal));
            $data['tgl_akhir'] = date('d M Y',strtotime($dt[0]->tgl_akhir));
            $data['tgl_pengajuan'] = $this->apps_model->tgl_indo($dt[0]->tgl_pengajuan);
            $data['jumlah'] = $dt[0]->jumlah;
            $data['keterangan'] = $dt[0]->keterangan;
            $data['tgl_cuti'] = $data['tgl_awal']." - ".$data['tgl_akhir'];
			switch ($dt[0]->approval) {
				case 1: $approval = "Approved"; break;
				case 2: $approval = "Rejected"; break;
				
				default: $approval = "Pending"; break;
			} 
			$data['approval'] = $approval;
		}
		$data['title'] = 'Form Cuti';
		$this->load->view('print_cuti', $data); 
	}
}
