
<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
	<form action="<?php echo base_url('report'); ?>" method="GET">
		<div class="form-group">
			<select name="month" class="form-control input-sm">
				<option value="">- Pilih Bulan -</option>
				<option value="1">Januari</option>
				<option value="2">Februari</option>
				<option value="3">Maret</option>
				<option value="4">April</option>
				<option value="5">Mei</option>
				<option value="6">Juni</option>
				<option value="7">Juli</option>
				<option value="8">Agustus</option>
				<option value="9">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
			</select>
		</div>
		<div class="form-group">
			<?php
				$cutoff = 2010;
				$now = date('Y');
				echo '<select name="year" class="form-control input-sm">' . PHP_EOL;
				echo '<option value="">- Pilih Tahun -</option>';
			    for ($y=$now; $y>=$cutoff; $y--) {
			        echo '  <option value="' . $y . '">' . $y . '</option>' . PHP_EOL;
			    }
			    echo '</select>' . PHP_EOL;
			?>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary btn-sm" value="Show">
		</div>
	</form>
</div>
<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
	<form action="<?php echo base_url('report/download'); ?>" method="POST" target="_blank">
		<div class="form-group text-right">
			<input type="hidden" name="month" value="<?php echo $this->input->get('month'); ?>">
			<input type="hidden" name="year" value="<?php echo $this->input->get('year'); ?>">
			<input type="submit" class="btn btn-warning btn-xs" value="Export to PDF">
		</div>
	</form>
	<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>No. Pengajuan</th>
				<th>Nama Karyawan</th>
				<th>Tgl. Pengajuan</th>
				<th>Tgl. Cuti</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($list as $dt): ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $dt->no_pengajuan; ?></td>
				<td><?php echo $dt->nm_lengkap; ?></td>
				<td><?php echo date('d M Y',strtotime($dt->tgl_pengajuan)); ?></td>
				<td>
					<?php
						$tgl_cuti =  date('d M Y',strtotime($dt->tgl_awal))." - ". date('d M Y',strtotime($dt->tgl_akhir));
						echo $tgl_cuti; 
					?>				
				</td>
				<td>
					<?php
						$status = "<span class='label label-default'>Pending</span>";
						if($dt->approval==1 && $dt->validasi==1)
						{
							$status = "<span class='label label-success'>Approved</span>";
						}elseif($dt->approval==2 && $dt->validasi==0)
						{
							$status = "<span class='label label-danger'>Rejected</span>";
						}elseif($dt->approval==1 && $dt->validasi==2) 
						{
							$status = "<span class='label label-warning'>Invalid</span>";
						}
						echo $status; 
					?>			
				</td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
</div>