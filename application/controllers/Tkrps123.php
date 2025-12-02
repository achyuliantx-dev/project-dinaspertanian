<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tkrps123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "tkrps123";
		$this->load->model('Mtkrps123');
		$this->load->model('Mkc001');
		$this->load->model('Mtkrkik123');
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
		$data["fill"] = "tkrps123v";
		$data["dtkec"] = $this->Mkc001->data();
		$data["dtipwkec"] = $this->Mtkrkik123->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtkrps123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$kondisi_baik = $k->kondisi_baik;
			$kondisi_buruk = $k->kondisi_buruk;
			$id_kec = $k->nama;
			$id_tkr_kode_ipwkec = $k->nama_ketua;
			$tahun = $k->tahun;
			$jumlah_seluruh = $k->jumlah_seluruh;
			$jenis_usaha = $k->jenis_usaha;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $kondisi_baik . '","' . $kondisi_buruk . '","' . $id_kec . '","' . $id_tkr_kode_ipwkec . '","' . $tahun . '","' . $jumlah_seluruh . '","' . $jenis_usaha . '"],';
		}

		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtkrps123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$kondisi_baik = $k->kondisi_baik;
					$kondisi_buruk = $k->kondisi_buruk;
					$id_kec = $k->id_kec;
					$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
					$tahun = $k->tahun;
					$jumlah_seluruh = $k->jumlah_seluruh;
					$jenis_usaha = $k->jenis_usaha;
				}
				echo base64_encode("1|" . $id . "|" . $kondisi_baik . "|" . $kondisi_buruk . "|" . $id_kec . "|" . $id_tkr_kode_ipwkec . "|" . $tahun . "|" . $jumlah_seluruh . "|" . $jenis_usaha);
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
		$hasil = $this->Mtkrps123->filterdesa($idkec);
		echo json_encode($hasil);
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$kondisi_baik = trim(str_replace("'", "''", $this->input->post("kondisi_baik")));
			$kondisi_buruk = trim(str_replace("'", "''", $this->input->post("kondisi_buruk")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$jumlah_seluruh = trim(str_replace("'", "''", $this->input->post("jumlah_seluruh")));
			$jenis_usaha = trim(str_replace("'", "''", $this->input->post("jenis_usaha")));
			$operasi = $this->Mtkrps123->tambah($kondisi_baik, $kondisi_buruk, $id_kec, $id_tkr_kode_ipwkec, $tahun, $jumlah_seluruh, $jenis_usaha);
			if ($operasi == "1") {
				$ket = "Kondisi Baik: $kondisi_baik,\Kondisi Buruk: $kondisi_buruk,\nKecamatan: $id_kec,\nKode IPW Kec: $id_tkr_kode_ipwkec,\nTahun: $tahun,\njumlah_seluruh: $jumlah_seluruh,\nJenis Usaha: $jenis_usaha";
				$this->Mlog->log_history("TKR PS", "Tambah", $ket);
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
			$kondisi_baik = trim(str_replace("'", "''", $this->input->post("kondisi_baik")));
			$kondisi_buruk = trim(str_replace("'", "''", $this->input->post("kondisi_buruk")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$jumlah_seluruh = trim(str_replace("'", "''", $this->input->post("jumlah_seluruh")));
			$jenis_usaha = trim(str_replace("'", "''", $this->input->post("jenis_usaha")));
			$operasi = $this->Mtkrps123->update($id, $kondisi_baik, $kondisi_buruk, $id_kec, $id_tkr_kode_ipwkec, $tahun, $jumlah_seluruh, $jenis_usaha);
			if ($operasi == "1") {
				$ket = "Kondisi Baik: $kondisi_baik,\Kondisi Buruk: $kondisi_buruk,\nKecamatan: $id_kec,\nKode IPW Kec: $id_tkr_kode_ipwkec,\nTahun: $tahun,\njumlah_seluruh: $jumlah_seluruh,\nJenis Usaha: $jenis_usaha";
				$this->Mlog->log_history("TKR PS", "Tambah", $ket);
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
			$kondisi_baik = trim(str_replace("'", "''", $this->input->post("nama")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$pass =  md5(base64_encode(enkripsi($tahun)));
			$level = trim(str_replace("'", "''", $this->input->post("level")));
			$status = trim(str_replace("'", "''", $this->input->post("status")));
			$operasi = $this->Mtkrps123->tambah_akses($id, $kondisi_baik, $tahun, $pass, $level, $status);
			if ($operasi == "1") {
				$ket = "ID Akses: $id,\nNama: $kondisi_baik,\ntahun: $tahun,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
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
			$td = $this->Mtkrps123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtkrps123->filter($id);
					$operasi = $this->Mtkrps123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$kondisi_baik = $k->kondisi_baik;
							$kondisi_buruk = $k->kondisi_buruk;
							$id_kec = $k->id_kec;
							$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
							$tahun = $k->tahun;
							$jumlah_seluruh = $k->jumlah_seluruh;
							$jenis_usaha = $k->jenis_usaha;
						}
						$ket = "Kondisi Baik: $kondisi_baik,\Kondisi Buruk: $kondisi_buruk,\nKecamatan: $id_kec,\nKode IPW Kec: $id_tkr_kode_ipwkec,\nTahun: $tahun,\njumlah_seluruh: $jumlah_seluruh,\nJenis Usaha: $jenis_usaha";
						$this->Mlog->log_history("TKR PS", "Hapus", $ket);
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
	// 	$kondisi_baik = str_replace("fileku", $kode, $filename);
	// 	$location = "assets/excel/" . $kondisi_baik;
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
	// 					$kondisi_baik = $d[0];
	// 					$nik = $d[1];
	// 					$nip = $d[2];
	// 					$gelarDep = $d[3];
	// 					$gelarBel = $d[4];
	// 					$tempat_lahir = $d[5];
	// 					$tgl_lahir = $d[6];
	// 					$kondisi_buruk = $d[7];
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
	// 					$id_kec = $d[14];
	// 					$desa = $d[15];
	// 					$pos = $d[16];
	// 					$id_tkr_kode_ipwkec = $d[17];
	// 					$email = $d[18];
	// 					$status = $d[19];
	// 					$jtt = $d[20];
	// 					$jja = $d[21];
	// 					$jab = $d[22];
	// 					if ($baris != 1) {
	// 						if ($kondisi_baik == "" || $nik == "" || $nip == "" || $gelarDep == "" || $gelarBel == "" || $tempat_lahir == "" || $tgl_lahir == "" || $kondisi_buruk == "" || $agama == "" || $jsp == "" || $sek == "" || $kec == "" || $ptt == "" || $pta == "" || $id_kec == "" || $desa == "" || $pos == "" || $id_tkr_kode_ipwkec == "" || $email == "" || $status == "" || $jtt == "" || $jja == "" || $jab == "") {
	// 							$gagal++;
	// 						} else {

	// 							$st = $this->Mtkrps123->tambah(
	// 								$kondisi_baik,
	// 								$nik,
	// 								$nip,
	// 								$gelarDep,
	// 								$gelarBel,
	// 								$tempat_lahir,
	// 								$tgl_lahir,
	// 								$kondisi_buruk,
	// 								$agama,
	// 								$jsp,
	// 								$sek,
	// 								$kec,
	// 								$ptt,
	// 								$pta,
	// 								$id_kec,
	// 								$desa,
	// 								$pos,
	// 								$id_tkr_kode_ipwkec,
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
	// 	$arr = [['<center><b><style font-size="14">DATA AKUN</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>', '<center><b>tahun</b></center>', '<center><b>Level</b></center>', '<center><b>Status</b></center>']];
	// 	$dt = $this->Mtkrps123->data();
	// 	foreach ($dt as $k) {
	// 		$id = $k->id;
	// 		$kondisi_baik = $k->nama;
	// 		$kondisi_buruk = $k->kondisi_buruk;
	// 		$id_kec = $k->id_kec;
	// 		$id_tkr_kode_ipwkec = $k->$id_tkr_kode_ipwkec;
	// 		array_push($arr, [$id, $kondisi_baik, $kondisi_buruk, $id_kec, $id_tkr_kode_ipwkec]);
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
