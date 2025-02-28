<?php include 'php/utils/db.php';

// Function to safely get file paths
function getFilePath($folder, $file)
{
    return "assets/{$folder}/" . htmlspecialchars($file, ENT_QUOTES, 'UTF-8');
}

// Function to process comma-separated values
function parseCSV($string)
{
    return array_filter(array_map('trim', explode(' | ', $string)));
}

// Check if 'u' parameter is set
if (isset($_GET['u'])) {
    $tagId = $_GET['u'];

    // Fetch college details (excluding courses and campus images)
    $stmt = $con->prepare("
        SELECT * FROM colleges WHERE tag_id = ?
    ");
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
        SELECT course_name, short_form, fees, duration_of_Course, study_mode, 
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

                    <a href="" class="btn p-2 px-5" style="border:2px solid #EB571C; background-color: #EB571C; color: white; border-radius:40px;">Apply Now</a>
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
        <!-- second end section -->

        <!-- banner-download-part  -->


        <!-- banner-do -->
        <div class="banner-part container-fluid mr-5">
            <h3>Want To Know About <?= $college['college_name'] ?></h3>
            <a href="assets/brochure/<?= $college['college_brochure'] ?>" download="<?php echo $college['college_name'] . ' Brochure' ?> " class="b-b">Download Brochure</a>
        </div>

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
                                <button class="btn filled">Talk to Experts</button>
                                <button class="btn  outline">Download Brochure</button>
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
        <div class="banner-part1" style="align-items: start; justify-content: start; height: auto;">
            <h4 class="text-start mt-2"> <?= $college['college_name'] ?> Packages</h4>

            <div class="banner-part2">
                <div class="box">
                    <p>Median Salary</p>
                    <h5 class="highlight"><?= $college['median_salary'] ?></h5>
                </div>
                <div class="box">
                    <p>Average Package</p>
                    <h5 class="highlight"><?= $college['avarage_package'] ?></h5>
                </div>
                <div class="box">
                    <p>Highest Package</p>
                    <h5 class="highlight"><?= $college['highest_package'] ?></h5>
                </div>
            </div>



        </div>

        <!-- connet-sec  -->

        <div class="container-fluid connet-secd">
            <div class="banner">
                <div class="banner-content p-2">
                    <h5>Are you Confused? Talk to <?= $college['college_name'] ?> Expert</h5>
                    <p>Who offers personalized guidance, mentorship, and invaluable insights tailored to your academic and career aspirations.</p>
                    <button class="banner-button1">Connect Now</button>
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



        <div class="container-fluid d-flex justify-content-center align-items-center mt-3 ">
            <!-- <h1>adan</h1> -->
            <div class="container container-custom shadow-lg">
                <h2 class="text-start fw-bold mb-4  ">Campus Facilities</h2>
                <div class="row g-2">
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-book-open"></i> Academic Zone</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-money-check-alt"></i> ATM</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-bed"></i> Boys Hostel</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-utensils"></i> Canteen</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-desktop"></i> Computer Lab</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-bed"></i> Girls Hostel</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-burger"></i> Mess</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-book"></i> Library</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-hospital"></i> Medical Facilities</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-chalkboard-teacher"></i> Classroom</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-briefcase"></i> Placement</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-futbol"></i> Sports</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-envelope"></i> Post Office</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-flask"></i> R&D</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-university"></i> Residential Institute</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-home"></i> Residential Zone</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-building"></i> Residential Zone</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-shopping-cart"></i> Shopping</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-bus"></i> Transport</div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="facility"><i class="fa-solid fa-wifi"></i> WiFi</div>
                    </div>
                    <!-- <div class="col-6 col-md-4 col-lg-3"><div class="facility"><i class="fa-solid fa-shirt"></i> Laundry</div></div> -->
                </div>
            </div>
        </div>


        <div class="container-fluid w-50 mt-3">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $index = 1; // Start index from 1 
                    ?>
                    <?php foreach ($campusImages as $cmps_img): ?>
                        <div class="carousel-item <?= $index === 1 ? 'active' : '' ?>">
                            <img src="<?= getFilePath("img/campus_images/", $cmps_img) ?>" class="d-block w-100" style="max-width: 800px;" alt="">
                        </div>
                        <?php $index++; ?>
                    <?php endforeach; ?>


                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- want sec  -->
        <div class="banner-part container-fluid p-5 mt-5">
            <h3>So Are you Want To Apply in <?= $college['college_name'] ?></h3>
            <button class="b-b">Apply Now </button>
        </div>






    </main>
    <?php include 'php/pages/footer.php' ?>

</body>

</html>