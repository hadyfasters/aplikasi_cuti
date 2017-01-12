<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
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
				<?php
				    if($this->session->userdata('prioritas') == 1):
				?>
				<th>Aksi</th>
				<?php endif; ?>
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
				<?php
				    if($this->session->userdata('prioritas') == 1) :
				    	if($dt->approval < 1 && $dt->approval == 0) :
				?>
					 <a href="<?php echo base_url('approval/approve?id='.$dt->no_pengajuan); ?>" title="Approve"><i class="fa fa-thumbs-o-up">&nbsp;</i></a> &nbsp; 
					 <a href="<?php echo base_url('approval/reject?id='.$dt->no_pengajuan); ?>" title="Reject"><i class="fa fa-thumbs-o-down">&nbsp;</i></a>
				<?php endif; endif; ?>
				</td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
</div>