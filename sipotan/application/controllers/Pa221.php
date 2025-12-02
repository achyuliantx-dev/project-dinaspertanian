<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pa221 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pa221";
		$this->load->model("Mpa221");
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
		$data["fill"] = "pa221v";
		$data["dtlahan"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpa221->data();
        foreach ($dt as $k){
            $id = $k->id;
            $lahan = $k->id_lahan;
            $panen = $k->tgl_panen;
            $produksi = $k->produksi_real;
            $produktivitas = $k->produktivitas;
            $biaya = $k->biaya_usaha_tani;
            $keuntungan = $k->keuntungan;
            $masalah = $k->masalah;
            $saran = $k->saran;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$lahan.'","'.$panen.'","'.$produksi.'","'.$produktivitas.'","'.$biaya.'","'.$keuntungan.'","'.$masalah.'","'.$saran.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpa221->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $lahan = $k->id_lahan;
		            $panen = $k->tgl_panen;
		            $produksi = $k->produksi_real;
		            $produktivitas = $k->produktivitas;
		            $biaya = $k->biaya_usaha_tani;
		            $keuntungan = $k->keuntungan;
		            $masalah = $k->masalah;
		            $saran = $k->saran;
				}
				echo base64_encode("1|".$id."|".$lahan."|".$panen."|".$produksi."|".$produktivitas."|".$biaya."|".$keuntungan."|".$masalah."|".$saran);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function filteranalisis(){
		$idlah = $this->uri->segment(3);
		$hasil = $this->Mpa221->filteranalisis($idlah);
		echo json_encode($hasil);
	}

	public function tambah(){
		if($this->aksesc[0] == "1"){
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$panen = trim(str_replace("'","''",$this->input->post("panen")));
			$produksi = trim(str_replace("'","''",$this->input->post("produksi")));
			$produktivitas = trim(str_replace("'","''",$this->input->post("produktivitas")));
			$biaya = trim(str_replace("'","''",$this->input->post("biaya")));
			$keuntungan = trim(str_replace("'","''",$this->input->post("keuntungan")));
			$masalah = trim(str_replace("'","''",$this->input->post("masalah")));
			$saran = trim(str_replace("'","''",$this->input->post("saran")));
			$operasi = $this->Mpa221->tambah($lahan, $panen, $produksi, $produktivitas, $biaya, $keuntungan, $masalah, $saran);
			if($operasi == "1"){
				$ket = "ID Lahan: $lahan,\nTanggaL Panen: $panen,\nProduksi: $produksi,\nProduktivitas: $produktivitas,\nBiaya: $biaya,\nKeuntungan: $keuntungan,\nMasalah: $masalah,\nSaran: $saran";
				$this->Mlog->log_history("Panen","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$panen = trim(str_replace("'","''",$this->input->post("panen")));
			$produksi = trim(str_replace("'","''",$this->input->post("produksi")));
			$produktivitas = trim(str_replace("'","''",$this->input->post("produktivitas")));
			$biaya = trim(str_replace("'","''",$this->input->post("biaya")));
			$keuntungan = trim(str_replace("'","''",$this->input->post("keuntungan")));
			$masalah = trim(str_replace("'","''",$this->input->post("masalah")));
			$saran = trim(str_replace("'","''",$this->input->post("saran")));
			$operasi = $this->Mpa221->update($id, $lahan, $panen, $produksi, $produktivitas, $biaya, $keuntungan, $masalah, $saran);
			if($operasi == "1"){
				$ket = "ID Panen: $id,\nID Lahan: $lahan,\nTanggaL Panen: $panen,\nProduksi: $produksi,\nProduktivitas: $produktivitas,\nBiaya: $biaya,\nKeuntungan: $keuntungan,\nMasalah: $masalah,\nSaran: $saran";
				$this->Mlog->log_history("Panen","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpa221->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpa221->filter($id);
					$operasi = $this->Mpa221->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $lahan = $k->id_lahan;
				            $panen = $k->tgl_panen;
				            $produksi = $k->produksi_real;
				            $produktivitas = $k->produktivitas;
				            $biaya = $k->biaya_usaha_tani;
				            $keuntungan = $k->keuntungan;
				            $masalah = $k->masalah;
				            $saran = $k->saran;
						}
						$ket = "ID Panen: $id,\nID Lahan: $lahan,\nTanggaL Panen: $panen,\nProduksi: $produksi,\nProduktivitas: $produktivitas,\nBiaya: $biaya,\nKeuntungan: $keuntungan,\nMasalah: $masalah,\nSaran: $saran";
						$this->Mlog->log_history("Panen","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}