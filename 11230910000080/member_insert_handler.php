<?php
// Proses penyimpanan data member baru

// Sertakan koneksi ke database
include "koneksi.php";

// Hash password sebelum disimpan
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Siapkan statement insert
$stmt = $conn->prepare(
    "INSERT INTO register (namadep, namabel, username, password, usia, jk, ttl, email, notel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param(
    "sssssssss",
    $_POST['namadep'],
    $_POST['namabel'],
    $_POST['username'],
    $hashed_password,
    $_POST['usia'],
    $_POST['jk'],
    $_POST['ttl'],
    $_POST['email'],
    $_POST['notel']
);

// Eksekusi dan cek hasil
if ($stmt->execute()) {
    echo "<script>alert('Data member berhasil ditambahkan'); window.location.href='index.php?module=member';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='index.php?module=member_tambah';</script>";
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();

?>