<?php
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040117");


function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $koneksi;

    $judul = htmlspecialchars($data["judul"]);
    $jurnalis = htmlspecialchars($data["jurnalis"]);
    $konten = htmlspecialchars($data["konten"]);
    
    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

        // query insert data
    $query = "INSERT INTO berita_olahraga VALUES
    ('0', '$judul', '$jurnalis', '$konten', '$gambar')";
        
    mysqli_query($koneksi, $query);
                                                                                                
    return mysqli_affected_rows($koneksi);
}


function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function hapus($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM berita_olahraga WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}

function ubah($data) {
    global $koneksi;

    $id = $data["id"];
    $judul = htmlspecialchars($data["judul_berita"]);
    $jurnalis = htmlspecialchars($data["jurnalis"]);
    $konten = htmlspecialchars($data["konten"]);

     // cek apakah user pilih gambar baru atau tidak
     if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE berita_olahraga SET
                judul_berita = '$judul',
                jurnalis = '$jurnalis',
                konten = '$konten',
                gambar = '$gambar'
                WHERE id = '$id';
                ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
    
function cari($keyword) {
    $query = "SELECT * FROM berita_olahraga
                WHERE 
                nama LIKE '%$keyword%' OR
                judul LIKE '%$keyword%' OR
                konten LIKE '%$keyword%' OR
                jurnalis LIKE '%$keyword%'";
    return query($query);
}


function registrasi($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result) ) {
        echo "<script>
            alert('username yang dipilih sudah terdaftar!')
            </script>";
         return false;
    }

    //cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
            alert('konfirmasi password tidak sesuai!'); 
            </script>";
        return false;
    }
 
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($koneksi, "INSERT INTO user VALUES('0', '$username', '$password')");

    return mysqli_affected_rows($koneksi);
    
}


?>