<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tkrrkp123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "tkrrkp123";
		$this->load->model('Mtkrrkp123');
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
		$data["fill"] = "tkrrkp123v";
		// $data["dtipwdes"] = $this->Mtkrkid123->data();
		// $data["dtkec"] = $this->Mkc001->data();
		// $data["dtdes"] = $this->Mds001->data();
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mtkrrkp123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$tahun = $k->tahun;
			$nip = $k->nip;
			$kode_jenjang = $k->kode_jenjang;
			$no_urut_rencana = $k->no_urut_rencana;
			$narasi_rencana = $k->narasi_rencana;
			$target_kinerja = $k->target_kinerja;
			$indikator_kinerja = $k->indikator_kinerja;
			$ak = $k->ak;
			$output_jumlah = $k->output_jumlah;
			$output_satuan = $k->output_satuan;
			$waktu = $k->waktu;
			$biaya = $k->biaya;
			$formulasi = $k->formulasi;
			$sumber_data = $k->sumber_data;
			$pangkat_gol_asli = $k->pangkat_gol_asli;
			$no_urut_tupoksi = $k->no_urut_tupoksi;
			$kode_range_pangkat = $k->kode_range_pangkat;
			$kode_jenjang_tupoksi = $k->kode_jenjang_tupoksi;
			$mutu = $k->mutu;
			$pangkat_aktif = $k->pangkat_aktif;
			$kelompok_tupoksi = $k->kelompok_tupoksi;
			$kuantitas = $k->kuantitas;
			$bobot_kerja = $k->bobot_kerja;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $tahun . '","' . $nip . '","' . $kode_jenjang . '","' . $no_urut_rencana . '", "' . $narasi_rencana . '","' . $target_kinerja . '","' . $indikator_kinerja . '","' . $ak . '","' . $output_jumlah . '","' . $output_satuan . '","' . $waktu . '","' . $biaya . '","' . $formulasi . '","' . $sumber_data . '","' . $pangkat_gol_asli . '","' . $no_urut_tupoksi . '","' . $kode_range_pangkat . '","' . $kode_jenjang_tupoksi . '","' . $mutu . '","' . $pangkat_aktif . '","' . $kelompok_tupoksi . '","' . $kuantitas . '","' . $bobot_kerja . '"],';
		}

		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mtkrrkp123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$tahun = $k->tahun;
					$nip = $k->nip;
					$kode_jenjang = $k->kode_jenjang;
					$no_urut_rencana = $k->no_urut_rencana;
					$narasi_rencana = $k->narasi_rencana;
					$target_kinerja = $k->target_kinerja;
					$indikator_kinerja = $k->indikator_kinerja;
					$ak = $k->ak;
					$output_jumlah = $k->output_jumlah;
					$output_satuan = $k->output_satuan;
					$waktu = $k->waktu;
					$biaya = $k->biaya;
					$formulasi = $k->formulasi;
					$sumber_data = $k->sumber_data;
					$pangkat_gol_asli = $k->pangkat_gol_asli;
					$no_urut_tupoksi = $k->no_urut_tupoksi;
					$kode_range_pangkat = $k->kode_range_pangkat;
					$kode_jenjang_tupoksi = $k->kode_jenjang_tupoksi;
					$mutu = $k->mutu;
					$pangkat_aktif = $k->pangkat_aktif;
					$kelompok_tupoksi = $k->kelompok_tupoksi;
					$kuantitas = $k->kuantitas;
					$bobot_kerja = $k->bobot_kerja;
				}
				echo base64_encode("1|" . $id .  "|" . $tahun . "|" . $nip . "|" . $kode_jenjang . "|" . $no_urut_rencana . "|" . $narasi_rencana . "|" . $target_kinerja . "|"  . $indikator_kinerja . "|" . $ak . "|" . $output_jumlah . "|" . $output_satuan . "|" . $waktu . "|" . $biaya . "|" . $formulasi . "|" . $sumber_data . "|" . $pangkat_gol_asli . "|" . $no_urut_tupoksi . "|"  . $kode_range_pangkat . "|" . $kode_jenjang_tupoksi . "|" . $mutu . "|" . $pangkat_aktif . "|" . $kelompok_tupoksi . "|" . $kuantitas . "|" . $bobot_kerja);
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
		$hasil = $this->Mtkrrkp123->filterdesa($idkec);
		echo json_encode($hasil);
	}

	public function tambah()
	{
		if ($this->aksesc[0] == "1") {
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$nip = trim(str_replace("'", "''", $this->input->post("nip")));
			$kode_jenjang = trim(str_replace("'", "''", $this->input->post("kode_jenjang")));
			$no_urut_rencana = trim(str_replace("'", "''", $this->input->post("no_urut_rencana")));
			$narasi_rencana = trim(str_replace("'", "''", $this->input->post("narasi_rencana")));
			$target_kinerja = trim(str_replace("'", "''", $this->input->post("target_kinerja")));
			$indikator_kinerja = trim(str_replace("'", "''", $this->input->post("indikator_kinerja")));
			$ak = trim(str_replace("'", "''", $this->input->post("ak")));
			$output_jumlah = trim(str_replace("'", "''", $this->input->post("output_jumlah")));
			$output_satuan = trim(str_replace("'", "''", $this->input->post("output_satuan")));
			$waktu = trim(str_replace("'", "''", $this->input->post("waktu")));
			$biaya = trim(str_replace("'", "''", $this->input->post("biaya")));
			$formulasi = trim(str_replace("'", "''", $this->input->post("formulasi")));
			$sumber_data = trim(str_replace("'", "''", $this->input->post("sumber_data")));
			$pangkat_gol_asli = trim(str_replace("'", "''", $this->input->post("pangkat_gol_asli")));
			$no_urut_tupoksi = trim(str_replace("'", "''", $this->input->post("no_urut_tupoksi")));
			$kode_range_pangkat = trim(str_replace("'", "''", $this->input->post("kode_range_pangkat")));
			$kode_jenjang_tupoksi = trim(str_replace("'", "''", $this->input->post("kode_jenjang_tupoksi")));
			$mutu = trim(str_replace("'", "''", $this->input->post("mutu")));
			$pangkat_aktif = trim(str_replace("'", "''", $this->input->post("pangkat_aktif")));
			$kelompok_tupoksi = trim(str_replace("'", "''", $this->input->post("kelompok_tupoksi")));
			$kuantitas = trim(str_replace("'", "''", $this->input->post("kuantitas")));
			$bobot_kerja = trim(str_replace("'", "''", $this->input->post("bobot_kerja")));
			$operasi = $this->Mtkrrkp123->tambah($tahun, $nip, $kode_jenjang, $no_urut_rencana, $narasi_rencana, $target_kinerja, $indikator_kinerja, $ak, $output_jumlah, $output_satuan, $waktu, $biaya, $formulasi, $sumber_data, $pangkat_gol_asli, $no_urut_tupoksi, $kode_range_pangkat, $kode_jenjang_tupoksi, $mutu, $pangkat_aktif, $kelompok_tupoksi, $kuantitas, $bobot_kerja);
			if ($operasi == "1") {
				$ket = "Tahun: $tahun,\nNIP : $nip,\nkode_jenjang: $kode_jenjang,\nNo Urut Rencana: $no_urut_rencana,\nNarasi Rencana: $narasi_rencana,\nTarget Kinerja: $target_kinerja,\nIndikator Kinerja: $indikator_kinerja,\nAK: $ak,\nOutput Jumlah: $output_jumlah,\nOutput Satuan: $output_satuan,\nWaktu: $waktu,\nBiaya: $biaya,\nFormulasi: $formulasi,\nSumber Data: $sumber_data,\nPangkat Gol Asli: $pangkat_gol_asli,\nNo Urut Tupoksi: $no_urut_tupoksi,\nKode Range Pangkat: $kode_range_pangkat,\nKode Jenjang Tupoksi: $kode_jenjang_tupoksi,\nMutu: $mutu,\nPangkat Aktof: $pangkat_aktif,\nKelompok Tupoksi: $kelompok_tupoksi,\nKuantitas: $kuantitas,\nBobot Kerja: $bobot_kerja";
				$this->Mlog->log_history("TKR Rencana Kerja Pegawai", "Tambah", $ket);
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
			$tahun = trim(str_replace("'", "''", $this->input->post("tahun")));
			$nip = trim(str_replace("'", "''", $this->input->post("nip")));
			$kode_jenjang = trim(str_replace("'", "''", $this->input->post("kode_jenjang")));
			$no_urut_rencana = trim(str_replace("'", "''", $this->input->post("no_urut_rencana")));
			$narasi_rencana = trim(str_replace("'", "''", $this->input->post("narasi_rencana")));
			$target_kinerja = trim(str_replace("'", "''", $this->input->post("target_kinerja")));
			$indikator_kinerja = trim(str_replace("'", "''", $this->input->post("indikator_kinerja")));
			$ak = trim(str_replace("'", "''", $this->input->post("ak")));
			$output_jumlah = trim(str_replace("'", "''", $this->input->post("output_jumlah")));
			$output_satuan = trim(str_replace("'", "''", $this->input->post("output_satuan")));
			$waktu = trim(str_replace("'", "''", $this->input->post("waktu")));
			$biaya = trim(str_replace("'", "''", $this->input->post("biaya")));
			$formulasi = trim(str_replace("'", "''", $this->input->post("formulasi")));
			$sumber_data = trim(str_replace("'", "''", $this->input->post("sumber_data")));
			$pangkat_gol_asli = trim(str_replace("'", "''", $this->input->post("pangkat_gol_asli")));
			$no_urut_tupoksi = trim(str_replace("'", "''", $this->input->post("no_urut_tupoksi")));
			$kode_range_pangkat = trim(str_replace("'", "''", $this->input->post("kode_range_pangkat")));
			$kode_jenjang_tupoksi = trim(str_replace("'", "''", $this->input->post("kode_jenjang_tupoksi")));
			$mutu = trim(str_replace("'", "''", $this->input->post("mutu")));
			$pangkat_aktif = trim(str_replace("'", "''", $this->input->post("pangkat_aktif")));
			$kelompok_tupoksi = trim(str_replace("'", "''", $this->input->post("kelompok_tupoksi")));
			$kuantitas = trim(str_replace("'", "''", $this->input->post("kuantitas")));
			$bobot_kerja = trim(str_replace("'", "''", $this->input->post("bobot_kerja")));
			$operasi = $this->Mtkrrkp123->update($id, $tahun, $nip, $kode_jenjang, $no_urut_rencana, $no_urut_rencana, $target_kinerja, $indikator_kinerja, $ak, $output_jumlah, $output_satuan, $waktu, $biaya, $formulasi, $sumber_data, $pangkat_gol_asli, $no_urut_tupoksi, $kode_range_pangkat, $kode_jenjang_tupoksi, $mutu, $pangkat_aktif, $kelompok_tupoksi, $kuantitas, $bobot_kerja);
			if ($operasi == "1") {
				$ket = "ID: $id,\nTahun: $tahun,\nNIP : $nip,\nkode_jenjang: $kode_jenjang,\nNo Urut Rencana: $no_urut_rencana,\nNarasi Rencana: $narasi_rencana,\nTarget Kinerja: $target_kinerja,\nIndikator Kinerja: $indikator_kinerja,\nAK: $ak,\nOutput Jumlah: $output_jumlah,\nOutput Satuan: $output_satuan,\nWaktu: $waktu,\nBiaya: $biaya,\nFormulasi: $formulasi,\nSumber Data: $sumber_data,\nPangkat Gol Asli: $pangkat_gol_asli,\nNo Urut Tupoksi: $no_urut_tupoksi,\nKode Range Pangkat: $kode_range_pangkat,\nKode Jenjang Tupoksi: $kode_jenjang_tupoksi,\nMutu: $mutu,\nPangkat Aktof: $pangkat_aktif,\nKelompok Tupoksi: $kelompok_tupoksi,\nKuantitas: $kuantitas,\nBobot Kerja: $bobot_kerja";
				$this->Mlog->log_history("TKR Rencana Kerja Pegawai", "Update", $ket);
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
			$no_urut_rencana = trim(str_replace("'", "''", $this->input->post("no_urut_rencana")));
			$pass =  md5(base64_encode(enkripsi($no_urut_rencana)));
			$level = trim(str_replace("'", "''", $this->input->post("level")));
			$status = trim(str_replace("'", "''", $this->input->post("status")));
			$operasi = $this->Mtkrrkp123->tambah_akses($id, $bulan_ke, $no_urut_rencana, $pass, $level, $status);
			if ($operasi == "1") {
				$ket = "ID Akses: $id,\nNama: $bulan_ke,\nno_urut_rencana: $no_urut_rencana,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
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
			$td = $this->Mtkrrkp123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mtkrrkp123->filter($id);
					$operasi = $this->Mtkrrkp123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$tahun = $k->tahun;
							$nip = $k->nip;
							$kode_jenjang = $k->kode_jenjang;
							$no_urut_rencana = $k->no_urut_rencana;
							$narasi_rencana = $k->narasi_rencana;
							$target_kinerja = $k->target_kinerja;
							$indikator_kinerja = $k->indikator_kinerja;
							$ak = $k->ak;
							$output_jumlah = $k->output_jumlah;
							$output_satuan = $k->output_satuan;
							$waktu = $k->waktu;
							$biaya = $k->biaya;
							$formulasi = $k->formulasi;
							$sumber_data = $k->sumber_data;
							$pangkat_gol_asli = $k->pangkat_gol_asli;
							$no_urut_tupoksi = $k->no_urut_tupoksi;
							$kode_range_pangkat = $k->kode_range_pangkat;
							$kode_jenjang_tupoksi = $k->kode_jenjang_tupoksi;
							$mutu = $k->mutu;
							$pangkat_aktif = $k->pangkat_aktif;
							$kelompok_tupoksi = $k->kelompok_tupoksi;
							$kuantitas = $k->kuantitas;
							$bobot_kerja = $k->bobot_kerja;
						}
						$ket = "ID: $id,\nTahun: $tahun,\nNIP : $nip,\nkode_jenjang: $kode_jenjang,\nNo Urut Rencana: $no_urut_rencana,\nNarasi Rencana: $narasi_rencana,\nTarget Kinerja: $target_kinerja,\nIndikator Kinerja: $indikator_kinerja,\nAK: $ak,\nOutput Jumlah: $output_jumlah,\nOutput Satuan: $output_satuan,\nWaktu: $waktu,\nBiaya: $biaya,\nFormulasi: $formulasi,\nSumber Data: $sumber_data,\nPangkat Gol Asli: $pangkat_gol_asli,\nNo Urut Tupoksi: $no_urut_tupoksi,\nKode Range Pangkat: $kode_range_pangkat,\nKode Jenjang Tupoksi: $kode_jenjang_tupoksi,\nMutu: $mutu,\nPangkat Aktof: $pangkat_aktif,\nKelompok Tupoksi: $kelompok_tupoksi,\nKuantitas: $kuantitas,\nBobot Kerja: $bobot_kerja";
						$this->Mlog->log_history("TKR Rencana Kerja Pegawai", "Hapus", $ket);
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
	// 					$tahun = $d[7];
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
	// 					$kode_jenjang = $d[17];
	// 					$email = $d[18];
	// 					$status = $d[19];
	// 					$jtt = $d[20];
	// 					$jja = $d[21];
	// 					$jab = $d[22];
	// 					if ($baris != 1) {
	// 						if ($bulan_ke == "" || $nik == "" || $nip == "" || $gelarDep == "" || $gelarBel == "" || $tempat_lahir == "" || $tgl_lahir == "" || $tahun == "" || $agama == "" || $jsp == "" || $sek == "" || $kec == "" || $ptt == "" || $pta == "" || $nip == "" || $desa == "" || $pos == "" || $kode_jenjang == "" || $email == "" || $status == "" || $jtt == "" || $jja == "" || $jab == "") {
	// 							$gagal++;
	// 						} else {

	// 							$st = $this->Mtkrrkp123->tambah(
	// 								$bulan_ke,
	// 								$nik,
	// 								$nip,
	// 								$gelarDep,
	// 								$gelarBel,
	// 								$tempat_lahir,
	// 								$tgl_lahir,
	// 								$tahun,
	// 								$agama,
	// 								$jsp,
	// 								$sek,
	// 								$kec,
	// 								$ptt,
	// 								$pta,
	// 								$nip,
	// 								$desa,
	// 								$pos,
	// 								$kode_jenjang,
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
	// 	$arr = [['<center><b><style font-size="14">DATA AKUN</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>', '<center><b>no_urut_rencana</b></center>', '<center><b>Level</b></center>', '<center><b>Status</b></center>']];
	// 	$dt = $this->Mtkrrkp123->data();
	// 	foreach ($dt as $k) {
	// 		$id = $k->id;
	// 		$bulan_ke = $k->nama;
	// 		$tahun = $k->tahun;
	// 		$nip = $k->nip;
	// 		$kode_jenjang = $k->$kode_jenjang;
	// 		array_push($arr, [$id, $bulan_ke, $tahun, $nip, $kode_jenjang]);
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
