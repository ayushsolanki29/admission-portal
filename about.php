<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <style>
        .banner-part {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: auto;
            background-color: #f8f9fa;
            padding: 20px 30px;
            flex-wrap: wrap;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .banner-part h3 {
            font-size: 1.6rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .b-b {
            background-color: #e75115;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .b-b:hover {
            background-color: #d64010;
            transform: scale(1.05);
        }
    </style>
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main>

        <!--great-deal-area start-->
        <section class="great-deal-area pt-100 pb-90 pt-md-100 pb-md-40 pt-xs-100 pb-xs-40">
            <div class="container">
                <div class="row justify-content-lg-center justify-content-start">
                    <div class="col-xl-3 col-lg-8">
                        <div class="deal-box mb-30 text-center text-xl-start">
                            <h2 class="mb-20"><b>Your Future</b> Starts Here</h2>
                            <p>Find the perfect college and course with expert guidance. We help students secure admissions in their dream institutions hassle-free.</p>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="deal-active owl-carousel mb-30">
                            <div class="single-item">
                                <div class="single-box mb-30">
                                    <div class="single-box__icon mb-25">
                                        <img src="assets/img/icon/puzzle.svg" alt="">
                                    </div>
                                    <h4 class="sub-title mb-20">Discover Top Colleges</h4>
                                    <p>Explore the best colleges suited to your career goals with our comprehensive database.</p>
                                </div>
                            </div>
                            <div class="single-item">
                                <div class="single-box s-box2 mb-30">
                                    <div class="single-box__icon mb-25">
                                        <img src="assets/img/icon/manager.svg" alt="">
                                    </div>
                                    <h4 class="sub-title mb-20">Expert Admission Guidance</h4>
                                    <p>Our specialists provide step-by-step guidance to help you secure admission in your dream college.</p>
                                </div>
                            </div>
                            <div class="single-item">
                                <div class="single-box s-box3 mb-30">
                                    <div class="single-box__icon mb-25">
                                        <img src="assets/img/icon/notepad.svg" alt="">
                                    </div>
                                    <h4 class="sub-title mb-20">Find the Right Course</h4>
                                    <p>Compare and choose from a wide range of courses that match your passion and career aspirations.</p>
                                </div>
                            </div>
                            <div class="single-item">
                                <div class="single-box mb-30">
                                    <div class="single-box__icon mb-25">
                                        <img src="assets/img/icon/puzzle.svg" alt="">
                                    </div>
                                    <h4 class="sub-title mb-20">Hassle-Free Admissions</h4>
                                    <p>We simplify the admission process, making it seamless and stress-free for students.</p>
                                </div>
                            </div>
                            <div class="single-item">
                                <div class="single-box s-box2 mb-30">
                                    <div class="single-box__icon mb-25">
                                        <img src="assets/img/icon/manager.svg" alt="">
                                    </div>
                                    <h4 class="sub-title mb-20">Personalized Support</h4>
                                    <p>Get one-on-one assistance tailored to your needs, ensuring you make the best decision for your future.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--great-deal-area end-->
        <!--about-us-area start-->
        <section class="about-us-area pt-md-100 pb-md-70 pt-xs-100 pb-xs-70">
            <div class="container">
                <div class="row align-items-center mb-120">
                    <div class="col-lg-7">
                        <div class="about__img__box mb-60">
                            <img class="about-main-thumb pl-110" src="assets/img/slider/01.png" alt="about-img">

                            <img class="about-img about_03" src="assets/img/slider/earth-bg.svg" alt="about-img">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="about-wrapper">
                            <div class="section-title section-title-4 mb-60">
                                <h5 class="bottom-line mb-25">About Us</h5>
                                <h2 class="mb-20">Your Trusted Partner in College Admissions & Career Success</h2>
                                <p class="mb-20">
                                    Welcome to <b>CollegeNew.com</b>, your go-to platform for finding the best colleges and courses.
                                    Based in <b>Kalol, Ahmedabad</b>, we specialize in helping students secure admissions
                                    in their dream institutions with ease.
                                </p>
                                <p>
                                    Whether you're looking for the right course, expert admission guidance, or seamless enrollment assistance,
                                    we ensure a smooth and stress-free journey. Discover top colleges, compare courses, and take the next step
                                    toward a successful future—all in one place.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
               

            </div>
        </section>
        <!--about-us-area end-->

        <section class="about-company-section py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-3">About <span class="theme-color">collegenew.com</span></h2>
                        <p class="lead text-muted">
                            We are your trusted guide for securing admissions in your dream colleges. At <strong>CollegeNew.com</strong>, we help students find the best courses and colleges, providing expert guidance throughout the admission process.
                        </p>
                    </div>
                </div>
                <div class="row mt-4 mb-3">
                    <div class="col-md-6 mb-3">
                        <h4 class="fw-semibold mb-3"><i class="bi bi-check-circle-fill text-success"></i> Our Mission</h4>
                        <p class="text-muted">We strive to bridge the gap between students and top educational institutions, ensuring a seamless admission experience.</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4 class="fw-semibold mb-3"><i class="bi bi-people-fill text-primary"></i> Why Choose Us?</h4>
                        <p class="text-muted">With years of experience, we offer reliable admission support, expert counseling, and a vast network of top colleges and courses.</p>
                    </div>
                </div>
                <hr>
                <div class="row mt-4 mb-3">
                    <div class="col-lg-12 mb-3">
                        <h4 class="fw-semibold text-center ">What We Offer</h4> <br>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-mortarboard-fill text-danger fs-3 me-3"></i>
                                    <div>
                                        <h5 class="mb-3">College Admissions</h5>
                                        <p class="text-muted">We assist students in securing admission to the best colleges suited to their aspirations.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-search text-info fs-3 me-3"></i>
                                    <div>
                                        <h5 class="mb-3">Course Discovery</h5>
                                        <p class="text-muted">Find the perfect course for your career goals with our detailed insights and recommendations.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-chat-dots-fill text-success fs-3 me-3"></i>
                                    <div>
                                        <h5 class="mb-3">Career Counseling</h5>
                                        <p class="text-muted">Get expert guidance on selecting the right college, course, and career path.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="contact.php#form" class="btn theme-bg px-4 py-2">Get Admission Help</a>
                        </div>
                    </div>
                </div>
                <div class="row pl-75 pr-75 pr-lg-0 pr-md-0 pr-xs-0 pl-lg-0 pl-md-0 pl-xs-0">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counters text-center mb-30">
                            <h2><span class="counter">500</span>+</h2>
                            <h5>Top Colleges Partnered</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counters count-1 text-center mb-30">
                            <h2><span class="counter">2000</span>+</h2>
                            <h5>Career-Oriented Courses</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counters count-2 text-center mb-30">
                            <h2><span class="counter">15000</span>+</h2>
                            <h5>Student Admissions</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counters count-3 text-center mb-30">
                            <h2><span class="counter">10</span>+</h2>
                            <h5>Years of Expertise</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
    <?php include 'php/pages/footer.php' ?>
</body>

</html>