<aside class="col-lg-3 col-12 min-vh-100 bg-dark p-0 sidebar d-lg-block d-none">
    <!-- hide btn for tablet and mobile -->
    <div class="close text-end p-2 d-lg-none d-md-block">
        <button onclick="hideSidebar()" class="btn btn-primary">X</button>
    </div>
    <div class="sidebar p-3">
        <div class="admin-dis text-center text-light border-bottom">
            <img src="./admin_utility/admin-profile.jpg" class="rounded-circle objrct-fit-cover" width="80px;" alt="">
            <h5 class="h5 text-capitalize">
                <?php echo $_SESSION['admin-name'];?>
            </h5>
            
        </div>
        <ul class="nav flex-column" >
            <li class="nav-item mb-2"><a href="./admin_panel.php" class="nav-link fs-5 text-light">All Blogs</a></li>
            <li class="nav-item mb-2"><a href="add_blog.php" class="nav-link fs-5 text-light">Add Blog</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link fs-5 text-light">Other</a></li>
        </ul>
    </div>
</aside>