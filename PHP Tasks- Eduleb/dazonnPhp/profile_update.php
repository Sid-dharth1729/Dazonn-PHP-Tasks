<?php
    // connection
    include("db_connect.php");

    $error = array("username"=> '',"up-userImg" =>'');
        // Session start
    session_start();

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    if(empty($username) && empty($email)){
        header("location:login_signup.php");
    }
    $profile_src = $_SESSION['userImg'];
    $imgFolder = 'profile-img/';

    if(isset($_POST['update'])){
        
        if(empty($_POST['username'])){
            $error['username'] = "Username can't be empty";
        }else{
            $username = $_POST['username'];
        }
        //updating image
        if(isset($_FILES['up-userImg']) && $_FILES['up-userImg']['error'] == 0){
            
            $file_name = basename($_FILES['up-userImg']['name']);
            $file_name_array = explode('.' ,$file_name);
            $extention = end($file_name_array);
            if($extention !="jpg" && $extention !="png" && $extention !="jpeg"
                    && $extention !="JPG" && $extention !="PNG" && $extention !="JPEG")
            {        
                $error['up-userImg'] ="Only jpg, png, jpeg files are allowed";
            }else{
                //profile will change
                
                $profile_src = $file_name;

                $file_loc = $imgFolder . $profile_src;
                move_uploaded_file($_FILES['up-userImg']['tmp_name'], $file_loc);
            }
        }
        else{
            // echo "error in input file ";
        }
        if(array_filter($error)){
            // echo "Wait error";
        }
        else{
            // echo "no error";
            $username = mysqli_real_escape_string($conn, $username);//no sql will passed
            $email =mysqli_real_escape_string($conn, $email);//no sql will passed
            $profile_src = mysqli_real_escape_string($conn, $profile_src);
            $sql_update= "UPDATE users SET username ='$username', profileImg ='$profile_src'
            WHERE email = '$email'";
            if(mysqli_query($conn, $sql_update)){
                $_SESSION['userImg'] = $profile_src;
                $_SESSION['username'] = $username;
                header("location:home.php");
                exit();
            }
            else{
                // echo "Error occur: " . mysqli_error($conn);
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

    <?php include("utility/navbars/selectNavbar.php");?>

    <div class="update-form-cont p-2">
        <div class="container w-50 border update-form py-2 rounded-5">
            <h2 class="h2 text-center">Update Profile</h2>
        <!-- Image before uploading -->
            <div class="profile-image text-center">
                <img src="<?php echo $imgFolder . $profile_src?>" class="rounded-circle object-fit-cover" style="width: 80px; height:80px" alt="">
            </div>
            <form action="profile_update.php" method= "post" enctype="multipart/form-data">
                
        <!--Profile IMAGE Div-->
                <div class="ms-auto py-2 mx-auto text-center sup-profile-div">
                    <label for="up-userImg" class="form-label">Update profile photo</label>
                    <input type="file" class="form-control" name="up-userImg" 
                    value="<?php echo $profile_src;?>" id="up-userImg" accept="image/*">
                    <div class="text-danger fw-bold">
                        <?php echo $error['up-userImg'];?>
                    </div> 
                </div>

                <div class="py-2">
                    <label for="username" class="form-label">Change Username</label>
                    <input type="text" name="username" id="username" class="form-control s-form-bg p-2" 
                    value="<?php echo $username;?>" placeholder="username">
                    <div class="text-danger fw-bold">
                        <?php echo $error['username'];?>
                    </div>
                </div>
                <div class="py-2">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="text" name="email" id="email" class="form-control s-form-bg p-2" 
                    value="<?php echo $email;?>" placeholder="email" readonly>
                </div>
                <div class="text-center py-1">
                <a href="home.php" class="btn user-sign-btn">Back to home</a>
                    <input style="width: fit-content;" type="submit" name="update" class="btn blue-btn" value="Save Details">
                </div>
            </form>
        </div>
    </div>
</body>
</html>