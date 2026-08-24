<?php

    //connect to db
    include("../connect_db.php");

    session_start();
    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
    }
    else{
        $username = "guest";
    }
    //for getting all patients
    $p_sql = "SELECT * FROM staff_patient 
            WHERE role = 'patient'";
    $p_result = mysqli_query($conn, $p_sql);
    $all_patients = mysqli_fetch_all($p_result, MYSQLI_ASSOC);
    // print_r($all_patients);

    mysqli_free_result($p_result);
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
                    <h2 class="h2 text-center">All Patients</h2>

                    <?php if(!empty($all_patients)):?>
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead >
                                    <tr>
                                        <th>p_Id</th>
                                        <th>Patient Name</th>
                                        <th>Gender</th>
                                        <th>Mobile No.</th>
                                        <th>Signup Date & Time</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    <?php foreach($all_patients as $patient):?>
                                        <tr>
                                            <td><?php echo $patient['id'];?></td>
                                            <td><?php echo $patient['name'];?></td>
                                            <td><?php echo $patient['gender'];?></td>
                                            <td><?php echo $patient['mobile'];?></td>
                                            <td><?php echo $patient['reg_date'];?></td>
                                            <!-- <td>
                                                <form action="<?php //echo $_SERVER['PHP_SELF']?>" method="post">
                                                    <input type="hidden" name="ap_id" value="<?php //echo $patient['id'];?>">
                                                    <button type="submit" name="ap_cancel" class="btn btn-danger btn-sm">
                                                        Cancel
                                                    </button>
                                                </form>
                                            </td> -->
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php else:?>
                        <h6 class="h5 text-warning text-center p-4">
                            No patient Exists
                        </h6>
                    <?php endif;?>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>