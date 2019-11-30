<?php
$host = '127.0.0.1';
$username = 'lab7_user';
$password = 'My_Password123';
$dbname = 'user';

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





if(isset($_GET)){
    if($_GET['emaillog'] && $_GET['password']){
        $emaillog=$_GET['emaillog'];
        $passwordlog=$_GET['password'];
        $stmt = $conn->query("SELECT * FROM userInfo WHERE email=$emaillog and  pword=$passwordlog");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        getIssues($results,$emaillog,$passwordlog,$something);
    }
    
    
    
}

function getIssues($results,$emaillog,$passwordlog,$something){
    foreach ($results as $row){
        if($row['email']==$emaillog && $row['pword']==$passwordlog){
            if($something=="myticket"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE assigned_to=$emaillog ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable();
                
               
            } elseif($something=="opentickets"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE stat='open' ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }elseif($something=="all"){
                $stmt = $conn->query("SELECT * FROM issueInfo");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }       
        }
    }
}
function checkemail($email){
    $test = preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email);
    return ($test) ? true : false;

   //stop move mi nuh xD
   //MI SEH STOP MOVE MI
//    looooooool
}

function issuestable(){
    echo"<html>
            <table> 
                <th>Title</th>
                <th>Type</th> 
                <th>Status</th> 
                <th>Assigned To</th>
                <tr>
                            
                </tr>";
}
function validateHashPw($pword){
    $passValid = filter_var($_POST['pword'],FILTER_SANITIZE_STRING);
    $passConf=preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/',$passValid);
    return ($passConf=password_hash($passConf,PASSWORD_DEFAULT)) ? true: false;
    
 }



    
    

?>