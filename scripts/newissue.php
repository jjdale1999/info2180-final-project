<?php

require_once 'connectdb.php';


if(isset($_GET)){

    $stmt = $conn->query("SELECT * FROM Users");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    $output = "<div id = \"sub\">
    <form action = \"scripts/submitissue.php\" method = \"POST\">
        <h1>Create Issue</h1>
        <div id = \"title\">
            
                <label for = \"title\">Title</label><br>
                <input type = \"text\" id = \"newissue-title\" name = \"title\"/><br>
            
        </div>
    
        <div id = \"description\">
            
                <label for = \"description\">Description</label><br>
                <textarea maxlength = \"255\" rows = \"4\" cols =\"50\" id = \"newissue-description\" name = \"description\"></textarea><br>
            
         </div>
    
        <div id = \"assignedTo\">
            
                <label for = \"assignedTo\">Assigned To</label><br>
                <select id = \"newissue-assignedTo\" name = \"assignedTo\" placeholder= \"Marcia Brady\">";

                foreach($results as $row) {
                    $name = $row['firstname'] . " " . $row['lastname'];
                    $output .= "<option>" . $name . "</option>";
                }

    $output .= "</select>
            
        </div>
    
        <div id = \"type\">
                <label for = \"type\">Type</label><br>

                <select id = \"newissue-type\" name = \"type\" placeholder = \"Bug\">
                    <option value = \"Bug\">Bug</option>
                    <option value = \"Proposal\">Proposal</option>
                    <option value = \"Task\">Task</option>
                 </select>
        </div>

        <div id = \"priority\">
                <label for = \"priority\">Priority</label><br>

                <select id = \"newissue-priority\" name = \"priority\" placeholder = \"Major\">
                    <option value = \"Minor\">Minor</option>
                    <option value = \"Major\">Major</option>
                    <option value = \"Critical\">Critical</option>
                </select>
        </div>

         <div id = \"submission\">
            <p>
                <input type = \"button\" id = \"newissue-submit\" value=\"Submit\"/>
            </p>
    
         </div>
    </form>
</div>";

    echo $output;
}
?>
