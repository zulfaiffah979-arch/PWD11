<?php
// Membaca parameter status dari URL (redirect setelah sukses)[cite: 27, 40]
$status = isset($_GET["status"]) ? $_GET["status"] : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Anggota Perpustakaan Kampus</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input[type="text"], select, textarea { width: 320px; padding: 6px; box-sizing: border-box; }
        textarea { resize: vertical; height: 80px; }
        button { margin-top: 16px; padding: 8px 20px; }
        .sukses { background: #e6f4ea; border-left: 5px solid #2e7d32; padding: 10px; width: 320px; }
    </style>
</head>
<body>
    <h1>Pendaftaran Anggota Perpustakaan Kampus</h1>

    <?php if ($status === "sukses") { ?>
        <p class="sukses">Data anggota berhasil disimpan.</p>
    <?php } ?>

    <form action="proses_anggota.php" method="post">
        <label for="no_anggota">Nomor Anggota</label>
        <input type="text" id="no_anggota" name="no_anggota" maxlength="15">

        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" maxlength="100">

        <label for="email">Email</label>
        <input type="text" id="email" name="email" maxlength="100">

        <label for="no_hp">Nomor HP</label>
        <input type="text" id="no_hp" name="no_hp" maxlength="13">

        <label for="jenis_anggota">Jenis Anggota</label>
        <select id="jenis_anggota" name="jenis_anggota">
            <option value="">-- Pilih Jenis Anggota --</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Dosen">Dosen</option>
            <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
        </select>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="4"></textarea>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>