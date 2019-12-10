<?php
session_start();

require_once 'connectdb.php';

if (isset($_POST)) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type = $_POST['type'];
    $priority = $_POST['priority'];

    $email = $_SESSION['user'];

    $stmt = $conn->query("SELECT * FROM Users WHERE email = '$email'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $row) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }

    $createdBy = $firstname . " " . $lastname;

    $assignedTo = $_POST['assignedTo'];

    $date = strval(date("Y-m-d"));
    $time = strval(date("h:i:s"));
    $dateTime = $date . " " . $time;

    $conn->query("INSERT INTO Issues (title, description, type, priority, status, assigned_to, created_by, created, updated) VALUES ('$title', '$description', '$type', '$priority', 'OPEN', '$assignedTo', '$createdBy', '$dateTime', '$dateTime')");
    echo "true";

}


?>
