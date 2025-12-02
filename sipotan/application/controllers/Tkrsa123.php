<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tkrsa123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "tkrsa123";
		$this->load->model('Mtkrsa123');
		$this->load->model('Mtkrkid123');
		$this->load->model('Mkc001');
		$this->load->model('Mds001');
		$this->load->model('Mpt034');
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
		$data["fill"] = "tkrsa123v";
		$data["dtipwdes"] = $this->Mtkrkid123->data();
		$data["dtkec"] = $this->Mkc001->data();
		$data["dtdes"] = $this->Mds001->data();
		$data["dtpoktan"] = $this->Mpt034->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtkrsa123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$no_urut = $k->no_urut;
			$nama_poktan = $k->nama_poktan;
			$jenis_alinstan = $k->jenis_alinstan;
			$jumlah_total = $k->jumlah_total;
			$milik_pribadi = $k->milik_pribadi;
			$milik_kelompok = $k->milik_kelompok;
			$jumlah_baik = $k->jumlah_baik;
			$jumlah_buruk = $k->jumlah_buruk;
			$tahun = $k->tahun;
			$id_poktan = $k->nama_lembaga_poktan;
			$id_des = $k->id_des;
			$id_kec = $k->id_kec;
			$id_tkr_kode_ipwdes = $k->id_tkr_kode_ipwdes;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $no_urut . '","' . $nama_poktan . '","' . $jenis_alinstan . '","' . $jumlah_total . '","' . $milik_pribadi . '","' . $milik_kelompok . '","' . $jumlah_baik . '","' . $jumlah_buruk . '","' . $tahun . '","' . $id_poktan . '","' . $id_des . '","' . $id_kec . '","' . $id_tkr_kode_ipwdes . '"],';
		}

		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtkrsa123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$no_urut = $k->no_urut;
					$nama_poktan = $k->nama_poktan;
					$jenis_alinstan = $k->jenis_alinstan;
					$jumlah_total = $k->jumlah_total;
					$milik_pribadi = $k->milik_pribadi;
					$milik_kelompok = $k->milik_kelompok;
					$jumlah_baik = $k->jumlah_baik;
					$jumlah_buruk = $k->jumlah_buruk;
					$tahun = $k->tahun;
					$id_poktan = $k->id_poktan;
					$id_des = $k->id_des;
					$id_kec = $k->id_kec;
					$id_tkr_kode_ipwdes = $k->id_tkr_kode_ipwdes;
				}
				echo base64_encode("1|" . $id .  "|" . $no_urut . "|" . $nama_poktan . "|" . $jenis_alinstan . "|" . $jumlah_total . "|" . $milik_pribadi . "|"  . $milik_kelompok . "|" . $jumlah_baik . "|" . $jumlah_buruk . "|" . $tahun . "|" . $id_poktan . "|" . $id_des . "|" . $id_kec . "|" . $id_tkr_kode_ipwdes);
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
		$hasil = $this->Mtkrsa123->filterdesa($idkec);
		echo json_encode($hasil);
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$no_urut = trim(str_replace("'", "''", $this->input->post("no_urut")));
			$nama_poktan = trim(str_replace("'", "''", $this->input->post("nama_poktan")));
			$jenis_alinstan = trim(str_replace("'", "''", $this->input->post("jenis_alinstan")));
			$jumlah_total = trim(str_replace("'", "''", $this->input->post("jumlah_total")));
			$milik_pribadi = trim(str_replace("'", "''", $this->input->post("milik_pribadi")));
			$milik_kelompok = trim(str_replace("'", "''", $this->input->post("milik_kelompok")));
			$jumlah_baik = trim(str_replace("'", "''", $this->input->post("jumlah_baik")));
			$jumlah_buruk = trim(str_replace("'", "''", $this->input->post("jumlah_buruk")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$id_poktan = trim(str_replace("'", "''", $this->input->post("id_poktan")));
			$id_des = trim(str_replace("'", "''", $this->input->post("id_des")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwdes = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwdes")));
			$operasi = $this->Mtkrsa123->tambah($no_urut, $nama_poktan, $jenis_alinstan, $jumlah_total, $milik_pribadi, $milik_kelompok, $jumlah_baik, $jumlah_buruk, $tahun, $id_poktan, $id_des, $id_kec, $id_tkr_kode_ipwdes);
			if ($operasi == "1") {
				$ket = "Nomor Urut: $no_urut,\nNama Poktan : $nama_poktan,\nJenis Alinstan: $jenis_alinstan,\nJumlah Total: $jumlah_total,\nMilik Pribadi: $milik_pribadi,\nMilik Kelompok: $milik_kelompok,\nJumlah Baik: $jumlah_baik,\nJumlah Buruk: $jumlah_buruk,\nTahun: $tahun,\nID Lembaga Tani: $id_poktan,\nID Des: $id_des,\nID Kec: $id_kec,\nID TKR Kode Ipwdes: $id_tkr_kode_ipwdes";
				$this->Mlog->log_history("TKR Sarana Alsintan", "Tambah", $ket);
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
			$nama_poktan = trim(str_replace("'", "''", $this->input->post("nama_poktan")));
			$jenis_alinstan = trim(str_replace("'", "''", $this->input->post("jenis_alinstan")));
			$jumlah_total = trim(str_replace("'", "''", $this->input->post("jumlah_total")));
			$milik_pribadi = trim(str_replace("'", "''", $this->input->post("milik_pribadi")));
			$milik_kelompok = trim(str_replace("'", "''", $this->input->post("milik_kelompok")));
			$jumlah_baik = trim(str_replace("'", "''", $this->input->post("jumlah_baik")));
			$jumlah_buruk = trim(str_replace("'", "''", $this->input->post("jumlah_buruk")));
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$id_poktan = trim(str_replace("'", "''", $this->input->post("id_poktan")));
			$id_des = trim(str_replace("'", "''", $this->input->post("id_des")));
			$id_kec = trim(str_replace("'", "''", $this->input->post("id_kec")));
			$id_tkr_kode_ipwdes = trim(str_replace("'", "''", $this->input->post("id_tkr_kode_ipwdes")));
			$operasi = $this->Mtkrsa123->update($id, $no_urut, $nama_poktan, $jenis_alinstan, $jumlah_total, $milik_pribadi, $milik_kelompok, $jumlah_baik, $jumlah_buruk, $tahun, $id_poktan, $id_des, $id_kec, $id_tkr_kode_ipwdes);
			if ($operasi == "1") {
				$ket = "ID: $id,\nNomor Urut: $no_urut,\nNama Poktan : $nama_poktan,\nJenis Alinstan: $jenis_alinstan,\nJumlah Total: $jumlah_total,\nMilik Pribadi: $milik_pribadi,\nMilik Kelompok: $milik_kelompok,\nJumlah Baik: $jumlah_baik,\nJumlah Buruk: $jumlah_buruk,\nTahun: $tahun,\nID Lembaga Tani: $id_poktan,\nID Des: $id_des,\nID Kec: $id_kec,\nID TKR Kode Ipwdes: $id_tkr_kode_ipwdes";
				$this->Mlog->log_history("TKR Sarana Alsintan", "Tambah", $ket);
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
			$jumlah_total = trim(str_replace("'", "''", $this->input->post("jumlah_total")));
			$pass =  md5(base64_encode(enkripsi($jumlah_total)));
			$level = trim(str_replace("'", "''", $this->input->post("level")));
			$status = trim(str_replace("'", "''", $this->input->post("status")));
			$operasi = $this->Mtkrsa123->tambah_akses($id, $bulan_ke, $jumlah_total, $pass, $level, $status);
			if ($operasi == "1") {
				$ket = "ID Akses: $id,\nNama: $bulan_ke,\njumlah_total: $jumlah_total,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
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
			$td = $this->Mtkrsa123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtkrsa123->filter($id);
					$operasi = $this->Mtkrsa123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$no_urut = $k->no_urut;
							$nama_poktan = $k->nama_poktan;
							$jenis_alinstan = $k->jenis_alinstan;
							$jumlah_total = $k->jumlah_total;
							$milik_pribadi = $k->milik_pribadi;
							$milik_kelompok = $k->milik_kelompok;
							$jumlah_baik = $k->jumlah_baik;
							$jumlah_buruk = $k->jumlah_buruk;
							$tahun = $k->tahun;
							$id_poktan = $k->id_poktan;
							$id_des = $k->id_des;
							$id_kec = $k->id_kec;
							$id_tkr_kode_ipwdes = $k->id_tkr_kode_ipwdes;
						}
						$ket = "ID: $id,\nNomor Urut: $no_urut,\nNama Poktan : $nama_poktan,\nJenis Alinstan: $jenis_alinstan,\nJumlah Total: $jumlah_total,\nMilik Pribadi: $milik_pribadi,\nMilik Kelompok: $milik_kelompok,\nJumlah Baik: $jumlah_baik,\nJumlah Buruk: $jumlah_buruk,\nTahun: $tahun,\nID Lembaga Tani: $id_poktan,\nID Des: $id_des,\nID Kec: $id_kec,\nID TKR Kode Ipwdes: $id_tkr_kode_ipwdes";
						$this->Mlog->log_history("TKR Sarana Alsintan", "Hapus", $ket);
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
	// 					$nama_poktan = $d[2];
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
	// 					$nama_poktan = $d[14];
	// 					$desa = $d[15];
	// 					$pos = $d[16];
	// 					$jenis_alinstan = $d[17];
	// 					$email = $d[18];
	// 					$status = $d[19];
	// 					$jtt = $d[20];
	// 					$jja = $d[21];
	// 					$jab = $d[22];
	// 					if ($baris != 1) {
	// 						if ($bulan_ke == "" || $nik == "" || $nama_poktan == "" || $gelarDep == "" || $gelarBel == "" || $tempat_lahir == "" || $tgl_lahir == "" || $no_urut == "" || $agama == "" || $jsp == "" || $sek == "" || $kec == "" || $ptt == "" || $pta == "" || $nama_poktan == "" || $desa == "" || $pos == "" || $jenis_alinstan == "" || $email == "" || $status == "" || $jtt == "" || $jja == "" || $jab == "") {
	// 							$gagal++;
	// 						} else {

	// 							$st = $this->Mtkrsa123->tambah(
	// 								$bulan_ke,
	// 								$nik,
	// 								$nama_poktan,
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
	// 								$nama_poktan,
	// 								$desa,
	// 								$pos,
	// 								$jenis_alinstan,
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
	// 	$arr = [['<center><b><style font-size="14">DATA AKUN</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>', '<center><b>jumlah_total</b></center>', '<center><b>Level</b></center>', '<center><b>Status</b></center>']];
	// 	$dt = $this->Mtkrsa123->data();
	// 	foreach ($dt as $k) {
	// 		$id = $k->id;
	// 		$bulan_ke = $k->nama;
	// 		$no_urut = $k->no_urut;
	// 		$nama_poktan = $k->nama_poktan;
	// 		$jenis_alinstan = $k->$jenis_alinstan;
	// 		array_push($arr, [$id, $bulan_ke, $no_urut, $nama_poktan, $jenis_alinstan]);
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
