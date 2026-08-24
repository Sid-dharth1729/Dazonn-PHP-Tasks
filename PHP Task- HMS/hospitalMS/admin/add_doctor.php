<?php
    session_start();
    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
    }
    else{
        $username = "guest";
    }

    //connect to db
    include("../connect_db.php");
  
    $doc_name ='';
    $mob = '';
    $pass ='';
    $c_pass ='';
    $doc_error = array('doc_name'=>'', 'mob'=>'', 'pass'=>'', 'c_pass'=>'');
    if(isset($_POST['add_doc'])){
        $gender = $_POST['gender'];
        $specialization = $_POST['specialization'];

        if(empty($_POST['doc_name'])){
            $doc_error['doc_name'] = "Doctor name is empty";
        }
        else{
            $doc_name = $_POST['doc_name'];
        }
        if(empty($_POST['mob'])){
            $doc_error['mob'] = "Mobile number is empty";
        }
        else{
            if(!is_numeric($_POST['mob']) || strlen($_POST['mob']) != 10){
                $doc_error['mob'] = "Mobile number is not valid"; 
            }
            $mob = $_POST['mob'];
        }
        if($_POST['pass'] === ''){
            $doc_error['pass'] = "Password can't be empty";
        }
        else{
            $pass = $_POST['pass'];
        }
        if($_POST['c_pass'] === ''){
            $doc_error['c_pass'] = "Password can't be empty";
        }
        else{
            $c_pass = $_POST['c_pass'];
            if($c_pass !== $pass){
                $doc_error['c_pass'] = "Password doesn't match";
            }
        }
        if(!array_filter($doc_error)){ //array haven't any values
            $mob = mysqli_real_escape_string($conn, $mob);
            $check = "SELECT * FROM staff WHERE mobile = $mob";
            $result = mysqli_query($conn, $check);
            if(mysqli_num_rows($result) > 0){
                $doc_error['mob'] = "Mobile number is already registered";
            }
            else{

                //using function to remove all the sql keywords if exists in variable {mysqli_real_escape_string()}
                $doc_name = mysqli_real_escape_string($conn, $doc_name);
                $pass = mysqli_real_escape_string($conn, $pass);
                //to store password with dots or hidden form (so it cant be shown in db)
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                
                $d_sql = "INSERT INTO staff(name, mobile, gender, specialization, password)
                    VALUES ('$doc_name','$mob','$gender','$specialization','$pass')"; //$hashed_pass can be used to hide pass in db
                if(mysqli_query($conn, $d_sql)){
                    echo "stored";
                    header("location: ./all_doctors.php");
                    mysqli_close($conn); //optional php server auto close it
                    exit();
                }
                // else{
                //     echo "query error:" . mysqli_error($conn);
                // }
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("../utility/dash_header.php");?>
<body>
    <div class="dashbord_cont container-fluid">
        <div class="row">
            <!-- Side bar -->
            <?php include("./admin_sidebar.php");?>

            <div class="col-12 col-md-8 col-lg-10 p-0">
                <!-- top_nav -->
                <?php include("./admin_t_navbar.php");?>

                <div class="container">
        
                <h2 class="h2 text-center">Add Doctor</h2>

                <div class="conatiner w-50 mx-auto p-4" style="background: #f9f4c5;">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <div class="py-2">
                            <label for="doc_name" class="form-label">Doctor Name</label>
                            <input type="text" name="doc_name" id="doc_name" class="form-control"
                            value="<?php echo $doc_name;?>"> 
                            <div class="text-danger fw-bold">
                                <?php echo $doc_error['doc_name'];?>
                            </div>
                        </div>
                        <div class="py-2">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select">
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
                                <?php echo $doc_error['mob'];?>
                            </div>
                        </div>
                        <div class="py-2">
                            <label for="specialization" class="form-label">Specialization</label>
                            <select name="specialization" id="specialization" class="form-select" required>
                                <option value="">Select</option>
                                <option value="physician">Physician</option>
                                <option value="ophthalmologist">Ophthalmologist</option>
                                <option value="orthopedic">Orthopedic</option>
                                <option value="urologist">Urologist</option>
                                <option value="neurologist">Neurologist</option>
                                <option value="gastroenterologist">Gastroenterologist</option>
                                <option value="gynecologist">Gagynecologist</option>
                                <option value="dermatologist">Dermatologist</option>
                                <option value="cardiologist">Cardiologist</option>
                            </select>
                        </div>
                        <div class="py-2">
                            <label for="pass" class="form-label">Create Password </label>
                            <input type="password" name="pass" id="pass" class="form-control fw-bold"
                            value="<?php echo $pass;?>">
                            <div class="text-danger fw-bold">
                                <?php echo $doc_error['pass'];?>
                            </div>
                        </div>
                        <div class="py-2">
                            <label for="c_pass" class="form-label">Confirm Password </label>
                            <input type="password" name="c_pass" id="c_pass" class="form-control fw-bold"
                            value="<?php echo $c_pass;?>">
                            <div class="text-danger fw-bold">
                                <?php echo $doc_error['c_pass'];?>
                            </div>
                        </div>
                        <div class="w-100 text-center py-3">
                            <input type="submit" name="add_doc" value="Add Doctor" class="btn btn-color py-2 px-3">
                            </p>
                        </div>
                    </form>
                </div>
    
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>