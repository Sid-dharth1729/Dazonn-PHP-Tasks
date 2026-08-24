<?php
    session_start();
    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
    }
    else{
        header("location:./index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("./utility/header.php");?>
<body>
    <div class="dashboard_cont container-fluid">
        <div class="row">
            <!-- Side bar -->
            <div class="col-12 col-md-4 col-lg-2 min-vh-100 bg-dark text-light p-0">
                <h2 class="h4 text-success bg-light w-100 text-center">HMS</h2>
                <h5 class="h5 text-center border-bottom py-2">Patient</h5>
                <!-- dashboard sidebar list -->
                <ul class="nav w-100 p-1 dash-sidebar">
                    <li class="nav-item  w-100 bg-primary text-center p-1 rounded">
                        <a href="patient.php" class="nav-link text-light fw-semibold">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./patients_dashboard/book_appointment.php" class="nav-link text-light">
                            Book Appointment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./patients_dashboard/my_appointment.php" class="nav-link text-light">
                            My Appointment 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./patients_dashboard/prescription.php" class="nav-link text-light">
                            Prescription
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-8 col-lg-10 p-0">
                <!-- top_nav -->
                <nav class="navbar border p-0">
                    <!-- left nav -->
                    <ul class="navbar-nav flex-row align-items-center">
                        <li class="nav-item d-block d-lg-none">
                            <button class="btn p-1 border me-2">
                                <img src="./images/hamburger.svg" alt="" width="30px">
                            </button>
                        </li>
                        <li class="nav-item">
                            <a href="./patient.php" class="nav-link">Home</a>
                        </li>
                    </ul>
                    <!-- right nav item -->
                    <ul class="navbar-nav flex-row align-items-center gap-2 pe-2">
                        <li class="nav-item d-flex ">
                            <span class="fw-semibold m-0 text-capitalize"><?php echo $username;?></span>
                        </li>
                        <li class="nav-item">
                            <a href="./utility/logout.php" class="btn btn-danger btn-sm p-1">
                                Logout
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container dashboard">
                    <h2 class="h2">Dashboard</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-12 p-2">
                            <div class="card border p-2">
                                <div class="card-img-div mx-auto">
                                    <img src="./images/bookmark.svg" alt="" class="card-svg">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="h5">Book My Appointment</h4>
                                    <a href="./patients_dashboard/book_appointment.php" class="fw-semibold">
                                        Book Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-12 p-2">
                            <div class="card border p-2">
                                <div class="card-img-div mx-auto">
                                    <img src="./images/link.svg" alt="" class="card-svg">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="h5">My Appointment</h4>
                                    <a href="./patients_dashboard/my_appointment.php" class="fw-semibold">
                                        View My Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-12 p-2">
                            <div class="card border p-2">
                                <div class="card-img-div mx-auto">
                                    <img src="./images/doc.svg" alt="" class="card-svg">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="h5">Prescriptions</h4>
                                    <a href="./patients_dashboard/prescription.php" class="fw-semibold">
                                        View Prescriptions
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("./utility/footer.php");?>
            </div>
        </div>
    </div>
</body>
</html>