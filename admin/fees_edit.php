<?php
session_start();
include '../php/utils/db.php';
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}


if (isset($_POST['add_fees_structure'])) {

    $college_id = $_POST['college_id'];
    $course_ids = $_POST['course_id']; // Array of course IDs
    $fees_values = $_POST['fees']; // Array of fees

    // Prepare the UPDATE query
    $stmt = $con->prepare("UPDATE fees SET fees = ? WHERE college_id = ? AND course_id = ?");

    // Bind parameters
    $stmt->bind_param("sii", $fees, $college_id, $course_id);

    // Loop through courses and fees to update data
    foreach ($course_ids as $index => $course_id) {
        $fees = $fees_values[$index];
        $stmt->execute();
    }

    // Close the statement
    $stmt->close();

    echo "<script>alert('Fees Updated Successfully');</script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Fees</title>
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

                    <h1 class="h3 mb-4 text-gray-800">Update Fees for Courses</h1>
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


                                <button type="button" onclick="window.location.href = 'fees_edit.php'" class="btn btn-danger mt-2">Clear College</button>
                            <?php
                            } ?>
                        </div>
                    </form>

                    <?php
                    if (isset($_GET['college_id'])) {
                        $college_id = $_GET['college_id'];

                        // Fetch the `courseIds` from the selected college
                        $college_query = "SELECT `courseId` FROM `colleges` WHERE `id` = ?";
                        $stmt = $con->prepare($college_query);
                        $stmt->bind_param("i", $college_id);
                        $stmt->execute();
                        $college_result = $stmt->get_result();
                        $stmt->close();

                        if ($college_result->num_rows > 0) {
                            $college_data = $college_result->fetch_assoc();
                            $course_ids = $college_data['courseId'];

                            // Convert courseIds to an array for SQL query
                            $course_ids_array = explode(',', $course_ids);
                            $course_ids_str = implode(',', array_map('intval', $course_ids_array)); // Safe for SQL

                            // Fetch courses and fees where both `college_id` and `course_id` match exactly
                            $courses_q = "
            SELECT c.id, c.short_form, COALESCE(f.fees, '') AS fees 
            FROM courses c
            INNER JOIN fees f ON c.id = f.course_id AND f.college_id = ?
            WHERE c.id IN ($course_ids_str)
        ";
                            $stmt = $con->prepare($courses_q);
                            $stmt->bind_param("i", $college_id);
                            $stmt->execute();
                            $courses_result = $stmt->get_result();
                            $stmt->close();

                            if ($courses_result->num_rows > 0) { ?>
                                <form method="post">
                                    <?php while ($courses_row = $courses_result->fetch_assoc()) { ?>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><?= htmlspecialchars($courses_row['short_form']) ?></span>
                                            <input type="hidden" name="course_id[]" value="<?= $courses_row['id'] ?>">
                                            <input type="hidden" name="college_id" value="<?= $college_id ?>">
                                            <input type="text" name="fees[]" class="form-control" placeholder="Enter Fees" value="<?= htmlspecialchars($courses_row['fees']) ?>">
                                        </div>
                                    <?php } ?>
                                    <button type="submit" name="add_fees_structure" class="btn btn-primary">Update Fees Structure</button>
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