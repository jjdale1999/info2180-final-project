<?php
require_once 'info.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if(isset($_POST) && isset($_POST['fname'])){
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pword = $_POST['pword'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = $id+1; 
    $date=date_default_timezone_get();

    $checkedEmail=checkEmail($email);
    $hashedPw=validateHashPw($pword);
    //for future reference, you can use password_verify('String being entered',$hashedVariableName)
    $dbEntry=$conn->query("INSERT INTO userInfo (id,firstName,lastName,pword,email,date_joined) VALUES ('$id', '$fname', '$lname', '$hashedPw', '$checkedEmail','$date')");
    
    
}


if(isset($_POST) && isset($_POST['title'])){
  $title =filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $desc = filter_var($_POST['descr'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $assignedTo= filter_var($_POST['assigned'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $type = filter_var($_POST['types'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $priority= filter_var($_POST['priority'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $dbEntry = $conn->query("INSERT INTO issueInfo (title,descr,assigned,types,priority) VALUES ('$title','$desc','$assignedTo','$type','$priority' )");

}




//checks for correct format of email
function checkemail($email){
    $test = preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email);
    return ($test) ? true : false;


}



function validateHashPw($pword){
    $passValid = filter_var($_POST['pword'],FILTER_SANITIZE_STRING);
    $passConf=preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/',$passValid);
    return ($passConf=password_hash($passConf,PASSWORD_DEFAULT)) ? true: false;
    
 }



    
    

?>