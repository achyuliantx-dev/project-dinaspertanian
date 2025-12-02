<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Masalah</h1>
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
							<th>Jenis Masalah</th>
							<th>Komoditas</th>
							<th>Luas Lahan</th>
							<th>Tipe Masalah</th>
							<th>Tahun</th>
							<th>Kecamatan</th>
							<th>IPW Desa</th>
							<th>Desa</th>
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
						<label class="form-control-label">ID Masalah*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Jenis Masalah</label>
						<select class="form-control select2" id="cbojen">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtopt)) {
								if (count($dtopt) > 0) {
									foreach ($dtopt as $x) {
										echo "<option value='" . $x->id_opt . "'>" . $x->nama_opt . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Komoditas</label>
						<select class="form-control select2" id="cbokom">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtkom)) {
								if (count($dtkom) > 0) {
									foreach ($dtkom as $x) {
										echo "<option value='" . $x->id . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Luas Lahan Ha*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtjml" placeholder="Masukkan Luas Lahan" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Tipe Masalah</label>
						<select class="form-control select2" id="cbotipe">
							<option value="">Silahkan Pilih</option>
							<option value="Bencana Alam">Bencana Alam</option>
							<option value="Hama">Hama</option>
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
						<label class="form-control-label" style="margin-bottom: -5px;">IPW Desa</label>
						<select class="form-control select2" id="cbobuk">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtipw)) {
								if (count($dtipw) > 0) {
									foreach ($dtipw as $x) {
										echo "<option value='" . $x->id . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Tahun</label>
						<select class="form-control select2" id="cbobtk">
							<option value="">Silahkan Pilih</option>
							<?php
							if (is_array($dtta)) {
								if (count($dtta) > 0) {
									foreach ($dtta as $x) {
										echo "<option value='" . $x->id . "'>" . $x->nama . "</option>";
									}
								}
							}
							?>
						</select>
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
		$("#cbojen").val("").change();
		$("#cbokom").val("").change();
		$("#txtjml").val("");
		$("#cbotipe").val("").change();
		$("#cbobtk").val("").change();
		$("#cbokec").val("").change();
		$("#cbobuk").val("").change();
		$("#cbodes").val("").change();
		$("#lbljudul").html('Form Tambah Data');
		$("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function tambah() {
		$("#btntambah").attr("disabled", true);
		var id = $("#txtid").val();
		var masalah = $("#cbojen").val();
		var komoditas = $("#cbokom").val();
		var luas = $("#txtjml").val();
		var tipe = $("#cbotipe").val();
		var thn = $("#cbobtk").val();
		var cam = $("#cbokec").val();
		var ipw = $("#cbobuk").val();
		var desa = $("#cbodes").val();

		if (id == "" || masalah == "" || komoditas == ""  || luas == "" || tipe == ""|| thn == "" || cam == "" || ipw == ""|| desa == "" ) {
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
				masalah: masalah,
				komoditas: komoditas,
				luas: luas,
				tipe: tipe,	
				thn: thn,
				cam: cam,
				ipw: ipw,
				desa: desa
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Tambah Berhasil',
						text: 'Data Masalah Berhasil di Tambahkan',
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
		var masalah = $("#cbojen").val();
		var komoditas = $("#cbokom").val();
		var luas = $("#txtjml").val();
		var tipe = $("#cbotipe").val();
		var thn = $("#cbobtk").val();
		var cam = $("#cbokec").val();
		var ipw = $("#cbobuk").val();
		var desa = $("#cbodes").val();

		if (id == "" || masalah == "" || komoditas == ""  || luas == "" || tipe == ""|| thn == "" || cam == "" || ipw == ""|| desa == "" ){

			swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            $("#btnupdate").attr("disabled", false);
			$("#btnhapus").attr("disabled", false);
			$("#btnrefresh").attr("disabled", false);
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
			data: {
				id: id,
				masalah: masalah,
				komoditas: komoditas,
				luas: luas,
				tipe: tipe,	
				thn: thn,
				cam: cam,
				ipw: ipw,
				desa: desa
			},
			cache: "false",
			success: function(x) {
				swal.close();
				var y = atob(x);
				if (y == 1) {
					swal({
						title: 'Update Berhasil',
						text: 'Data Masalah Berhasil di Update',
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
								text: 'Data Masalah Berhasil di Hapus',
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
					$("#cbojen").val(xx[2]).change();
					$("#cbokom").val(xx[3]).change();
					$("#txtjml").val(xx[4]);
					$("#cbotipe").val(xx[5]).change();
					$("#cbobtk").val(xx[6]).change();
					$("#cbokec").val(xx[7]).change();
					$("#cbobuk").val(xx[8]).change();
					$("#cbodes").val(xx[9]).change();
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