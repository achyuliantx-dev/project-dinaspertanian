<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pg207 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pg207";
		$this->load->model('Mpg207');
		$this->load->model('Mgp001');
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
		$data["fill"] = "pg207v";
		$data["dtgap"] = $this->Mgp001->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpg207->data();
        foreach ($dt as $k){
            $id = $k->id;
            $gap = $k->id_gapoktan;
            $gp = $k->gapoktan;
            $ket = $k->ketua;
            $sek = $k->sekretaris;
            $ben = $k->bendahara;
            $tgl1 = $k->periode_awal;
            $tgl = $k->periode_akhir;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$gp.'","'.$ket.'","'.$sek.'","'.$ben.'","'.$tgl1.'","'.$tgl.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpg207->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $gap = $k->id_gapoktan;
		            $ket = $k->ketua;
		            $sek = $k->sekretaris;
		            $ben = $k->bendahara;
		            $tgl1 = $k->periode_awal;
		            $tgl = $k->periode_akhir;
				}
				echo base64_encode("1|".$id."|".$gap."|".$ket."|".$sek."|".$ben."|".$tgl1."|".$tgl);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$gap = trim(str_replace("'","''",$this->input->post("gap")));
			$ket = trim(str_replace("'","''",$this->input->post("ket")));
			$sek = trim(str_replace("'","''",$this->input->post("sek")));
			$ben = trim(str_replace("'","''",$this->input->post("ben")));
			$tgl1 = trim(str_replace("'","''",$this->input->post("tgl1")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$operasi = $this->Mpg207->tambah($gap, $ket, $sek, $ben, $tgl1, $tgl);
			if($operasi == "1"){
				$ket = "Nama Gapoktan: $gap,\nKetua: $ket,\nSekretaris: $sek,\nBendahara: $ben,\nPeriode Awal: $tgl1,\nPeriode Akhir: $tgl";
				$this->Mlog->log_history("Pengurus Gapoktan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$gap = trim(str_replace("'","''",$this->input->post("gap")));
			$ket = trim(str_replace("'","''",$this->input->post("ket")));
			$sek = trim(str_replace("'","''",$this->input->post("sek")));
			$ben = trim(str_replace("'","''",$this->input->post("ben")));
			$tgl1 = trim(str_replace("'","''",$this->input->post("tgl1")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$operasi = $this->Mpg207->update($id, $gap, $ket, $sek, $ben, $tgl1, $tgl);
			if($operasi == "1"){
				$ket = "ID Pengurus Gapoktan: $id,\nNama Gapoktan: $gap,\nKetua: $ket,\nSekretaris: $sek,\nBendahara: $ben,\nPeriode Awal: $tgl1,\nPeriode Akhir: $tgl";
				$this->Mlog->log_history("Pengurus Gapoktan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpg207->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpg207->filter($id);
					$operasi = $this->Mpg207->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $gap = $k->id_gapoktan;
				            $ket = $k->ketua;
				            $sek = $k->sekretaris;
				            $ben = $k->bendahara;
				            $tgl1 = $k->periode_awal;
				            $tgl = $k->periode_akhir;
						}
						$ket = "ID Pengurus Gapoktan: $id,\nNama Gpaoktan: $gap,\nKetua: $ket,\nSekretaris: $sek,\nBendahara: $ben,\nPeriode Awal: $tgl1,\nPeriode Akhir: $tgl";
				$this->Mlog->log_history("Pengurus Gapoktan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}