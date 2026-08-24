  <?php
    // session_start() if not active because in profile_update the session is there;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_SESSION['username'])){
        $user_name ='Guest';
    }else{
        $user_name = $_SESSION['username'];
    }
    $imgFolder = './profile-img/';
    if(empty($_SESSION['userImg'])){
        $userImg = $imgFolder . "guest.jpg";
    }
    else{
        $userImg = $imgFolder . $_SESSION['userImg'];  
    }
  ?>
  
  <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid nav-cont" >
            <div class="navbar-brand">
                <a href="home.php" class="text-decoration-nonr">
                        <img src="images/logo.jpg" alt="">
                </a>
            </div>
            <!-- <a href="home.php" class="text-decoration-none"> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <!-- </a> -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a href="home.php" class="nav-link text-dark fw-semibold text-uppercase">
                        Home</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link text-dark fw-semibold text-uppercase">
                        About</a></li>
                    <li class="nav-item"><a href="courses.php" class="nav-link text-dark fw-semibold text-uppercase">
                        Courses</a></li>
                    <li class="nav-item"><a href="blog.php" class="nav-link text-dark fw-semibold text-uppercase">
                        Blog</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link text-dark fw-semibold text-uppercase">
                        Contact</a></li>
                </ul>
                <div class="d-lg-flex  gap-2 align-items-center">
                <!-- User Image  -->
                        <div class="nav-profile text-center">
                            <a href="profile_update.php" class="text-decoration-none">
                                <img src="<?php echo $userImg;?>" class="rounded-circle object-fit-cover" 
                                style="width: 40px; height: 40px;" alt="">
                            </a>

                            <p style="font-size: 0.8rem" class="text-sencondary m-0">
                                <?php echo $user_name;?></p>
                        </div>
                        <a href="logout.php" class="btn btn-primary rounded-0 mx-2 s-up-btn">
                            Logout
                        </a>
                </div>
            </div>
        </div>
    </nav>