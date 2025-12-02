<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dk999 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "dk999";
		$this->load->model("Mdk999");
		$this->load->model("Mld111");
		$this->load->model("Mjd777");
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
		$data["fill"] = "dk999v";
		$data["dtnop"] = $this->Mld111->data();
		$data["dtjd"] = $this->Mjd777->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mdk999->data();
        foreach ($dt as $k){
            $id = $k->id;
            $id_lahan = $k->id_lahan;
            $tdek = $k->tgl_dekomposisi;
            $jubd = $k->jml_bo_dekomposisi;
            $tbj = $k->tgl_benam_jerami;
            $cps = $k->cara_panen_sebelumnya;
            $tad = $k->tgl_aplikasi_dekomposer;
            $jdek = $k->jenis_dekomposer;
            $ddek = $k->dosis_dekomposer;
            $jap = $k->jam_aplikasi;
            $nama = $k->nama;
            
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$id_lahan.'","'.$tdek.'","'.$jubd.'","'.$tbj.'","'.$cps.'","'.$tad.'","'.$nama.'","'.$ddek.'","'.$jap.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mdk999->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $id_lahan = $k->id_lahan;
		            $tdek = $k->tgl_dekomposisi;
		            $jubd = $k->jml_bo_dekomposisi;
		            $tbj = $k->tgl_benam_jerami;
		            $cps = $k->cara_panen_sebelumnya;
		            $tad = $k->tgl_aplikasi_dekomposer;
		            $jdek = $k->jenis_dekomposer;
		            $ddek = $k->dosis_dekomposer;
		            $jap = $k->jam_aplikasi;
				}
				echo base64_encode("1|".$id."|".$id_lahan."|".$tdek."|".$jubd."|".$tbj."|".$cps."|".$tad."|".$jdek."|".$ddek."|".$jap);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$tdek = trim(str_replace("'","''",$this->input->post("tdek")));
			$jubd = trim(str_replace("'","''",$this->input->post("jubd")));
			$tbj = trim(str_replace("'","''",$this->input->post("tbj")));
			$cps = trim(str_replace("'","''",$this->input->post("cps")));
			$tad = trim(str_replace("'","''",$this->input->post("tad")));
			$jdek = trim(str_replace("'","''",$this->input->post("jdek")));
			$ddek = trim(str_replace("'","''",$this->input->post("ddek")));
			$jap = trim(str_replace("'","''",$this->input->post("jap")));
			
			$operasi = $this->Mdk999->tambah($id_lahan, $tdek, $jubd, $tbj, $cps, $tad, $jdek, $ddek, $jap);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nTanggal Dekomposisi: $tdek,\nJumlah Bo Dekomposisi: $jubd,\nTanggal Benam Jerami: $tbj,\nCara Panen Sebelumya: $cps,\nTaggal Aplikasi Dekomposer: $tad,\nJenis Dekomposer: $jdek,\nDosis Dekomposer: $ddek,\nJam Aplikasi Dekomposer: $jap";
				$this->Mlog->log_history("Tabel Dekomposer","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$id_lahan = trim(str_replace("'","''",$this->input->post("id_lahan")));
			$tdek = trim(str_replace("'","''",$this->input->post("tdek")));
			$jubd = trim(str_replace("'","''",$this->input->post("jubd")));
			$tbj = trim(str_replace("'","''",$this->input->post("tbj")));
			$cps = trim(str_replace("'","''",$this->input->post("cps")));
			$tad = trim(str_replace("'","''",$this->input->post("tad")));
			$jdek = trim(str_replace("'","''",$this->input->post("jdek")));
			$ddek = trim(str_replace("'","''",$this->input->post("ddek")));
			$jap = trim(str_replace("'","''",$this->input->post("jap")));
			
			$operasi = $this->Mdk999->update($id, $id_lahan, $tdek, $jubd, $tbj, $cps, $tad, $jdek, $ddek, $jap);
			if($operasi == "1"){
				$ket = "Kode Lahan: $id_lahan,\nTanggal Dekomposisi: $tdek,\nJumlah Bo Dekomposisi: $jubd,\nTanggal Benam Jerami: $tbj,\nCara Panen Sebelumya: $cps,\nTaggal Aplikasi Dekomposer: $tad,\nJenis Dekomposer: $jdek,\nDosis Dekomposer: $ddek,\nJam Aplikasi Dekomposer: $jap";
				$this->Mlog->log_history("Tabel Dekomposer","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mdk999->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mdk999->filter($id);
					$operasi = $this->Mdk999->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $id_lahan = $k->id_lahan;
				            $tdek = $k->tgl_dekomposisi;
				            $jubd = $k->jml_bo_dekomposisi;
				            $tbj = $k->tgl_benam_jerami;
				            $cps = $k->cara_panen_sebelumnya;
				            $tad = $k->tgl_aplikasi_dekomposer;
				            $jdek = $k->jenis_dekomposer;
				            $ddek = $k->dosis_dekomposer;
				            $jap = $k->jam_aplikasi;
						}
						$ket = "Kode Lahan: $id_lahan,\nTanggal Dekomposisi: $tdek,\nJumlah Bo Dekomposisi: $jubd,\nTanggal Benam Jerami: $tbj,\nCara Panen Sebelumya: $cps,\nTaggal Aplikasi Dekomposer: $tad,\nJenis Dekomposer: $jdek,\nDosis Dekomposer: $ddek,\nJam Aplikasi Dekomposer: $jap";
						$this->Mlog->log_history("Tabel Dekomposer","Delete",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}