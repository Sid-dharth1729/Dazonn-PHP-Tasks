<?php
                        // username, password, db_name of db
    $conn = mysqli_connect('localhost','root', '', 'eduleb_db');
    if(!$conn){
        die("Connection failed:" . mysqli_error($conn));
    }
?>                                 