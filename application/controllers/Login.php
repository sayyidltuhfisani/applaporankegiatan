<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	
	public function index()
	{
		session_ready();
		$this->load->view('login');
	}

	public function kodecaptha()
	{
		$captcha_font = imageloadfont(FCPATH.'libereri/kodecaptha/segoe.gdf');
		// print_r($captcha_font);
		// exit();
		 // untuk mengacak captcha
		$code = $this->acakCaptcha();
		

		//lebar dan tinggi captcha
		$wh = imagecreatetruecolor(163, 49);

		//background color biru
		$bgc = imagecolorallocate($wh, 255,205 ,255 );

		//text color abu-abu
		$fc = imagecolorallocate($wh, 200, 100, 90);
		imagefill($wh, 0, 0, $bgc);
		// imagefill($wh, 0, 0, 0);

		//( $image , $fontsize , $string , $fontcolor )
		imagestring($wh, $captcha_font, 25, 1,  $code, $fc);

		//buat gambar
		header('content-type: image/png');
		imagepng($wh);
		imagedestroy($wh);

	} 

	public function acakCaptcha() {
		$alphabet = "0123456789";

		//untuk menyatakan $pass sebagai array
		// $pass = array(); 
		$digit='';

   		//masukkan -2 dalam string length
		$panjangAlpha = strlen($alphabet) - 1; 
		for ($i = 0; $i < 6; $i++) {
			$digit .= rand(0, $panjangAlpha);
			// $pass[] = $alphabet[$n];
		}
		$this->session->set_userdata('kode_captcha', $digit);
   		//ubah array menjadi string
		// return implode($pass); 
		return $digit;
	}
	

	public function proseslogin()
	{

		if ($this->input->is_ajax_request()) {
			$data=array();

			$nilaicap = htmlspecialchars($this->input->post('captcha'));
			$username =htmlspecialchars($this->input->post('username'));
			$pass= htmlspecialchars($this->input->post('pass'));
			$cap = $this->session->userdata('kode_captcha');

			if ($nilaicap != $cap) {
				$data["status"] = 'gagal';
				$data["keterangan"] = 'captcha tidak sesusai';
			}
			else{

				$proses=$this->Login_model->login($pass,$username);

				// $data["status"] = 'berhasil';
				// $data["keterangan"] = $proses;
				if ($proses['hasil'] == 'ada') {
					$data["status"] = 'berhasil';
					$data["keterangan"] = 'Anda berhasil Login';
				}else{
					$data["status"] = 'gagal';
					$data["keterangan"] = 'Password dan Username Salah';
				}

				
			}
			echo json_encode($data);
		}
		else{
			redirect('404_override');
		}
	}

	public function keluar()
	{
		$items = array('nama','level','nama_lengkap');

		$this->session->unset_userdata($items);

		redirect('login');	}
}
