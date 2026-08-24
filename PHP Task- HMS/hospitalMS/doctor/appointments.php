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
    //appointments table
    $appoint_sql = "SELECT * FROM appointments WHERE doctor = '$username'";
    $sql_res = mysqli_query($conn, $appoint_sql);
    $all_appoints = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
    // print_r($all_appoints);
    mysqli_free_result($sql_res);

    //add pricription
    if(isset($_POST['prescribe'])){
        // session_start();
        $_SESSION['ap_id'] = $_POST['ap_id'];
        echo $_SESSION['ap_id'];
        echo $_POST['ap_id'];
        // header("local")
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
                    <h2 class="h2 text-center">All Appointments</h2>
                    
                    <div class="table-responsive">    
                        <?php if(!empty($all_appoints)):?>
                            <table class="table table-striped text-center table-hover">
                                <thead >
                                    <tr>
                                        <th>Appointment Id</th>
                                        <th>Patient Name</th>
                                        <th>Doctor</th>
                                        <th>Department</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Prescribe</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    <?php foreach($all_appoints as $appoint):?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($appoint['ap_id']);?></td>
                                            <td><?php echo htmlspecialchars($appoint['p_name']);?></td>
                                            <td><?php echo htmlspecialchars($appoint['doctor']);?></td>
                                            <td><?php echo htmlspecialchars($appoint['specialization']);?></td>
                                            <td><?php echo htmlspecialchars($appoint['ap_date']);?></td>
                                            <td><?php echo htmlspecialchars($appoint['ap_time']);?></td>
                                            <td>
                                                <p class="<?php echo htmlspecialchars($appoint['ap_status']);?>">
                                                    <?php echo htmlspecialchars($appoint['ap_status']);?>
                                                </p>
                                            </td>
                                            <!-- prescription button -->
                                            <td class ="p-1">
                                                <?php if($appoint['ap_status'] === 'pending'):?>
                                                <a href="./prescription_form.php?ap_id=<?php echo htmlspecialchars($appoint['ap_id']);?>" class="btn btn-warning btn-sm m-0">
                                                        Prescribe
                                                </a>
                                                <?php else:?>
                                                <button class="btn btn-warning btn-sm m-0" disabled>
                                                        Prescribe
                                                </button> 
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else:?>
                            <h6 class="h5 text-warning text-center p-4">
                                No Appointment Exists Yet
                            </h6>
                        <?php endif;?>
                    </div>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>