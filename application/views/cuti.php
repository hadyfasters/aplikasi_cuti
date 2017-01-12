<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
	<div class="button-toolbar">
		<a href="<?php echo base_url('cuti/add') ?>" class="btn btn-primary">Input Cuti</a>
	</div>
	<br>
	<table id="tbl_data" class="table table-bordered table-striped" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama</th>
				<th>Jenis</th>
				<th>Jumlah</th>
				<th>Pengajuan</th>
				<th>Approve</th>
				<th>Validasi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($list as $dt): ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $dt->nm_lengkap; ?></td>
				<td><?php echo $dt->nm_cuti; ?></td>
				<td><?php echo $dt->jumlah; ?></td>
				<td><?php echo date('m/d/Y',strtotime($dt->tgl_pengajuan)); ?></td>
				<td>
					<?php
						switch ($dt->approval) {
							case 1: $approval = "<span class='label label-success'>Approved</span>"; break;
							case 2: $approval = "<span class='label label-danger'>Rejected</span>"; break;
							
							default: $approval = "<span class='label label-default'>Pending</span>"; break;
						}
						echo $approval; 
					?>				
				</td>
				<td>
					<?php
						switch ($dt->validasi) {
							case 1: $validasi = "<span class='label label-success'>Valid</span>"; break;
							case 2: $validasi = "<span class='label label-danger'>Invalid</span>"; break;
							
							default: $validasi = "<span class='label label-default'>Pending</span>"; break;
						}
						echo $validasi; 
					?>			
				</td>
				<td>
					 <a href="<?php echo base_url('cuti/view?id='.$dt->no_pengajuan); ?>"><i class="fa fa-eye">&nbsp;</i></a>
				<?php if($dt->approval == 1 && $dt->validasi == 1) : ?>
					<a href="<?php echo base_url('cuti/print_out?no='.$dt->no_pengajuan); ?>" class="text-success" target="_blank"><i class="fa fa-print">&nbsp;</i></a>
				<?php endif; ?>

				<?php
				    if($this->session->userdata('prioritas') == 1) :
				    	if($dt->approval == 1 && $dt->validasi <> 1 && $dt->validasi <> 2) :
				?>
					 <a href="<?php echo base_url('cuti/edit_data?id='.$dt->no_pengajuan); ?>"><i class="fa fa-edit text-success">&nbsp;</i></a>
					 <a href="<?php echo base_url('cuti/delete?id='.$dt->no_pengajuan); ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fa fa-trash text-danger">&nbsp;</i></a>
				<?php endif; endif; ?>
				</td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
</div>