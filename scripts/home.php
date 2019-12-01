<?php
$host = '127.0.0.1';
$username = 'lab7_user';
$password = 'My_Password123';
$dbname = 'users';
$charset = 'utf8mb4';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);


if(isset($_GET)){ 
    if($_GET['home']){
        $something=$_GET['home']; 
        getIssues($something,$conn);
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
             getIssues($something,$conn);
        }
           
    }

    //this is when they click the home button on the side bar
     
    


}

    //function to show all issues in a table
    //$something is based on what button they click on for filter by 
    function getIssues($something,$conn){
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
            // home page
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
                                    "<td>".$row['typ']."</td>".
                                    "<td>".$row['stat']."</td>".
                                    "<td>".$row['assigned_to']."</td>".
                                    "<td>".$row['created']."</td>".
                                "</tr>";
            }

            $tableheads.="</table></div>";
            echo $tableheads;
    }
    

?>