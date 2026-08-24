<?php
   // db is also used in p_info
    include("./p_info.php");

    include("../connect_db.php");

    $pres_sql = "SELECT * FROM prescription WHERE p_name = '$username'";
    $pres_res = mysqli_query($conn, $pres_sql);
    $all_pres = mysqli_fetch_all($pres_res, MYSQLI_ASSOC);
    print_r($all_pres);
    mysqli_free_result($pres_res);
    //view pricription

    mysqli_close($conn);

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
                    <h2 class="h2 text-center">Your all Prescription</h2>

                     <?php if(!empty($all_pres)):?>
                        <div class="table-responsive">
                            <table class="table table-striped text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th>Appointment Id</th>
                                        <th>Patient Name</th>
                                        <th>Doctor</th>
                                        <th>Department</th>
                                        <th>Complaint</th>
                                        <th>Disease</th>
                                        <th>Prescription</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    <?php foreach($all_pres as $pres):?>
                                        <tr>
                                            <td><?php echo $pres['ap_id'];?></td>
                                            <td><?php echo $pres['p_name'];?></td>
                                            <td><?php echo $pres['doctor'];?></td>
                                            <td><?php echo $pres['department'];?></td>
                                            <td><?php echo $pres['complaint'];?></td>
                                            <td><?php echo $pres['disease'];?></td>
                                            <td><?php echo $pres['prescription'];?></td>
                                            <td><?php echo $pres['date'];?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>

                    <?php else:?>
                        <h6 class="h5 text-warning text-center p-4">
                            No Prescription Exists Yet
                        </h6>
                    <?php endif;?>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>