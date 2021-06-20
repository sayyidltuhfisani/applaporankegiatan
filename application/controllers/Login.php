<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	
	public function index()
	{
		$this->load->view('login');
	}

	public function kodecaptha()
	{
		$captcha_font = imageloadfont(FCPATH.'libereri/kodecaptha/segoe.gdf');
		// print_r($captcha_font);
		// exit();
		 // untuk mengacak captcha
		$code = $this->acakCaptcha();
		// $_SESSION["code"] = $code;

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
		$pass = array(); 

   		//masukkan -2 dalam string length
		$panjangAlpha = strlen($alphabet) - 1; 
		for ($i = 0; $i < 6; $i++) {
			$n = rand(0, $panjangAlpha);
			$pass[] = $alphabet[$n];
		}

   		//ubah array menjadi string
		return implode($pass); 
	}
	

	public function proseslogin()
	{

		if ($this->input->is_ajax_request()) {
			$data=array();
			$data["status"] = 'berhasil';
			$data["keterangan"] = 'Anda berhasil Login';
			echo json_encode($data);
		}
		else{
			redirect('404_override');
		}
	}
}
