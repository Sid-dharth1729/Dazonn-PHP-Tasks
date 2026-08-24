<?php
    session_start();
    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
    }
    else{
        // $username = "guest";
        header("location:../index.php");
        exit();
    }
    include("../connect_db.php");
    // patients
    $p_sql = "SELECT * FROM staff_patient 
            WHERE role = 'patient'";
    $p_result = mysqli_query($conn, $p_sql);
    $all_patients = mysqli_fetch_all($p_result, MYSQLI_ASSOC);
    $p_cont = count($all_patients);
    mysqli_free_result($p_result);

    //doctors
     $d_sql = "SELECT * FROM staff 
            WHERE role = 'doctor'";
    $d_result = mysqli_query($conn, $d_sql);
    $all_doctors = mysqli_fetch_all($d_result, MYSQLI_ASSOC);
    $d_cont = count($all_doctors);
    mysqli_free_result($d_result);

    //appoinments
    $appoint_sql = "SELECT * FROM appointments";
    $sql_res = mysqli_query($conn, $appoint_sql);
    $all_appoints = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
    $ap_cont = count($all_appoints);

    //appoinment pending
    $pen_sql = "SELECT * FROM appointments WHERE ap_status = 'pending'";
    $pen_res = mysqli_query($conn, $pen_sql);
    $all_pen = mysqli_fetch_all($pen_res, MYSQLI_ASSOC);
    $pen_cont = count($all_pen);

    mysqli_close($conn);
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
                    <h2 class="h2 text-center">Dashbord</h2>
                      <div class="row justify-content-center align-items-center">
                        <div class="col-lg-3 col-md-6 col-12 py-2">
                            <div class="card bg-success text-light">
                                <div class="card-body">
                                    <h3 class="h3"><?php echo $p_cont;?></h3>
                                    <p>Patients</p>
                                    <a href="./all_patients.php" class="btn border border-dark w-100 text-light">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 py-2">
                            <div class="card bg-primary text-light">
                                <div class="card-body">
                                    <h3 class="h3"><?php echo $d_cont;?></h3>
                                    <p>Doctors</p>
                                    <a href="./all_doctors.php" class="btn border border-dark w-100 text-light">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 py-2">
                            <div class="card bg-warning text-light">
                                <div class="card-body">
                                    <h3 class="h3"><?php echo $ap_cont;?></h3>
                                    <p>Appointments</p>
                                    <a href="./all_appointments.php" class="btn border border-dark w-100 text-light">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 py-2">
                            <div class="card bg-danger text-light">
                                <div class="card-body">
                                    <h3 class="h3"><?php echo $pen_cont;?></h3>
                                    <p>Pending Appointments</p>
                                    <a href="./all_appointments.php" class="btn border border-dark w-100 text-light">More Info</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>