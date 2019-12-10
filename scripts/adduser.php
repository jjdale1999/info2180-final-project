<?php
session_start();

require_once 'connectdb.php';


if(isset($_GET)){
    
    $email = $_SESSION['user'];
    if($email === "admin@bugme.com") {

        echo "<div id=\"sub\">
        <form action = \"scripts/submitform.php\" method = \"POST\" id = \"maincontent\">
            <h1> New User</h1>

            <label for = \"adduser-firstname\">Firstname</label><br>
            <input id = \"adduser-firstname\" name = \"adduser-firstname\"><br>

            <label for = \"adduser-lastname\">Lastname</label><br>
            <input id = \"adduser-lastname\" name = \"adduser-lastname\"><br>

            <label for =\"adduser-password\">Password</label><br>
            <input type =\"password\" id =\"adduser-password\" name = \"adduser-password\"><br>

            <label for = \"adduser-email\">Email</label><br>
            <input id = \"adduser-email\" name = \"adduser-email\"><br>
            <button type = \"submit\" id = \"adduser-submitBtn\">Submit</button>
                
        </form>
    </div>";
    } else {
        echo "false";
    }


}


?>
