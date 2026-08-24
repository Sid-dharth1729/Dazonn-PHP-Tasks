<?php 
        include("db_connect.php");

    $password = '';
    $email = '';
    $sin_error = array('email' =>'', 'password' => '');
    if(isset($_POST['logIn'])){
        if(empty($_POST['email'])){
            $sin_error['email'] = "Enter email address";
        }else{
            $email = $_POST['email'];
        }
        if(empty($_POST['password'])){
            $sin_error['password'] = "Enter your password";
        }else{
            $password = $_POST['password'];
        }
        //Searching In DataBase
        if(array_filter($sin_error)){
            //$sin_error (array) is not empty
        }else{

            $sql_in = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql_in);
            //fetching in array
            $user = mysqli_fetch_assoc($result);
            
            mysqli_free_result($result);
            mysqli_close($conn);
            // print_r($user);
            
            if($user['password'] != $password){
                $sin_error['password'] = "Incorect password";
            }else{
                //SESSION 
                session_start();
                $_SESSION['username']=$user['username'];
                    // for [profile update pade]
                $_SESSION['email']=$user['email'];
                $_SESSION['password']=$user['password'];
                // $_SESSION['username']=$user['username'];

                $_SESSION['userImg']=$user['profileImg'];
                // echo $_SESSION['userImg'];
                header("location:home.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("utility/header.php");?>
<body>
    <!-- navbar -->
        <?php include("utility/form_navbar.php");?>

    <div class="login-form-cont">
        <div class="container ">
            <div class="row log-in-form rounded-5 m-1">
                <div class="col-lg-7 col-md-6 p-3 form-img">
                    <img class="w-100 h-100 object-fit-cover rounded-5" src="./images/form-img.jpg" alt="">
                </div>
                <!-- main form -->
                <div class="col-lg-5 col-md-6 p-lg-4 p-2 ">
                    <h2 class="h2 text-center">Login</h2>
                    <form action="logIn.php" method="post">
                        <div class="py-2">
                            <label for="email" class="form-label ps-2">Email</label>
                            <input type="text" name="email" id="email" class="form-control rounded-pill"
                            value="<?php echo $email;?>">
                            <div class="text-danger fw-bold">
                                <?php echo $sin_error['email'];?>
                            </div>
                        </div>
                        <div class="py-2">
                            <label for="password" class="form-label ps-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control rounded-pill">
                            <div class="text-danger fw-bold">
                                    <?php echo $sin_error['password'];?>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <input style="width: fit-content;" type="submit" name="logIn" class="btn user-sign-btn" value="Login">
                              <p class="p-txt my-2 form-btm-txt">
                                    Don't have an account?
                                    <a href="signUp.php" class="fw-semibold">Signup</a>
                                </p>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>