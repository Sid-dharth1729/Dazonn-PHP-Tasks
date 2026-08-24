 <nav class="navbar border p-0">
    <!-- left nav -->
    <ul class="navbar-nav flex-row align-items-center">
        <li class="nav-item d-block d-lg-none">
            <button class="btn p-1 border me-2">
                <img src="../images/hamburger.svg" alt="" width="30px">
            </button>
        </li>
        <li class="nav-item">
            <a href="./doctor.php" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- right nav item -->
    <ul class="navbar-nav flex-row align-items-center gap-2 pe-2">
        <li class="nav-item d-flex ">
            <span class="fw-semibold m-0 text-capitalize"><?php echo $username;?></span>
        </li>
        <li class="nav-item">
            <a href="../utility/logout.php" class="btn btn-danger btn-sm p-1">
                Logout
            </a>
        </li>
    </ul>
</nav>