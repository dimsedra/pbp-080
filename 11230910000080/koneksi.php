<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdp_db";

// Buat koneksi menggunakan MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>