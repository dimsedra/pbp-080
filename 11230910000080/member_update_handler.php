<?php
// Proses pembaruan data member

// Sertakan koneksi ke database
include "koneksi.php";

// Pastikan ID ada
if (!isset($_POST['id'])) {
    echo "<script>window.location.href='index.php?module=member';</script>";
    exit;
}

// Ambil data dari form
$id = intval($_POST['id']);
$namadep = $_POST['namadep'];
$namabel = $_POST['namabel'];
$username = $_POST['username'];
$usia = $_POST['usia'];
$jk = $_POST['jk'];
$ttl = $_POST['ttl'];
$email = $_POST['email'];
$notel = $_POST['notel'];

// Siapkan password: jika ada input baru, hash. Jika tidak, ambil password lama
if (!empty($_POST['password'])) {
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
    $stmt_pwd = $conn->prepare("SELECT password FROM register WHERE id = ?");
    $stmt_pwd->bind_param("i", $id);
    $stmt_pwd->execute();
    $res_pwd = $stmt_pwd->get_result();
    $row_pwd = $res_pwd->fetch_assoc();
    $hashed_password = $row_pwd['password'];
    $stmt_pwd->close();
}

// Siapkan statement update
$stmt = $conn->prepare(
    "UPDATE register SET namadep = ?, namabel = ?, username = ?, password = ?, usia = ?, jk = ?, ttl = ?, email = ?, notel = ? WHERE id = ?"
);
$stmt->bind_param(
    "sssssssssi",
    $namadep,
    $namabel,
    $username,
    $hashed_password,
    $usia,
    $jk,
    $ttl,
    $email,
    $notel,
    $id
);

// Eksekusi dan cek hasil
if ($stmt->execute()) {
    echo "<script>alert('Data member berhasil diupdate'); window.location.href='index.php?module=member';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='index.php?module=member_edit&id=" . $id . "';</script>";
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();

?>