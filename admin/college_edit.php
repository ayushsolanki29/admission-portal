<?php
include '../php/utils/db.php';
session_start();
// if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
//     header("Location:login.php");
//     exit();
// }

if (isset($_GET['edit'], $_GET['id'])) {
    $id = $_GET['id'];
    $select_colleges = "SELECT * FROM `colleges` WHERE `id` = '$id'";
    $college_result = $con->query($select_colleges);
    if ($college_result->num_rows > 0) {
        $college = $college_result->fetch_assoc();
    } else {
        echo "<script>alert('college Not Found');</script>";
        header("Location:college_list.php");
        exit();
    }
}

if (isset($_POST['edit_college'])) {

    // Get form data
    $college_id = $id; // Ensure college_id is passed for updating
    $college_name = trim($_POST['college_name']);
    $city_name = trim($_POST['city_name']);
    $district_name = trim($_POST['district_name']);
    $admission_type = isset($_POST['admission_type']) ? implode(',', $_POST['admission_type']) : '';
    $courseId = isset($_POST['courseId']) ? implode(',', $_POST['courseId']) : '';
    $desciption_of_college = trim($_POST['desciption_of_college']);
    $university_details = trim($_POST['university_details']);
    $admission_process = trim($_POST['admission_process']);
    $placement_details = trim($_POST['placement_details']);
    $median_salary = trim($_POST['median_salary']);
    $avarage_package = trim($_POST['avarage_package']);
    $highest_package = trim($_POST['highest_package']);
    $finance_type = trim($_POST['finance_type']);
    $university_name = trim($_POST['university_name']);
    $google_map_link = trim($_POST['google_map_link']);
    $total_Students = trim($_POST['total_Students']);
    $online_Students = trim($_POST['online_Students']);
    $ofline_Students = trim($_POST['ofline_Students']);
    
    // Old file paths
    $old_college_brochure = $_POST['old_college_brochure'];
    $old_college_campus = $_POST['old_college_campus'];
    $old_college_logo = $_POST['old_college_logo'];
    
    // Directories
    $college_logo_dir = "../assets/img/college/";
    $college_campus_dir = "../assets/img/campus_images/";
    $college_brochure_dir = "../assets/brochure/";

    // File upload function
    function uploadFile($file, $target_dir, $old_file) {
        if (!empty($file['name'])) {
            $file_name = uniqid() . "_" . basename($file['name']);
            $target_file = $target_dir . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $valid_extensions = ["jpg", "jpeg", "png", "gif", "pdf"];

            // Validate file type
            if (!in_array($imageFileType, $valid_extensions)) {
                return ["error" => "Invalid File Type"];
            }

            // Check MIME type
            $mime = mime_content_type($file['tmp_name']);
            if (!str_starts_with($mime, "image/") && $imageFileType !== "pdf") {
                return ["error" => "Invalid MIME Type"];
            }

            // Move file
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                if (!empty($old_file) && file_exists($target_dir . $old_file)) {
                    unlink($target_dir . $old_file); // Delete old file
                }
                return ["success" => $file_name];
            }
            return ["error" => "Failed to upload"];
        }
        return ["success" => $old_file]; // Keep old file if no new file is uploaded
    }

    // Process file uploads
    $college_logo = uploadFile($_FILES['college_logo'], $college_logo_dir, $old_college_logo);
    $college_campus = uploadFile($_FILES['college_campus'], $college_campus_dir, $old_college_campus);
    $college_brochure = uploadFile($_FILES['college_brochure'], $college_brochure_dir, $old_college_brochure);

    // Check for upload errors
    if (isset($college_logo['error']) || isset($college_campus['error']) || isset($college_brochure['error'])) {
        echo "<script>alert('File upload failed: Check file format');</script>";
        header("location: college_list.php?err=File upload failed: Check file format");
        exit;
    }

    // Prepare update query
    $stmt = $con->prepare("UPDATE colleges SET college_name = ?, city_name = ?, district_name = ?, admission_type = ?, courseId = ?, desciption_of_college = ?, university_details = ?, admission_process = ?, placement_details = ?, college_logo = ?, college_brochure = ?, median_salary = ?, avarage_package = ?, highest_package = ?, finance_type = ?, university_name = ?, total_Students = ?, online_Students = ?, ofline_Students = ?, college_campus = ?, google_map_link = ? WHERE id = ?");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param(
            "sssssssssssssssssssssi",
            $college_name,
            $city_name,
            $district_name,
            $admission_type,
            $courseId,
            $desciption_of_college,
            $university_details,
            $admission_process,
            $placement_details,
            $college_logo['success'],
            $college_brochure['success'],
            $median_salary,
            $avarage_package,
            $highest_package,
            $finance_type,
            $university_name,
            $total_Students,
            $online_Students,
            $ofline_Students,
            $college_campus['success'],
            $google_map_link,
            $college_id
        );

        // Execute query
        if ($stmt->execute()) {
            echo "<script>alert('College Updated Successfully');</script>";
            header("location: college_list.php?success=College Updated Successfully");
        } else {
            echo "<script>alert('Error Updating College');</script>";
            header("location: college_list.php?err=Error Updating College");

        }
        
        $stmt->close(); // Close statement
    } else {
        echo "<script>alert('Database Error: Failed to prepare statement');</script>";
        header("location: college_list.php?err=Database Error: Failed to prepare statement");

    }
    
    $con->close(); // Close DB connection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit college</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Edit <strong> <?= $college['college_name'] ?></strong> </h1>



                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>College Name</label>
                                    <input type="text" name="college_name" value="<?= $college['college_name'] ?>" required class="form-control" placeholder="Enter college Name Here ...">
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <label for="city_name">City Name</label>
                                        <input type="text" name="city_name" value="<?= $college['city_name'] ?>" required class="form-control" id="city_name" placeholder="Enter city Name">

                                    </div>
                                    <div class="col">
                                        <label for="district_name">District Name</label>
                                        <input type="text" name="district_name" value="<?= $college['district_name'] ?>" required class="form-control" id="district_name" placeholder="Enter District Name">

                                    </div>
                                </div>


                            </div>
                            <div class="row mt-3">

                                <div class="col">

                                    <div class="form-group">
                                        <label>Admission Type</label>
                                        <div class="form-group">
                                            <label>Admission Type</label>
                                            <div class="input-group mb-3">
                                                <?php
                                                // Convert stored admission types into an array
                                                $selected_admission_types = isset($college['admission_type']) ? explode(',', $college['admission_type']) : [];

                                                ?>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="admission_type[]" value="ACPC"
                                                            <?= in_array("ACPC", $selected_admission_types) ? 'checked' : '' ?>>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" readonly disabled value="ACPC">
                                                &nbsp;
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="admission_type[]" value="Direct Admission"
                                                            <?= in_array("Direct Admission", $selected_admission_types) ? 'checked' : '' ?>>
                                                    </div>
                                                </div>
                                                <input type="text" value="Direct Admission" readonly disabled class="form-control">
                                            </div>
                                        </div>



                                    </div>

                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Choose Courses</label>
                                        <select class="form-control courses_select" name="courseId[]" required multiple>
                                            <option disabled>Select Courses</option>
                                            <?php
                                            // Convert stored course IDs into an array
                                            $selected_courses = isset($college['courseId']) ? explode(',', $college['courseId']) : [];

                                            // Fetch all courses from the database
                                            $select_courses = mysqli_query($con, "SELECT `id`, `course_name` FROM `courses` ORDER BY `id` DESC");
                                            if ($select_courses) {
                                                while ($courses = mysqli_fetch_array($select_courses)) {
                                                    // Check if the course ID is in the selected courses array
                                                    $selected = in_array($courses['id'], $selected_courses) ? 'selected' : '';
                                            ?>
                                                    <option value="<?= $courses['id'] ?>" <?= $selected ?>><?= $courses['course_name'] ?></option>
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
                                    <textarea class="form-control" name="desciption_of_college" required id="textarea" rows="5" placeholder="e.g., Like IIT Madras B.Tech, BS + MS and B.Tech+M.Tech admission is based on JEE Advanced and JEE Main. The college offers 92 courses at the PG and UG levels. For admission to the MBA registration is open, furthermore, CAT 2025 will be held on November 30, 2025. IIT Madras fees range from Rs 5,000 to Rs 3,00,000 annually"><?= $college['desciption_of_college'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col">
                                    <label for="textarea">University Details</label>
                                    <textarea class="form-control" name="university_details" required id="textarea" rows="5" placeholder="e.g., Institute of Technology Madras was established in 1959. As per the QS World University Ranking, IIT Madras bagged the 526th. IIT Madras campus is spread across 630 acres of land and has over 550 faculty, 9700 students and 1250 administrative & supporting staff. IITM courses are spread across 16 academic departments. It offers multiple courses at the undergraduate, postgraduate and doctoral levels. Apart from the regular courses, it also offers an online B.Sc programme. IIT Chennai admissions in all these programmes are done based on entrance exams. UG admissions are done through JEE Advanced, and admission to the MA and M.Tech programmes are done through GATE. Candidates willing to take admission in the MBA and M.Sc programme need to appear for CAT and JAM respectively."><?= $college['university_details'] ?></textarea>
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

The candidate must pass specified English skills tests, entrance examination cut-offs, and other requirements for specific courses. They will also have to upload their videos through the PI and GD rounds scheduled in an online form on Skype."><?= $college['admission_process'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="textarea">Placement Details</label>
                                    <textarea class="form-control" name="placement_details" required id="textarea" rows="5" placeholder="e.g.,Amity’s placement record continues a legacy of excellence, with over 1,50,000 Amity graduates working in leading organisations throughout the world. More than 500 prominent companies including the Fortune 500 companies visit the campus for the Amity University Punjab Placements process."><?= $college['placement_details'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col">
                                    <label for="exampleFormControlSelect1">College Logo</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="college_logo" class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Logo</label>
                                        </div>
                                    </div>
                                    <img src="../assets/img/college/<?= $college['college_logo'] ?>" class="img-thumbnail img-fluid mt-2" width="100" alt="">

                                </div>

                                <div class="col">
                                    <label for="exampleFormControlSelect1">Campus Image</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="college_campus" class="custom-file-input" id="inputGroupFile05">
                                            <label class="custom-file-label" for="inputGroupFile05">Choose Campus Image</label>
                                        </div>
                                    </div>
                                    <img src="../assets/img/campus_images/<?= $college['college_campus'] ?>" class="img-thumbnail img-fluid mt-2" width="100" alt="">
                                </div>

                                <div class="col">
                                    <label for="exampleFormControlSelect1">College Brochure</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="college_brochure" class="custom-file-input" id="inputGroupFile05">
                                            <label class="custom-file-label" for="inputGroupFile05">Choose Brochure</label>
                                        </div>
                                    </div>
                                    <a href="../assets/brochure/<?= $college['college_brochure'] ?>" class="text-primary mt-2" target="blank">Check</a>
                                </div>
                            </div>
                            <input type="hidden" value="<?= $college['college_brochure'] ?>" name="old_college_brochure">
                            <input type="hidden" value="<?= $college['college_campus'] ?>" name="old_college_campus">
                            <input type="hidden" value="<?= $college['college_logo'] ?>" name="old_college_logo">

                            <small id="discountHelpBlock" class="form-text text-muted info-text">
                                Image should be in jpg, jpeg, png, gif format. <br> Campus Image Format :<strong>700px (width) x 500px (Height)</strong>
                                <br> College Logo Format :<strong>120px (width) x 120px (Height)</strong>
                            </small>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="median_salary">Median Salary</label>
                                            <input type="text" name="median_salary" value="<?= $college['median_salary'] ?>" required class="form-control" id="median_salary" placeholder="Enter Median Salary">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="avarage_package">Avarage Package</label>
                                            <input type="text" name="avarage_package" value="<?= $college['avarage_package'] ?>" required class="form-control" id="avarage_package" placeholder="Enter Avarage Package">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="highest_package">Highest Package</label>
                                            <input type="text" name="highest_package" value="<?= $college['highest_package'] ?>" required class="form-control" id="highest_package" placeholder="Enter Highest Package">
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
                                            <input type="text" name="finance_type" value="<?= $college['finance_type'] ?>" required class="form-control" id="finance_type" placeholder="Enter Finance Type">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="university_name">University Name</label>
                                            <input type="text" name="university_name" value="<?= $college['university_name'] ?>" required class="form-control" id="university_name" placeholder="Enter University Name">
                                        </div>
                                    </div>

                                </div>
                                <!-- <small id="discountHelpBlock" class="form-text text-muted info-text">
                                    For example, if the original price is ₹100 and you want to sell it for ₹80, enter 20 as the discount (20% off).
                                </small> -->
                            </div>

                            <div class="form-group">
                                <label for="google_map_link">Google Map Link</label>
                                <input type="text" name="google_map_link" value="<?= $college['google_map_link'] ?>" required class="form-control" id="google_map_link" placeholder="Enter Google Map  Link">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="total_Students">Total Students</label>
                                            <input type="number" value="<?= $college['total_Students'] ?>" name="total_Students" required class="form-control" id="total_Students" placeholder="Enter Total Students" oninput="countStudents()">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="online_Students">Online Students</label>
                                            <input type="number" value="<?= $college['online_Students'] ?>" name="online_Students" required class="form-control" id="online_Students" placeholder="Enter Online Students" oninput="countStudents()">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="ofline_Students">Ofline Students</label>
                                            <input type="number" value="<?= $college['ofline_Students'] ?>" readonly name="ofline_Students" required class="form-control" id="ofline_Students" placeholder="Enter Ofline Students">
                                        </div>
                                    </div>
                                </div>
                                <!-- <small id="discountHelpBlock" class="form-text text-muted info-text">
    For example, if the original price is ₹100 and you want to sell it for ₹80, enter 20 as the discount (20% off).
</small> -->
                            </div>
                            <button type="submit" name="edit_college" class="btn btn-primary">Edit college</button>
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