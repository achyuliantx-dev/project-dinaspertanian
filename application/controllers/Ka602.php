<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ka602 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ka602";
		$this->load->model("Mka602");
		$this->load->model("Mak789");
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
		$data["fill"] = "ka602v";
		$data["dtak"] = $this->Mak789->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mka602->data();
        foreach ($dt as $k){
            $id = $k->id;
            $akab = $k->asosiasi_kab;
            $ket = $k->ketua;
            $sek = $k->sekretaris;
            $ben = $k->bendahara;
            $pawal = $k->periode_awal;
            $pakhir = $k->periode_akhir;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$akab.'","'.$ket.'","'.$sek.'","'.$ben.'","'.$pawal.'","'.$pakhir.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpt071->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
				$id = $k->id;
	            $akab = $k->id_asosiasi_kab;
	            $ket = $k->ketua;
	            $sek = $k->sekretaris;
	            $ben = $k->bendahara;
	            $pawal = $k->periode_awal;
	            $pakhir = $k->periode_akhir;
				}
				echo base64_encode("1|".$id."|".$akab."|".$ket."|".$sek."|".$ben."|".$pawal."|".$pakhir);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$akab = trim(str_replace("'","''",$this->input->post("akab")));
			$ket = trim(str_replace("'","''",$this->input->post("ketua")));
			$sek = trim(str_replace("'","''",$this->input->post("sekretaris")));
			$ben = trim(str_replace("'","''",$this->input->post("bendahara")));
			$pawal = trim(str_replace("'","''",$this->input->post("pawal")));
			$pakhir = trim(str_replace("'","''",$this->input->post("pakhir")));
			$operasi = $this->Mka602->tambah($akab, $ket, $sek, $ben, $pawal, $pakhir);
			if($operasi == "1"){
				$ket = "ID Asosiasi Kab: $akab,\nNama Ketua: $ket,\nNama Sekretaris: $sek, \nNama Bendahara: $ben, \nPeriode Awal: $pawal,\nPeriode Akhir: $pakhir";
				$this->Mlog->log_history("Pengurus Asosiasi Kab","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$akab = trim(str_replace("'","''",$this->input->post("akab")));
			$ket = trim(str_replace("'","''",$this->input->post("ketua")));
			$sek = trim(str_replace("'","''",$this->input->post("sekretaris")));
			$ben = trim(str_replace("'","''",$this->input->post("bendahara")));
			$pawal = trim(str_replace("'","''",$this->input->post("pawal")));
			$pakhir = trim(str_replace("'","''",$this->input->post("pakhir")));
			$operasi = $this->Mka602->update($id, $akab, $ket, $sek, $ben, $pawal, $pakhir);
			if($operasi == "1"){
				$ket = "ID Pengurus Asosiasi Kab: $id,\nID Asosiasi Kab: $akab,\nNama Ketua: $ket,\nNama Sekretaris: $sek, \nNama Bendahara: $ben, \nPeriode Awal: $pawal,\nPeriode Akhir: $pakhir";
				$this->Mlog->log_history("Pengurus Asosiasi Kab","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mka602->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mka602->filter($id);
					$operasi = $this->Mka602->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $akab = $k->id_asosiasi_kab;
				            $ket = $k->ketua;
				            $sek = $k->sekretaris;
				            $ben = $k->bendahara;
				            $pawal = $k->periode_awal;
				            $pakhir = $k->periode_akhir;
						}
						$ket = "ID Asosiasi Kab: $akab,\nNama Ketua: $ket,\nNama Sekretaris: $sek, \nNama Bendahara: $ben, \nPeriode Awal: $pawal,\nPeriode Akhir: $pakhir";
						$this->Mlog->log_history("Pengurus Asosiasi Kab","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}