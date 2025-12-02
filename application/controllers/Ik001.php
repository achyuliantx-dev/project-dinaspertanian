<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ik001 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		$idformini = "ik001";
		$this->load->model('Mik001');
		$this->load->model('Mkc001');
		$data["datalogin"] = $this->Mlogin->cek_login();
		$dataform = $this->Mlogin->cek_sistem($idformini);
        if(is_array($data["datalogin"])){
			foreach($dataform as $cx){
				$idsistem_sistem = $cx->id_sistem;
			}
			$idsistem_user = array();
         	foreach ($data["datalogin"] as $dl){
				$idlevel = $dl->id_level;
				array_push($idsistem_user, $dl->id_sistem);
			}
			if(array_search($idsistem_sistem, $idsistem_user) !== false){}else{redirect(base_url());}
			$data["datamenu"] = $this->Mlogin->cek_menu($idsistem_sistem, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($idsistem_sistem, $idlevel);
			$data["ids"] = $idsistem_sistem;
			$data["idf"] = $idformini;
			$this->idsc = $idsistem_sistem;
			$idform = array(); $akses = array();
			foreach ($data["dataform"] as $dx){
				array_push($idform, $dx->id_form);
				if($dx->id_form == $idformini){array_push($akses, $dx->akses_tambah, $dx->akses_update, $dx->akses_hapus, $dx->akses_cetak);}
			}
			if(array_search($idformini, $idform) !== false){
				$data["akses"] = $akses;
				$this->aksesc = $akses; 
			}else{redirect(base_url());}
        	$this->load->view($idsistem_sistem.'/basis', $data, true);
        }else{redirect(base_url());}
    }


	public function index()
	{
		$data["fill"] = "ik001v";
		$data["dtkec"] = $this->Mkc001->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mik001->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$nama = $k->nama;
			$kec = $k->kecamatan;
			$buk = $k->batas_utara_kec;
			$btk = $k->batas_timur_kec;
			$bsk = $k->batas_selatan_kec;
			$bbk = $k->batas_barat_kec;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $nama . '","' . $kec . '","' . $buk . '","' . $btk . '","' . $bsk . '","' . $bbk . '"],';
		}
		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mik001->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$nama = $k->nama;
					$buk = $k->batas_utara_kec;
					$btk = $k->batas_timur_kec;
					$bsk = $k->batas_selatan_kec;
					$bbk = $k->batas_barat_kec;
					$cam = $k->id_kecamatan;
				}
				echo base64_encode("1|" . $id . "|" . $nama. "|" . $cam . "|" . $buk . "|" . $btk . "|" . $bsk . "|" . $bbk);
			} else {
				echo base64_encode("0|");
			}
		} else {
			echo base64_encode("0|");
		}
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$nama = trim(str_replace("'", "''", $this->input->post("nama")));
			$kec = trim(str_replace("'", "''", $this->input->post("kec")));
			$buk = trim(str_replace("'", "''", $this->input->post("buk")));
			$btk = trim(str_replace("'", "''", $this->input->post("btk")));
			$bsk = trim(str_replace("'", "''", $this->input->post("bsk")));
			$bbk = trim(str_replace("'", "''", $this->input->post("bbk")));
			$operasi = $this->Mik001->tambah($nama, $kec, $buk, $btk, $bsk, $bbk);
			if ($operasi == "1") {
				$ket = "Nama IPW Kecamatan: $nama,\nId Kecamatan: $kec,\nBatas Utara Kecamatan: $buk,\nBatas Timur Kecamatan: $btk,\nBatas Selatan Kecamatan: $bsk,\nBatas Barat Kecamatan: $bbk";
				$this->Mlog->log_history("IPW Kecamatan", "Tambah", $ket);
			}
			echo base64_encode($operasi);
		} else {
			echo base64_encode("99");
		}
	}

	public function update(){
		if ($this->aksesc[1] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$nama = trim(str_replace("'", "''", $this->input->post("nama")));
			$kec = trim(str_replace("'", "''", $this->input->post("kec")));
			$buk = trim(str_replace("'", "''", $this->input->post("buk")));
			$btk = trim(str_replace("'", "''", $this->input->post("btk")));
			$bsk = trim(str_replace("'", "''", $this->input->post("bsk")));
			$bbk = trim(str_replace("'", "''", $this->input->post("bbk")));
			$operasi = $this->Mik001->update($id, $nama, $kec, $buk, $btk, $bsk, $bbk);
			if ($operasi == "1") {
				$ket = "Id Kecamatan: $kec,\nNama IPW Kecamatan: $nama,\nBatas Utara Kecamatan: $buk,\nBatas Timur Kecamatan: $btk,\nBatas Selatan Kecamatan: $bsk,\nBatas Barat Kecamatan: $bbk";
				$this->Mlog->log_history("IPW Kecamatan", "update", $ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus()
	{
		if ($this->aksesc[2] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$td = $this->Mik001->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mik001->filter($id);
					$operasi = $this->Mik001->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$nama = $k->nama;
							$kec = $k->id_kecamatan;
							$buk = $k->batas_utara_kec;
							$btk = $k->batas_timur_kec;
							$bsk = $k->batas_selatan_kec;
							$bbk = $k->batas_barat_kec;
						}
						$ket = "Id Kecamatan: $kec,\nNama IPW Kecamatan: $nama,\nBatas Utara Kecamatan: $buk,\nBatas Timur Kecamatan: $btk,\nBatas Selatan Kecamatan: $bsk,\nBatas Barat Kecamatan: $bbk";
						$this->Mlog->log_history("IPW Kecamatan", "Hapus", $ket);
					}
					echo base64_encode($operasi);
				}
			} else {
				echo base64_encode("80");
			}
		} else {
			echo base64_encode("99");
		}
	}
}
