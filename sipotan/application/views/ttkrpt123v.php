<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Aplikasi MOL</h1>
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
	<div class="col-xxl-6 col-lg-6 col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title" id="lbljudul">Form</h3>
			</div>
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label class="form-control-label">ID*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Kode Lahan*</label>
						<select class="form-control select2" id="cboid_lahan">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtnop)) {
								if (count($dtnop) > 0) {
									foreach ($dtnop as $x) {
										echo "<option value='" . $x->id_lahan . "'>" . $x->id_lahan . " | " . $x->nama_bpp . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi MOL 1 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uam1" placeholder="Masukkan Umur Aplikasi MOL 1" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi MOL 1 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dam1" placeholder="Masukkan Dosis Aplikasi MOL 1" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi MOL 2 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uam2" placeholder="Masukkan Umur Aplikasi MOL 2" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi MOL 2 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dam2" placeholder="Masukkan Dosis Aplikasi MOL 2" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xxl-6 col-lg-6 col-md-6">
		<div class="panel">
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi MOL 3 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uam3" placeholder="Masukkan Umur Aplikasi MOL 3" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi MOL 3 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dam3" placeholder="Masukkan Dosis Aplikasi MOL 3" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi MOL 4 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uam4" placeholder="Masukkan Umur Aplikasi MOL 4" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi MOL 4 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dam4" placeholder="Masukkan Dosis Aplikasi MOL 4" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi MOL 5 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uam5" placeholder="Masukkan Umur Aplikasi MOL 5" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi MOL 5 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dam5" placeholder="Masukkan Dosis Aplikasi MOL 5" autocomplete="off">
					</div>
					<div class="form-group col-md-12" id="bloktombol"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xxl-12 col-lg-12 col-md-12">
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
						<th>Kode Lahan</th>
						<th>Umur Aplikasi MOL 1</th>
						<th>Dosis Aplikasi MOL 1</th>
						<th>Umur Aplikasi MOL 2</th>
						<th>Dosis Aplikasi MOL 2</th>
						<th>Umur Aplikasi MOL 3</th>
						<th>Dosis Aplikasi MOL 3</th>
						<th>Umur Aplikasi MOL 4</th>
						<th>Dosis Aplikasi MOL 4</th>
						<th>Umur Aplikasi MOL 5</th>
						<th>Dosis Aplikasi MOL 5</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>



<script>
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
		$("#cboid_lahan").val("").change();
		$("#uam1").val("");
		$("#dam1").val("");
		$("#uam2").val("");
		$("#dam2").val("");
		$("#uam3").val("");
		$("#dam3").val("");
		$("#uam4").val("");
		$("#dam4").val("");
		$("#uam5").val("");
		$("#dam5").val("");
		$("#lbljudul").html('Form Tambah Data');
		$("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function tambah() {
		$("#btntambah").attr("disabled", true);
		var id = $("#txtid").val();
		var id_lahan = $("#cboid_lahan").val();
		var uam1 = $("#uam1").val();
		var dam1 = $("#dam1").val();
		var uam2 = $("#uam2").val();
		var dam2 = $("#dam2").val();
		var uam3 = $("#uam3").val();
		var dam3 = $("#dam3").val();
		var uam4 = $("#uam4").val();
		var dam4 = $("#dam4").val();
		var uam5 = $("#uam5").val();
		var dam5 = $("#dam5").val();

		if (id == "" || id_lahan == "" || uam1 == "" || dam1 == "" || uam2 == "" || dam2 == "" || uam3 == "" || dam3 == "" || uam4 == "" || dam4 == "" || uam5 == "" || dam5 == "") {
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
				id: id,
				id_lahan: id_lahan,
				uam1: uam1,
				dam1: dam1,
				uam2: uam2,
				dam2: dam2,
				uam3: uam3,
				dam3: dam3,
				uam4: uam4,
				dam4: dam4,
				uam5: uam5,
				dam5: dam5
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Tambah Berhasil',
						text: 'Data Tabel Aplikasi MOL Berhasil di Tambahkan',
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
		var id_lahan = $("#cboid_lahan").val();
		var uam1 = $("#uam1").val();
		var dam1 = $("#dam1").val();
		var uam2 = $("#uam2").val();
		var dam2 = $("#dam2").val();
		var uam3 = $("#uam3").val();
		var dam3 = $("#dam3").val();
		var uam4 = $("#uam4").val();
		var dam4 = $("#dam4").val();
		var uam5 = $("#uam5").val();
		var dam5 = $("#dam5").val();

		if (id == "" || id_lahan == "" || uam1 == "" || dam1 == "" || uam2 == "" || dam2 == "" || uam3 == "" || dam3 == "" || uam4 == "" || dam4 == "" || uam5 == "" || dam5 == "") {
			swal({
				title: 'Update Gagal',
				text: 'Ada Isian yang Belum Anda Isi !',
				icon: 'error'
			});
			$("#btnupdate").attr("disabled", false);
			$("#btnhapus").attr("disabled", false);
			$("#btnrefresh").attr("disabled", false);
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
				id_lahan: id_lahan,
				uam1: uam1,
				dam1: dam1,
				uam2: uam2,
				dam2: dam2,
				uam3: uam3,
				dam3: dam3,
				uam4: uam4,
				dam4: dam4,
				uam5: uam5,
				dam5: dam5
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Update Berhasil',
						text: 'Data Tabel Aplikasi MOL Berhasil di Update',
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
								text: 'Data Tabel Aplikasi MOL Berhasil di Hapus',
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
					$("#cboid_lahan").val(xx[2]).change();
					$("#uam1").val(xx[3]);
					$("#dam1").val(xx[4]);
					$("#uam2").val(xx[5]);
					$("#dam2").val(xx[6]);
					$("#uam3").val(xx[7]);
					$("#dam3").val(xx[8]);
					$("#uam4").val(xx[9]);
					$("#dam4").val(xx[10]);
					$("#uam5").val(xx[11]);
					$("#dam5").val(xx[12]);
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