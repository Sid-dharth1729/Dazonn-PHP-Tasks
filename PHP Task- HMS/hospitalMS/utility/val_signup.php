<?php
    $name = '';
    $pass = '';
    $mob = '';
    $c_pass = '';
    $error = array("name"=> '',"mob"=> '', "pass"=>'', "c_pass" =>'');
    if(isset($_POST['signup'])){
        $gender = $_POST['gender'];
        if(empty($_POST['name'])){
            $error['name'] = "Username is empty";
        }else{
            $name = $_POST['name'];
        }
        if(empty($_POST['mob'])){
            $error['mob'] = "Mobile number is empty";
        }else{
            if(!is_numeric($_POST['mob']) || strlen($_POST['mob']) != 10 ){
                $error['mob'] = "Invalid mobile number";
            }
            $mob = $_POST['mob'];
        }
        if($_POST['pass'] === ''){
            $error['pass'] = "Pasword is empty";
        }else{
            $pass = $_POST['pass'];
        }
        if($_POST['c_pass'] === ''){
            $error['c_pass'] = "Confirm your password";
        }else{
            $c_pass = $_POST['c_pass'];
            if($c_pass != $pass){
                $error['c_pass'] = "Password doesn't match";
            }
        }
        if(!array_filter($error)){  //array empty

            //Mobile number exists
            $check = "SELECT * FROM staff_patient WHERE mobile = '$mob'";
            $result = mysqli_query($conn, $check);

            if(mysqli_num_rows($result) > 0){
                $error['mob'] = "Mobile number is already registered.";
            }
            else{
                $i_sql = "INSERT INTO staff_patient(name, mobile, password, role, gender)
                VALUES ('$name', '$mob', '$pass', '$role', '$gender')";
    
                if(mysqli_query($conn, $i_sql)){
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['mob'] = $mob;

                    header("location:$role.php");
                    mysqli_close($conn);
                    exit();
                    
                }
                // else{
                    // echo "query error:" . mysqli_error($conn);
                // }
            }
        }
    }
?>