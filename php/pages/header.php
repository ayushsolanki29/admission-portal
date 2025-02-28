<div id="preloader">
    <div class="preloader">
        <span></span>
        <span></span>
    </div>
</div>

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
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-xl-3 col-lg-2 col-7">
                    <div class="right-nav d-flex align-items-center justify-content-end">
                        <div class="right-btn mr-25 mr-xs-15">
                            <ul class="d-flex align-items-center">
                                <li><a href="register.php" class="theme_btn free_btn">Register Now</a></li>
                                <li><a class="sign-in ml-20" href="login.php"><img src="assets/img/icon/user.svg" alt=""></a></li>
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
            <a href="index.html">
                <img src="assets/img/logo/header_logo_one.svg" alt="logo">
            </a>
        </div>
        <div class="offset-widget mb-40">
            <div class="info-widget">
                <h4 class="offset-title mb-20">About Us</h4>
                <p class="mb-30">
                    But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                    was born and will give you a complete account of the system and expound the actual teachings of
                    the great explore
                </p>
                <a class="theme_btn theme_btn_bg" href="contact.html">Contact Us</a>
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
                    <li><a href="index.html">Home Style 1</a></li>
                    <li><a href="index-2.html">Home Style 2</a></li>
                    <li><a href="index-3.html">Home Style 3</a></li>
                </ul>
            </li>

            <li><a href="contact.php">Contacts Us</a></li>
        </ul>
    </nav>
    <!-- side-mobile-menu end -->
</aside>
<div class="body-overlay"></div>
<!-- slide-bar end -->