<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Rencana Kerja Pegawai</h1>
	<div class="page-header-actions">
		<div class="btn-group btn-group-sm" id="withBtnGroup" aria-label="Page Header Actions" role="group">
			<div class="input-group" style="padding-left: 10px; padding-right: 10px;">
				<input type="file" name="txtfile" id="txtfile" accept=".xlsx" hidden onchange="bacafile()" />
				<input type="text" class="form-control" id="txtnamafile" readonly />
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" onclick="$('#txtfile').click()">browse</button>
				</span>
			</div>
			<div style="padding-left: 10px; padding-right: 10px;">
				<button type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Refresh Data" data-container="body" onclick="uploadfile()">
					<i class="icon <?= $icform; ?>" aria-hidden="true"></i>
					<span class="hidden-sm-down">Import: <?= $idf; ?></span>
				</button>
			</div>
			<div style="padding-left: 10px; padding-right: 10px;">
				<button type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Refresh Data" data-container="body" onclick="exportExcel()">
					<i class="icon <?= $icform; ?>" aria-hidden="true"></i>
					<span class="hidden-sm-down">Ekspor: <?= $idf; ?></span>
				</button>
			</div>
			<div style="padding-left: 10px; padding-right: 10px;">
				<button type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Refresh Data" data-container="body" onclick="downloadFormat()">
					<i class="icon <?= $icform; ?>" aria-hidden="true"></i>
					<span class="hidden-sm-down">Download Format Excel: <?= $idf; ?></span>
				</button>
			</div>
			<div style="padding-left: 10px; padding-right: 10px;">
				<button type="button" class="btn btn-primary">
					<i class="icon <?= $icform; ?>" aria-hidden="true"></i>
					<span class="hidden-sm-down">Kode Form: <?= $idf; ?></span>
				</button>
			</div>
			<div style="padding-left: 10px; padding-right: 10px;">
				<button type="button" class="btn btn-danger" data-toggle="tooltip" data-original-title="Refresh Data" data-container="body" onclick="refreshdata()">
					<i class="icon wb-loop" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xxl-9 col-lg-9 col-md-9">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Data</h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 10%;">Aksi</th>
							<th style="width: 15%;">ID</th>
							<th>Tahun</th>
							<th>NIP</th>
							<th>Kode Jenjang</th>
							<th>No Urut Rencana</th>
							<th>Narasi Rencana</th>
							<th>Target Kinerja</th>
							<th>Indikator Kinerja</th>
							<th>AK</th>
							<th>Output Jumlah</th>
							<th>Output Satuan</th>
							<th>Waktu</th>
							<th>Biaya</th>
							<th>Formulasi</th>
							<th>Pangkat Gol Asli</th>
							<th>No Urut Tupoksi</th>
							<th>Kode Range Pangkat</th>
							<th>Kode Jenjang Tupoksi</th>
							<th>Mutu</th>
							<th>Pangkat Aktif</th>
							<th>Kelompok Tupoksi</th>
							<th>Kuantitas</th>
							<th>Bobot Kinerja</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xxl-3 col-lg-3 col-md-3">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title" id="lbljudul">Form</h3>
			</div>
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label class="form-control-label">ID Rencana Kerja Pegawai*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tahun*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_tahun" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">NIP*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_nip" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Kode Jenjang*</label>
						<select class="form-control select2" id="txt_kode_jenjang">
							<option value="">Silahkan Pilih</option>
							<option value="Terampil">Terampil</option>
							<option value="Ahli">Ahli</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">No Urut Rencana*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_no_urut_rencana" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Narasi Rencana*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_narasi_rencana" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Target Kinerja*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_target_kinerja" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Indikator Kinerja*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_indikator_kinerja" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">AK*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_ak" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Output Jumlah*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_output_jumlah" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Output Satuan*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_output_satuan" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Waktu*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_waktu" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_biaya" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Formulasi*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_formulasi" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Sumber Data*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_sumber_data" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Pangkat Gol Asli*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_pangkat_gol_asli" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">No Urut Tupoksi*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_no_urut_tupoksi" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Kode Range Pangkat*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_kode_range_pangkat" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Kode Jenjang Tupoksi*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_kode_jenjang_tupoksi" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Mutu*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_mutu" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Pangkat Aktif*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_pangkat_aktif" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Kelompok Tupoksi*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_kelompok_tupoksi" placeholder="Masukkan Alamat" autocomplete="off">
					</div>

					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Kuantitas*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_kuantitas" placeholder="Masukkan Alamat" autocomplete="off">
					</div>

					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Bobot Kerja*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_bobot_kerja" placeholder="Masukkan Alamat" autocomplete="off">
					</div>

					<div class="form-group col-md-12" id="bloktombol"></div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	console.log("<?= base_url(ucfirst($idf)); ?>");
	
	var idmenu = "<?= $idmskr; ?>";
	var idform = "<?= ucfirst($idf); ?>";
	$("#tpm" + idmenu).addClass("active");
	$("#stpm" + idform).addClass("active");

	swal("Sedang Mengakses Data.....", {
		button: false,
		closeOnClickOutside: false,
		closeOnEsc: false
	});
	var tabel = $('#tbl-xdt').DataTable({
		"ajax": "<?= base_url(ucfirst($idf) . '/json'); ?>",
		"fnDrawCallback": function(oSettings) {
			swal.close();
		}
	});

	refresh();

	function downloadFormat() {
		window.open("<?= base_url(ucfirst($idf) . '/download'); ?>", '_blank');
	}

	function exportExcel() {
		window.open("<?= base_url(ucfirst($idf) . '/export'); ?>", '_blank');
	}

	function bacafile() {
		let obyek = document.getElementById("txtfile");
		let namafile = obyek.files.item(0).name;
		$("#txtnamafile").val(namafile);
	}

	function uploadfile() {
		let nama = $("#txtnamafile").val();
		let x = nama.split(".");
		let tipe = x[x.length - 1];
		if (nama == "") {
			swal({
				title: "Gagal",
				text: "Anda Belum Memilih File",
				icon: "error"
			});
			return;
		}
		if (tipe != "xlsx") {
			swal({
				title: "Gagal",
				text: "File Harus Excel (.xlsx)",
				icon: "error"
			});
			return;
		}
		let fileku = document.getElementById("txtfile").files;
		if (fileku.length > 0) {
			let formdata = new FormData();
			formdata.append("namafile", `fileku.${tipe}`);
			formdata.append("file", fileku[0]);
			let xhttp = new XMLHttpRequest();
			xhttp.open("POST", "<?= base_url(ucfirst($idf) . '/import'); ?>", true);
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
					swal({
						title: "Berhasil",
						text: "Upload File Berhasil",
						icon: "success"
					});
					return;
				}
			}
			xhttp.send(formdata);
		} else {
			swal({
				title: "Gagal",
				text: "Anda Belum Memilih File",
				icon: "error"
			});
			return;
		}
	}

	refresh();

	function refreshdata() {
		swal("Sedang Mengakses Data.....", {
			button: false,
			closeOnClickOutside: false,
			closeOnEsc: false
		});
		tabel.ajax.reload(null, false);
	}

	function refresh() {
		$("#txtid").val("Otomatis By System");
		$("#txt_tahun").val("");
		$("#txt_nip").val("");
		$("#txt_kode_jenjang").val("").change();
		$("#txt_no_urut_rencana").val("");
		$("#txt_narasi_rencana").val("");
		$("#txt_target_kinerja").val("");
		$("#txt_indikator_kinerja").val("");
		$("#txt_ak").val("");
		$("#txt_output_jumlah").val("");
		$("#txt_output_satuan").val("");
		$("#txt_waktu").val("");
		$("#txt_biaya").val("");
		$("#txt_formulasi").val("");
		$("#txt_sumber_data").val("");
		$("#txt_pangkat_gol_asli").val("");
		$("#txt_no_urut_tupoksi").val("");
		$("#txt_kode_range_pangkat").val("");
		$("#txt_kode_jenjang_tupoksi").val("");
		$("#txt_mutu").val("");
		$("#txt_pangkat_aktif").val("");
		$("#txt_kelompok_tupoksi").val("");
		$("#txt_kuantitas").val("");
		$("#txt_bobot_kerja").val("");
		$("#lbljudul").html('Form Tambah Data');
		$("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function tambah() {
		$("#btntambah").attr("disabled", true);
		var id = $("#txtid").val();
		var tahun = $("#txt_tahun").val();
		var nip = $("#txt_nip").val();
		var kode_jenjang = $("#txt_kode_jenjang").val();
		var no_urut_rencana = $("#txt_no_urut_rencana").val();
		var narasi_rencana = $("#txt_narasi_rencana").val();
		var target_kinerja = $("#txt_target_kinerja").val();
		var indikator_kinerja = $("#txt_indikator_kinerja").val();
		var ak = $("#txt_ak").val();
		var output_jumlah = $("#txt_output_jumlah").val();
		var output_satuan = $("#txt_output_satuan").val();
		var waktu = $("#txt_waktu").val();
		var biaya = $("#txt_biaya").val();
		var formulasi = $("#txt_formulasi").val();
		var sumber_data = $("#txt_sumber_data").val();
		var pangkat_gol_asli = $("#txt_pangkat_gol_asli").val();
		var no_urut_tupoksi = $("#txt_no_urut_tupoksi").val();
		var kode_range_pangkat = $("#txt_kode_range_pangkat").val();
		var kode_jenjang_tupoksi = $("#txt_kode_jenjang_tupoksi").val();
		var mutu = $("#txt_mutu").val();
		var pangkat_aktif = $("#txt_pangkat_aktif").val();
		var kelompok_tupoksi = $("#txt_kelompok_tupoksi").val();
		var kuantitas = $("#txt_kuantitas").val();
		var bobot_kerja = $("#txt_bobot_kerja").val();


		if (id == "" || tahun == "" || nip == "" || kode_jenjang == "" || no_urut_rencana == "" || narasi_rencana == "" || target_kinerja == "" || indikator_kinerja == "" || ak == "" || output_jumlah == "" || output_satuan == "" || waktu == "" || formulasi == "" || sumber_data == "" || pangkat_gol_asli == "" || no_urut_tupoksi == "" || kode_range_pangkat == "" || kode_jenjang_tupoksi == "" || mutu == "" || pangkat_aktif == "" || kelompok_tupoksi == "" || kuantitas == "" || bobot_kerja == "") {
			swal({
				title: 'Tambah Gagal',
				text: 'Ada Isian yang Belum Anda Isi !',
				icon: 'error'
			});
			return;
		}
		swal("Memproses Data.....", {
			button: false,
			closeOnClickOutside: false,
			closeOnEsc: false
		});

		$.ajax({
			url: "<?= base_url(ucfirst($idf) . '/tambah'); ?>",
			method: "POST",
			data: {
				tahun: tahun,
				nip: nip,
				kode_jenjang: kode_jenjang,
				no_urut_rencana: no_urut_rencana,
				narasi_rencana: narasi_rencana,
				target_kinerja: target_kinerja,
				indikator_kinerja: indikator_kinerja,
				ak: ak,
				output_jumlah: output_jumlah,
				output_satuan: output_satuan,
				waktu: waktu,
				biaya: biaya,
				formulasi: formulasi,
				sumber_data: sumber_data,
				pangkat_gol_asli: pangkat_gol_asli,
				no_urut_tupoksi: no_urut_tupoksi,
				kode_range_pangkat: kode_range_pangkat,
				kode_jenjang_tupoksi: kode_jenjang_tupoksi,
				mutu: mutu,
				pangkat_aktif: pangkat_aktif,
				kelompok_tupoksi: kelompok_tupoksi,
				kuantitas: kuantitas,
				bobot_kerja: bobot_kerja
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Tambah Berhasil',
						text: 'Data Rencana Kerja Pegawai Berhasil di Tambahkan',
						icon: 'success'
					}).then((Refreshh) => {
						refresh();
						tabel.ajax.reload(null, false);
					});
				} else {
					if (y == 99) {
						swal({
							title: 'Tambah Gagal',
							text: 'Anda Tidak Memiliki Akses Menambah Data Pada Menu Ini',
							icon: 'error'
						});
						refresh();
					} else {
						swal({
							title: 'Tambah Gagal',
							text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !',
							icon: 'error'
						});
					}
				}
			},
			error: function() {
				swal.close();
				swal({
					title: 'Tambah Gagal',
					text: 'Jaringan Anda Bermasalah !',
					icon: 'error'
				});
			}
		})
		$("#btntambah").attr("disabled", false);
	}

	function update() {
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

		var id = $("#txtid").val();
		var tahun = $("#txt_tahun").val();
		var nip = $("#txt_nip").val();
		var kode_jenjang = $("#txt_kode_jenjang").val();
		var no_urut_rencana = $("#txt_no_urut_rencana").val();
		var narasi_rencana = $("#txt_narasi_rencana").val();
		var target_kinerja = $("#txt_target_kinerja").val();
		var indikator_kinerja = $("#txt_indikator_kinerja").val();
		var ak = $("#txt_ak").val();
		var output_jumlah = $("#txt_output_jumlah").val();
		var output_satuan = $("#txt_output_satuan").val();
		var waktu = $("#txt_waktu").val();
		var biaya = $("#txt_biaya").val();
		var formulasi = $("#txt_formulasi").val();
		var sumber_data = $("#txt_sumber_data").val();
		var pangkat_gol_asli = $("#txt_pangkat_gol_asli").val();
		var no_urut_tupoksi = $("#txt_no_urut_tupoksi").val();
		var kode_range_pangkat = $("#txt_kode_range_pangkat").val();
		var kode_jenjang_tupoksi = $("#txt_kode_jenjang_tupoksi").val();
		var mutu = $("#txt_mutu").val();
		var pangkat_aktif = $("#txt_pangkat_aktif").val();
		var kelompok_tupoksi = $("#txt_kelompok_tupoksi").val();
		var kuantitas = $("#txt_kuantitas").val();
		var bobot_kerja = $("#txt_bobot_kerja").val();

		if (id == "" || tahun == "" || nip == "" || kode_jenjang == "" || no_urut_rencana == "" || narasi_rencana == "" || target_kinerja == "" || indikator_kinerja == "" || ak == "" || output_jumlah == "" || output_satuan == "" || waktu == "" || formulasi == "" || sumber_data == "" || pangkat_gol_asli == "" || no_urut_tupoksi == "" || kode_range_pangkat == "" || kode_jenjang_tupoksi == "" || mutu == "" || pangkat_aktif == "" || kelompok_tupoksi == "" || kuantitas == "" || bobot_kerja == "") {
			swal({
				title: 'Tambah Gagal',
				text: 'Ada Isian yang Belum Anda Isi !',
				icon: 'error'
			});
			return;
		}
		swal("Memproses Data.....", {
			button: false,
			closeOnClickOutside: false,
			closeOnEsc: false
		});



		$.ajax({
			url: "<?= base_url(ucfirst($idf) . '/update'); ?>",
			method: "POST",
			data: {
				id: id,
				tahun: tahun,
				nip: nip,
				kode_jenjang: kode_jenjang,
				no_urut_rencana: no_urut_rencana,
				narasi_rencana: narasi_rencana,
				target_kinerja: target_kinerja,
				indikator_kinerja: indikator_kinerja,
				ak: ak,
				output_jumlah: output_jumlah,
				output_satuan: output_satuan,
				waktu: waktu,
				biaya: biaya,
				formulasi: formulasi,
				sumber_data: sumber_data,
				pangkat_gol_asli: pangkat_gol_asli,
				no_urut_tupoksi: no_urut_tupoksi,
				kode_range_pangkat: kode_range_pangkat,
				kode_jenjang_tupoksi: kode_jenjang_tupoksi,
				mutu: mutu,
				pangkat_aktif: pangkat_aktif,
				kelompok_tupoksi: kelompok_tupoksi,
				kuantitas: kuantitas,
				bobot_kerja: bobot_kerja
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Update Berhasil',
						text: 'Data Rencana Kerja Pegawai Berhasil di Update',
						icon: 'success'
					}).then((Refreshh) => {
						refresh();
						tabel.ajax.reload(null, false);
					});
				} else {
					if (y == 99) {
						swal({
							title: 'Update Gagal',
							text: 'Anda Tidak Memiliki Akses Update Data Pada Menu Ini',
							icon: 'error'
						});
						refresh();
					} else {
						swal({
							title: 'Update Gagal',
							text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !',
							icon: 'error'
						});
					}
				}
			},
			error: function() {
				swal.close();
				swal({
					title: 'Update Gagal',
					text: 'Jaringan Anda Bermasalah !',
					icon: 'error'
				});
			}
		})

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}

	function hapus() {
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

		var id = $("#txtid").val();

		if (id == "") {
			swal({
				title: 'Hapus Gagal',
				text: 'ID Akun Kosong !',
				icon: 'error'
			});
			return;
		}
		swal("Memproses Data.....", {
			button: false,
			closeOnClickOutside: false,
			closeOnEsc: false
		});
		swal({
			title: 'Hapus Data',
			text: "Anda Yakin Ingin Menghapus Data Ini ?",
			icon: 'warning',
			buttons: {
				confirm: {
					text: 'Yakin',
					className: 'btn btn-success'
				},
				cancel: {
					visible: true,
					text: 'Tidak',
					className: 'btn btn-danger'
				}
			}
		}).then((Hapuss) => {
			if (Hapuss) {
				$.ajax({
					url: "<?= base_url(ucfirst($idf) . '/hapus'); ?>",
					method: "POST",
					data: {
						id: id
					},
					cache: "false",
					success: function(x) {
						swal.close();
						var y = atob(x);
						if (y == 1) {
							swal({
								title: 'Hapus Berhasil',
								text: 'Data Rencana Kerja Pegawai Berhasil di Hapus',
								icon: 'success'
							}).then((Refreshh) => {
								refresh();
								tabel.ajax.reload(null, false);
							});
						} else {
							if (y == 99) {
								swal({
									title: 'Hapus Gagal',
									text: 'Anda Tidak Memiliki Akses Menghapus Data Pada Menu Ini',
									icon: 'error'
								});
								refresh();
							} else {
								if (y == 90) {
									swal({
										title: 'Hapus Gagal',
										text: 'Data Menu Ini Masih digunakan dalam Data Log History, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah',
										icon: 'error'
									});
									refresh();
								} else {
									swal({
										title: 'Hapus Gagal',
										text: 'Periksa Kembali Data Yang Anda Pilih !',
										icon: 'error'
									});
								}
							}
						}
					},
					error: function() {
						swal.close();
						swal({
							title: 'Hapus Gagal',
							text: 'Jaringan Anda Bermasalah !',
							icon: 'error'
						});
					}
				})
			} else {
				swal.close();
			}
		});

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}

	function filter(el) {
		var id = $(el).data("id");
		swal("Memproses Data.....", {
			button: false,
			closeOnClickOutside: false,
			closeOnEsc: false
		});
		$.ajax({
			url: "<?= base_url($idf . '/filter'); ?>",
			method: "POST",
			data: {
				id: id
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				var xx = y.split("|");
				if (xx[0] == 1) {
					$("#txtid").val(xx[1]);
					$("#txt_tahun").val(xx[2]);
					$("#txt_nip").val(xx[3]);
					$("#txt_kode_jenjang").val(xx[4]).change();
					$("#txt_no_urut_rencana").val(xx[5]);
					$("#txt_narasi_rencana").val(xx[6]);
					$("#txt_target_kinerja").val(xx[7]);
					$("#txt_indikator_kinerja").val(xx[8]);
					$("#txt_ak").val(xx[9]);
					$("#txt_output_jumlah").val(xx[10]);
					$("#txt_output_satuan").val(xx[11]);
					$("#txt_waktu").val(xx[12]);
					$("#txt_biaya").val(xx[12]);
					$("#txt_formulasi").val(xx[13]);
					$("#txt_sumber_data").val(xx[14]);
					$("#txt_pangkat_gol_asli").val(xx[15]);
					$("#txt_no_urut_tupoksi").val(xx[16]);
					$("#txt_kode_range_pangkat").val(xx[17]);
					$("#txt_kode_jenjang_tupoksi").val(xx[18]);
					$("#txt_mutu").val(xx[19]);
					$("#txt_pangkat_aktif").val(xx[20]);
					$("#txt_kelompok_tupoksi").val(xx[21]);
					$("#txt_kuantitas").val(xx[22]);
					$("#txt_bobot_kerja").val(xx[23]);
					$("#lbljudul").html('Form Kelola Data');
					$("#txtid").attr("readonly", true);
					$("#bloktombol").html('\
						<button type="button" class="btn btn-info" id="btnupdate" onclick="update()">Update</button>\
						<button type="button" class="btn btn-danger" id="btnhapus" onclick="hapus()">Hapus</button>\
						<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>\
					');
				} else {
					swal({
						title: 'Update Gagal',
						text: 'Data Tidak di Temukan',
						icon: 'error'
					});
					refresh();
				}
			},
			error: function() {
				swal.close();
				swal({
					title: 'Filter Gagal',
					text: 'Jaringan Anda Bermasalah !',
					icon: 'error'
				});
			}
		})
	}
</script>