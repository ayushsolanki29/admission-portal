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
                                <div class="col">
                                    <label for="city">City Name</label>
                                    <input type="text" name="city" required class="form-control" id="city" placeholder="Enter city Name">

                                </div>


                            </div>
                            <div class="row mt-3">

                                <div class="col">
                                    <label for="exampleFormControlSelect1">College Logo</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnail" required class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Logo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
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
                            <div class="form-group row">
                                <div class="col">
                                    <label for="textarea">Description</label>
                                    <textarea class="form-control" name="desciption" required id="textarea" rows="1" placeholder="Enter Description here"></textarea>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Choose Cources</label>
                                        <select class="form-control " name="courcesId[]" required>
                                            <option>Select Cources</option>
                                            <option value="2">NO Cource Availble</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="finance">Finance Type</label>
                                            <input type="text" name="finance" required class="form-control" id="finance" placeholder="Enter Finance Type">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="university">University</label>
                                            <input type="text" name="university" required class="form-control" id="university" placeholder="Enter University Name">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Final">Transportation</label>
                                            <select class="form-control " name="transportation" required>
                                                <option disabled>Select Transportation</option>
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