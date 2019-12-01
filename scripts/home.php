<?php
$host = '127.0.0.1';
$username = 'lab7_user';
$password = 'My_Password123';
$dbname = 'users';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


if(isset($_POST)){ //Wouldn't this have to be checking for a POST request tho since we dealing with passwords? 
    //i was actually thinking about that too, but then again , u not  inserting anything into the database , 
    //u want to recieve something from thr database

    //But the password would be displayed in the url in a GET request....... hmmmmmmm, idk lol lets try POST
    //this is after the login
    if($_POST['emaillog'] && $_POST['password']){
        $emaillog=$_POST['emaillog'];
        $passwordlog=$_POST['password']; //this is what i want to hash to check if it matches in the table
        //cheks to see if the email and password  is in the table 
        $stmt = $conn->query("SELECT * FROM userInfo WHERE email=$emaillog and  pword=$passwordlog");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $something="";
        //if the length is equal to one then 
        if(sizeof($result)==1){
            getIssues($emaillog,$passwordlog,$something);
        }
           
    }

    //this is when they click the home button on the side bar
    if($_GET['home']){
        $something=$_GET['home'];
        //how will we assign values to emaillog and passwordlog tho? above 
        getIssues($emaillog,$passwordlog,$something);
    }   //this is fine
//yeah just realize , so try it 
    //function to show all issues in a table
    //$something is based on what button they click on for filter by 
    function getIssues($emaillog,$passwordlog,$something){
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


}

    
    

?>