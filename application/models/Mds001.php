<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mds001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan FROM desa AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function getOptions($search = '') {
        // Query untuk mengambil data dari database
        $this->db->select('id, nama'); // Sesuaikan dengan kolom yang ingin ditampilkan
        $this->db->from('desa'); // Ganti "my_table" dengan nama tabel Anda
        if (!empty($search)) {
            $this->db->like('nama', $search); // Menambahkan filter pencarian
        }
        $query = $this->db->get();
        return $query->result();
    }
    
	public function filter($a){
		$sql = "SELECT * FROM desa WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM dusun WHERE id_desa='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id,$nama,$kec,$jenis){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO desa VALUES('$id','$nama','$kec','$jenis');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $kec,$jenis){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE desa SET nama='$nama', id_kecamatan='$kec', jenis='$jenis' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM desa WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}