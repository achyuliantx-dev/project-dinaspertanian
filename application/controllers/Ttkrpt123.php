<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ttkrpt123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "ttkrpt123";
		$this->load->model('Mtkrpt123');
		$this->load->model('Mtkrkid123');
		$this->load->model('Mkc001');
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
		$data["fill"] = "ttkrpt123v";
		$data["dtipwdes"] = $this->Mtkrkid123->data();
		$data["dtkec"] = $this->Mkc001->data();
		// $data["dtdes"] = $this->Mds001->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtkrpt123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$nama_pola_tanam = $k->nama_pola_tanam;
			$luas = $k->luas;
			$keterangan = $k->keterangan;
			$tahun = $k->tahun;
			$id_kec = $k->id_kec;
			$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
			if ($id_des == "") {
				$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='" . $id . "' data-nama='" . $nama_pola_tanam . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>&nbsp<button class='btn btn-icon btn-round btn-danger' data-toggle='modal' data-target='#md_akses' data-nama='" . $nama_pola_tanam . "' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-user'></i></button>";
			} else {
				$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			}
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $nama_pola_tanam . '","' . $luas . '","' . $keterangan . '","' . $tahun . '","' . $id_kec . '","' . $id_tkr_kode_ipwkec . '"],';
		}

		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtkrpt123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$nama_pola_tanam = $k->nama_pola_tanam;
					$luas = $k->luas;
					$keterangan = $k->keterangan;
					$tahun = $k->tahun;
					$id_kec = $k->id_kec;
					$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
				}
				echo base64_encode("1|" . $id . "|" . $nama_pola_tanam . "|" . $luas . "|" . $luas . "|" . $keterangan . "|" . $tahun . "|" . $id_des . "|" . $id_kec . "|" . $id_tkr_kode_ipwkec);
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
		$hasil = $this->Mtkrpt123->filterdesa($idkec);
		echo json_encode($hasil);
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$nama_pola_tanam = trim(str_replace("'", "''", $this->input->post("nama_pola_tanam")));
			$luas = trim(str_replace("'", "''", $this->input->post("luas")));
			$keterangan = trim(str_replace("'", "''", $this->input->post("keterangan")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$operasi = $this->Mtkrpt123->tambah($nama_pola_tanam, $luas, $keterangan, $tahun, $id_kec, $id_tkr_kode_ipwkec);
			if ($operasi == "1") {
				$ket = "Nama Pola Tanam: $nama_pola_tanam,\nluas: $luas,\nketerangan: $keterangan,\nTahun: $tahun,\nID Kecamatan: $id_kec,\nIPW Kecamatan: $id_tkr_kode_ipwkec";
				$this->Mlog->log_history("TKR Pola Tanam", "Tambah", $ket);
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
			$nama_pola_tanam = trim(str_replace("'", "''", $this->input->post("nama_pola_tanam")));
			$luas = trim(str_replace("'", "''", $this->input->post("luas")));
			$keterangan = trim(str_replace("'", "''", $this->input->post("keterangan")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$operasi = $this->Mtkrpt123->update($id, $nama_pola_tanam, $luas, $keterangan, $tahun, $id_kec, $id_tkr_kode_ipwkec);
			if ($operasi == "1") {
				$ket = "Nama Pola Tanam: $nama_pola_tanam,\nluas: $luas,\nketerangan: $keterangan,\nTahun: $tahun,\nID Kecamatan: $id_kec,\nIPW Kecamatan: $id_tkr_kode_ipwkec";
				$this->Mlog->log_history("TKR Pola Tanam", "Tambah", $ket);
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
			$nama_pola_tanam = trim(str_replace("'", "''", $this->input->post("nama")));
			$uraian = trim(str_replace("'", "''", $this->input->post("uraian")));
			$pass =  md5(base64_encode(enkripsi($uraian)));
			$level = trim(str_replace("'", "''", $this->input->post("level")));
			$status = trim(str_replace("'", "''", $this->input->post("status")));
			$operasi = $this->Mtkrpt123->tambah_akses($id, $nama_pola_tanam, $uraian, $pass, $level, $status);
			if ($operasi == "1") {
				$ket = "ID Akses: $id,\nNama: $nama_pola_tanam,\nuraian: $uraian,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
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
			$td = $this->Mtkrpt123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtkrpt123->filter($id);
					$operasi = $this->Mtkrpt123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$nama_pola_tanam = $k->nama_pola_tanam;
							$luas = $k->luas;
							$keterangan = $k->keterangan;
							$tahun = $k->tahun;
							$id_kec = $k->id_kec;
							$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
						}
						$ket = "Nama Pola Tanam: $nama_pola_tanam,\nluas: $luas,\nketerangan: $keterangan,\nTahun: $tahun,\nID Kecamatan: $id_kec,\nIPW Kecamatan: $id_tkr_kode_ipwkec";
						$this->Mlog->log_history("TKR Pola Tanam", "Hapus", $ket);
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
	// 	$nama_pola_tanam = str_replace("fileku", $kode, $filename);
	// 	$location = "assets/excel/" . $nama_pola_tanam;
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
	// 					$nama_pola_tanam = $d[0];
	// 					$nik = $d[1];
	// 					$nip = $d[2];
	// 					$gelarDep = $d[3];
	// 					$gelarBel = $d[4];
	// 					$tempat_lahir = $d[5];
	// 					$tgl_lahir = $d[6];
	// 					$luas = $d[7];
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
	// 					$luas = $d[14];
	// 					$desa = $d[15];
	// 					$pos = $d[16];
	// 					$keterangan = $d[17];
	// 					$email = $d[18];
	// 					$status = $d[19];
	// 					$jtt = $d[20];
	// 					$jja = $d[21];
	// 					$jab = $d[22];
	// 					if ($baris != 1) {
	// 						if ($nama_pola_tanam == "" || $nik == "" || $nip == "" || $gelarDep == "" || $gelarBel == "" || $tempat_lahir == "" || $tgl_lahir == "" || $luas == "" || $agama == "" || $jsp == "" || $sek == "" || $kec == "" || $ptt == "" || $pta == "" || $luas == "" || $desa == "" || $pos == "" || $keterangan == "" || $email == "" || $status == "" || $jtt == "" || $jja == "" || $jab == "") {
	// 							$gagal++;
	// 						} else {

	// 							$st = $this->Mtkrpt123->tambah(
	// 								$nama_pola_tanam,
	// 								$nik,
	// 								$nip,
	// 								$gelarDep,
	// 								$gelarBel,
	// 								$tempat_lahir,
	// 								$tgl_lahir,
	// 								$luas,
	// 								$agama,
	// 								$jsp,
	// 								$sek,
	// 								$kec,
	// 								$ptt,
	// 								$pta,
	// 								$luas,
	// 								$desa,
	// 								$pos,
	// 								$keterangan,
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
	// 	$arr = [['<center><b><style font-size="14">DATA AKUN</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>', '<center><b>uraian</b></center>', '<center><b>Level</b></center>', '<center><b>Status</b></center>']];
	// 	$dt = $this->Mtkrpt123->data();
	// 	foreach ($dt as $k) {
	// 		$id = $k->id;
	// 		$nama_pola_tanam = $k->nama;
	// 		$luas = $k->luas;
	// 		$luas = $k->luas;
	// 		$keterangan = $k->$keterangan;
	// 		array_push($arr, [$id, $nama_pola_tanam, $luas, $luas, $keterangan]);
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
