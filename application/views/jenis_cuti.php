<div class="col-md-3 col-sm-3 col-xs-12">
<?php if(isset($edit) && $edit == 1) : ?>
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Jenis Cuti</h3>
		</div>
		<div class="box-body no-padding">
			<form class="form-horizontal" action="<?php echo base_url('jenis_cuti/edit'); ?>" method="POST">
				<input type="hidden" name="kode_cuti" value="<?php echo $kode; ?>">
				<div class="form-group">
					<label for="nm_cuti">Nama Cuti :</label>
					<input type="text" class="form-control input-sm" id="nm_cuti" name="nm_cuti" placeholder="Nama Cuti" value="<?php echo $nama; ?>">
				</div>
				<div class="form-group">
					<label for="jumlah_max">Jumlah Maksimal :</label>
					<input type="number" class="form-control input-sm" id="jumlah_max" name="jumlah_max" placeholder="Jumlah Maksimal Cuti" value="<?php echo $jumlah_max; ?>">
				</div>
				<div class="form-group">
					<label for="grup">Grup Cuti :</label>
					<select class="form-control" name="grup" id="grup">
						<option value="">- Pilih Grup -</option>
						<option value="0">Semua</option>
						<option value="1">Pria</option>
						<option value="2">Wanita</option>
					</select>
				</div>
				<div class="form-group text-center">
					<div class="checkbox">
						<label class="radio-inline">
						<input type="radio" name="status" value="0" <?php echo ($status == 0 ? "checked" : ""); ?> >&nbsp;Inactive
						</label>
						<label class="radio-inline">
						<input type="radio" name="status" value="1" <?php echo ($status == 1 ? "checked" : ""); ?> >&nbsp;Active
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
			<h3 class="box-title">Input Jenis Cuti</h3>
		</div>
		<div class="box-body no-padding">
			<form class="form-horizontal" action="<?php echo base_url('jenis_cuti/create'); ?>" method="POST">
				<div class="form-group">
					<label for="nm_cuti">Nama Cuti :</label>
					<input type="text" class="form-control input-sm" id="nm_cuti" name="nm_cuti" placeholder="Nama Cuti">
				</div>
				<div class="form-group">
					<label for="jumlah_max">Jumlah Maksimal :</label>
					<input type="number" class="form-control input-sm" id="jumlah_max" name="jumlah_max" min="1" placeholder="Jumlah Maksimal Cuti">
				</div>
				<div class="form-group">
					<label for="grup">Grup Cuti :</label>
					<select class="form-control" name="grup" id="grup">
						<option value="">- Pilih Grup -</option>
						<option value="0">Semua</option>
						<option value="1">Pria</option>
						<option value="2">Wanita</option>
					</select>
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
			<h3 class="box-title">Daftar Jenis Cuti</h3>
		</div>
		<div class="box-body no-padding">
			<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Jumlah Maksimal</th>
						<th>Grup</th>
						<th>Status</th>
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
						<td><?php echo $dt->kode_cuti; ?></td>
						<td><?php echo $dt->nm_cuti; ?></td>
						<td><?php echo $dt->jumlah_max; ?></td>
						<td>
							<?php 
				                switch ($dt->grup) {
				                    case 1: $dt->grup = "Pria"; break;
				                    case 2: $dt->grup = "Wanita"; break;
				                    default: $dt->grup = "Semua"; break;
				                }
								echo $dt->grup; 
							?>								
						</td>
						<td>
							<?php
								echo ($dt->status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>"); 
							?>				
						</td>
						<td>
							<a href="<?php echo base_url('jenis_cuti?id='.$dt->kode_cuti); ?>">Edit</a> | <a href="<?php echo base_url('jenis_cuti/delete?id='.$dt->kode_cuti); ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Delete</a>
						</td>
					</tr>
					<?php $no++; endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>