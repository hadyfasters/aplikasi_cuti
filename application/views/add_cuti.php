<form action="<?php echo base_url('cuti/create'); ?>" method="POST" enctype="multipart/form-data">
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="form-group">
			<label for="nm_lengkap">NIK</label>
			<br/>
			<?php echo $nik; ?>
			<input type="hidden" name="nik" id="nik" class="form-control input-sm" placeholder="Nomor Induk Karyawan" value="<?php echo $nik; ?>">
		</div>
		<div class="form-group">
			<label for="nm_lengkap">Nama Lengkap</label>
			<br/>
			<?php echo $nm_lengkap; ?>
			<input type="hidden" name="nm_lengkap" id="nm_lengkap" class="form-control input-sm" placeholder="Nama Lengkap" value="<?php echo $nm_lengkap; ?>" readonly required>
		</div>
		<div class="form-group">
			<label for="departemen">Departemen</label>
			<br/>
			<?php echo $nm_dptm; ?>
			<input type="hidden" name="departemen" id="departemen" class="form-control input-sm" placeholder="Departemen" value="<?php echo $dptm; ?>">
		</div>
		<div class="form-group">
			<label for="jabatan">Jabatan</label>
			<br/>
			<?php echo $nm_jbtn; ?>
			<input type="hidden" name="jabatan" id="jabatan" class="form-control input-sm" placeholder="Departemen" value="<?php echo $jbtn; ?>">
		</div>
		<div class="form-group">
			<label for="tgl_pengajuan">Tanggal Pengajuan Cuti</label>
			<br/>
			<?php $now = date('m/d/Y'); echo $now; ?>
			<input type="hidden" name="tgl_pengajuan" id="tgl_pengajuan" class="form-control input-sm" placeholder="Tanggal Pengajuan" value="<?php echo $now; ?>">
		</div>
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="form-group">
			<label for="cuti">Jenis Cuti<span class="required"> *</span></label>
			<select name="cuti" id="cuti" class="form-control input-sm" required>
				<option value="">-- Pilih Jenis Cuti --</option>
				<?php 
					foreach ($jenis_cuti as $jc) {
						$ct = $this->Cuti_model->getSisaCuti($nik,$jc->cuti);
						$sisa = $jc->jumlah_max - count($ct[0]);
						echo '<option value="'.$jc->kode_cuti.'">'.$jc->nm_cuti.' ('.$sisa.')</option>';
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="tgl_awal">Dari<span class="required"> *</span></label>
			<div class="input-group">
				<input type="text" name="tgl_awal" id="tgl_awal" class="form-control input-sm" placeholder="Tanggal Awal - mm/dd/yyyy" required>
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label for="tgl_akhir">Sampai<span class="required"> *</span></label>
			<div class="input-group">
				<input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control input-sm" placeholder="Tanggal Akhir - mm/dd/yyyy" required>
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label for="jumlah">Jumlah Cuti<span class="required"> *</span></label>
			<input type="number" name="jumlah" id="jumlah" class="form-control input-sm" min="1" placeholder="Jumlah Cuti" required>
		</div>
		<div class="form-group">
			<label for="keterangan">Keterangan<span class="required"> *</span></label>
			<textarea name="keterangan" id="keterangan" class="form-control input-sm" placeholder="Keterangan" required></textarea>
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		<div class="form-group text-center">
			<input type="reset" class="btn btn-warning btn-sm" value="Reset">
			<input type="submit" id="submit_data" class="btn btn-primary btn-sm" onclick="return confirm('Apakah anda yakin sudah mengisi data dengan benar?')" value="Submit">
		</div>
	</div>
</form>