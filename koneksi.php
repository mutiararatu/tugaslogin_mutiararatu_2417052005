<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "login_db"
);

if (!$conn) {
    die("Koneksi gagal");
}

?>