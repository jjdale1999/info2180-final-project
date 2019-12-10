<?php
session_start();

require_once 'connectdb.php';


if(isset($_GET)){     
    
    $email = $_SESSION['user'];

    $stmt = $conn->query("SELECT * FROM Users WHERE email = '$email'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $row) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }

    $name = $firstname . " " . $lastname;

    $stmt = $conn->query("SELECT * FROM Issues WHERE assigned_to = '$name'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $tableheads="<div id = \"home-heading\">
                    <h1> Issues <h1>
                    <button id = \"home-createNewUserBtn\"> Create New User </button>
                </div>
                <div> 
                <label>Filter by: </label>
                <button class = \"home-buttons\" id = \"home-allBtn\">ALL</button>
                <button class = \"home-buttons\" id = \"home-openBtn\"> OPEN </button>
                <button class = \"home-active\" id = \"home-myTicketsBtn\"> MY TICKETS </button> 
                </div>
                <div class = \"mytickets\" id='table'><table> 
                    <th>Title</th>
                    <th>Type</th> 
                    <th>Status</th> 
                    <th>Assigned To</th>
                    <th>Created</th>";
                    foreach($results as $row){
                        $date = explode(" ", $row['created'])[0];

                        $status = $row['status'];
                        if($status === "OPEN") {
                            $class = "OPEN";
                        } else if ($status === "CLOSED") {
                            $class = "CLOSED";
                        } else if ($status === "IN PROGRESS") {
                            $class = "IP";
                        }

                        $tableheads.= "<tr>". "
                                            <td>"."#".$row['id']." <a id='page' href='#'>".$row['title']."</a></td>".
                                            "<td>".$row['type']."</td>".
                                            "<td id = \"table-status\"> <div id = \"status-".$class."\">".$row['status']."</div> </td>".
                                            "<td>".$row['assigned_to']."</td>".
                                            "<td>".$date."</td>".
                                        "</tr>";
                            }

    $tableheads.="</table></div>";
    echo $tableheads;



}
?>
