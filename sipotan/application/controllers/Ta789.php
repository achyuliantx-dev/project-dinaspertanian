<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ta789 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ta789";
		$this->load->model('Mta789');
		$this->load->model('Mld111');
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
		$data["fill"] = "ta789v";
		$data["dtlah"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mta789->data();
        foreach ($dt as $k){
            $id = $k->id;
            $id_lahan = $k->id_lahan;
			$bol = $k->biaya_olah_lahan;
			$bpem = $k->biaya_pembibitan;
			$btan= $k->biaya_tanam;
			$bpuk = $k->biaya_pupuk;
			$bpes = $k->biaya_pestisida;
			$bpeng = $k->biaya_pengairan;
			$btk = $k->biaya_tenaga_kerja;
			$bsl = $k->biaya_sewa_lahan;
			$blan= $k->biaya_lain2;
			$tbiaya = $k->total_biaya;
			$hpk = $k->harga_pasar_kg;
			$tpan = $k->total_panen;
			$keu =$k->keuntungan;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$id_lahan.'","'.$bol.'","'.$bpem.'","'.$btan.'","'.$bpuk.'","'.$bpes.'","'.$bpeng.'","'.$btk.'","'.$bsl.'","'.$blan.'","'.$tbiaya.'","'.$hpk.'","'.$tpan.'","'.$keu.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mta789->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $id_lahan = $k->id_lahan;
					$bol = $k->biaya_olah_lahan;
					$bpem = $k->biaya_pembibitan;
					$btan= $k->biaya_tanam;
					$bpuk = $k->biaya_pupuk;
					$bpes = $k->biaya_pestisida;
					$bpeng = $k->biaya_pengairan;
					$btk = $k->biaya_tenaga_kerja;
					$bsl = $k->biaya_sewa_lahan;
					$blan= $k->biaya_lain2;
					$tbiaya= $k->total_biaya;
					$hpk = $k->harga_pasar_kg;
					$tpan = $k->total_panen;
					$keu =$k->keuntungan;
				}
				echo base64_encode("1|".$id."|".$id_lahan."|".$bol."|".$bpem."|".$btan."|".$bpuk."|".$bpes."|".$bpeng."|".$btk."|".$bsl."|".$blan."|".$tbiaya."|".$hpk."|".$tpan."|".$keu);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	

public function tambah(){
		if($this->aksesc[0] == "1"){
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$bol = trim(str_replace("'","''",$this->input->post("bol")));
			$bpem = trim(str_replace("'","''",$this->input->post("bpem")));
			$btan = trim(str_replace("'","''",$this->input->post("btan")));
			$bpuk = trim(str_replace("'","''",$this->input->post("bpuk")));
			$bpes = trim(str_replace("'","''",$this->input->post("bpes")));
			$bpeng = trim(str_replace("'","''",$this->input->post("bpeng")));
			$btk = trim(str_replace("'","''",$this->input->post("btk")));
			$bsl = trim(str_replace("'","''",$this->input->post("bsl")));
			$blan = trim(str_replace("'","''",$this->input->post("blan")));
			$hpk = trim(str_replace("'","''",$this->input->post("hpk")));
			$tpan = trim(str_replace("'","''",$this->input->post("tpan")));
			$tbiaya=$bol+$bpem+$btan+$bpuk+$bpes+$bpeng+$btk+$bsl+$blan;
			$keu=$hpk*$tpan-$tbiaya;
			$operasi = $this->Mta789->tambah($id_lahan, $bol, $bpem, $btan, $bpuk, $bpes, $bpeng, $btk, $bsl, $blan,$tbiaya, $hpk, $tpan,$keu);
			if($operasi == "1"){
				$ket = "Id Lahan: $id_lahan,\nBiaya Olah Lahan: $bol,\nBiaya Pembibitan: $bpem,\nBiaya Tanam: $btan,\nBiaya Pupuk: $bpuk,\nBiaya Pestisida: $bpes,\nBiaya Pengairan: $bpeng,\nBiaya Tenaga Kerja: $btk,\nBiaya Sewa Lahan: $bsl,\nBiaya Lain-Lain: $blan,\nHarga Per Kg: $hpk,\nTotal Panen: $tpan";
				$this->Mlog->log_history("Tabel Analisa Usaha Tani","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$bol = trim(str_replace("'","''",$this->input->post("bol")));
			$bpem = trim(str_replace("'","''",$this->input->post("bpem")));
			$btan = trim(str_replace("'","''",$this->input->post("btan")));
			$bpuk = trim(str_replace("'","''",$this->input->post("bpuk")));
			$bpes = trim(str_replace("'","''",$this->input->post("bpes")));
			$bpeng = trim(str_replace("'","''",$this->input->post("bpeng")));
			$btk = trim(str_replace("'","''",$this->input->post("btk")));
			$bsl = trim(str_replace("'","''",$this->input->post("bsl")));
			$blan = trim(str_replace("'","''",$this->input->post("blan")));
			$hpk = trim(str_replace("'","''",$this->input->post("hpk")));
			$tpan = trim(str_replace("'","''",$this->input->post("tpan")));
			$tbiaya= $bol+$bpem+$btan+$bpuk+$bpes+$bpeng+$btk+$bsl+$blan;
			$keu= $hpk*$tpan-$tbiaya;
			$operasi = $this->Mta789->update($id, $id_lahan, $bol, $bpem, $btan, $bpuk, $bpes, $bpeng, $btk, $bsl, $blan, $tbiaya, $hpk, $tpan, $keu);
			if($operasi == "1"){
				$ket = "Id: $id,\nId Lahan: $id_lahan,\nBiaya Olah Lahan: $bol,\nBiaya Pembibitan: $bpem,\nBiaya Tanam: $btan,\nBiaya Pupuk: $bpuk,\nBiaya Pestisida: $bpes,\nBiaya Pengairan: $bpeng,\nBiaya Tenaga Kerja: $btk,\nBiaya Sewa Lahan: $bsl,\nBiaya Lain-Lain: $blan,\nHarga Per Kg: $hpk,\nTotal Panen: $tpan";
				$this->Mlog->log_history("Tabel Analisa Usaha Tani","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mta789->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mta789->filter($id);
					$operasi = $this->Mta789->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $id_lahan = $k->id_lahan;
							$bol = $k->biaya_olah_lahan;
							$bpem = $k->biaya_pembibitan;
							$btan= $k->biaya_tanam;
							$bpuk = $k->biaya_pupuk;
							$bpes = $k->biaya_pestisida;
							$bpeng = $k->biaya_pengairan;
							$btk = $k->biaya_tenaga_kerja;
							$bsl = $k->biaya_sewa_lahan;
							$blan= $k->biaya_lain2;
							$hpk = $k->harga_pasar_kg;
							$tpan = $k->total_panen;
						}
						
						$ket = "Id: $id,\nId Lahan: $id_lahan,\nBiaya Olah Lahan: $bol,\nBiaya Pembibitan: $bpem,\nBiaya Tanam: $btan,\nBiaya Pupuk: $bpuk,\nBiaya Pestisida: $bpes,\nBiaya Pengairan: $bpeng,\nBiaya Tenaga Kerja: $btk,\nBiaya Sewa Lahan: $bsl,\nBiaya Lain-Lain: $blan,\nHarga Per Kg: $hpk,\nTotal Panen: $tpan";
						$this->Mlog->log_history("Tabel Analisa Usaha Tani","Delete",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}