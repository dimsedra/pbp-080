<?php
// halaman daftar member

// Sertakan file koneksi ke database
include "koneksi.php";

// Ambil kata kunci pencarian (jika ada)
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Siapkan query dasar
if ($search !== "") {
    // Pakai LIKE ke beberapa kolom yang relevan
    $sql = "
        SELECT id, namadep, namabel, username, usia, jk, ttl, email, notel
        FROM register
        WHERE 
            namadep LIKE ? OR
            namabel LIKE ? OR
            username LIKE ? OR
            email LIKE ? OR
            notel LIKE ?
        ORDER BY id ASC
    ";
    $stmt = $conn->prepare($sql);
    $like = "%".$search."%";
    $stmt->bind_param("sssss", $like, $like, $like, $like, $like);
} else {
    // Tanpa filter pencarian
    $sql = "
        SELECT id, namadep, namabel, username, usia, jk, ttl, email, notel
        FROM register
        ORDER BY id ASC
    ";
    $stmt = $conn->prepare($sql);
}

// Eksekusi query
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Judul halaman -->
<h2>Daftar Member</h2>

<!-- Form Pencarian -->
<form method="get" action="" style="margin-bottom: 15px;">
    <!-- Karena sistem modul pakai ?module=member -->
    <input type="hidden" name="module" value="member">

    <input
        type="text"
        name="search"
        placeholder="Cari nama, username, email, atau no. telp"
        value="<?php echo htmlspecialchars($search); ?>"
        style="padding: 5px; width: 250px;"
    />
    <button type="submit" style="padding: 5px 10px;">Cari</button>

    <?php if ($search !== ""): ?>
        <a href="index.php?module=member" style="margin-left: 10px;">Reset</a>
    <?php endif; ?>
</form>

<!-- Tautan untuk tambah member -->
<p>
    <a href="?module=member_tambah"
       style="background-color: #ff0; padding: 5px 10px; text-decoration: none;">
        Tambah Member
    </a>
</p>

<!-- Tabel data member -->
<table style="width:100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr>
            <!-- Ganti ID jadi No (nomor urut tampilan) -->
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">No</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Nama Depan</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Nama Belakang</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Username</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Usia</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Jenis Kelamin</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Tempat, Tanggal Lahir</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Email</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">No. Telepon</th>
            <th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php
            // Mulai nomor urut dari 1
            $no = 1;
            while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <!-- Nomor urut tampilan (bukan id db) -->
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                        <?php echo $no++; ?>
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
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                        <?php echo htmlspecialchars($row['usia']); ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
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
                        <!-- Edit tetap pakai id sebagai parameter -->
                        <a href="?module=member_edit&amp;id=<?php echo urlencode($row['id']); ?>" style="margin-right: 5px;">
                            Edit
                        </a>
                        |
                        <!-- Hapus juga tetap pakai id -->
                        <a href="member_delete.php?id=<?php echo urlencode($row['id']); ?>"
                           onclick="return confirm('Yakin ingin menghapus data ini?');">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                    Belum ada data member.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
// Tutup statement dan koneksi setelah selesai
$stmt->close();
$conn->close();
?>
