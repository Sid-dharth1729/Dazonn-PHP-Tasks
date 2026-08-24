<?php
    include("connect_db.php");
    //ROLE
    $role ='doctor';

    // login
    $login_mob = '';
    $login_pass = '';
    $login_error = array('mob' =>'', 'pass' => '');
    if(isset($_POST['login'])){
        if(empty($_POST['mob'])){
            $login_error['mob'] = "Enter your mobile number";
        }else{
            $login_mob = $_POST['mob'];
            
            $sql_in = "SELECT * FROM staff 
                WHERE mobile = '$login_mob' AND role ='$role'";
            $result = mysqli_query($conn, $sql_in);
            if(mysqli_num_rows($result) == 0){
                $login_error['mob'] = "Mobile number is not registered";
            }   
        }
        if($_POST['pass'] ==='' && !empty($_POST['mob'])){
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
                header("location:./doctor/$role.php");
                // echo "hai";
                exit();
            }
        }
         mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("./utility/header.php");?>
<body>

    <!-- login form -->
    <div class="login-form-cont">
        <div class="conatiner w-50 mx-auto p-4" style="background: #fbd1d1;">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <!-- <h2 class="h5">HOSPITAL MANAGEMENT SYSTEM</h2> -->
                <h2 class="h2 text-center">
                        Staff Login
                </h2>
                <!-- <h2 class="h2">Patient Login</h2> -->
                 <div class="py-2">
                    <label for="mob" class="form-label">Mobile Number</label>
                    <input type="tel" name="mob" id="mob" class="form-control"
                    value="<?php echo $login_mob;?>"> 
                    <div class="text-danger fw-bold">
                        <?php echo $login_error['mob'];?>
                    </div>
                </div>
                <div class="py-2">
                    <label for="pass" class="form-label">Enter Password </label>
                    <input type="password" name="pass" id="pass" class="form-control fw-bold"
                    value="<?php echo $login_pass;?>">
                    <div class="text-danger fw-bold">
                        <?php echo $login_error['pass'];?>
                    </div>
                </div>
                <div class="w-100 text-center py-3">
                    <input type="submit" name="login" value="Login" class="btn btn-color py-2 px-3">
                </div>
            </form>
        </div>
    </div>
</body>
</html>