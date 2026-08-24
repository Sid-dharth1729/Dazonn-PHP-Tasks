<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location:login_signup.php");
    }
    // else{
    //     echo "nahi hai empty";
    // }
?>

<!DOCTYPE html>
<html lang="en">
<?php include("utility/header.php");?>
<body>
    <?php include("utility/navbars/selectNavbar.php");?>

    <!-- Courses sec -->
    <div class="container-fluid about-top">
        <div class="container about-top-cont ">
            <h1 class="h1 text-center fs-large fw-bold">All Courses</h1>
            <div class="btm-link d-flex justify-content-center">
                <a href="home.php" class="text-decoration-none">Home</a>
                <p> / Courses</p>
            </div>
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="all_courses" style="background-color:#F9F9F9";>
        <div class="container sec-cont">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 py-2">
                    <div class="card bg-light rounded-3 shadow courses-card">
                        <div class="course-card-img-div">
                            <img class="card-img-top mb-2 rounded-top-3" src="./images/coursesImg/course-1.jpg" alt="">
                            <span class="course-badge">Education</span>
                        </div>
                        <div class="card-body text-center">
                            <a href="#" class="h5 fw-bold text-decoration-none course-card-head">Complete User fundamentals beginners to advanced</a>
                            <div class="course-card-p my-3 d-flex justify-content-center gap-3" style="font-size:0.9rem;">
                                <p class="text-dark m-0"> 
                                    <img class="clock" style="width:20px;" src="https://www.svgrepo.com/show/532906/book-open.svg" alt="">
                                    <span>12 Course</span>
                                    <p class="m-0">
                                        <img class="clock" src="https://www.svgrepo.com/show/479673/alarm-clock.svg" alt="">
                                        <span>
                                            2 Hrs 32 Min
                                        </span>
                                    </p> 
                                </p>
                            </div>
                        </div>
                        <div class="card-footer course-card-footer text-center bg-light rounded-3">
                            <h5 class="h5 fw-bold">Course Fee - 99$</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 py-2">
                    <div class="card bg-light rounded-3 shadow courses-card">
                        <div class="course-card-img-div">
                            <img class="card-img-top mb-2 rounded-top-3" src="./images/coursesImg/course-1.jpg" alt="">
                            <span class="course-badge">Education</span>
                        </div>
                        <div class="card-body text-center">
                            <a href="#" class="h5 fw-bold text-decoration-none course-card-head">Complete User fundamentals beginners to advanced</a>
                            <div class="course-card-p my-3 d-flex justify-content-center gap-3" style="font-size:0.9rem;">
                                <p class="text-dark m-0"> 
                                    <img class="clock" style="width:20px;" src="https://www.svgrepo.com/show/532906/book-open.svg" alt="">
                                    <span>12 Course</span>
                                    <p class="m-0">
                                        <img class="clock" src="https://www.svgrepo.com/show/479673/alarm-clock.svg" alt="">
                                        <span>
                                            2 Hrs 32 Min
                                        </span>
                                    </p> 
                                </p>
                            </div>
                        </div>
                        <div class="card-footer course-card-footer text-center bg-light rounded-3">
                            <h5 class="h5 fw-bold">Course Fee - 99$</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 py-2">
                    <div class="card bg-light rounded-3 shadow courses-card">
                        <div class="course-card-img-div">
                            <img class="card-img-top mb-2 rounded-top-3" src="./images/coursesImg/course-1.jpg" alt="">
                            <span class="course-badge">Education</span>
                        </div>
                        <div class="card-body text-center">
                            <a href="#" class="h5 fw-bold text-decoration-none course-card-head">Complete User fundamentals beginners to advanced</a>
                            <div class="course-card-p my-3 d-flex justify-content-center gap-3" style="font-size:0.9rem;">
                                <p class="text-dark m-0"> 
                                    <img class="clock" style="width:20px;" src="https://www.svgrepo.com/show/532906/book-open.svg" alt="">
                                    <span>12 Course</span>
                                    <p class="m-0">
                                        <img class="clock" src="https://www.svgrepo.com/show/479673/alarm-clock.svg" alt="">
                                        <span>
                                            2 Hrs 32 Min
                                        </span>
                                    </p> 
                                </p>
                            </div>
                        </div>
                        <div class="card-footer course-card-footer text-center bg-light rounded-3">
                            <h5 class="h5 fw-bold">Course Fee - 99$</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 py-2">
                    <div class="card bg-light rounded-3 shadow courses-card">
                        <div class="course-card-img-div">
                            <img class="card-img-top mb-2 rounded-top-3" src="./images/coursesImg/course-1.jpg" alt="">
                            <span class="course-badge">Education</span>
                        </div>
                        <div class="card-body text-center">
                            <a href="#" class="h5 fw-bold text-decoration-none course-card-head">Complete User fundamentals beginners to advanced</a>
                            <div class="course-card-p my-3 d-flex justify-content-center gap-3" style="font-size:0.9rem;">
                                <p class="text-dark m-0"> 
                                    <img class="clock" style="width:20px;" src="https://www.svgrepo.com/show/532906/book-open.svg" alt="">
                                    <span>12 Course</span>
                                    <p class="m-0">
                                        <img class="clock" src="https://www.svgrepo.com/show/479673/alarm-clock.svg" alt="">
                                        <span>
                                            2 Hrs 32 Min
                                        </span>
                                    </p> 
                                </p>
                            </div>
                        </div>
                        <div class="card-footer course-card-footer text-center bg-light rounded-3">
                            <h5 class="h5 fw-bold">Course Fee - 99$</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 py-2">
                    <div class="card bg-light rounded-3 shadow courses-card">
                        <div class="course-card-img-div">
                            <img class="card-img-top mb-2 rounded-top-3" src="./images/coursesImg/course-1.jpg" alt="">
                            <span class="course-badge">Education</span>
                        </div>
                        <div class="card-body text-center">
                            <a href="#" class="h5 fw-bold text-decoration-none course-card-head">Complete User fundamentals beginners to advanced</a>
                            <div class="course-card-p my-3 d-flex justify-content-center gap-3" style="font-size:0.9rem;">
                                <p class="text-dark m-0"> 
                                    <img class="clock" style="width:20px;" src="https://www.svgrepo.com/show/532906/book-open.svg" alt="">
                                    <span>12 Course</span>
                                    <p class="m-0">
                                        <img class="clock" src="https://www.svgrepo.com/show/479673/alarm-clock.svg" alt="">
                                        <span>
                                            2 Hrs 32 Min
                                        </span>
                                    </p> 
                                </p>
                            </div>
                        </div>
                        <div class="card-footer course-card-footer text-center bg-light rounded-3">
                            <h5 class="h5 fw-bold">Course Fee - 99$</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("utility/footer.php");?>
</body>
</html>