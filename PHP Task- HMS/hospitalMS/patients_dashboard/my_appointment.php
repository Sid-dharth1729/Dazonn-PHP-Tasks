<?php

     // p_info
    include("./p_info.php");

    //connect to db
    include("../connect_db.php");
    
    $apl_sql = "SELECT * FROM appointments 
                WHERE p_id = '$id'";
    $sql_result = mysqli_query($conn, $apl_sql);
    $ap_lists = mysqli_fetch_all($sql_result, MYSQLI_ASSOC);
    
    // print_r($ap_lists);
     
    mysqli_free_result($sql_result);
    if(isset($_POST['ap_cancel'])){
        $ap_id = $_POST['ap_id'];
        echo $ap_id;
        // $del_sql = "DELETE * FROM appoinments WHERE ap_id = $ap_id";
    }
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
                    <h2 class="h2 text-center">My Appointment</h2>
                    
                    <?php if(!empty($ap_lists)):?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Doctor</th>
                                        <th>Department</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class ="text-capitalize">
                                    <?php $s_num = 1;?>
                                    <?php foreach($ap_lists as $appoinment):?>
                                        <tr>
                                            <td><?php echo $s_num++;?></td>
                                            <td><?php echo $appoinment['doctor'];?></td>
                                            <td><?php echo $appoinment['specialization'];?></td>
                                            <td><?php echo $appoinment['ap_date'];?></td>
                                            <td><?php echo $appoinment['ap_time'];?></td>
                                            <td>
                                                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                                    <input type="hidden" name="ap_id" value="<?php echo $appoinment['ap_id'];?>">
                                                    <button type="submit" name="ap_cancel" class="btn btn-danger">
                                                        Cancel
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php else:?>
                        <h6 class="h5 text-warning text-center p-4">
                            You have no appointments
                        </h6>
                    <?php endif;?>
                </div>
                <?php include("../utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>