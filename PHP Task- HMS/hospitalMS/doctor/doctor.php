<?php
    session_start();
    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
    }
    else{
        $username = "guest";
    }
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

                 <div class="container dashboard">
                    <h2 class="h2 text-center">Dashboard</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-12 p-2">
                            <div class="card border p-2">
                                <div class="card-img-div mx-auto">
                                    <img src="../images/bookmark.svg" alt="" class="card-svg">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="h5">Appointments</h4>
                                    <a href="./appointments.php" class="fw-semibold">
                                        Appointments
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-12 p-2">
                            <div class="card border p-2">
                                <div class="card-img-div mx-auto">
                                    <img src="../images/doc.svg" alt="" class="card-svg">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="h5">Prescriptions</h4>
                                    <a href="./doc_prescription.php" class="fw-semibold">
                                        View Prescriptions
                                    </a>
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