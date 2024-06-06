<?php
require 'functions.php';

$berita_olahraga = query("SELECT * FROM berita_olahraga");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $berita_olahraga = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORT</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <a href="#" class="navbar-logo">SPORT<span>News</span></a>
            <nav>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#news">Berita</a></li>
                    <li><a href="login.php">Login</a></li>
                    <input type="text" placeholder="Search here...">
                </ul>
             </nav>
        </div>
     </header>
    
    <main>
        <section class="hero">
            <div class="row">
                <div class="hero-img">  
                 <img src="img/f1.jpeg" alt="Hero Image">
                </div>
                <div class="content">
                    <h2 href="https://sport.detik.com/f1/d-7358850/hasil-f1-gp-monako-2024-diwarnai-drama-leclerc-juara">Hasil F1 GP Monako 2024: Diwarnai Drama, Leclerc Juara</h2>
                    <p> Charles Leclerc tampil sebagai juara Formula 1 GP Monako. Pebalap Ferrari itu tampil dominan dalam balapan yang diwarnai drama di awal.Balapan GP Monako di Circuit de Monaco, Minggu (26/5/2024) langsung diwarnai insiden selepas start. Carlos Sainz langsung menepi karena masalah, tapi ia terselamatkan karena tak lama kemudian red flag berkibar.</p>
                </div>
            </div>
        </section>
        
        <section class="news" id="news">
            <h1>Berita Lainya</h1>
            <div class="news-container">
                <?php foreach( $berita_olahraga as $row ) : ?>
                <article class="news-item">
                    <img src="img/<?= $row["gambar"]; ?>" alt="">
                    <h3 class="judul"><?php echo $row["judul_berita"]?></h3>
                    <p class="konten"><?php echo $row["konten"]?></p>
                    <p class="jurnalis"><?php echo $row["jurnalis"]?></p>
                    <a href="#">Baca Selengkapnya</a>
                </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; Create by renuputra</p>
    </footer>
</body>
</html>
