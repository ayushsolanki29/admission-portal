<?php include 'php/utils/db.php'; ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <link rel="stylesheet" href="assets\css\college.css">

</head>

<body>


    <?php include 'php/pages/header.php' ?>

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
                <li class="has-dropdown">
                    <a href="index.html">Home</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Home Style 1</a></li>
                        <li><a href="index-2.html">Home Style 2</a></li>
                        <li><a href="index-3.html">Home Style 3</a></li>
                    </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li class="has-dropdown">
                    <a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="courses.html">Course One</a></li>
                        <li><a href="courses-2.html">Course Two</a></li>
                        <li><a href="course-details.html">Courses Details</a></li>
                        <li><a href="price.html">Price</a></li>
                        <li><a href="instructor.html">Instructor</a></li>
                        <li><a href="instructor-profile.html">Instructor Profile</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="login.html">login</a></li>
                    </ul>
                </li>
                <li class="has-dropdown"><a href="#">Blogs</a>
                    <ul class="sub-menu">
                        <li><a href="blog.html">Blog Grid</a></li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contacts Us</a></li>
            </ul>
        </nav>
        <!-- side-mobile-menu end -->
    </aside>
    <div class="body-overlay"></div>
    <!-- slide-bar end -->

    <main class="card-container gradient-bg  d-sm-auto container-fluid">


        <div class="search-flex">
            <div class="search-container1">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-box" placeholder="Search colleges...">
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <?php $select_colleges =  mysqli_query($con, "SELECT * FROM `colleges`");
                while ($row = mysqli_fetch_array($select_colleges)) {
                ?>
                    <div class="col-md-4 ">
                        <div class="card">
                            <img src="assets\img\college\<?= $row['college_logo']?>" class="card-img-top p-0 m-0" alt="College Image">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['college_name']?></h5>
                                <!-- <p class="card-text text-danger fw-bold">&#8377; 100,800</p> -->
                                <ul class="icon-list">
                                    <li><i class="fas fa-university"></i> ACPC</li>
                                    <li><i class="fas fa-user-check"></i> Direct Admission</li>
                                    <li><i class="fas fa-graduation-cap"></i> BE / B.Tech - Bachelor of Engineering / Technology</li>
                                    <li><i class="fas fa-building"></i> Private (Self Finance) Institute</li>
                                    <li><i class="fas fa-school"></i> Indus University</li>
                                    <li><i class="fas fa-briefcase"></i> 15 LPA</li>
                                </ul>
                                <div class="explore-btn" onclick="window.location.href='college-details.php?u=<?=$row['tag_id']?>'">
                                    <button>Explore More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php     }
                ?>
            </div>
        </div>


    </main>

    <?php include 'php/pages/footer.php' ?>
    <script>
        $(document).ready(function() {
            $(".search-icon").click(function() {
                $(".search-container1").toggleClass("expanded");
                $(".search-box").focus();
            });

            $(".search-box").focus(function() {
                $(".search-container1").addClass("expanded");
            });



            $(document).click(function(e) {
                if (!$(e.target).closest(".search-container1").length) {
                    $(".search-container1").removeClass("expanded");

                }
            });
        });
    </script>
</body>

</html>