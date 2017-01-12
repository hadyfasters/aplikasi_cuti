<!-- BOX DASHBOARD KARYAWAN -->			
<div class="row">
	<div class="col-sm-6 col-md-6 col-lg-6 hidden-xs">
		<div class="img_box">
			<?php if ($dt[0]->foto<>'' && file_exists('./assets/files/'.$dt[0]->foto)) : ?>
				<img src="<?php echo base_url('assets/files/'.$dt[0]->foto); ?>" width="100">
			<?php else : ?>
				<img src="<?php echo base_url('assets/images/no_avatar.png'); ?>" width="100">
			<?php endif; ?>
		</div>
	</div>
	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
		<div class="pull-right text-center">
			<strong class="nama"><?php echo $dt[0]->nm_lengkap; ?></strong><br>
			<strong class="nik text-muted"><?php echo $dt[0]->nik; ?></strong><br>
			<strong class="nama"><?php echo @$jbt[0]->nama_jabatan; ?></strong><br>
			<strong class="nama"><?php echo @$dpt[0]->nm_dptm; ?></strong>
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		<h4 class="dashboard_title text-center" style="background:#e8e8e8;padding:3px;">Informasi Pribadi</h4>
		<?php if($this->session->userdata('prioritas')==1) : ?>
		<div class="button-toolbar">
			<a href="<?php echo base_url('karyawan/edit_data?id='.$dt[0]->nik) ?>" class="btn btn-primary">Update Data</a>
		</div>
		<br>
		<?php endif; ?>
		<div class="row">
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
				<div class="form-group">
					<label><b>Email</b></label>
					<br/>
					<?php echo $dt[0]->email; ?>
				</div>
				<div class="form-group">
					<label><b>Tempat / Tanggal Lahir</b></label>
					<br/>
					<?php echo $dt[0]->tmpt_lahir.", ".$this->apps_model->tgl_str($dt[0]->tgl_lahir); ?>
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
				<div class="form-group">
					<label><b>Telepon / HP</b></label>
					<br/>
					<?php echo ucwords($dt[0]->no_telp); ?>
				</div>
				<div class="form-group">
					<label><b>Alamat</b></label>
					<br/>
					<?php echo $dt[0]->alamat; ?>
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
				<div class="form-group">
					<label><b>Jenis Kelamin</b></label>
					<br/>
					<?php echo ucwords($dt[0]->jenis_kelamin); ?>
				</div>
				<div class="form-group">
					<label><b>Agama</b></label>
					<br/>
					<?php echo $dt[0]->agama; ?>
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
				<div class="form-group">
					<label><b>Status</b></label>
					<br/>
					<?php echo $dt[0]->status_nikah; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
		<h4 class="dashboard_title text-center" style="background:#e8e8e8;padding:3px;">Riwayat Posisi</h4>
		<?php if($this->session->userdata('prioritas')==1) : ?>
		<div class="button-toolbar">
			<a href="<?php echo base_url('posisi/add?id='.$dt[0]->nik) ?>" class="btn btn-primary">Update Posisi</a>
		</div>
		<br>
		<?php endif; ?>
		<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Jabatan</th>
					<th>Atasan Langsung</th>
					<th>Tgl. Kontrak</th>
					<th>No. Kontrak</th>
					<?php
					    if($this->session->userdata('logged_in') == "loginasadmin"){
					?>
					<th>Aksi</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($pos as $dt): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $dt->nik; ?></td>
					<td><?php echo $dt->nm_lengkap; ?></td>
					<td><?php echo $dt->jabatan; ?></td>
					<td><?php echo $dt->atasan_langsung; ?></td>
					<td><?php echo $dt->tgl_kontrak; ?></td>
					<td><?php echo $dt->no_kontrak; ?></td>
					<td>
						<a href="<?php echo base_url('posisi/delete?no='.$dt->no_kontrak); ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Delete</a>
					</td>
				</tr>
				<?php $no++; endforeach; ?>
			</tbody>
		</table>
	</div>
</div>