<div class="col-md-3 col-sm-3 col-xs-12">
<?php if(isset($edit) && $edit == 1) : ?>
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Departemen</h3>
		</div>
		<div class="box-body no-padding">
			<form class="form-horizontal" action="<?php echo base_url('departemen/edit'); ?>" method="POST">
				<input type="hidden" name="kode_dptm" value="<?php echo $kode; ?>">
				<div class="form-group">
					<label for="start_date">Nama Departemen :</label>
					<input type="text" class="form-control input-sm" id="departemen_nm" name="nm_dptm" placeholder="Nama Departemen" value="<?php echo $nama; ?>">
				</div>
				<div class="form-group">
					<label for="end_date">Inisial Departemen :</label>
					<input type="text" class="form-control input-sm" id="inisial" name="inisial" placeholder="Inisial Departemen" value="<?php echo $inisial; ?>">
				</div>
				<div class="form-group text-center">
					<div class="checkbox">
						<label class="radio-inline">
						<input type="radio" name="status_dptm" value="0" <?php echo ($status == 0 ? "checked" : ""); ?> >&nbsp;Inactive
						</label>
						<label class="radio-inline">
						<input type="radio" name="status_dptm" value="1" <?php echo ($status == 1 ? "checked" : ""); ?> >&nbsp;Active
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
			<h3 class="box-title">Input Departemen</h3>
		</div>
		<div class="box-body no-padding">
			<form class="form-horizontal" action="<?php echo base_url('departemen/create'); ?>" method="POST">
				<div class="form-group">
					<label for="start_date">Nama Departemen :</label>
					<input type="text" class="form-control input-sm" id="departemen_nm" name="nm_dptm" placeholder="Nama Departemen">
				</div>
				<div class="form-group">
					<label for="end_date">Inisial Departemen :</label>
					<input type="text" class="form-control input-sm" id="inisial" name="inisial" placeholder="Inisial Departemen">
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
			<h3 class="box-title">Daftar Departemen</h3>
		</div>
		<div class="box-body no-padding">
			<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Inisial</th>
						<th>Status</th>
						<?php
						    if($this->session->userdata('logged_in') == "loginasadmin"){
						?>
						<th>Aksi</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($departemen as $dptm): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $dptm->kode_dptm; ?></td>
						<td><?php echo $dptm->nm_dptm; ?></td>
						<td><?php echo $dptm->inisial_dptm; ?></td>
						<td>
							<?php
								echo ($dptm->status_dptm == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>"); 
							?>				
						</td>
						<td>
							<a href="<?php echo base_url('departemen?id='.$dptm->kode_dptm); ?>">Edit</a> 
							<?php if($dptm->kode_dptm <> 'D.01.16.11.001') : ?> 
							| 
							<a href="<?php echo base_url('departemen/delete?id='.$dptm->kode_dptm); ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Delete</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php $no++; endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>