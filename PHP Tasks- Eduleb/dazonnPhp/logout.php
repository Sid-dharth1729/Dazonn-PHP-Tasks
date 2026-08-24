<?php
    session_start(); //Access the current session
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session completely;

    //open login form
    header("location:login_signup.php");
    exit();
?>