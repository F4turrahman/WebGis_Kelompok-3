<?php
include_once "koneksi.php";
$username = $_POST["username"];
$password = $_POST["password"];

$query_sql = "SELECT * FROM tbl_users
                WHERE username = '$username' AND password = '$password'";

$result = mysqli_query($conn, $query_sql);
$jumlah = mysqli_num_rows($result);
$x = mysqli_fetch_array($result);

if ($jumlah == 1) {
    session_start();
    $_SESSION['username'] = $x['username'];
    $_SESSION['password'] = $x['password'];
    header("Location: layer/index.php");
} else {
    echo"<center><h1>Email atau Password Anda salah. Silahkan Coba Login Kembali.</h1>
            <button><strong><a href='index.html'>Login</a></strong></button></center>";
}