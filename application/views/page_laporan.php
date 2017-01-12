<?php
$this->fpdf = new FPDF("P","cm","A4"); 

// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm 
$this->fpdf->SetMargins(1,1,1); 

/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman di footer, nanti kita akan membuat page number dengan format : number page / total page */ 
$this->fpdf->AliasNbPages(); 

// AddPage merupakan fungsi untuk membuat halaman baru 
$this->fpdf->AddPage(); 

// Setting Font : String Family, String Style, Font size 
$this->fpdf->SetFont('Times','B',14); 

/* Kita akan membuat header dari halaman pdf yang kita buat -------------- Header Halaman dimulai dari baris ini ----------------------------- */ 
$this->fpdf->Cell(19,0.5,'PT. QPRO Sukses Mandiri',0,0,'L'); 
$this->fpdf->SetFont('Times','',12);
$this->fpdf->Ln(); $this->fpdf->Cell(19,0.5,'Plaza Sentral Lt.9 No.904',0,0,'L');
$this->fpdf->Ln(); $this->fpdf->Cell(19,0.5,'Jl. Jenderal Sudirman Kav.47',0,0,'L');
$this->fpdf->Ln(); $this->fpdf->Cell(19,0.5,'Jakarta Selatan - Indonesia',0,0,'L');

$this->fpdf->Line(1,3.1,20,3.1); 
$this->fpdf->Line(1,3.15,20,3.15); 
// fungsi Ln untuk membuat baris baru 
//$this->fpdf->Ln(); //$this->fpdf->Ln(); 

/* Setting ulang Font : String Family, String Style, Font size kenapa disetting ulang ??? jika tidak disetting ulang, ukuran font akan mengikuti settingan sebelumnya. tetapi karena kita menginginkan settingan untuk penulisan alamatnya berbeda, maka kita harus mensetting ulang Font nya. jika diatas settingannya : helvetica, 'B', '12' khusus untuk penulisan alamat, kita setting : helvetica, '', 10 yang artinya string stylenya normal / tidak Bold dan ukurannya 10 */ 
// $this->fpdf->SetFont('helvetica','',10); 
// $this->fpdf->Cell(19,0.5,'Sub judul',0,0,'L'); 
// $this->fpdf->Ln(); 
// $this->fpdf->Cell(19,0.5,'subtitle',0,0,'L'); 

/* Fungsi Line untuk membuat garis */ 
// $this->fpdf->Line(1,1.7,20,1.7); 
// $this->fpdf->Line(1,1.75,20,1.75); 

/* -------------- Header Halaman selesai ------------------------------------------------*/ 
$this->fpdf->Ln(1); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(19,0.5,'REKAPITULASI PENGAJUAN CUTI',0,0,'C'); 
if($date <> '')
{
	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','',12);
	$this->fpdf->Cell(19,0.5,$date,0,0,'C'); 
}

/* setting header table */ 
$this->fpdf->Ln(0.7); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3.5, 0.7, 'No.Pengajuan' , 1, 'LR', 'C'); 
$this->fpdf->Cell(4, 0.7, 'Nama Karyawan' , 1, 'LR', 'C'); 
$this->fpdf->Cell(3.5, 0.7, 'Tgl. Pengajuan' , 1, 'LR', 'C'); 
$this->fpdf->Cell(5, 0.7, 'Tgl. Cuti' , 1, 'LR', 'C'); 
$this->fpdf->Cell(3, 0.7, 'Status' , 1, 'LR', 'C'); 

if(count($hasil) > 0)
{
	/* generate hasil query disini */ 
	foreach($hasil as $data) { 
		$status = "Pending";
		if($data->approval==1 && $data->validasi==1)
		{
			$status = "Approved";
		}elseif($data->approval==2 && $data->validasi==0)
		{
			$status = "Rejected";
		}elseif($data->approval==1 && $data->validasi==2) 
		{
			$status = "Invalid";
		}
		$tgl_cuti =  date('d M Y',strtotime($data->tgl_awal))." - ". date('d M Y',strtotime($data->tgl_akhir));
		$this->fpdf->Ln(); 
		$this->fpdf->SetFont('Times','',12); 
		$this->fpdf->Cell(3.5, 0.7, $data->no_pengajuan, 1, 'LR', 'C'); 
		$this->fpdf->Cell(4, 0.7, $data->nm_lengkap, 1, 'LR', 'L'); 
		$this->fpdf->Cell(3.5, 0.7, date('d M Y',strtotime($data->tgl_pengajuan)), 1, 'LR', 'C');
		$this->fpdf->Cell(5, 0.7, $tgl_cuti, 1, 'LR', 'C');  
		$this->fpdf->Cell(3, 0.7, $status, 1, 'LR', 'C'); 
	} 	
}else{
	$this->fpdf->Ln(); 
	$this->fpdf->SetFont('Times','',12); 
	$this->fpdf->Cell(19, 0.7, '- No Data -', 1, 'LR', 'C'); 
}

/* setting posisi footer 3 cm dari bawah */ 
$this->fpdf->SetY(-3); 

/* setting font untuk footer */ 
$this->fpdf->SetFont('Times','',10); 

/* setting cell untuk waktu pencetakan */ 
$this->fpdf->Cell(9.5, 0.5, 'Printed on : '.date('d/m/Y H:i').' | Rekapitulasi Pengajuan Cuti',0,'LR','L'); 

/* setting cell untuk page number */ 
$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R'); 

/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */ 
$this->fpdf->Output("rekap_cuti.pdf","I"); 

?>