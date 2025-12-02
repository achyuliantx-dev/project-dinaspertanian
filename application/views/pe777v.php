<div class="page-header">
	<h1 class="page-title">Pengelolaan Pemupukan</h1>
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
				<div class="form-row" style="margin-bottom: 10px;">
                     <div class="form-group col-md-12">
						<label class="form-control-label">ID Panen*</label>
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
						<label class="form-control-label">Tanggal Pupuk Organik*</label>
						<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgl1" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jumlah Pupuk Organik*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtjml1" placeholder="Masukkan Jumlah Pupuk Organik" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tanggal Pupuk Anorganik*</label>
						<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgl2"  autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jumlah Pupuk Anorganik*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtjml2" placeholder="Masukkan Jumlah Pupuk Anorganik" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tanggal Pupuk Susulan I*</label>
						<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgl3" autocomplete="off">
					</div><br><br><br><br><br>
                </div>
			</div>
		</div>
	</div>
	<div class="col-xxl-6 col-lg-6 col-md-6">
		<div class="panel">
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Cara Pupuk Susulan I*</label>
						<select class="form-control select2" id="cbocp1">
							<option value="">Silahkan Pilih</option>
							<option value="Ditabur">Ditabur</option>
							<option value="Dikocor">Dikocor</option>
							<option value="Kombinasi">Kombinasi</option>
							<option value="Lainnya">Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jenis Pupuk Susulan I*</label>
						<select class="form-control select2" id="cbojp1" multiple>
							<option value="Organik">Organik</option>
							<option value="Anorganik">Anorganik</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="input-group-text">Dosis Pupuk Organik dan Anorganik Susulan I*</label>
					</div>
					<div class="input-group col-md-12 jedaobyek" style="margin-bottom: 10px;">
					  	<input type="text" class="form-control khusus_abjad jedaobyek" id="txtdosiso1" placeholder="Masukkan Dosis Pupuk Organik">
					  	<input type="text" class="form-control khusus_abjad jedaobyek" id="txtdosisa1" placeholder="Masukkan Dosis Pupuk Anorganik">
					</div> 
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Tanggal Pupuk Susulan II*</label>
						<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgl4" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Cara Pupuk Susulan II*</label>
						<select class="form-control select2" id="cbocp2">
							<option value="">Silahkan Pilih</option>
							<option value="Ditabur">Ditabur</option>
							<option value="Dikocor">Dikocor</option>
							<option value="Kombinasi">Kombinasi</option>
							<option value="Lainnya">Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jenis Pupuk Susulan II*</label>
						<select class="form-control select2" id="cbojp2" multiple>
							<option value="Organik">Organik</option>
							<option value="Anorganik">Anorganik</option>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="input-group-text">Dosis Pupuk Organik dan Anorganik Susulan II*</label>
					</div>
					<div class="input-group col-md-12 jedaobyek">
					  	<input type="text" class="form-control khusus_abjad jedaobyek" id="txtdosiso2" placeholder="Masukkan Dosis Pupuk Organik">
					  	<input type="text" class="form-control khusus_abjad jedaobyek" id="txtdosisa2" placeholder="Masukkan Dosis Pupuk Anorganik">
					</div> 
					<br><br>
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
							<th>Tgl Pupuk Organik</th>
							<th>Jumlah Pupuk Organik</th>
							<th>Tgl Pupuk Anorganik</th>
							<th>Jumlah Pupuk Anorganik</th>
							<th>Tgl Pupuk S I</th>
							<th>Cara Pupuk S I</th>
							<th>Jenis Pupuk S I</th>
							<th>Dosis Pupuk Organik S I</th>
							<th>Dosis Pupuk Anorganik S I</th>
							<th>Tgl Pupuk S II</th>
							<th>Cara Pupuk S II</th>
							<th>Jenis Pupuk S II</th>
							<th>Dosis Pupuk Organik S II</th>
							<th>Dosis Pupuk Anorganik S II</th>
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
        $("#txttgl1").val("");
        $("#txtjml1").val("");
        $("#txttgl2").val("");
        $("#txtjml2").val("");
        $("#txttgl3").val("");
        $("#cbocp1").val("").change();
        $("#cbojp1").val("").change();
        $("#txtdosiso1").val("");
        $("#txtdosisa1").val("");
        $("#txttgl4").val("");
        $("#cbocp2").val("").change();
        $("#cbojp2").val("").change();
        $("#txtdosiso2").val("");
        $("#txtdosisa2").val("");
        $("#lbljudul").html('Form Tambah Data');
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
		var lahan = $("#cbolahan").val();
		var tglPuOr = $("#txttgl1").val();
		var jmlPuOr = $("#txtjml1").val();
		var tglPuAn = $("#txttgl2").val();
		var jmlPuAn = $("#txtjml2").val();
		var tglPuSu1 = $("#txttgl3").val();
		var caraPu1 =  $("#cbocp1").val();
		var jenisPu1 = $("#cbojp1").val();
		var dosisPuO1 = $("#txtdosiso1").val();
		var dosisPuA1 = $("#txtdosisa1").val();
		var tglPuSu2 = $("#txttgl4").val();
		var caraPu2 = $("#cbocp2").val();
		var jenisPu2 = $("#cbojp2").val();
		var dosisPuO2 =  $("#txtdosiso2").val();
		var dosisPuA2 =  $("#txtdosisa2").val();
		
        if(id == "" || lahan == "" || tglPuOr == "" || jmlPuOr == "" || tglPuAn == "" || jmlPuAn == "" || tglPuSu1 == "" || caraPu1 == "" || jenisPu1 == "" || dosisPuO1 =="" || dosisPuA1 =="" || tglPuSu2 == "" || caraPu2 == "" || jenisPu2 == "" || dosisPuO2 =="" || dosisPuA2 ==""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, lahan: lahan,tglPuOr: tglPuOr, jmlPuOr: jmlPuOr, tglPuAn: tglPuAn, jmlPuAn: jmlPuAn, tglPuSu1: tglPuSu1, caraPu1: caraPu1, jenisPu1: jenisPu1.toString(), dosisPuO1: dosisPuO1, dosisPuA1: dosisPuA1, tglPuSu2: tglPuSu2, caraPu2: caraPu2, jenisPu2: jenisPu2.toString(), dosisPuO2: dosisPuO2, dosisPuA2: dosisPuA2},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Pemupukan Berhasil di Tambahkan',
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
		var tglPuOr = $("#txttgl1").val();
		var jmlPuOr = $("#txtjml1").val();
		var tglPuAn = $("#txttgl2").val();
		var jmlPuAn = $("#txtjml2").val();
		var tglPuSu1 = $("#txttgl3").val();
		var caraPu1 =  $("#cbocp1").val();
		var jenisPu1 = $("#cbojp1").val();
		var dosisPuO1 = $("#txtdosiso1").val();
		var dosisPuA1 = $("#txtdosisa1").val();
		var tglPuSu2 = $("#txttgl4").val();
		var caraPu2 = $("#cbocp2").val();
		var jenisPu2 = $("#cbojp2").val();
		var dosisPuO2 =  $("#txtdosiso2").val();
		var dosisPuA2 =  $("#txtdosisa2").val();
		
       if(id == "" || lahan == "" || tglPuOr == "" || jmlPuOr == "" || tglPuAn == "" || jmlPuAn == "" || tglPuSu1 == "" || caraPu1 == "" || jenisPu1 == "" || dosisPuO1 =="" || dosisPuA1 =="" || tglPuSu2 == "" || caraPu2 == "" || jenisPu2 == "" || dosisPuO2 =="" || dosisPuA2 ==""){
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
            data: {id: id, lahan: lahan,tglPuOr: tglPuOr, jmlPuOr: jmlPuOr, tglPuAn: tglPuAn, jmlPuAn: jmlPuAn, tglPuSu1: tglPuSu1, caraPu1: caraPu1, jenisPu1: jenisPu1.toString(), dosisPuO1: dosisPuO1, dosisPuA1: dosisPuA1, tglPuSu2: tglPuSu2, caraPu2: caraPu2, jenisPu2: jenisPu2.toString(), dosisPuO2: dosisPuO2, dosisPuA2: dosisPuA2},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Pemupukan Berhasil di Update',
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
								text: 'Data Pemupukan Berhasil di Hapus',
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
					$("#txttgl1").val(xx[3]);
					$("#txtjml1").val(xx[4]);
					$("#txttgl2").val(xx[5]);
					$("#txtjml2").val(xx[6]);
					$("#txttgl3").val(xx[7]);
					$("#cbocp1").val(xx[8]).change();
					$("#cbojp1").val(xx[9]).change();
					$("#txtdosiso1").val(xx[10]);
					$("#txtdosisa1").val(xx[11]);
					$("#txttgl4").val(xx[12]);
					$("#cbocp2").val(xx[13]).change();
					$("#cbojp2").val(xx[14]).change();
					$("#txtdosiso2").val(xx[15]);
					$("#txtdosisa2").val(xx[16]);
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
			