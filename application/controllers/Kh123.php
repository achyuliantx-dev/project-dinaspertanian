<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kh123 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "kh123";
		$this->load->model("Mkh123");
		$this->load->model("Mld111");
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
		$data["fill"] = "kh123v";
		$data["dtnop"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mkh123->data();
        foreach ($dt as $k){
            $id = $k->id;
            $id_lahan = $k->id_lahan;
            $nilai_n = $k->nilai_n;
            $nilai_p = $k->nilai_p;
            $nilai_k = $k->nilai_k;
            $ph = $k->nilai_ph;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$id_lahan.'","'.$nilai_n.'","'.$nilai_p.'","'.$nilai_k.'","'.$ph.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mkh123->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $id_lahan = $k->id_lahan;
		            $nilai_n = $k->nilai_n;
		            $nilai_p = $k->nilai_p;
		            $nilai_k = $k->nilai_k;
		            $ph = $k->nilai_ph;		
				}
				echo base64_encode("1|".$id."|".$id_lahan."|".$nilai_n."|".$nilai_p."|".$nilai_k."|".$ph);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$nilai_n = trim(str_replace("'","''",$this->input->post("nilai_n")));
			$nilai_p = trim(str_replace("'","''",$this->input->post("nilai_p")));
			$nilai_k = trim(str_replace("'","''",$this->input->post("nilai_k")));
			$ph = trim(str_replace("'","''",$this->input->post("ph")));
			$operasi = $this->Mkh123->tambah($id_lahan, $nilai_n, $nilai_p, $nilai_k, $ph);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nNilai n: $nilai_n,\nNilai p: $nilai_p,\nNilai k: $nilai_k,\nNilai Ph: $ph";
				$this->Mlog->log_history("Tabel Kandungan Unsur Hara","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$nilai_n = trim(str_replace("'","''",$this->input->post("nilai_n")));
			$nilai_p = trim(str_replace("'","''",$this->input->post("nilai_p")));
			$nilai_k = trim(str_replace("'","''",$this->input->post("nilai_k")));
			$ph = trim(str_replace("'","''",$this->input->post("ph")));
			$operasi = $this->Mkh123->update($id, $id_lahan, $nilai_n, $nilai_p, $nilai_k, $ph);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nNilai n: $nilai_n,\nNilai p: $nilai_p,\nNilai k: $nilai_k,\nNilai Ph: $ph";
				$this->Mlog->log_history("Tabel Kandungan Unsur Hara","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mkh123->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mkh123->filter($id);
					$operasi = $this->Mkh123->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $id_lahan = $k->id_lahan;
				            $nilai_n = $k->nilai_n;
				            $nilai_p = $k->nilai_p;
				            $nilai_k = $k->nilai_k;
				            $ph = $k->nilai_ph;	
						}
						$ket = "Kode Lahan: $id_lahan,\nNilai n: $nilai_n,\nNilai p: $nilai_p,\nNilai k: $nilai_k,\nNilai Ph: $ph";
						$this->Mlog->log_history("Tabel Kandungan Unsur Hara","Delete",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}