<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tp001 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		$idformini = "tp001";
		$this->load->model('Mtp001');
		$this->load->model('Mjj789');
		$this->load->model('Mrt001');
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
		$data["fill"] = "tp001v";
		$data["dtrange"] = $this->Mrt001->data();
		$data["dtjenjang"] = $this->Mjj789->data();
		
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtp001->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$jen = $k->jenjang;
			$nama = $k->nama;
			$kete = $k->keterangan;
			$pangkat = $k->pangkat;
			$kel = $k->kelompok;
			$kuant = $k->kuantitas;
			$ak = $k->ak;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $jen . '","' . $nama . '","' . $kete . '","' . $pangkat . '","' . $kel . '","' . $kuant . '","' . $ak . '"],';
		}
		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtp001->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$jenjang = $k->id_jenjang;
					$nama = $k->nama;
					$kete = $k->keterangan;
					$pangkt = $k->id_range;
					$kel = $k->kelompok;
					$kuant = $k->kuantitas;
					$ak = $k->ak;
					
				}
				echo base64_encode("1|" . $id . "|" . $jenjang . "|" . $nama . "|" . $kete . "|" . $pangkt . "|" . $kel . "|" . $kuant . "|" . $ak);
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
			$jenjang = trim(str_replace("'", "''", $this->input->post("jenjang")));
			$nama = trim(str_replace("'", "''", $this->input->post("nama")));
			$kete = trim(str_replace("'", "''", $this->input->post("kete")));
			$pangkat = trim(str_replace("'", "''", $this->input->post("pangkat")));
			$kel = trim(str_replace("'", "''", $this->input->post("kel")));
			$kuant = trim(str_replace("'", "''", $this->input->post("kuant")));
			$ak = trim(str_replace("'", "''", $this->input->post("ak")));
			$operasi = $this->Mtp001->tambah($jenjang, $nama, $kete, $pangkat, $kel, $kuant, $ak);
			if ($operasi == "1") {
				$ket = "Id Jenjang: $jenjang,\nNama Tupoksi: $nama,\nKeterangan: $kete,\nId Range Pangkat: $pangkat,\nKelompok: $kel,\nKuantitas: $kuant,\nAk: $ak";
				$this->Mlog->log_history("Tupoksi Golongan", "Tambah", $ket);
			}
			echo base64_encode($operasi);
		} else {
			echo base64_encode("99");
		}
	}

	public function update(){
		if ($this->aksesc[1] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$jenjang = trim(str_replace("'", "''", $this->input->post("jenjang")));
			$nama = trim(str_replace("'", "''", $this->input->post("nama")));
			$kete = trim(str_replace("'", "''", $this->input->post("kete")));
			$pangkat = trim(str_replace("'", "''", $this->input->post("pangkat")));
			$kel = trim(str_replace("'", "''", $this->input->post("kel")));
			$kuant = trim(str_replace("'", "''", $this->input->post("kuant")));
			$ak = trim(str_replace("'", "''", $this->input->post("ak")));
			$operasi = $this->Mtp001->update($id, $jenjang, $nama, $kete, $pangkat, $kel, $kuant, $ak);
			if ($operasi == "1") {
				$ket = "Id Tupoksi: $id,\nId Jenjang: $jenjang,\nNama Tupoksi: $nama,\nKeterangan: $kete,\nId Range Pangkat: $pangkat,\nKelompok: $kel,\nKuantitas: $kuant,\nAk: $ak";
				$this->Mlog->log_history("Tupoksi Golongan", "Update", $ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus()
	{
		if ($this->aksesc[2] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$td = $this->Mtp001->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtp001->filter($id);
					$operasi = $this->Mtp001->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$jenjang = $k->id_jenjang;
							$nama = $k->nama;
							$kete = $k->keterangan;
							$pangkt = $k->id_range;
							$kel = $k->kelompok;
							$kuant = $k->kuantitas;
							$ak = $k->ak;
						}
						$ket = "Id Tupoksi: $id,\nId Jenjang: $jenjang,\nNama Tupoksi: $nama,\nKeterangan: $kete,\nId Range Pangkat: $pangkat,\nKelompok: $kel,\nKuantitas: $kuant,\nAk: $ak";
						$this->Mlog->log_history("Tupoksi Golongan", "Delete", $ket);
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
