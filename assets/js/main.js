$(document).ready(function() {
	$('#tbl_cuti').DataTable();
	$('#tbl_izin').DataTable();
	$('#tbl_ultah').DataTable();
	$('#tbl_data').DataTable();

	$('#tgl_lahir').datepicker({
		dateformat: "yyyy-mm-dd",
		autoclose: true
	});
	$('#tgl_masuk').datepicker({
		dateformat: "yyyy-mm-dd",
		autoclose: true
	});
	$('#tgl_kontrak').datepicker({
		dateformat: "yyyy-mm-dd",
		autoclose: true
	});
	$('#tgl_awal').datepicker({
		dateformat: "yyyy-mm-dd",
		autoclose: true
	});
	$('#tgl_akhir').datepicker({
		dateformat: "yyyy-mm-dd",
		autoclose: true
	});   
});