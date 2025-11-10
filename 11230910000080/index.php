<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

</html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 1</title>
    <link rel="stylesheet" href="style/style.css">
</head>


<body>
    <div id="container">
        <div id="header">
            <h1>LMS UIN JAKARTA</h1>
        </div>

        <div id="sidebar">
            <h3>Navigasi</h3>
            <ul id="navmenu">
                <li><a href="index.php" class="selected">Profil</a></li>
                <li><a href="?module=galeri#pos">Galeri</a></li>
                <li><a href="?module=jadwal#pos">Jadwal</a></li>
                <li><a href="?module=register#pos">Register</a></li>
            </ul>
        </div>

        <div id="page">
            <?php if (isset($_GET['module']))
                include "konten/$_GET[module].php";
            else
                include "konten/home.php";
            ?>
        </div>

        <div id="clear">

        </div>

        <div id="footer">
            <p>&copy;2025</p>
        </div>
    </div>
</body>


</html>
