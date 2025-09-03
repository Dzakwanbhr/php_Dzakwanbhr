<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "testdb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$where = [];
$nama = "";
$hobi = "";
if (isset($_POST['search'])) {
    if (!empty($_POST['nama'])) {
        $nama = $conn->real_escape_string($_POST['nama']);
        $where[] = "person.nama LIKE '%$nama%'";
    }
    if (!empty($_POST['hobi'])) {
        $hobi = $conn->real_escape_string($_POST['hobi']);
        $where[] = "hobi.hobi LIKE '%$hobi%'";
    }
}
$where_sql = "";
if (count($where) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

$sql = "SELECT person.id, person.nama, person.alamat, 
               GROUP_CONCAT(hobi.hobi SEPARATOR ', ') AS hobi_list
        FROM person
        LEFT JOIN hobi ON person.id = hobi.person_id
        $where_sql
        GROUP BY person.id";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Daftar Orang dan Hobi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        .search-box {
            width: 60%;
            margin: 20px auto;
            padding: 15px;
            border: 2px solid #333;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .search-box input[type="text"] {
            padding: 6px;
            width: 200px;
            margin-right: 10px;
        }
        .search-box button {
            padding: 6px 12px;
            cursor: pointer;
        }
        h2, h3 { text-align: center; }
    </style>
</head>
<body>

<h2>Daftar orang dan Hobi</h2>

<table>
    <tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Hobi</th></tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nama']."</td>";
            echo "<td>".$row['alamat']."</td>";
            echo "<td>".$row['hobi_list']."</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Data tidak ditemukan</td></tr>";
    }
    ?>
</table>

<h3>Cari Data</h3>
<div class="search-box">
    <form method="post">
        Nama: <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
        Hobi: <input type="text" name="hobi" value="<?php echo htmlspecialchars($hobi); ?>">
        <button type="submit" name="search">SEARCH</button>
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>
