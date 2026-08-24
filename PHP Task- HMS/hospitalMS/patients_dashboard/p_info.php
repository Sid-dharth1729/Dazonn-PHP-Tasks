<?php
    session_start();
    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
        // for id
        if(!empty($_SESSION['id'])){
            $id = $_SESSION['id'];
        }
        else{
            $mob = $_SESSION['mob'];
            
            include("../connect_db.php");

            $sql_id = "SELECT id FROM staff_patient 
                    WHERE mobile = '$mob'";
            $result = mysqli_query($conn, $sql_id);

            if ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
            } else {
                $id = null;
            } 
            mysqli_free_result($result);
            mysqli_close($conn);     
        }
    }
    else{
        $username = "guest";
    }
?>