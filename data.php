<?php
require_once "koneksi.php";

$sql = "SELECT id, no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat FROM anggota ORDER BY id ASC";

$hasil = mysqli_query($koneksi, $sql);

// Memeriksa apakah query berhasil
if (!$hasil) {
    die("Query gagal: " . htmlspecialchars(mysqli_error($koneksi), ENT_QUOTES, 'UTF-8'));
}

$jumlah = mysqli_num_rows($hasil); // untuk menghitung jumlah data

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan Kampus</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            color: #1f3864;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1f3864;
            color: white;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h1>Data Anggota Perpustakaan Kampus</h1>

    <p>Jumlah Anggota: <?php echo $jumlah; ?></p>

    <table>
        <tr>
            <th>No</th>
            <th>Nomor Anggota</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Nomor HP</th>
            <th>Jenis Anggota</th>
            <th>Alamat</th>
        </tr>

        <?php $no = 1; while ($baris = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($baris["no_anggota"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($baris["nama_lengkap"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($baris["email"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($baris["no_hp"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($baris["jenis_anggota"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($baris["alamat"], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <?php } ?>

    </table>

    <br>

    <a href="form_anggota.php">Tambah Anggota</a>

    <?php mysqli_free_result($hasil); ?>
    <?php mysqli_close($koneksi); ?>

</body>
</html>