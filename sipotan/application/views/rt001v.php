<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Rantai Pangkat</h1>
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
							<th>Range Pangkat</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xxl-3 col-lg-3 col-md-3">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title" id="lbljudul">Form Tambah Data</h3>
			</div>
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label class="form-control-label">ID Range Pangkat*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Nama Range Pangkat*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnama" placeholder="Masukkan Nama Ranatai Pasar" autocomplete="off">
					</div>
					<div class="form-group col-md-12" id="bloktombol"></div>
				</div>
			</div>
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
		$("#txtnama").val("");
		$("#lbljudul").html('Form Tambah Data');
		$("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function tambah() {
		$("#btntambah").attr("disabled", true);
		var id = $("#txtid").val();
		var nama = $("#txtnama").val();

		if (id == "" || nama == "") {
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
				nama: nama
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Tambah Berhasil',
						text: 'Data Range Pangkat Berhasil di Tambahkan',
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
		var nama = $("#txtnama").val();
		if (id == "" || nama == "") {
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
				nama: nama
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Update Berhasil',
						text: 'Data Range Pangkat Berhasil di Update',
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
				text: 'ID Range Pangkat Kosong !',
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
								text: 'Data Range Pangkat Berhasil di Hapus',
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
					$("#txtnama").val(xx[2]);
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