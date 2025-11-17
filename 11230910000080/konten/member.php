<?php
// halaman daftar member

// Sertakan file koneksi ke database untuk bisa mengambil data member
// Menggunakan include saja karena index.php berada di direktori yang sama
include "koneksi.php";

// Siapkan dan eksekusi query untuk mengambil seluruh data member.
// Kita hanya menampilkan kolom yang relevan dan melewatkan kolom password untuk menjaga privasi.
$stmt = $conn->prepare(
    "SELECT id, namadep, namabel, username, usia, jk, ttl, email, notel FROM register ORDER BY id ASC"
);
$stmt->execute();
$result = $stmt->get_result();

?>

<!-- Judul halaman -->
<h2>Daftar Member</h2>

<!-- Tautan untuk menambah data member baru -->
<p>
    <a href="?module=member_tambah" style="background-color: rgb(24, 48, 83); color: yellow; padding: 5px 10px; text-decoration: none;">Tambah Member</a>
</p>

<!-- Tabel untuk menampilkan data member -->
<table style="width:100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">ID</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Nama Depan</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Nama Belakang</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Username</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Usia</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Jenis Kelamin</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Tempat/Tanggal Lahir</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Email</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Nomor Telepon</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['id']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['namadep']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['namabel']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['username']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['usia']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['jk']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['ttl']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['email']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <?php echo htmlspecialchars($row['notel']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <!-- Link untuk edit dan hapus -->
                        <a href="?module=member_edit&amp;id=<?php echo urlencode($row['id']); ?>" style="margin-right: 5px;">Edit</a>
                        |
                        <a href="member_delete.php?id=<?php echo urlencode($row['id']); ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" style="border: 1px solid #ddd; padding: 8px; text-align: center;">Belum ada data member.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
// Tutup statement dan koneksi setelah selesai
$stmt->close();
$conn->close();
?>