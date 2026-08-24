<?php
    include("db_connect.php");
    // Validation
    $error = array("username"=> '',"email"=> '', "password"=>'', "con-pass" =>'', "userImg" =>'');
    
    $username = '';
    $password = '';
    $email = '';
    $con_pass = '';
    $profile_src ='guest.jpg';
    $imgFolder = 'profile-img/';
    if(isset($_POST['signup'])){
        
        if(empty($_POST['username'])){
            $error['username'] = "Username is empty";
        }else{
            $username = $_POST['username'];
        }
    //EMAIL VALIDATION
        if(empty($_POST['email'])){
            $error['email'] = "Email is empty";
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email'] ="Email address must be valid";
            }
            else{
                $email = mysqli_real_escape_string($conn, $email);
                $email_query = "SELECT * FROM users WHERE email = '$email'";
                $exists_email = mysqli_query($conn, $email_query);
                if(mysqli_num_rows($exists_email) > 0){
                    $error['email'] ="Email already existed";
                }
            }
        }
        if(empty($_POST['password'])){
            $error['password'] = "Password is empty";
        }else{
            $password = $_POST['password'];  
        }
        if(empty($_POST['con-pass'])){
            $error['con-pass'] = "Password is empty";
        }
        elseif($_POST['password'] != $_POST['con-pass']){
                $error['con-pass'] = 'Please write the same password';
        }else{
            $con_pass = $_POST['con-pass'];
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
                    session_start();
                    $_SESSION['userImg'] = $file_name;
                    $profile_src = $_SESSION['userImg'];

                    $folder_loc = $imgFolder . $profile_src;
                    // for allocation space file to folder
                    move_uploaded_file($_FILES['userImg']['tmp_name'], $folder_loc);
                //storing img in Database
                
                }
            }
            else{
                $profile_src ='guest.jpg';
                session_start();
                $_SESSION['userImg'] = $profile_src;
            }
        // }
        //checks any errors are in error array
        if(array_filter($error)){
            // echo "error hai ";
            //validate if con_pass is satisfied(is not empty)  or not
        }else{
            //to remove all sql query if exists in variable
            $username = mysqli_real_escape_string($conn, $username);
            $email = mysqli_real_escape_string($conn , $email);
            $password = mysqli_real_escape_string($conn,$password);
            
        //Sql Query 
            $sql_up = "INSERT INTO users(username, email, password, profileImg) 
            VALUES ('$username', '$email', '$password','$profile_src')";
            

            if(mysqli_query($conn, $sql_up)){
                // echo "Data inserted";
                //session
                // session_start();
                //for navbar and profile_update.php 
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                header('Location:home.php');
                exit();

            }else{
                echo "Error occur: " . mysqli_error($conn);
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
        <?php include("utility/form_navbar.php");?>
        
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
                            <form action="signUp.php" method= "post" enctype="multipart/form-data">
                                    <!-- username -->
                                <div class="py-2">
                                    <!-- <label for="username" class="form-label mb-1">Username</label> -->
                                    <input type="text" name="username" id="username" class="form-control s-form-bg py-1" 
                                    value="<?php echo $username;?>" placeholder="Username">
                                    <div class="text-danger fw-bold">
                                        <?php echo $error['username'];?>
                                    </div>
                                </div>
                                    <!-- email -->
                                <div class="py-2">
                                    <!-- <label for="email" class="form-label mb-1">Your Email</label> -->
                                    <input type="text" name="email" id="email" class="form-control s-form-bg py-1" 
                                    value="<?php echo $email;?>" placeholder="Enter your email">
                                    <div class="text-danger fw-bold">
                                        <?php echo $error['email'];?>
                                    </div>
                                </div>

                                <!--Profile IMAGE Div-->
                                <div class="py-2 ">
                                    <label for="userImg" class="form-label mb-1">Upload profile photo</label>
                                    <input type="file" class="form-control" name="userImg" 
                                    value="<?php echo $profile_src;?>" id="userImg" accept="image/*">
                                    <div class="text-danger fw-bold">
                                        <?php echo $error['userImg'];?>
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="py-2 col-lg-6 col-sm-12">
                                        <!-- <label for="password" class="form-label mb-1">Your password</label> -->
                                        <input type="password" name="password" id="password" class="form-control s-form-bg py-1" 
                                        value="<?php echo $password;?>" placeholder="Create password" >
                                        <div class="text-danger fw-bold">
                                            <?php echo $error['password'];?>
                                        </div>
                                    </div>
                                    <div class="py-2 col-lg-6 col-sm-12">
                                        <!-- <label for="con-pass" class="form-label mb-1">Confirm password</label> -->
                                        <input type="password" name="con-pass" id="con-pass" class="form-control s-form-bg py-1" 
                                        value="<?php echo $con_pass;?>" placeholder="Confirm password">
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
                                <a href="logIn.php" class="fw-semibold">Login</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 p-0 form-img">
                        <img class="w-100 h-100 object-fit-cover rounded-5" src="./images/form-img.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>