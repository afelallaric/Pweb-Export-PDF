<?php
require 'config.php';

$sql = "SELECT * FROM calon_siswa";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Siswa</title>
</head>

<body>
    <h1>Daftar Siswa</h1>
    <a href="form-daftar.php">[+] Tambah Siswa Baru</a>
    <a href="edit-siswa.php">[+] Edit Data Siswa</a>
    <a href="export-all-pdf.php">[+] Ekspor Semua PDF</a> <!-- Tombol Ekspor Semua -->
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Sekolah Asal</th>
                <th>Photo</th>
                <th>Upload Photo</th>
                <th>Ekspor</th>
                <th>Hapus</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= htmlspecialchars($row['agama']) ?></td>
                    <td><?= htmlspecialchars($row['sekolah_asal']) ?></td>
                    <td>
                        <?php if ($row['photo']): ?>
                            <img src="<?= $row['photo'] ?>" alt="Photo" width="100">
                        <?php else: ?>
                            Belum ada foto
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="upload-photo.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="photo" required>
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="upload">Upload</button>
                        </form>
                    </td>
                    <td>
                        <a href="export-row-pdf.php?id=<?= $row['id'] ?>">Ekspor PDF</a>
                    </td>
                    <td>
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                    <td>
                        <a href="edit-siswa.php?id=<?= $row['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>
