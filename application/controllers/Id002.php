<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Id002 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		$idformini = "id002";
		$this->load->model('Mid002');
		$this->load->model('Mkc001');
		$this->load->model('Mds001');
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


	public function index()
	{
		$data["fill"] = "id002v";
		$data["dtkec"] = $this->Mkc001->data();
		$data["dtdes"] = $this->Mds001->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mid002->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$nama = $k->nama;
			$desa = $k->desa;
			$kec = $k->kecamatan;
			$bud = $k->batas_utara_desa;
			$btd = $k->batas_timur_desa;
			$bsd = $k->batas_selatan_desa;
			$bbd = $k->batas_barat_desa;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $nama . '","' . $desa . '","' . $kec . '","' . $bud . '","' . $btd . '","' . $bsd . '","' . $bbd . '"],';
		}
		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mid002->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$nama = $k->nama;
					$bud = $k->batas_utara_desa;
					$btd = $k->batas_timur_desa;
					$bsd = $k->batas_selatan_desa;
					$bbd = $k->batas_barat_desa;
					$des= $k->id_desa;
					$cam = $k->id_kecamatan;
				}
				echo base64_encode("1|" . $id . "|" . $nama . "|" . $des . "|" . $cam . "|" . $bud . "|" . $btd . "|" . $bsd . "|" . $bbd);
			} else {
				echo base64_encode("0|");
			}
		} else {
			echo base64_encode("0|");
		}
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$nama = trim(str_replace("'", "''", $this->input->post("nama")));
			$desa = trim(str_replace("'", "''", $this->input->post("desa")));
			$kec = trim(str_replace("'", "''", $this->input->post("kec")));
			$bud = trim(str_replace("'", "''", $this->input->post("bud")));
			$btd = trim(str_replace("'", "''", $this->input->post("btd")));
			$bsd = trim(str_replace("'", "''", $this->input->post("bsd")));
			$bbd = trim(str_replace("'", "''", $this->input->post("bbd")));
			$operasi = $this->Mid002->tambah($nama, $desa, $kec, $bud, $btd, $bsd, $bbd);
			if ($operasi == "1") {
				$ket = "Nama IPW Desa: $nama,\nId Desa: $desa,\nId Kecamatan: $kec,\nBatas Utara Desa: $bud,\nBatas Timur Desa: $btd,\nBatas Selatan Desa: $bsd,\nBatas Barat Desa: $bbd";
				$this->Mlog->log_history("IPW Desa", "Tambah", $ket);
			}
			echo base64_encode($operasi);
		} else {
			echo base64_encode("99");
		}
	}

	public function update(){
		if ($this->aksesc[1] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$nama = trim(str_replace("'", "''", $this->input->post("nama")));
			$desa = trim(str_replace("'", "''", $this->input->post("desa")));
			$kec = trim(str_replace("'", "''", $this->input->post("kec")));
			$bud = trim(str_replace("'", "''", $this->input->post("bud")));
			$btd = trim(str_replace("'", "''", $this->input->post("btd")));
			$bsd = trim(str_replace("'", "''", $this->input->post("bsd")));
			$bbd = trim(str_replace("'", "''", $this->input->post("bbd")));
			$operasi = $this->Mid002->update($id, $nama, $desa, $kec, $bud, $btd, $bsd, $bbd);
			if ($operasi == "1") {
				$ket = "Id IPW Desa: $id,\nNama IPW Desa: $nama,\nId Desa: $desa,\nId Kecamatan: $kec,\nBatas Utara Desa: $bud,\nBatas Timur Desa: $btd,\nBatas Selatan Desa: $bsd,\nBatas Barat Desa: $bbd";
				$this->Mlog->log_history("IPW Desa", "update", $ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus()
	{
		if ($this->aksesc[2] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$td = $this->Mid002->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mid002->filter($id);
					$operasi = $this->Mid002->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$nama= $k->nama;
							$desa = $k->id_desa;
							$kec = $k->id_kecamatan;
							$bud = $k->batas_utara_desa;
							$btd = $k->batas_timur_desa;
							$bsd = $k->batas_selatan_desa;
							$bbd = $k->batas_barat_desa;
						}
						$ket = "Id IPW Desa: $id,\nNama IPW Desa: $nama,\nId Desa: $desa,\nId Kecamatan: $kec,\nBatas Utara Desa: $bud,\nBatas Timur Desa: $btd,\nBatas Selatan Desa: $bsd,\nBatas Barat Desa: $bbd";
						$this->Mlog->log_history("IPW Desa", "Hapus", $ket);
					}
					echo base64_encode($operasi);
				}
			} else {
				echo base64_encode("80");
			}
		} else {
			echo base64_encode("99");
		}
	}
}
