<?php
    session_start();
    if(empty($_SESSION['admin-name'])){
        header("location:admin_login.php");
    }
    include("../db_connect.php");

    // geting all blogs
    $blogs_sql = "SELECT * FROM blogs ORDER BY s_no";
    $result = mysqli_query($conn, $blogs_sql);

    $all_blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    mysqli_free_result($result);
    
    // Delete blog
    if(isset($_POST['delete_blog'])){
        $blog_s_no = $_POST['delete_blog_s_no'];
        // echo $blog_s_no;
        $del_sql = "DELETE FROM blogs WHERE s_no = $blog_s_no";
        
        if(mysqli_query($conn, $del_sql)){
            //reseting s_no.
            mysqli_query($conn, "SET @count =0");
            $set_sn_sql = "UPDATE blogs SET s_no = @count := @count+ 1
                            ORDER BY s_no";
            mysqli_query($conn, $set_sn_sql);
            //auto increment from 1
            mysqli_query($conn, "ALTER TABLE blogs AUTO_INCREMENT = 1");

            header("location:admin_panel.php");
            mysqli_close($conn);
            exit();
        }
    }
    // else{
    //     echo "errors..";
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("../utility/header.php");?>
<body>
    <div class="admin-cont container-fluid">
        <div class="row">
            <?php include("./admin_utility/sidebar.php");?>

            <main class="col-lg-9 col-12 p-0">
                <!-- admin nav -->
                <?php include("./admin_utility/admin_nav.php");?>
                <div class="container py-2">
                    <h1 class="h1 text-center">All Blogs</h1>

                    <table class="table table-bordered text-center">
                        <tr class="table-dark">
                            <th>S.no</th>
                            <th>Title</th>
                            <th>Short Discription</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($all_blogs as $blog):?>
                            <tr>
                                <td class="border-3">
                                    <?php echo $blog['s_no'];?>
                                </td>
                                <td class="border-3">
                                    <?php echo $blog['title'];?>
                                </td>
                                <td  class="border-3">
                                    <?php echo $blog['short_discription'];?>
                                </td>
                                <td  class="border-3">
                                    <?php echo $blog['category'];?>
                                </td>
                                <td class="border-3">
                                    <?php echo $blog['created_at'];?>
                                </td>
                                <td class="border-3">
                                    <div class="d-lg-flex d-block">
                                        <a href="add_blog.php?s_no=<?php echo $blog['s_no'];?>" class="btn btn-primary m-1">Edit</a>
                                        
                                        <!-- delete blog -->
                                         <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                                            <input type="hidden" name="delete_blog_s_no" value="<?php echo $blog['s_no'];?>">
                                            <input type="submit" name="delete_blog" class="btn btn-danger m-1" value="Delete">
                                         </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- script for hide show sidebar -->
    <script src="./admin_utility/sidebar.js"></script>
</body>
</html>