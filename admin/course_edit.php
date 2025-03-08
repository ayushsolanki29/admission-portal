<?php

session_start();
include '../php/utils/db.php';
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}
if (isset($_GET['edit'], $_GET['id'])) {
    $id = $_GET['id'];
    $select_course = "SELECT * FROM `courses` WHERE `id` = '$id'";
    $course_result = $con->query($select_course);
    if ($course_result->num_rows > 0) {
        $course = $course_result->fetch_assoc();
    } else {
        echo "<script>alert('Course Not Found');</script>";
        header("Location:course_list.php");
        exit();
    }
}
if (isset($_POST['edit_course'])) {
    $course_id = $id; // Assuming you're passing course_id for updating
    $course_name = $_POST['course_name'];
    $course_shortName = $_POST['course_shortName'];
    $fees = $_POST['fees'];
    $duration_of_Course = $_POST['duration_of_Course'];
    $study_mode = $_POST['study_mode'];
    $enterance_exam = $_POST['enterance_exam'];
    $eligibility = $_POST['eligibility'];
    $department = $_POST['department'];

    // Existing image data
    $old_course_thumbnail = $_POST['old_course_thumbnail'];

    // File Upload Logic
    $course_thumbnail = $_FILES['course_thumbnail']['name'];
    $target_dir = "../assets/img/course/";

    if (!empty($course_thumbnail)) {
        $course_thumbnail = uniqid() . "_" . $course_thumbnail;
        $target_file = $target_dir . basename($_FILES["course_thumbnail"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $extensions_arr)) {
            // Delete old file if a new one is uploaded
            if (!empty($old_course_thumbnail) && file_exists($target_dir . $old_course_thumbnail)) {
                unlink($target_dir . $old_course_thumbnail);
            }
            move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], $target_dir . $course_thumbnail);
        } else {
            echo "<script>alert('Invalid File Type');</script>";
            exit;
        }
    } else {
        // If no new image is uploaded, keep the old one
        $course_thumbnail = $old_course_thumbnail;
    }

    // Update Query
    $sql = "UPDATE `courses` SET 
            `course_name`='$course_name', 
            `short_form`='$course_shortName', 
            `fees`='$fees', 
            `duration_of_Course`='$duration_of_Course', 
            `study_mode`='$study_mode', 
            `enterance_exam`='$enterance_exam', 
            `eligibility`='$eligibility', 
            `department`='$department', 
            `course_thumbnail`='$course_thumbnail'
            WHERE `id`='$course_id'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Course Updated Successfully');</script>";
        header("location:course_list.php?success=Course Updated Successfully");
    } else {
        echo "<script>alert('Error Updating Course');</script>";
        header("location:course_list.php?err=Error Updating Course");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit course</title>
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

                    <h1 class="h3 mb-4 text-gray-800">Edit <?= $course['course_name'] ?></h1>



                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Course Full Name</label>
                                    <input type="text" name="course_name" value="<?= $course['course_name'] ?>" required class="form-control" placeholder="Enter Course Full Name Here ...">
                                </div>
                                <div class="col">
                                    <label>Course Short Name</label>
                                    <input type="text" value="<?= $course['short_form'] ?>" name="course_shortName" required class="form-control" placeholder="Enter Course short Name Here ...">
                                </div>

                                <div class="col">
                                    <label for="fees">Fees</label>
                                    <input type="text" name="fees" value="<?= $course['fees'] ?>" required class="form-control" id="fees" placeholder="Enter Fees">

                                </div>

                                <div class="col">
                                    <label for="exampleFormControlSelect1">Course Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="course_thumbnail" class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Course Logo</label>
                                        </div>
                                    </div>
                                    <img src="../assets/img/course/<?= $course['course_thumbnail'] ?>" class="img-thumbnail img-fluid mt-2" width="100" alt="">
                                    <input type="hidden" name="old_course_thumbnail" value="<?= $course['course_thumbnail'] ?>">
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
                                            <input type="text" value="<?= $course['duration_of_Course'] ?>" name="duration_of_Course" required class="form-control" id="duration_of_Course" placeholder="Enter Duration of Course">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="study_mode">Study Mode</label>
                                            <input type="text" value="<?= $course['study_mode'] ?>" name="study_mode" required class="form-control" id="study_mode" placeholder="Enter Study Mode">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="enterance_exam">Enterance Exam</label>
                                            <input type="text" value="<?= $course['enterance_exam'] ?>" name="enterance_exam" required class="form-control" id="enterance_exam" placeholder="Enter Enterance Exam">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="eligibility">Eligibility</label>
                                            <input type="text" value="<?= $course['eligibility'] ?>" name="eligibility" required class="form-control" id="eligibility" placeholder="Enter Eligibility">
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
                                                    while ($row = $department_result->fetch_assoc()) { ?>
                                                        <option <?= $course['department'] === $row['department_name'] ? 'selected' : '' ?> value="<?= $row['department_name'] ?>"><?= $row['department_name'] ?></option>
                                                <?php }
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

                            <button type="submit" name="edit_course" class="btn btn-primary">Update Course</button>
                    </form>
                </div>
            </div>

            <?php include 'php/pages/footer.php' ?>