<?php
// api_uji_coba.php

if (isset($_POST['nama_uji'])) {
    $nama = htmlspecialchars($_POST['nama_uji']);
    
    // Database Simulasi
    $data_anggota = [
        "adrian" => ["status" => "Aktif", "role" => "Admin", "id" => "AD-001"],
        "adhyaksa" => ["status" => "Aktif", "role" => "Pustakawan", "id" => "AD-002"],
        "tamu" => ["status" => "Terbatas", "role" => "User", "id" => "T-999"]
    ];

    // Cek apakah nama ada di database (ubah ke lowercase agar tidak case sensitive)
    $key = strtolower($nama);

    echo "<div style='text-align:left;'>";
    echo "<h4 style='color:#ffd700;'>Respon Server PHP:</h4>";
    
    if (array_key_exists($key, $data_anggota)) {
        $user = $data_anggota[$key];
        echo "✅ Data Ditemukan!<br>";
        echo "ID: " . $user['id'] . "<br>";
        echo "Status: " . $user['status'] . "<br>";
        echo "Role: " . $user['role'];
    } else {
        echo "❌ Nama '<strong>$nama</strong>' tidak terdaftar.<br>";
        echo "<small>Coba ketik: Adrian atau Adhyaksa</small>";
    }
    echo "</div>";
} else {
    echo "Akses langsung dilarang.";
}
?>
