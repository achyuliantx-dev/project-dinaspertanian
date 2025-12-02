<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gt001 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		$idformini = "gt001";
		$this->load->model('Mgt001');
		$this->load->model('Mik001');
		$this->load->model('Mkc001');
		$this->load->model('Mtn123');
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
		$data["fill"] = "gt001v";
		$data["dtkec"] = $this->Mkc001->data();
		$data["dtipw"] = $this->Mik001->data();
		$data["dtta"] = $this->Mtn123->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mgt001->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$ur = $k->uraian;
			$jml = $k->jumlah;
			$kec = $k->kecamatan;
			$ipw = $k->ipw;
			$thn = $k->tahun;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $ur . '","' . $jml . '","' . $kec . '","' . $ipw . '","' . $thn . '"],';
		}
		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mgt001->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$ur = $k->uraian;
					$jml = $k->jumlah;
					$cam = $k->id_kecamatan;
					$ipwk = $k->id_ipwkecamatan;
					$thna = $k->id_tahun;
					
				}
				echo base64_encode("1|" . $id . "|" . $ur . "|" . $jml . "|" . $cam . "|" . $ipwk . "|" . $thna);
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
			$ur = trim(str_replace("'", "''", $this->input->post("ur")));
			$jml = trim(str_replace("'", "''", $this->input->post("jml")));
			$cam = trim(str_replace("'", "''", $this->input->post("cam")));
			$ipw = trim(str_replace("'", "''", $this->input->post("ipw")));
			$thn = trim(str_replace("'", "''", $this->input->post("thn")));
			$operasi = $this->Mgt001->tambah($ur, $jml, $cam, $ipw, $thn);
			if ($operasi == "1") {
				$ket = "Uraian: $ur,\nJumlah: $jml,\nId Kecamatan: $cam,\nId IPW Kecamatan: $ipw,\nTahun Anggaran: $thn";
				$this->Mlog->log_history("Gerakan Penerapan Teknologi", "Tambah", $ket);
			}
			echo base64_encode($operasi);
		} else {
			echo base64_encode("99");
		}
	}

	public function update(){
		if ($this->aksesc[1] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$ur = trim(str_replace("'", "''", $this->input->post("ur")));
			$jml = trim(str_replace("'", "''", $this->input->post("jml")));
			$cam = trim(str_replace("'", "''", $this->input->post("cam")));
			$ipw = trim(str_replace("'", "''", $this->input->post("ipw")));
			$thn = trim(str_replace("'", "''", $this->input->post("thn")));
			$operasi = $this->Mgt001->update($id, $ur, $jml, $cam, $ipw, $thn);
			if ($operasi == "1") {
				$ket = "Id Gerakan Penerapan Teknologi: $id,\nUraian: $ur,\nJumlah: $jml,\nId Kecamatan: $cam,\nId IPW Kecamatan: $ipw,\nTahun Anggaran: $thn";
				$this->Mlog->log_history("Gerakan Penerapan Teknologi", "Update", $ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus()
	{
		if ($this->aksesc[2] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$td = $this->Mgt001->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mgt001->filter($id);
					$operasi = $this->Mgt001->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$ur = $k->uraian;
							$jml = $k->jumlah;
							$cam = $k->id_kecamatan;
							$ipw = $k->id_ipwkecamatan;
							$thn = $k->id_tahun;
						}
						$ket = "Id Gerakan Penerapan Teknologi: $id,\nUraian: $ur,\nJumlah: $jml,\nId Kecamatan: $cam,\nId IPW Kecamatan: $ipw,\nTahun Anggaran: $thn";
						$this->Mlog->log_history("Gerakan Penerapan Teknologi", "Hapus", $ket);
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
