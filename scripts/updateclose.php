<?php
    require_once 'info.php';

    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);
    if(isset($_GET)){
        
        $id = $_GET['id'];
        
        $dbEntry=$conn->query("UPDATE issueInfo SET stat = 'CLOSED' WHERE id = $id");
        header('Location: ../index.html');
        
        
    }

?>