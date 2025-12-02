<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Se552 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "se552";
		$this->load->model("Mse552");
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
		$data["fill"] = "se552v";
		$data["dtlahan"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mse552->data();
        foreach ($dt as $k){
            $id = $k->id;
            $lahan = $k->id_lahan;
            $tglSemaiK = $k->tgl_semai_kering;
            $tglSemaiB = $k->tgl_semai_basah;
            $jml = $k->jml_benih;
            $tglPu = $k->tgl_pupuk_semaian;
            $jenisPu = $k->jenis_pupuk_semai;
            $dosisPu = $k->dosis_pupuk_semai_organik;
            $dosisPua = $k->dosis_pupuk_semai_anorganik;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$lahan.'","'.$tglSemaiK.'","'.$tglSemaiB.'","'.$jml.'","'.$tglPu.'","'.$jenisPu.'","'.$dosisPu.'","'.$dosisPua.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mse552->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$lahan = $k->id_lahan;
		            $tglSemaiK = $k->tgl_semai_kering;
		            $tglSemaiB = $k->tgl_semai_basah;
		            $jml = $k->jml_benih;
		            $tglPu = $k->tgl_pupuk_semaian;
		            $jenisPu = $k->jenis_pupuk_semai;
		            $dosisPu = $k->dosis_pupuk_semai_organik;
		            $dosisPua = $k->dosis_pupuk_semai_anorganik;
				}
				echo base64_encode("1|".$id."|".$lahan."|".$tglSemaiK."|".$tglSemaiB."|".$jml."|".$tglPu."|".$jenisPu."|".$dosisPu."|".$dosisPua);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$tglSemaiK = trim(str_replace("'","''",$this->input->post("tglSemaiK")));
			$tglSemaiB = trim(str_replace("'","''",$this->input->post("tglSemaiB")));
			$jml = trim(str_replace("'","''",$this->input->post("jml")));
			$tglPu = trim(str_replace("'","''",$this->input->post("tglPu")));
			$jenisPu = trim(str_replace("'","''",$this->input->post("jenisPu")));
			$dosisPu = trim(str_replace("'","''",$this->input->post("dosisPu")));
			$dosisPua = trim(str_replace("'","''",$this->input->post("dosisPua")));
			$operasi = $this->Mse552->tambah($lahan, $tglSemaiK, $tglSemaiB, $jml, $tglPu, $jenisPu, $dosisPu, $dosisPua);
			if($operasi == "1"){
				$ket = "ID Lahan: $lahan,\nTanggaL Semai Kering: $tglSemaiK,\TanggaL Semai Kering: $tglSemaiB,\Jumlah Benih: $jml,\nTanggal Pupuk Semaian: $tglPu,\nJenis Pupuk Semai: $jenisPu,\nDosis Pupuk Organik: $dosisPu, \nDosis Pupuk Anorganik: $dosisPua";
				$this->Mlog->log_history("Semaian","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$tglSemaiK = trim(str_replace("'","''",$this->input->post("tglSemaiK")));
			$tglSemaiB = trim(str_replace("'","''",$this->input->post("tglSemaiB")));
			$jml = trim(str_replace("'","''",$this->input->post("jml")));
			$tglPu = trim(str_replace("'","''",$this->input->post("tglPu")));
			$jenisPu = trim(str_replace("'","''",$this->input->post("jenisPu")));
			$dosisPu = trim(str_replace("'","''",$this->input->post("dosisPu")));
			$dosisPua = trim(str_replace("'","''",$this->input->post("dosisPua")));
			$operasi = $this->Mse552->update($id, $lahan, $tglSemaiK, $tglSemaiB, $jml, $tglPu, $jenisPu, $dosisPu, $dosisPua);
			if($operasi == "1"){
				$ket = "ID Lahan: $lahan,\nTanggaL Semai Kering: $tglSemaiK,\TanggaL Semai Kering: $tglSemaiB,\Jumlah Benih: $jml,\nTanggal Pupuk Semaian: $tglPu,\nJenis Pupuk Semai: $jenisPu,\nDosis Pupuk Organik: $dosisPu, \nDosis Pupuk Anorganik: $dosisPua";
				$this->Mlog->log_history("Semaian","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mse552->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mse552->filter($id);
					$operasi = $this->Mse552->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
							$lahan = $k->id_lahan;
				            $tglSemaiK = $k->tgl_semai_kering;
				            $tglSemaiB = $k->tgl_semai_basah;
				            $jml = $k->jml_benih;
				            $tglPu = $k->tgl_pupuk_semaian;
				            $jenisPu = $k->jenis_pupuk_semai;
				            $dosisPu = $k->dosis_pupuk_semai_organik;
				            $dosisPua = $k->dosis_pupuk_semai_anorganik;
						}
						$ket = "ID Lahan: $lahan,\nTanggaL Semai Kering: $tglSemaiK,\TanggaL Semai Kering: $tglSemaiB,\Jumlah Benih: $jml,\nTanggal Pupuk Semaian: $tglPu,\nJenis Pupuk Semai: $jenisPu,\nDosis Pupuk Organik: $dosisPu, \nDosis Pupuk Anorganik: $dosisPua";
						$this->Mlog->log_history("Semaian","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}