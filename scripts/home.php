<?php
$host = '127.0.0.1';
$username = 'lab7_user';
$password = 'My_Password123';
$dbname = 'users';
$charset = 'utf8mb4';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);

$emaillog="";
if(isset($_GET)){ 
    if($_GET['home']){
        $something=$_GET['home']; 
        getIssues($something,$conn,$emaillog);

    } 
    //this is after the login
    else if($_GET['emaillog'] && $_GET['password']){
        $emaillog=$_GET['emaillog'];
        $passwordlog=$_GET['password']; 
        //cheks to see if the email and password  is in the table
      
        $stmt = $conn->query("SELECT * FROM userInfo WHERE email=$emaillog and  pword=$passwordlog");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $something="";
        //if the length is equal to one then 
        if(sizeof($result)==1){
            
             getIssues($something,$conn,$emaillog);
            
        }
           
    } //when the title a tag is clicked 
    else 
    if($_GET['id']){
        $id=$_GET['id'];
        $stmt = $conn->query("SELECT * FROM issueInfo WHERE id=$id");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        getIssueInfo($results[0]);
    }

    //this is when they click the home button on the side bar
     
    


}

    //function to show all issues in a table
    //$something is based on what button they click on for filter by 
    function getIssues($something,$conn,$emaillog){
        //if they click my ticket 
            if($something=="myticket"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE assigned_to='Marsha Brady' ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                issuestable($results); // echos the table to html
                
            
            } 
            //if they click open tickets
            else if($something=="open"){
                $stmt = $conn->query("SELECT * FROM issueInfo WHERE stat='OPEN' ");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
            }
            //if they click all
            else if($something=="all"){
                $stmt = $conn->query("SELECT * FROM issueInfo");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
    
            }  else if($something=="home"){
                $stmt = $conn->query("SELECT * FROM issueInfo");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                issuestable($results);
    
            } 
            
          
    
        }
    //home view , figure 2
    function issuestable($results){
        $tableheads="<table> 
                        <th>Title</th>
                        <th>Type</th> 
                        <th>Status</th> 
                        <th>Assigned To</th>
                        <th>Created</th>";
            foreach($results as $row){
                $tableheads.= "<tr>". "
                                    <td>"."#".$row['id']."<a id='getinfo' href='scripts/home.php?id=".$row['id']."'>".$row['title']."</a></td>".
                                    "<td>".$row['typ']."</td>".
                                    "<td>".$row['stat']."</td>".
                                    "<td>".$row['assigned_to']."</td>".
                                    "<td>".$row['created']."</td>".
                                "</tr>";
            }

            $tableheads.="</table>";
            echo $tableheads;
    }
    
    //This should be figure 4
    //function to query and show query info on issues
    function getIssueInfo($results){
      $view="  <html>
        <head>
            <title>BugMe Issue Tracker</title>
            <link rel = 'stylesheet' type = 'text/css' href = '../styles/style.css'>
            <script type='text/javascript' src='../scripts/index.js'></script>
        </head>
    
        <body>
            <header>       
                <h1><img src='../img/bug.png' alt='bug logo'>BugMe Issue Tracker</h1>
            </header>
            <main>
                <nav>
                    <a id='home' href='../scripts/home.php'><h5><img id='homeimg' src='../img/home.jpg' alt='home icon'>Home</h5></a>
                    <a id = 'adduser' href='../scripts/adduser.php'><h5><img id='addimg' src='../img/adduser.png' alt='add user icon'>Add User</h5></a>
                    <a id = 'newissue' href='../scripts/newissue.php'><h5><img id='newimg' src='../img/createissue.png' alt='create issue icon'>New Issue</h5></a>
                    <a id = 'logout' href='../scripts/logout.php'><h5><img id='logoutimg' src='../img/logout.jpg' alt='logout icon'>Logout</h5></a>
                </nav>
                
                <div id='container'>
                    
                    <div id = 'result'>";
                    $view.="<h1>". $results['title']."</h1>".
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
                    
                  $view.="  </div>
                </div>
                
            </main>
        </body>
    </html>";
        
        echo $view;
    }
?>