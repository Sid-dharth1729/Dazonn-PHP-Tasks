<?php
    //below code checks username that indicates user login not not
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_SESSION['username'])){
        // $user_name ='Guest';
        include("form_navbar.php");
        // echo "empty";
    }else{
        include("navbar.php");
        // echo "full";
    }
?>