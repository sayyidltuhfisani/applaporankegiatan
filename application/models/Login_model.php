<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function login($pass,$username)
	{
		$items=array();
		$pass=$this->prosesenkripsi($pass);
		
		$this->db->select('id_login, username, level, nama_lengkap');
		$this->db->from('login');		
		$this->db->where('password', $pass);
		$this->db->where('username', $username);
		$this->db->where('aktive', 'Y');
	

		$query= $this->db->get();

		if ($query->num_rows() > 0 ) {
			$row=$query->row();
			$items['hasil']='ada';
			$addsession=array(
				"nama" =>$row->username,
				"level"=>$row->level,
				"nama_lengkap" =>$row->nama_lengkap
			);

			$this->session->set_userdata($addsession);

		}else{
			$items['hasil']='tidak';
			
		}
		return $items;
	}
	function prosesenkripsi($pass){
		$len = strlen($pass);
		$pass1 = substr($pass, 0, round($len/2));
		$pass2 = substr($pass, round($len/2));

	
		$pass = md5('S3reF1n4'.$pass1.'78sP12XZr'.$pass2.'Med4N');

		return $pass;

	}


	function ubah($id, $pass){
		$this->db->select('pass');
		$this->db->from('tbl_login');		
		$this->db->where('id', $id);
		
		$query= $this->db->get();

		if ($query->num_rows() > 0) {
			$row = $query->row();

			$prosespass=$this->prosesenkripsi($pass);

			if ($prosespass == $row->pass) {

				return true;
				
			}
			else{
				return false;
			}


		}
		
	}

	function simpanygubah($id,$passbaru){

		$prosespass=$this->prosesenkripsi($passbaru);


		$this->db->set('pass', $prosespass);
		$this->db->where('id',$id);
		$query=$this->db->update('tbl_login');	

		if ($query) {
			return true;
		}
		else{
			return false;
		}


	}

}

?>