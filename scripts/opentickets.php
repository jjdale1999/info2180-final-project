<?php

require_once 'connectdb.php';


if(isset($_GET)){      
    $stmt = $conn->query("SELECT * FROM Issues WHERE status = 'OPEN'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tableheads="<div id = \"home-heading\">
                    <h1> Issues <h1>
                    <button id = \"home-createNewUserBtn\"> Create New User </button>
                </div>
                <div> 
                <label>Filter by: </label>
                <button class = \"home-buttons\" id = \"home-allBtn\">ALL</button>
                <button class = \"home-active\" id = \"home-openBtn\"> OPEN </button>
                <button class = \"home-buttons\" id = \"home-myTicketsBtn\"> MY TICKETS </button> 
                </div>
                <div class = \"opentickets\" id='table'><table> 
                    <th>Title</th>
                    <th>Type</th> 
                    <th>Status</th> 
                    <th>Assigned To</th>
                    <th>Created</th>";
                    foreach($results as $row){
                        $date = explode(" ", $row['created'])[0];

                        $tableheads.= "<tr>". "
                                            <td>"."#".$row['id']." <a id='page' href='#'>".$row['title']."</a></td>".
                                            "<td>".$row['type']."</td>".
                                            "<td id = \"table-status\"> <div id = \"status-OPEN\">".$row['status']."</div> </td>".
                                            "<td>".$row['assigned_to']."</td>".
                                            "<td>".$date."</td>".
                                        "</tr>";
                            }

    $tableheads.="</table></div>";
    echo $tableheads;



}
?>
