<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Am222 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "am222";
		$this->load->model("Mam222");
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
		$data["fill"] = "am222v";
		$data["dtnop"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mam222->data();
        foreach ($dt as $k){
            $id = $k->id;
            $id_lahan = $k->id_lahan;
            $uam1 = $k->umur_apl_mol1;
            $dam1 = $k->dosis_apl_mol1;
            $uam2 = $k->umur_apl_mol2;
            $dam2 = $k->dosis_apl_mol2;
            $uam3 = $k->umur_apl_mol3;
            $dam3 = $k->dosis_apl_mol3;
            $uam4 = $k->umur_apl_mol4;
            $dam4 = $k->dosis_apl_mol4;
            $uam5 = $k->umur_apl_mol5;
            $dam5 = $k->dosis_apl_mol5;
            
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$id_lahan.'","'.$uam1.'","'.$dam1.'","'.$uam2.'","'.$dam2.'","'.$uam3.'","'.$dam3.'","'.$uam4.'","'.$dam4.'","'.$uam5.'","'.$dam5.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mam222->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $id_lahan = $k->id_lahan;
		            $uam1 = $k->umur_apl_mol1;
		            $dam1 = $k->dosis_apl_mol1;
		            $uam2 = $k->umur_apl_mol2;
		            $dam2 = $k->dosis_apl_mol2;
		            $uam3 = $k->umur_apl_mol3;
		            $dam3 = $k->dosis_apl_mol3;
		            $uam4 = $k->umur_apl_mol4;
		            $dam4 = $k->dosis_apl_mol4;
		            $uam5 = $k->umur_apl_mol5;
		            $dam5 = $k->dosis_apl_mol5;	
				}
				echo base64_encode("1|".$id."|".$id_lahan."|".$uam1."|".$dam1."|".$uam2."|".$dam2."|".$uam3."|".$dam3."|".$uam4."|".$dam4."|".$uam5."|".$dam5);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$uam1 = trim(str_replace("'","''",$this->input->post("uam1")));
			$dam1 = trim(str_replace("'","''",$this->input->post("dam1")));
			$uam2 = trim(str_replace("'","''",$this->input->post("uam2")));
			$dam2 = trim(str_replace("'","''",$this->input->post("dam2")));
			$uam3 = trim(str_replace("'","''",$this->input->post("uam3")));
			$dam3 = trim(str_replace("'","''",$this->input->post("dam3")));
			$uam4 = trim(str_replace("'","''",$this->input->post("uam4")));
			$dam4 = trim(str_replace("'","''",$this->input->post("dam4")));
			$uam5 = trim(str_replace("'","''",$this->input->post("uam5")));
			$dam5 = trim(str_replace("'","''",$this->input->post("dam5")));
			
			$operasi = $this->Mam222->tambah($id_lahan, $uam1, $dam1, $uam2, $dam2, $uam3, $dam3, $uam4, $dam4, $uam5, $dam5);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nUmur aplikasi MOL1: $uam1,\nDosis aplikasi MOL1: $dam1,\nUmur aplikasi MOL2: $uam2,\nDosis aplikasi MOL2: $dam2,\nUmur aplikasi MOL3: $uam3,\nDosis aplikasi MOL3: $dam3,\nUmur aplikasi MOL4: $uam4,\nDosis aplikasi MOL4: $dam4,\nUmur aplikasi MOL5: $uam5,\nDosis aplikasi MOL5: $dam5";
				$this->Mlog->log_history("Tabel Aplikasi MOL","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$uam1 = trim(str_replace("'","''",$this->input->post("uam1")));
			$dam1 = trim(str_replace("'","''",$this->input->post("dam1")));
			$uam2 = trim(str_replace("'","''",$this->input->post("uam2")));
			$dam2 = trim(str_replace("'","''",$this->input->post("dam2")));
			$uam3 = trim(str_replace("'","''",$this->input->post("uam3")));
			$dam3 = trim(str_replace("'","''",$this->input->post("dam3")));
			$uam4 = trim(str_replace("'","''",$this->input->post("uam4")));
			$dam4 = trim(str_replace("'","''",$this->input->post("dam4")));
			$uam5 = trim(str_replace("'","''",$this->input->post("uam5")));
			$dam5 = trim(str_replace("'","''",$this->input->post("dam5")));
			$operasi = $this->Mam222->update($id, $id_lahan, $uam1, $dam1, $uam2, $dam2, $uam3, $dam3, $uam4, $dam4, $uam5, $dam5);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nUmur aplikasi MOL1: $uam1,\nDosis aplikasi MOL1: $dam1,\nUmur aplikasi MOL2: $uam2,\nDosis aplikasi MOL2: $dam2,\nUmur aplikasi MOL3: $uam3,\nDosis aplikasi MOL3: $dam3,\nUmur aplikasi MOL4: $uam4,\nDosis aplikasi MOL4: $dam4,\nUmur aplikasi MOL5: $uam5,\nDosis aplikasi MOL5: $dam5";
				$this->Mlog->log_history("Tabel Aplikasi MOL","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mam222->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mam222->filter($id);
					$operasi = $this->Mam222->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $id_lahan = $k->id_lahan;
				            $uam1 = $k->umur_apl_mol1;
				            $dam1 = $k->dosis_apl_mol1;
				            $uam2 = $k->umur_apl_mol2;
				            $dam2 = $k->dosis_apl_mol2;
				            $uam3 = $k->umur_apl_mol3;
				            $dam3 = $k->dosis_apl_mol3;
				            $uam4 = $k->umur_apl_mol4;
				            $dam4 = $k->dosis_apl_mol4;
				            $uam5 = $k->umur_apl_mol5;
				            $dam5 = $k->dosis_apl_mol5;
						}
						$ket = "Kode Lahan: $id_lahan,\nUmur aplikasi MOL1: $uam1,\nDosis aplikasi MOL1: $dam1,\nUmur aplikasi MOL2: $uam2,\nDosis aplikasi MOL2: $dam2,\nUmur aplikasi MOL3: $uam3,\nDosis aplikasi MOL3: $dam3,\nUmur aplikasi MOL4: $uam4,\nDosis aplikasi MOL4: $dam4,\nUmur aplikasi MOL5: $uam5,\nDosis aplikasi MOL5: $dam5";
						$this->Mlog->log_history("Tabel Aplikasi MOL","Delete",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}