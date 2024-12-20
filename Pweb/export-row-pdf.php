<?php
require 'config.php';
require_once 'tcpdf/tcpdf.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data siswa berdasarkan ID
    $sql = "SELECT * FROM calon_siswa WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Inisialisasi PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    // Judul
    $pdf->Cell(0, 10, 'Detail Siswa', 0, 1, 'C');
    $pdf->Ln(5);

    // Isi Data
    $pdf->Cell(50, 10, 'ID:', 0);
    $pdf->Cell(0, 10, $row['id'], 0, 1);
    $pdf->Cell(50, 10, 'Nama:', 0);
    $pdf->Cell(0, 10, $row['nama'], 0, 1);
    $pdf->Cell(50, 10, 'Alamat:', 0);
    $pdf->Cell(0, 10, $row['alamat'], 0, 1);
    $pdf->Cell(50, 10, 'Jenis Kelamin:', 0);
    $pdf->Cell(0, 10, $row['jenis_kelamin'], 0, 1);
    $pdf->Cell(50, 10, 'Agama:', 0);
    $pdf->Cell(0, 10, $row['agama'], 0, 1);
    $pdf->Cell(50, 10, 'Sekolah Asal:', 0);
    $pdf->Cell(0, 10, $row['sekolah_asal'], 0, 1);

    // Tampilkan Foto jika ada
    if ($row['photo']) {
        $pdf->Ln(10);
        $pdf->Image($row['photo'], '', '', 40, 40);
    }

    // Output PDF
    $pdf->Output('detail_siswa.pdf', 'D');
} else {
    echo "ID tidak ditemukan!";
}
?>
