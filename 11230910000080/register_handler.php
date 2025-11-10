<?php
// Sertakan file koneksi baru kita. 
// Variabel $conn sekarang tersedia dari file itu.
include "koneksi.php";

// --- PENTING: Keamanan Password ---
// Kita mengenkripsi password sebelum menyimpannya ke database.
// Ini adalah praktik keamanan standar.
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// ---------------------------------


// 1. Siapkan SQL Statement dengan "Prepared Statement" (?)
// Tanda tanya (?) adalah placeholder yang aman untuk data.
$stmt = $conn->prepare("INSERT INTO register 
    (namadep, namabel, username, password, usia, jk, ttl, email, notel) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// 2. Bind (ikat) variabel dari form ke placeholder (?)
// "sssssssss" berarti 9 variabel berikutnya semuanya adalah string.
// Ini adalah bagian inti yang mencegah SQL Injection.
$stmt->bind_param(
    "sssssssss",
    $_POST['namadep'],
    $_POST['namabel'],
    $_POST['username'],
    $hashed_password, // <-- Gunakan password yang sudah di-hash
    $_POST['usia'],
    $_POST['jk'],
    $_POST['ttl'],
    $_POST['email'],
    $_POST['notel']
);

// 3. Eksekusi statement dan cek hasilnya
if ($stmt->execute()) {
    // Jika sukses
    echo "<script>alert('Selamat, anda telah terdaftar'); window.location.href='index.php';</script>";
} else {
    // Jika gagal, tampilkan error
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='index.php?module=form_register';</script>";
}

// 4. Tutup statement dan koneksi
$stmt->close();
$conn->close();

?>
