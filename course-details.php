<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
if (isset($_SESSION['Auth'])) {
    $user_id = $_SESSION['Auth'];
} else {
    header('Location: login.php?error=Please Login First For Checking Course');
    exit();
}
if (isset($_GET['cid'])) {
    $tagId = $_GET['cid'];
    $stmt = $con->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param("s", $tagId);
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = $result->fetch_assoc();
    $stmt->close();
} else {
    header("Location:404.php");
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <?php
    $meta_title = "{$courses['course_name']} - Course Details, Fees & Admissions | CollegeNew.com";
    $meta_dec = "Get complete details about {$courses['course_name']} including course fees, duration, eligibility, and admission process. Find the best colleges offering this course.";
    $meta_keywords = "{$courses['course_name']}, course details, course fees, best courses, study programs, higher education, career guidance, admissions";
    $meta_img = $domain . "/assets/img/course/{$courses['course_thumbnail']}";
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
    <link rel="canonical" href="<?= $domain ?>/course-details.php?u=<?= $tagId ?>">
    <title>
        <?= $courses['course_name'] . " - Details" ?>
    </title>
</head>

<body>


    <?php include 'php/pages/header.php' ?>
    <main>

        <!--course-details-area start-->
        <section class="course-details-area pt-md-100 pt-xs-100 pb-xs-70">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 col-xl-7">

                        <div class="courses-details-wrapper ">
                            <h2 class="courses-title mb-2"><?= $courses['short_form'] ?></h2>
                            <h5><?= $courses['course_name'] ?></h5>

                            <div class="course-details-img">
                                <img src="assets/img/course/<?= $courses['course_thumbnail']; ?>" class="w-100" alt="">
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5">
                        <div class="courses-ingredients">
                            <div class="courses-tag-btn mb-4" style="margin-right: 10px;">
                                <a href="colleges.php?cid=<?= $courses['id'] ?>" class="theme-bg text-white">Find College</a>
                                <a href="#" id="shareBtn">Share</a>
                            </div>
                            <h2 class="corses-title mb-30">Course Details</h2>
                            <p> <strong>Eligibility : </strong> <?= $courses['eligibility'] ?></p>
                            <ul class="courses-item mt-25">
                                <li><strong>Duration : </strong> <?= $courses['duration_of_Course'] ?></li>
                                <li><strong>Fees : </strong> <?= $courses['fees'] ?></li>
                                <li><strong>Study Mode : </strong> <?= $courses['study_mode'] ?></li>
                                <li><strong>Entrance Exam : </strong> <?= $courses['enterance_exam'] ?></li>
                                <li> <strong>Department :</strong> <?= $courses['department'] ?></li>
                            </ul>
                        </div>

                        <script>
                            document.getElementById('shareBtn').addEventListener('click', function(event) {
                                event.preventDefault();

                                if (navigator.share) {
                                    navigator.share({
                                        title: "<?= $courses['short_form'] ?> (<?= $courses['department'] ?>) - Course Details",
                                        text: "Check out this course: <?= $courses['course_name'] ?>\nEligibility: <?= $courses['eligibility'] ?>\nFees: <?= $courses['fees'] ?>",
                                        url: window.location.href
                                    }).then(() => {
                                        console.log('Thanks for sharing!');
                                    }).catch((error) => {
                                        console.error('Error sharing:', error);
                                    });
                                } else {
                                    alert("Your browser doesn't support the Web Share API. Please copy the link manually.");
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>
        </section>
        <!--course-details-area end-->
        <!-- feature-course start -->
        <section class="feature-course pb-130 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
            <div class="container">
                <h2 class="courses-title mb-35">Semilar Department</h2>
                <div class="grid row">
                    <?php
                    $department = $courses['department'];
                    // Secure SQL query to fetch courses sorted alphabetically
                    $sql = "SELECT id, course_name, short_form, fees, duration_of_Course, study_mode, enterance_exam, eligibility, department, course_thumbnail FROM courses WHERE `department` = '$department' AND `id`!='$tagId'  ORDER BY course_name ASC ";
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
                        echo '<div class="col-12 text-center"><p class="text-danger">No courses found.</p></div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- feature-course end -->
    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>