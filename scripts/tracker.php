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
    if($_GET['title']){
        $title=$_GET['title'];
        $stmt = $conn->query("SELECT * FROM issueInfo WHERE title=$title");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        getIssueInfo();
    }
    
}

//function to query and show query info on issues
function getIssueInfo($results){
   $view="<h1>". $results['title']."</h1>".
        "Issue #".$results['id'].
        "<p>".$results['descript']."</p>".
        ">  Issue created on ".$results['created']."at"."".
        "by ".$results['created_by'].
        ">  Last updated on ".$results['updated']."at"."";
    //this div is the side info to the right of the view issue page
    $view.="<div>". "Assigned To <br>".$results['assigned_to']."<br> <br>". 
            "Type: <br>".$results['typ']."<br> <br>".
            "Priority: <br>".$results['pr']."<br> <br>".
            "Status: <br>".$results['stat']."<br><br>".
            "</div>";
    $view.="<button>Mark as Closed </button>".
            "<button>Matk in Progress </button>";
}

//function to show all issues in a table
function getIssues($results,$emaillog,$passwordlog,$something){
    foreach ($results as $row){
        if($row['email']==$emaillog){
            if($something=="myticket"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE assigned_to=$emaillog ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results); // echos the table to html
                
               
            } elseif($something=="opentickets"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE stat='open' ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
            }elseif($something=="all"){
                $stmt = $conn->query("SELECT * FROM issueInfo");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
    
            }       
        }
    }
}

//checks for correct format of email
function checkemail($email){
    $test = preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email);
    return ($test) ? true : false;


}

//home view
function issuestable($results){
    $tableheads="<button> Create New User </button>".
                "<h1> Issues <h1>".
                "<table> 
                    <th>Title</th>
                    <th>Type</th> 
                    <th>Status</th> 
                    <th>Assigned To</th>
                    <th>Created</th>";
        foreach($results as $row){
            $tableheads.= "<tr>". "
                                <td>".$row['id'].$row['title']."</td>".
                                "<td>".$row['type']."</td>".
                                "<td>".$row['stat']."</td>".
                                "<td>".$row['assigned_to']."</td>".
                                "<td>".$row['created_by']."</td>".
                            "</tr>";
        }

        $tableheads.="</table>";
        echo $tableheads;
}
function validateHashPw($pword){
    $passValid = filter_var($_POST['pword'],FILTER_SANITIZE_STRING);
    $passConf=preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/',$passValid);
    return ($passConf=password_hash($passConf,PASSWORD_DEFAULT)) ? true: false;
    
 }



    
    

?>