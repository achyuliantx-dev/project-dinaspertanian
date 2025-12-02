<div class="page-header">
	<h1 class="page-title">Pengelolaan Data IPW Desa</h1>
	<div class="page-header-actions">
		<div class="btn-group btn-group-sm" id="withBtnGroup" aria-label="Page Header Actions" role="group">
			<button type="button" class="btn btn-primary">
				<i class="icon <?= $icform; ?>" aria-hidden="true"></i>
				<span class="hidden-sm-down">Kode Form: <?= $idf; ?></span>
			</button>
			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-original-title="Refresh Data" data-container="body" onclick="refreshdata()">
				<i class="icon wb-loop" aria-hidden="true"></i>
			</button>
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
							<th style="width: 10%;">ID</th>
							<th>Nama IPW Desa</th>
							<th>Desa</th>
							<th>Kecamatan</th>
							<th>Batas Utara Desa</th>
							<<th>Batas Timur Desa</th>
							<th>Batas Selatan Desa</th>
							<th>Batas Barat Desa</th>
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
						<label class="form-control-label">ID IPW Desa*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Nama IPW Desa*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtnama" value=""  autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Desa</label>
						<select class="form-control select2" id="cbodes">
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
						<select class="form-control select2" id="cbokec">
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
						<label class="form-control-label" style="margin-bottom: -5px;">Batas Utara Desa</label>
						<select class="form-control select2" id="cbobud">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtdes)) {
								if (count($dtdes) > 0) {
									foreach ($dtdes as $x) {
										echo "<option value='" . $x->nama . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Batas Timur Desa</label>
						<select class="form-control select2" id="cbobtd">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtdes)) {
								if (count($dtdes) > 0) {
									foreach ($dtdes as $x) {
										echo "<option value='" . $x->nama . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Batas Selatan Desa</label>
						<select class="form-control select2" id="cbobsd">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtdes)) {
								if (count($dtdes) > 0) {
									foreach ($dtdes as $x) {
										echo "<option value='" . $x->nama . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Batas Barat Desa</label>
						<select class="form-control select2" id="cbobbd">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtdes)) {
								if (count($dtdes) > 0) {
									foreach ($dtdes as $x) {
										echo "<option value='" . $x->nama . "'>" . $x->nama . "</option>";
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
	var idmenu = "<?= $idmskr; ?>";
	var idform = "<?= ucfirst($idf); ?>";
	$("#tpm" + idmenu).addClass("active");
	$("#stpm" + idform).addClass("active");

	swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
	var tabel = $('#tbl-xdt').DataTable({
		"ajax": "<?= base_url(ucfirst($idf).'/json'); ?>",
		"fnDrawCallback": function(oSettings){swal.close();}
	});

	refresh();

	function refreshdata(){
		swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		tabel.ajax.reload(null, false);
	}

	function refresh() {
		$("#txtid").val("Otomatis By System");
		$("#txtnama").val("");
		$("#cbodes").val("").change();
		$("#cbokec").val("").change();
		$("#cbobud").val("").change();
		$("#cbobtd").val("").change();
		$("#cbobsd").val("").change();
		$("#cbobbd").val("").change();
		$("#lbljudul").html('Form Tambah Data');
		$("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function tambah() {
		$("#btntambah").attr("disabled", true);
		var id = $("#txtid").val();
		var nama = $("#txtnama").val();
		var desa = $("#cbodes").val();
		var kec = $("#cbokec").val();
		var bud = $("#cbobud").val();
		var btd = $("#cbobtd").val();
		var bsd = $("#cbobsd").val();
		var bbd = $("#cbobbd").val();

		if (id == "" || nama == "" || desa == "" || kec == "" || bud == ""  || btd == "" || bsd == ""|| bbd == "" ) {
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
				nama: nama,
				desa: desa,
				kec: kec,
				bud: bud,
				btd: btd,
				bsd: bsd,	
				bbd: bbd
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Tambah Berhasil',
						text: 'Data IPW Desa Berhasil di Tambahkan',
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
		var desa = $("#cbodes").val();
		var kec = $("#cbokec").val();
		var bud = $("#cbobud").val();
		var btd = $("#cbobtd").val();
		var bsd = $("#cbobsd").val();
		var bbd = $("#cbobbd").val();

		if (id == "" || nama == "" || desa == "" || kec == "" || bud == ""  || btd == "" || bsd == ""|| bbd == "" ) {
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
				nama: nama,
				desa: desa,
				kec: kec,
				bud: bud,
				btd: btd,
				bsd: bsd,	
				bbd: bbd
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Update Berhasil',
						text: 'Data IPW Desa Berhasil di Update',
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
								text: 'Data IPW Desa Berhasil di Hapus',
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
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		$.ajax({
            url: "<?= base_url($idf.'/filter'); ?>",
            method: "POST",
            data: {id: id},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
				var xx = y.split("|");
				if(xx[0] == 1){
					$("#txtid").val(xx[1]);
					$("#txtnama").val(xx[2]);
					$("#cbodes").val(xx[3]).change();
					$("#cbokec").val(xx[4]).change();
					$("#cbobud").val(xx[5]).change();
					$("#cbobtd").val(xx[6]).change();
					$("#cbobsd").val(xx[7]).change();
					$("#cbobbd").val(xx[8]).change();
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