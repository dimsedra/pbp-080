<?php
// Data jadwal kuliah dalam bentuk array multidimensi
$jadwal_kuliah = [
    [
        'hari' => 'Senin',
        'matkul' => 'Pemrograman Web',
        'jam' => '08:00 - 10:00',
        'ruang' => 'Lab. Komputer 1'
    ],
    [
        'hari' => 'Selasa',
        'matkul' => 'Basis Data',
        'jam' => '10:00 - 12:00',
        'ruang' => 'Ruang 201'
    ],
    [
        'hari' => 'Rabu',
        'matkul' => 'Struktur Data',
        'jam' => '13:00 - 15:00',
        'ruang' => 'Lab. Komputer 2'
    ],
    [
        'hari' => 'Kamis',
        'matkul' => 'Jaringan Komputer',
        'jam' => '09:00 - 11:00',
        'ruang' => 'Ruang 203'
    ]
];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Jadwal Kuliah</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <h2>Tabel Jadwal Kuliah</h2>

    <table>
        <thead>
            <tr>
                <th>Hari</th>
                <th>Mata Kuliah</th>
                <th>Jam</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop melalui setiap baris data jadwal
            foreach ($jadwal_kuliah as $jadwal) {
                echo "<tr>";
                echo "<td>" . $jadwal['hari'] . "</td>";
                echo "<td>" . $jadwal['matkul'] . "</td>";
                echo "<td>" . $jadwal['jam'] . "</td>";
                echo "<td>" . $jadwal['ruang'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>