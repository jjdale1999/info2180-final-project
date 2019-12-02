<?php
require_once 'info.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);

$emaillog="";
if(isset($_GET)){ 
    if(isset($_GET['home'])){
        echo"here";
        $something=$_GET['home']; 
        getIssues($something,$conn,$emaillog);

    } 
    //this is after the login
    else if(isset($_GET['emaillog']) && isset($_GET['password'])){
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
                                    <td>"."#".$row['id']."<a id='getinfo' href='scripts/issueinfo.php?id=".$row['id']."'>".$row['title']."</a></td>".
                                    "<td>".$row['typ']."</td>".
                                    "<td>".$row['stat']."</td>".
                                    "<td>".$row['assigned_to']."</td>".
                                    "<td>".$row['created']."</td>".
                                "</tr>";
            }

            $tableheads.="</table>";
            echo $tableheads;
    }
    
    
?>