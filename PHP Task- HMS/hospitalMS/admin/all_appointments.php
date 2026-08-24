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

    $appoint_sql = "SELECT * FROM appointments";
    $sql_res = mysqli_query($conn, $appoint_sql);
    $all_appoints = mysqli_fetch_all($sql_res, MYSQLI_ASSOC);
    // print_r($all_appoints);
    mysqli_free_result($sql_res);
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
                    <h2 class="h2 text-center">All Appointments</h2>

                     <?php if(!empty($all_appoints)):?>
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead >
                                    <tr>
                                        <th>Ap_Id</th>
                                        <th>p_Id</th>
                                        <th>Patient Name</th>
                                        <th>Doctor</th>
                                        <th>Department</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    <?php foreach($all_appoints as $appoint):?>
                                        <tr>
                                            <td><?php echo $appoint['ap_id'];?></td>
                                            <td><?php echo $appoint['p_id'];?></td>
                                            <td><?php echo $appoint['p_name'];?></td>
                                            <td><?php echo $appoint['doctor'];?></td>
                                            <td><?php echo $appoint['specialization'];?></td>
                                            <td><?php echo $appoint['ap_date'];?></td>
                                            <td><?php echo $appoint['ap_time'];?></td>
                                            <td>
                                                <p class="<?php echo $appoint['ap_status'];?>">
                                                    <?php echo $appoint['ap_status'];?>
                                                </p>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php else:?>
                        <h6 class="h5 text-warning text-center p-4">
                            No Appointment Exists Yet
                        </h6>
                    <?php endif;?>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>