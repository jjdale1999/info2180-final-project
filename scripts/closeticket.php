<?php

require_once 'connectdb.php';

if (isset($_POST)) {
    $title = $_POST['title'];
    $date = strval(date("Y-m-d"));
    $time = strval(date("H:i:s"));
    $dateTime = $date . " " . $time;

    $stmt = $conn->query("UPDATE Issues SET status = 'CLOSED', updated = '$dateTime' WHERE title = '$title'");
    echo "true";

}


?>
