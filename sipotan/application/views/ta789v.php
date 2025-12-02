<div class="page-header">
	<h1 class="page-title">Pengelolaan Analisa Usaha Tani</h1>
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
								if(is_array($dtlah)){
									if(count($dtlah)>0){
										foreach($dtlah as $x){
											echo "<option value='".$x->id_lahan."'>".$x->id_lahan." | ".$x->nama_bpp."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Olah Lahan *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="bol" placeholder="Masukkan Nominal " autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Pembibitan *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="bpem" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Tanam *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="btan" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Pupuk *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="bpuk" placeholder="Masukkan Dosis Aplikasi POC 2" autocomplete="off">
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
						<label class="form-control-label">Biaya Pestisida *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="bpes" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Pengairan *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="bpeng" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Tenaga Kerja *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="btk" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Sewa Lahan*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="bsl" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Lain-Lain *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="blan" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Harga Pasar Per Kg *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="hpk" placeholder="Masukkan Nominal" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Total Panen *</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="tpan" placeholder="Masukkan Jumlah Panen" autocomplete="off">
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
							<th>Biaya Olah Lahan</th>
							<th>Biaya Pembibitan</th>
							<th>Biaya Tanam</th>
							<th>Biaya Pupuk</th>
							<th>Biaya Pestisida</th>
							<th>Biaya Pengairan</th>
							<th>Biaya Tenaga Kerja</th>
							<th>Biaya Sewa Lahan</th>
							<th>Biaya Lain-Lain</th>
							<th>Total Biaya</th>
							<th> Harga Pasar per Kg</th>
							<th>Total Panen</th>
							<th>Keuntungan</th>
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
        $("#bol").val("");
        $("#bpem").val("");
        $("#btan").val("");
        $("#bpuk").val("");
        $("#bpes").val("");
        $("#bpeng").val("");
        $("#btk").val("");
        $("#bsl").val("");
        $("#blan").val("");
        $("#hpk").val("");
        $("#tpan").val("");
        $("#lbljudul").html('Form Tambah Data');
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
        var id_lahan = $("#cboid_lahan").val();
        var bol = $("#bol").val();
        var bpem = $("#bpem").val();
        var btan = $("#btan").val();
        var bpuk = $("#bpuk").val();
        var bpes = $("#bpes").val();
        var bpeng = $("#bpeng").val();
        var btk = $("#btk").val();
        var bsl = $("#bsl").val();
        var blan = $("#blan").val();
        var hpk = $("#hpk").val();
        var tpan = $("#tpan").val();
		
        if(id == "" || id_lahan == "" || bol == "" || bpem == "" || btan == "" || bpuk == ""|| bpes == "" || bpeng == ""|| btk == "" || bsl == ""|| blan == "" || hpk == ""|| tpan == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, id_lahan: id_lahan, bol: bol, bpem: bpem, btan: btan, bpuk: bpuk, bpes: bpes, bpeng: bpeng, btk: btk, bsl: bsl, blan: blan, hpk: hpk, tpan:tpan},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Tabel Analisa Usaha Tani Berhasil di Tambahkan',
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
        var bol = $("#bol").val();
        var bpem = $("#bpem").val();
        var btan = $("#btan").val();
        var bpuk = $("#bpuk").val();
        var bpes = $("#bpes").val();
        var bpeng = $("#bpeng").val();
        var btk = $("#btk").val();
        var bsl = $("#bsl").val();
        var blan = $("#blan").val();
        var hpk = $("#hpk").val();
        var tpan = $("#tpan").val();
		
        if(id == "" || id_lahan == "" || bol == "" || bpem == "" || btan == "" || bpuk == ""|| bpes == "" || bpeng == ""|| btk == "" || bsl == ""|| blan == "" || hpk == ""|| tpan == ""){
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
            data: {id: id, id_lahan: id_lahan, bol: bol, bpem: bpem, btan: btan, bpuk: bpuk, bpes: bpes, bpeng: bpeng, btk: btk, bsl: bsl, blan: blan, hpk: hpk, tpan:tpan},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Tabel Analisa Usaha Tani Berhasil di Update',
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
					$("#bol").val(xx[3]);
					$("#bpem").val(xx[4]);
					$("#btan").val(xx[5]);
					$("#bpuk").val(xx[6]);
					$("#bpes").val(xx[7]);
					$("#bpeng").val(xx[8]);
					$("#btk").val(xx[9]);
					$("#bsl").val(xx[10]);
					$("#blan").val(xx[11]);
					$("#hpk").val(xx[13]);
					$("#tpan").val(xx[14]);
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
			