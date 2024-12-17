<?php
require 'config.php';
require_once 'tcpdf/tcpdf.php';

// Ambil semua data siswa
$sql = "SELECT * FROM calon_siswa";
$result = mysqli_query($conn, $sql);

// Inisialisasi PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Judul PDF
$pdf->Cell(0, 10, 'Daftar Siswa', 0, 1, 'C');
$pdf->Ln(5);

// Header tabel
$header = ['ID', 'Nama', 'Alamat', 'Jenis Kelamin', 'Agama', 'Sekolah Asal'];
foreach ($header as $col) {
    $pdf->Cell(30, 10, $col, 1);
}
$pdf->Ln();

// Isi tabel
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(30, 10, $row['id'], 1);
    $pdf->Cell(30, 10, $row['nama'], 1);
    $pdf->Cell(30, 10, $row['alamat'], 1);
    $pdf->Cell(30, 10, $row['jenis_kelamin'], 1);
    $pdf->Cell(30, 10, $row['agama'], 1);
    $pdf->Cell(30, 10, $row['sekolah_asal'], 1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output('daftar_siswa.pdf', 'D');
?>
