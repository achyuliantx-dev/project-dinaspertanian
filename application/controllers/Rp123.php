<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rp123 extends CI_Controller
{
	public $idsc;
	public $aksesc = array();
	function __construct()
	{
		parent::__construct();
		include APPPATH . "libraries\SimpleXLSX.php";
		include APPPATH . "libraries\SimpleXLSXGen.php";
		$this->load->helper(array('url', 'download'));
		$idformini = "rp123";
		$this->load->model("Mrp123");
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
		$data["fill"] = "rp123v";
		$this->load->view($this->idsc . '/basis', $data);
	}

	public function json()
	{
		$dtJSON = '{"data": [xxx]}';
		$dtisi = "";
		$dt = $this->Mrp123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$nama = $k->nama;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='" . $id . "' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$dtisi .= '["' . $tomboledit . '","' . $id . '","' . $nama . '"],';
		}
		$dtisifix = rtrim($dtisi, ",");
		$data = str_replace("xxx", $dtisifix, $dtJSON);
		echo $data;
	}

	public function filter()
	{
		$id = trim($this->input->post("id"));
		$dt = $this->Mrp123->filter($id);
		if (is_array($dt)) {
			if (count($dt) > 0) {
				foreach ($dt as $k) {
					$id = $k->id;
					$nama = $k->nama;
				}
				echo base64_encode("1|" . $id . "|" . $nama);
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
			$operasi = $this->Mrp123->tambah($nama);
			if ($operasi == "1") {
				$ket = "Nama Agama: $nama";
				$this->Mlog->log_history("Agama", "Tambah", $ket);
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
			$nama = trim(str_replace("'", "''", $this->input->post("nama")));
			$operasi = $this->Mrp123->update($id, $nama);
			if ($operasi == "1") {
				$ket = "ID Agama: $id,\nNama Agama: $nama";
				$this->Mlog->log_history("Agama", "Update", $ket);
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
			$td = $this->Mrp123->cekform($id);
			if (is_array($td)) {
				if (count($td) > 0) {
					echo base64_encode("90");
				} else {
					$dt = $this->Mrp123->filter($id);
					$operasi = $this->Mrp123->hapus($id);
					if ($operasi == "1") {
						foreach ($dt as $k) {
							$id = $k->id;
							$nama = $k->nama;
						}
						$ket = "ID Agama: $id,\nNama Agama: $nama";
						$this->Mlog->log_history("Agama", "Hapus", $ket);
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

	public function import()
	{
		$filename = $this->input->post("namafile");
		$kode = round(microtime(true) * 1000);
		$nama = str_replace("fileku", $kode, $filename);
		$location = "assets/excel/" . $nama;
		$extensi = pathinfo($location, PATHINFO_EXTENSION);
		$extensi = strtolower($extensi);
		$extvalid = array("xlsx");
		$response = 0;

		if (in_array($extensi, $extvalid)) {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $location)) {
				if ($xlsx = SimpleXLSX::parse($location)) {
					$berhasil = 0;
					$gagal = 0;
					$baris = 1;
					foreach ($xlsx->rows() as $d) {
						$nama = $d[0];
						if ($baris != 1) {
							if (
								$nama == ""
							) {
								$gagal++;
							} else {
								// $statusnik = "unik";
								// $statushp = "unik";
								// $filter1 = $this->Mag778->filter("NIK", $nik);
								// if (is_array($filter1)) {
								// 	if (count($filter1) > 0) {
								// 		$statusnik = "ganda";
								// 	}
								// }
								$st = $this->Mrp123->tambah($nama);
								if ($st == "1") {
									$berhasil++;
								} else {
									$gagal++;
								}
							}
						}
						$baris++;
					}
				}
				unlink($location);
				$response = "1|$berhasil|$gagal";
			}
		} else {
			$response = "2|File Yang di Upload Salah Extensi";
		}
		echo base64_encode($response);
		exit;
	}

	public function export()
	{
		$arr = [['<center><b><style font-size="14">DATA AGAMA</style></b></center>'], ['<center><b>ID</b></center>', '<center><b>Nama</b></center>']];
		$dt = $this->Mrp123->data();
		foreach ($dt as $k) {
			$id = $k->id;
			$nama = $k->nama;
			array_push($arr, [$id, $nama]);
		}

		$xlsx = Shuchkin\SimpleXLSXGen::fromArray($arr);
		$xlsx->mergeCells('A1:E1');
		$xlsx->setColWidth(1, 15)->setColWidth(2, 25)->setColWidth(3, 15)->setColWidth(4, 10)->setColWidth(5, 25);
		$xlsx->downloadAs('Data Agama.xlsx');
	}

	public function download()
	{
		force_download('assets/excel/Format Data Agama.xlsx', NULL);
	}
}
