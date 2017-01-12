<div class="col-md-3 col-sm-3 col-xs-12">
<?php if(isset($edit) && $edit == 1) : ?>
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Jabatan</h3>
		</div>
		<div class="box-body no-padding">
			<form class="form-horizontal" action="<?php echo base_url('jabatan/edit'); ?>" method="POST">
				<input type="hidden" name="kode_jabatan" value="<?php echo $kode; ?>">
				<div class="form-group">
					<label for="start_date">Nama Jabatan :</label>
					<input type="text" class="form-control input-sm" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan" value="<?php echo $nama; ?>">
				</div>
				<div class="form-group">
					<label for="end_date">Inisial Jabatan :</label>
					<input type="text" class="form-control input-sm" id="inisial_jabatan" name="inisial_jabatan" placeholder="Inisial Jabatan" value="<?php echo $inisial; ?>">
				</div>
				<div class="form-group">
					<label>Prioritas Jabatan :</label>
					<div class="checkbox text-center">
						<label class="radio-inline">
						<input type="radio" name="prioritas_jabatan" value="0" <?php echo ($prioritas == 0 ? "checked" : ""); ?> >&nbsp;Low
						</label>
						<label class="radio-inline">
						<input type="radio" name="prioritas_jabatan" value="1" <?php echo ($prioritas == 1 ? "checked" : ""); ?> >&nbsp;High
						</label>
					</div>
				</div>
				<div class="form-group">
					<label>Status Jabatan :</label>
					<div class="checkbox text-center">
						<label class="radio-inline">
						<input type="radio" name="status_jabatan" value="0" <?php echo ($status == 0 ? "checked" : ""); ?> >&nbsp;Inactive
						</label>
						<label class="radio-inline">
						<input type="radio" name="status_jabatan" value="1" <?php echo ($status == 1 ? "checked" : ""); ?> >&nbsp;Active
						</label>
					</div>
				</div>
				<div class="form-group text-center">
					<input type="reset" class="btn btn-warning btn-xs" value="Reset">
					<input type="submit" class="btn btn-primary btn-xs" onclick="return confirm('Apakah anda yakin sudah mengisi data dengan benar?')" value="Save">
				</div>
			</form>
		</div>
	</div>
<?php else : ?>
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Input Jabatan</h3>
		</div>
		<div class="box-body no-padding">
			<form class="form-horizontal" action="<?php echo base_url('jabatan/create'); ?>" method="POST">
				<div class="form-group">
					<label for="start_date">Nama Jabatan :</label>
					<input type="text" class="form-control input-sm" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan">
				</div>
				<div class="form-group">
					<label for="end_date">Inisial Jabatan :</label>
					<input type="text" class="form-control input-sm" id="inisial_jabatan" name="inisial_jabatan" placeholder="Inisial Jabatan">
				</div>
				<div class="form-group text-center">
					<input type="reset" class="btn btn-warning btn-xs" value="Reset">
					<input type="submit" class="btn btn-primary btn-xs" value="Add">
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>
</div>
<div class="col-md-9 col-sm-9 col-xs-12">
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Daftar Jabatan</h3>
		</div>
		<div class="box-body no-padding">
			<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Inisial</th>
						<th>Prioritas</th>
						<th>Status</th>
						<?php
						    if($this->session->userdata('logged_in') == "loginasadmin"){
						?>
						<th>Aksi</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($jabatan as $jbt): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $jbt->kode_jabatan; ?></td>
						<td><?php echo $jbt->nama_jabatan; ?></td>
						<td><?php echo $jbt->inisial_jabatan; ?></td>
						<td>
							<?php
								echo ($jbt->prioritas_jabatan == 1 ? "<span class='label label-primary'>High</span>" : "<span class='label label-warning'>Low</span>"); 
							?>				
						</td>
						<td>
							<?php
								echo ($jbt->status_jabatan == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>"); 
							?>				
						</td>
						<td>
							<a href="<?php echo base_url('jabatan?id='.$jbt->kode_jabatan); ?>">Edit</a> | <a href="<?php echo base_url('jabatan/delete?id='.$jbt->kode_jabatan); ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Delete</a>
						</td>
					</tr>
					<?php $no++; endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>