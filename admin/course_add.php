<?php

session_start();
include '../php/utils/db.php';
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['add_course'])) {
    $course_name = $_POST['course_name'];
    $course_shortName = $_POST['course_shortName'];
    $fees = $_POST['fees'];
    $duration_of_Course = $_POST['duration_of_Course'];
    $study_mode = $_POST['study_mode'];
    $enterance_exam = $_POST['enterance_exam'];
    $eligibility = $_POST['eligibility'];
    $department = $_POST['department'];
    $course_thumbnail = $_FILES['course_thumbnail']['name'];
    $target_dir = "../assets/img/course/";
    $course_thumbnail = uniqid() . "_" . $course_thumbnail;
    $target_file = $target_dir . basename($_FILES["course_thumbnail"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $extensions_arr)) {
        $sql = "INSERT INTO `courses`(`course_name`,`short_form` ,`fees`, `duration_of_Course`, `study_mode`, `enterance_exam`, `eligibility`, `department`, `course_thumbnail`) VALUES ('$course_name','$course_shortName','$fees','$duration_of_Course','$study_mode','$enterance_exam','$eligibility','$department','$course_thumbnail')";
        if ($con->query($sql) === TRUE) {
            move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], $target_dir . $course_thumbnail);
            echo "<script>alert('Course Added Successfully');</script>";
        } else {
            echo "<script>alert('Error Adding Course');</script>";
        }
    } else {
        echo "<script>alert('Invalid File Type');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add New course</title>
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

                    <h1 class="h3 mb-4 text-gray-800">Add New course</h1>



                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Course Full Name</label>
                                    <input type="text" name="course_name" required class="form-control" placeholder="Enter Course Full Name Here ...">
                                </div>
                                <div class="col">
                                    <label>Course Short Name</label>
                                    <input type="text" name="course_shortName" required class="form-control" placeholder="Enter Course short Name Here ...">
                                </div>

                                <div class="col">
                                    <label for="fees">Fees</label>
                                    <input type="text" name="fees" required class="form-control" id="fees" placeholder="Enter Fees">

                                </div>

                                <div class="col">
                                    <label for="exampleFormControlSelect1">Course Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="course_thumbnail" required class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Course Logo</label>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <small id="discountHelpBlock" class="form-text text-muted info-text">
                                Image should be in jpg, jpeg, png, gif format. <br> Image Format :<strong>400px (width) x 244px (Height)</strong>
                            </small>
                            <div class="form-group mt-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="duration_of_Course">Duration of Course</label>
                                            <input type="text" name="duration_of_Course" required class="form-control" id="duration_of_Course" placeholder="Enter Duration of Course">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="study_mode">Study Mode</label>
                                            <input type="text" name="study_mode" required class="form-control" id="study_mode" placeholder="Enter Study Mode">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="enterance_exam">Enterance Exam</label>
                                            <input type="text" name="enterance_exam" required class="form-control" id="enterance_exam" placeholder="Enter Enterance Exam">
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
                                            <label for="eligibility">Eligibility</label>
                                            <input type="text" name="eligibility" required class="form-control" id="eligibility" placeholder="Enter Eligibility">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select class="form-control " name="department" required>
                                                <option disabled selected>Select Department</option>
                                                <?php
                                                $select_department = "SELECT `department_name` FROM `department` ORDER BY `department`.`id` DESC";
                                                $department_result = $con->query($select_department);
                                                if ($department_result->num_rows > 0) {
                                                    while ($row = $department_result->fetch_assoc()) {
                                                        echo '<option value="' . $row['department_name'] . '">' . $row['department_name'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">No Department Found</option>';
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <small id="discountHelpBlock" class="form-text text-muted info-text">
                                    For example, if the original price is ₹100 and you want to sell it for ₹80, enter 20 as the discount (20% off).
                                </small> -->
                            </div>

                            <button type="submit" name="add_course" class="btn btn-primary">Add Course</button>
                    </form>
                </div>
            </div>

            <?php include 'php/pages/footer.php' ?>