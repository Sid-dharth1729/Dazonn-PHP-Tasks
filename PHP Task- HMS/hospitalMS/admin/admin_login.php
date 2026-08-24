<?php
    include("../connect_db.php");
    //ROLE
    $role ='admin';
    //login
    include("../utility/val_login.php");

?>

<!DOCTYPE html>
<html lang="en">
    <?php include("../utility/dash_header.php");?>
<body>

    <!-- login form -->
    <div class="login-form-cont">
        <div class="conatiner w-50 mx-auto p-4" style="background: #fbd1d1;">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <!-- <h2 class="h5">HOSPITAL MANAGEMENT SYSTEM</h2> -->
                <h2 class="h2 text-center">
                        Admin Login
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