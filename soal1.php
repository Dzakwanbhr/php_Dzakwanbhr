<?php
$jml = $_GET['jml'];
echo "<table border=1 cellspacing=0 cellpadding=5>\n";

for ($a = $jml; $a > 0; $a--) {
    // total tiap baris
    $total = 0;
    for ($b = $a; $b > 0; $b--) {
        $total += $b;
    }

    // baris total
    echo "<tr>";
    echo "<td colspan='$a' align='center'><b>TOTAL = $total</b></td>";
    echo "</tr>\n";

    // baris angka
    echo "<tr>";
    for ($b = $a; $b > 0; $b--) {
        echo "<td align='center'>$b</td>";
    }
    echo "</tr>\n";
}

echo "</table>";
?>
