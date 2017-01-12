<form action="<?php echo base_url('cuti/edit'); ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="no_pengajuan" value="<?php echo $no_pengajuan; ?>">
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
		</div>
		<div class="form-group">
			<label for="tgl_awal">Dari</label>
			<br/>
			<?php echo $tgl_awal; ?>
		</div>
		<div class="form-group">
			<label for="tgl_akhir">Sampai</label>
			<br/>
			<?php echo $tgl_akhir; ?>
		</div>
		<div class="form-group">
			<label for="jumlah">Jumlah Cuti</label>
			<br/>
			<?php echo $jumlah; ?>
		</div>
		<div class="form-group">
			<label for="keterangan">Keterangan</label>
			<br/>
			<?php echo $keterangan; ?>
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		<div class="form-group text-center">
			<a href="<?php echo base_url('cuti/print_out?no='.$no_pengajuan); ?>" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-print">&nbsp;</i>Print</a>
			<a href="<?php echo base_url('cuti'); ?>" class="btn btn-primary btn-sm">Back</a>
		</div>
	</div>
</form>