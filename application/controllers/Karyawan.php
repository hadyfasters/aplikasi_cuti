 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

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
			$data['title'] = 'Data Karyawan';
			$data['list'] = $this->Karyawan_model->getAll();
			$data['content'] = $this->load->view('karyawan', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function add()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');
			$data['title'] = 'Tambah Data Karyawan';
            $data['jabatan'] = $this->Jabatan_model->getAll();
            $data['departemen'] = $this->Departemen_model->getAll();
			$data['content'] = $this->load->view('add_karyawan', $data, true);
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
				$dt = $this->Karyawan_model->getByCode($_GET['id']);
				$data['edit'] = 1;
				$data['nik'] = $dt[0]->nik;
				$data['nm_lengkap'] = $dt[0]->nm_lengkap;
				$data['tgl_lahir'] = date("m/d/Y",strtotime($dt[0]->tgl_lahir));
				$data['tmpt_lahir'] = $dt[0]->tmpt_lahir;
				$data['jenis_kelamin'] = $dt[0]->jenis_kelamin;
				$data['alamat'] = $dt[0]->alamat;
				$data['agama'] = $dt[0]->agama;
				$data['status_nikah'] = $dt[0]->status_nikah;
				$data['no_telp'] = $dt[0]->no_telp;
				$data['email'] = $dt[0]->email;
				$data['foto'] = $dt[0]->foto;
				$data['ttd'] = $dt[0]->ttd;
				$data['dptm'] = $dt[0]->departemen;
				$data['jbtn'] = $dt[0]->jabatan;
				$data['tgl_masuk'] = date("m/d/Y",strtotime($dt[0]->tgl_masuk));
				$data['status_karyawan'] = $dt[0]->status_karyawan;
	            $data['jabatan'] = $this->Jabatan_model->getAll();
	            $data['departemen'] = $this->Departemen_model->getAll();
			}
			$data['title'] = 'Edit Data Karyawan';
			$data['content'] = $this->load->view('edit_karyawan', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}

	public function create()
	{
		$post = $this->input->post();

		$file = $_FILES;

		$tgl_masuk = date("Y-m-d",strtotime($post['tgl_masuk']));
		$tgl_lahir = date("Y-m-d",strtotime($post['tgl_lahir']));
        $nik = $this->Karyawan_model->getCode($tgl_masuk,$tgl_lahir);

        $data['nik'] = $nik;
		$data['nm_lengkap'] = $post['nm_lengkap'];
		$data['tgl_lahir'] = $tgl_lahir;
		$data['tmpt_lahir'] = $post['tmpt_lahir'];
		$data['jenis_kelamin'] = $post['jenis_kelamin'];
		$data['alamat'] = $post['alamat'];
		$data['agama'] = $post['agama'];
		$data['status_nikah'] = $post['status_nikah'];
		$data['no_telp'] = $post['no_telp'];
		$data['departemen'] = $post['departemen'];
		$data['jabatan'] = $post['jabatan'];
		$data['email'] = $post['email'];
		if($post['password'] === $post['password2'])
		{
			$data['password'] = MD5($post['password']);
		}else{
            $message = " Password not match. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('karyawan/add');
		}

		// FOTO UPLOADER
		if ($file['foto']['error'] === 0){   

			$filename = str_replace(".","",$nik)."_FOTO";
			$dk = $this->Karyawan_model->getByCode($id);

			$config['upload_path'] = './assets/files/';
			$config['allowed_types'] = 'jpg|jpeg|png|jp2';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $filename;
			$this->upload->initialize($config);
			if($this->upload->do_upload('foto')){
				$upl_foto = $this->upload->data();
				$data['foto'] = $upl_foto['file_name'];
				
				$status = "success";
				$msg = "Foto Berhasil diupload";
				@unlink($_FILES['foto']);
			}else{
				$message = $this->upload->display_errors('', '');
	            $this->session->set_flashdata('errors', $message);
	        	redirect('karyawan/edit_data?id='.$id);
			}

		}

		// TTD UPLOADER
		if ($file['ttd']['error'] === 0){   

			$filename = str_replace(".","",$nik)."_TTD";
			$dk = $this->Karyawan_model->getByCode($id);

			$config['upload_path'] = './assets/files/';
			$config['allowed_types'] = 'jpg|jpeg|png|jp2';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $filename;
			$this->upload->initialize($config);
			if($this->upload->do_upload('ttd')){
				$upl_foto = $this->upload->data();
				$data['ttd'] = $upl_foto['file_name'];
				
				$status = "success";
				$msg = "TTD Berhasil diupload";
				@unlink($_FILES['ttd']);
			}else{
				$message = $this->upload->display_errors('', '');
	            $this->session->set_flashdata('errors', $message);
	        	redirect('karyawan/edit_data?id='.$id);
			}

		}

		$data['tgl_masuk'] = $tgl_masuk;
		$data['status_karyawan'] = 1;

        $proceed = $this->Karyawan_model->save($data);

        if($proceed){
            $message = " New Karyawan Has Been Added. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('Karyawan');
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('Karyawan');
        }
	}

	public function edit()
	{
		$post = $this->input->post();

		$file = $_FILES;

        $id = $post['nik'];
		$tgl_masuk = date("Y-m-d",strtotime($post['tgl_masuk']));
		$tgl_lahir = date("Y-m-d",strtotime($post['tgl_lahir']));

		$data['nm_lengkap'] = $post['nm_lengkap'];
		$data['tgl_lahir'] = $tgl_lahir;
		$data['tmpt_lahir'] = $post['tmpt_lahir'];
		$data['jenis_kelamin'] = $post['jenis_kelamin'];
		$data['alamat'] = $post['alamat'];
		$data['agama'] = $post['agama'];
		$data['status_nikah'] = $post['status_nikah'];
		$data['no_telp'] = $post['no_telp'];
		$data['departemen'] = $post['departemen'];
		$data['jabatan'] = $post['jabatan'];
		$data['email'] = $post['email'];
		if($post['password'] <> '')
		{
			if($post['password'] === $post['password2'])
			{
				$data['password'] = MD5($post['password']);
			}else{
	            $message = " Password not match. ";
	            $this->session->set_flashdata('errors', $message);
	        	redirect('karyawan/edit_data?id='.$id);
			}
		}

		// FOTO UPLOADER
		if ($file['foto']['error'] === 0){   

			$filename = str_replace(".","",$id)."_FOTO";
			$dk = $this->Karyawan_model->getByCode($id);

			$config['upload_path'] = './assets/files/';
			$config['allowed_types'] = 'jpg|jpeg|png|jp2';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $filename;
			$this->upload->initialize($config);
			if($this->upload->do_upload('foto')){
				$upl_foto = $this->upload->data();
				$data['foto'] = $upl_foto['file_name'];
				
				$status = "success";
				$msg = "Foto Berhasil diupload";
				@unlink($_FILES['foto']);
			}else{
				$message = $this->upload->display_errors('', '');
	            $this->session->set_flashdata('errors', $message);
	        	redirect('karyawan/edit_data?id='.$id);
			}

		}

		// TTD UPLOADER
		if ($file['ttd']['error'] === 0){   

			$filename = str_replace(".","",$id)."_TTD";
			$dk = $this->Karyawan_model->getByCode($id);

			$config['upload_path'] = './assets/files/';
			$config['allowed_types'] = 'jpg|jpeg|png|jp2';
			$config['overwrite'] = TRUE;
			$config['file_name'] = $filename;
			$this->upload->initialize($config);
			if($this->upload->do_upload('ttd')){
				$upl_foto = $this->upload->data();
				$data['ttd'] = $upl_foto['file_name'];
				
				$status = "success";
				$msg = "TTD Berhasil diupload";
				@unlink($_FILES['ttd']);
			}else{
				$message = $this->upload->display_errors('', '');
	            $this->session->set_flashdata('errors', $message);
	        	redirect('karyawan/edit_data?id='.$id);
			}

		}

		$data['tgl_masuk'] = $tgl_masuk;
		$data['status_karyawan'] = $post['status_karyawan'];

        $proceed = $this->Karyawan_model->update($data,$id);

        if($proceed){
            $message = " Data Karyawan Has Been Updated. ";
        	if($proceed <> 1)
        	{
        		$message = $proceed;
        	}
            $this->session->set_flashdata('errors', $message);
        	redirect('Karyawan');
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('Karyawan');
        }
	}

	public function delete()
	{
		$id = $this->input->get('id');

        $proceed = $this->Karyawan_model->delete($id);

        if($proceed){
            $message = " Karyawan Has Been Deleted. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('karyawan');
        } else {
            $message = " There is something error. ";
            $this->session->set_flashdata('errors', $message);
        	redirect('karyawan');
        }
	}

	public function view()
	{
		if(!empty($this->session->userdata('logged_in'))) {
			$data['message'] = $this->session->flashdata('errors');

			$id = $this->input->get('id');
			$data['dt'] = $this->Karyawan_model->getByCode($id);
			$data['dpt'] = $this->Departemen_model->getByCode($data['dt'][0]->departemen);
			$data['jbt'] = $this->Jabatan_model->getByCode($data['dt'][0]->jabatan);
			$data['pos'] = $this->Posisi_model->getByNIK($id);

			$data['title'] = 'Biodata Karyawan';
			$data['content'] = $this->load->view('view_karyawan', $data, true);
			$this->load->view('template',$data);
		}else{
			redirect('login/logout');
		}
	}
}
