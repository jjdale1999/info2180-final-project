<?php
$host = '127.0.0.1';
$username = 'lab7_user';
$password = 'My_Password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if(isset($_POST)){
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pword = $_POST['pword'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // You should use regular expressions to
    // ensure that passwords have at least one number and one letter, and one capital letter
    
    // and are at least 8 characters long. The password MUST be hashed before being stored
    // in the database. Also you should ensure the other fields are validated and that user
    // inputs are escaped and sanitized before being stored in the database. 
    
  

    // /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}
     
    $dbEntry= $conn->prepare('INSERT INTO userInfo (first_name, last_name, Constituency, Email, Yrs_service, Salt, Password_Digest, ID)')

}


if(isset($_GET)){
    $emaillog=$_GET['emaillog'];
    $passwordlog=$_GET['password'];
    $stmt = $conn->query("SELECT * FROM userInfo WHERE email=$emaillog and  pword=$passwordlog");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row){
        if($row['email']==$emaillog && $row['pword']==$passwordlog){
            if($something=="myticket"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE assignedto=$emaillog ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } elseif($something=="opentickets"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE stat='open' ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }          
        }
    }
    
}

function checkemail($email){
    $test = preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email);
    return ($test) ? true : false;

   
}


function validatePw($pword){
    $passValid = filter_var($_POST['pword'],FILTER_SANITIZE_STRING);
    $passConf=preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/',$passValid);
    return ($passConf=password_hash($passConf,PASSWORD_DEFAULT)) ? true: false;
    
        
    }

    


?>