<?php
session_start();
$step = isset($_POST['step']) ? intval($_POST['step']) : 1;

echo '<style>
    body { font-family: Arial, sans-serif; }
    .box {
        border: 2px solid #444;
        padding: 20px;
        margin: 30px auto;
        width: 300px;
    }
    .box h2 { text-align: center; margin-top: 0; }
    .box form { display: flex; flex-direction: column; }
    .box label { margin-bottom: 10px; }
    .box input { padding: 6px; margin-top: 4px; }
    .submit-btn {
        margin-top: 15px;
        text-align: center;
    }
    .submit-btn button {
        padding: 8px 20px;
        border: 2px solid #444;
        cursor: pointer;
    }

</style>';

if ($step === 1) {
    echo '<div class="box">';
    echo '<form method="post">';
    echo '<label>Nama Anda:<br><input type="text" name="nama" required></label>';
    echo '<input type="hidden" name="step" value="2">';
    echo '<div class="submit-btn"><button type="submit">Submit</button></div>';
    echo '</form>';
    echo '</div>';
}
elseif ($step === 2) {
    $_SESSION['nama'] = $_POST['nama'];
    echo '<div class="box">';
    echo '<form method="post">';
    echo '<label>Umur Anda:<br><input type="number" name="umur" required></label>';
    echo '<input type="hidden" name="step" value="3">';
    echo '<div class="submit-btn"><button type="submit">Submit</button></div>';
    echo '</form>';
    echo '</div>';
}
elseif ($step === 3) {
    $_SESSION['umur'] = $_POST['umur'];
    echo '<div class="box">';
    echo '<form method="post">';
    echo '<label>Hobi Anda:<br><input type="text" name="hobi" required></label>';
    echo '<input type="hidden" name="step" value="4">';
    echo '<div class="submit-btn"><button type="submit">Submit</button></div>';
    echo '</form>';
    echo '</div>';
}
elseif ($step === 4) {
    $_SESSION['hobi'] = $_POST['hobi'];
    echo '<div class="box">';
    echo '<ul>';
    echo '<li>Nama: ' . htmlspecialchars($_SESSION['nama']) . '</li>';
    echo '<li>Umur: ' . htmlspecialchars($_SESSION['umur']) . '</li>';
    echo '<li>Hobi: ' . htmlspecialchars($_SESSION['hobi']) . '</li>';
    echo '</ul>';
    echo '<form method="post">';
    echo '<div class="submit-btn"><button type="submit" name="reset">Mulai Ulang</button></div>';
    echo '</form>';
    echo '</div>';

    if (isset($_POST['reset'])) {
        session_destroy();
        header("Location: soal2.php");
        exit;
    }
}
?>

