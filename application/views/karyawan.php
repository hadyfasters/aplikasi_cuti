<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
	<?php if($this->session->userdata('prioritas')==1 && $this->session->userdata('divisi')=='D.01.16.11.002') : ?>
	<div class="button-toolbar">
		<a href="<?php echo base_url('karyawan/add') ?>" class="btn btn-primary">Tambah Karyawan</a>
	</div>
	<br>
	<?php endif; ?>
	<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>TTL</th>
				<th>Telp/HP</th>
				<th>Email</th>
				<th>Tgl.Masuk</th>
				<th>Aktif</th>
				<?php
				    if($this->session->userdata('logged_in') == "loginasadmin" && $this->session->userdata('divisi')=='D.01.16.11.002'){
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
				<td><?php echo $dt->tmpt_lahir.",".$dt->tgl_lahir; ?></td>
				<td><?php echo $dt->no_telp; ?></td>
				<td><?php echo $dt->email; ?></td>
				<td><?php echo $dt->tgl_masuk; ?></td>
				<td>
					<?php
						echo ($dt->status_karyawan == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>"); 
					?>				
				</td>
				<?php
				    if($this->session->userdata('logged_in') == "loginasadmin" && $this->session->userdata('divisi')=='D.01.16.11.002'){
				?>
				<td>
					 <a href="<?php echo base_url('karyawan/view?id='.$dt->nik); ?>"><i class="fa fa-eye">&nbsp;</i></a>
					 <a href="<?php echo base_url('karyawan/edit_data?id='.$dt->nik); ?>"><i class="fa fa-edit text-success">&nbsp;</i></a>
					 <a href="<?php echo base_url('karyawan/delete?id='.$dt->nik); ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fa fa-trash text-danger">&nbsp;</i></a>
				</td>
				<?php } ?>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
</div>