<?php

require_once 'connectdb.php';

if (isset($_POST)) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; //does not need to be sanitized because it will be hashed
    $hashedPassword = md5($password);
    $date = strval(date("Y-m-d"));
    $time = strval(date("H:i:s"));
    $dateTime = $date . " " . $time;

    $stmt = $conn->query("SELECT * FROM Users");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $flag = true;
    foreach($results as $row) {
        if($row['email'] === $email) {
            $flag = false;
            break;
        }
    }

    if($flag === true) {
        $conn->query("INSERT INTO Users (firstname, lastname, password, email, date_joined) VALUES ('$firstname', '$lastname', '$hashedPassword', '$email', '$dateTime')");
    
        echo "true";
    }


}


?>
