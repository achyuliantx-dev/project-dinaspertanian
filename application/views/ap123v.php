<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Aplikasi POC</h1>
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
	<div class="col-xxl-6 col-lg-6 col-md-6">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form</h3></div>
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
								if(is_array($dtnop)){
									if(count($dtnop)>0){
										foreach($dtnop as $x){
											echo "<option value='".$x->id_lahan."'>".$x->id_lahan." | $x->nama_bpp</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi POC 1 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uap1" placeholder="Masukkan Umur Aplikasi POC 1" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi POC 1 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dap1" placeholder="Masukkan Dosis Aplikasi POC 1" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi POC 2 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uap2" placeholder="Masukkan Umur Aplikasi POC 2" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi POC 2 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dap2" placeholder="Masukkan Dosis Aplikasi POC 2" autocomplete="off">
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
						<label class="form-control-label">Umur Aplikasi POC 3 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uap3" placeholder="Masukkan Umur Aplikasi POC 3" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi POC 3 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dap3" placeholder="Masukkan Dosis Aplikasi POC 3" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi POC 4 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uap4" placeholder="Masukkan Umur Aplikasi POC 4" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi POC 4 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dap4" placeholder="Masukkan Dosis Aplikasi POC 4" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Aplikasi POC 5 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="uap5" placeholder="Masukkan Umur Aplikasi POC 5" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Dosis Aplikasi POC 5 *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="dap5" placeholder="Masukkan Dosis Aplikasi POC 5" autocomplete="off">
					</div>
					<div class="form-group col-md-12" id="bloktombol"></div>
                </div>
			</div>
		</div>
	</div>
</div>
<div class="col-xxl-12 col-lg-12 col-md-12">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title">Data</h3></div>
			<div class="panel-body">
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 10%;">Aksi</th>
							<th style="width: 15%;">ID</th>
							<th>Kode Lahan</th>
							<th>Umur Aplikasi POC 1</th>
							<th>Dosis Aplikasi POC 1</th>
							<th>Umur Aplikasi POC 2</th>
							<th>Dosis Aplikasi POC 2</th>
							<th>Umur Aplikasi POC 3</th>
							<th>Dosis Aplikasi POC 3</th>
							<th>Umur Aplikasi POC 4</th>
							<th>Dosis Aplikasi POC 4</th>
							<th>Umur Aplikasi POC 5</th>
							<th>Dosis Aplikasi POC 5</th>
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
	
	function refresh(){
        $("#txtid").val("Otomatis By System");
        $("#cboid_lahan").val("").change();
        $("#uap1").val("");
        $("#dap1").val("");
        $("#uap2").val("");
        $("#dap2").val("");
        $("#uap3").val("");
        $("#dap3").val("");
        $("#uap4").val("");
        $("#dap4").val("");
        $("#uap5").val("");
        $("#dap5").val("");
        $("#lbljudul").html('Form Tambah Data');
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
        var id_lahan = $("#cboid_lahan").val();
        var uap1 = $("#uap1").val();
        var dap1 = $("#dap1").val();
        var uap2 = $("#uap2").val();
        var dap2 = $("#dap2").val();
        var uap3 = $("#uap3").val();
        var dap3 = $("#dap3").val();
        var uap4 = $("#uap4").val();
        var dap4 = $("#dap4").val();
        var uap5 = $("#uap5").val();
        var dap5 = $("#dap5").val();
		
        if(id == "" || id_lahan == "" || uap1 == "" || dap1 == "" || uap2 == "" || dap2 == ""|| uap3 == "" || dap3 == ""|| uap4 == "" || dap4 == ""|| uap5 == "" || dap5 == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, id_lahan: id_lahan, uap1: uap1, dap1: dap1, uap2: uap2, dap2: dap2, uap3: uap3, dap3: dap3, uap4: uap4, dap4: dap4, uap5: uap5, dap5: dap5},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Tabel Aplikasi POC Berhasil di Tambahkan',
						icon: 'success'
					}).then((Refreshh)=>{
						refresh();
						tabel.ajax.reload(null, false);
					});
                }else{
					if(y == 99){
						swal({title: 'Tambah Gagal', text: 'Anda Tidak Memiliki Akses Menambah Data Pada Menu Ini', icon: 'error'});
						refresh();
					}else{
						swal({title: 'Tambah Gagal', text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !', icon: 'error'});
					}
                }
            },
			error: function(){
				swal.close();
				swal({title: 'Tambah Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
		$("#btntambah").attr("disabled", false);
	}

	function update(){
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

       	var id = $("#txtid").val();
        var id_lahan = $("#cboid_lahan").val();
        var uap1 = $("#uap1").val();
        var dap1 = $("#dap1").val();
        var uap2 = $("#uap2").val();
        var dap2 = $("#dap2").val();
        var uap3 = $("#uap3").val();
        var dap3 = $("#dap3").val();
        var uap4 = $("#uap4").val();
        var dap4 = $("#dap4").val();
        var uap5 = $("#uap5").val();
        var dap5 = $("#dap5").val();
		
        if(id == "" || id_lahan == "" || uap1 == "" || dap1 == "" || uap2 == "" || dap2 == ""|| uap3 == "" || dap3 == ""|| uap4 == "" || dap4 == ""|| uap5 == "" || dap5 == ""){
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
            data: {id: id, id_lahan: id_lahan, uap1: uap1, dap1: dap1, uap2: uap2, dap2: dap2, uap3: uap3, dap3: dap3, uap4: uap4, dap4: dap4, uap5: uap5, dap5: dap5},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Tabel Aplikasi POC Berhasil di Update',
						icon: 'success'
					}).then((Refreshh)=>{
						refresh();
						tabel.ajax.reload(null, false);
					});
                }else{
					if(y == 99){
						swal({title: 'Update Gagal', text: 'Anda Tidak Memiliki Akses Update Data Pada Menu Ini', icon: 'error'});
						refresh();
					}else{
						swal({title: 'Update Gagal', text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !', icon: 'error'});
					}
                }
            },
			error: function(){
				swal.close();
				swal({title: 'Update Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}

	function hapus(){
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

        var id = $("#txtid").val();
    
        if(id == ""){
            swal({title: 'Hapus Gagal', text: 'ID Akun Kosong !', icon: 'error'});
            return;
		}
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		swal({
			title: 'Hapus Data',
			text: "Anda Yakin Ingin Menghapus Data Ini ?",
			icon: 'warning',
			buttons:{
				confirm: {text : 'Yakin', className : 'btn btn-success'},
				cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
			}
		}).then((Hapuss)=>{
			if(Hapuss){
				$.ajax({
					url: "<?= base_url(ucfirst($idf).'/hapus'); ?>",
					method: "POST",
					data: {id: id},
					cache: "false",
					success: function(x){
						swal.close();
						var y = atob(x);
						if(y == 1){
							swal({
								title: 'Hapus Berhasil',
								text: 'Data Tabel Aplikasi POC Berhasil di Hapus',
								icon: 'success'
							}).then((Refreshh)=>{
								refresh();
								tabel.ajax.reload(null, false);
							});
						}else{
							if(y == 99){
								swal({title: 'Hapus Gagal', text: 'Anda Tidak Memiliki Akses Menghapus Data Pada Menu Ini', icon: 'error'});
								refresh();
							}else{
								if(y == 90){
									swal({title: 'Hapus Gagal', text: 'Data Menu Ini Masih digunakan dalam Data Log History, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah', icon: 'error'});
									refresh();
								}else{
									swal({title: 'Hapus Gagal', text: 'Periksa Kembali Data Yang Anda Pilih !', icon: 'error'});
								}
							}
						}
					},
					error: function(){
						swal.close();
						swal({title: 'Hapus Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
					}
				})
			}else{swal.close();}
		});

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}
	
	function filter(el){
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
					$("#cboid_lahan").val(xx[2]).change();
					$("#uap1").val(xx[3]);
					$("#dap1").val(xx[4]);
					$("#uap2").val(xx[5]);
					$("#dap2").val(xx[6]);
					$("#uap3").val(xx[7]);
					$("#dap3").val(xx[8]);
					$("#uap4").val(xx[9]);
					$("#dap4").val(xx[10]);
					$("#uap5").val(xx[11]);
					$("#dap5").val(xx[12]);
					$("#lbljudul").html('Form Kelola Data');
					$("#txtid").attr("readonly", true);
					$("#bloktombol").html('\
						<button type="button" class="btn btn-info" id="btnupdate" onclick="update()">Update</button>\
						<button type="button" class="btn btn-danger" id="btnhapus" onclick="hapus()">Hapus</button>\
						<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>\
					');
				}else{
					swal({title: 'Update Gagal', text: 'Data Tidak di Temukan', icon: 'error'});
					refresh();
				}
            },
			error: function(){
				swal.close();
				swal({title: 'Filter Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
    }

	
</script>
			