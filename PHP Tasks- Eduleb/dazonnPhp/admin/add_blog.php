<?php
    session_start();
    if(empty($_SESSION['admin-name'])){
        header("location:admin_login.php");
    }
    include("../db_connect.php");

    // Add blog (if get has no s_no)
    $blog_errors = array('title'=> '', 'short-dis'=>'','category'=>'','blog_img'=>'','created_at'=>'','full-dis'=>'');
    if(!isset($_GET['s_no'])){
        $disabled = '';
        //add blog
        $title ='';
        $short_dis ='';
        $category ='';
        $created_at ='';
        $full_dis ='';
        //image
        $blog_img_src ='';
        $blog_img_folder ="../images_blog/";
        if(isset($_POST['add_btn'])){
            //input validation
        if(empty($_POST['title'])){
                $blog_errors['title'] ="Title can'be empty";
        }
        else{
            $title = $_POST['title'];
        }
        if(empty($_POST['short-dis'])){
                $blog_errors['short-dis'] ="Short discription can'be empty";
        }
        else{
            $short_dis = $_POST['short-dis'];
        }
        if(empty($_POST['category'])){
                $blog_errors['category'] ="Category is empty";
        }
        else{
                $category = $_POST['category'];
        }
        if(empty($_POST['created_at'])){
                $blog_errors['created_at'] ="Created date is empty";
        }
        else{
                $created_at = $_POST['created_at'];
        }
        if(empty($_POST['full-dis'])){
                $blog_errors['full-dis'] ="Full discription is empty";
        }
        else{
                $full_dis = $_POST['full-dis'];
        }
        //images
        if(!empty($_FILES['blog_img']['name'])){
                $file_name = $_FILES['blog_img']['name'];
                $file_name_array = explode('.', $file_name);
                $extention = end($file_name_array);

                if($extention != 'jpg' && $extention != 'png' && $extention != 'jpeg' &&
                $extention != 'JPG' && $extention != 'PNG' && $extention != 'JPEG'){
                    $blog_errors['blog_img'] = "Only jpg, png and jpeg files are allowed";
                }
                else{
                    $blog_img_src = $file_name;
                    $full_src = $blog_img_folder . $blog_img_src;
                    // for allocation space file to folder
                    move_uploaded_file($_FILES['blog_img']['tmp_name'], $full_src);
                }
        }
        else{
                //default image src
                $blog_img_src = "default_img.jpg";
        }
        if(!array_filter($blog_errors)){
                $title = mysqli_real_escape_string($conn, $title);
                $short_dis = mysqli_real_escape_string($conn, $short_dis);
                $category = mysqli_real_escape_string($conn, $category);
                $created_at = mysqli_real_escape_string($conn, $created_at);
                $full_dis = mysqli_real_escape_string($conn, $full_dis);
                //sql
                $add_sql = "INSERT INTO blogs(title, short_discription, blog_image, category, created_at, full_discription) 
                VALUES ('$title', '$short_dis', '$blog_img_src', '$category', '$created_at', '$full_dis')";
                
                if(mysqli_query($conn, $add_sql)){
                    // echo "Blog inserted";
                    header("location:admin_panel.php");
                    exit();
                }
        }
    
        }
    }

    // Edit blog (if get has s_no)
    else{
        $disabled = 'disabled';

        $s_no = mysqli_real_escape_string($conn ,$_GET['s_no']);
        $get_sql = "SELECT * FROM blogs WHERE s_no = $s_no";
        $q_result = mysqli_query($conn, $get_sql);
        $ed_blog = mysqli_fetch_assoc($q_result);
        // print_r($ed_blog);
        $title = $ed_blog['title'];
        $short_dis = $ed_blog['short_discription'];
        $category = $ed_blog['category'];
        $full_dis = $ed_blog['full_discription'];
        $created_at = $ed_blog['created_at'];
        $blog_img_src = $ed_blog['blog_image'];

        if(isset($_POST['add_btn'])){
            if(empty($_POST['short-dis'])){
                $blog_errors['short-dis'] = "Short Discription can't be empty";
            }else{
                $short_dis = mysqli_real_escape_string($conn, $_POST['short-dis']);
            }
            if(empty($_POST['full-dis'])){
                $blog_errors['full-dis'] = "Full Discription can't be empty";
            }else{
                $full_dis = mysqli_real_escape_string($conn, $_POST['full-dis']);
            }
            if(empty($_POST['category'])){
                $blog_errors['category'] = "Category can't be empty";
            }else{
                $category = mysqli_real_escape_string($conn, $_POST['category']);
            }
            //images
            if(!empty($_FILES['blog_img']['name'])){
                    $blog_img_folder ="../images_blog/";

                    $u_file_name = $_FILES['blog_img']['name'];
                    $u_file_name_array = explode('.', $u_file_name);
                    $extention = end($u_file_name_array);

                    if($extention != 'jpg' && $extention != 'png' && $extention != 'jpeg' &&
                    $extention != 'JPG' && $extention != 'PNG' && $extention != 'JPEG'){
                        $blog_errors['blog_img'] = "Only jpg, png and jpeg files are allowed";
                    }
                    else{
                        $blog_img_src = $u_file_name;
                        $u_full_src = $blog_img_folder . $blog_img_src;
                        // for allocation space file to folder
                        move_uploaded_file($_FILES['blog_img']['tmp_name'], $u_full_src);
                    }
            }
            // else{
            //         //default image src
            //         $blog_img_src = "default_img.jpg";
            // }
            // Update sql
            $u_sql = "UPDATE blogs SET 
            short_discription ='$short_dis',category = '$category', full_discription = '$full_dis', blog_image ='$blog_img_src'
            WHERE s_no ='$s_no'";
            if(mysqli_query($conn, $u_sql)){
                header("Location:admin_panel.php");
                exit();
            }
            else{
                echo "Query Error". mysqli_error($conn);
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("../utility/header.php");?>
</head>
<body>
    <div class="add-blog-cont container-fluid" style="background-color: #f4f4ff;">
        <div class="row">
            <!-- sidebar -->
            <?php include("./admin_utility/sidebar.php");?>
            
            <main class="col-lg-9 col-12 p-0">
                <!-- admin nav -->
                <?php include("./admin_utility/admin_nav.php");?>

                <!-- ADD Blog  -->
                <div class="container p-3"> 
                    <h1 class="h1 text-center">
                        <?php if(isset($_GET['s_no'])):?>
                                Edit Blog
                        <?php else:?>
                                Add Blog
                        <?php endif;?>
                        </h1>
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <div class="py-2">
                            <!-- <label for="title" class="form-label">Enter title</label> -->
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title of blog"
                            value="<?php echo $title;?>" <?php echo  $disabled?>>
                            <p class="text-danger fw-semibold m-0">
                                <?php echo $blog_errors['title'];?>
                            </p>
                        </div>
                        <div class="py-2">
                            <input type="text" name="short-dis" class="form-control" id="short-dis" 
                            placeholder="Write a short-discription about blog" value="<?php echo $short_dis;?>">
                            <p class="text-danger fw-semibold m-0">
                                <?php echo $blog_errors['short-dis'];?>
                            </p>
                        </div>
                        <div class="py-2">
                            <input type="text" name="category" class="form-control" id="category" 
                            placeholder="Enter category of blog" value="<?php echo $category;?>">
                            <p class="text-danger fw-semibold m-0">
                                <?php echo $blog_errors['category'];?>
                            </p>
                        </div>
                        <!-- Images -->
                        <div class="py-2">
                            <label for="blog_img">Upload blog image</label>
                            <input type="file" name="blog_img" class="form-control" id="blog_img" accept="image/*">
                            <p class="text-danger fw-semibold m-0">
                                <?php echo $blog_errors['blog_img'];?>
                            </p>
                        </div>
                        <div class="py-2">
                            <input type="date" name="created_at" class="form-control" id="created_at" 
                            placeholder="Enter created date of blog" value="<?php echo $created_at;?>" <?php echo  $disabled?>>
                            <p class="text-danger fw-semibold m-0">
                                <?php echo $blog_errors['created_at'];?>
                            </p>
                        </div>
                        <div class="py-2">
                            <textarea style="height: 80px" name="full-dis" class="form-control" 
                            placeholder="Write full-discription of blog"><?php echo $full_dis;?></textarea>
                            <p class="text-danger fw-semibold m-0">
                                <?php echo $blog_errors['full-dis'];?>
                            </p>
                        </div>
                        <div class="py-2 w-100 text-center">
                            <input type="submit" name="add_btn" id="add_btn" class="btn btn-primary" 
                            value="<?php if(!isset($_GET['s_no'])):?>Add Blog<?php else:?> Edit Blog <?php endif;?>">
                        </div>
                    </form>
                </div>

                <!-- edit Blog  -->
               
            </main>
        </div>
    </div>

    <!-- script for hide show sidebar -->
    <script src="./admin_utility/sidebar.js"></script>
</body>
</html>