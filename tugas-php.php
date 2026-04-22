<?php
session_start();

// Inisialisasi data default
if (!isset($_SESSION['data_buku'])) {
    $_SESSION['data_buku'] = [
        ['id' => 1, 'judul' => 'Some Kind of Wonderful', 'penulis' => 'Winna Efendi', 'kategori' => 'Fiksi Romantis'],
        ['id' => 2, 'judul' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'kategori' => 'Filsafat']
    ];
}

// ================= TAMBAH DATA =================
if (isset($_POST['tambah_buku'])) {
    $judul = trim($_POST['judul_baru'] ?? '');
    $penulis = trim($_POST['penulis_baru'] ?? '');
    $kategori = trim($_POST['kategori_baru'] ?? '');

    if ($judul && $penulis && $kategori) {
        $id_baru = count($_SESSION['data_buku']) > 0 
            ? end($_SESSION['data_buku'])['id'] + 1 
            : 1;

        $_SESSION['data_buku'][] = [
            'id' => $id_baru,
            'judul' => htmlspecialchars($judul),
            'penulis' => htmlspecialchars($penulis),
            'kategori' => htmlspecialchars($kategori)
        ];
    }
}

// ================= HAPUS DATA =================
if (isset($_POST['hapus_buku'])) {
    $id_hapus = $_POST['id_hapus'] ?? null;

    $_SESSION['data_buku'] = array_values(array_filter(
        $_SESSION['data_buku'],
        fn($buku) => $buku['id'] != $id_hapus
    ));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tugas PHP</title>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body { font-family: 'Outfit', sans-serif; background:#0f172a; color:white; padding:20px; }
h1 { text-align:center; color:#00e5ff; }

.card { background:#1e293b; padding:20px; border-radius:10px; margin-bottom:20px; }
input, select, button {
    width:100%; padding:10px; margin:5px 0;
    border-radius:8px; border:none;
}
button { background:#00e5ff; font-weight:bold; cursor:pointer; }
button:hover { opacity:0.8; }

table { width:100%; border-collapse:collapse; margin-top:10px; }
td, th { border:1px solid #334155; padding:10px; }
th { background:#00e5ff; color:black; }

.hapus { background:#ef4444; color:white; }
</style>
</head>

<body>

<h1>Tugas PHP</h1>

<!-- ================= LOOP ================= -->
<div class="card">
<h3>Loop 1 - 1000</h3>
<div style="max-height:200px; overflow:auto;">
<?php
for ($i=1;$i<=100;$i++) { // dibatasi 100 biar ringan
    echo "$i. Ini adalah hari ke-$i belajar PHP <br>";
}
?>
</div>
</div>

<!-- ================= KALKULATOR ================= -->
<div class="card">
<h3>Kalkulator</h3>
<form method="POST">
<input type="number" name="a" placeholder="Angka 1" required>
<input type="number" name="b" placeholder="Angka 2" required>
<select name="op">
<option value="+">+</option>
<option value="-">-</option>
<option value="*">*</option>
<option value="/">/</option>
</select>
<button name="hitung">Hitung</button>
</form>

<?php
if (isset($_POST['hitung'])) {
    $a=$_POST['a']; $b=$_POST['b']; $op=$_POST['op'];

    switch($op){
        case '+': $h=$a+$b; break;
        case '-': $h=$a-$b; break;
        case '*': $h=$a*$b; break;
        case '/': $h=$b!=0?$a/$b:"Error"; break;
    }

    echo "<p>Hasil: $h</p>";
}
?>
</div>

<!-- ================= LOGIN ================= -->
<div class="card">
<h3>Login</h3>
<form method="POST">
<input type="text" name="user">
<input type="password" name="pass">
<button name="login">Login</button>
</form>

<?php
if (isset($_POST['login'])) {
    $u=$_POST['user']??'';
    $p=$_POST['pass']??'';

    if (!$u || !$p) {
        echo "Input kosong!";
    } elseif ($u=="admin" && $p=="12345") {
        echo "Login sukses";
    } else {
        echo "Login gagal";
    }
}
?>
</div>

<!-- ================= CRUD ================= -->
<div class="card">
<h3>Data Buku</h3>

<table>
<tr>
<th>ID</th><th>Judul</th><th>Penulis</th><th>Kategori</th><th>Aksi</th>
</tr>

<?php foreach($_SESSION['data_buku'] as $b): ?>
<tr>
<td><?= $b['id'] ?></td>
<td><?= $b['judul'] ?></td>
<td><?= $b['penulis'] ?></td>
<td><?= $b['kategori'] ?></td>
<td>
<form method="POST">
<input type="hidden" name="id_hapus" value="<?= $b['id'] ?>">
<button class="hapus" name="hapus_buku">Hapus</button>
</form>
</td>
</tr>
<?php endforeach; ?>

</table>

<h4>Tambah Buku</h4>
<form method="POST">
<input name="judul_baru" placeholder="Judul" required>
<input name="penulis_baru" placeholder="Penulis" required>
<input name="kategori_baru" placeholder="Kategori" required>
<button name="tambah_buku">Tambah</button>
</form>

</div>

</body>
</html>
