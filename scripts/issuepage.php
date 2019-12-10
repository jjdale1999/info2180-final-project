<?php

require_once 'connectdb.php';


if(isset($_GET)){
    $title = $_GET['title'];      
    $stmt = $conn->query("SELECT * FROM Issues");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $flag = false;

    foreach($results as $row) {
        if($row['title'] === $title) {
            $flag = true;
            $id = $row['id'];
            $description = $row['description'];
            $type = $row['type'];
            $priority = $row['priority'];
            $status = $row['status'];
            $assignedTo = $row['assigned_to'];
            $createdBy = $row['created_by'];
            $createdDate = $row['created'];
            $updatedDate = $row['updated'];
            break;
        }
    }

    if($flag === true) {
        $createdDate = date_create($createdDate);
        $createdDate = date_format($createdDate, "F j, Y \a\\t g:iA");

        $updatedDate = date_create($updatedDate);
        $updatedDate = date_format($updatedDate, "F j, Y \a\\t g:iA");

        $page = "<div id=\"body\">

        <div id=\"header\">

            <h1 id=\"page-title\">". $title ."</h1>
            <h3 id=\"page-issuenumber\">Issue #". $id ."</h3>

        </div>

        <div id=\"main\">

            <div id=\"one\">

                <p id=\"page-description\">". $description ."</p>

                <ul id=\"page-time\">
                    <li id=\"created-time\">Issue created on ". $createdDate ." by ". $createdBy ."</li>
                    <li id=\"updated-time\">Last updated on ". $updatedDate ."</li>
                </ul>

            </div>

            <div id=\"two\">
                    <div id=\"page-details\">
                        <div id=\"assigned\">
                            <h3 class=\"nospace\">Assigned To:</h3>" . $assignedTo . "
                        </div>
                        <div id=\"type\">
                            <h3 class=\"nospace\">Type:</h3>" . $type . "
                        </div>
                        <div id=\"priority\">
                            <h3 class=\"nospace\">Priority:</h3>" . $priority . "
                        </div>
                        <div id=\"status\">
                            <h3 class=\"nospace\">Status:</h3>" . $status . "
                        </div>
                    </div>

                <div id=\"closed-button\">
                    <button id=\"page-closed\">Mark as Closed</button>
                </div>

                <div id=\"inprogress-button\">
                    <button id=\"page-inprogress\">Mark In Progress</button>
                </div>
            </div>
        </div>
        
    </div>";

    echo $page;
    }


    



}
?>
