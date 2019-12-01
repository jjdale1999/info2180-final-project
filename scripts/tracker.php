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

if(isset($_GET)){
    //when login 
    if($_GET['emaillog'] && $_GET['password']){
        $emaillog=$_GET['emaillog'];
        $passwordlog=$_GET['password']; //this is what i want to hash to check if it matches in the table
        $stmt = $conn->query("SELECT * FROM userInfo WHERE email=$emaillog and  pword=$passwordlog");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $something="";
        //if the length is equal to one then 
        if(sizeof($result)==1){
            getIssues($emaillog,$passwordlog,$something);
        }
           
    }
    //when home is clicked
    if($_GET['home']){
        $something="";
        getIssues($emaillog,$passwordlog,'');
    }


    //when the title a tag is clicked 
    if($_GET['title']){
        $title=$_GET['title'];
        $stmt = $conn->query("SELECT * FROM issueInfo WHERE title=$title");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        getIssueInfo();
    }

    //this is for the drop down box for options with all users names
    if($_GET['createissue']){
        $stmt = $conn->query("SELECT * FROM userInfo");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $options ="";
        foreach($results as $row){
            $options.= "<option>".$row['firstname']." ".$row['lastname']."</option>";
        }
        echo $options;
    }
    
}

//This should be figure 4
//function to query and show query info on issues
function getIssueInfo($results){
   $view="<h1>". $results['title']."</h1>".
        "Issue #".$results['id'].
        "<div id='info'> <p>".$results['descript']."</p>".
        ">  Issue created on ".$results['created']."at"."".
        "by ".$results['created_by'].
        ">  Last updated on ".$results['updated']."at".""."</div>";
    //this div is the side info to the right of the view issue page
    $view.="<div id='rightbox'>". "Assigned To <br>".$results['assigned_to']."<br> <br>". 
            "Type: <br>".$results['typ']."<br> <br>".
            "Priority: <br>".$results['pr']."<br> <br>".
            "Status: <br>".$results['stat']."<br><br>".
            "</div>";
    $view.="<button>Mark as Closed </button>".
            "<button>Matk in Progress </button>";
}

//function to show all issues in a table
//$something is based on what button they click on for filter by 
function getIssues($emaillog,$passwordlog,$something){
    // foreach ($results as $row){
    //     if($row['email']==$emaillog){
        //if they click my ticket 
            if($something=="myticket"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE assigned_to=$emaillog ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results); // echos the table to html
                
               
            } 
            //if they click open tickets
            elseif($something=="opentickets"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE stat='open' ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
            }
            //if they click all
            elseif($something=="all"){
                $stmt = $conn->query("SELECT * FROM issueInfo");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
    
            } 
            //for after login , so home page
            else{
                $stmt = $conn->query("SELECT * FROM issueInfo");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
            }      
        
    
}
//home view , figure 2
function issuestable($results){
    $tableheads="<div><h1> Issues <h1> ".
    "<button> Create New User </button></div>".
    "<div> <label>Filterby:</label>
    <button>ALL</button>
    <button> OPEN </button>
    <button> MY TICKETS </button> </div>".
    "<div id='table'><table> 
        <th>Title</th>
        <th>Type</th> 
        <th>Status</th> 
        <th>Assigned To</th>
        <th>Created</th>";
    foreach($results as $row){
    $tableheads.= "<tr>". "
                    <td>"."#".$row['id']."<a href=''>".$row['title']."</a></td>".
                    "<td>".$row['type']."</td>".
                    "<td>".$row['stat']."</td>".
                    "<td>".$row['assigned_to']."</td>".
                    "<td>".$row['created_by']."</td>".
                "</tr>";
}

$tableheads.="</table></div>";
echo $tableheads;
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