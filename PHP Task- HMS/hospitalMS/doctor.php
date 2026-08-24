<?php
    session_start();
    // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    // header("Pragma: no-cache");

    if(!empty($_SESSION['name'])){
        $username = $_SESSION['name'];
    }
    else{
        // $username = "guest";
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
            <div class="col-12 col-md-4 col-lg-2 min-vh-100 bg-dark text-light p-0">
                <h2 class="h4 text-success bg-light w-100 text-center">HMS</h2>
                <h5 class="h5 text-center border-bottom py-2">Doctor</h5>
                <!-- dashboard sidebar list -->
                <ul class="nav w-100 p-1 dash-sidebar">
                    <li class="nav-item  w-100 bg-primary text-center p-1 rounded">
                        <a href="doctor.php" class="nav-link text-light fw-semibold">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./doctor/appointments.php" class="nav-link text-light">
                            Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light">
                            Prescription
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light">
                            Attendance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light">
                            Expenditure
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-8 col-lg-10 p-0">
                <nav class="navbar border p-0">
                    <!-- left nav -->
                    <ul class="navbar-nav flex-row align-items-center">
                        <li class="nav-item d-block d-lg-none">
                            <button class="btn p-1 border me-2">
                                <img src="./images/hamburger.svg" alt="" width="30px">
                            </button>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Home</a>
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
                <div class="container">
                    <h2 class="h2">Dashboard</h2>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card bg-success text-light">
                                <div class="card-body">
                                    <h3 class="h3">26</h3>
                                    <p>Users</p>
                                    <button class="btn border border-dark w-100 text-light">More Info</button>
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