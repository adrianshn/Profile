<?php
// Memulai sesi PHP untuk menyimpan data tabel sementara
session_start();

// Data Awal Tabel CRUD
if (!isset($_SESSION['data_buku_adrian'])) {
    $_SESSION['data_buku_adrian'] = [
        ['id' => 1, 'judul' => 'Pengantar Ilmu Hukum', 'penulis' => 'R. Soeroso', 'kategori' => 'Hukum Dasar'],
        ['id' => 2, 'judul' => 'Hukum Pidana', 'penulis' => 'Moeljatno', 'kategori' => 'Pidana']
    ];
}

// Logika Tambah Data (Create)
if (isset($_POST['tambah_buku'])) {
    $judul = $_POST['judul_baru'];
    $penulis = $_POST['penulis_baru'];
    $kategori = $_POST['kategori_baru'];
    
    $id_baru = 1;
    if (!empty($_SESSION['data_buku_adrian'])) {
        $last_item = end($_SESSION['data_buku_adrian']);
        $id_baru = $last_item['id'] + 1;
    }

    $_SESSION['data_buku_adrian'][] = [
        'id' => $id_baru,
        'judul' => $judul,
        'penulis' => $penulis,
        'kategori' => $kategori
    ];
}

// Logika Hapus Data (Delete)
if (isset($_POST['hapus_buku'])) {
    $id_hapus = $_POST['id_hapus'];
    foreach ($_SESSION['data_buku_adrian'] as $key => $buku) {
        if ($buku['id'] == $id_hapus) unset($_SESSION['data_buku_adrian'][$key]);
    }
    $_SESSION['data_buku_adrian'] = array_values($_SESSION['data_buku_adrian']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        /* Background dibuat transparan agar menyatu dengan index.html */
        body { color: #ffffff; padding: 10px; background: transparent; }
        
        h1, h2 { color: #ffd700; margin-bottom: 15px; text-align: center; }
        p.subtitle { text-align: center; margin-bottom: 30px; color: #cbd5e1; }
        h3 { color: #f8fafc; margin-bottom: 10px; font-weight: 500; font-size: 1.2rem; }

        .task-card { background: rgba(15, 23, 42, 0.9); padding: 25px; border-radius: 15px; border: 1px solid rgba(255,215,0,0.2); margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .php-loop-box { max-height: 250px; overflow-y: auto; background: rgba(0,0,0,0.3); padding: 15px; border-radius: 10px; border: 1px solid rgba(255,215,0,0.3); margin-top: 15px; }
        
        .php-result { background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 15px; border-radius: 8px; border-left: 4px solid #10b981; font-weight: bold; margin-top: 15px; }
        .php-error { background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 15px; border-radius: 8px; border-left: 4px solid #ef4444; font-weight: bold; margin-top: 15px; }
        .php-warning { background: rgba(255, 215, 0, 0.1); color: #ffd700; padding: 15px; border-radius: 8px; border-left: 4px solid #ffd700; font-weight: bold; margin-top: 15px; }
        
        input, select { width: 100%; padding: 12px; margin-bottom: 15px; background: rgba(255,255,255,0.1); border: none; border-radius: 5px; color: white; font-size: 1rem; outline: none; font-family: 'Poppins', sans-serif; }
        input:focus, select:focus { border: 1px solid #ffd700; }
        input::placeholder { color: #94a3b8; }
        
        button { width: 100%; padding: 12px; background: #ffd700; color: #0f172a; border: none; border-radius: 5px; font-weight: bold; font-size: 1rem; cursor: pointer; transition: 0.3s; }
        button:hover { background: #e6c200; transform: translateY(-2px); }

        table.tugas-table { width: 100%; border-collapse: collapse; margin-top: 15px; color: white; font-size: 0.95rem; }
        table.tugas-table th, table.tugas-table td { border: 1px solid rgba(255,255,255,0.1); padding: 12px; text-align: left; }
        table.tugas-table th { background: rgba(255, 215, 0, 0.2); color: #ffd700; }

        .btn-hapus { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid #ef4444; padding: 6px 12px; font-size: 0.85rem; width: auto; border-radius: 5px; cursor: pointer; }
        .btn-hapus:hover { background: #ef4444; color: white; transform: none; }
        .add-form-container { background: rgba(255, 215, 0, 0.05); padding: 20px; border-radius: 10px; margin-top: 20px; border: 1px dashed #ffd700; display: none; }
    </style>
</head>
<body>

    <h2><i class="fas fa-code"></i> Tugas Pemrograman Web</h2>
    <p class="subtitle">Halaman ini dibuat khusus untuk memproses tugas PHP Sisi Server.</p>

    <div class="task-card">
        <h3><i class="fas fa-redo"></i> 1. Tugas Perulangan (1 - 1000)</h3>
        <p style="font-size: 0.9rem; color: #cbd5e1;">Menampilkan teks berulang menggunakan perintah <code>for</code> di PHP.</p>
        <div class="php-loop-box">
            <?php 
            for ($i = 1; $i <= 1000; $i++) {
                echo "<div style='padding: 5px; border-bottom: 1px solid rgba(255,255,255,0.05); color: #e2e8f0;'>$i. Ini adalah hari ke-$i belajar PHP</div>";
            }
            ?>
        </div>
    </div>

    <div class="task-card">
        <h3><i class="fas fa-calculator"></i> 2. Kalkulator Dua Bilangan</h3>
        <form method="POST" action="">
            <input type="number" name="angka1" placeholder="Masukkan Bilangan Pertama" required>
            <input type="number" name="angka2" placeholder="Masukkan Bilangan Kedua" required>
            <select name="operasi">
                <option value="+">Tambah (+)</option>
                <option value="-">Kurang (-)</option>
                <option value="*">Kali (x)</option>
                <option value="/">Bagi (/)</option>
            </select>
            <button type="submit" name="hitung">Hitung Hasil</button>
        </form>
        
        <?php 
        if (isset($_POST['hitung'])) {
            $a1 = $_POST['angka1']; $a2 = $_POST['angka2']; $op = $_POST['operasi'];
            if ($op == '+') $hasil = $a1 + $a2;
            elseif ($op == '-') $hasil = $a1 - $a2;
            elseif ($op == '*') $hasil = $a1 * $a2;
            elseif ($op == '/') $hasil = ($a2 != 0) ? $a1 / $a2 : "Error (Bagi 0)";
            
            echo "<div class='php-result'><i class='fas fa-check-circle'></i> Hasil dari $a1 $op $a2 = $hasil</div>";
        }
        ?>
    </div>

    <div class="task-card">
        <h3><i class="fas fa-shield-alt"></i> 3. Validasi Login (3 Kondisi)</h3>
        <p style="font-size: 0.9rem; color: #cbd5e1; margin-bottom: 15px;">Gunakan ID: <strong>admin</strong> | Password: <strong>12345</strong> untuk melihat kondisi Sukses.</p>
        <form method="POST" action="">
            <input type="text" name="user_tugas" placeholder="Masukkan ID User">
            <input type="password" name="pass_tugas" placeholder="Masukkan Password">
            <button type="submit" name="proses_login_tugas">Cek Status Login</button>
        </form>

        <?php 
        if (isset($_POST['proses_login_tugas'])) {
            $u = $_POST['user_tugas']; 
            $p = $_POST['pass_tugas'];
            
            if (empty($u) || empty($p)) {
                echo "<div class='php-warning'><i class='fas fa-exclamation-triangle'></i> Input tidak lengkap, apabila ID atau Password kosong.</div>";
            } elseif ($u == "admin" && $p == "12345") {
                echo "<div class='php-result'><i class='fas fa-check-circle'></i> Login sukses, apabila ID dan Password sesuai.</div>";
            } else {
                echo "<div class='php-error'><i class='fas fa-times-circle'></i> Login gagal, apabila ID atau Password salah.</div>";
            }
        }
        ?>
    </div>

    <div class="task-card">
        <h3><i class="fas fa-database"></i> 4. Tabel Database PHP (Fungsi CRUD Aktif)</h3>
        <p style="font-size: 0.9rem; color: #cbd5e1; margin-bottom: 15px;">Menampilkan tabel dan memanipulasi data menggunakan PHP Session.</p>
        
        <div style="overflow-x: auto;">
            <table class="tugas-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($_SESSION['data_buku_adrian'])): ?>
                        <tr><td colspan="5" style="text-align:center;">Data kosong. Silakan tambah data baru.</td></tr>
                    <?php else: ?>
                        <?php foreach ($_SESSION['data_buku_adrian'] as $buku): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($buku['id']); ?></td>
                            <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                            <td><?php echo htmlspecialchars($buku['penulis']); ?></td>
                            <td><?php echo htmlspecialchars($buku['kategori']); ?></td>
                            <td>
                                <form method="POST" action="" style="margin: 0; padding: 0;">
                                    <input type="hidden" name="id_hapus" value="<?php echo $buku['id']; ?>">
                                    <button type="submit" name="hapus_buku" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus buku ini?');"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <button onclick="document.getElementById('formTambah').style.display='block'" style="margin-top: 20px; background: transparent; border: 2px dashed #ffd700; color: #ffd700;">
            <i class="fas fa-plus"></i> Tambah Data Buku Baru
        </button>

        <div id="formTambah" class="add-form-container">
            <h4 style="margin-bottom: 15px; color: #ffd700;">Form Tambah Buku</h4>
            <form method="POST" action="">
                <input type="text" name="judul_baru" placeholder="Judul Buku (Contoh: Hukum Perdata)" required>
                <input type="text" name="penulis_baru" placeholder="Nama Penulis" required>
                <input type="text" name="kategori_baru" placeholder="Kategori (Misal: Perdata/Pidana)" required>
                <button type="submit" name="tambah_buku"><i class="fas fa-save"></i> Simpan Data</button>
                <button type="button" onclick="document.getElementById('formTambah').style.display='none'" style="margin-top: 10px; background: rgba(255,255,255,0.1); color: white;">Batal</button>
            </form>
        </div>
    </div>

</body>
</html>
