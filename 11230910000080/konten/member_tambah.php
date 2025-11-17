<?php
// halaman tambah member
?>

<!-- Judul halaman -->
<h2>Tambah Member</h2>

<!-- Form untuk menambah data member -->
<form action="member_insert_handler.php" method="post">
    <table width="496" border="0" align="center">
        <tr>
            <td width="163">Nama Depan:</td>
            <td width="317"><input type="text" name="namadep" required /></td>
        </tr>
        <tr>
            <td>Nama Belakang:</td>
            <td><input type="text" name="namabel" required /></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" required /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" required /></td>
        </tr>
        <tr>
            <td>Usia:</td>
            <td><input type="text" name="usia" required /></td>
        </tr>
        <tr>
            <td>Jenis Kelamin:</td>
            <td><input type="text" name="jk" required /></td>
        </tr>
        <tr>
            <td>Tempat/Tanggal Lahir:</td>
            <td><input type="text" name="ttl" required /></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" required /></td>
        </tr>
        <tr>
            <td>Nomor Telepon:</td>
            <td><input type="text" name="notel" required /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Simpan" /></td>
        </tr>
    </table>
</form>