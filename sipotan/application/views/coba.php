<div class="page-header">
	<h1 class="page-title">Pengelolaan Data PPL</h1>
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

<!-- Form Tambah -->
<div class="row">
	<button type='button' class='btn btn-success waves-effect waves-light' data-toggle='modal' data-target='#md_tbh' >Tambah</button><br>
	<div class="row">
		<div class="modal fade" id="md_tbh">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
          	</button>
          </div>
          <div class="row">
          	<div class="col-xxl-6 col-lg-6 col-md-6">
          		<div class="panel">
          			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form Tambah Data</h3></div>
          			<div class="panel-body">
          				<div class="form-row">
          					<div class="form-group col-md-12">
          						<label class="form-control-label">ID PPL*</label>
          						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtid" value="Otomatis By System" readonly autocomplete="off">
          					</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Nama*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnama" placeholder="Masukkan Nama" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">NIK*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnik" placeholder="Masukkan NIK" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">NIP/NIPPPK*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnip" placeholder="Masukkan NIP/NIPPPK" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Gelar Depan*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtgel1" placeholder="Masukkan Gelar Depan" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Gelar Belakang*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtgel2" placeholder="Masukkan Gelar Belakang" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Tempat Lahir*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtlahir" placeholder="Masukkan Tempat Lahir" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Tanggal Lahir*</label>
											<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgl" placeholder="Masukkan Tanggal Lahir" autocomplete="off">
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
											<label class="form-control-label" style="margin-bottom: -5px;">Agama</label>
											<select class="form-control select2" id="cboaga">
												<option value="">Silahkan Pilih</option>
												<?php
													if(is_array($dtaga)){
														if(count($dtaga)>0){
															foreach($dtaga as $x){
																echo "<option value='".$x->id."'>".$x->nama."</option>";
															}
														}
													}
												?>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Jurusan Semasa Pendidikan*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtjsp" placeholder="Masukkan Jurusan Semasa Pendidikanr" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Sekolah/Universitas*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtsek" placeholder="Masukkan Sekolah/Universitas" autocomplete="off">
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
											<label class="form-control-label">Pangkat Terakhir Terampil*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtptt" placeholder="Masukkan Pangkat Terakhir Terampil" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Pangkat Terakhir ASN*</label>
											<select class="form-control select2" id="cbopta">
												<option value="Ahli">Ahli</option>
												<option value="Terampil">Terampil</option>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Alamat*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtala" placeholder="Masukkan Alamat" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label" style="margin-bottom: -5px;">Kecamatan</label>
											<select class="form-control select2" id="cbokec" onchange="filterdesa('tambah')">
												<option value="">Silahkan Pilih</option>
												<?php
													if(is_array($dtkec)){
														if(count($dtkec)>0){
															foreach($dtkec as $x){
																echo "<option value='".$x->id."'>".$x->nama."</option>";
															}
														}
													}
												?>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label" style="margin-bottom: -5px;">Desa</label>
											<select class="form-control select2" id="cbodesa" multiple="multiple"></select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Kode Pos*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtpos" placeholder="Masukkan Kode Pos" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Telp*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txttelp" placeholder="Masukkan Telp" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Email*</label>
											<input type="text" class="form-control jedaobyek" id="txtema" placeholder="Masukkan Email" autocomplete="off">
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label">Status*</label>
											<select class="form-control select2" id="cbosta">
												<option value="">Silahkan Pilih</option>
												<option value="ASN">ASN</option>
												<option value="PPPK">PPPK</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label">Jenjang Jabatan Terampil*</label>
											<select class="form-control select2" id="cbojjt">
												<option value="">Silahkan Pilih</option>
												<option value="Pemula">Pemula</option>
												<option value="Terampil">Terampil</option>
												<option value="Mahir">Mahir</option>
												<option value="Penyelia">Penyelia</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label">Jenjang Jabatan Ahli*</label>
											<select class="form-control select2" id="cbojja">
												<option value="">Silahkan Pilih</option>
												<option value="Ahli Pertama">Ahli Pertama</option>
												<option value="Ahli Muda">Ahli Muda</option>
												<option value="Ahli Madya">Ahli Madya</option>
												<option value="Ahli Utama">Ahli Utama</option>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Kelas Jabatan*</label>
											<select class="form-control select2" id="cbojab">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
										</div>
										<div class="form-group col-md-4" id="blokicon" style="font-size: 55px; text-align: center; margin-top: -5px;"></div>
										<div class="form-group col-md-12" id="bloktombol"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Form Edit -->
	<div class="modal fade" id="md_edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="row">
          	<div class="col-xxl-6 col-lg-6 col-md-6">
          		<div class="panel">
          			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form Kelola Data</h3></div>
          			<div class="panel-body">
          				<div class="form-row">
          					<div class="form-group col-md-12">
          						<label class="form-control-label">ID PPL*</label>
          						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtide" value="Otomatis By System" readonly autocomplete="off">
          					</div>
          					<div class="form-group col-md-12 jedaobyek">
          						<label class="form-control-label">Nama*</label>
          						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnamae" placeholder="Masukkan Nama" autocomplete="off">
          					</div>
          					<div class="form-group col-md-12 jedaobyek">
          						<label class="form-control-label">NIK*</label>
          						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnike" placeholder="Masukkan NIK" autocomplete="off">
          					</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">NIP/NIPPPK*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnipe" placeholder="Masukkan NIP/NIPPPK" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Gelar Depan*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtgel1e" placeholder="Masukkan Gelar Depan" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Gelar Belakang*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtgel2e" placeholder="Masukkan Gelar Belakang" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Tempat Lahir*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtlahire" placeholder="Masukkan Tempat Lahir" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Tanggal Lahir*</label>
											<input type="date" class="form-control khusus_abjad jedaobyek" id="txttgle" placeholder="Masukkan Tanggal Lahir" autocomplete="off">
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label">Jenis Kelamin*</label>
											<select class="form-control select2" id="cbojke">
												<option value="">Silahkan Pilih</option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label" style="margin-bottom: -5px;">Agama</label>
											<select class="form-control select2" id="cboagae">
												<option value="">Silahkan Pilih</option>
												<?php
													if(is_array($dtaga)){
														if(count($dtaga)>0){
															foreach($dtaga as $x){
																echo "<option value='".$x->id."'>".$x->nama."</option>";
															}
														}
													}
												?>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Jurusan Semasa Pendidikan*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtjspe" placeholder="Masukkan Jurusan Semasa Pendidikanr" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Sekolah/Universitas*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtseke" placeholder="Masukkan Sekolah/Universitas" autocomplete="off">
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
											<label class="form-control-label">Pangkat Terakhir Terampil*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtptte" placeholder="Masukkan Pangkat Terakhir Terampil" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Pangkat Terakhir ASN*</label>
											<select class="form-control select2" id="cboptae">
												<option value="Ahli">Ahli</option>
												<option value="Terampil">Terampil</option>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Alamat*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtalae" placeholder="Masukkan Alamat" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label" style="margin-bottom: -5px;">Kecamatan</label>
											<select class="form-control select2" id="cbokece" onchange="filterdesa('update')">
												<option value="">Silahkan Pilih</option>
												<?php
													if(is_array($dtkec)){
														if(count($dtkec)>0){
															foreach($dtkec as $x){
																echo "<option value='".$x->id."'>".$x->nama."</option>";
															}
														}
													}
												?>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label" style="margin-bottom: -5px;">Desa</label>
											<select class="form-control select2" id="cbodesae" multiple></select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Kode Pos*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtpose" placeholder="Masukkan Kode Pos" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Telp*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txttelpe" placeholder="Masukkan Telp" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Email*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtemae" placeholder="Masukkan Email" autocomplete="off">
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label">Status*</label>
											<select class="form-control select2" id="cbostae">
												<option value="">Silahkan Pilih</option>
												<option value="PNS">PNS</option>
												<option value="PPPK">PPPK</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label">Jenjang Jabatan Terampil*</label>
											<select class="form-control select2" id="cbojjte">
												<option value="">Silahkan Pilih</option>
												<option value="Pemula">Pemula</option>
												<option value="Terampil">Terampil</option>
												<option value="Mahir">Mahir</option>
												<option value="Penyelia">Penyelia</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label class="form-control-label">Jenjang Jabatan Ahli*</label>
											<select class="form-control select2" id="cbojjae">
												<option value="">Silahkan Pilih</option>
												<option value="Ahli Pertama">Ahli Pertama</option>
												<option value="Ahli Muda">Ahli Muda</option>
												<option value="Ahli Madya">Ahli Madya</option>
												<option value="Ahli Utama">Ahli Utama</option>
											</select>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Kelas Jabatan*</label>
											<select class="form-control select2" id="cbojabe">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
										</div>
										<div class="form-group col-md-4" id="blokicon" style="font-size: 55px; text-align: center; margin-top: -5px;"></div>
										<div class="form-group col-md-12" id="bloktombole"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Form Tambah Akun -->
	<div class="row">
		<div class="modal fade" id="md_akses">
			<div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="row">
          	<div class="col-xxl-12 col-lg-12 col-md-12">
          		<div class="panel">
          			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form Tambah Akun</h3></div>
          			<div class="panel-body">
          				<div class="form-row">
          					<div class="form-group col-md-12">
          						<label class="form-control-label">ID Akses*</label>
          						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtida" readonly autocomplete="off">
          					</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Nama*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnamab" placeholder="Masukkan Nama"  readonly autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Username*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtusername" placeholder="Masukkan Username" autocomplete="off">
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Level*</label>
											<input type="text" class="form-control khusus_abjad jedaobyek" id="txtlevel" placeholder="Masukkan Level" autocomplete="off" value="04" readonly>
										</div>
										<div class="form-group col-md-12 jedaobyek">
											<label class="form-control-label">Status*</label>
											<select class="form-control select2" id="cbostat">
												<option value="">Silahkan Pilih</option>
												<option value="Y">Aktif</option>
												<option value="N">Tidak Aktif</option>
											</select>
										</div>
										<div class="form-group col-md-4" id="blokicon" style="font-size: 55px; text-align: center; margin-top: -5px;"></div>
											<div class="form-group col-md-12" id="bloktombolb"></div>
					          </div>
					        </div>
					      </div>
					    </div>
					  </div>
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
							<th style="width: 10%;">ID</th>
							<th style="width: 20%;">Nama</th>
							<th>Jenis Kelamin</th>
							<th>Alamat</th>
							<th>Telp</th>
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
    $("#txtid").val("Otomatis By System");
    $("#txtnama").val("");
    $("#txtnik").val("");
    $("#txtnip").val("");
    $("#txtgel1").val("");
    $("#txtgel2").val("");
		$("#txtlahir").val("");
		$("#txttgl").val("");
    $("#cbojk").val("").change();
    $("#cboaga").val("").change();
    $("#txtjsp").val("");
    $("#txtsek").val("");
		$("#cbokec").val("").change();
		$("#txtptt").val("");
    $("#cbopta").val("").change();
    $("#txtala").val("");
		$("#cbodesa").val("").change();
		$("#txtpos").val("");
		$("#txttelp").val("");
		$("#txtema").val("");
		$("#cbostat").val("").change();
		$("#cbojjt").val("").change();
		$("#cbojja").val("").change();
		$("#cbojab").val("").change();
		$("#blokicon").html("");
    $("#lbljudul").html('Form Tambah Data');
    $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	// function refresha(){
	// 	$("#txtusername").val("");
  //   $("#cbostat").val("").change();
  //  	$("#blokicon").html("");
  //   $("#lbljudul").html('Form Tambah Akun');
  //   $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresha()">Batal</button>');
	// }
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
		var id = $("#txtid").val();
		var nama = $("#txtnama").val();
    var nik = $("#txtnik").val();
    var nip= $("#txtnip").val();
    var gelarDep= $("#txtgel1").val("");
    var gelarBel= $("#txtgel2").val("");
    var tempat_lahir = $("#txtlahir").val();
    var tgl_lahir= $("#txttgl").val();
		var jk= $("#cbojk").val();
		var agama= $("#cboaga").val();
		var jsp= $("#txtjsp").val();
		var sek= $("#txtsek").val();
 		var kec= $("#cbokec").val();
 		var ptt= $("#txtptt").val();
 		var pta= $("#cbopta").val();
 		var alamat= $("#txtala").val();
 		var desa= $("#cbodesa").val();
 		var pos= $("#txtpos").val();
 		var telp= $("#txttelp").val();
 		var email= $("#txtema").val();
 		var status= $("#cbosta").val();
 		var jtt= $("#cbojjt").val();
 		var jja= $("#cbojja").val();
 		var jab= $("#cbojab").val();
    
        if(id == "" ||  nama == "" || nik == "" || nip == "" || gelarDep== "" || gelarBel = "" || tempat_lahir == "" || tgl_lahir == "" || jk == "" || agama == "" || jsp == "" || sek == "" || kec == "" || ptt == "" || pta == "" || alamat == "" || desa == "" || pos == "" || telp == "" || email == "" || status == "" || jtt == "" || jja == "" || jab == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            $("#btntambah").attr("disabled", false);
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, nama: nama, nik: nik, nip: nip, gelarDep: gelarDep, gelarBel: gelarBel, tempat_lahir: tempat_lahir, tgl_lahir: tgl_lahir, jk: jk, agama: agama, jsp: jsp, sek: sek, kec: kec, ptt: ptt, pta: pta, alamat: alamat, desa: desa.toString(), pos: pos, telp: telp, email: email, status: status, jtt: jtt, jja: jja, jab: jab},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data PPL Berhasil di Tambahkan',
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

    var id = $("#txtide").val();
		var nama = $("#txtnamae").val();
    var nik = $("#txtnike").val();
    var nip= $("#txtnipe").val();
    var gelarDep= $("#txtgel1e").val();
    var gelarBel= $("#txtgel2e").val();
    var tempat_lahir = $("#txtlahire").val();
    var tgl_lahir= $("#txttgle").val();
		var jk= $("#cbojke").val();
		var agama= $("#cboagae").val();
		var jsp= $("#txtjspe").val();
		var sek= $("#txtseke").val();
 		var kec= $("#cbokece").val();
 		var ptt= $("#txtptte").val();
 		var pta= $("#cboptae").val();
 		var alamat= $("#txtalae").val();
 		var desa= $("#cbodesae").val();
 		var pos= $("#txtpose").val();
 		var telp= $("#txttelpe").val();
 		var email= $("#txtemae").val();
 		var status= $("#cbostae").val();
 		var jtt= $("#cbojjte").val();
 		var jja= $("#cbojjae").val();
 		var jab= $("#cbojabe").val();
    
    if(id == "" ||  nama == "" || nik == "" || nip == "" || gelarDep == "" || gelarBel == "" || tempat_lahir == "" || tgl_lahir == "" || jk == "" || agama == "" || jsp == "" || sek == "" || kec == "" || ptt == "" || pta == "" || alamat == "" || desa == "" || pos == "" || telp == "" || email == "" || status == "" || jtt == "" || jja == "" || jab == ""){
        swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
      $("#btnupdate").attr("disabled", false);
			$("#btnhapus").attr("disabled", false);
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {id: id, nama: nama, nik: nik, nip: nip, gelarDep: gelarDep, gelarBel: gelarBel, tempat_lahir: tempat_lahir, tgl_lahir: tgl_lahir, jk: jk, agama: agama, jsp: jsp, sek: sek, kec: kec, ptt: ptt, pta: pta, alamat: alamat, desa: desa.toString(), pos: pos, telp: telp, email: email, status: status, jtt: jtt, jja: jja, jab: jab},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data PPL Berhasil di Update',
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

	function tambah_akses(){
		$("#btntambah").attr("disabled", true);

		var id = $("#txtida").val();
		var nama = $("#txtnamab").val();
		var username = $("#txtusername").val();
		var level = $("#txtlevel").val();
		var status = $("#cbostat").val();

		if(id == "" ||  nama == "" || username == "" || level == "" || status == "" ){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
     $("#btntambah").attr("disabled", false);
			$("#btnhapus").attr("disabled", false);
			$("#btnrefresh").attr("disabled", false);
        return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah_akses'); ?>",
            method: "POST",
            data: {id: id, nama: nama, username: username, level: level, status: status},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Akun Akses Berhasil di Tambahkan',
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

	function hapus(){
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

        var id = $("#txtide").val();
        if(id == ""){
            swal({title: 'Hapus Gagal', text: 'ID Kosong !', icon: 'error'});
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
						console.log(x);
						var y = atob(x);
						if(y == 1){
							swal({
								title: 'Hapus Berhasil',
								text: 'Data PPL Berhasil di Hapus',
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
		var nama = $(el).data("nama");
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
					$("#txtide").val(id);
					$("#txtida").val(id);
	        $("#txtnamae").val(nama);
	        $("#txtnamab").val(nama);
	        $("#txtnike").val(xx[3]);
	        $("#txtnipe").val(xx[4]);
	        $("#txtgel1e").val(xx[5]);
	        $("#txtgel2e").val(xx[6]);
					$("#txtlahire").val(xx[7]);
					$("#txttgle").val(xx[8]);
	        $("#cbojke").val(xx[9]).change();
	        $("#cboagae").val(xx[10]).change();
	        $("#txtjspe").val(xx[11]);
	        $("#txtseke").val(xx[12]);
					$("#cbokece").val(xx[13]).change();
					$("#txtptte").val(xx[14]);
	        $("#txtptae").val(xx[15]).change();
	        $("#txtalae").val(xx[16]);
					$("#txtpose").val(xx[17]);
					$("#txttelpe").val(xx[18]);
					$("#txtemae").val(xx[19]);
					$("#cbostae").val(xx[20]).change();
					$("#cbojjte").val(xx[21]).change();
					$("#cbojjae").val(xx[22]).change();
					$("#txtjabe").val(xx[23]).change();
					$("#lbljudul").html('Form Kelola Data');
					$("#txtid").attr("readonly", true);
					$("#bloktombole").html('\
						<button type="button" class="btn btn-info" id="btnupdate" onclick="update()">Update</button>\
						<button type="button" class="btn btn-danger" id="btnhapus" onclick="hapus()">Hapus</button>\
					');
					$("#bloktombolb").html('\
						<button type="button" class="btn btn-info" id="btntambah" onclick="tambah_akses()">Tambah</button>\
					');
					sessionStorage.setItem("pilihdesa", xx[16]);
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
    function filterdesa(jenis){

    	let idkec = jenis == "tambah" ? $("#cbokec").val() : $("#cbokece").val();
      if(idkec == "") {
      		$("#cbodesa").html("");
      		$("#cbodesae").html("");
      		return;
      }else{
      		$.getJSON("<?= base_url(ucfirst($idf).'/filterdesa/'); ?>" + idkec, function (result) {
              if (result.length != 0) {
              	let dt = "";
              		$.each(result, function (i, kolom) {
                  		let id = kolom.id;
                  		let nama = kolom.nama;
                  		dt += "<option value='"+ id +"'>"+ nama +"</option>";
                  })
                  if(jenis == "tambah"){
                  	$("#cbodesa").html(dt);
                  }else{
                  	$("#cbodesae").html(dt);
                  	let ds = sessionStorage.pilihdesa;
                  	$("#cbodesae").val(ds.split(",")).change();
                  }
              }else{
              		if(jenis == "tambah"){
                  	$("#cbodesa").html("");
                  }else{
                  	$("#cbodesae").html("");
                  }
              }   
          })
      }
    }
</script>


			