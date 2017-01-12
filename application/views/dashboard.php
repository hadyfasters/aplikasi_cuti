<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<fieldset>
			<legend>Data Cuti</legend>
			<div class="table-responsive">
				<table id="tbl_cuti" class="table table-bordered table-striped table-condensed" cellspacing="0" width="100%">
					<thead style="background:#e8e8e8;">
						<tr>
							<th>Nama Karyawan</th>
							<th>Jabatan</th>
							<th>Divisi / Departemen</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach ($cuti as $val) {
						echo '<tr>';
						echo '<td>'.$val->nm_lengkap.'</td>';
						echo '<td>'.$val->nama_jabatan.'</td>';
						echo '<td>'.$val->nm_dptm.'</td>';
						echo '</tr>';
						}
					?>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div>
	<!-- <div class="col-md-12 col-sm-12 col-xs-12">
		<fieldset>
			<legend>SAKIT / IZIN</legend>
			<div class="table-responsive">
				<table id="tbl_izin" class="table table-bordered table-striped table-condensed" cellspacing="0" width="100%">
					<thead style="background:#e8e8e8;">
						<tr>
							<th>Nama Karyawan</th>
							<th>Jabatan</th>
							<th>Divisi / Departemen</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Aryo Seno</td>
							<td>HR Manager</td>
							<td>Human Resources</td>
						</tr>
						<tr>
							<td>Meyse Frisly Angelika</td>
							<td>HR Admin Assistant</td>
							<td>Human Resources</td>
						</tr>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div> -->
	<div class="col-md-12 col-sm-12 col-xs-12">
		<fieldset>
			<legend>Ulang Tahun (<?php echo date('d-m-Y'); ?>)</legend>
			<div class="table-responsive">
				<table id="tbl_ultah" class="table table-bordered table-striped table-condensed">
					<thead style="background:#e8e8e8;">
						<tr>
							<th>Nama Karyawan</th>
							<th>Jabatan</th>
							<th>Divisi / Departemen</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($ultah as $val) {
							echo '<tr>';
							echo '<td>'.$val->nm_lengkap.'</td>';
							echo '<td>'.$val->jabatan.'</td>';
							echo '<td>'.$val->departemen.'</td>';
							echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div>
</div>