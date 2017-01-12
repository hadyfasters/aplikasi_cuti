<form action="<?php echo base_url('karyawan/edit'); ?>" method="POST" enctype="multipart/form-data">
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="form-group">
			<label for="nm_lengkap">NIK<span class="required"> *</span></label>
			<input type="text" name="nik" id="nik" class="form-control input-sm" placeholder="NIK" value="<?php echo $nik; ?>" readonly required>
		</div>
		<div class="form-group">
			<label for="nm_lengkap">Nama Lengkap<span class="required"> *</span></label>
			<input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control input-sm" placeholder="Nama Lengkap" value="<?php echo $nm_lengkap; ?>" required>
		</div>
		<div class="form-group">
			<label for="email">Email<span class="required"> *</span></label>
			<input type="text" name="email" id="email" class="form-control input-sm" placeholder="Email" value="<?php echo $email; ?>" required>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
		</div>
		<div class="form-group">
			<label for="password2">Konfirmasi Password</label>
			<input type="password" name="password2" id="password2" class="form-control input-sm" placeholder="Konfirmasi Password">
		</div>
		<div class="form-group">
			<label for="tmpt_lahir">Tempat Lahir<span class="required"> *</span></label>
			<input type="text" name="tmpt_lahir" id="tmpt_lahir" class="form-control input-sm" placeholder="Tempat Lahir" value="<?php echo $tmpt_lahir; ?>" required>
		</div>
		<div class="form-group">
			<label for="tgl_lahir">Tanggal Lahir<span class="required"> *</span></label>
			<div class="input-group">
				<input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control input-sm" placeholder="Tanggal Lahir - mm/dd/yyyy" value="<?php echo $tgl_lahir; ?>" required>
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label for="jenis_kelamin">Jenis Kelamin<span class="required"> *</span></label>
			<select name="jenis_kelamin" id="jenis_kelamin" class="form-control input-sm" required>
				<option value="">-- Pilih Jenis Kelamin --</option>
				<option value="pria" <?php echo ($jenis_kelamin=="pria"?"selected":""); ?>>Pria</option>
				<option value="wanita" <?php echo ($jenis_kelamin=="wanita"?"selected":""); ?>>Wanita</option>
			</select>
		</div>
		<div class="form-group">
			<label for="alamat">Alamat<span class="required"> *</span></label>
			<textarea name="alamat" id="alamat" class="form-control input-sm" placeholder="Alamat" required><?php echo $alamat; ?></textarea>
		</div>
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="form-group">
			<label for="agama">Agama<span class="required"> *</span></label>
			<input type="text" name="agama" id="agama" class="form-control input-sm" placeholder="Agama" value="<?php echo $agama; ?>" required>
		</div>
		<div class="form-group">
			<label for="no_telp">No. Telepon<span class="required"> *</span></label>
			<input type="text" name="no_telp" id="no_telp" class="form-control input-sm" placeholder="No. Telepon" value="<?php echo $no_telp; ?>" required>
		</div>
		<div class="form-group">
			<label for="status_nikah">Status<span class="required"> *</span></label>
			<select name="status_nikah" id="status_nikah" class="form-control input-sm" required>
				<option value="">-- Pilih Status --</option>
				<option value="belum menikah" <?php echo ($status_nikah=="belum menikah"?"selected":""); ?>>Belum Menikah</option>
				<option value="menikah" <?php echo ($status_nikah=="menikah"?"selected":""); ?>>Menikah</option>
			</select>
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
			<label for="tgl_masuk">Tanggal Masuk<span class="required"> *</span></label>
			<div class="input-group">
				<input type="text" name="tgl_masuk" id="tgl_masuk" class="form-control input-sm" placeholder="Tanggal Masuk - mm/dd/yyyy" value="<?php echo $tgl_masuk; ?>" required>
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label for="foto">Upload Foto tidak lebih dari 2MB. (image only)</label>
			<input type="file" name="foto" id="foto" class="form-control input-sm" accept="image/*" placeholder="Upload Foto">
		</div>
		<div class="form-group">
			<label for="ttd">Upload Scan TTD tidak lebih dari 2MB. (image only)</label>
			<input type="file" name="ttd" id="ttd" class="form-control input-sm" accept="image/*" placeholder="Scan Tanda Tangan">
		</div>
		<div class="form-group">
			<label>Status Karyawan :</label>
			<div class="checkbox">
				<label class="radio-inline">
				<input type="radio" name="status_karyawan" value="0" <?php echo ($status_karyawan == 0 ? "checked" : ""); ?> >&nbsp;Inactive
				</label>
				<label class="radio-inline">
				<input type="radio" name="status_karyawan" value="1" <?php echo ($status_karyawan == 1 ? "checked" : ""); ?> >&nbsp;Active
				</label>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		<div class="form-group text-center">
			<input type="reset" class="btn btn-warning btn-sm" value="Reset">
			<input type="submit" id="submit_data" class="btn btn-primary btn-sm" onclick="return confirm('Apakah anda yakin sudah mengisi data dengan benar?')" value="Submit">
		</div>
	</div>
</form>