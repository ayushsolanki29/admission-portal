<?php

session_start();
// if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
//     header("Location:login.php");
//     exit();
// }

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
                                    <label>Course Name</label>
                                    <input type="text" name="course_name" required class="form-control" placeholder="Enter Course Name Here ...">
                                </div>


                                <div class="col">
                                    <label for="fees">Fees</label>
                                    <input type="text" name="fees" required class="form-control" id="fees" placeholder="Enter Fees">

                                </div>





                                <div class="col">
                                    <label for="exampleFormControlSelect1">Course Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnail" required class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Course Logo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <label for="finance">Department</label>
                                            <input type="text" name="finance" required class="form-control" id="finance" placeholder="Enter Finance Type">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="university">Eligibility</label>
                                            <input type="text" name="university" required class="form-control" id="university" placeholder="Enter University Name">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select class="form-control " name="department" required>
                                                <option disabled>Select Department</option>
                                                <option value="Yes" selected>Yes</option>
                                                <option value="No">No</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <small id="discountHelpBlock" class="form-text text-muted info-text">
                                    For example, if the original price is ₹100 and you want to sell it for ₹80, enter 20 as the discount (20% off).
                                </small> -->
                            </div>

                            <button type="submit" name="addcollege" class="btn btn-primary">Add college</button>
                    </form>
                </div>
            </div>

            <?php include 'php/pages/footer.php' ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(document).ready(function() {
                    // $(".categorySelect").chosen();


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