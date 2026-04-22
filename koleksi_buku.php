<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body { font-family: sans-serif; background: transparent; color: white; padding: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #334155; text-align: left; }
        th { background: #0f172a; color: #ffd700; }
        input { padding: 8px; border-radius: 4px; border: none; width: 100%; box-sizing: border-box; }
        .form-top { display: flex; gap: 10px; margin-bottom: 20px; }
        button { padding: 8px 12px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .btn-tambah { background: #10b981; color: white; }
        .btn-edit { background: #f59e0b; color: white; }
        .btn-hapus { background: #ef4444; color: white; }
    </style>
</head>
<body>

    <form method="POST" class="form-top">
        <input type="text" name="judul" placeholder="Judul Buku..." required>
        <input type="text" name="penulis" placeholder="Penulis..." required>
        <input type="number" name="tahun" placeholder="Tahun" required style="width:100px;">
        <button type="submit" name="tambah_data" class="btn-tambah">Tambah</button>
    </form>

    <table>
        <tr>
            <th style="width: 50px;">ID</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th style="width: 150px;">Aksi</th>
        </tr>
        <tr><form method='POST'><td>7<input type='hidden' name='id_buku' value='7'></td><td><input type='text' name='judul' value='Ensiklopedia'></td><td><input type='text' name='penulis' value='Rusmanto'></td><td><input type='number' name='tahun' value='2004'></td><td style='display:flex; gap:5px;'>
                        <button type='submit' name='ubah_data' class='btn-edit'>Simpan</button>
                        <button type='submit' name='hapus_data' class='btn-hapus' onclick="return confirm('Hapus data buku ini?');">Hapus</button>
                      </td></form></tr><tr><form method='POST'><td>5<input type='hidden' name='id_buku' value='5'></td><td><input type='text' name='judul' value='Laskar Pelangi'></td><td><input type='text' name='penulis' value='Andrea Hinata'></td><td><input type='number' name='tahun' value='2005'></td><td style='display:flex; gap:5px;'>
                        <button type='submit' name='ubah_data' class='btn-edit'>Simpan</button>
                        <button type='submit' name='hapus_data' class='btn-hapus' onclick="return confirm('Hapus data buku ini?');">Hapus</button>
                      </td></form></tr>    </table>

</body>
</html>