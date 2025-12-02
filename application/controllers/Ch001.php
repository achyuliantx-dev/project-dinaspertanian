<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ch001 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ch001";
		$this->load->model('Mch001');
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

	public function index(){
		$data["fill"] = "ch001v";
		$data["dtkec"] = $this->Mkc001->data();
		$data["dtta"] = $this->Mtn123->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mch001->data();
        foreach ($dt as $k){
            $id = $k->id;
            if ($k->bulan == "1") {
				$bul= "Januari";
			}elseif ($k->bulan == "2") {
				$bul = "Februari";
			}elseif ($k->bulan == "3") {
				$bul = "Maret";
			}elseif ($k->bulan == "4") {
				$bul = "April";
			}elseif ($k->bulan == "5") {
				$bul = "Mei";
			}elseif ($k->bulan == "6") {
				$bul = "Juni";
			}elseif ($k->bulan == "7") {
				$bul = "Juli";
			}elseif ($k->bulan == "8") {
				$bul = "Agustus";
			}elseif ($k->bulan == "9") {
				$bul = "September";
			}elseif ($k->bulan == "10") {
				$bul = "Oktober";
			}elseif ($k->bulan == "11") {
				$bul = "November";
			}else{
				$bul="Desember";
			}
			$ch = $k->ch;
			$hh = $k->hh;
			$ta = $k->tahun_anggaran;
			$cam = $k->kecamatan;
            $kec = $k->id_kecamatan;
            $tan=$k->id_tahun_anggaran;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$bul.'","'.$ch.'","'.$hh.'","'.$ta.'","'.$cam.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mch001->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$bul = $k->bulan;
					$ch = $k->ch;
					$hh = $k->hh;
					$tan = $k->id_tahun_anggaran;
		            $kec = $k->id_kecamatan;
		            
				}
				echo base64_encode("1|".$id."|".$bul."|".$ch."|".$hh."|".$tan."|".$kec);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if ($this->aksesc[0] == "1") {
			$bul = trim(str_replace("'", "''", $this->input->post("bul")));
			$ch = trim(str_replace("'", "''", $this->input->post("ch")));
			$hh = trim(str_replace("'", "''", $this->input->post("hh")));
			$ta = trim(str_replace("'", "''", $this->input->post("ta")));
			$kec = trim(str_replace("'", "''", $this->input->post("kec")));
			$operasi = $this->Mch001->tambah($bul, $ch, $hh, $ta, $kec);
			if ($operasi == "1") {
				$ket = "Bulan: $bul,\nCurah Hujan: $ch,\nHari Hujan: $hh,\nId Tahun Anggaran: $ta,\nId Kecamatan: $kec";
				$this->Mlog->log_history("Curah Hujan", "Tambah", $ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if ($this->aksesc[1] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$bul = trim(str_replace("'", "''", $this->input->post("bul")));
			$ch = trim(str_replace("'", "''", $this->input->post("ch")));
			$hh = trim(str_replace("'", "''", $this->input->post("hh")));
			$ta = trim(str_replace("'", "''", $this->input->post("ta")));
			$kec = trim(str_replace("'", "''", $this->input->post("kec")));
			$operasi = $this->Mch001->update($id, $bul, $ch, $hh, $ta, $kec);
			if ($operasi == "1") {
				$ket = "Id Curah Hujan: $id,\nBulan: $bul,\nCurah Hujan: $ch,\nHari Hujan: $hh,\nId Tahun Anggaran: $ta,\nId Kecamatan: $kec";
				$this->Mlog->log_history("Curah Hujan", "Update", $ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$td = $this->Mch001->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mch001->filter($id);
					$operasi = $this->Mch001->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$bul = $k->bulan;
							$ch = $k->ch;
							$hh = $k->hh;
							$tan = $k->id_tahun_anggaran;
							$kec = $k->id_kecamatan;
						}
						$ket = "ID Curah Hujan: $id,\nBulan: $bul,\nCurah Hujan: $ch,,\nHari Hujan: $hh,\nID Tahun Anggaran: $tan,\nId Kecamatan:$kec";
						$this->Mlog->log_history("Curah Hujan", "Hapus", $ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}