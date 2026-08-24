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
    //for getting all doctord
    $d_sql = "SELECT * FROM staff 
            WHERE role = 'doctor'";
    $d_result = mysqli_query($conn, $d_sql);
    $all_doctors = mysqli_fetch_all($d_result, MYSQLI_ASSOC);
    // print_r($all_patients);

    mysqli_free_result($d_result);
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
                    <h2 class="h2 text-center">All Doctors</h2>
                    <?php if(!empty($all_doctors)):?>
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead >
                                    <tr>
                                        <th>doc_Id</th>
                                        <th>Doctor Name</th>
                                        <th>Specialization</th>
                                        <th>Gender</th>
                                        <th>Mobile No.</th>
                                        <th>Signup Date & Time</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    <?php foreach($all_doctors as $doctor):?>
                                        <tr>
                                            <td><?php echo $doctor['staff_id'];?></td>
                                            <td><?php echo $doctor['name'];?></td>
                                            <td><?php echo $doctor['specialization'];?></td>
                                            <td><?php echo $doctor['gender'];?></td>
                                            <td><?php echo $doctor['mobile'];?></td>
                                            <td><?php echo $doctor['date_time'];?></td>
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
                            No Doctor Exists
                        </h6>
                    <?php endif;?>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>