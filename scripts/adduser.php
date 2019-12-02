<?php
require_once 'info.php';

//when submit is clicked on new user page, the strings entered on new user page would
//here then stored in the userInfo table found in the users database.
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if(isset($_POST) && isset($_POST['fname'])){
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pword = $_POST['pword'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date=date_default_timezone_get();

    $checkedEmail=checkEmail($email);
    $hashedPw=validateHashPw($pword);
    //for future reference, you can use password_verify('String being entered',$hashedVariableName)
    $dbEntry=$conn->query("INSERT INTO userInfo (firstName,lastName,pword,email,date_joined) VALUES ( '$fname', '$lname', '$hashedPw', '$checkedEmail','$date')");
    header('Location: ../index.html');

    
}
//makes sure the string entered is in the format of an email
function checkemail($email){
    $test = preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email);
    return ($test) ? true : false;


}


//checks to see if the password entered has at least one upper lower and digit, then hashes that password.
function validateHashPw($pword){
    $passValid = filter_var($_POST['pword'],FILTER_SANITIZE_STRING);
    $passConf=preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/',$passValid);
    return ($passConf=password_hash($passConf,PASSWORD_DEFAULT)) ? true: false;
    
 }
 ?>