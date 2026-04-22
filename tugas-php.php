<?php
session_start();

// =======================
// SIMULASI DATABASE
// =======================
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// =======================
// PROSES DAFTAR
// =======================
if (isset($_POST['daftar'])) {

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Cek email sudah ada atau belum
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] == $email) {
            echo "<script>alert('Email sudah terdaftar!'); window.location='index.html';</script>";
            exit;
        }
    }

    // Simpan user
    $_SESSION['users'][] = [
        'nama' => $nama,
        'email' => $email,
        'password' => $password
    ];

    echo "<script>alert('Pendaftaran berhasil! Silakan login'); window.location='index.html';</script>";
    exit;
}

// =======================
// PROSES LOGIN
// =======================
if (isset($_POST['login'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $login = false;

    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {
            $_SESSION['login'] = $user['nama'];
            $login = true;
            break;
        }
    }

    if ($login) {
        echo "<script>alert('Login berhasil!'); window.location='tugas-php.php';</script>";
    } else {
        echo "<script>alert('Email atau password salah!'); window.location='index.html';</script>";
    }

    exit;
}

// =======================
// LOGOUT
// =======================
if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>window.location='index.html';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard PHP</title>
    <style>
        body {
            font-family: Arial;
            background: #0f172a;
            color: white;
            text-align: center;
            padding: 40px;
        }

        .box {
            background: #1e293b;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }

        a {
            color: gold;
            text-decoration: none;
            font-weight: bold;
        }

        ul {
            text-align: left;
            margin-top: 20px;
        }

        li {
            padding: 8px;
            border-bottom: 1px solid #334155;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: gold;
            color: black;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="box">

<h2>Dashboard PHP</h2>

<?php if (isset($_SESSION['login'])): ?>
    <h3>Selamat datang, <?= $_SESSION['login']; ?> 👋</h3>
    <a href="?logout=true" class="btn">Logout</a>
<?php else: ?>
    <p>Anda belum login</p>
    <a href="index.html" class="btn">Kembali</a>
<?php endif; ?>

<hr>

<h3>Data User Terdaftar:</h3>

<ul>
<?php
if (!empty($_SESSION['users'])) {
    foreach ($_SESSION['users'] as $user) {
        echo "<li>{$user['nama']} - {$user['email']}</li>";
    }
} else {
    echo "<li>Belum ada user</li>";
}
?>
</ul>

</div>

</body>
</html>
