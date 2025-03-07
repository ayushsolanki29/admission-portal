<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();


// Check if 'u' parameter is set
if (isset($_GET['u'])) {
    $tagId = $_GET['u'];

    // Fetch college details (excluding courses and campus images)
    $stmt = $con->prepare("SELECT * FROM colleges WHERE tag_id = ?");
    $stmt->bind_param("s", $tagId);
    $stmt->execute();
    $result = $stmt->get_result();
    $college = $result->fetch_assoc();
    $stmt->close();

    if (!$college) {
        header("Location: 404.php");
        exit();
    }

    // Fetch courses separately
    $stmt = $con->prepare("
        SELECT id, course_name, short_form, fees, duration_of_Course, study_mode, 
               enterance_exam, eligibility, department, course_thumbnail 
        FROM courses WHERE FIND_IN_SET(id, ?)
    ");
    $stmt->bind_param("s", $college['courseId']);
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = [];

    while ($row = $result->fetch_assoc()) {
        $courses[] = [
            'name' => $row['course_name'],
            'id' => $row['id'],
            'short_form' => $row['short_form'],
            'fees' => $row['fees'],
            'duration' => $row['duration_of_Course'],
            'study_mode' => $row['study_mode'],
            'entrance_exam' => $row['enterance_exam'],
            'eligibility' => $row['eligibility'],
            'department' => $row['department'],
            'thumbnail' => $row['course_thumbnail']
        ];
    }
    $stmt->close();

    // Fetch campus images separately
    $stmt = $con->prepare("
        SELECT DISTINCT image FROM campus_images WHERE college_id = ?
    ");
    $stmt->bind_param("i", $college['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $campusImages = [];

    while ($row = $result->fetch_assoc()) {
        $campusImages[] = $row['image'];
    }
    $stmt->close();
} else {
    header("Location: 404.php");
    exit();
}

if (!isset($_COOKIE['college_views'])) {
    $productViews = [];
} else {
    $productViews = json_decode($_COOKIE['college_views'], true);
}
$pid = $college['id'];

if (!in_array($pid, $productViews)) {
    // Make sure to include database connection before this
    $sql = "UPDATE `colleges` SET `views` = `views` + 1 WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $stmt->close();

    $productViews[] = $pid;
    setcookie('college_views', json_encode($productViews), time() + (1 * 24 * 60 * 60));
}

$apply_btn = "php/utils/actions.php?create_new_lead=true&lead_source=college&id=" . $college['id'];

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>

    <title><?= htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?> - Details</title>

    <link rel="stylesheet" href="assets\css\colleged.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <?php include 'php/pages/header.php' ?>
    <main>

        <!-- Fisrt-section  -->
        <div class="coantiner-fluids d-flex">
            <div class="left-section col-md-6 p-5">
                <!-- College Logo -->
                <div class="p-2">
                    <img src="assets/img/college/<?= htmlspecialchars($college['college_logo'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $college['college_name'] ?>" class="img-fluid" style="max-width: 120px;">
                </div>

                <h3 class="p-2"><?= htmlspecialchars($college['college_name'], ENT_QUOTES, 'UTF-8'); ?>, <?= htmlspecialchars($college['city_name'], ENT_QUOTES, 'UTF-8'); ?></h3>

                <p class="p-2" style="color: black; font-weight: 500;">
                    <?= $college['desciption_of_college'] ?>
                </p>
                <div class="p-2 ">
                    <i class="fa-solid fa-location-dot d-flex align-items-center gap-2">
                        <p style="color:#EB571C"><?= $college['city_name'] ?> (<?= $college['district_name'] ?>)</p>
                    </i>
                </div>
                <div class="p-2 mt-5 gap-5 d-flex">

                    <a target="_blank" href="<?= getFilePath('brochure', $college['college_brochure']); ?>" download="<?php echo $college['college_name'] . ' Brochure' ?>" class="btn p-2" style="border:2px solid #EB571C; color:#EB571C; border-radius:40px;">Download Brochure</a>
                    <a href="<?= $apply_btn ?>" target="_blank" class="btn p-2 px-5" style="border:2px solid #EB571C; background-color: #EB571C; color: white; border-radius:40px;">Apply Now</a>

                </div>
            </div>

            <div class="right-section ban col-md-6 d-flex align-items-center">
                <div class="ban-back">
                    <img src="assets\img\campus_images\<?= $college['college_campus'] ?>" alt="<?php echo $college['college_name'] . ' college_campus' ?>" srcset="">
                </div>
            </div>

        </div>
        <!-- End First Section  -->

        <!-- second section  -->
        <div class="container-fluid p-5">
            <h5>About <?= $college['college_name'] ?>'s University Details</h5>
            <p class="mt-4"><?= $college['university_details'] ?>.</p>
        </div>


        <!-- banner-do -->
        <div class="container-fluid banner-section bg-light p-4 rounded shadow-lg text-white">
            <h2 class="fw-bold">Discover Everything About <?= $college['college_name'] ?>!</h2>
            <p class="mt-2">Get all the details you need about courses, facilities, and more.</p>

            <a href="assets/brochure/<?= $college['college_brochure'] ?>"
                download="<?= $college['college_name'] ?> Brochure"
                class="btn btn-lg download-btn mt-3">
                📄 Download Brochure
            </a>
        </div>
        <style>
            .download-btn {
                background: #EB571C;
                color: #fff;
                font-weight: bold;
                padding: 12px 20px;
                border-radius: 30px;
                transition: all 0.3s ease-in-out;
                display: inline-block;
                text-decoration: none;
            }

            .download-btn:hover {
                background: rgba(235, 87, 28, 0.82);
                color: #fff;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            }
        </style>

        <!-- Course And addmision 2025  -->
        <div class="container-fluid mt-5">
            <div class="top-heading-text p-4">
                <h4 class="mt-2"><?= $college['college_name'] ?> Courses And Admission 2025</h4>
                <p class="mt-4"><?= $college['admission_process'] ?></p>
            </div>
            <div class="container-fluid card-sec">
                <?php foreach ($courses as $course): ?>
                    <div class="card-cour">
                        <div class="head">
                            <h3 class="m-0">
                                <?= htmlspecialchars($course['short_form'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                            </h3>
                        </div>
                        <div class="body-card">
                            <div class="info-section">
                                <strong class="fees">
                                    ₹<?= htmlspecialchars($course['fees'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                                </strong>
                                <span class="duration">
                                    <?= htmlspecialchars($course['duration'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                                <span class="study-mode">
                                    <?= htmlspecialchars($course['study_mode'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </div>
                            <div class="info-labels">
                                <strong>Fees</strong>
                                <span>Duration</span>
                                <span>Study Mode</span>
                            </div>

                            <p>
                                <strong>Course Name:</strong>
                                <?= htmlspecialchars($course['name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p>
                                <strong>Exams Accepted:</strong>
                                <?= htmlspecialchars($course['entrance_exam'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p>
                                <strong>Eligibility:</strong>
                                <?= htmlspecialchars($course['eligibility'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p>
                                <strong>Department:</strong>
                                <?= htmlspecialchars($course['department'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <div class="button-card">
                                <button onclick="window.location.href = 'course-details.php?cid=<?= $course['id'] ?>'" class="btn filled"> View More</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
        <!-- Course And addmision End -->
        <div class="container-fluid p-5">
            <h4 class="mt-3"> <?= $college['college_name'] ?> Placements Report</h4>
            <p class="mt-3"><?= $college['placement_details'] ?></p>

        </div>
        <div class="container-fluid mt-4 p-3">
            <div class="package-section p-4 bg-light rounded ">
                <h3 class="text-gray fw-bold mb-4"><?= $college['college_name'] ?> Placement Packages</h3>

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="package-box bg-white text-center p-4 rounded-pill shadow-sm">
                            <p class="text-muted mb-2">Median Salary</p>
                            <h4 class="highlight fw-bold text-dark"><?= $college['median_salary'] ?></h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="package-box bg-white text-center p-4 rounded-pill shadow-sm">
                            <p class="text-muted mb-2">Average Package</p>
                            <h4 class="highlight fw-bold text-dark"><?= $college['avarage_package'] ?></h4>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="package-box bg-white text-center p-4 rounded-pill shadow-sm">
                            <p class="text-muted mb-2">Highest Package</p>
                            <h4 class="highlight fw-bold text-dark"><?= $college['highest_package'] ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .package-box {
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            }

            .package-box:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
        </style>

        <!-- connet-sec  -->

        <div class="container-fluid connet-secd">
            <div class="banner">
                <div class="banner-content p-2">
                    <h5>Are you Confused? Talk to <?= $college['college_name'] ?> Expert</h5>
                    <p>Who offers personalized guidance, mentorship, and invaluable insights tailored to your academic and career aspirations.</p>
                    <a href="<?= $apply_btn ?>" target="_blank" class="banner-button1">Connect Now</a>
                </div>
                <div class="banner-image">
                    <img src="https://nj1-static.collegedekho.com/_next/static/media/askQueCtaIcon.8c3ad181.svg?width=256&q=80" alt="Confusion Illustration">
                </div>
            </div>
        </div>

        <!-- connet-sec End  -->

        <!-- star ratting start  -->
        <!-- <div class="container star-sec mt-5">
            <div class="review-header">IIT Madras Reviews</div>
            <div class="review-content-container">
                <div class="rating-box">
                    <div class="score">4.8</div>
                    <div>
                        <div class="stars">★★★★★</div>
                        <a href="#">(8 Reviews)</a>
                    </div>
                </div>
                <div>
                    <div class="progress-container">
                        <span>★★★★★</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 88%;"></div>
                        </div>
                        <span>88%</span>
                    </div>
                    <div class="progress-container">
                        <span>★★★★☆</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 0%;"></div>
                        </div>
                        <span>0%</span>
                    </div>
                    <div class="progress-container">
                        <span>★★★☆☆</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 13%;"></div>
                        </div>
                        <span>13%</span>
                    </div>
                    <div class="progress-container">
                        <span>★★☆☆☆</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 0%;"></div>
                        </div>
                        <span>0%</span>
                    </div>
                    <div class="progress-container">
                        <span>★☆☆☆☆</span>
                        <div class="progress-bar">
                            <div class="progress" style="width: 0%;"></div>
                        </div>
                        <span>0%</span>
                    </div>
                </div>
            </div>
            <div class="review-categories">
                <div class="category-card">
                    <div>Overall</div>
                    <div class="score">4.8 ★</div>
                    <a href="#">(8 Reviews)</a>
                </div>
                <div class="category-card">
                    <div>Infrastructure</div>
                    <div class="score">4.6 ★</div>
                    <a href="#">(7 Reviews)</a>
                </div>
                <div class="category-card">
                    <div>Faculty</div>
                    <div class="score">4.7 ★</div>
                    <a href="#">(6 Reviews)</a>
                </div>
                <div class="category-card">
                    <div>Placement</div>
                    <div class="score">4.6 ★</div>
                    <a href="#">(7 Reviews)</a>
                </div>
            </div>
        </div> -->
        <!-- star-sec end  -->



        <div class="container-fluid d-flex justify-content-center align-items-center mt-5">
            <div class="container container-custom shadow-lg p-4 theme-bg rounded">
                <h2 class="text-center fw-bold mb-4 text-gray">Campus Facilities</h2>
                <div class="row g-3">
                    <?php
                    $facilities = [
                        ["fa-book-open", "Academic Zone"],
                        ["fa-money-check-alt", "ATM"],
                        ["fa-bed", "Boys Hostel"],
                        ["fa-utensils", "Canteen"],
                        ["fa-desktop", "Computer Lab"],
                        ["fa-bed", "Girls Hostel"],
                        ["fa-burger", "Mess"],
                        ["fa-book", "Library"],
                        ["fa-hospital", "Medical Facilities"],
                        ["fa-chalkboard-teacher", "Classroom"],
                        ["fa-briefcase", "Placement"],
                        ["fa-futbol", "Sports"],
                        ["fa-envelope", "Post Office"],
                        ["fa-flask", "R&D"],
                        ["fa-university", "Residential Institute"],
                        ["fa-home", "Residential Zone"],
                        ["fa-building", "Residential Zone"],
                        ["fa-shopping-cart", "Shopping"],
                        ["fa-bus", "Transport"],
                        ["fa-wifi", "WiFi"]
                    ];
                    ?>
                    <?php foreach ($facilities as $facility): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="facility-pill d-flex align-items-center justify-content-start shadow-sm p-2 px-3 rounded-pill bg-white">
                                <i class="fa-solid <?= $facility[0] ?> me-2 theme-color"></i>
                                <span class="fw-semibold text-dark"><?= $facility[1] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


        <section class="bg-light">
            <hr>
            <div class="text-center mb-4">
                <h4 class="fw-bold"><?= $college['college_name'] ?> Campus Images</h4>
                <p class="text-muted">Explore the beautiful campus of <?= $college['college_name'] ?> through our gallery.</p>
            </div>

            <div class="text-center row align-items-center container" style="max-width: 100%;">
                <!-- Carousel Section -->
                <div class="col-lg-6 mb-4">
                    <div id="campusCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $index = 0; ?>
                            <?php foreach ($campusImages as $cmps_img): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="<?= getFilePath("img/campus_images/", $cmps_img) ?>"
                                        class="d-block w-100 rounded"
                                        style="max-height: 340px; object-fit: cover;"
                                        alt="Campus Image">
                                </div>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        </div>

                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#campusCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#campusCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Google Map Section -->
                <div class="col-lg-6">
                    <div class="ratio ratio-16x9 shadow rounded">
                        <iframe src="<?= $college['google_map_link'] ?>"
                            style="border:0; max-height: 350px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </section>


        <!-- want sec  -->
        <div class="banner-part container-fluid text-center theme-bg text-white p-5 mt-5 rounded shadow">
            <h3 class="fw-bold">Ready to Begin Your Journey at <?= $college['college_name'] ?>?</h3>
            <p class="mt-2">Unlock endless opportunities and shape your future with us. Apply today and take the first step toward success!</p>
            <a href="<?= $apply_btn ?>" target="_blank" class="btn btn-light theme-color fw-bold px-4 py-2 mt-3 rounded-pill">Apply Now</a>
        </div>






    </main>
    <?php include 'php/pages/footer.php' ?>

</body>

</html>