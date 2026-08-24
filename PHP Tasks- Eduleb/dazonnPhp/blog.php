<?php
    include("db_connect.php");

    //for blogs
    $blog_sql = "SELECT * FROM blogs ORDER BY s_no";
    $q_result = mysqli_query($conn, $blog_sql);

    $blogs = mysqli_fetch_all($q_result, MYSQLI_ASSOC);
    // print_r($blogs);
    mysqli_free_result($q_result);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("utility/header.php");?>
<body>
        <!-- navbar -->
    <?php include("utility/navbars/selectNavbar.php");?>


    <!-- Blog sec -->
    <div class="container-fluid about-top">
        <div class="container about-top-cont ">
            <h1 class="h1 text-center fs-large fw-bold">Blog</h1>
            <div class="btm-link d-flex justify-content-center">
                <a href="home.php" class="text-decoration-none">Home</a>
                <p> / Blog</p>
            </div>
        </div>
    </div>

    <!-- Blog cards -->
     <div class="blog-cont">
        <div class="container sec-cont">
            <div class="row">
                <!-- <div class="col-lg-4 col-sm-12 col-md-6 my-3">
                    <div class="card">
                        <img class="card-img rounded-0 img-fluid" src="https://themewagon.github.io/eduleb/assets/img/blog/1.jpg" alt="">
                        <div class="card-body blog-card-body">
                            <p class="p-txt">May 10, 2024 | 
                                <a href="#" class="text-decoration-none fw-semibold">Education</a>
                            </p>
                            <a href="#" class="h5 text-decoration-none fw-semibold d-block pb-3">Professional Mobile Painting and Sculpting</a>
                            <a href="#" class="btn blue-btn rounded-0 text-decoration-none m-1">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-md-6 my-3">
                    <div class="card">
                        <img class="card-img rounded-0 img-fluid" src="https://themewagon.github.io/eduleb/assets/img/blog/5.jpg" alt="">
                        <div class="card-body blog-card-body">
                            <p class="p-txt">May 16, 2024 | 
                                <a href="#" class="text-decoration-none fw-semibold">Education</a>
                            </p>
                            <a href="#" class="h5 text-decoration-none fw-semibold d-block pb-3">Professional Ceramic Moulding for Beginner</a>
                            <a href="#" class="btn blue-btn rounded-0 text-decoration-none m-1">Read More</a>
                        </div>
                    </div>
                </div> -->

                <?php foreach($blogs as $blog):?>
                    <div class="col-lg-4 col-sm-12 col-md-6 my-3">
                        <div class="card  h-100">
                            <img style="height:300px;" class="card-img rounded-0 object-fit-cover" 
                                src="<?php echo "images_blog/". $blog['blog_image'];?>" alt="">
                            <div class="card-body blog-card-body">
                                <p class="text-secondary mb-1"><?php echo $blog['created_at'];?> | 
                                    <a href="blog_details.php?s_no=<?php echo $blog['s_no'];?>" class="text-decoration-none fw-semibold">
                                        <?php echo $blog['category'];?>
                                    </a>
                                </p>
                                
                                <a href="blog_details.php?s_no=<?php echo $blog['s_no'];?>" class="b-title h5 text-decoration-none fw-semibold d-block">
                                    <?php echo $blog['title'];?>
                                </a>
                                <p class="text-secondary">
                                    <?php echo $blog['short_discription'];?>
                                </p>
                                <a href="blog_details.php?s_no=<?php echo $blog['s_no'];?>" class="btn blue-btn rounded-0 text-decoration-none py-2 px-3">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
     </div>
    <!-- footer -->
    <?php include("utility/footer.php");?>
</body>
</html>