<?php
require 'functions.php';

//ambil data di url
$id = $_GET["id"];

// query data berita berdasarkan id
$spt = query("SELECT * FROM berita_olahraga WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    // cek apakah data berhasil ditambahkan atau tidak
    if( ubah($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil diubah!');
            document.location.href = 'admin.php';
            </script>
            ";
    } else {
        echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'admin.php';
            </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Berita</title>
</head>
<body>
    
    <h1>Ubah Data Berita</h1>

    <form action="" method="post" enctype="multipart/form-data">
    
    <ul>
            <li>
                <label for="judul">judul_berita :</label>
                <input type="text" name="judul" id="judul" required value="<?= $spt["judul_berita"] ?>">
            </li>
            <li>
                <label for="jurnalis">jurnalis :</label>
                <input type="text" name="jurnalis" id="jurnalis" required value="<?= $spt["jurnalis"] ?>">
            </li>
            <li>
                <label for="konten">konten :</label>
                <input type="text" name="konten" id="konten" required value="<?= $spt["konten"] ?>">
                
            </li>
            <li>
                <label for="gambar">gambar :</label> <br>
                <img src="img/<?= $spt['gambar']; ?>" width="40" alt=""> <br>
                <input type="file" name="gambar" id="gambar" required>
            </li> 
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
        </ul>
    </form>

</body>
</html>