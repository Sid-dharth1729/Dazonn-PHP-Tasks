<?php
    include("../db_connect.php");

    $ad_errors = array('ad-email' =>'', 'ad-pass' =>'', 'role' =>'');
    $ad_email = '';
    $ad_pass = '';
    if(isset($_POST['ad-login'])){
        if(empty($_POST['ad-email'])){
            $ad_errors['ad-email'] = "Enter email address";
        }
        else{
            $ad_email = $_POST['ad-email'];

            $ad_sql = "SELECT * FROM users WHERE email = '$ad_email'";
            $q_result = mysqli_query($conn, $ad_sql);
            //fetching to check role (bcz all emails are in same table of db)
            $admin = mysqli_fetch_assoc($q_result);

            if(mysqli_num_rows($q_result) == 0 || $admin['role'] == 'user'){
                $ad_errors['ad-email'] = "Email doesn't exists";
            }
            mysqli_free_result($q_result);
            mysqli_close($conn);
        }
        if(empty($_POST['ad-password']) && empty($ad_errors['ad-email'])){
            $ad_errors['ad-pass'] = "Enter password";
        }else{
            $ad_pass = $_POST['ad-password'];
        }
        if(!array_filter($ad_errors)){  //if $ad_error is empty
            if($ad_pass != $admin['password']){
                $ad_errors['ad-pass'] = "Incorrect password";
            }
            else{
                session_start();
                $_SESSION['admin-name'] = $admin['username'];
                header("location:./admin_panel.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    include("../utility/header.php");
?>
<body  style="background-color: #f0f0f0;">
    <div class="admin-login-con">
        <div class="container py-4">
            <div class="row log-in-form rounded-5 m-1">
                <div class="col-lg-7 col-md-6 p-3 form-img">
                        <img class="w-100 h-100 object-fit-cover rounded-5" src="../images/form-img.jpg" alt="">
                </div>
                <!-- form -->
                <div class="col-lg-5 col-md-6 p-2">
                    <h2 class="h2 text-center">Admin Login</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <div class="py-2">
                            <label for="ad-email" class="form-label">Email:</label>
                            <input type="email" name="ad-email" id="ad-email" class="form-control"
                            value="<?php echo $ad_email;?>">
                            <div class="text-danger fw-bold">
                                <?php echo $ad_errors['ad-email'];?>
                            </div>
                        </div>
                        <div class="py-2">
                            <label for="ad-password" class="form-label">Password:</label>
                            <input type="password" name="ad-password" id="ad-password" class="form-control">
                        <div class="text-danger fw-bold">
                                <?php echo $ad_errors['ad-pass'];?>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <input style="width: fit-content;" type="submit" name="ad-login" value="Login" class="btn blue-btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
     <!-- copyright footer -->
    <?php include("../utility/footer_copyright.php");?>
</body>
</html>