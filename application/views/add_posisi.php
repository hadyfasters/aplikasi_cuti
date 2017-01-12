<form action="<?php echo base_url('posisi/create'); ?>" method="POST" enctype="multipart/form-data">
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="form-group">
			<label for="nm_lengkap">NIK<span class="required"> *</span></label>
			<input type="text" name="nik" id="nik" class="form-control input-sm" placeholder="Nomor Induk Karyawan" value="<?php echo $nik; ?>" readonly required>
		</div>
		<div class="form-group">
			<label for="nm_lengkap">Nama Lengkap<span class="required"> *</span></label>
			<input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control input-sm" placeholder="Nama Lengkap" value="<?php echo $nm_lengkap; ?>" readonly required>
		</div>
		<div class="form-group">
			<label for="departemen">Departemen<span class="required"> *</span></label>
			<select name="departemen" id="departemen" class="form-control input-sm" required>
				<option value="">-- Pilih Departemen --</option>
				<?php 
					foreach ($departemen as $d) {
						if($d->kode_dptm == $dptm)
						{
							echo '<option value="'.$d->kode_dptm.'" selected>'.$d->nm_dptm.'</option>';
						}else{
							echo '<option value="'.$d->kode_dptm.'">'.$d->nm_dptm.'</option>';
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="jabatan">Jabatan<span class="required"> *</span></label>
			<select name="jabatan" id="jabatan" class="form-control input-sm" required>
				<option value="">-- Pilih Jabatan --</option>
				<?php 
					foreach ($jabatan as $j) {
						if($j->kode_jabatan == $jbtn)
						{
							echo '<option value="'.$j->kode_jabatan.'" selected>'.$j->nama_jabatan.'</option>';
						}else{
							echo '<option value="'.$j->kode_jabatan.'">'.$j->nama_jabatan.'</option>';
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="atasan_1">Atasan Langsung</label>
			<select name="atasan_1" id="atasan_1" class="form-control input-sm">
				<option value="">-- Pilih Jabatan --</option>
				<?php 
					foreach ($jabatan as $j) {
						if($j->kode_jabatan == $ats_1)
						{
							echo '<option value="'.$j->kode_jabatan.'" selected>'.$j->nama_jabatan.'</option>';
						}else{
							echo '<option value="'.$j->kode_jabatan.'">'.$j->nama_jabatan.'</option>';
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="atasan_2">Atasan dari Atasan Langsung</label>
			<select name="atasan_2" id="atasan_2" class="form-control input-sm">
				<option value="">-- Pilih Jabatan --</option>
				<?php 
					foreach ($jabatan as $j) {
						if($j->kode_jabatan == $ats_2)
						{
							echo '<option value="'.$j->kode_jabatan.'" selected>'.$j->nama_jabatan.'</option>';
						}else{
							echo '<option value="'.$j->kode_jabatan.'">'.$j->nama_jabatan.'</option>';
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="form-group">
			<label for="no_kontrak">Nomor Kontrak<span class="required"> *</span></label>
			<input type="text" name="no_kontrak" id="no_kontrak" class="form-control input-sm" placeholder="Nomor Kontrak" required>
		</div>
		<div class="form-group">
			<label for="tgl_kontrak">Tanggal Kontrak<span class="required"> *</span></label>
			<div class="input-group">
				<input type="text" name="tgl_kontrak" id="tgl_kontrak" class="form-control input-sm" placeholder="Tanggal Kontrak - mm/dd/yyyy" required>
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label for="file_kontrak">Upload Berkas Kontrak tidak lebih dari 2MB.</label>
			<input type="file" name="file_kontrak" id="file_kontrak" class="form-control input-sm" accept="application/pdf" placeholder="Scan Berkas Kontrak">
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		<div class="form-group text-center">
			<input type="reset" class="btn btn-warning btn-sm" value="Reset">
			<input type="submit" id="submit_data" class="btn btn-primary btn-sm" onclick="return confirm('Apakah anda yakin sudah mengisi data dengan benar?')" value="Submit">
		</div>
	</div>
</form>