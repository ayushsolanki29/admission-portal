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
                                <div class="row">

                                    <div class="col">
                                        <label for="city">City Name</label>
                                        <input type="text" name="city" required class="form-control" id="city" placeholder="Enter city Name">

                                    </div>
                                    <div class="col">
                                        <label for="district">District Name</label>
                                        <input type="text" name="district" required class="form-control" id="district" placeholder="Enter District Name">

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
                                        <label for="exampleFormControlSelect1">Choose Cources</label>
                                        <select class="form-control " name="courcesId[]" required>
                                            <option>Select Cources</option>
                                            <option value="2">NO Cource Availble</option>

                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="textarea">Description of College</label>
                                    <textarea class="form-control" name="desciption" required id="textarea" rows="5" placeholder="e.g., Like IIT Madras B.Tech, BS + MS and B.Tech+M.Tech admission is based on JEE Advanced and JEE Main. The college offers 92 courses at the PG and UG levels. For admission to the MBA registration is open, furthermore, CAT 2025 will be held on November 30, 2025. IIT Madras fees range from Rs 5,000 to Rs 3,00,000 annually"></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col">
                                    <label for="textarea">About University Details</label>
                                    <textarea class="form-control" name="desciption" required id="textarea" rows="5" placeholder="e.g., Institute of Technology Madras was established in 1959. As per the QS World University Ranking, IIT Madras bagged the 526th. IIT Madras campus is spread across 630 acres of land and has over 550 faculty, 9700 students and 1250 administrative & supporting staff. IITM courses are spread across 16 academic departments. It offers multiple courses at the undergraduate, postgraduate and doctoral levels. Apart from the regular courses, it also offers an online B.Sc programme. IIT Chennai admissions in all these programmes are done based on entrance exams. UG admissions are done through JEE Advanced, and admission to the MA and M.Tech programmes are done through GATE. Candidates willing to take admission in the MBA and M.Sc programme need to appear for CAT and JAM respectively."></textarea>
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
                            <div class="form-group ">
                                <div class="col">
                                    <label for="textarea">About University Details</label>
                                    <textarea class="form-control" name="about_university_details" required id="textarea" rows="5" placeholder="e.g., Institute of Technology Madras was established in 1959. As per the QS World University Ranking, IIT Madras bagged the 526th. IIT Madras campus is spread across 630 acres of land and has over 550 faculty, 9700 students and 1250 administrative & supporting staff. IITM courses are spread across 16 academic departments. It offers multiple courses at the undergraduate, postgraduate and doctoral levels. Apart from the regular courses, it also offers an online B.Sc programme. IIT Chennai admissions in all these programmes are done based on entrance exams. UG admissions are done through JEE Advanced, and admission to the MA and M.Tech programmes are done through GATE. Candidates willing to take admission in the MBA and M.Sc programme need to appear for CAT and JAM respectively."></textarea>
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
                                            <input type="file" name="thumbnail" required class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Logo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlSelect1">College Brochure</label>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnail" required class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Brochure</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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