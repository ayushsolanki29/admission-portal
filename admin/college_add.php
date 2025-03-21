<?php
include '../php/utils/db.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_college'])) {

    $college_name = trim($_POST['college_name']);
    $city_name = trim($_POST['city_name']);
    $district_name = trim($_POST['district_name']);
    $admission_type = isset($_POST['admission_type']) ? implode(',', $_POST['admission_type']) : '';
    $courseId = isset($_POST['courseId']) ? implode(',', $_POST['courseId']) : '';
    $description_of_college = trim($_POST['desciption_of_college']);
    $university_details = trim($_POST['university_details']);
    $admission_process = trim($_POST['admission_process']);
    $placement_details = trim($_POST['placement_details']);
    $median_salary = trim($_POST['median_salary']);
    $average_package = trim($_POST['avarage_package']);
    $highest_package = trim($_POST['highest_package']);
    $finance_type = trim($_POST['finance_type']);
    $university_name = trim($_POST['university_name']);
    $total_Students = trim($_POST['total_Students']);
    $online_Students = trim($_POST['online_Students']);
    $offline_Students = trim($_POST['ofline_Students']);
    $google_map_link = trim($_POST['google_map_link']);
    $tag_id = uniqid();

    // File directories
    $college_logo_dir = "../assets/img/college/";
    $college_brochure_dir = "../assets/brochure/";
    $college_campus_dir = "../assets/img/campus_images/";

    // Upload file function using only $_FILES[]
    function uploadFile($file, $target_dir)
    {
        if ($file['error'] == 0) {
            $file_name = uniqid() . "_" . basename($file['name']);
            $target_file = $target_dir . $file_name;
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                return $file_name;
            }
        }
        return null;
    }

    // Process file uploads
    $college_logo = isset($_FILES['college_logo']) && $_FILES['college_logo']['error'] == 0 ? uploadFile($_FILES['college_logo'], $college_logo_dir) : '';
    $college_brochure = isset($_FILES['college_brochure']) && $_FILES['college_brochure']['error'] == 0 ? uploadFile($_FILES['college_brochure'], $college_brochure_dir) : '';
    $college_campus = isset($_FILES['college_campus']) && $_FILES['college_campus']['error'] == 0 ? uploadFile($_FILES['college_campus'], $college_campus_dir) : '';

    // Construct SQL query
    $sql = "INSERT INTO colleges (college_name, city_name, district_name, admission_type, courseId, desciption_of_college, university_details, admission_process, placement_details, college_logo, college_brochure, median_salary, avarage_package, highest_package, finance_type, university_name, total_Students, online_Students, ofline_Students, tag_id, college_campus, google_map_link) 
            VALUES ('$college_name', '$city_name', '$district_name', '$admission_type', '$courseId', '$description_of_college', '$university_details', '$admission_process', '$placement_details', '$college_logo', '$college_brochure', '$median_salary', '$average_package', '$highest_package', '$finance_type', '$university_name', '$total_Students', '$online_Students', '$offline_Students', '$tag_id', '$college_campus', '$google_map_link')";

    if ($con->query($sql) === TRUE) {
        header("location:college_list.php?success=College Added Successfully!");
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add New college</title>
    <?php include 'php/pages/head.php' ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top">

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div id="wrapper">
        <?php include 'php/pages/sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <?php include 'php/pages/nav.php' ?>
                <div class="container-fluid">

                    <h1 class="h3 mb-4 text-gray-800">Add New College</h1>



                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>College Name</label>
                                    <input type="text" name="college_name" required class="form-control" placeholder="Enter college Name Here ...">
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <label for="city_name">City Name</label>
                                        <input type="text" name="city_name" required class="form-control" id="city_name" placeholder="Enter city Name">

                                    </div>
                                    <div class="col">
                                        <label for="district_name">District Name</label>
                                        <input type="text" name="district_name" required class="form-control" id="district_name" placeholder="Enter District Name">

                                    </div>
                                </div>


                            </div>
                            <div class="row mt-3">

                                <div class="col">
                                    <div class="form-group">
                                        <label>Admission Type</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" name="admission_type[]" value="ACPC">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" readonly disabled value="ACPC">
                                            &nbsp;
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" name="admission_type[]" value="Direct Admission" checked>
                                                </div>
                                            </div>
                                            <input type="text" value="Direct Admission" readonly disabled class="form-control" aria-label="Text input with checkbox">
                                        </div>
                                    </div>

                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">choose Courses</label>
                                        <select class="form-control courses_select" name="courseId[]" required multiple>
                                            <option disabled>select Courses</option>
                                            <?php
                                            $select_courses = mysqli_query($con, "SELECT `id`, `course_name` FROM `courses` ORDER BY `id` DESC ");
                                            if ($select_courses) {
                                                while ($courses = mysqli_fetch_array($select_courses)) { ?>
                                                    <option value="<?= $courses['id'] ?>"><?= $courses['course_name'] ?></option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="textarea">Description of College</label>
                                    <textarea class="form-control" name="desciption_of_college" required id="textarea" rows="5" placeholder="e.g., Like IIT Madras B.Tech, BS + MS and B.Tech+M.Tech admission is based on JEE Advanced and JEE Main. The college offers 92 courses at the PG and UG levels. For admission to the MBA registration is open, furthermore, CAT 2025 will be held on November 30, 2025. IIT Madras fees range from Rs 5,000 to Rs 3,00,000 annually"></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col">
                                    <label for="textarea">University Details</label>
                                    <textarea class="form-control" name="university_details" required id="textarea" rows="5" placeholder="e.g., Institute of Technology Madras was established in 1959. As per the QS World University Ranking, IIT Madras bagged the 526th. IIT Madras campus is spread across 630 acres of land and has over 550 faculty, 9700 students and 1250 administrative & supporting staff. IITM courses are spread across 16 academic departments. It offers multiple courses at the undergraduate, postgraduate and doctoral levels. Apart from the regular courses, it also offers an online B.Sc programme. IIT Chennai admissions in all these programmes are done based on entrance exams. UG admissions are done through JEE Advanced, and admission to the MA and M.Tech programmes are done through GATE. Candidates willing to take admission in the MBA and M.Sc programme need to appear for CAT and JAM respectively."></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col">
                                    <label for="textarea">Admission Process</label>
                                    <textarea class="form-control" name="admission_process" required id="textarea" rows="5" placeholder="e.g., mity University Punjab Selection Criteria
Amity University Punjab offers 20+ programmes at the UG, PG, and doctorate levels. These courses are provided under various streams, including science, management, law, commerce, and many others. 

Apart from these courses, it also provides a Study Abroad Programme (SAP), allowing students to take a five-week course at Amity's campuses in London, Singapore, Dubai, and New York. When it comes to job placements, the university has had 500 firms participate and has placed a total of 8,000 students. 

As part of India's biggest Scholarship Programme, Amity University has also provided up to 100% scholarships to 25,000 deserving students.

Amity University Punjab is now taking applications for the 2024 academic year. Interested candidates can apply online through the website.

> Class 12 Marks

Candidates who have scored 80% or above in 10+2 would get a direct entry for the Amity University Punjab courses. They need to do nothing more than fill out an application form and pay the application fees. The Class 12 marks alone have become a qualifying condition for many courses. 

> Entrance exams

For certain courses at AUP students have to appear for state level and national level entrance exams. Selection is made based on the candidate’s rank.

>Others

The candidate must pass specified English skills tests, entrance examination cut-offs, and other requirements for specific courses. They will also have to upload their videos through the PI and GD rounds scheduled in an online form on Skype."></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="textarea">Placement Details</label>
                                    <textarea class="form-control" name="placement_details" required id="textarea" rows="5" placeholder="e.g.,Amity’s placement record continues a legacy of excellence, with over 1,50,000 Amity graduates working in leading organisations throughout the world. More than 500 prominent companies including the Fortune 500 companies visit the campus for the Amity University Punjab Placements process."></textarea>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col">
                                    <label for="exampleFormControlSelect1">College Logo</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="college_logo" required class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Logo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="exampleFormControlSelect1">Campus Image</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="college_campus" required class="custom-file-input" id="inputGroupFile05">
                                            <label class="custom-file-label" for="inputGroupFile05">Choose Campus Image</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="exampleFormControlSelect1">College Brochure</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="college_brochure" required class="custom-file-input" id="inputGroupFile05">
                                            <label class="custom-file-label" for="inputGroupFile05">Choose Brochure</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <small id="discountHelpBlock" class="form-text text-muted info-text">
                                Image should be in jpg, jpeg, png, gif format. <br> Campus Image Format :<strong>700px (width) x 500px (Height)</strong>
                                <br> College Logo Format :<strong>120px (width) x 120px (Height)</strong>
                            </small>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="median_salary">Median Salary</label>
                                            <input type="text" name="median_salary" required class="form-control" id="median_salary" placeholder="Enter Median Salary">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="avarage_package">Avarage Package</label>
                                            <input type="text" name="avarage_package" required class="form-control" id="avarage_package" placeholder="Enter Avarage Package">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="highest_package">Highest Package</label>
                                            <input type="text" name="highest_package" required class="form-control" id="highest_package" placeholder="Enter Highest Package">
                                        </div>
                                    </div>
                                </div>
                                <!-- <small id="discountHelpBlock" class="form-text text-muted info-text">
                                    For example, if the original price is ₹100 and you want to sell it for ₹80, enter 20 as the discount (20% off).
                                </small> -->
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="finance_type">Finance Type</label>
                                            <input type="text" name="finance_type" required class="form-control" id="finance_type" placeholder="Enter Finance Type">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="university_name">University Name</label>
                                            <input type="text" name="university_name" required class="form-control" id="university_name" placeholder="Enter University Name">
                                        </div>
                                    </div>

                                </div>
                                <!-- <small id="discountHelpBlock" class="form-text text-muted info-text">
                                    For example, if the original price is ₹100 and you want to sell it for ₹80, enter 20 as the discount (20% off).
                                </small> -->
                            </div>

                            <div class="form-group">
                                <label for="google_map_link">Google Map Link</label>
                                <input type="text" name="google_map_link" required class="form-control" id="google_map_link" placeholder="Enter Google Map  Link">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="total_Students">Total Students</label>
                                            <input type="number" name="total_Students" required class="form-control" id="total_Students" placeholder="Enter Total Students" oninput="countStudents()">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="online_Students">Online Students</label>
                                            <input type="number" name="online_Students" required class="form-control" id="online_Students" placeholder="Enter Online Students" oninput="countStudents()">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="ofline_Students">Ofline Students</label>
                                            <input type="number" readonly name="ofline_Students" required class="form-control" id="ofline_Students" placeholder="Enter Ofline Students">
                                        </div>
                                    </div>
                                </div>
                                <!-- <small id="discountHelpBlock" class="form-text text-muted info-text">
    For example, if the original price is ₹100 and you want to sell it for ₹80, enter 20 as the discount (20% off).
</small> -->
                            </div>
                            <button type="submit" name="add_college" class="btn btn-primary">Add college</button>
                    </form>
                </div>
            </div>

            <?php include 'php/pages/footer.php' ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(document).ready(function() {
                    $(".courses_select").chosen();



                    function countStudents() {
                        let total_Students = parseInt($('#total_Students').val());
                        let online_Students = parseInt($('#online_Students').val());

                        if (!isNaN(total_Students) && !isNaN(online_Students)) {
                            let ofline_Students = total_Students - online_Students;
                            $('#ofline_Students').val(parseInt(ofline_Students));
                        } else {
                            $('#ofline_Students').val('');
                        }
                    }


                    $('#total_Students, #online_Students').on('input', countStudents);
                });
            </script>