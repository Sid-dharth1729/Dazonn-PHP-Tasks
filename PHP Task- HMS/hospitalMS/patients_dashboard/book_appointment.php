<?php
    //p_info
    include("./p_info.php");

    // connect to db
    include("../connect_db.php");

    //specialist and doctor available
    $sp_sql = "SELECT * FROM staff WHERE role = 'doctor'";
    $sp_result = mysqli_query($conn, $sp_sql);
    $d_specialists = mysqli_fetch_all($sp_result, MYSQLI_ASSOC);
    mysqli_free_result($sp_result);
   
    //doctor of selected specialization
    // $doc_sql = "SELECT * FROM staff WHERE role = 'doctor'";
    // $dq_result = mysqli_query($conn, $doc_sql);
    // $sp_doctors = mysqli_fetch_all($dq_result, MYSQLI_ASSOC);
    // print_r($sp_doctors);
    
    // $reg_no =''; 
    // $p_name =''; 
    $valid_doc =array(); //emptyarry
    if(isset($_POST['add_appoint'])){
        $specialization = $_POST['specialization']; 
        $doctor = $_POST['doctor'];
        $doc_sp_sql = "SELECT specialization FROM staff 
                    WHERE role = 'doctor' AND name = '$doctor'";
        $d_s_res = mysqli_query($conn, $doc_sp_sql);
        $slected_doc_sp = mysqli_fetch_assoc($d_s_res);
        mysqli_free_result($d_s_res);       
        // print_r($slected_doc_sp);        

        $ap_date = $_POST['apoint_date']; 
        $ap_time = $_POST['apoint_time'];

        if (empty($specialization) || empty($doctor) || empty($ap_date) || empty($ap_time)) {
            // echo "All fields are required.";
        } 
        elseif( $specialization !== $slected_doc_sp['specialization']){
            $er_sql = "SELECT name FROM staff 
                        WHERE role = 'doctor' AND specialization = '$specialization'";
            $er_res = mysqli_query($conn, $er_sql);
            // print_r($er_res);
            while($row = mysqli_fetch_assoc($er_res)){
                $valid_doc[] = $row['name'];
            }
            // print_r($valid_doc);
        }
        else {
            $ap_sql =  "INSERT INTO appointments(p_name, specialization, doctor, ap_date, ap_time, p_id)
                        VALUE ( '$username', '$specialization', '$doctor', '$ap_date', '$ap_time', '$id')";
            if(mysqli_query($conn, $ap_sql)){
                // echo "inserted in table";
                header("location:./my_appointment.php");
                exit();
            }
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("../utility/dash_header.php");?>
<body>
    <div class="dashboard_cont container-fluid">
        <div class="row">
            <!-- Side bar -->
            <?php include("./sidebar.php");?>

            <div class="col-12 col-md-8 col-lg-10 p-0">
                <!-- top_nav -->
                <?php include("./t_navbar.php");?>

                <div class="container">
                    <h2 class="h2 text-center">Book Appointment</h2>

                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" 
                            class="resp-width mx-auto border p-4" style="background-color:#d7eef4;">

                        <div class="row py-2 justify-content-lg-center align-items-center">
                            <label for="p_name" class="col-lg-4 col-12 form-label pe-2 fw-semibold">Name:</label>
                            <div class="col-lg-5 col-12">
                                <input type="text" name="p_name" id="p_name" class="form-control"
                                     value="<?php echo $username;?>" disabled>
                            </div>
                        </div>
                        <div class="row py-2 justify-content-lg-center align-items-lg-center">
                            <label for="specialization" class="col-lg-4 col-12 form-label pe-2 fw-semibold">Specialist:</label>
                            <div class="col-lg-5 col-12">
                                <select name="specialization" id="specialization" class="form-select text-capitalize" required>
                                    <!-- Specialist available -->
                                    <option value="">Select</option>
                                    <?php foreach ($d_specialists as $specialist):?>
                                        <option value="<?php echo $specialist['specialization'];?>">
                                            <?php echo htmlspecialchars($specialist['specialization']);?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <span class="text-danger fw-semibold text-capitalize">
                                    <?php if(!empty($specialization)):?>
                                    Available <?php echo $specialization;?> :
                                    <ol class="m-0">
                                        <?php foreach ($valid_doc as $doc):?>
                                            <li><?php echo htmlspecialchars($doc);?></li>
                                        <?php endforeach;?>
                                    </ol>
                                    <?php endif;?>
                                </span>
                            </div>
                        </div>
                        <div class="row py-2 justify-content-lg-center align-items-center">
                            <label for="doctor" class="col-lg-4 col-12 form-label pe-2 fw-semibold">Doctor:</label>
                            <div class="col-lg-5 col-12">
                                <select name="doctor" id="doctor" class="form-select text-capitalize" required>
                                    <option value="">Select doctor</option>
                                    <?php foreach ($d_specialists as $sp_doctor):?>
                                        <option value="<?php echo htmlspecialchars($sp_doctor['name']);?>">
                                            <?php echo htmlspecialchars($sp_doctor['name']);?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row py-2 justify-content-lg-center align-items-center">
                            <label for="apoint_date" class="col-lg-4 col-12 form-label pe-2 fw-semibold">Appointment Date:</label>
                            <div class="col-lg-5 col-12">
                                <input type="date" name="apoint_date" id="apoint_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="row py-2 justify-content-lg-center align-items-center">
                            <label for="apoint_time" class="col-lg-4 col-12 form-label pe-2 fw-semibold">Appointment Time:</label>
                            <div class="col-lg-5 col-12">
                                <input type="time" name="apoint_time" id="apoint_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="w-100 text-center py-2">
                            <input type="submit" name="add_appoint" class="btn btn-color" value="Book Appointment">
                        </div>
                    </form>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>