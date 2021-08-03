<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_model extends CI_Model {

	public function editdata($id,$isi)
	{
		# code...
	}
	public function hapusdata($ket,$id)
	{
		if ($ket =='hapus') {
			
		}
		else{

		}
	}
	public function simpandatagambar($id,$nameimage)
	{
		$count=count($nameimage);

		for($i=0;$i<$count; $i++) {

			$t=array(
				"id_laporan"			=>$id,
				"nama_file"				=>$nameimage[$i]
			);

			$t1=$this->db->insert("tbl_file_laporan",$t);
		}

		if ($count == $i) {
			$data['status']='berhasil';
			$data['keterangan']='data berhasil disimpan';
		}
		else{
			$data['status']='gagal';
			$data['keterangan']='data gagal disimpan';
		}
		return $data;
		
	}
	public function listgambar($id)
	{
		return  $this->db->query("select * from tbl_file_laporan where id_laporan='$id'")->result_array();
	}
	public function getdata()
	{
		$id_login=$this->session->userdata('id_login');
		return  $this->db->query("select * from tbl_laporan where id_login='$id_login'")->result_array();
	}

	public function cektgl($tgl)
	{
		$id_login=$this->session->userdata('id_login');

		$d="select id_laporan from tbl_laporan where tgl='$tgl' and id_login='$id_login'";

		if ($this->db->query($d)->num_rows() > 0) {
			$data='udah';
		}
		else{
			$data='tidak';
		}

		return $data;

	}

	public function simpandata($tgl,$isi,$image)
	{
		$id_login=$this->session->userdata('id_login');
		$t=array(
			"id_login"			=>$id_login,
			"tgl"				=>$tgl,
			"isilaporan"		=>$isi
			
		);

		$t1=$this->db->insert("tbl_laporan",$t);

		if ($t1) {
			$d="select id_laporan from tbl_laporan where tgl='$tgl' and id_login='$id_login'";

			$d1=$this->db->query($d)->row();

			$id_laporan=$d1->id_laporan;

			$count=count($image);

			for($i=0;$i<$count; $i++) {

				$t=array(
					"id_laporan"			=>$id_laporan,
					"nama_file"				=>$image[$i]
				);

				$t1=$this->db->insert("tbl_file_laporan",$t);
			}

			if ($count == $i) {
				$data['status']='berhasil';
				$data['keterangan']='data berhasil disimpan';
			}
			else{
				$data['status']='gagal';
				$data['keterangan']='data gagal disimpan';
			}
		}
		else{
			$data['status']='gagal';
			$data['keterangan']='data gagal disimpan';
		}
		

		return $data;
		


	}

}
?>