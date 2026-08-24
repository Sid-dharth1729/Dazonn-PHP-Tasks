<?php
    include("db_connect.php");
    //session call
    session_start();

//signUP form
    // Validation
    $error = array("username"=> '',"email"=> '', "password"=>'', "con-pass" =>'', "userImg" =>'');
    
    $sup_username = '';
    $sup_password = '';
    $sup_email = '';
    $sup_con_pass = '';
    $profile_src ='guest.jpg';
    $imgFolder = 'profile-img/';
    if(isset($_POST['signup'])){
        
        if(empty($_POST['username'])){
            $error['username'] = "Username is empty";
        }else{
            $sup_username = $_POST['username'];
        }
    //EMAIL VALIDATION
        if(empty($_POST['email'])){
            $error['email'] = "Email is empty";
        }else{
            $sup_email = $_POST['email'];
            if(!filter_var($sup_email, FILTER_VALIDATE_EMAIL)){
                $error['email'] ="Email address must be valid";
            }
            else{
                $sup_email = mysqli_real_escape_string($conn, $sup_email);
                $sup_email_query = "SELECT * FROM users WHERE email = '$sup_email'";
                $exists_email = mysqli_query($conn, $sup_email_query);
                if(mysqli_num_rows($exists_email) > 0){
                    $error['email'] ="Email already existed";
                }
            }
        }
        if(empty($_POST['password'])){
            $error['password'] = "Password is empty";
        }else{
            $sup_password = $_POST['password'];  
        }
        if(empty($_POST['con-pass'])){
            $error['con-pass'] = "Password is empty";
        }
        elseif($_POST['password'] != $_POST['con-pass']){
                $error['con-pass'] = 'Please write the same password';
        }else{
            $sup_con_pass = $_POST['con-pass'];
        }

         //image logic $_FILE['name'] to check img is uploaded or not
        // if(!empty($_FILES)){
            if(!empty($_FILES['userImg']['name'])){
    
                $file_name = $_FILES['userImg']['name'];
                // print_r($file_name);
                $file_name_array = explode('.' ,$file_name);
                // print_r($file_name_array);
                $extention = end($file_name_array);
                // echo $extention;
    
                // extention checking
                if($extention !="jpg" && $extention !="png" && $extention !="jpeg"
                    && $extention !="JPG" && $extention !="PNG" && $extention !="JPEG"){
                        
                    $error['userImg'] ="Only jpg, png, jpeg files are allowed";
                }
                else{
        //SISSION FOR IMG
                    // session_start();
                    $_SESSION['userImg'] = $file_name;
                    $profile_src = $_SESSION['userImg'];

                    $folder_loc = $imgFolder . $profile_src;
                    // for allocation space file to folder
                    // move_uploaded_file($_FILES['userImg']['tmp_name'], $folder_loc);
                //storing img in Database
                
                }
            }
            else{
                $profile_src ='guest.jpg';
                // session_start();
                $_SESSION['userImg'] = $profile_src;
            }
        // }
        //checks any errors are in error array

        if(!array_filter($error)){ //check $error are not empty 
            //validate if con_pass is satisfied(is not empty)  or not
            
            // for allocation space file to folder (only store when there is no error )
             if (!empty($_FILES['userImg']['name'])){
                 move_uploaded_file($_FILES['userImg']['tmp_name'], $folder_loc);
             }
 
            //to remove all sql query if exists in variable
            $sup_username = mysqli_real_escape_string($conn, $sup_username);
            $sup_email = mysqli_real_escape_string($conn , $sup_email);
            $sup_password = mysqli_real_escape_string($conn,$sup_password);
            
        //Sql Query 
            $sql_up = "INSERT INTO users(username, email, password, profileImg) 
            VALUES ('$sup_username', '$sup_email', '$sup_password','$profile_src')";
                                        //ALTER TABLE users ADD role VARCHAR(20) NOT NULL DEFAULT 'user';
                                            //default role will be 'user'

            if(mysqli_query($conn, $sql_up)){
                // echo "Data inserted";
                //session
                // session_start();
                //for navbar and profile_update.php 
                $_SESSION['username'] = $sup_username;
                $_SESSION['email'] = $sup_email;

                header('Location:home.php');
                exit();

            }else{
                echo "Error occur: " . mysqli_error($conn);
            }
        }
        else{
            // echo "error  hai ";
            //check $error are not empty 
            //validate if con_pass is satisfied(is not empty)  or not
        }
    }

    // login form
    $login_password = '';
    $login_email = '';
    $login_error = array('email' =>'', 'password' => '');
    if(isset($_POST['logIn'])){
        if(empty($_POST['email'])){
            $login_error['email'] = "Enter email address";
        }else{
            $login_email = $_POST['email'];
            
            $sql_in = "SELECT * FROM users WHERE email = '$login_email'";
            $result = mysqli_query($conn, $sql_in);
            if(mysqli_num_rows($result) == 0){
                $login_error['email'] = "Email address doesn't exists";
            }
            
        }
        if(empty($_POST['password']) && !empty($_POST['email'])){
            $login_error['password'] = "Enter your password";
        }else{
            $login_password = $_POST['password'];
        }
        //Searching In DataBase
        if(array_filter($login_error)){
            //$sin_error (array) is not empty
        }else{
                    //used above
            // $sql_in = "SELECT * FROM users WHERE email = '$login_email'";
            // $result = mysqli_query($conn, $sql_in);
            //fetching in array
            $user = mysqli_fetch_assoc($result);
            
            mysqli_free_result($result);
            mysqli_close($conn);
            // print_r($user);
            
            if($user['password'] != $login_password){
                $login_error['password'] = "Incorect password";
            }else{
                //SESSION  its called above
                // session_start();
                $_SESSION['username']=$user['username'];
                    // for [profile update pade]
                $_SESSION['email']=$user['email'];
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
    <?php
            include("utility/header.php");
            ?>
    <body>
                <!-- navbar -->
        <?php include("utility/navbars/selectNavbar.php");?>
        
        <!-- sign up form -->
        <div class="signup-form-cont">
            <div class="container">
                <div class="row sign-up-form rounded-5 p-2 m-1">
                    <!-- main form -->
                    <div class="col-lg-6 col-md-6 p-0">
                        <div class="container py-2">
                            <h2 class="h2 text-center mb-0">Create an account</h2>
                        <!-- Image before uploading -->
                            <!-- <div class="profile-image text-center">
                                <img src="<?php //echo $imgFolder . $profile_src?>" class="rounded-circle" style="width: 80px; height:80px" alt="">
                            </div> -->

                                <!-- form Action -->
                            <form action="login_signup.php?form=signup" method= "post" enctype="multipart/form-data">
                                    <!-- username -->
                                <div class="py-2">
                                    <!-- <label for="username" class="form-label mb-1">Username</label> -->
                                    <input type="text" name="username" id="username" class="form-control s-form-bg py-1" 
                                    value="<?php echo $sup_username;?>" placeholder="Username">
                                    <div class="text-danger fw-bold">
                                        <?php echo $error['username'];?>
                                    </div>
                                </div>
                                    <!-- email -->
                                <div class="py-2">
                                    <!-- <label for="email" class="form-label mb-1">Your Email</label> -->
                                    <input type="text" name="email" id="email" class="form-control s-form-bg py-1" 
                                    value="<?php echo $sup_email;?>" placeholder="Enter your email">
                                    <div class="text-danger fw-bold">
                                        <?php echo $error['email'];?>
                                    </div>
                                </div>

                                <!--Profile IMAGE Div-->
                                <div class="py-2 ">
                                    <label for="userImg" id="inputLabel" class="form-label mb-1 p-2 bg-light rounded-2 w-100 overflow-hidden" style="cursor:pointer">
                                        <div class="input-img-text d-flex align-items-center" style="font-size: 0.9rem; color:#4e4e4e;">
                                            <img style="width:25px;" src="https://www.svgrepo.com/show/502892/upload-photo.svg" alt="">
                                            <span id="imgName">

                                                <?php if($profile_src == 'guest.jpg' || empty($profile_src)){
                                                    echo "Upload profile photo (optional)";
                                                }
                                                else{
                                                    echo $profile_src;
                                                } ?>
                                            </span>
                                        </div>

                                        <input type="file" class="form-control" name="userImg" 
                                        value="<?php echo $profile_src;?>" id="userImg" accept="image/*" hidden>
                                    </label>
                                    <div class="text-danger fw-bold">
                                        <?php echo $error['userImg'];?>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="py-2 col-lg-6 col-sm-12">
                                        <!-- <label for="password" class="form-label mb-1">Your password</label> -->
                                        <input type="password" name="password" id="password" class="form-control s-form-bg py-1" 
                                        value="<?php echo $sup_password;?>" placeholder="Create password" >
                                        <div class="text-danger fw-bold">
                                            <?php echo $error['password'];?>
                                        </div>
                                    </div>
                                    <div class="py-2 col-lg-6 col-sm-12">
                                        <!-- <label for="con-pass" class="form-label mb-1">Confirm password</label> -->
                                        <input type="password" name="con-pass" id="con-pass" class="form-control s-form-bg py-1" 
                                        value="<?php echo $sup_con_pass;?>" placeholder="Confirm password">
                                            <div class="text-danger fw-bold">
                                            <?php echo $error['con-pass'];?>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 text-center pt-2">
                                    <input style="width: fit-content;" class="form-control btn s-up-btn" type="submit" name="signup" value="Sign Up">
                                    
                                </div>
                                <div class="mt-3 text-center w-100">
                                    <a href="#" class="btn border-dark rounded-pill px-3">
                                        <img style="width: 20px; margin-bottom: 5px;" src="https://www.svgrepo.com/show/511330/apple-173.svg" alt="">
                                        Apple
                                    </a>
                                    <a href="#" class="btn border-dark rounded-pill px-31">
                                        <img style="width: 20px; margin-bottom: 5px;" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="">
                                        Google
                                    </a>
                                </div>
                            </form>
                            <p class="p-txt m-0 form-btm-txt">
                                Already have an account?
                                <a href="login_signup.php?form=login" class="fw-semibold">Login</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 p-0 form-img">
                        <img class="w-100 h-100 object-fit-cover rounded-5" src="./images/form-img.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- login form -->
        <div class="login-form-cont">
            <div class="container ">
                <div class="row log-in-form rounded-5 m-1">
                    <div class="col-lg-7 col-md-6 p-3 form-img">
                        <img class="w-100 h-100 object-fit-cover rounded-5" src="./images/form-img.jpg" alt="">
                    </div>
                    <!-- main form -->
                    <div class="col-lg-5 col-md-6 p-lg-4 p-2 ">
                        <h2 class="h2 text-center">Login</h2>

                        <form action="login_signup.php?form=login" method="post">
                            <div class="py-2">
                                <label for="log_email" class="form-label ps-2">Email</label>
                                <input type="text" name="email" id="log_email" class="form-control rounded-pill"
                                value="<?php echo $login_email;?>">
                                <div class="text-danger fw-bold">
                                    <?php echo $login_error['email'];?>
                                </div>
                            </div>
                            <div class="py-2">
                                <label for="log_password" class="form-label ps-2">Password</label>
                                <input type="password" name="password" id="log_password" class="form-control rounded-pill">
                                <div class="text-danger fw-bold">
                                        <?php echo $login_error['password'];?>
                                </div>
                            </div>
                            <div class="text-center py-3">
                                <input style="width: fit-content;" type="submit" name="logIn" class="btn user-sign-btn" value="Login">
                                    <p class="p-txt my-2 form-btm-txt">
                                        Don't have an account?
                                        <a href="login_signup.php?form=signup" class="fw-semibold">Signup</a>
                                    </p>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    <!-- copyright footer -->
    <?php include("./utility/footer_copyright.php");?>

    <script src="./utility/script-login&signup.js"></script>
    <script src="./utility/script-drag&drop.js"></script>
    </body>
</html>