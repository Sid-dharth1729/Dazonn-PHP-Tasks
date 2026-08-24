<?php
    $login_mob = '';
    $login_pass = '';
    $login_error = array('mob' =>'', 'pass' => '');
    if(isset($_POST['login'])){
        if(empty($_POST['mob'])){
            $login_error['mob'] = "Enter your mobile number";
        }else{
            $login_mob = $_POST['mob'];
            
            $sql_in = "SELECT * FROM staff_patient 
                WHERE mobile = '$login_mob' AND role ='$role'";
            $result = mysqli_query($conn, $sql_in);
            if(mysqli_num_rows($result) == 0){
                $login_error['mob'] = "Mobile number is not registered";
            }
            
        }
        if(empty($_POST['pass']) && !empty($_POST['mob'])){
            $login_error['pass'] = "Enter your password";
        }else{
            $login_pass = $_POST['pass'];
        }
        //Searching In DataBase
        if(array_filter($login_error)){
            // $sin_error (array) is not empty
        }else{

            $user = mysqli_fetch_assoc($result);
            
            mysqli_free_result($result);
            // mysqli_close($conn);
            // print_r($user);
            
            if($user['password'] != $login_pass){
                $login_error['pass'] = "Incorect password";
            }else{
                session_start();
                $_SESSION['name'] = $user['name'];
                $_SESSION['id'] = $user['id'];
                header("location:$role.php");
                // echo "hai";
                exit();
            }
        }
         mysqli_close($conn);
    }
?>