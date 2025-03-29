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
    $meta_title = "Top Colleges in India - Find Best Colleges & Courses | CollegeNew.com";
    $meta_dec = "Explore the best colleges in India. Compare courses, admission details, and fees to find the perfect college for your career goals with expert guidance.";
    $meta_keywords = "top colleges in India, best universities, college admissions, higher education, career counseling, study programs, courses and fees";
    $meta_img = $domain . "/assets/img/og-image.png";
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
    <link rel="canonical" href="<?= $domain ?>/colleges.php">
    <link rel="stylesheet" href="assets\css\college.css">

</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main class="card-container gradient-bg  d-sm-auto container-fluid">

        <div class="container">
            <div class="row">
                <?php
              
              if (isset($_GET['cid'])) {
                $cid = $_GET['cid'];
                $stmt = $con->prepare("
                    SELECT c.id, c.city_name, c.college_name, c.admission_type, c.college_logo, c.tag_id, 
                           c.university_name, c.finance_type, c.highest_package, 
                           SUBSTRING_INDEX(GROUP_CONCAT(cr.short_form ORDER BY cr.id SEPARATOR ' | '), ' | ', 3) AS courses
                    FROM colleges c
                    LEFT JOIN courses cr ON FIND_IN_SET(cr.id, c.courseId) > 0
                    WHERE FIND_IN_SET(?, c.courseId) > 0
                    GROUP BY c.id 
                ");
                $stmt->bind_param("s", $cid);
            } else {
                $stmt = $con->prepare("
                    SELECT c.id, c.college_name, c.city_name, c.admission_type, c.college_logo, c.tag_id, 
                           c.university_name, c.finance_type, c.highest_package, 
                           SUBSTRING_INDEX(GROUP_CONCAT(cr.short_form ORDER BY cr.id SEPARATOR ' | '), ' | ', 3) AS courses
                    FROM colleges c
                    LEFT JOIN courses cr ON FIND_IN_SET(cr.id, c.courseId) > 0
                    GROUP BY c.id 
                ");
            }
            
                
                $stmt->execute();
                $result = $stmt->get_result();
                $colleges = $result->fetch_all(MYSQLI_ASSOC);
                
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    // Secure variables
                    $collegeLogo = htmlspecialchars($row['college_logo'] ?? 'default.png');
                    $city_name = htmlspecialchars($row['city_name'] ?? 'n/a');
                    $collegeName = htmlspecialchars($row['college_name'] ?? 'Unknown College');
                    $admissionType = htmlspecialchars($row['admission_type'] ?? 'N/A');
                    $financeType = htmlspecialchars($row['finance_type'] ?? 'Unknown');
                    $universityName = htmlspecialchars($row['university_name'] ?? 'Unknown University');
                    $tagId = htmlspecialchars($row['tag_id'] ?? '');
                    $courses = htmlspecialchars($row['courses'] ?? 'No Courses Available');
                    $package = htmlspecialchars($row['highest_package'] ?? '99999');
                ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="assets/img/college/<?= $collegeLogo ?>" class="card-img-top" alt="<?= $collegeName ?> Logo">
                            <div class="card-body">
                                <a href="college-details.php?u=<?= urlencode($tagId) ?>">
                                    <h5 class="card-title"><?= $collegeName .' ,'. $city_name ?></h5>
                                </a>
                                <ul class="icon-list">
                                    <li><i class="fas fa-university"></i> <?= $admissionType ?></li>
                                    <li><i class="fas fa-graduation-cap"></i> <?= $courses ?> and +more</li>
                                    <li><i class="fas fa-building"></i> <?= $financeType ?> Institute</li>
                                    <li><i class="fas fa-school"></i> <?= $universityName ?></li>
                                    <li><i class="fas fa-wallet"></i> Heights Package : <?= $package ?></li>

                                </ul>
                                <div class="explore-btn">
                                    <button onclick="window.location.href='college-details.php?u=<?= urlencode($tagId) ?>'">Explore More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                $stmt->close();
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