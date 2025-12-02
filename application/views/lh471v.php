<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Lahan Pertanian</h1>
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
			<div class="panel-heading"><h3 class="panel-title">Data</h3></div>
			<div class="panel-body">
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 10%;">Aksi</th>
							<th style="width: 10%;">NOP</th>
							<th>Petani</th>
							<th>Luas Lahan Subsidi</th>
							<th>Luas Lahan Nonsubsidi</th>
							<th>Total Luas Lahan</th>
							<th>Jenis Lahan</th>
							<th>Desa</th>
							<th>Lintang</th>
							<th>Bujur</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xxl-3 col-lg-3 col-md-3">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form</h3></div>
			<div class="panel-body">
				<div class="form-row">
                     <div class="form-group col-md-12">
						<label class="form-control-label">Nomor Objek Pajak*</label>
						<input type="text" placeholder="Masukkan NOP" class="form-control  jedaobyek" id="txtnop" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Petani</label>
						<select class="form-control select2" id="cbonik">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtpet)){
									if(count($dtpet)>0){
										foreach($dtpet as $x){
											echo "<option value='".$x->nik."'>".$x->nik." | $x->nama</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Luas Lahan Subsidi*</label>
						<input type="text" class="form-control jedaobyek" id="txthas" placeholder="Masukkan Luas Lahan Subsidi" autocomplete="off" maxlength="100">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Luas Lahan NonSubsidi*</label>
						<input type="text" class="form-control jedaobyek" id="txthan" placeholder="Masukkan Luas Lahan NonSubsidi" autocomplete="off" maxlength="100">
					</div>
					<!-- <div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Total Luas Lahan*</label>
						<input type="text" class="form-control jedaobyek" id="txtha" placeholder="Masukkan Luas Lahan" autocomplete="off" maxlength="100">
					</div> -->
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Kategori Lahan</label>
						<select class="form-control select2" id="cboket">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtket)){
									if(count($dtket)>0){
										foreach($dtket as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
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
								if(is_array($dtdes)){
									if(count($dtdes)>0){
										foreach($dtdes as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Lintang*</label>
						<input type="text" class="form-control jedaobyek" id="txtlin" placeholder="Masukkan Garis Lintang" autocomplete="off" maxlength="100">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Bujur*</label>
						<input type="text" class="form-control jedaobyek" id="txtbuj" placeholder="Masukkan Garis Bujur" autocomplete="off" maxlength="100">
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
		"fnDrawCallback": function(oSettings){swal.close();
		}
	});

	$("#cboicon").change(function(){lihaticon();});
	refresh();

	function refreshdata(){tabel.ajax.reload(null, false);}
	
	function refresh(){
        $("#txtnop").val("");
       	$("#cbonik").val("").change();
       	$("#txthas").val("");
       	$("#txthan").val("");
		$("#txtha").val("");
		$("#cboket").val("").change();
        $("#cbodes").val("").change();
        $("#txtlin").val("");
        $("#txtbuj").val("");
		$("#blokicon").html("");
        $("#lbljudul").html('Form Tambah Data');
		$("#txtid").attr("readonly", false);
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var nop = $("#txtnop").val();
        var nik= $("#cbonik").val();
		var has= $("#txthas").val();
		var han= $("#txthan").val();
		// var ha= $("#txtha").val();
		var jenis= $("#cboket").val();
		var des= $("#cbodes").val();
        var lin= $("#txtlin").val();
        var buj= $("#txtbuj").val();
    
        if(nop == "" || nik == "" || has == "" || han == "" || jenis == "" || des == "" || lin == "" || buj == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {nop: nop, nik: nik, has: has, han: han, jenis: jenis, des: des, lin: lin, buj: buj},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Lahan Berhasil di Tambahkan',
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

         var nop = $("#txtnop").val();
         var nik= $("#cbonik").val();
		 var has= $("#txthas").val();
		 var han= $("#txthan").val();
		 // var ha= $("#txtha").val();
		 var jenis= $("#cboket").val();
		 var des= $("#cbodes").val();
         var lin= $("#txtlin").val();
         var buj= $("#txtbuj").val();
    
         if(nop == "" || nik == "" || has == "" || han == ""|| jenis == "" || des == "" || lin == "" || buj == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            $("#btnupdate").attr("disabled", false);
			$("#btnhapus").attr("disabled", false);
			$("#btnrefresh").attr("disabled", false);
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {nop: nop, nik: nik, has: has, han: han, jenis: jenis, des: des, lin: lin, buj: buj},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Lahan Berhasil di Update',
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

        var nop = $("#txtnop").val();
        if(nop == ""){
            swal({title: 'Hapus Gagal', text: 'ID Form Kosong !', icon: 'error'});
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
					data: {nop: nop},
					cache: "false",
					success: function(x){
						swal.close();
						console.log(x);
						var y = atob(x);
						if(y == 1){
							swal({
								title: 'Hapus Berhasil',
								text: 'Data Lahan Berhasil di Hapus',
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
									swal({title: 'Hapus Gagal', text: 'Data Form Ini Masih digunakan dalam Data Form Level, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah', icon: 'error'});
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
					$("#txtnop").val(xx[1]);
			       	$("#cbonik").val(xx[2]).change();
			       	$("#txthas").val(xx[3]);
			       	$("#txthan").val(xx[4]);
					$("#cboket").val(xx[5]).change();
			        $("#cbodes").val(xx[6]).change();
			        $("#txtlin").val(xx[7]);
			        $("#txtbuj").val(xx[8]);
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
			