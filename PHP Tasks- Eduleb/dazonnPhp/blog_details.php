<?php
    include("db_connect.php");
    if(isset($_GET['s_no'])){
        $s_no = mysqli_real_escape_string($conn, $_GET['s_no']);
        $b_sql = "SELECT * FROM blogs WHERE s_no = '$s_no'";
        
        $b_result = mysqli_query($conn, $b_sql);
        $blog_detail = mysqli_fetch_assoc($b_result);
        // print_r($blog_detail);
        mysqli_free_result($b_result);
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./utility/header.php");?>
</head>
<body>
    <?php include("./utility/navbars/selectNavbar.php");?>

    <div class="blog-details">
        <div class="container text-center mt-4">
            <?php if($blog_detail):?>
            <h4 class="h2">
                <?php echo $blog_detail['title'];?>
            </h4>
            <p class="text-secondary">
                <span class="text-dark">Created at:</span> 
                <?php  echo $blog_detail['created_at'];?>
            </p>
            <p class="text-secondary">
                <span class="text-dark">Category:</span> 
                <?php echo $blog_detail['category'];?>
            </p>
            <h6 class="h5 fw-semibold">Discription:-</h6>
            <p class="text-dark text-justified">
                <?php echo $blog_detail['short_discription'];?>
                <?php echo $blog_detail['full_discription'];?>
            </p>

        </div>
        <?php else:?>
             <h4 class="h4">
                No such blog exixts
            </h4>
        <?php endif;?>
    </div>
</body>
</html>