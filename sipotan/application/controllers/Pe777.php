<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pe777 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pe777";
		$this->load->model("Mpe777");
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
		$data["fill"] = "pe777v";
		$data["dtlahan"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpe777->data();
        foreach ($dt as $k){
            $id = $k->id;
            $lahan = $k->id_lahan;
            $tglPuOr = $k->tgl_pupuk_dasar_organik;
            $jmlPuOr = $k->jml_pupuk_organik;
            $tglPuAn = $k->tgl_pupuk_anorganik;
            $jmlPuAn = $k->jml_pupuk_anorganik;
            $tglPuSu1 = $k->tgl_pupuk_susulan1;
            $caraPu1 = $k->cara_pupuk_s1;
            $jenisPu1 = $k->jenis_pupuk_s1;
            $dosisPuO1 = $k->dosis_pupuk_organik_s1;
            $dosisPuA1 = $k->dosis_pupuk_anorganik_s1;
            $tglPuSu2 = $k->tgl_pupuk_susulan2;
            $caraPu2 = $k->cara_pupuk_s2;
            $jenisPu2 = $k->jenis_pupuk_s2;
            $dosisPuO2 = $k->dosis_pupuk_organik_s2;
            $dosisPuA2 = $k->dosis_pupuk_anorganik_s2;

			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$lahan.'","'.$tglPuOr.'","'.$jmlPuOr.'","'.$tglPuAn.'","'.$jmlPuAn.'","'.$tglPuSu1.'","'.$caraPu1.'","'.$jenisPu1.'","'.$dosisPuO1.'","'.$dosisPuA1.'","'.$tglPuSu2.'","'.$caraPu2.'","'.$jenisPu2.'","'.$dosisPuO2.'", "'.$dosisPuA2.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpe777->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $lahan = $k->id_lahan;
		            $tglPuOr = $k->tgl_pupuk_dasar_organik;
		            $jmlPuOr = $k->jml_pupuk_organik;
		            $tglPuAn = $k->tgl_pupuk_anorganik;
		            $jmlPuAn = $k->jml_pupuk_anorganik;
		            $tglPuSu1 = $k->tgl_pupuk_susulan1;
		            $caraPu1 = $k->cara_pupuk_s1;
		            $jenisPu1 = $k->jenis_pupuk_s1;
		            $dosisPuO1 = $k->dosis_pupuk_organik_s1;
		            $dosisPuA1 = $k->dosis_pupuk_anorganik_s1;
		            $tglPuSu2 = $k->tgl_pupuk_susulan2;
		            $caraPu2 = $k->cara_pupuk_s2;
		            $jenisPu2 = $k->jenis_pupuk_s2;
		            $dosisPuO2 = $k->dosis_pupuk_organik_s2;
		            $dosisPuA2 = $k->dosis_pupuk_anorganik_s2;
				}
				echo base64_encode("1|".$id."|".$lahan."|".$tglPuOr."|".$jmlPuOr."|".$tglPuAn."|".$jmlPuAn."|".$tglPuSu1."|".$caraPu1."|".$jenisPu1."|".$dosisPuO1."|".$dosisPuA1."|".$tglPuSu2."|".$caraPu2."|".$jenisPu2."|".$dosisPuO2."|".$dosisPuA2);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$tglPuOr = trim(str_replace("'","''",$this->input->post("tglPuOr")));
			$jmlPuOr = trim(str_replace("'","''",$this->input->post("jmlPuOr")));
			$tglPuAn = trim(str_replace("'","''",$this->input->post("tglPuAn")));
			$jmlPuAn = trim(str_replace("'","''",$this->input->post("jmlPuAn")));
			$tglPuSu1 = trim(str_replace("'","''",$this->input->post("tglPuSu1")));
			$caraPu1 = trim(str_replace("'","''",$this->input->post("caraPu1")));
			$jenisPu1 = trim(str_replace("'","''",$this->input->post("jenisPu1")));
			$dosisPuO1 = trim(str_replace("'","''",$this->input->post("dosisPuO1")));
			$dosisPuA1 = trim(str_replace("'","''",$this->input->post("dosisPuA1")));
			$tglPuSu2 = trim(str_replace("'","''",$this->input->post("tglPuSu2")));
			$caraPu2 = trim(str_replace("'","''",$this->input->post("caraPu2")));
			$jenisPu2 = trim(str_replace("'","''",$this->input->post("jenisPu2")));
			$dosisPuO2 = trim(str_replace("'","''",$this->input->post("dosisPuO2")));
			$dosisPuA2 = trim(str_replace("'","''",$this->input->post("dosisPuA2")));
			$operasi = $this->Mpe777->tambah($lahan, $tglPuOr, $jmlPuOr, $tglPuAn, $jmlPuAn, $tglPuSu1, $caraPu1, $jenisPu1, $dosisPuO1,$dosisPuA1, $tglPuSu2, $caraPu2, $jenisPu2, $dosisPuO2, $dosisPuA2);
			if($operasi == "1"){
				$ket = "ID Lahan: $lahan,\nTanggaL Pupuk Organik: $tglPuOr,\nProduksi: $jmlPuOr,\nProduktivitas: $tglPuAn,\nBiaya: $jmlPuAn,\nKeuntungan: $tglPuSu1,\n Cara Pupuk S1: $caraPu1,\nJenis Pupuk S1: $jenisPu1,\nDosis Pupuk Organik SI: $dosisPuO1,\nDosis Pupuk Anrganik SI: $dosisPuA1,\nTanggal Pupuk Susulan 2: $tglPuSu2,\nCara Pupuk S2: $caraPu2,\nJenis Pupuk S2: $jenisPu2,\nDosis Pupuk Organik S2: $dosisPuO2,\nDosis Pupuk Anorganik S2: $dosisPuA2";
				$this->Mlog->log_history("Pemupukan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$tglPuOr = trim(str_replace("'","''",$this->input->post("tglPuOr")));
			$jmlPuOr = trim(str_replace("'","''",$this->input->post("jmlPuOr")));
			$tglPuAn = trim(str_replace("'","''",$this->input->post("tglPuAn")));
			$jmlPuAn = trim(str_replace("'","''",$this->input->post("jmlPuAn")));
			$tglPuSu1 = trim(str_replace("'","''",$this->input->post("tglPuSu1")));
			$caraPu1 = trim(str_replace("'","''",$this->input->post("caraPu1")));
			$jenisPu1 = trim(str_replace("'","''",$this->input->post("jenisPu1")));
			$dosisPuO1 = trim(str_replace("'","''",$this->input->post("dosisPuO1")));
			$dosisPuA1 = trim(str_replace("'","''",$this->input->post("dosisPuA1")));
			$tglPuSu2 = trim(str_replace("'","''",$this->input->post("tglPuSu2")));
			$caraPu2 = trim(str_replace("'","''",$this->input->post("caraPu2")));
			$jenisPu2 = trim(str_replace("'","''",$this->input->post("jenisPu2")));
			$dosisPuO2 = trim(str_replace("'","''",$this->input->post("dosisPuO2")));
			$dosisPuA2 = trim(str_replace("'","''",$this->input->post("dosisPuA2")));
			$operasi = $this->Mpe777->update($id, $lahan, $tglPuOr, $jmlPuOr, $tglPuAn, $jmlPuAn, $tglPuSu1, $caraPu1, $jenisPu1, $dosisPuO1,$dosisPuA1, $tglPuSu2, $caraPu2, $jenisPu2, $dosisPuO2, $dosisPuA2);
			if($operasi == "1"){
				$ket = "ID Pemupukan: $id,\nID Lahan: $lahan,\nTanggaL Pupuk Organik: $tglPuOr,\nProduksi: $jmlPuOr,\nProduktivitas: $tglPuAn,\nBiaya: $jmlPuAn,\nKeuntungan: $tglPuSu1,\n Cara Pupuk S1: $caraPu1,\nJenis Pupuk S1: $jenisPu1,\nDosis Pupuk Organik SI: $dosisPuO1,\nDosis Pupuk Anrganik SI: $dosisPuA1,\nTanggal Pupuk Susulan 2: $tglPuSu2,\nCara Pupuk S2: $caraPu2,\nJenis Pupuk S2: $jenisPu2,\nDosis Pupuk Organik S2: $dosisPuO2,\nDosis Pupuk Anorganik S2: $dosisPuA2";
				$this->Mlog->log_history("Pemupukan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpe777->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpe777->filter($id);
					$operasi = $this->Mpe777->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $lahan = $k->id_lahan;
				            $tglPuOr = $k->tgl_pupuk_dasar_organik;
				            $jmlPuOr = $k->jml_pupuk_organik;
				            $tglPuAn = $k->tgl_pupuk_anorganik;
				            $jmlPuAn = $k->jml_pupuk_anorganik;
				            $tglPuSu1 = $k->tgl_pupuk_susulan1;
				            $caraPu1 = $k->cara_pupuk_s1;
				            $jenisPu1 = $k->jenis_pupuk_s1;
				            $dosisPuO1 = $k->dosis_pupuk_organik_s1;
				            $dosisPuA1 = $k->dosis_pupuk_anorganik_s1;
				            $tglPuSu2 = $k->tgl_pupuk_susulan2;
				            $caraPu2 = $k->cara_pupuk_s2;
				            $jenisPu2 = $k->jenis_pupuk_s2;
				            $dosisPuO2 = $k->dosis_pupuk_organik_s2;
				            $dosisPuA2 = $k->dosis_pupuk_anorganik_s2;
						}
						$ket = "ID Pemupukan: $id,\nID Lahan: $lahan,\nTanggaL Pupuk Organik: $tglPuOr,\nProduksi: $jmlPuOr,\nProduktivitas: $tglPuAn,\nBiaya: $jmlPuAn,\nKeuntungan: $tglPuSu1,\n Cara Pupuk S1: $caraPu1,\nJenis Pupuk S1: $jenisPu1,\nDosis Pupuk Organik SI: $dosisPuO1,\nDosis Pupuk Anrganik SI: $dosisPuA1,\nTanggal Pupuk Susulan 2: $tglPuSu2,\nCara Pupuk S2: $caraPu2,\nJenis Pupuk S2: $jenisPu2,\nDosis Pupuk Organik S2: $dosisPuO2,\nDosis Pupuk Anorganik S2: $dosisPuA2";
						$this->Mlog->log_history("Pemupukan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}