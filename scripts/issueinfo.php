<?php
require_once 'info.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);

$emaillog="";
if(isset($_GET)){ 

    if($_GET['id']){
        $id=$_GET['id'];
        $stmt = $conn->query("SELECT * FROM issueInfo WHERE id=$id");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        getIssueInfo($results[0]);
    }


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
        $view.="<a id='closed' href='../scripts/updateclose.php?id=".$results['id']."'>"."Mark as Closed </a>".
                "<a id='closed' href='../scripts/updateinprogess.php?id=".$results['id']."'>"."Mark as In Progress </a>";
                    
                  $view.="  </div>
                </div>
                
            </main>
        </body>
    </html>";
        
        echo $view;
    }

?>