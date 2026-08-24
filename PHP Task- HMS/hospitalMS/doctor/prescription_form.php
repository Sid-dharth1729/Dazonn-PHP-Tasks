<?php
    session_start();
    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
    }
    else{
        $username = "guest";
    }
    if(!isset($_GET['ap_id']) || empty($_GET['ap_id'])){
        die("invalid request");
    }
    else{
        $ap_id = $_GET['ap_id']; 
    }

    include("../connect_db.php");
    //appointments table
    $ap_sql = "SELECT * FROM appointments WHERE ap_id = '$ap_id'";
    $sql_res = mysqli_query($conn, $ap_sql);
    $appointment = mysqli_fetch_assoc($sql_res);
    // print_r($appointment);
    mysqli_free_result($sql_res);

    $error = array("complaint" =>'','disease' => '' ,'prescription' => '');
    $complaint ='';
    $disease ='';
    $prescription ='';
    if(isset($_POST['save'])){
        if(empty($_POST['complaint'])){
            $error['complaint'] ="Enter patient complaint";
        }else{
            $complaint = $_POST['complaint'];
        }
        if(empty($_POST['disease'])){
            $error['disease'] ="Enter patient disease";
        }else{
            $disease = $_POST['disease'];
        }
        if(empty($_POST['prescription'])){
            $error['prescription'] ="Enter prescription for patient";
        }else{
            $prescription = $_POST['prescription'];
        }
        if(!array_filter($error)){ //no error
            $complaint = mysqli_real_escape_string($conn, $complaint);
            $disease = mysqli_real_escape_string($conn, $disease);
            $prescription = mysqli_real_escape_string($conn, $prescription);
            $pres_sql = "INSERT INTO prescription(ap_id, p_id, p_name, doctor, department, complaint, disease, prescription) 
                    VALUES ('$appointment[ap_id]','$appointment[p_id]', '$appointment[p_name]', 
                    '$appointment[doctor]','$appointment[specialization]',
                    '$complaint', '$disease', '$prescription')";
            if(mysqli_query($conn, $pres_sql)){
                //update appointment status = completed
                $u_app = "UPDATE appointments SET ap_status ='completed'  WHERE ap_id = $appointment[ap_id]";
                if(mysqli_query($conn, $u_app)){
                    header("location:./appointments.php");
                }else{
                    echo "updation error: " . mysqli_error($conn);
                }
            }else{
                    echo "insertion error: " . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("../utility/dash_header.php");?>
<body>
    <div class="dashbord_cont container-fluid">
        <div class="row">
            <!-- Side bar -->
            <?php include("./doc_sidebar.php");?>

            <div class="col-12 col-md-8 col-lg-10 p-0">
                <!-- top_nav -->
                <?php include("./doc_t_navbar.php");?>

                 <div class="container">
                    <form action="<?php echo $_SERVER['PHP_SELF'] . '?ap_id=' .$ap_id;?>" method="post">
                        <div class="py-2 info d-flex flex-column flex-lg-row gap-2">
                            <div>
                                <label for="ap_id" class="form-label">ap_id:</label>
                                <input type="text" name="ap_id" id="ap_id" class="form-control"
                                value="<?php echo $appointment['ap_id'];?>" disabled>
                            </div>
                            <div>
                                <label for="p_id" class="form-label">p_id:</label>
                                <input type="text" name="p_id" id="p_id" class="form-control"
                                value="<?php echo $appointment['p_id'];?>" disabled>
                            </div>
                            <div>
                                <label for="p_name" class="form-label">Patient name:</label>
                                <input type="text" name="p_name" id="p_name" class="form-control"
                                value="<?php echo $appointment['p_name'];?>" disabled>
                            </div>
                            <div>
                                <label for="doctor" class="form-label">Doctor:</label>
                                <input type="text" name="doctor" id="doctor" class="form-control"
                                value="<?php echo $appointment['doctor'];?>" disabled>
                            </div>
                            <div>
                                <label for="specialization" class="form-label">Department:</label>
                                <input type="text" name="specialization" id="specialization" class="form-control text-capitalize"
                                value="<?php echo $appointment['specialization'];?>" disabled>
                            </div>
                        </div>
                        <!-- filled by doctor -->
                        <div class="py-2">
                            <label for="complaint" class="form-label">Patient Complaint:</label>
                            <textarea name="complaint" id="complaint" class="form-control"><?php echo htmlspecialchars($complaint);?></textarea>
                            <p class="text-danger fw-semibold"><?php echo $error['complaint'];?></p>
                        </div>
                        <div class="py-2">
                            <label for="disease" class="form-label">Disease:</label>
                            <textarea name="disease" id="disease" class="form-control"><?php echo htmlspecialchars($disease);?></textarea>
                            <p class="text-danger fw-semibold"><?php echo $error['disease'];?></p>

                        </div>
                         <div class="py-2">
                            <label for="prescription" class="form-label">Patient Complaint:</label>
                            <textarea name="prescription" id="prescription" class="form-control"><?php echo htmlspecialchars($prescription);?></textarea>
                            <p class="text-danger fw-semibold"><?php echo $error['prescription'];?></p>
                        </div>
                        <div class="py-2 text-center">
                            <input type="submit" name="save" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                 </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>