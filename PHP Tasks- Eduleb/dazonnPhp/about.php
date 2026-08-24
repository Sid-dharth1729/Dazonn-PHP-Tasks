<!DOCTYPE html>
<html lang="en">

    <?php include("utility/header.php");?>

<body>
    <!-- navbar -->
    <?php include("utility/navbars/selectNavbar.php");?>

    <!-- about sec -->
    <div class="container-fluid about-top">
        <div class="container about-top-cont ">
            <h1 class="h1 text-center fs-large fw-bold">About</h1>
            <div class="btm-link d-flex justify-content-center">
                <a href="home.php" class="text-decoration-none">Home</a>
                <p> / About</p>
            </div>
        </div>
    </div>

    <!-- About Discription -->
     <div class="dis-bg">
        <div class="container sec-cont">
            <div class="title-div text-center">
                <h1 class="h1">Start your journey With us</h1>
                <p class="p-txt text-secondary">We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of learning options and gain new skills! Our school is know.</p>
            </div>
            <div class="card-cont row g-4">
                <div class="col-card col-lg-3 col-md-6 col-sm-12">
                    <div class="card p-4">
                        <div class="card-body p-0 mb-4">
                            <div class="card-head d-flex gap-2 align-items-center justify-content-start">
                                <div class="card-circle">
                                    <h5 class="h5">01</h5></div>
                                <h5 class="h5 pe-3">Expert Teacher</h5>
                            </div>
                            <p class="p-txt pt-3">Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                        </div>
                    </div>
                </div>
                <div class="col-card col-lg-3 col-md-6 col-sm-12">
                    <div class="card p-4">
                        <div class="card-body p-0 mb-4">
                            <div class="card-head d-flex gap-2 align-items-center justify-content-start">
                                <div class="card-circle circle-blue">
                                    <h5 class="h5">02</h5></div>
                                <h5 class="h5">Quality Education</h5>
                            </div>
                            <p class="p-txt pt-3">Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                        </div>
                    </div>
                </div>
                <div class="col-card col-lg-3 col-md-6 col-sm-12">
                    <div class="card p-4">
                        <div class="card-body p-0 mb-4">
                            <div class="card-head d-flex gap-2 align-items-center justify-content-start">
                                <div class="card-circle circle-violet">
                                    <h5 class="h5">03</h5></div>
                                <h5 class="h5">Remote Learning</h5>
                            </div>
                            <p class="p-txt pt-3">Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                        </div>
                    </div>
                </div>
                <div class="col-card col-lg-3 col-md-6 col-sm-12">
                    <div class="card p-4">
                        <div class="card-body p-0 mb-4">
                            <div class="card-head d-flex gap-2 align-items-center justify-content-start">
                                <div class="card-circle circle-green">
                                    <h5 class="h5">04</h5></div>
                                <h5 class="h5">Life Time Support</h5>
                            </div>
                            <p class="p-txt pt-3">Lorem ipsum dolor sit amet, consectetur notted adipisicing elit ut labore.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

     <!-- IMAGE dicription -->
      <div class="abt-courses">
        <div class="container sec-cont">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="course-img-div mb-2">
                        <img src="images/about-couses.jpg" class="courses-img img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <h1 class="h1">We Are Providing The Online Course In Global World</h1>
                    <p class="pt-2 p-txt">We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of learning options and gain new skills! Our school is know.</p>
                    <p class="pt-2 p-txt">We offer a brand new approach to the most basic learning paradigms. Choose from a wide range of learning options and gain new skills! Our school is know.</p>
                    <ul class="tick-list">
                        <li class="li-txt">Get access to 12,000+ of our top courses</li>
                        <li class="li-txt">Popular topic to learn now in our online courses for student</li>
                        <li class="li-txt">Find the right instructor for you</li>
                    </ul>
                    <button class="btn blue-btn rounded-0 mt-2">View All Courses</button>
                </div>
            </div>
        </div>
      </div>
    
    <!-- Build Career -->
     <div class="build-cont">
        <div class="container sec-cont">
            <div class="row">
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <div class="career-card career-1">
                        <h4>Build Your Career</h4>
                        <h1>Become an Instructor</h1>
                        <p class="p-txt text-light">Learn at your own pace, move the between multiple courses. </p>
                        <a class="btn blue-btn text-decoration-none rounded-0" href="#">Apply now</a>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-6 col-sm-12">
                    <div class="career-card  career-2">
                        <h4>Build Your Career</h4>
                        <h1>Get Free Courses</h1>
                        <p class="p-txt text-light">Learn at your own pace, move the between multiple courses. </p>
                        <a class="btn blue-btn text-decoration-none rounded-0" href="#">Apply now</a>
                    </div>
                </div>
            </div>
        </div>
     </div>

    <!-- footer -->
    <?php include("utility/footer.php");?>
</body>
</html>