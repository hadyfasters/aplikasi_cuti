<form action="<?php echo base_url('approval/save'); ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="no_pengajuan" value="<?php echo $no_pengajuan; ?>">
	<input type="hidden" name="approval" value="1">
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
			<?php echo $tgl_pengajuan; ?>
			<input type="hidden" name="tgl_pengajuan" id="tgl_pengajuan" class="form-control input-sm" placeholder="Tanggal Pengajuan" value="<?php echo $tgl_pengajuan; ?>">
		</div>
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="form-group">
			<label for="cuti">Jenis Cuti</label>
			<br/>
			<?php echo $nm_cuti; ?>
			<input type="hidden" name="cuti" id="cuti" class="form-control input-sm" placeholder="Jenis Cuti" value="<?php echo $cuti; ?>">
		</div>
		<div class="form-group">
			<label for="tgl_awal">Dari</label>
			<br/>
			<?php echo $tgl_awal; ?>
			<input type="hidden" name="tgl_awal" id="tgl_awal" class="form-control input-sm" placeholder="Tanggal Awal" value="<?php echo $tgl_awal; ?>">
		</div>
		<div class="form-group">
			<label for="tgl_akhir">Sampai</label>
			<br/>
			<?php echo $tgl_akhir; ?>
			<input type="hidden" name="tgl_akhir" id="tgl_akhir" class="form-control input-sm" placeholder="Tanggal Awal" value="<?php echo $tgl_akhir; ?>">
		</div>
		<div class="form-group">
			<label for="jumlah">Jumlah Cuti</label>
			<br/>
			<?php echo $jumlah; ?>
			<input type="hidden" name="jumlah" id="jumlah" class="form-control input-sm" placeholder="Tanggal Awal" value="<?php echo $jumlah; ?>">
		</div>
		<div class="form-group">
			<label for="keterangan">Keterangan</label>
			<br/>
			<?php echo $keterangan; ?>
			<input type="hidden" name="keterangan" id="keterangan" class="form-control input-sm" placeholder="Tanggal Awal" value="<?php echo $keterangan; ?>">
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		<div class="form-group text-center">
			<input type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure to Approve this?')" value="Approve">
			<a href="<?php echo base_url('approval'); ?>" class="btn btn-primary btn-sm">Back</a>
		</div>
	</div>
</form>