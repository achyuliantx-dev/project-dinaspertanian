<div class="page-header">
	<h1 class="page-title" style="text-align:center;">Pengelolaan Data Panen</h1>
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
		<div class="col-xxl-12 col-lg-12 col-md-12">
		<div class="panel" style="margin-left:220px; margin-right:220px;">
			<div class="panel-heading"><h3 class="panel-title" id="lbljudul" style="text-align:center;">Form</h3></div>
			<div class="panel-body">
				<div class="form-row">
                     <div class="form-group col-md-12">
						<label class="form-control-label">ID Panen*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">ID Lahan*</label>
						<select class="form-control select2" id="cbolahan" onchange="filteranalisis()">
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
						<label class="form-control-label">Tanggal Panen*</label>
						<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgl" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Produksi*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtproduksi" placeholder="Masukkan Produksi Real" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Produktivitas*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtproduktivitas" placeholder="Masukkan Produktivitas" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Biaya Usaha Tani*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtbut" placeholder="Biaya Usaha Tani" autocomplete="off" readonly>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Keuntungan*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtuntung" placeholder="Keuntungan" autocomplete="off" readonly>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Masalah*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtmasalah" placeholder="Masukkan Masalah" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Saran*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtsaran" placeholder="Masukkan Saran" autocomplete="off">
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
							<th>Tanggal Panen</th>
							<th>Produksi</th>
							<th>Produktivitas</th>
							<th>Biaya Usaha Tani</th>
							<th>Keuntungan</th>
							<th>Masalah</th>
							<th>Saran</th>
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
        $("#txttgl").val("");
        $("#txtproduksi").val("");
        $("#txtproduktivitas").val("");
        $("#txtbut").val("");
        $("#txtuntung").val("");
        $("#txtmasalah").val("");
        $("#txtsaran").val("");
        $("#lbljudul").html('Form Tambah Data');
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
        var lahan = $("#cbolahan").val();
        var panen = $("#txttgl").val();
        var produksi = $("#txtproduksi").val();
        var produktivitas = $("#txtproduktivitas").val();
        var biaya = $("#txtbut").val();
        var keuntungan = $("#txtuntung").val();
        var masalah = $("#txtmasalah").val();
        var saran = $("#txtsaran").val();
		
        if(id == "" || lahan == "" || panen == "" || produksi == "" || produktivitas == "" || biaya == "" || keuntungan == "" || masalah == "" || saran == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, lahan: lahan,panen: panen, produksi: produksi, produktivitas: produktivitas, biaya: biaya, keuntungan: keuntungan, masalah: masalah, saran: saran},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Panen Berhasil di Tambahkan',
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
        var panen = $("#txttgl").val();
        var produksi = $("#txtproduksi").val();
        var produktivitas = $("#txtproduktivitas").val();
        var biaya = $("#txtbut").val();
        var keuntungan = $("#txtuntung").val();
        var masalah = $("#txtmasalah").val();
        var saran = $("#txtsaran").val();
		
        if(id == "" || lahan == "" || panen == "" || produksi == "" || produktivitas == "" || biaya == "" || keuntungan == "" || masalah == "" || saran == ""){
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
            data: {id: id, lahan: lahan, panen: panen, produksi: produksi, produktivitas: produktivitas, biaya: biaya, keuntungan: keuntungan, masalah: masalah, saran: saran},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Panen Berhasil di Update',
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
								text: 'Data Panen Berhasil di Hapus',
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
					$("#txttgl").val(xx[3]);
					$("#txtproduksi").val(xx[4]);
					$("#txtproduktivitas").val(xx[5]);
					$("#txtbut").val(xx[6]);
					$("#txtuntung").val(xx[7]);
					$("#txtmasalah").val(xx[8]);
					$("#txtsaran").val(xx[9]);
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

	function filteranalisis(){

    	let idlah = $("#cbolahan").val();
      	if(idlah == "") {
      		$("#txtbut").val("");
      		$("#txtuntung").val("");
      		return;
      	}else{
      		$.getJSON("<?= base_url(ucfirst($idf).'/filteranalisis/'); ?>" + idlah, function (result) {
            	if (result.length != 0) {
              		$.each(result, function (i, kolom) {
                  		let biaya = kolom.total_biaya;
                  		let untung = kolom.keuntungan;
                  		$("#txtbut").val(biaya);
                  		$("#txtuntung").val(untung);
                	})
              	}else{
              		$("#txtbut").val("");
      				$("#txtuntung").val("");
              	}   
          	})
      	}
    }
</script>
			