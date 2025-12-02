<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tkrob123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "tkrob123";
		$this->load->model('Mtkrob123');
		$this->load->model('Mtkrkik123');
		$this->load->model('Mkc001');
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
		$data["fill"] = "tkrob123v";
		$data["dtkec"] = $this->Mkc001->data();
		$data["dtipwkec"] = $this->Mtkrkik123->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtkrob123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$no_urut = $k->no_urut;
			$uraian = $k->uraian;
			$jarak = $k->jarak;
			$jenis_jalan = $k->jenis_jalan;
			$kondisi_jalan = $k->kondisi_jalan;
			$id_kec = $k->nama;
			$id_tkr_kode_ipwkec = $k->nama_ketua;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $no_urut . '","' . $uraian . '","' . $jarak . '","' . $jenis_jalan . '","' . $kondisi_jalan . '","' . $id_kec . '","' . $id_tkr_kode_ipwkec . '"],';
		}

		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtkrob123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$no_urut = $k->no_urut;
					$uraian = $k->uraian;
					$jarak = $k->jarak;
					$jenis_jalan = $k->jenis_jalan;
					$kondisi_jalan = $k->kondisi_jalan;
					$id_kec = $k->id_kec;
					$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
				}
				echo base64_encode("1|" . $id . "|" . $no_urut . "|" . $uraian . "|" . $jarak . "|" . $jenis_jalan . "|" . $kondisi_jalan . "|" . $id_kec . "|" . $id_tkr_kode_ipwkec);
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
		$hasil = $this->Mtkrob123->filterdesa($idkec);
		echo json_encode($hasil);
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$no_urut = trim(str_replace("'", "''", $this->input->post("no_urut")));
			$uraian = trim(str_replace("'", "''", $this->input->post("uraian")));
			$jarak = trim(str_replace("'", "''", $this->input->post("jarak")));
			$jenis_jalan = trim(str_replace("'", "''", $this->input->post("jenis_jalan")));
			$kondisi_jalan = trim(str_replace("'", "''", $this->input->post("kondisi_jalan")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$operasi = $this->Mtkrob123->tambah($no_urut, $uraian, $jarak, $jenis_jalan, $kondisi_jalan, $id_kec, $id_tkr_kode_ipwkec);
			if ($operasi == "1") {
				$ket = "Nomor Urut: $no_urut,\nUraian: $uraian,\nJarak: $jarak,\nJenis Jalan: $jenis_jalan,\nKondisi Jalan: $kondisi_jalan, \nID Kecamatan : $id_kec,\nIPW Kecamtan : $id_tkr_kode_ipwkec";
				$this->Mlog->log_history("TKR OB", "Tambah", $ket);
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
			$no_urut = trim(str_replace("'", "''", $this->input->post("no_urut")));
			$uraian = trim(str_replace("'", "''", $this->input->post("uraian")));
			$jarak = trim(str_replace("'", "''", $this->input->post("jarak")));
			$jenis_jalan = trim(str_replace("'", "''", $this->input->post("jenis_jalan")));
			$kondisi_jalan = trim(str_replace("'", "''", $this->input->post("kondisi_jalan")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$operasi = $this->Mtkrob123->update($id, $no_urut, $uraian, $jarak, $jenis_jalan, $kondisi_jalan, $id_kec, $id_tkr_kode_ipwkec);
			if ($operasi == "1") {
				$ket = "ID :$id,\nNomor Urut: $no_urut,\nUraian: $uraian,\nJarak: $jarak,\nJenis Jalan: $jenis_jalan,\nKondisi Jalan: $kondisi_jalan, \nID Kecamatan : $id_kec,\nIPW Kecamtan : $id_tkr_kode_ipwkec";
				$this->Mlog->log_history("TKR OB", "Update", $ket);
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
			$no_urut = trim(str_replace("'", "''", $this->input->post("nama")));
			$kondisi_jalan = trim(str_replace("'", "''", $this->input->post("kondisi_jalan")));
			$pass =  md5(base64_encode(enkripsi($kondisi_jalan)));
			$level = trim(str_replace("'", "''", $this->input->post("level")));
			$status = trim(str_replace("'", "''", $this->input->post("status")));
			$operasi = $this->Mtkrob123->tambah_akses($id, $no_urut, $kondisi_jalan, $pass, $level, $status);
			if ($operasi == "1") {
				$ket = "ID Akses: $id,\nNama: $no_urut,\nkondisi_jalan: $kondisi_jalan,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
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
			$td = $this->Mtkrob123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtkrob123->filter($id);
					$operasi = $this->Mtkrob123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$no_urut = $k->nama;
							$uraian = $k->uraian;
							$jarak = $k->jarak;
							$jenis_jalan = $k->jenis_jalan;
							$kondisi_jalan = $k->kondisi_jalan;
							$id_kec = $k->id_kec;
							$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
						}
						$ket = "Nomor Urut: $no_urut,\nUraian: $uraian,\nJarak: $jarak,\nJenis Jalan: $jenis_jalan,\nKondisi Jalan: $kondisi_jalan, \nID Kecamatan : $id_kec,\nIPW Kecamtan : $id_tkr_kode_ipwkec";
						$this->Mlog->log_history("TKR OB", "Hapus", $ket);
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
	// 	$no_urut = str_replace("fileku", $kode, $filename);
	// 	$location = "assets/excel/" . $no_urut;
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
	// 					$no_urut = $d[0];
	// 					$nik = $d[1];
	// 					$nip = $d[2];
	// 					$gelarDep = $d[3];
	// 					$gelarBel = $d[4];
	// 					$tempat_lahir = $d[5];
	// 					$tgl_lahir = $d[6];
	// 					$uraian = $d[7];
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
	// 					$jarak = $d[14];
	// 					$desa = $d[15];
	// 					$pos = $d[16];
	// 					$jenis_jalan = $d[17];
	// 					$email = $d[18];
	// 					$status = $d[19];
	// 					$jtt = $d[20];
	// 					$jja = $d[21];
	// 					$jab = $d[22];
	// 					if ($baris != 1) {
	// 						if ($no_urut == "" || $nik == "" || $nip == "" || $gelarDep == "" || $gelarBel == "" || $tempat_lahir == "" || $tgl_lahir == "" || $uraian == "" || $agama == "" || $jsp == "" || $sek == "" || $kec == "" || $ptt == "" || $pta == "" || $jarak == "" || $desa == "" || $pos == "" || $jenis_jalan == "" || $email == "" || $status == "" || $jtt == "" || $jja == "" || $jab == "") {
	// 							$gagal++;
	// 						} else {

	// 							$st = $this->Mtkrob123->tambah(
	// 								$no_urut,
	// 								$nik,
	// 								$nip,
	// 								$gelarDep,
	// 								$gelarBel,
	// 								$tempat_lahir,
	// 								$tgl_lahir,
	// 								$uraian,
	// 								$agama,
	// 								$jsp,
	// 								$sek,
	// 								$kec,
	// 								$ptt,
	// 								$pta,
	// 								$jarak,
	// 								$desa,
	// 								$pos,
	// 								$jenis_jalan,
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
	// 	$arr = [['<center><b><style font-size="14">DATA AKUN</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>', '<center><b>kondisi_jalan</b></center>', '<center><b>Level</b></center>', '<center><b>Status</b></center>']];
	// 	$dt = $this->Mtkrob123->data();
	// 	foreach ($dt as $k) {
	// 		$id = $k->id;
	// 		$no_urut = $k->nama;
	// 		$uraian = $k->uraian;
	// 		$jarak = $k->jarak;
	// 		$jenis_jalan = $k->jenis_jalan;
	// 		array_push($arr, [$id, $no_urut, $uraian, $jarak, $jenis_jalan]);
	// 	}

	// 	$xlsx = Shuchkin\SimpleXLSXGen::fromArray($arr);
	// 	$xlsx->mergeCells('A1:G1');
	// 	$xlsx->setColWidth(1, 15)->setColWidth(2, 25)->setColWidth(3, 20)->setColWidth(4, 40)->setColWidth(5, 25);
	// 	$xlsx->downloadAs('Data TKR OB.xlsx');
	// }

	// public function download()
	// {
	// 	force_download('assets/excel/Format Data TKR OB.xlsx', NULL);
	// }
}
