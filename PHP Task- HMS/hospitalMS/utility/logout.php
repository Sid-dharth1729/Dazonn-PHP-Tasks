<?php
    session_start(); //Access the current session
    session_unset();
    session_destroy();
    header("location:../index.php");
    exit();
?>