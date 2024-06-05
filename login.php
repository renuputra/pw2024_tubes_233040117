<?php
session_start();

if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}


require 'functions.php';

if ( isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
       if( password_verify($password, $row["password"]) ) {
        header("Location: admin.php");
        exit;
       }
    }

    $error = true;

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="content">
         <div class="text">
            Login Form
         </div>
         
            <?php if( isset($error) ) : ?>
                <p style="color: red; font-style: italic;">username / password salah</p>
            <?php endif; ?>
         <form action="#" method="POST">
            <div class="field">
               <input type="text" name="username" id="username" required>
               <span class="fas fa-user"></span>
               <label for="username">Username</label>
            </div>
            <div class="field">
               <input type="password" name="password" id="password" required>
               <span class="fas fa-lock"></span>
               <label label="password">Password</label>
            </div>
            <button type="submit" name="login">Login</button>
            <div class="sign-up">
               Not a member?
               <a href="register.php">signup now</a>
            </div>
         </form>
      </div>
   </body>
</html>