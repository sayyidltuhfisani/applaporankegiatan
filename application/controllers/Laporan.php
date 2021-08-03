<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $isijudul=judul();
		session_not_ready();

		// $data['isi'] = judul();
		$data['level']=$this->session->userdata('level');
		$data['nama']=$this->session->userdata('nama_lengkap');
		
		

		$this->load->view('template/header',$data);
	}

	public function index()
	{
		$data['menu']=$this->Proses_model->getdata();

		$this->load->view('laporan/main',$data);
		$this->load->view('template/footer');
	}
	public function cetak()
	{
		$this->load->view('laporan/cetak');
		$this->load->view('template/footer');
	}
	public function kelender()
	{
		$this->load->view('laporan/kelender');
		$this->load->view('template/footer');
	}
	
}
 ?>