<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
	<div class="button-toolbar">
		<a href="<?php echo base_url('posisi/add') ?>" class="btn btn-primary">Tambah Posisi Karyawan</a>
	</div>
	<br>
	<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Atasan Langsung</th>
				<th>Kepala Departemen</th>
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
			<?php $no=1; foreach ($list as $dt): ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $dt->nik; ?></td>
				<td><?php echo $dt->nm_lengkap; ?></td>
				<td><?php echo $dt->atasan_1; ?></td>
				<td><?php echo $dt->atasan_2; ?></td>
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