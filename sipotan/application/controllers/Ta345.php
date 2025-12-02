<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ta345 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ta345";
		$this->load->model("Mta345");
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
		$data["fill"] = "ta345v";
		$data["dtlahan"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mta345->data();
        foreach ($dt as $k){
            $id = $k->id;
            $lahan = $k->id_lahan;
            $umurCB = $k->umur_cabut_bibit;
            $tglTanam = $k->tgl_tanam;
            $kondisiTa = $k->kondisi_tanah;
            $teknologiTe = $k->teknologi_terapan;
            $jarakTa = $k->jarak_tanam;
            $jmlBT = $k->jml_batang_tancap;
            $drainase = $k->drainase;
            $mekanisme = $k->mekanisme;
            $ub = $k->usia_bibit;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$lahan.'","'.$umurCB.'","'.$tglTanam.'","'.$kondisiTa.'","'.$teknologiTe.'","'.$jarakTa.'","'.$jmlBT.'","'.$drainase.'","'.$mekanisme.'","'.$ub.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mta345->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $lahan = $k->id_lahan;
		            $umurCB = $k->umur_cabut_bibit;
		            $tglTanam = $k->tgl_tanam;
		            $kondisiTa = $k->kondisi_tanah;
		            $teknologiTe = $k->teknologi_terapan;
		            $jarakTa = $k->jarak_tanam;
		            $jmlBT = $k->jml_batang_tancap;
		            $drainase = $k->drainase;
		            $mekanisme = $k->mekanisme;
		            $ub = $k->usia_bibit;
				}
				echo base64_encode("1|".$id."|".$lahan."|".$umurCB."|".$tglTanam."|".$kondisiTa."|".$teknologiTe."|".$jarakTa."|".$jmlBT."|".$drainase."|".$mekanisme."|".$ub);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$umurCB = trim(str_replace("'","''",$this->input->post("umurCB")));
			$tglTanam = trim(str_replace("'","''",$this->input->post("tglTanam")));
			$kondisiTa = trim(str_replace("'","''",$this->input->post("kondisiTa")));
			$teknologiTe = trim(str_replace("'","''",$this->input->post("teknologiTe")));
			$jarakTa = trim(str_replace("'","''",$this->input->post("jarakTa")));
			$jmlBT = trim(str_replace("'","''",$this->input->post("jmlBT")));
			$drainase = trim(str_replace("'","''",$this->input->post("drainase")));
			$mekanisme = trim(str_replace("'","''",$this->input->post("mekanisme")));
			$ub = trim(str_replace("'","''",$this->input->post("ub")));
			$operasi = $this->Mta345->tambah($lahan, $umurCB, $tglTanam, $kondisiTa, $teknologiTe, $jarakTa, $jmlBT, $drainase, $mekanisme, $ub);
			if($operasi == "1"){
				$ket = "ID Lahan: $lahan,\nUmur Cabut Bibit : $umurCB,\nTanggal Tanam: $tglTanam,\nKondisi Tanah: $kondisiTa,\nTeknologi Terapan: $teknologiTe,\nJarak Tanam: $jarakTa,\nJumlah Batang Tancap: $jmlBT,\nDrainase: $drainase,\nMekanisme: $mekanisme,\nUsia Bibit: $ub";
				$this->Mlog->log_history("Tanam","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$umurCB = trim(str_replace("'","''",$this->input->post("umurCB")));
			$tglTanam = trim(str_replace("'","''",$this->input->post("tglTanam")));
			$kondisiTa = trim(str_replace("'","''",$this->input->post("kondisiTa")));
			$teknologiTe = trim(str_replace("'","''",$this->input->post("teknologiTe")));
			$jarakTa = trim(str_replace("'","''",$this->input->post("jarakTa")));
			$jmlBT = trim(str_replace("'","''",$this->input->post("jmlBT")));
			$drainase = trim(str_replace("'","''",$this->input->post("drainase")));
			$mekanisme = trim(str_replace("'","''",$this->input->post("mekanisme")));
			$ub = trim(str_replace("'","''",$this->input->post("ub")));
			$operasi = $this->Mta345->update($id, $lahan, $umurCB, $tglTanam, $kondisiTa, $teknologiTe, $jarakTa, $jmlBT, $drainase, $mekanisme, $ub);
			if($operasi == "1"){
				$ket = "ID Tanam: $id,\nID Lahan: $lahan,\nUmur Cabut Bibit : $umurCB,\nTanggal Tanam: $tglTanam,\nKondisi Tanah: $kondisiTa,\nTeknologi Terapan: $teknologiTe,\nJarak Tanam: $jarakTa,\nJumlah Batang Tancap: $jmlBT,\nDrainase: $drainase,\nMekanisme: $mekanisme,\nUsia Bibit: $ub";
				$this->Mlog->log_history("Tanam","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mta345->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mta345->filter($id);
					$operasi = $this->Mta345->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $lahan = $k->id_lahan;
				            $umurCB = $k->umur_cabut_bibit;
				            $tglTanam = $k->tgl_tanam;
				            $kondisiTa = $k->kondisi_tanah;
				            $teknologiTe = $k->teknologi_terapan;
				            $jarakTa = $k->jarak_tanam;
				            $jmlBT = $k->jml_batang_tancap;
				            $drainase = $k->drainase;
				            $mekanisme = $k->mekanisme;
				            $ub = $k->usia_bibit;
						}
						$ket = "ID Tanam: $id,\nID Lahan: $lahan,\nUmur Cabut Bibit : $umurCB,\nTanggal Tanam: $tglTanam,\nKondisi Tanah: $kondisiTa,\nTeknologi Terapan: $teknologiTe,\nJarak Tanam: $jarakTa,\nJumlah Batang Tancap: $jmlBT,\nDrainase: $drainase,\nMekanisme: $mekanisme,\nUsia Bibit: $ub";
						$this->Mlog->log_history("Panen","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}