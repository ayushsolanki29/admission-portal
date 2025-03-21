<?php
session_start();
include '../php/utils/db.php';
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['add_fees_structure'])) {
    // Database connection (Assuming $con is your MySQL connection)

    $college_id = $_POST['college_id'];
    $course_ids = $_POST['course_id']; // Array of course IDs
    $fees_values = $_POST['fees']; // Array of fees

    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO fees (college_id, course_id, fees) VALUES (?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("iis", $college_id, $course_id, $fees);

    // Loop through courses and fees to insert data
    foreach ($course_ids as $index => $course_id) {
        $fees = $fees_values[$index];
        $stmt->execute();
    }

    // Close the statement
    $stmt->close();

    echo "<script>alert('fees Added Successfully');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Fees</title>
    <?php include 'php/pages/head.php' ?>

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

                    <h1 class="h3 mb-4 text-gray-800">Add Fees</h1>
                    <form method="get">
                        <div class="form-group">

                            <?php if (!isset($_GET['college_id'])) { ?>
                                <label>Select College Name</label>
                                <select class="form-control" name="college_id" required>
                                    <option disabled selected>Select college</option>
                                    <?php
                                    $college_name = "SELECT `id`, `college_name`, `courseId` FROM `colleges` ORDER BY `id` DESC";
                                    $college_result = $con->query($college_name);
                                    if ($college_result->num_rows > 0) {
                                        while ($row = $college_result->fetch_assoc()) {
                                            echo '<option value="' . $row['id'] . '" data-courses="' . $row['courseId'] . '">' . $row['college_name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="0">No college Found</option>';
                                    }
                                    ?>
                                </select>
                            <?php }
                            ?>
                            <?php if (!isset($_GET['college_id'])) { ?>

                                <button type="submit" class="btn btn-info mt-2">Fetch Courses</button>
                            <?php } else {
                            ?>


                                <button type="button" onclick="window.location.href = 'fees_add.php'" class="btn btn-danger mt-2">Clear College</button>
                            <?php
                            } ?>
                        </div>
                    </form>

                    <?php
                    if (isset($_GET['college_id'])) {
                        $college_id = $_GET['college_id'];

                        // Fetch the `courseIds` from the selected college
                        $college_query = "SELECT `courseId` FROM `colleges` WHERE `id` = '$college_id'";
                        $college_result = $con->query($college_query);

                        if ($college_result->num_rows > 0) {
                            $college_data = $college_result->fetch_assoc();
                            $course_ids = $college_data['courseId'];

                            // Convert courseIds to an array for SQL query
                            $course_ids_array = explode(',', $course_ids);
                            $course_ids_str = implode("','", $course_ids_array); // Make it safe for SQL

                            // Fetch courses where id matches courseIds
                            $courses_q = "SELECT `id`, `short_form` FROM `courses` WHERE `id` IN ('$course_ids_str')";
                            $courses_result = $con->query($courses_q);

                            if ($courses_result->num_rows > 0) { ?>
                                <form method="post">
                                    <?php while ($courses_row = $courses_result->fetch_assoc()) { ?>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><?= $courses_row['short_form'] ?></span>
                                            <input type="hidden" name="course_id[]" value="<?= $courses_row['id'] ?>">
                                            <input type="hidden" name="college_id" value="<?= $college_id ?>">
                                            <input type="text" name="fees[]" class="form-control" placeholder="Enter Fees">
                                        </div>
                                    <?php } ?>
                                    <button type="submit" name="add_fees_structure" class="btn btn-primary">Add Fees Structre</button>
                                </form>
                    <?php
                            } else {
                                echo '<p class="bg-danger rounded p-2 text-white">No Course Found</p>';
                            }
                        } else {
                            echo '<p class="bg-danger rounded p-2 text-white">Invalid College Selected</p>';
                        }
                    }
                    ?>

                </div>
            </div>

            <?php include 'php/pages/footer.php' ?>