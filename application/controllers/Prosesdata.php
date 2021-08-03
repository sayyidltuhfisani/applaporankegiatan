<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prosesdata extends CI_Controller {

	public function hapusdata()
	{
		$ket=$this->input->post('ket');
		$id=$this->input->post('id');

		$data=$this->Proses_model->hapusdata($ket,$id);

		// $data['status']='gagal';
		// $data['keterangan']='Tanggal Ini Sudah Bikin Laporan';

		echo json_encode($data);
	}

	public function tambahgambar()
	{
		$ket=$this->input->post('ket');
		$id=$this->input->post('id');

		$menu['id']=$id;
		$menu['ket']=$ket;
		$this->load->view('laporan/tambahgambar',$menu);
		
	}

	public function listgambar()
	{
		$id=$this->input->post('id');
		$data['menu']=$this->Proses_model->listgambar($id);
		$data['idlaporan']=$id;
		$data['idlogin']=$this->session->userdata('id_login');
		$this->load->view('laporan/listgambar',$data);
	}


	public function tambahdanedit()
	{
		$ket=$this->input->post('ket');
		$id=$this->input->post('id');
		$tgl=$this->input->post('tgl');
		if ($ket == 'edit') {
			
		}
		$menu['tgl']=$tgl;
		$menu['id']=$id;
		$menu['ket']=$ket;
		$this->load->view('laporan/tambahdanedit',$menu);
		
	}
	public function formproses()
	{
		$ket=$this->input->post('ket');
		$id=$this->input->post('id');
		$tgl=$this->input->post('tgl');
		$isi=$this->input->post('isi');
		$upload=$this->input->post('files');

		if ($ket == 'gambar') {
			$nameimage=array();

			$idlogin=$this->session->userdata('id_login');

			$dir='./berkaspendukung/'.$idlogin.'/';

			$count = count($_FILES['files']['name']);


			if(!is_dir($dir)){
				mkdir($dir, 0766);
			}

			$config['upload_path']          = $dir;
			$config['allowed_types']        = 'jpg|jpeg|png|gif';
			$config['max_size']             = 5120;
			$config['encrypt_name'] 		= true;

			$this->load->library('upload',$config);



			for($i=0;$i<$count;$i++){

				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];



				if($this->upload->do_upload('file')){

					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$nameimage[$i] = $filename;

				}
			}

			$data=$this->Proses_model->simpandatagambar($id,$nameimage);
		}
		elseif ($ket == 'edit') {
			$data=$this->Proses_model->editdata($id,$isi);
		}
		else{

			$cek=$this->Proses_model->cektgl($tgl);
			if ($cek == 'udah') {
				$data['status']='gagal';
				$data['keterangan']='Tanggal Ini Sudah Bikin Laporan';
			}
			else{



				$nameimage=array();

				$idlogin=$this->session->userdata('id_login');

				$dir='./berkaspendukung/'.$idlogin.'/';

				$count = count($_FILES['files']['name']);


				if(!is_dir($dir)){
					mkdir($dir, 0766);
				}

				$config['upload_path']          = $dir;
				$config['allowed_types']        = 'jpg|jpeg|png|gif';
				$config['max_size']             = 5120;
				$config['encrypt_name'] 		= true;

				$this->load->library('upload',$config);



				for($i=0;$i<$count;$i++){

					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];



					if($this->upload->do_upload('file')){

						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$nameimage[$i] = $filename;

					}
				}



				$data=$this->Proses_model->simpandata($tgl,$isi,$nameimage);
			}


		}

		// $data['status']='berhasil';
		// $data['keterangan']=$nameimage[0];

		echo json_encode($data);
	}
}
?>