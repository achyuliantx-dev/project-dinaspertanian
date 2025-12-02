<div class="page-header">
	<h1 class="page-title" style="text-align:center;">Pengelolaan Data Penyiangan</h1>
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
	<div class="col-xxl-12 col-lg-12 col-md-12" >
		<div class="panel" style="margin-left:220px; margin-right: 220px;">
			<div class="panel-heading"><h3 class="panel-title" id="lbljudul" style="text-align: center;">Form</h3></div>
			<div class="panel-body">
				<div class="form-row">
                     <div class="form-group col-md-12">
						<label class="form-control-label">ID Penyiangan*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">ID Lahan*</label>
						<select class="form-control select2" id="cbolahan">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtlahan)){
									if(count($dtlahan)>0){
										foreach($dtlahan as $x){
											echo "<option value='".$x->id_lahan."'>".$x->id_lahan." | ".$x->nama_bpp."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Penyiangan I*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtu1" placeholder="Masukkan Umur Penyiangan I" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Alat Penyiangan I*</label>
						<select class="form-control select2" id="cboa1">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtalat)){
									if(count($dtalat)>0){
										foreach($dtalat as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Penyiangan II*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtu2" placeholder="Masukkan Umur Penyiangan II" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Alat Penyiangan II*</label>
						<select class="form-control select2" id="cboa2">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtalat)){
									if(count($dtalat)>0){
										foreach($dtalat as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Penyiangan III*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtu3" placeholder="Masukkan Umur Penyiangan III" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Alat Penyiangan III*</label>
						<select class="form-control select2" id="cboa3">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtalat)){
									if(count($dtalat)>0){
										foreach($dtalat as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Umur Penyiangan IV*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtu4" placeholder="Masukkan Umur Penyiangan IV" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Alat Penyiangan IV*</label>
						<select class="form-control select2" id="cboa4">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtalat)){
									if(count($dtalat)>0){
										foreach($dtalat as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
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
<div class="row">
	<div class="col-xxl-12 col-lg-12 col-md-12">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title">Data</h3></div>
			<div class="panel-body">
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 10%;">Aksi</th>
							<th style="width: 15%;">ID</th>
							<th>ID Lahan</th>
							<th>Umur Penyiangan I</th>
							<th>Alat Penyiangan I</th>
							<th>Umur Penyiangan II</th>
							<th>Alat Penyiangan II</th>
							<th>Umur Penyiangan III</th>
							<th>Alat Penyiangan III</th>
							<th>Umur Penyiangan IV</th>
							<th>Alat Penyiangan IV</th>
						</tr>
					</thead>
				</table>
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
	
	function refresh(){
        $("#txtid").val("Otomatis By System");
        $("#cbolahan").val("").change();
        $("#txtu1").val("");
        $("#cboa1").val("").change();
        $("#txtu2").val("");
        $("#cboa2").val("").change();
        $("#txtu3").val("");
        $("#cboa3").val("").change();
        $("#txtu4").val("");
        $("#cboa4").val("").change();
        $("#lbljudul").html('Form Tambah Data');
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
        var lahan = $("#cbolahan").val();
        var umur1 = $("#txtu1").val();
        var alat1 = $("#cboa1").val();
        var umur2 = $("#txtu2").val();
        var alat2 = $("#cboa2").val();
        var umur3 = $("#txtu3").val();
        var alat3 = $("#cboa3").val();
        var umur4 = $("#txtu4").val();
        var alat4 = $("#cboa4").val();
		
        if(id == "" || lahan == "" || umur1 == "" || alat1 == "" || umur2 == "" || alat2 == "" || umur3 == "" || alat3 == "" || umur4 == "" || alat4 == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, lahan: lahan,umur1: umur1, alat1: alat1, umur2: umur2, alat2: alat2, umur3: umur3, alat3: alat3, umur4: umur4, alat4: alat4},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Penyiangan Berhasil di Tambahkan',
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
        var lahan = $("#cbolahan").val();
        var umur1 = $("#txtu1").val();
        var alat1 = $("#cboa1").val();
        var umur2 = $("#txtu2").val();
        var alat2 = $("#cboa2").val();
        var umur3 = $("#txtu3").val();
        var alat3 = $("#cboa3").val();
        var umur4 = $("#txtu4").val();
        var alat4 = $("#cboa4").val();
		
        if(id == "" || lahan == "" || umur1 == "" || alat1 == "" || umur2 == "" || alat2 == "" || umur3 == "" || alat3 == "" || umur4 == "" || alat4 == ""){
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
            data: {id: id, lahan: lahan,umur1: umur1, alat1: alat1, umur2: umur2, alat2: alat2, umur3: umur3, alat3: alat3, umur4: umur4, alat4: alat4},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Penyiangan Berhasil di Update',
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
								text: 'Data Penyiangan Berhasil di Hapus',
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
					$("#cbolahan").val(xx[2]).change();
					$("#txtu1").val(xx[3]);
					$("#cboa1").val(xx[4]).change();
					$("#txtu2").val(xx[5]);
					$("#cboa2").val(xx[6]).change();
					$("#txtu3").val(xx[7]);
					$("#cboa3").val(xx[8]).change();
					$("#txtu4").val(xx[9]);
					$("#cboa4").val(xx[10]).change();
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
			