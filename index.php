<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main>
        <!--slider-area start-->
        <section class="slider-area pt-180 pt-xs-150 pt-150 pb-xs-35">
            <img class="sl-shape shape_01" src="assets/img/icon/01.svg" alt="">
            <img class="sl-shape shape_02" src="assets/img/icon/02.svg" alt="">
            <img class="sl-shape shape_03" src="assets/img/icon/03.svg" alt="">
            <img class="sl-shape shape_04" src="assets/img/icon/04.svg" alt="">
            <img class="sl-shape shape_05" src="assets/img/icon/05.svg" alt="">
            <img class="sl-shape shape_06" src="assets/img/icon/06.svg" alt="">
            <img class="sl-shape shape_07" src="assets/img/shape/dot-box-5.svg" alt="">
            <div class="main-slider pt-10">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 order-last order-lg-first">
                            <div class="slider__img__box mb-50 pr-30">
                                <img class="img-one mt-55 pr-70" src="assets/img/slider/01.png" alt="">
                                <img class="slide-shape img-two" src="assets/img/slider/02.png" alt="">
                                <img class="slide-shape img-three" src="assets/img/slider/03.png" alt="">
                                <img class="slide-shape img-four" src="assets/img/shape/dot-box-1.svg" alt="">
                                <!-- <img class="slide-shape img-five" src="assets/img/shape/dot-box-2.svg" alt=""> -->
                                <img class="slide-shape img-six" src="assets/img/shape/zigzg-1.svg" alt="">
                                <img class="slide-shape img-seven wow fadeInRight animated" data-delay="1.5s" src="assets/img/icon/dot-plan-1.svg" alt="Chose-img">
                                <img class="slide-shape img-eight" src="assets/img/slider/earth-bg.svg" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="slider__content pt-15">
                                <h1 class="main-title mb-40 wow fadeInUp2 animated" data-wow-delay='.1s'>Learn Everyday & Any New Skills Online with Top <span class="vec-shape">Instructors.</span></h1>
                                <h5 class="mb-35 wow fadeInUp2 animated" data-wow-delay='.2s'>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</h5>
                                <ul class="search__area d-md-inline-flex align-items-center justify-content-between mb-30">
                                    <li>
                                        <div class="widget__search">
                                            <form class="input-form" action="colleges.php?s=true">
                                                <input type="text" name="search" class="search-input" placeholder="Search..." required autocomplete="off" autofocus>
                                                <button class="search-icon"><i class="far fa-search"></i></button>
                                            </form>

                                        </div>
                                        <div class="autocomplete-suggestions"></div>
                                    </li>
                                    <li>
                                        <button id="search_btn" class="theme_btn search_btn ml-35">Search Now</button>
                                    </li>
                                </ul>
                                <?php
                                if (isset($_SESSION['Auth'])) {

                                ?>

                                    <p class="highlight-text">hello, <span><?= $user['username'] ?>.

                                        </span> welcome back! </p>

                                <?php
                                } else { ?>
                                    <p class="highlight-text"><span>#1</span> Worldwide Online Learning & Skills Development Platform</p>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--slider-area end-->
        <!--great-deal-area start-->
        <section class="great-deal-area pt-150 pb-0 pt-md-100 pb-md-40 pt-xs-100 pb-xs-40">
            <?php include 'php/pages/choose-your-department.php'; ?>
        </section>
        <!--great-deal-area end-->
        <?php include 'php/pages/what-are-you-looking-for.php'; ?>

        <section class="course-categories pb-115 pt-md-95 pb-md-65 pt-xs-95 pb-xs-65">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section-title section-title-3 text-center mb-60">
                            <h5 class="mb-25">Discover Top Colleges</h5>
                            <h2 class="mb-20">Explore <span class="bottom-line">Leading Institutions</span></h2>
                            <p>Find the best colleges offering a variety of courses to kickstart your academic journey. Choose from accredited institutions and get started today!</p>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 gx-4 online__course__cat">
                    <?php
                    // Securely fetch all colleges using prepared statements
                    $stmt = $con->prepare("SELECT `college_name`, `college_logo`, `tag_id` FROM colleges ORDER BY `college_name` ASC");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($college = $result->fetch_assoc()) {
                            $college_name = htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8');
                            $college_logo = htmlspecialchars($college['college_logo'], ENT_QUOTES, 'UTF-8');
                            $tag_id = urlencode($college['tag_id']); // Ensures URL safety
                    ?>
                            <div class="col">
                                <div class="courses_link mb-30 wow fadeInUp2 animated" data-wow-delay=".1s">
                                    <img class="icon-01 mb-35" src="assets/img/college/<?= $college_logo ?>" alt="<?= $college_name ?>">
                                    <h5 class="sub-title mb-25"><?= $college_name ?></h5>
                                    <a href="college-details.php?u=<?= $tag_id ?>" class="explore-btn">
                                        <img class="arrows-icon" src="assets/img/icon/arrow-right.svg" alt="Explore">
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-center">
                            <p class="text-danger">No colleges found. Please check back later.</p>
                        </div>
                    <?php
                    }
                    $stmt->close();
                    ?>
                </div>

                <div class="col-xxl-12 text-center mt-20 mb-30 wow fadeInUp2 animated" data-wow-delay=".3s">
                    <a href="colleges.php" class="theme_btn">Explore All Colleges</a>
                </div>
            </div>

        </section>
        <!-- feature-course start -->
        <section class="feature-course pos-rel overflow-hidden pt-md-95 pb-md-75 pt-xs-95 pb-xs-70">
            <div class="feature-blur-one"></div>
            <div class="feature-blur-two"></div>
            <div class="container">
                <div class="align-items-center mb-35">

                    <div class="section-title section-title-3 text-center text-xl-start mb-30">
                        <h5 class="mb-25">Featured Courses</h5>
                        <h2 class="mb-20">Explore our <span class="bottom-line">Popular Courses</span></h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                    </div>


                </div>
                <div class="grid row">
                    <?php
                    // Secure SQL query to fetch courses sorted alphabetically
                    $sql = "SELECT id, course_name, short_form, fees, duration_of_Course, study_mode, enterance_exam, eligibility, department, course_thumbnail FROM courses ORDER BY course_name ASC";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Escaping output for security
                            $course_id = (int) $row['id'];
                            $course_name = htmlspecialchars($row['course_name'], ENT_QUOTES, 'UTF-8');
                            $short_form = htmlspecialchars($row['short_form'], ENT_QUOTES, 'UTF-8');
                            $fees = htmlspecialchars($row['fees'], ENT_QUOTES, 'UTF-8');
                            $duration = htmlspecialchars($row['duration_of_Course'], ENT_QUOTES, 'UTF-8');
                            $study_mode = htmlspecialchars($row['study_mode'], ENT_QUOTES, 'UTF-8');
                            $entrance_exam = htmlspecialchars($row['enterance_exam'], ENT_QUOTES, 'UTF-8');
                            $eligibility = htmlspecialchars($row['eligibility'], ENT_QUOTES, 'UTF-8');
                            $department = htmlspecialchars($row['department'], ENT_QUOTES, 'UTF-8');
                            $course_thumbnail = htmlspecialchars($row['course_thumbnail'], ENT_QUOTES, 'UTF-8');

                            // Course Details URL with ID
                            $course_url = "course-details.php?id=$course_id";
                    ?>
                            <div class="col-lg-4 col-md-6 grid-item">
                                <div class="z-gallery z-gallery-two gallery-03 mb-30">
                                    <div class="z-gallery__thumb mb-20">
                                        <a href="<?= $course_url ?>">
                                            <img class="img-fluid" src="assets/img/course/<?= $course_thumbnail ?>" alt="<?= $course_name ?>">
                                        </a>
                                    </div>
                                    <div class="z-gallery__content pos-rel">
                                        <div class="course__meta d-flex align-items-center justify-content-between mb-15">
                                            <span><img class="icon" src="assets/img/icon/time.svg" alt="course-meta"> <?= $duration ?></span>
                                            <span><img class="icon" src="assets/img/icon/bar-chart.svg" alt="course-meta"> <?= $study_mode ?></span>
                                        </div>
                                        <h4 class="sub-title mb-15">
                                            <a href="<?= $course_url ?>"><?= $course_name ?> (<?= $short_form ?>)</a>
                                        </h4>
                                        <p class="mb-20">Eligibility: <?= $eligibility ?></p>
                                        <div class="course__authors d-xl-flex align-items-center justify-content-between mb-20">
                                            <div class="course__authors-box d-flex align-items-center">
                                                <div class="course__authors-box-text ml-10">
                                                    <h5><?= $department ?></h5>
                                                    <span>Entrance Exam: <?= $entrance_exam ?></span>
                                                </div>
                                            </div>
                                            <p>Fees: <span>₹<?= $fees ?></span></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="col-12 text-center"><p class="text-danger">No courses found.</p></div>';
                    }
                    ?>
                </div>
                >
                <div class="row">
                    <div class="col-xxl-12 mt-20 text-center mb-20 wow fadeInUp2 animated" data-wow-delay='.3s'>
                        <a href="courses.html" class="theme_btn">Explore More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature-course end -->

        <!-- why-chose-section-wrapper start -->
        <div class="why-chose-section-wrapper gradient-bg mr-100 ml-100">
            <!-- why-chose-us start -->
            <section class="why-chose-us">
                <div class="why-chose-us-bg pt-md-95 pb-md-90 pt-xs-95 pb-xs-90">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-7 col-lg-7">
                                <div class="chose-img-wrapper mb-50 pos-rel">
                                    <div class="coures-member">
                                        <h5>Total Students</h5>
                                        <img class="choses chose_01" src="assets/img/chose/01.png" alt="Chose-img">
                                        <img class="choses chose_02" src="assets/img/chose/02.png" alt="Chose-img">
                                        <img class="choses chose_03" src="assets/img/chose/03.png" alt="Chose-img">
                                        <img class="choses chose_04" src="assets/img/chose/04.png" alt="Chose-img">
                                        <span>25k+</span>
                                    </div>
                                    <div class="feature tag_01"><span><img src="assets/img/icon/shield-check.svg" alt=""></span> Safe & Secured</div>
                                    <div class="feature tag_02"><span><img src="assets/img/icon/catalog.svg" alt=""></span> 120+ Colleges</div>
                                    <div class="feature tag_03"><span><i class="fal fa-check"></i></span> Gerruntide Admission</div>
                                    <div class="video-wrapper">
                                        <a href="https://www.youtube.com/watch?v=7omGYwdcS04" class="popup-video"><i class="fas fa-play"></i></a>
                                    </div>
                                    <div class="img-bg pos-rel">
                                        <img class="chose_05 pl-70 pl-lg-0 pl-md-0 pl-xs-0" src="assets/img/chose/05.png" alt="Chose-img">
                                    </div>
                                    <img class="chose chose_06" src="assets/img/shape/dot-box3.svg" alt="Chose-img">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5">
                                <div class="chose-wrapper pl-25 pl-lg-0 pl-md-0 pl-xs-0">
                                    <div class="section-title mb-30 wow fadeInUp2 animated" data-wow-delay='.1s'>
                                        <h5 class="bottom-line mb-25">Discover collegenew </h5>
                                        <h2 class="mb-25">Why Choose collegenew.com ?</h2>
                                        <p>At collegenew.com , we redefine excellence by delivering cutting-edge solutions that inspire, engage, and transform. Whether it's innovation, reliability, or customer satisfaction – we set the benchmark.</p>
                                    </div>
                                    <ul class="text-list mb-40 wow fadeInUp2 animated" data-wow-delay='.2s'>
                                        <li> Unmatched expertise & industry-leading innovation</li>
                                        <li> Tailored solutions designed for your success</li>
                                        <li> Commitment to quality, trust, and long-term partnerships</li>
                                    </ul>
                                    <a href="about.php" class="theme_btn wow fadeInUp2 animated" data-wow-delay='.3s'>Learn More</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- why-chose-us end -->

        </div>
        <!-- why-chose-section-wrapper start -->
        <?php
        $testimonials = [
            ["name" => "Rohan Sharma", "course" => "B.Tech Student", "review" => "The admission process was so smooth! I got into my dream college without any hassle. Highly recommended!"],
            ["name" => "Pooja Verma", "course" => "MBA Aspirant", "review" => "This platform provided me with proper guidance. The counselors were very helpful in clearing my doubts!"],
            ["name" => "Vikram Patel", "course" => "Engineering Student", "review" => "I had many queries, but the team was always available to help me out. Thanks for the amazing service!"],
            ["name" => "Sneha Joshi", "course" => "Medical Student", "review" => "I was unsure about which college to choose, but the experts guided me perfectly. Now I'm studying at my desired university!"],
            ["name" => "Aditya Mehta", "course" => "BBA Student", "review" => "I applied through this platform and got admission without any trouble. The team was very supportive!"],
            ["name" => "Simran Kaur", "course" => "M.Sc Aspirant", "review" => "I was struggling with the application process, but this service made everything easy and stress-free!"],
            ["name" => "Rahul Desai", "course" => "B.Com Student", "review" => "This platform really cares about students. They helped me shortlist the best colleges according to my profile."],
            ["name" => "Megha Reddy", "course" => "Law Student", "review" => "I received step-by-step guidance on admission procedures. I'm truly grateful for their support!"],
            ["name" => "Amit Trivedi", "course" => "B.Sc Student", "review" => "The experts here helped me clear my doubts about colleges and courses. I highly recommend their services!"],
            ["name" => "Neha Kapoor", "course" => "MBA Candidate", "review" => "I got admission into a top-tier college without any confusion. Their support team was very patient and helpful!"]
        ];

        $latestReviews = array_slice($testimonials, -10); // Get the latest 10 reviews
        ?>

        <section class="testimonial-area nav-style-chevron pt-150 pb-120 pt-md-95 pb-md-70 pt-xs-95 pb-xs-5">
            <div class="container testimonial-bg">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mb-60">
                        <h5 class="bottom-line left-line mb-25 pl-40 pr-40">Our Testimonials</h5>
                        <h2 class="mb-25">What Students Say About Us</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="testimonial-active-full owl-carousel">
                            <?php foreach ($latestReviews as $review) : ?>
                                <div class="item">
                                    <div class="testimonial-wrapper text-center mb-30">
                                        <div class="quote-icon mb-20">
                                            <img src="assets/img/icon/Quotemarks-right.svg" alt="quote-icon">
                                        </div>
                                        <h5>"<?= $review['review']; ?>"</h5>
                                        <div class="testimonial-authors__content mt-65">
                                            <h3 class="mb-15"><?= $review['name']; ?></h3>
                                            <p><?= $review['course']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>




    </main>

    <?php include 'php/pages/footer.php' ?>
    <script src="assets/js/search.js"></script>
</body>

</html>