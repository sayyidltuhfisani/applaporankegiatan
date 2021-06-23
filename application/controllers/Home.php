<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->view('home/home');
		$this->load->view('template/footer');
	}

	
	
}
