<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pe888 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pe888";
		$this->load->model("Mpe888");
		$this->load->model("Mld111");
		$this->load->model("Map543");
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
		$data["fill"] = "pe888v";
		$data["dtlahan"] = $this->Mld111->data();
		$data["dtalat"] = $this->Map543->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpe888->data();
        foreach ($dt as $k){
            $id = $k->id;
            $lahan = $k->id_lahan;
            $umur1 = $k->umur_penyiangan1;
            $alat1 = $k->alat_penyiangan1;
            $umur2 = $k->umur_penyiangan2;
            $alat2 = $k->alat_penyiangan2;
            $umur3 = $k->umur_penyiangan3;
            $alat3 = $k->alat_penyiangan3;
            $umur4 = $k->umur_penyiangan4;
            $alat4 = $k->alat_penyiangan4;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$lahan.'","'.$umur1.'","'.$alat1.'","'.$umur2.'","'.$alat2.'","'.$umur3.'","'.$alat3.'","'.$umur4.'","'.$alat4.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpe888->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $lahan = $k->id_lahan;
		            $umur1 = $k->umur_penyiangan1;
		            $alat1 = $k->alat_penyiangan1;
		            $umur2 = $k->umur_penyiangan2;
		            $alat2 = $k->alat_penyiangan2;
		            $umur3 = $k->umur_penyiangan3;
		            $alat3 = $k->alat_penyiangan3;
		            $umur4 = $k->umur_penyiangan4;
		            $alat4 = $k->alat_penyiangan4;
				}
				echo base64_encode("1|".$id."|".$lahan."|".$umur1."|".$alat1."|".$umur2."|".$alat2."|".$umur3."|".$alat3."|".$umur4."|".$alat4);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$umur1 = trim(str_replace("'","''",$this->input->post("umur1")));
			$alat1 = trim(str_replace("'","''",$this->input->post("alat1")));
			$umur2 = trim(str_replace("'","''",$this->input->post("umur2")));
			$alat2 = trim(str_replace("'","''",$this->input->post("alat2")));
			$umur3 = trim(str_replace("'","''",$this->input->post("umur3")));
			$alat3 = trim(str_replace("'","''",$this->input->post("alat3")));
			$umur4 = trim(str_replace("'","''",$this->input->post("umur4")));
			$alat4 = trim(str_replace("'","''",$this->input->post("alat4")));
			$operasi = $this->Mpe888->tambah($lahan, $umur1, $alat1, $umur2, $alat2, $umur3, $alat3, $umur4,  $alat4);
			if($operasi == "1"){
				$ket = "ID Lahan: $lahan,\nUmur Penyiangan I: $umur1,\nAlat Penyiangan I: $alat1,\nUmur Penyiangan II: $umur2,\nAlat Penyiangan II: $alat2,\nUmur Penyiangan III: $umur3,\nAlat Penyiangan III: $alat3,\nUmur Penyiangan IV: $umur4,\nAlat Penyiangan IV: $alat4";
				$this->Mlog->log_history("Penyiangan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$umur1 = trim(str_replace("'","''",$this->input->post("umur1")));
			$alat1 = trim(str_replace("'","''",$this->input->post("alat1")));
			$umur2 = trim(str_replace("'","''",$this->input->post("umur2")));
			$alat2 = trim(str_replace("'","''",$this->input->post("alat2")));
			$umur3 = trim(str_replace("'","''",$this->input->post("umur3")));
			$alat3 = trim(str_replace("'","''",$this->input->post("alat3")));
			$umur4 = trim(str_replace("'","''",$this->input->post("umur4")));
			$alat4 = trim(str_replace("'","''",$this->input->post("alat4")));
			$operasi = $this->Mpe888->update($id, $lahan, $umur1, $alat1, $umur2, $alat2, $umur3, $alat3, $umur4,  $alat4);
			if($operasi == "1"){
				$ket = "ID Penyiangan: $id,\nID Lahan: $lahan,\nUmur Penyiangan I: $umur1,\nAlat Penyiangan I: $alat1,\nUmur Penyiangan II: $umur2,\nAlat Penyiangan II: $alat2,\nUmur Penyiangan III: $umur3,\nAlat Penyiangan III: $alat3,\nUmur Penyiangan IV: $umur4,\nAlat Penyiangan IV: $alat4";
				$this->Mlog->log_history("Penyiangan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpe888->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpe888->filter($id);
					$operasi = $this->Mpe888->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $lahan = $k->id_lahan;
				            $umur1 = $k->umur_penyiangan1;
				            $alat1 = $k->alat_penyiangan1;
				            $umur2 = $k->umur_penyiangan2;
				            $alat2 = $k->alat_penyiangan2;
				            $umur3 = $k->umur_penyiangan3;
				            $alat3 = $k->alat_penyiangan3;
				            $umur4 = $k->umur_penyiangan4;
				            $alat4 = $k->alat_penyiangan4;
						}
						$ket = "ID Penyiangan: $id,\nID Lahan: $lahan,\nUmur Penyiangan I: $umur1,\nAlat Penyiangan I: $alat1,\nUmur Penyiangan II: $umur2,\nAlat Penyiangan II: $alat2,\nUmur Penyiangan III: $umur3,\nAlat Penyiangan III: $alat3,\nUmur Penyiangan IV: $umur4,\nAlat Penyiangan IV: $alat4";
						$this->Mlog->log_history("Penyiangan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}