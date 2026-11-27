<?php

require_once 'koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);

if (!$stmt) {
    die("Query gagal: " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$baris = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$baris) {
    die("Data anggota tidak ditemukan!");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF=8">
    <meta name="viewport" content="width=device-width, initial-scale.0">
</head>

<body>
    <h2>Edit Data Anggota</h2>

    <form action="proses_update.php" method="POST">

        <input type="hidden" name="id"
            value="<?= $baris['id']; ?>">

        <label>Nomor Anggota</label><br>
        <input type="text" name="no_anggota"
            value="<?= htmlspecialchars($baris['no_anggota']); ?>"
            maxlength="15" required>
        <br></br>

        <label>Nama Lengkap</label><br>
        <input type="text" name="nama_lengkap"
            value="<?= htmlspecialchars($baris['nama_lengkap']); ?>"
            maxlength="100" required>
        <br></br>

        <label>Email</label><br>
        <input type="text" name="email"
            value="<?= htmlspecialchars($baris['email']); ?>"
            maxlength="20" required>
        <br></br>

        <label>Nomor Hp</label><br>
        <input type="text" name="no_hp"
            value="<?= htmlspecialchars($baris['no_hp']); ?>"
            maxlength="15" required>
        <br></br>

        <label>Jenis Anggota</label><br>
        <select name="jenis_anggota" required>
            <option value="Mahasiswa"
            <? $baris['jenis_anggota'] == "Mahasiswa" ? "selected" : ""; ?>>
            Mahasiswa
            </option>

            <option value="Dosen"
            <? $baris['jenis_anggota'] == "Dosen" ? "selected" : ""; ?>>
            Dosen
            </option>

            <option value="Teanaga Kependidikan"
            <? $baris['jenis_anggota'] == "Tenaga Kependidikan" ? "selected" : ""; ?>>
            Tenaga Kependidikan
            </option>
        </select>
        <br></br>

        <label>Alamat</label><br>
        <textarea name="alamat" rows="4" cols="40"
            required><?= htmlspecialchars($baris ['alamat']); ?></textarea>
        <br></br>

        <button type="submit" name="update">
            Update Data
        </button>

        <a href="data.php">Kembali</a>
</form>
</body>
</html>