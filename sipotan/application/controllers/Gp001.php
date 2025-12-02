<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gp001 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "gp001";
		$this->load->model('Mds001');
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
		$data["fill"] = "gp001v";
		$data["dtdes"] = $this->Mds001->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mgp001->data();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
            $tgl = $k->tgl_berdiri;
            $no = $k->no_legalitas;
            if($k->status == "1"){$stat = "Aktif";}else{$stat = "Tak Aktif";}
            $alamat = $k->alamat;
            $des = $k->id_desa;
            $telp = $k->telp;
            $email = $k->email;
            $desa = $k->desa;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$tgl.'","'.$no.'","'.$stat.'","'.$alamat.'","'.$desa.'","'.$telp.'","'.$email.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mgp001->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $nama = $k->nama;
		            $tgl = $k->tgl_berdiri;
		            $no = $k->no_legalitas;
		            $stat = $k->status;
		            $alamat = $k->alamat;
		            $des = $k->id_desa;
		            $telp = $k->telp;
		            $email = $k->email;
				}
				echo base64_encode("1|".$id."|".$nama."|".$tgl."|".$no."|".$stat."|".$alamat."|".$des."|".$telp."|".$email);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$no = trim(str_replace("'","''",$this->input->post("no")));
			$stat = trim(str_replace("'","''",$this->input->post("stat")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$des = trim(str_replace("'","''",$this->input->post("des")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$email = trim(str_replace("'","''",$this->input->post("email")));
			$operasi = $this->Mgp001->tambah($nama,$tgl,$no,$stat, $alamat,$des,$telp,$email);
			if($operasi == "1"){
				$ket = "Nama Gapoktan: $nama,\nTanggal: $tgl,\nNomor Legalitas: $no,\nStatus: $stat,\nAlamat: $alamat,\nNama Desa: $des,\nTelp: $telp,\nEmail: $email";
				$this->Mlog->log_history("Gapoktan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$no = trim(str_replace("'","''",$this->input->post("no")));
			$stat = trim(str_replace("'","''",$this->input->post("stat")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$des = trim(str_replace("'","''",$this->input->post("des")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$email = trim(str_replace("'","''",$this->input->post("email")));
			$operasi = $this->Mgp001->update($id, $nama,$tgl,$no,$stat, $alamat,$des,$telp,$email);
			if($operasi == "1"){
				$ket = "ID Gapoktan: $id,\nNama Gapoktan: $nama,\nTanggal: $tgl,\nNomor Legalitas: $no,\nStatus: $stat,\nAlamat: $alamat,\nNama Desa: $des,\nTelp: $telp,\nEmail: $email";
				$this->Mlog->log_history("Asosiasi Gapoktan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mgp001->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mgp001->filter($id);
					$operasi = $this->Mgp001->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $nama = $k->nama;
				            $tgl = $k->tgl_berdiri;
				            $no = $k->no_legalitas;
				            $stat = $k->status;
				            $alamat = $k->alamat;
				            $des = $k->id_desa;
				            $telp = $k->telp;
				            $email = $k->email;
						}
						$ket = "ID Gapoktan: $id,\nNama Gapoktan: $nama,\nTanggal: $tgl,\nNomor Legalitas: $no,\nStatus: $stat,\nAlamat: $alamat,\nNama Desa: $des,\nTelp: $telp,\nEmail: $email";
				$this->Mlog->log_history("Gapoktan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}