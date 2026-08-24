<?php
    include("connect_db.php");
    $role ='patient';
    //signup
    include("./utility/val_signup.php");
    //login
    include("./utility/val_login.php");

?>

<!DOCTYPE html>
<html lang="en">
    <?php include("utility/header.php");?>
<body>

        <!-- signUp form -->
    <div class="signup-form-cont">
        <div class="conatiner w-50 mx-auto p-4" style="background: #d1f1fb;">
            <form action="login_signup.php?form=signup" method="post">
                <!-- <h2 class="h5">HOSPITAL MANAGEMENT SYSTEM</h2> -->
                <h2 class="h2 text-center">Patient SignUp</h2>
                <div class="py-2">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                    value="<?php echo $name;?>"> 
                    <div class="text-danger fw-bold">
                        <?php echo $error['name'];?>
                    </div>
                </div>
                <div class="py-2">
                    <label for="gender" class="form-label">Gender</label>
                    <select type="gender" name="gender" id="gender" class="form-select">
                        <option value="male">Male</option>                            
                        <option value="female">Female</option>                            
                        <option value="other">Other</option>                            
                    </select>
                </div>
                <div class="py-2">
                    <label for="mob" class="form-label">Enter Phone </label>
                    <input type="tel" name="mob" id="mob" class="form-control" 
                    value="<?php echo $mob;?>">
                     <div class="text-danger fw-bold">
                        <?php echo $error['mob'];?>
                    </div>
                </div>
                <div class="py-2">
                    <label for="pass" class="form-label">Enter Password </label>
                    <input type="password" name="pass" id="pass" class="form-control fw-bold"
                    value="<?php echo $pass;?>">
                     <div class="text-danger fw-bold">
                        <?php echo $error['pass'];?>
                    </div>
                </div>
                <div class="py-2">
                    <label for="c_pass" class="form-label">Confirm Password </label>
                    <input type="password" name="c_pass" id="c_pass" class="form-control fw-bold"
                    value="<?php echo $c_pass;?>">
                     <div class="text-danger fw-bold">
                        <?php echo $error['c_pass'];?>
                    </div>
                </div>
                <div class="w-100 text-center py-3">
                    <input type="submit" name="signup" value="SignUp" class="btn btn-color py-2 px-3">
                    <p class="text-dark pt-2">Already have an account 
                        <a href="./login_signup.php?form=login" class="text-decoration-none">
                            Login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- login form -->
    <div class="login-form-cont">
        <div class="conatiner w-50 mx-auto p-4" style="background: #d1f1fb;">
            <form action="./login_signup.php?form=login" method="post">
                <!-- <h2 class="h5">HOSPITAL MANAGEMENT SYSTEM</h2> -->
                <h2 class="h2 text-center">
                        Patient Login
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

                    <p class="text-dark pt-2">Don't have an account 
                        <a href="login_signup.php?form=signup" class="text-decoration-none">
                            SignUp
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>



    <!-- script -->
     <script src="./utility/script.js"></script>
</body>
</html>