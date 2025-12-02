<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ap123 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ap123";
		$this->load->model("Map123");
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
		$data["fill"] = "ap123v";
		$data["dtnop"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Map123->data();
        foreach ($dt as $k){
            $id = $k->id;
            $id_lahan = $k->id_lahan;
            $uap1 = $k->umur_apl_poc1;
            $dap1 = $k->dosis_apl_poc1;
            $uap2 = $k->umur_apl_poc2;
            $dap2 = $k->dosis_apl_poc2;
            $uap3 = $k->umur_apl_poc3;
            $dap3 = $k->dosis_apl_poc3;
            $uap4 = $k->umur_apl_poc4;
            $dap4 = $k->dosis_apl_poc4;
            $uap5 = $k->umur_apl_poc5;
            $dap5 = $k->dosis_apl_poc5;
            
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$id_lahan.'","'.$uap1.'","'.$dap1.'","'.$uap2.'","'.$dap2.'","'.$uap3.'","'.$dap3.'","'.$uap4.'","'.$dap4.'","'.$uap5.'","'.$dap5.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Map123->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $id_lahan = $k->id_lahan;
		            $uap1 = $k->umur_apl_poc1;
		            $dap1 = $k->dosis_apl_poc1;
		            $uap2 = $k->umur_apl_poc2;
		            $dap2 = $k->dosis_apl_poc2;
		            $uap3 = $k->umur_apl_poc3;
		            $dap3 = $k->dosis_apl_poc3;
		            $uap4 = $k->umur_apl_poc4;
		            $dap4 = $k->dosis_apl_poc4;
		            $uap5 = $k->umur_apl_poc5;
		            $dap5 = $k->dosis_apl_poc5;	
				}
				echo base64_encode("1|".$id."|".$id_lahan."|".$uap1."|".$dap1."|".$uap2."|".$dap2."|".$uap3."|".$dap3."|".$uap4."|".$dap4."|".$uap5."|".$dap5);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$uap1 = trim(str_replace("'","''",$this->input->post("uap1")));
			$dap1 = trim(str_replace("'","''",$this->input->post("dap1")));
			$uap2 = trim(str_replace("'","''",$this->input->post("uap2")));
			$dap2 = trim(str_replace("'","''",$this->input->post("dap2")));
			$uap3 = trim(str_replace("'","''",$this->input->post("uap3")));
			$dap3 = trim(str_replace("'","''",$this->input->post("dap3")));
			$uap4 = trim(str_replace("'","''",$this->input->post("uap4")));
			$dap4 = trim(str_replace("'","''",$this->input->post("dap4")));
			$uap5 = trim(str_replace("'","''",$this->input->post("uap5")));
			$dap5 = trim(str_replace("'","''",$this->input->post("dap5")));
			
			$operasi = $this->Map123->tambah($id_lahan, $uap1, $dap1, $uap2, $dap2, $uap3, $dap3, $uap4, $dap4, $uap5, $dap5);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nUmur aplikasi POC1: $uap1,\nDosis aplikasi POC1: $dap1,\nUmur aplikasi POC2: $uap2,\nDosis aplikasi POC2: $dap2,\nUmur aplikasi POC3: $uap3,\nDosis aplikasi POC3: $dap3,\nUmur aplikasi POC4: $uap4,\nDosis aplikasi POC4: $dap4,\nUmur aplikasi POC5: $uap5,\nDosis aplikasi POC5: $dap5";
				$this->Mlog->log_history("Tabel Aplikasi POC","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$uap1 = trim(str_replace("'","''",$this->input->post("uap1")));
			$dap1 = trim(str_replace("'","''",$this->input->post("dap1")));
			$uap2 = trim(str_replace("'","''",$this->input->post("uap2")));
			$dap2 = trim(str_replace("'","''",$this->input->post("dap2")));
			$uap3 = trim(str_replace("'","''",$this->input->post("uap3")));
			$dap3 = trim(str_replace("'","''",$this->input->post("dap3")));
			$uap4 = trim(str_replace("'","''",$this->input->post("uap4")));
			$dap4 = trim(str_replace("'","''",$this->input->post("dap4")));
			$uap5 = trim(str_replace("'","''",$this->input->post("uap5")));
			$dap5 = trim(str_replace("'","''",$this->input->post("dap5")));
			
			$operasi = $this->Map123->update($id, $id_lahan, $uap1, $dap1, $uap2, $dap2, $uap3, $dap3, $uap4, $dap4, $uap5, $dap5);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nUmur aplikasi POC1: $uap1,\nDosis aplikasi POC1: $dap1,\nUmur aplikasi POC2: $uap2,\nDosis aplikasi POC2: $dap2,\nUmur aplikasi POC3: $uap3,\nDosis aplikasi POC3: $dap3,\nUmur aplikasi POC4: $uap4,\nDosis aplikasi POC4: $dap4,\nUmur aplikasi POC5: $uap5,\nDosis aplikasi POC5: $dap5";
				$this->Mlog->log_history("Tabel Aplikasi POC","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Map123->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Map123->filter($id);
					$operasi = $this->Map123->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $id_lahan = $k->id_lahan;
				            $uap1 = $k->umur_apl_poc1;
				            $dap1 = $k->dosis_apl_poc1;
				            $uap2 = $k->umur_apl_poc2;
				            $dap2 = $k->dosis_apl_poc2;
				            $uap3 = $k->umur_apl_poc3;
				            $dap3 = $k->dosis_apl_poc3;
				            $uap4 = $k->umur_apl_poc4;
				            $dap4 = $k->dosis_apl_poc4;
				            $uap5 = $k->umur_apl_poc5;
				            $dap5 = $k->dosis_apl_poc5;	
						}
						$ket = "Kode Lahan: $id_lahan,\nUmur aplikasi POC1: $uap1,\nDosis aplikasi POC1: $dap1,\nUmur aplikasi POC2: $uap2,\nDosis aplikasi POC2: $dap2,\nUmur aplikasi POC3: $uap3,\nDosis aplikasi POC3: $dap3,\nUmur aplikasi POC4: $uap4,\nDosis aplikasi POC4: $dap4,\nUmur aplikasi POC5: $uap5,\nDosis aplikasi POC5: $dap5";
						$this->Mlog->log_history("Tabel Aplikasi POC","Delete",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}