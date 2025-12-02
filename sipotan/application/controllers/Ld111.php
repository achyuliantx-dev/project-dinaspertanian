<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ld111 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ld111";
		$this->load->model("Mld111");
		$this->load->model("Mbp112");
		$this->load->model("Mva112");
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
		$data["fill"] = "ld111v";
		$data["dtbp"] = $this->Mbp112->data();
		$data["dtvar"] = $this->Mva112->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mld111->data();
        foreach ($dt as $k){
            $id_lahan = $k->id_lahan;
            $id_bpp = $k->id_bpp;
            $luas = $k->luas;
            $msm = $k->musim;
            $id_var = $k->id_varietas;
            $pt = $k->pola_tanam;
            $kbo = $k->kandungan_bo;
            $bpp = $k->nama_bpp;
            $var = $k->nama_varietas;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id_lahan."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id_lahan.'","'.$bpp.'","'.$luas.'","'.$msm.'","'.$var.'","'.$kbo.'","'.$pt.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id_lahan = trim($this->input->post("id"));
		$dt = $this->Mld111->filter($id_lahan);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id_lahan = $k->id_lahan;
		            $id_bpp = $k->id_bpp;
		            $luas = $k->luas;
		            $msm = $k->musim;
		            $id_var = $k->id_varietas;
		            $pt = $k->pola_tanam;
		            $kbo = $k->kandungan_bo;
		            // $bpp = $k->nama_bpp;
		            // $var = $k->nama_varietas;
				}
				echo base64_encode("1|".$id_lahan."|".$id_bpp."|".$luas."|".$msm."|".$id_var."|".$pt."|".$kbo);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id_bpp = trim(str_replace("'","''",$this->input->post("id_bpp")));
			$luas = trim(str_replace("'","''",$this->input->post("luas")));
			$msm = trim(str_replace("'","''",$this->input->post("msm")));
			$id_var = trim(str_replace("'","''",$this->input->post("id_var")));
			$pt = trim(str_replace("'","''",$this->input->post("pt")));
			$kbo = trim(str_replace("'","''",$this->input->post("kbo")));
			$operasi = $this->Mld111->tambah($id_bpp, $luas, $msm, $id_var, $pt, $kbo);
			if($operasi == "1"){
				$ket = "Id Bpp: $id_bpp,\nLuas Lahan: $luas,\nMusim: $msm,\nID Varietas: $id_var,\nPola Tanam: $pt,\nKandungan BO: $kbo";
				$this->Mlog->log_history("Tabel Lahan Demplot","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$id_bpp = trim(str_replace("'","''",$this->input->post("id_bpp")));
			$luas = trim(str_replace("'","''",$this->input->post("luas")));
			$msm = trim(str_replace("'","''",$this->input->post("msm")));
			$id_var = trim(str_replace("'","''",$this->input->post("id_var")));
			$pt = trim(str_replace("'","''",$this->input->post("pt")));
			$kbo = trim(str_replace("'","''",$this->input->post("kbo")));
			$operasi = $this->Mld111->update($id_lahan,$id_bpp, $luas, $msm, $id_var, $pt, $kbo);
			if($operasi == "1"){
				$ket = "Id Lahan Demplot: $id_lahan,\nId Bpp: $id_bpp,\nLuas Lahan: $luas,\nMusim: $msm,\nID Varietas: $id_var,\nPola Tanam: $pt,\nKandungan BO: $kbo";
				$this->Mlog->log_history("Tabel Lahan Demplot","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$td = $this->Mld111->cekform($id_lahan);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mld111->filter($id_lahan);
					$operasi = $this->Mld111->hapus($id_lahan);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id_lahan = $k->id_lahan;
				            $id_bpp = $k->id_bpp;
				            $luas = $k->luas;
				            $msm = $k->musim;
				            $id_var = $k->id_varietas;
				            $pt = $k->pola_tanam;
				            $kbo = $k->kandungan_bo;
						}
						$ket = "Id Bpp: $id_bpp,\nLuas Lahan: $luas,\nMusim: $msm,\nID Varietas: $id_var,\nPola Tanam: $pt,\nKandungan BO: $kbo";
						$this->Mlog->log_history("Tabel Lahan Demplot","Delete",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}