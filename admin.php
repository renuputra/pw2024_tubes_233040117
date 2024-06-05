<?php
require 'functions.php';
$sport = query("SELECT * FROM `berita_olahraga` WHERE 1");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $sport = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    
<h1>Berita Olahraga</h1>

<a href="tambah.php">Tambah Berita</a>
<br><br>

<form action="" method="post">

    <input type="text" name="keyword" size="40" autofocus="" placeholder="masukan keyword pencarian" autocomplete="off">
    <button type="submit" name="cari">Cari!</button>

</form>


<table border="1" cellpadding="10" cellspacing="0">

<tr>
    <th>No.</th>
    <th>judul_berita</th>
    <th>jurnalis</th>
    <th>Konten</th>
    <th>gambar</th>
    <th>Aksi</th>
</tr>

<?php $i = 1; ?>
<?php foreach( $sport as $row ) : ?>
<tr>
    <td><?php echo $i ?></td>   
    <td><?php echo $row["judul_berita"]?></td> 
    <td><?php echo $row["jurnalis"]?></td>
    <td><?php echo $row["konten"]?></td>
    <td><img src="img/<?= $row["gambar"]; ?>" width="250"></td>  
    <td>
            <a href="ubah.php?id=<?= $row["id"] ?>">ubah</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>"  onclick="return confirm('yakin?');">hapus</a>
    </td>

</tr>
<?php $i++; ?>
<?php endforeach; ?>


</table>


</body>
</html>

