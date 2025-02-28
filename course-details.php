<?php include 'php/utils/db.php';
// if (isset($_GET['u'])) {
//     $tagId = $_GET['u'];
//     $stmt = $con->prepare("SELECT * FROM colleges WHERE tag_id = ?");
//     $stmt->bind_param("s", $tagId);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $college = $result->fetch_assoc();
//     $stmt->close();
// } else {
//     header("Location:404.php");
// }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <title>
       
    </title>
</head>

<body>


    <?php include 'php/pages/header.php' ?>
    <main>
        <!--page-title-area start-->
        <section class="page-title-area d-flex align-items-end" style="background-image: url(assets/img/page-title-bg/01.jpg);">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-12">
                        <div class="page-title-wrapper mb-50">
                            <h1 class="page-title mb-25">Courses Details</h1>
                            <div class="breadcrumb-list">
                                <ul class="breadcrumb">
                                    <li><a href="index.html">Home - Pages -</a></li>
                                    <li><a href="#">Courses Details</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page-title-area end-->
        <!--course-details-area start-->
        <section class="course-details-area pt-150 pb-120 pt-md-100 pb-md-70 pt-xs-100 pb-xs-70">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 col-xl-7">
                        <div class="courses-details-wrapper mb-30">
                            <h2 class="courses-title mb-30">Fundamentals Of Dslr Photography</h2>
                            <h5>Photography Specialist By Jason Momoa</h5>
                            <div class="course-details-img mb-30" style="background-image: url(assets/img/course/details/01.jpg);">
                                <div class="video-wrapper">
                                    <a href="https://www.youtube.com/watch?v=7omGYwdcS04" class="popup-video"><i class="fas fa-play"></i></a>
                                </div>
                            </div>
                            <div class="courses-tag-btn">
                                <a href="#">Add to wishlist</a>
                                <a href="#">Share</a>
                                <a href="#">Gift this course</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5">
                        <div class="learn-area mb-30">
                            <ul class="cart-list-tag d-sm-inline-flex align-items-center mb-50">
                                <li>
                                    <div class="price-list">
                                        <h5><span>$123.65</span> <b class="sub-title">$93.65</b></h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="cart-btn">
                                        <a class="theme_btn" href="#">Add To Cart</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="video-wrapper courses-cart-video">
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04" class="popup-video"><i class="fas fa-play"></i></a>
                                    </div>
                                </li>
                            </ul>
                            <div class="learn-box">
                                <h5>25 Lessons ( 3h 36m )</h5>
                                <ul class="learn-list">
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><img src="assets/img/icon/video-player.svg" alt="course-list"></span> 01. Intro Video <span class="time float-end">4:02</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 02. How to Open Camera <span class="time float-end">2:03</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 03. Balancing the Exposure <span class="time float-end">5:03</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 04. Preparing to Shoot <span class="time float-end">5:12</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 05. Studio Demonstration <span class="time float-end">6:12</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 06. Shutter Speed <span class="time float-end">7:00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 07. Aperture <span class="time float-end">6:05</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 08. ISO <span class="time float-end">30:00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 09. Editing Tips & Tricks <span class="time float-end">20:03</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 10. Advance Photography <span class="time float-end">40:36</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 10. Advance Photography-2 <span class="time float-end">40:36</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 10. Advance Photography-3 <span class="time float-end">40:36</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04">
                                            <span class="play-video"><i class="fal fa-lock-alt"></i></span> 10. Advance Photography-4 <span class="time float-end">40:36</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <div class="project-details mb-65">
                            <h2 class="courses-title mb-30">Photography Learning A-Z</h2>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.</p>
                            <ul class="seller-rating d-md-inline-flex align-items-center mt-20 mb-10">
                                <li>
                                    <a href="#" class="theme_btn mb-10">Bestseller</a>
                                </li>
                                <li>
                                    <div class="star-icon mb-10">
                                        <a href="#"><i class="fas fa-star"></i></a>
                                        <a href="#"><i class="fas fa-star"></i></a>
                                        <a href="#"><i class="fas fa-star"></i></a>
                                        <a href="#"><i class="fas fa-star"></i></a>
                                        <a href="#"><i class="fas fa-star"></i></a>
                                        <a href="#">4.8 ( 256,384)</a>
                                    </div>
                                </li>
                                <li>
                                    <h5 class="mb-10">Enroll 360,349</h5>
                                </li>
                            </ul>
                            <h5 class="mb-25"><span>Created by</span> Jason Momoa & Uxaction Photography team</h5>
                            <div class="date-lang">
                                <span><b>Date :</b> 31/05/2020</span>
                                <span><b>Language :</b> English</span>
                            </div>
                        </div>
                        <div class="meet-our-teacher mb-65">
                            <h2 class="courses-title mb-30">Meet Your Teacher</h2>
                            <div class="teachers-content mb-25">
                                <img class="teacher_01" src="assets/img/course/details/teacher.png" alt="">
                                <div class="teachers-content__text">
                                    <h5>Jason Momoa</h5>
                                    <p>Photography Specialist</p>
                                </div>
                            </div>
                            <p class="mb-20">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.</p>
                            <p class="mb-20">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.Lorem ipsum dolor.</p>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy.</p>
                        </div>
                        <div class="skill-area">
                            <h2 class="courses-title mb-35">Related Skills</h2>
                            <div class="courses-tag-btn">
                                <a href="#">Photography</a>
                                <a href="#">Outdoor</a>
                                <a href="#">Indoor Photography</a>
                                <a href="#">DSLR</a>
                                <a href="#">Creative</a>
                                <a href="#">Camera</a>
                                <a href="#">Professional</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <div class="courses-ingredients">
                            <h2 class="corses-title mb-30">Course Includes</h2>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore.</p>
                            <ul class="courses-item mt-25">
                                <li><img src="assets/img/icon/video.svg" alt=""> 4 hours on-demand video</li>
                                <li><img src="assets/img/icon/newspaper.svg" alt=""> 73 articles</li>
                                <li><img src="assets/img/icon/download.svg" alt=""> 650+ downloadable resources</li>
                                <li><img src="assets/img/icon/infinity.svg" alt=""> Full Lifetime Access</li>
                                <li><img src="assets/img/icon/mobile.svg" alt=""> Access on mobile and TV or any devices</li>
                                <li><img src="assets/img/icon/certificate-line.svg" alt=""> Certificate of completion</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--course-details-area end-->
        <!-- feature-course start -->
        <section class="feature-course pb-130 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
            <div class="container">
                <h2 class="courses-title mb-35">Recent Courses</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="z-gallery mb-30">
                            <div class="z-gallery__thumb mb-20">
                                <a href="course-details.html"><img class="img-fluid" src="assets/img/course/01.png" alt=""></a>
                                <div class="feedback-tag">4.8(256)</div>
                                <div class="heart-icon"><i class="fas fa-heart"></i></div>
                            </div>
                            <div class="z-gallery__content">
                                <div class="course__tag mb-15">
                                    <span>Science</span>
                                    <span>Lab</span>
                                    <a class="f-right" href="instructor-details.html"><img src="assets/img/course/in1.png" alt=""></a>
                                </div>
                                <h4 class="sub-title mb-20"><a href="course-details.html">Take Your Career to the Next Level Future</a></h4>
                                <div class="course__meta">
                                    <span><img class="icon" src="assets/img/icon/time.svg" alt="course-meta"> 12 Class</span>
                                    <span><img class="icon" src="assets/img/icon/bar-chart.svg" alt="course-meta"> Higher</span>
                                    <span><img class="icon" src="assets/img/icon/user.svg" alt="course-meta"> 6395+</span>
                                    <span>$260</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="z-gallery mb-30">
                            <div class="z-gallery__thumb mb-20">
                                <a href="course-details.html"><img class="img-fluid" src="assets/img/course/02.png" alt=""></a>
                                <div class="feedback-tag">4.8(256)</div>
                                <div class="heart-icon"><i class="fas fa-heart"></i></div>
                            </div>
                            <div class="z-gallery__content">
                                <div class="course__tag mb-15">
                                    <span>Science</span>
                                    <span>Lab</span>
                                    <a class="f-right" href="instructor-details.html"><img src="assets/img/course/in2.png" alt=""></a>
                                </div>
                                <h4 class="sub-title mb-20"><a href="course-details.html">Your Career to build for the pro level</a></h4>
                                <div class="course__meta">
                                    <span><img class="icon" src="assets/img/icon/time.svg" alt="course-meta"> 12 Class</span>
                                    <span><img class="icon" src="assets/img/icon/bar-chart.svg" alt="course-meta"> Higher</span>
                                    <span><img class="icon" src="assets/img/icon/user.svg" alt="course-meta"> 6395+</span>
                                    <span>$260</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="z-gallery mb-30">
                            <div class="z-gallery__thumb mb-20">
                                <a href="course-details.html"><img class="img-fluid" src="assets/img/course/03.png" alt=""></a>
                                <div class="feedback-tag">4.8(256)</div>
                                <div class="heart-icon"><i class="fas fa-heart"></i></div>
                            </div>
                            <div class="z-gallery__content">
                                <div class="course__tag mb-15">
                                    <span>Science</span>
                                    <span>Lab</span>
                                    <a class="f-right" href="instructor-details.html"><img src="assets/img/course/in3.png" alt=""></a>
                                </div>
                                <h4 class="sub-title mb-20"><a href="course-details.html">Take A Course For You Biright Future</a></h4>
                                <div class="course__meta">
                                    <span><img class="icon" src="assets/img/icon/time.svg" alt="course-meta"> 12 Class</span>
                                    <span><img class="icon" src="assets/img/icon/bar-chart.svg" alt="course-meta"> Higher</span>
                                    <span><img class="icon" src="assets/img/icon/user.svg" alt="course-meta"> 6395+</span>
                                    <span>$260</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature-course end -->
        <!--what-loking-for start-->
        <section class="what-looking-for pos-rel gradient-bg pt-145 pb-130 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
            <div class="what-blur-shape-one"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-55">
                            <h5 class="bottom-line mb-25">Teachers & Students</h5>
                            <h2>What you Looking For?</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="what-box text-center mb-3">
                            <div class="what-box__icon mb-30">
                                <img src="assets/img/icon/phone-operator.svg" alt="">
                            </div>
                            <h3>Do you want to teach here?</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.</p>
                            <a href="course-details.html" class="theme_btn border_btn">Register Now</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="what-box text-center mb-3">
                            <div class="what-box__icon mb-30">
                                <img src="assets/img/icon/graduate.svg" alt="">
                            </div>
                            <h3>Do you want to learn here?</h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di nonumy eirmod tempor invidunt ut labore et dolore magn aliq erat.</p>
                            <a href="course-details.html" class="theme_btn border_btn active">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--what-loking-for end-->
        <!-- subscribe-area start -->
        <section class="subscribe-area border-bot pt-145 pb-50 pt-md-90 pt-xs-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="subscribe-wrapper text-center mb-30">
                            <h2>Subscribe our Newsletter & Get every updates.</h2>
                            <div class="subscribe-form-box pos-rel">
                                <form class="subscribe-form">
                                    <input type="text" placeholder="Write Your E-mail">
                                </form>
                                <button class="sub_btn">Subscribe Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-area end -->
    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>