<?php

if($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  
    echo true;   

}
