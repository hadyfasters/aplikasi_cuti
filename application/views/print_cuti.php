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
$this->fpdf->Cell(19,0.5,'PT. QPRO Consulting',0,0,'L'); 
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
$this->fpdf->SetFont('Times','BU',18); 
$this->fpdf->Cell(19,1,strtoupper($title),0,0,'C'); 

$this->fpdf->Ln(1); 

/* setting header table */ 
$this->fpdf->Ln(1); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 1, 'No.Pengajuan' , 0, 'LR', 'L'); 
$this->fpdf->Cell(1, 1, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12); 
$this->fpdf->Cell(6, 1, $no_pengajuan , 0, 'LR', 'L');
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 1, 'Tgl. Pengajuan' , 0, 'LR', 'L'); 
$this->fpdf->Cell(1, 1, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12);  
$this->fpdf->Cell(6, 1, $tgl_pengajuan, 0, 'LR', 'L');

$this->fpdf->Ln(1); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 0.7, 'NIK' , 0, 'LR', 'L');  
$this->fpdf->Cell(1, 0.7, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12); 
$this->fpdf->Cell(6, 0.7, $nik , 0, 'LR', 'L'); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 1, 'Jenis Cuti' , 0, 'LR', 'L'); 
$this->fpdf->Cell(1, 1, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12);  
$this->fpdf->Cell(6, 1, $nm_cuti, 0, 'LR', 'L');

$this->fpdf->Ln(1); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 0.7, 'Nama Lengkap' , 0, 'LR', 'L');  
$this->fpdf->Cell(1, 0.7, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12); 
$this->fpdf->Cell(6, 0.7, $nm_lengkap , 0, 'LR', 'L'); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 1, 'Jumlah Cuti' , 0, 'LR', 'L'); 
$this->fpdf->Cell(1, 1, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12);  
$this->fpdf->Cell(6, 1, $jumlah." Hari", 0, 'LR', 'L');

$this->fpdf->Ln(1); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 0.7, 'Jabatan' , 0, 'LR', 'L');  
$this->fpdf->Cell(1, 0.7, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12); 
$this->fpdf->Cell(6, 0.7, $nm_jbtn , 0, 'LR', 'L');
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 1, 'Tgl. Cuti' , 0, 'LR', 'L'); 
$this->fpdf->Cell(1, 1, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12);  
$this->fpdf->Cell(6, 1, $tgl_cuti, 0, 'LR', 'L');

$this->fpdf->Ln(1); 
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 0.7, 'Departemen' , 0, 'LR', 'L');  
$this->fpdf->Cell(1, 0.7, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12); 
$this->fpdf->Cell(6, 0.7, $nm_dptm , 0, 'LR', 'L');
$this->fpdf->SetFont('Times','B',12); 
$this->fpdf->Cell(3, 1, 'Keterangan' , 0, 'LR', 'L'); 
$this->fpdf->Cell(1, 1, ':' , 0, 'LR', 'C'); 
$this->fpdf->SetFont('Times','',12);  
$this->fpdf->Cell(6, 1, $keterangan, 0, 'LR', 'L');


/* setting posisi footer 3 cm dari bawah */ 
$this->fpdf->SetY(-4.05); 

$this->fpdf->SetFont('Times','B',23); 
$this->fpdf->Cell(19, 2, strtoupper($approval), 1, 'LR', 'C'); 

/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */ 
$this->fpdf->Output("approval_cuti.pdf","I"); 

?>