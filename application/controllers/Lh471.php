<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lh471 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "lh471";
		$this->load->model('Mlh471');
		$this->load->model('Mpt001');
		$this->load->model('Mds001');
		$this->load->model('Mkl412');
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
		$data["fill"] = "lh471v";
		$data["dtdes"] = $this->Mds001->data();
		$data["dtpet"] = $this->Mpt001->data();
		$data["dtket"] = $this->Mkl412->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mlh471->data();
        foreach ($dt as $k){
        	$nop = $k->nop;
            $nik = $k->nik;
            $petani = $k->petani;
            $has = $k->lahan_subsidi;
            $han = $k->lahan_nonsubsidi;
            $ha = $k->luas_ha;
            $jen = $k->kategori_lahan;
            $jenis = $k->id_kategori_lahan;
			$des = $k->id_desa;
			$desa = $k->desa;
			$lin= $k->lintang;
			$buj = $k->bujur;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$nop."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$nop.'","'.$petani.'","'.$has.'","'.$han.'","'.$ha.'","'.$jen.'","'.$desa.'","'.$lin.'","'.$buj.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$nop = trim($this->input->post("id"));
		$dt = $this->Mlh471->filter($nop);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$nop = $k->nop;
		            $nik = $k->nik;
		            $has = $k->lahan_subsidi;
            		$han = $k->lahan_nonsubsidi;
		            // $ha = $k->luas_ha;
		            $jenis = $k->id_kategori_lahan;
					$des = $k->id_desa;
					$lin= $k->lintang;
					$buj = $k->bujur;
				}
				echo base64_encode("1|".$nop."|".$nik."|".$has."|".$han."|".$jenis."|".$des."|".$lin."|".$buj);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	

public function tambah(){
		if($this->aksesc[0] == "1"){
			$nop = trim(str_replace("'","''",$this->input->post("nop")));
			$nik = trim(str_replace("'","''",$this->input->post("nik")));
			$has = trim(str_replace("'","''",$this->input->post("has")));
			$han = trim(str_replace("'","''",$this->input->post("han")));
			// $ha = trim(str_replace("'","''",$this->input->post("ha")));
			$jenis = trim(str_replace("'","''",$this->input->post("jenis")));
			$des = trim(str_replace("'","''",$this->input->post("des")));
			$lin = trim(str_replace("'","''",$this->input->post("lin")));
			$buj = trim(str_replace("'","''",$this->input->post("buj")));
			$operasi = $this->Mlh471->tambah($nop, $nik, $has, $han, $jenis, $des, $lin, $buj);
			if($operasi == "1"){
				$ket = "NOP: $nop,\nNik: $nik,\nLuas Lahan Subsidi: $has,\n Luas Lahan Nonsubsidi: $han,\nID Kategori Lahan: $jenis,\nID Desa: $des,\nLintang: $lin,\nBujur: $buj";
				$this->Mlog->log_history("Lahan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$nop = trim(str_replace("'","''",$this->input->post("nop")));
			$nik = trim(str_replace("'","''",$this->input->post("nik")));
			$has = trim(str_replace("'","''",$this->input->post("has")));
			$han = trim(str_replace("'","''",$this->input->post("han")));
			// $ha = trim(str_replace("'","''",$this->input->post("ha")));
			$jenis = trim(str_replace("'","''",$this->input->post("jenis")));
			$des = trim(str_replace("'","''",$this->input->post("des")));
			$lin = trim(str_replace("'","''",$this->input->post("lin")));
			$buj = trim(str_replace("'","''",$this->input->post("buj")));
			$operasi = $this->Mlh471->update($nop, $nik, $has, $han, $jenis, $des, $lin, $buj);
			if($operasi == "1"){
				$ket = "NOP: $nop,\nNik: $nik,\nLuas Lahan Subsidi: $has,\n Luas Lahan Nonsubsidi: $han,\nID Kategori Lahan: $jenis,\nID Desa: $des,\nLintang: $lin,\nBujur: $buj";
				$this->Mlog->log_history("Lahan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$nop = trim(str_replace("'","''",$this->input->post("nop")));
			$td = $this->Mlh471->cekform($nop);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mlh471->filter($nop);
					$operasi = $this->Mlh471->hapus($nop);
					if($operasi == "1"){
						foreach ($dt as $k){
							$nop = $k->nop;
				            $nik = $k->nik;
				            $has = $k->lahan_subsidi;
		            		$han = $k->lahan_nonsubsidi;
				            // $ha = $k->luas_ha;
				            $jenis = $k->id_kategori_lahan;
							$des = $k->id_desa;
							$lin= $k->lintang;
							$buj = $k->bujur;
						}
						
						$ket = "NOP: $nop,\nNik: $nik,\nLuas Lahan Subsidi: $has,\n Luas Lahan Nonsubsidi: $han,\nID Kategori Lahan: $jenis,\nID Desa: $des,\nLintang: $lin,\nBujur: $buj";
						 $this->Mlog->log_history("Lahan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}