<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tkrtpp123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "tkrtpp123";
		$this->load->model('Mtkrtpp123');
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
		$data["fill"] = "tkrtpp123v";
		$data["dtipwkec"] = $this->Mtkrkik123->data();
		$data["dtkec"] = $this->Mkc001->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtkrtpp123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$no_urut = $k->no_urut;
			$tingkat_pendidikan = $k->tingkat_pendidikan;
			$jumlah = $k->jumlah;
			$tahun = $k->tahun;
			$id_kec = $k->nama_kec;
			$id_tkr_kode_ipwkec = $k->nama_ketua;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $no_urut . '","' . $tingkat_pendidikan . '","' . $jumlah . '","' . $tahun . '","' . $id_kec . '","' . $id_tkr_kode_ipwkec . '"],';
		}

		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtkrtpp123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$no_urut = $k->no_urut;
					$tingkat_pendidikan = $k->tingkat_pendidikan;
					$jumlah = $k->jumlah;
					$tahun = $k->tahun;
					$id_kec = $k->id_kec;
					$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
					echo base64_encode("1|" . $id .  "|" . $no_urut . "|" . $tingkat_pendidikan . "|" . $jumlah . "|" . $tahun . "|"  .  $id_kec . "|" . $id_tkr_kode_ipwkec );
				}
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
		$hasil = $this->Mtkrtpp123->filterdesa($idkec);
		echo json_encode($hasil);
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$no_urut = trim(str_replace("'", "''", $this->input->post("no_urut")));
			$tingkat_pendidikan = trim(str_replace("'", "''", $this->input->post("tingkat_pendidikan")));
			$jumlah = trim(str_replace("'", "''", $this->input->post("jumlah")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$operasi = $this->Mtkrtpp123->tambah($no_urut, $tingkat_pendidikan, $jumlah, $tahun, $id_kec, $id_tkr_kode_ipwkec);
			if ($operasi == "1") {
				$ket = "No Urut: $no_urut,\nTingkat Pendidikan : $tingkat_pendidikan,\nJumlah: $jumlah,\nTahun: $tahun,\nID Kec: $id_kec,\nID TKR Kode Ipwkec: $id_tkr_kode_ipwkec";
				$this->Mlog->log_history("TKR Tingkat Pendidikan Penduduk", "Tambah", $ket);
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
			$tingkat_pendidikan = trim(str_replace("'", "''", $this->input->post("tingkat_pendidikan")));
			$jumlah = trim(str_replace("'", "''", $this->input->post("jumlah")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwkec = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwkec")));
			$operasi = $this->Mtkrtpp123->update($id, $no_urut, $tingkat_pendidikan, $jumlah, $tahun, $id_kec, $id_tkr_kode_ipwkec);
			if ($operasi == "1") {
				$ket = "ID: $id,\nNo Urut: $no_urut,\nTingkat Pendidikan : $tingkat_pendidikan,\nJumlah: $jumlah,\nTahun: $tahun,\nID Kec: $id_kec,\nID TKR Kode Ipwkec: $id_tkr_kode_ipwkec";
				$this->Mlog->log_history("TKR Tingkat Pendidikan Penduduk", "Tambah", $ket);
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
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$pass =  md5(base64_encode(enkripsi($id_kec)));
			$level = trim(str_replace("'", "''", $this->input->post("level")));
			$status = trim(str_replace("'", "''", $this->input->post("status")));
			$operasi = $this->Mtkrtpp123->tambah_akses($id, $bulan_ke, $id_kec, $pass, $level, $status);
			if ($operasi == "1") {
				$ket = "ID Akses: $id,\nNama: $bulan_ke,\nid_kec: $id_kec,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
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
			$td = $this->Mtkrtpp123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtkrtpp123->filter($id);
					$operasi = $this->Mtkrtpp123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$no_urut = $k->no_urut;
							$tingkat_pendidikan = $k->tingkat_pendidikan;
							$jumlah = $k->jumlah;
							$tahun = $k->tahun;
							$id_kec = $k->id_kec;
							$id_tkr_kode_ipwkec = $k->id_tkr_kode_ipwkec;
						}
						$ket = "ID: $id,\nNo Urut: $no_urut,\nTingkat Pendidikan : $tingkat_pendidikan,\nJumlah: $jumlah,\nTahun: $tahun,\nID Kec: $id_kec,\nID TKR Kode Ipwkec: $id_tkr_kode_ipwkec";
						$this->Mlog->log_history("TKR Tingkat Pendidikan Penduduk", "Hapus", $ket);
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
	// 					$tingkat_pendidikan = $d[2];
	// 					$gelarDep = $d[3];
	// 					$gelarBel = $d[4];
	// 					$tempat_lahir = $d[5];
	// 					$tgl_lahir = $d[6];
	// 					$no_urut = $d[7];
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
	// 					$tingkat_pendidikan = $d[14];
	// 					$desa = $d[15];
	// 					$pos = $d[16];
	// 					$jumlah = $d[17];
	// 					$email = $d[18];
	// 					$status = $d[19];
	// 					$jtt = $d[20];
	// 					$jja = $d[21];
	// 					$jab = $d[22];
	// 					if ($baris != 1) {
	// 						if ($bulan_ke == "" || $nik == "" || $tingkat_pendidikan == "" || $gelarDep == "" || $gelarBel == "" || $tempat_lahir == "" || $tgl_lahir == "" || $no_urut == "" || $agama == "" || $jsp == "" || $sek == "" || $kec == "" || $ptt == "" || $pta == "" || $tingkat_pendidikan == "" || $desa == "" || $pos == "" || $jumlah == "" || $email == "" || $status == "" || $jtt == "" || $jja == "" || $jab == "") {
	// 							$gagal++;
	// 						} else {

	// 							$st = $this->Mtkrtpp123->tambah(
	// 								$bulan_ke,
	// 								$nik,
	// 								$tingkat_pendidikan,
	// 								$gelarDep,
	// 								$gelarBel,
	// 								$tempat_lahir,
	// 								$tgl_lahir,
	// 								$no_urut,
	// 								$agama,
	// 								$jsp,
	// 								$sek,
	// 								$kec,
	// 								$ptt,
	// 								$pta,
	// 								$tingkat_pendidikan,
	// 								$desa,
	// 								$pos,
	// 								$jumlah,
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
	// 	$arr = [['<center><b><style font-size="14">DATA AKUN</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>', '<center><b>id_kec</b></center>', '<center><b>Level</b></center>', '<center><b>Status</b></center>']];
	// 	$dt = $this->Mtkrtpp123->data();
	// 	foreach ($dt as $k) {
	// 		$id = $k->id;
	// 		$bulan_ke = $k->nama;
	// 		$no_urut = $k->no_urut;
	// 		$tingkat_pendidikan = $k->tingkat_pendidikan;
	// 		$jumlah = $k->$jumlah;
	// 		array_push($arr, [$id, $bulan_ke, $no_urut, $tingkat_pendidikan, $jumlah]);
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
