<?php
session_start();

require_once 'connectdb.php';

if(isset($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->query("SELECT * FROM Users");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $row){
        if(($row['email'] === $email) && ($row['password'] === md5($password))) {
            $_SESSION['user'] = $email;
            echo "true";
            break;
        }
    }
  
}