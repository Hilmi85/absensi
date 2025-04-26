<table class="table">
    <tr class="tr">
        <th class="th">Tanggal</th>
        <th class="th">Clock In</th>
        <th class="th">Clock Out</th>
        <th class="th">Performa</th>
    </tr>

    <?php

    include("../connection.php");

    date_default_timezone_set("Asia/Jakarta");

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM absensi WHERE user_id='$user_id'";
    $result = $db->query($sql);
    $tanggal = date('Y-m-d');
    $time = date("H:i:s");

    if (isset($_POST['clockout'])) {
        $sql = "UPDATE absensi SET jam_keluar='$time' WHERE user_id='$user_id' AND tanggal='$tanggal'";
        
        $clockout = $db->query($sql);
        if ($clockout === TRUE) {
            session_start();
            session_destroy();
            header("location:../index.php?message=Terima kasih!");
        } else {
            echo "Maaf, sedang dalam pemeliharaan!";
        }
    
    }

    while($data = $result->fetch_assoc()) {
        echo "<tr class='tr'>";
        echo "<td class='td'>" . $data['tanggal'] . "</td>";
        echo "<td class='td'>" . $data['jam_masuk'] . "</td>";
        if (empty($data['jam_keluar']) && !empty($data['jam_masuk']) && $data['tanggal'] == $tanggal) {
            echo "<td class='td'>
            <form action='' method='POST'>
                <button name='clockout' type='submit'>keluar</button>
            </form>
            </td>";
        } else {
            echo "<td class='td'>" . $data['jam_keluar'] . "</td>";
        }
        if(!empty($data['jam_masuk']) && !empty($data['jam_keluar'])) {
            echo "<td class='td'>✔️</td>";
        } else {
        echo "<td class='td'>❌</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<form action="action.php" method="POST">
    <button name="absen" type="submit">Absen</button>
</form>