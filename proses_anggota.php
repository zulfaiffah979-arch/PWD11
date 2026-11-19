<?php
// Halaman ini hanya boleh dibuka melalui pengiriman form (POST)[cite: 30, 40]
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: form_anggota.php");
    exit;
}

// 1. Ambil data dan bersihkan dengan trim() serta isset()[cite: 40]
$no_anggota    = isset($_POST["no_anggota"]) ? trim($_POST["no_anggota"]) : "";
$nama_lengkap  = isset($_POST["nama_lengkap"]) ? trim($_POST["nama_lengkap"]) : "";
$email         = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$no_hp         = isset($_POST["no_hp"]) ? trim($_POST["no_hp"]) : "";
$jenis_anggota = isset($_POST["jenis_anggota"]) ? trim($_POST["jenis_anggota"]) : "";
$alamat        = isset($_POST["alamat"]) ? trim($_POST["alamat"]) : "";

// 2. Validasi di sisi server menggunakan empty(), ctype_digit(), dan filter_var()[cite: 39, 40]
$daftar_jenis_anggota = array("Mahasiswa", "Dosen", "Tenaga Kependidikan");
$errors = array();

// Validasi Nomor Anggota: Wajib diisi; hanya angka; maksimal 15 digit[cite: 39]
if (empty($no_anggota)) {
    $errors[] = "Nomor Anggota tidak boleh kosong.";
} elseif (!ctype_digit($no_anggota)) {
    $errors[] = "Nomor Anggota hanya boleh berisi angka.";
} elseif (strlen($no_anggota) > 15) {
    $errors[] = "Nomor Anggota maksimal 15 digit.";
}

// Validasi Nama Lengkap: Wajib diisi; maksimal 100 karakter[cite: 39]
if (empty($nama_lengkap)) {
    $errors[] = "Nama Lengkap tidak boleh kosong.";
} elseif (strlen($nama_lengkap) > 100) {
    $errors[] = "Nama Lengkap maksimal 100 karakter.";
}

// Validasi Email: Wajib diisi; format email valid; maksimal 100 karakter[cite: 39]
if (empty($email)) {
    $errors[] = "Email tidak boleh kosong.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
} elseif (strlen($email) > 100) {
    $errors[] = "Email maksimal 100 karakter.";
}

// Validasi Nomor HP: Wajib diisi; hanya angka; 10 sampai 13 digit[cite: 39]
if (empty($no_hp)) {
    $errors[] = "Nomor HP tidak boleh kosong.";
} elseif (!ctype_digit($no_hp)) {
    $errors[] = "Nomor HP hanya boleh berisi angka.";
} elseif (strlen($no_hp) < 10 || strlen($no_hp) > 13) {
    $errors[] = "Nomor HP harus berukuran 10 sampai 13 digit.";
}

// Validasi Jenis Anggota: Wajib dipilih: Mahasiswa, Dosen, atau Tenaga Kependidikan[cite: 39]
if (empty($jenis_anggota)) {
    $errors[] = "Jenis Anggota wajib dipilih.";
} elseif (!in_array($jenis_anggota, $daftar_jenis_anggota, true)) {
    $errors[] = "Jenis Anggota tidak valid.";
}

// Validasi Alamat: Wajib diisi[cite: 39]
if (empty($alamat)) {
    $errors[] = "Alamat tidak boleh kosong.";
}

// 3. Bila semua data valid, simpan ke database menggunakan Prepared Statement[cite: 40]
$berhasil = false;
$pesan_db = "";

if (empty($errors)) {
    require_once "koneksi.php";

    $sql = "INSERT INTO anggota (no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        // Menggunakan mysqli_stmt_bind_param() dengan 6 parameter string ("ssssss")[cite: 8, 40]
        mysqli_stmt_bind_param($stmt, "ssssss", $no_anggota, $nama_lengkap, $email, $no_hp, $jenis_anggota, $alamat);

        if (mysqli_stmt_execute($stmt)) {
            $berhasil = true;
        } else {
            $pesan_db = mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $pesan_db = mysqli_error($koneksi);
    }

    mysqli_close($koneksi);

    // Jika berhasil, alihkan kembali ke form dengan status sukses[cite: 30, 40]
    if ($berhasil) {
        header("Location: form_anggota.php?status=sukses");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Penyimpanan Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        .gagal { background: #fdecea; border-left: 5px solid #c0392b; padding: 10px; }
    </style>
</head>
<body>
    <?php if (!empty($errors)) { ?>
        <h1>Data Tidak Valid</h1>
        <p class="gagal">Data belum dapat disimpan. Perbaiki kesalahan:</p>
        <ul>
            <?php foreach ($errors as $pesan) { ?>
                <li><?php echo htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <h1>Data Gagal Disimpan</h1>
        <p class="gagal">Terjadi kesalahan saat menyimpan data ke database.</p>
        <p>Pesan dari MySQL: <?php echo htmlspecialchars($pesan_db, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php } ?>
    <p><a href="javascript:history.back()">Kembali dan perbaiki data</a></p>
</body>
</html>