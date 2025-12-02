<?php
defined('BASEPATH') OR exit('No direct scriburuk access allowed');
class Pa111 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pa111";
		$this->load->model("Mpa111");
		$this->load->model("Mpt034");
		$this->load->model("Mal111");
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
		$data["fill"] = "pa111v";
		$data["dtpok"] = $this->Mpt034->data();
		$data["dtalsintan"] = $this->Mal111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpa111->data();
        foreach ($dt as $k){
            $id = $k->id;
            $poktan = $k->poktan;
            $jenis_alsintan = $k->jenis_alsintan;
            $pribadi = $k->k_pribadi;
            $kelompok = $k->k_kelompok;
            $kepemilikan = "Pribadi= $pribadi, Kelompok= $kelompok";  
            $baik = $k->k_baik;
            $buruk = $k->k_buruk;
            $kondisi = "Baik= $baik, Buruk= $buruk";
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$poktan.'","'.$jenis_alsintan.'","'.$kepemilikan.'","'.$kondisi.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpa111->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
				 	$id = $k->id;
		            $poktan = $k->id_poktan;
		            $jenis_alsintan = $k->id_alsintan;
		            $pribadi = $k->k_pribadi;
		            $kelompok = $k->k_kelompok;
		            $baik = $k->k_baik;
		            $buruk = $k->k_buruk;
				}
				echo base64_encode("1|".$id."|".$poktan."|".$jenis_alsintan."|".$pribadi."|".$kelompok."|".$baik."|".$buruk);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$poktan = trim(str_replace("'","''",$this->input->post("poktan")));
			$jenis_alsintan = trim(str_replace("'","''",$this->input->post("jenis_alsintan")));
			$pribadi = trim(str_replace("'","''",$this->input->post("pribadi")));
			$kelompok = trim(str_replace("'","''",$this->input->post("kelompok")));
			$baik = trim(str_replace("'","''",$this->input->post("baik")));
			$buruk = trim(str_replace("'","''",$this->input->post("buruk")));
			$operasi = $this->Mpa111->tambah($poktan, $jenis_alsintan, $pribadi, $kelompok, $baik, $buruk);
			if($operasi == "1"){
				$ket = "ID Poktan: $poktan,\nID Jenis Alsintan: $jenis_alsintan,\nID Kepemilikan Pribadi: $pribadi,\nKepemilikan Kelompok: $kelompok,\nKondisi Baik: $baik,\nKondisi Buruk: $buruk";
				$this->Mlog->log_history("Prasarana Alsintan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$poktan = trim(str_replace("'","''",$this->input->post("poktan")));
			$jenis_alsintan = trim(str_replace("'","''",$this->input->post("jenis_alsintan")));
			$pribadi = trim(str_replace("'","''",$this->input->post("pribadi")));
			$kelompok = trim(str_replace("'","''",$this->input->post("kelompok")));
			$baik = trim(str_replace("'","''",$this->input->post("baik")));
			$buruk = trim(str_replace("'","''",$this->input->post("buruk")));
			$operasi = $this->Mpa111->update($id, $poktan, $jenis_alsintan, $pribadi, $kelompok, $baik, $buruk);
			if($operasi == "1"){
				$ket = "ID Alsintan: $id,\nID Poktan: $poktan,\nID Jenis Alsintan: $jenis_alsintan,\nID Kepemilikan Pribadi: $pribadi,\nKepemilikan Kelompok: $kelompok,\nKondisi Baik: $baik,\nKondisi Buruk: $buruk";
				$this->Mlog->log_history("Prasarana Alsintan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpa111->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpa111->filter($id);
					$operasi = $this->Mpa111->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $poktan = $k->id_poktan;
				            $jenis_alsintan = $k->id_alsintan;
				            $pribadi = $k->k_pribadi;
				            $kelompok = $k->k_kelompok;
				            $baik = $k->k_baik;
				            $buruk = $k->k_buruk;
						}
						$ket = "ID Alsintan: $id,\nID Poktan: $poktan,\nID Jenis Alsintan: $jenis_alsintan,\nID Kepemilikan Pribadi: $pribadi,\nKepemilikan Kelompok: $kelompok,\nKondisi Baik: $baik,\nKondisi Buruk: $buruk";
						$this->Mlog->log_history("Prasarana Alsintan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}