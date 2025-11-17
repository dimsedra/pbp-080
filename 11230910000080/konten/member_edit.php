<?php
// halaman edit member

// Pastikan parameter ID ada
if (!isset($_GET['id'])) {
    // Jika tidak ada ID, kembali ke daftar member
    echo "<script>window.location.href='index.php?module=member';</script>";
    exit;
}

// Sertakan koneksi ke database
include "koneksi.php";

// Ambil data member berdasarkan ID
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT id, namadep, namabel, username, usia, jk, ttl, email, notel FROM register WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Jika data tidak ditemukan, alihkan kembali
if ($result->num_rows === 0) {
    echo "<script>alert('Data member tidak ditemukan'); window.location.href='index.php?module=member';</script>";
    $stmt->close();
    $conn->close();
    exit;
}

$data = $result->fetch_assoc();
?>

<!-- Judul halaman -->
<h2>Edit Member</h2>

<!-- Form edit member dengan data awal terisi -->
<form action="member_update_handler.php" method="post">
    <!-- Simpan ID di input tersembunyi -->
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>" />
    <table width="496" border="0" align="center">
        <tr>
            <td width="163">Nama Depan:</td>
            <td width="317"><input type="text" name="namadep" value="<?php echo htmlspecialchars($data['namadep']); ?>" required /></td>
        </tr>
        <tr>
            <td>Nama Belakang:</td>
            <td><input type="text" name="namabel" value="<?php echo htmlspecialchars($data['namabel']); ?>" required /></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required /></td>
        </tr>
        <tr>
            <td>Password Baru:</td>
            <td><input type="password" name="password" placeholder="Biarkan kosong jika tidak diubah" /></td>
        </tr>
        <tr>
            <td>Usia:</td>
            <td><input type="text" name="usia" value="<?php echo htmlspecialchars($data['usia']); ?>" required /></td>
        </tr>
        <tr>
            <td>Jenis Kelamin:</td>
            <td><input type="text" name="jk" value="<?php echo htmlspecialchars($data['jk']); ?>" required /></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir:</td>
            <td><input type="text" name="ttl" value="<?php echo htmlspecialchars($data['ttl']); ?>" required /></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required /></td>
        </tr>
        <tr>
            <td>Nomor Telepon:</td>
            <td><input type="text" name="notel" value="<?php echo htmlspecialchars($data['notel']); ?>" required /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Update" /></td>
        </tr>
    </table>
</form>

<?php
$stmt->close();
$conn->close();
?>