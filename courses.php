<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <?php
    $meta_title = "Explore Top Courses in India - Find Best Career Programs | CollegeNew.com";
    $meta_dec = "Discover the best courses in India. Compare course details, eligibility, fees, and career opportunities to find the perfect program for your future.";
    $meta_keywords = "top courses in India, best career programs, higher education, course details, study programs, professional courses, course fees, career guidance";
    $meta_img = $domain . "assets/img/og-img.png";
?>

    <title><?= $meta_title ?></title>
    <meta name="title" content="<?= $meta_title ?>">
    <meta name="description" content=<?= $meta_dec ?>>
    <meta name="keywords" content=<?= $meta_keywords ?>>

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $domain ?>">
    <meta property="og:title" content="<?= $meta_title ?>">
    <meta property="og:description" content="<?= $meta_dec ?>">
    <meta property="og:image" content="<?= $meta_img ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $domain ?>">
    <meta property="twitter:title" content="<?= $meta_title ?>">
    <meta property="twitter:description" content=<?= $meta_dec ?>>
    <meta property="twitter:image" content="<?= $meta_img ?>">
    <link rel="canonical" href="<?= $domain ?>">
</head>

<body>


    <?php include 'php/pages/header.php' ?>
    <main>


        <!-- feature-course start -->
        <section class="feature-course pos-rel overflow-hidden pt-md-95 pb-md-75 pt-xs-95 pb-xs-70">
            <div class="feature-blur-one"></div>
            <div class="feature-blur-two"></div>
            <br>
            <?php if (!isset($_GET['d'])) { ?>
                <div class="deal-active owl-carousel mb-30">
                    <?php
                    // Fetch all departments
                    $sql = "SELECT * FROM department ORDER BY department_name ASC";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $departmentName = htmlspecialchars($row['department_name'], ENT_QUOTES, 'UTF-8');
                            $departmentId = urlencode($row['id']); // Ensure URL safety
                    ?>
                            <div class="single-item">
                                <div class="single-box mb-30 text-center p-3 shadow-sm rounded">
                                    <a href="courses.php?d=<?= $departmentName ?>" class="d-block text-decoration-none">
                                        <h4 class="sub-title mb-2 font-weight-bold "><?= $departmentName ?></h4>
                                        <p class="text-muted">Discover top courses in <?= $departmentName ?> and advance your career.</p>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-center">
                            <p class="text-danger">No departments available at the moment.</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php } else { ?>
                <div class="single-item">
                    <div class="single-box mb-30 text-center p-3 shadow-sm rounded">
                        <a href="courses.php" class="d-block text-decoration-none">
                            <h4 class="sub-title mb-2 font-weight-bold text-danger">Clear Filter</h4>
                            <p class="text-muted">Click here to view all Department again.</p>
                        </a>
                    </div>
                </div>
            <?php } ?>


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
                    if (isset($_GET['d'])) {
                        $department_name = $_GET['d'];
                        $sql = "SELECT id, course_name, short_form, fees, duration_of_Course, study_mode, enterance_exam, eligibility, department, course_thumbnail FROM courses WHERE department = '$department_name' ORDER BY course_name ASC";
                    } else {
                        $sql = "SELECT id, course_name, short_form, fees, duration_of_Course, study_mode, enterance_exam, eligibility, department, course_thumbnail FROM courses ORDER BY course_name ASC";
                    }
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
                            $course_url = "course-details.php?cid=$course_id";
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
                        echo "<div class='col  grid-item text-center'>";
                        echo '<div class="col-12 p-5 text-center"><h2 class="text-danger">No courses found.</h2></div>';
                        echo "</div>";
                    }
                    ?>
                </div>


            </div>
        </section>
        <!-- feature-course end -->
        <?php include 'php/pages/what-are-you-looking-for.php'; ?>

    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>