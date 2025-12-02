<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Sarana Alsintan</h1>
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
							<th>ID</th>
							<th>No Urut</th>
							<th>Nama Poktan</th>
							<th>Jenis Alsintan</th>
							<th>Jumlah Total</th>
							<th>Milik Pribadi</th>
							<th>Milik Kelompok</th>
							<th>Jumlah Baik</th>
							<th>Jumlah Buruk</th>
							<th>Tahun</th>
							<th>Poktan</th>
							<th>Desa</th>
							<th>Kecamatan</th>
							<th>IPW Desa</th>
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
						<label class="form-control-label">ID Sarana Alsintan*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">No Urut*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_no_urut" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Nama Poktan*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_nama_poktan" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Jenis Alsintan*</label>
						<select class="form-control select2" id="txt_jenis_alinstan">
							<option value="">Silahkan Pilih</option>
							<option value="Pompa Air">Pompa Air</option>
							<option value="TR-2">TR-2</option>
							<option value="TR-4">TR-4</option>
							<option value="Mesin Tanam">Mesin Tanam</option>
							<option value="Combine Kecil">Combine Kecil</option>
							<option value="Combine Sedang">Combine Sedang</option>
							<option value="Combine Besar">Combine Besar</option>
							<option value="Spayer">Spayer</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jumlah Total*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_jumlah_total" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Milik Pribadi*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_milik_pribadi" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Milik Kelompok*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_milik_kelompok" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jumlah Baik*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_jumlah_baik" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jumlah Buruk*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_jumlah_buruk" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tahun*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txt_tahun" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Poktan</label>
						<select class="form-control select2" id="txt_id_poktan">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtpoktan)) {
								if (count($dtpoktan) > 0) {
									foreach ($dtpoktan as $x) {
										echo "<option value='" . $x->id . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Desa</label>
						<select class="form-control select2" id="txt_id_desa">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtdes)) {
								if (count($dtdes) > 0) {
									foreach ($dtdes as $x) {
										echo "<option value='" . $x->id . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Kecamatan</label>
						<select class="form-control select2" id="txt_id_kecamatan">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtkec)) {
								if (count($dtkec) > 0) {
									foreach ($dtkec as $x) {
										echo "<option value='" . $x->id . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">IPW Desa</label>
						<select class="form-control select2" id="txt_id_ipwdes">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtipwdes)) {
								if (count($dtipwdes) > 0) {
									foreach ($dtipwdes as $x) {
										echo "<option value='" . $x->id . "'>" . $x->nama_ketua . "</option>";
									}
								}
							}
							?>
						</select>
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
		$("#txt_no_urut").val("");
		$("#txt_nama_poktan").val("");
		$("#txt_jenis_alinstan").val("").change();
		$("#txt_jumlah_total").val("");
		$("#txt_milik_pribadi").val("");
		$("#txt_milik_kelompok").val("");
		$("#txt_jumlah_baik").val("");
		$("#txt_jumlah_buruk").val("");
		$("#txt_tahun").val("");
		$("#txt_id_poktan").val("").change();
		$("#txt_id_desa").val("").change();
		$("#txt_id_kecamatan").val("").change();
		$("#txt_id_ipwdes").val("").change();
		$("#lbljudul").html('Form Tambah Data');
		$("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function tambah() {
		$("#btntambah").attr("disabled", true);
		var id = $("#txtid").val();

		var no_urut = $("#txt_no_urut").val();
		var nama_poktan = $("#txt_nama_poktan").val();
		var jenis_alinstan = $("#txt_jenis_alinstan").val();
		var jumlah_total = $("#txt_jumlah_total").val();
		var milik_pribadi = $("#txt_milik_pribadi").val();
		var milik_kelompok = $("#txt_milik_kelompok").val();
		var jumlah_baik = $("#txt_jumlah_baik").val();
		var jumlah_buruk = $("#txt_jumlah_buruk").val();
		var tahun = $("#txt_tahun").val();
		var id_poktan = $("#txt_id_poktan").val();
		var id_desa = $("#txt_id_desa").val();
		var id_kecamatan = $("#txt_id_kecamatan").val();
		var id_ipwdes = $("#txt_id_ipwdes").val();


		if (no_urut == "" || nama_poktan == "" || jenis_alinstan == "" || jumlah_total == "" || milik_pribadi == "" || milik_kelompok == "" || jumlah_baik == "" || jumlah_buruk == "" || tahun == "" || id_poktan == "" || id_desa == "" || id_kecamatan == "" || id_ipwdes == "") {
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
				no_urut: no_urut,
				nama_poktan: nama_poktan,
				jenis_alinstan: jenis_alinstan,
				jumlah_total: jumlah_total,
				milik_pribadi: milik_pribadi,
				milik_kelompok: milik_kelompok,
				jumlah_baik: jumlah_baik,
				jumlah_buruk: jumlah_buruk,
				tahun: tahun,
				id_poktan: id_poktan,
				id_des: id_desa,
				id_kec: id_kecamatan,
				id_tkr_kode_ipwdes: id_ipwdes
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Tambah Berhasil',
						text: 'Data Sarana Alsintan Berhasil di Tambahkan',
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
		var no_urut = $("#txt_no_urut").val();
		var nama_poktan = $("#txt_nama_poktan").val();
		var jenis_alinstan = $("#txt_jenis_alinstan").val();
		var jumlah_total = $("#txt_jumlah_total").val();
		var milik_pribadi = $("#txt_milik_pribadi").val();
		var milik_kelompok = $("#txt_milik_kelompok").val();
		var jumlah_baik = $("#txt_jumlah_baik").val();
		var jumlah_buruk = $("#txt_jumlah_buruk").val();
		var tahun = $("#txt_tahun").val();
		var id_poktan = $("#txt_id_poktan").val();
		var id_desa = $("#txt_id_desa").val();
		var id_kecamatan = $("#txt_id_kecamatan").val();
		var id_ipwdes = $("#txt_id_ipwdes").val();


		if (no_urut == "" || nama_poktan == "" || jenis_alinstan == "" || jumlah_total == "" || milik_pribadi == "" || milik_kelompok == "" || jumlah_baik == "" || jumlah_buruk == "" || tahun == "" || id_poktan == "" || id_desa == "" || id_kecamatan == "" || id_ipwdes == "") {
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
				no_urut: no_urut,
				nama_poktan: nama_poktan,
				jenis_alinstan: jenis_alinstan,
				jumlah_total: jumlah_total,
				milik_pribadi: milik_pribadi,
				milik_kelompok: milik_kelompok,
				jumlah_baik: jumlah_baik,
				jumlah_buruk: jumlah_buruk,
				tahun: tahun,
				id_poktan: id_poktan,
				id_des: id_desa,
				id_kec: id_kecamatan,
				id_tkr_kode_ipwdes: id_ipwdes
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Update Berhasil',
						text: 'Data Sarana Alsintan Berhasil di Update',
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
								text: 'Data Sarana Alsintan Berhasil di Hapus',
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
					$("#txt_no_urut").val(xx[2]);
					$("#txt_nama_poktan").val(xx[3]);
					$("#txt_jenis_alinstan").val(xx[4]).change();
					$("#txt_jumlah_total").val(xx[5]);
					$("#txt_milik_pribadi").val(xx[6]);
					$("#txt_milik_kelompok").val(xx[7]);
					$("#txt_jumlah_baik").val(xx[8]);
					$("#txt_jumlah_buruk").val(xx[9]);
					$("#txt_tahun").val(xx[10]);
					$("#txt_id_poktan").val(xx[11]).change();
					$("#txt_id_desa").val(xx[12]).change();
					$("#txt_id_kecamatan").val(xx[13]).change();
					$("#txt_id_ipwdes").val(xx[14]).change();
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