<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Petani</h1>
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
						<label class="form-control-label">NIK*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnik" placeholder="Masukkan NIK" autocomplete="off" maxlength="16">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Nama*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnama" placeholder="Masukkan Nama Anda" autocomplete="off">
					</div>
					<div class="form-group col-md-12">
						<label class="form-control-label">Jenis Kelamin*</label>
						<select class="form-control select2" id="cbojk">
							<option value="">Silahkan Pilih</option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tempat Lahir*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtlahir" placeholder="Masukkan Tempat Lahir" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tanggal Lahir*</label>
						<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgl" placeholder="Masukkan Tanggal Lahir" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Telp*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txttelp" placeholder="Masukkan Telp" autocomplete="off">
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
						<label class="form-control-label">Nama Ibu*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtibu" placeholder="Masukkan Nama Ibu Kandung" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Alamat*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtalamat" placeholder="Masukkan Alamat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Dusun</label>
						<select class="form-control select2" id="cbodsn">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($dtdus)){
									if(count($dtdus)>0){
										foreach($dtdus as $x){
											echo "<option value='".$x->id."'>".$x->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">RT*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtrt" placeholder="Masukkan RT" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">RW*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtrw" placeholder="Masukkan RW" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Desa</label>
						<select class="form-control select2" id="cbodesa">
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
					<div class="form-group col-md-4" id="blokicon" style="font-size: 55px; text-align: center; margin-top: -5px;"></div>
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
							<th style="width: 10%;">Nik</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Kelahiran</th>
							<th>Tanggal Lahir</th>
							<th>Telp</th>
							<th>Nama Ibu</th>
							<th>Alamat</th>
							<th>Dusun</th>
							<th style="width: 10%;">Rt</th>
							<th style="width: 10%;">Rw</th>
							<th>Desa</th>
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
		"fnDrawCallback": function(oSettings){swal.close();
		}
	});

	$("#cboicon").change(function(){lihaticon();});
	refresh();

	function refreshdata(){tabel.ajax.reload(null, false);}
	
	function refresh(){
        $("#txtnik").val("");
        $("#txtnama").val("");
		$("#cbojk").val("").change();
		$("#txtlahir").val("");
        $("#txttgl").val("");
        $("#txttelp").val("");
        $("#txtibu").val("");
        $("#txtalamat").val("");
		$("#cbodsn").val("").change();
		$("#txtrt").val("");
        $("#txtrw").val("");
		$("#cbodesa").val("").change();
		$("#blokicon").html("");
        $("#lbljudul").html('Form Tambah Data');
		$("#txtid").attr("readonly", false);
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var nik = $("#txtnik").val();
        var nama= $("#txtnama").val();
		var jk= $("#cbojk").val();
		var kelahiran= $("#txtlahir").val();
        var tgl= $("#txttgl").val();
        var telp= $("#txttelp").val();
        var ibu= $("#txtibu").val();
        var alamat= $("#txtalamat").val();
		var dusun= $("#cbodsn").val();
		var rt= $("#txtrt").val();
        var rw= $("#txtrw").val();
		var desa= $("#cbodesa").val();
    
        if(nik == "" || nama == "" || jk == "" || kelahiran == "" ||tgl == "" || telp == "" || ibu == "" || alamat == "" ||dusun == "" || rt == "" || rw == "" || desa == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {nik: nik, nama: nama, jk: jk, kelahiran: kelahiran, tgl_lahir: tgl, telp: telp, ibu: ibu, alamat: alamat, dus: dusun, rt: rt, rw: rw, des: desa},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Form Berhasil di Tambahkan',
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

        var nik = $("#txtnik").val();
        var nama= $("#txtnama").val();
		var jk= $("#cbojk").val();
		var kelahiran= $("#txtlahir").val();
        var tgl= $("#txttgl").val();
        var telp= $("#txttelp").val();
        var ibu= $("#txtibu").val();
        var alamat= $("#txtalamat").val();
		var dusun= $("#cbodsn").val();
		var rt= $("#txtrt").val();
        var rw= $("#txtrw").val();
		var desa= $("#cbodesa").val();
    
        if(nik == "" || nama == "" || jk == "" || kelahiran == "" ||tgl == "" || telp == "" || ibu == "" || alamat == "" ||dusun == "" || rt == "" || rw == "" || desa == ""){
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
            data: {nik: nik, nama: nama, jk: jk, kelahiran: kelahiran, tgl_lahir: tgl, telp: telp, ibu: ibu, alamat: alamat, dus: dusun, rt: rt, rw: rw, des: desa},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Petani Berhasil di Update',
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

        var nik = $("#txtnik").val();
        if(nik == ""){
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
					data: {nik: nik},
					cache: "false",
					success: function(x){
						swal.close();
						console.log(x);
						var y = atob(x);
						if(y == 1){
							swal({
								title: 'Hapus Berhasil',
								text: 'Data Petani Berhasil di Hapus',
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
					$("#txtnik").val(xx[1]);
					$("#txtnama").val(xx[2]);
					$("#cbojk").val(xx[3]);
					$("#txtlahir").val(xx[4]);
			        $("#txttgl").val(xx[5]);
			        $("#txttelp").val(xx[6]);
			   		$("#txtibu").val(xx[7]);
			        $("#txtalamat").val(xx[8]);
					$("#cbodsn").val(xx[9]).change();
					$("#txtrt").val(xx[10]);
			        $("#txtrw").val(xx[11]);
					$("#cbodesa").val(xx[12]).change();
					$("#cbomenu").val(xx[13]).change();
					$("#cbosistem").val(xx[14]).change();
					$("#cboicon").val(xx[15]).change();
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
			