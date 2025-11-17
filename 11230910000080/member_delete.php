<?php
// Proses penghapusan data member

// Sertakan koneksi ke database
include "koneksi.php";

// Pastikan ID diberikan
if (!isset($_GET['id'])) {
    echo "<script>window.location.href='index.php?module=member';</script>";
    exit;
}

$id = intval($_GET['id']);

// Siapkan statement delete
$stmt = $conn->prepare("DELETE FROM register WHERE id = ?");
$stmt->bind_param("i", $id);

// Eksekusi dan cek hasil
if ($stmt->execute()) {
    echo "<script>alert('Data member berhasil dihapus'); window.location.href='index.php?module=member';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='index.php?module=member';</script>";
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();

?>