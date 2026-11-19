<?php
// Menguji koneksi dengan memanggil koneksi.php menggunakan require_once[cite: 18, 40]
require_once "koneksi.php";

$versi_server = mysqli_get_server_info($koneksi);
mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tes Koneksi Database</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        .sukses { background: #e6f4ea; border-left: 5px solid #2e7d32; padding: 10px; }
        td { padding: 4px 16px 4px 0; }
    </style>
</head>
<body>
    <h1>Tes Koneksi Database</h1>
    <p class="sukses">Koneksi ke MySQL berhasil[cite: 18].</p>
    <table>
        <tr>
            <td>Host</td>
            <td>: <?php echo htmlspecialchars($host); ?></td>
        </tr>
        <tr>
            <td>Database</td>
            <td>: <?php echo htmlspecialchars($database); ?></td>
        </tr>
        <tr>
            <td>Versi server</td>
            <td>: <?php echo htmlspecialchars($versi_server); ?></td>
        </tr>
    </table>
</body>
</html>