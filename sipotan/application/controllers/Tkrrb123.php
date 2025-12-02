<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tkrrb123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "tkrrb123";
		$this->load->model('Mtkrrb123');
		// $this->load->model('Mtkrkid123');
		// $this->load->model('Mkc001');
		// $this->load->model('Mds001');
		$data["datalogin"] = $this->Mlogin->cek_login();
		$dataform = $this->Mlogin->cek_sistem($idformini);
		if (is_array($data["datalogin"])) {
			foreach ($dataform as $cx) {
				$idsistem_sistem = $cx->id_sistem;
			}
			$idsistem_user = array();
			foreach ($data["datalogin"] as $dl) {
				$idlevel = $dl->id_level;
				array_push($idsistem_user, $dl->id_sistem);
			}
			if (array_search($idsistem_sistem, $idsistem_user) !== false) {
			} else {
				redirect(base_url());
			}
			$data["datamenu"] = $this->Mlogin->cek_menu($idsistem_sistem, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($idsistem_sistem, $idlevel);
			$data["ids"] = $idsistem_sistem;
			$data["idf"] = $idformini;
			$this->idsc = $idsistem_sistem;
			$idform = array();
			$akses = array();
			foreach ($data["dataform"] as $dx) {
				array_push($idform, $dx->id_form);
				if ($dx->id_form == $idformini) {
					array_push($akses, $dx->akses_tambah, $dx->akses_update, $dx->akses_hapus, $dx->akses_cetak);
				}
			}
			if (array_search($idformini, $idform) !== false) {
				$data["akses"] = $akses;
				$this->aksesc = $akses;
			} else {
				redirect(base_url());
			}
			$this->load->view($idsistem_sistem . '/basis', $data, true);
		} else {
			redirect(base_url());
		}
	}

	public function index()
	{
		$data["fill"] = "tkrrb123v";
		// $data["dtipwdes"] = $this->Mtkrkid123->data();
		// $data["dtkec"] = $this->Mkc001->data();
		// $data["dtdes"] = $this->Mds001->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtkrrb123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$target = $k->target;
			$nip = $k->nip;
			$realisasi = $k->realisasi;
			$bulan_ke = $k->bulan_ke;
			$tahun = $k->tahun;
			$kode_jenjang = $k->kode_jenjang;
			$triwulan = $k->triwulan;
			$no_urut_rencana = $k->no_urut_rencana;
			$pangkat_gol_asli = $k->pangkat_gol_asli;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $target . '","' . $nip . '","' . $realisasi . '","' . $bulan_ke . '","' . $tahun . '","' . $kode_jenjang . '","' . $triwulan . '","' . $no_urut_rencana . '","' . $pangkat_gol_asli . '"],';
		}

		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtkrrb123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$target = $k->target;
					$nip = $k->nip;
					$realisasi = $k->realisasi;
					$bulan_ke = $k->bulan_ke;
					$tahun = $k->tahun;
					$kode_jenjang = $k->kode_jenjang;
					$triwulan = $k->triwulan;
					$no_urut_rencana = $k->no_urut_rencana;
					$pangkat_gol_asli = $k->pangkat_gol_asli;
				}
				echo base64_encode("1|" . $id .  "|" . $target . "|" . $nip . "|" . $realisasi . "|" . $bulan_ke . "|" . $tahun . "|"  . $kode_jenjang . "|" . $triwulan . "|" . $no_urut_rencana . "|" . $pangkat_gol_asli);
			} else {
				echo base64_encode("0|");
			}
		} else {
			echo base64_encode("0|");
		}
	}

	public function filterdesa()
	{
		$idkec = $this->uri->segment(3);
		$hasil = $this->Mtkrrb123->filterdesa($idkec);
		echo json_encode($hasil);
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$target = trim(str_replace("'", "''", $this->input->post("target")));
			$nip = trim(str_replace("'", "''", $this->input->post("nip")));
			$realisasi = trim(str_replace("'", "''", $this->input->post("realisasi")));
			$bulan_ke = trim(str_replace("'", "''", $this->input->post("bulan_ke")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$kode_jenjang = trim(str_replace("'", "''", $this->input->post("kode_jenjang")));
			$triwulan = trim(str_replace("'", "''", $this->input->post("triwulan")));
			$no_urut_rencana = trim(str_replace("'", "''", $this->input->post("no_urut_rencana")));
			$pangkat_gol_asli = trim(str_replace("'", "''", $this->input->post("pangkat_gol_asli")));
			$operasi = $this->Mtkrrb123->tambah($target, $nip, $realisasi, $bulan_ke, $tahun, $kode_jenjang, $triwulan, $no_urut_rencana, $pangkat_gol_asli);
			if ($operasi == "1") {
				$ket = "target: $target,\nNIP : $nip,\nrealisasi: $realisasi,\nNo Urut Rencana: $bulan_ke,\nTarget Kinerja: $tahun,\nIndikator Kinerja: $kode_jenjang,\nOutput Jumlah: $triwulan,\nOutput Satuan: $no_urut_rencana,\npangkat_gol_asli: $pangkat_gol_asli";
				$this->Mlog->log_history("TKR Rincian Bulanan", "Tambah", $ket);
			}
			echo base64_encode($operasi);
		} else {
			echo base64_encode("99");
		}
	}

	public function update()
	{
		if ($this->aksesc[1] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$target = trim(str_replace("'", "''", $this->input->post("target")));
			$nip = trim(str_replace("'", "''", $this->input->post("nip")));
			$realisasi = trim(str_replace("'", "''", $this->input->post("realisasi")));
			$bulan_ke = trim(str_replace("'", "''", $this->input->post("bulan_ke")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$kode_jenjang = trim(str_replace("'", "''", $this->input->post("kode_jenjang")));
			$triwulan = trim(str_replace("'", "''", $this->input->post("triwulan")));
			$no_urut_rencana = trim(str_replace("'", "''", $this->input->post("no_urut_rencana")));
			$pangkat_gol_asli = trim(str_replace("'", "''", $this->input->post("pangkat_gol_asli")));
			$operasi = $this->Mtkrrb123->update($id, $target, $nip, $realisasi, $bulan_ke, $tahun, $kode_jenjang, $triwulan, $no_urut_rencana, $pangkat_gol_asli);
			if ($operasi == "1") {
				$ket = "ID: $id,\ntarget: $target,\nNIP : $nip,\nrealisasi: $realisasi,\nNo Urut Rencana: $bulan_ke,\nTarget Kinerja: $tahun,\nIndikator Kinerja: $kode_jenjang,\nOutput Jumlah: $triwulan,\nOutput Satuan: $no_urut_rencana,\npangkat_gol_asli: $pangkat_gol_asli";
				$this->Mlog->log_history("TKR Rincian Bulanan", "Update", $ket);
			}
			echo base64_encode($operasi);
		} else {
			echo base64_encode("99");
		}
	}

	public function tambah_akses()
	{
		if ($this->aksesc[1] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$bulan_ke = trim(str_replace("'", "''", $this->input->post("nama")));
			$bulan_ke = trim(str_replace("'", "''", $this->input->post("bulan_ke")));
			$pass =  md5(base64_encode(enkripsi($bulan_ke)));
			$level = trim(str_replace("'", "''", $this->input->post("level")));
			$status = trim(str_replace("'", "''", $this->input->post("status")));
			$operasi = $this->Mtkrrb123->tambah_akses($id, $bulan_ke, $bulan_ke, $pass, $level, $status);
			if ($operasi == "1") {
				$ket = "ID Akses: $id,\nNama: $bulan_ke,\nbulan_ke: $bulan_ke,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
				$this->Mlog->log_history("Akses", "Tambah", $ket);
			}
			echo base64_encode($operasi);
		} else {
			echo base64_encode("99");
		}
	}

	public function hapus()
	{
		if ($this->aksesc[2] == "1") {
			$id = trim(str_replace("'", "''", $this->input->post("id")));
			$td = $this->Mtkrrb123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtkrrb123->filter($id);
					$operasi = $this->Mtkrrb123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$target = $k->target;
							$nip = $k->nip;
							$realisasi = $k->realisasi;
							$bulan_ke = $k->bulan_ke;
							$tahun = $k->tahun;
							$kode_jenjang = $k->kode_jenjang;
							$triwulan = $k->triwulan;
							$no_urut_rencana = $k->no_urut_rencana;
							$pangkat_gol_asli = $k->pangkat_gol_asli;
						}
						$ket = "ID: $id,\ntarget: $target,\nNIP : $nip,\nrealisasi: $realisasi,\nNo Urut Rencana: $bulan_ke,\nTarget Kinerja: $tahun,\nIndikator Kinerja: $kode_jenjang,\nOutput Jumlah: $triwulan,\nOutput Satuan: $no_urut_rencana,\npangkat_gol_asli: $pangkat_gol_asli";
						$this->Mlog->log_history("TKR Rincian Bulanan", "Hapus", $ket);
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

	// public function import()
	// {
	// 	$filename = $this->input->post("namafile");
	// 	$kode = round(microtime(true) * 1000);
	// 	$bulan_ke = str_replace("fileku", $kode, $filename);
	// 	$location = "assets/excel/" . $bulan_ke;
	// 	$extensi = pathinfo($location, PATHINFO_EXTENSION);
	// 	$extensi = strtolower($extensi);
	// 	$extvalid = array("xlsx");
	// 	$response = 01;

	// 	if (in_array($extensi, $extvalid)) {
	// 		if (move_uploaded_file($_FILES["file"]["tmp_name"], $location)) {
	// 			if ($xlsx = SimpleXLSX::parse($location)) {
	// 				$berhasil = 0;
	// 				$gagal = 0;
	// 				$baris = 1;
	// 				foreach ($xlsx->rows() as $d) {
	// 					$bulan_ke = $d[0];
	// 					$nik = $d[1];
	// 					$nip = $d[2];
	// 					$gelarDep = $d[3];
	// 					$gelarBel = $d[4];
	// 					$tempat_lahir = $d[5];
	// 					$tgl_lahir = $d[6];
	// 					$target = $d[7];
	// 					// $agama = $d[8];
	// 					$ag = explode("-", $d[8]);
	// 					$agama = $ag[1];
	// 					// echo $agama;
	// 					$jsp = $d[9];
	// 					$sek = $d[10];
	// 					$kecsplit = explode("-", $d[11]);
	// 					$kec = $kecsplit[1];
	// 					$ptt = $d[12];
	// 					$pta = $d[13];
	// 					$nip = $d[14];
	// 					$desa = $d[15];
	// 					$pos = $d[16];
	// 					$realisasi = $d[17];
	// 					$email = $d[18];
	// 					$status = $d[19];
	// 					$jtt = $d[20];
	// 					$jja = $d[21];
	// 					$jab = $d[22];
	// 					if ($baris != 1) {
	// 						if ($bulan_ke == "" || $nik == "" || $nip == "" || $gelarDep == "" || $gelarBel == "" || $tempat_lahir == "" || $tgl_lahir == "" || $target == "" || $agama == "" || $jsp == "" || $sek == "" || $kec == "" || $ptt == "" || $pta == "" || $nip == "" || $desa == "" || $pos == "" || $realisasi == "" || $email == "" || $status == "" || $jtt == "" || $jja == "" || $jab == "") {
	// 							$gagal++;
	// 						} else {

	// 							$st = $this->Mtkrrb123->tambah(
	// 								$bulan_ke,
	// 								$nik,
	// 								$nip,
	// 								$gelarDep,
	// 								$gelarBel,
	// 								$tempat_lahir,
	// 								$tgl_lahir,
	// 								$target,
	// 								$agama,
	// 								$jsp,
	// 								$sek,
	// 								$kec,
	// 								$ptt,
	// 								$pta,
	// 								$nip,
	// 								$desa,
	// 								$pos,
	// 								$realisasi,
	// 								$email,
	// 								$status,
	// 								$jtt,
	// 								$jja,
	// 								$jab
	// 							);
	// 						}
	// 					}
	// 					$baris++;
	// 				}
	// 			}
	// 			// unlink($location);
	// 			// $response = "1|$berhasil|$gagal";
	// 			echo $st;
	// 		}
	// 	} else {
	// 		$response = "2|File Yang di Upload Salah Extensi";
	// 	}
	// 	echo base64_encode($response);
	// 	exit;
	// }

	// public function export()
	// {
	// 	$arr = [['<center><b><style font-size="14">DATA AKUN</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>', '<center><b>bulan_ke</b></center>', '<center><b>Level</b></center>', '<center><b>Status</b></center>']];
	// 	$dt = $this->Mtkrrb123->data();
	// 	foreach ($dt as $k) {
	// 		$id = $k->id;
	// 		$bulan_ke = $k->nama;
	// 		$target = $k->target;
	// 		$nip = $k->nip;
	// 		$realisasi = $k->$realisasi;
	// 		array_push($arr, [$id, $bulan_ke, $target, $nip, $realisasi]);
	// 	}

	// 	$xlsx = Shuchkin\SimpleXLSXGen::fromArray($arr);
	// 	$xlsx->mergeCells('A1:G1');
	// 	$xlsx->setColWidth(1, 15)->setColWidth(2, 25)->setColWidth(3, 20)->setColWidth(4, 40)->setColWidth(5, 25);
	// 	$xlsx->downloadAs('Data PPL.xlsx');
	// }

	// public function download()
	// {
	// 	force_download('assets/excel/Format Data PPL.xlsx', NULL);
	// }
}
