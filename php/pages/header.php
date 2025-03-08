<div id="preloader">
    <div class="spinner"></div>
</div>
<?php
if (isset($_COOKIE['rememberme'])) {
    $rememberme_token = mysqli_real_escape_string($con, $_COOKIE['rememberme']);
    $rememberme_tokens_query = "SELECT * FROM `rememberme_tokens` WHERE `token` = '$rememberme_token' AND `expiration` > NOW()";
    $rememberme_tokens_result = mysqli_query($con, $rememberme_tokens_query);

    if ($rememberme_tokens_result && mysqli_num_rows($rememberme_tokens_result) === 1) {
        $rememberme_tokens_row = mysqli_fetch_assoc($rememberme_tokens_result);
        $_SESSION['Auth'] = $rememberme_tokens_row['user_id'];
    } else {
        echo "<script>alert('Login Session is ended Please Login Again')</script>";
        setcookie("rememberme", "", time() - 3600, "/");

        echo "<script>window.location.href = 'logout.php';</script>";
    }
}
if (isset($_SESSION['Auth'])) {
    $user = getUserData($_SESSION['Auth']);
}
?>
<header>
    <div id="theme-menu-two" class="main-header-area  <?php if (basename($_SERVER['PHP_SELF']) != 'index.php') echo 'main-head-three'; ?> pl-100 pr-100 pt-20 pb-15">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2 col-5">
                    <div class="logo"><a href="index.php"><img src="assets/img/logo/header_logo_one.png" alt=""></a></div>
                </div>
                <div class="col-xl-7 col-lg-8 d-none d-lg-block">
                    <nav class="main-menu navbar navbar-expand-lg justify-content-center">
                        <div class="nav-container">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">

                                    <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">
                                        <a class="nav-link" href="index.php">
                                            Home
                                        </a>
                                    </li>

                                    <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'colleges.php' || basename($_SERVER['PHP_SELF']) == 'colleges.php') echo 'active'; ?> ">
                                        <a class="nav-link" href="colleges.php">
                                            Colleges
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'about.php' || basename($_SERVER['PHP_SELF']) == 'about.php') echo 'active'; ?> ">
                                        <a class="nav-link" href="about.php">
                                            About
                                        </a>
                                    </li>
                                    <li class="nav-item  <?php if (basename($_SERVER['PHP_SELF']) == 'courses.php' || basename($_SERVER['PHP_SELF']) == 'courses.php') echo 'active'; ?>">
                                        <a class="nav-link" href="courses.php">
                                            Cources
                                        </a>
                                    </li>



                                    <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'contact.php' || basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'active'; ?>">
                                        <a class="nav-link" href="contact.php" id="navbarDropdown5" role="button" aria-expanded="false">Contact</a>
                                    </li>
                                    <?php
                                    if (isset($_SESSION['Auth'])) { ?>
                                        <li class="nav-item  <?php if (basename($_SERVER['PHP_SELF']) == 'profile.php' || basename($_SERVER['PHP_SELF']) == 'profile.php') echo 'active'; ?>">
                                            <a class="nav-link" href="profile.php">
                                                Profile
                                            </a>
                                        </li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-xl-3 col-lg-2 col-7">
                    <div class="right-nav d-flex align-items-center justify-content-end">
                        <div class="right-btn mr-25 mr-xs-15">
                            <ul class="d-flex align-items-center">
                                <?php
                                if (isset($_SESSION['Auth'])) { ?>
                                    <li><a href="logout.php" class="theme_btn free_btn">Logout</a></li>

                                <?php } else { ?>
                                    <li><a href="register.php" class="theme_btn free_btn">Register Now</a></li>

                                <?php } ?>
                                <?php
                                if (isset($_SESSION['Auth'])) { ?>
                                    <li><a class="sign-in ml-20" href="profile.php"><img src="assets/img/profile/default.png" width="40px" height="40px" alt=""></a></li>

                                <?php } ?>
                            </ul>
                        </div>

                        <div class="hamburger-menu d-md-inline-block d-lg-none text-right">
                            <a href="javascript:void(0);">
                                <i class="far fa-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.theme-main-menu -->
</header>

<!-- slide-bar start -->
<aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
    </div>

    <!-- offset-sidebar start -->
    <div class="offset-sidebar">
        <div class="offset-widget offset-logo mb-30">
            <a href="index.php">
                <img src="assets/img/logo/header_logo_one.png" alt="logo" width="250px">
            </a>
        </div>
        <div class="offset-widget mb-40">
            <div class="info-widget">
                <h4 class="offset-title mb-20">About Us</h4>
                <p class="mb-30">
                    We are your trusted guide for securing admissions in your dream colleges. At <strong>CollegeNew.com</strong>, we help students find the best courses and colleges, providing expert guidance throughout the admission process.

                </p>
                <a class="theme_btn theme_btn_bg" href="contact.php">Contact Us</a>
            </div>
        </div>
        <div class="offset-widget mb-30 pr-10">
            <div class="info-widget info-widget2">
                <h4 class="offset-title mb-20">Contact Info</h4>
                <p> <i class="fal fa-address-book"></i> 23/A, Miranda City Likaoli Prikano, Dope</p>
                <p> <i class="fal fa-phone"></i> +0989 7876 9865 9 </p>
                <p> <i class="fal fa-envelope-open"></i> info@example.com </p>
            </div>
        </div>
    </div>
    <!-- offset-sidebar end -->

    <!-- side-mobile-menu start -->
    <nav class="side-mobile-menu">
        <ul id="mobile-menu-active">
            <li><a href="index.php">Home</a></li>

            <li class="has-dropdown">
                <a href="index.html">Colleges</a>
                <ul class="sub-menu">
                    <?php
                    // Securely fetch all colleges using prepared statements
                    $college_stmt = $con->prepare("SELECT `college_name`, `tag_id` FROM colleges ORDER BY `college_name` ASC");
                    $college_stmt->execute();
                    $college_result = $college_stmt->get_result();

                    if ($college_result->num_rows > 0) {
                        while ($college_res = $college_result->fetch_assoc()) {
                            $college_name = htmlspecialchars($college_res['college_name'], ENT_QUOTES, 'UTF-8');

                            $tag_id = urlencode($college_res['tag_id']); // Ensures URL safety
                    ?>
                            <li><a href="college-details.php?u=<?php echo $tag_id; ?>"><?php echo $college_name; ?></a></li>
                    <?php }
                        $college_stmt->close();
                    } ?>
                </ul>
            </li>

            <li><a href="courses.php">Courses</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="contact.php">Contacts Us</a></li>
            <?php
            if (isset($_SESSION['Auth'])) { ?>
                <li class="has-dropdown">
                    <a href="index.html"><?= $user['username'] ?></a>
                    <ul class="sub-menu">

                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>

                    </ul>
                </li>
            <?php }else{ ?>
                        <li><a href="register.php">Register</a></li>
            <?php }
            ?>
        </ul>
    </nav>
    <!-- side-mobile-menu end -->
</aside>
<div class="body-overlay"></div>
<!-- slide-bar end -->