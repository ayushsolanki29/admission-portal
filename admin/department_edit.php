<?php
session_start();
include '../php/utils/db.php';
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}

if (isset($_GET['edit'], $_GET['id'])) {
    $id = $_GET['id'];
    $select_course = "SELECT * FROM `department` WHERE `id` = '$id'";
    $course_result = $con->query($select_course);
    if ($course_result->num_rows > 0) {
        $department = $course_result->fetch_assoc();
    } else {
        echo "<script>alert('Department Not Found');</script>";
        header("Location:department_list.php");
        exit();
    }
}
if (isset($_POST['edit_department'])) {
    $department_id = $id;
    $department_name = $_POST['department_name'];

    // Update query
    $sql = "UPDATE `department` SET `department_name` = '$department_name' WHERE `id` = '$department_id'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Department Updated Successfully');</script>";
        header("location:department_list.php?success=Department Updated Successfully!");
    } else {
        echo "<script>alert('Error Updating Department');</script>";
        header("location:department_list.php?err=Error Updating Department!");

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Department</title>
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

                    <h1 class="h3 mb-4 text-gray-800">Edit <strong> <?= $department['department_name'] ?></strong></h1>
                    <form method="post">
                        <div class="form-group">
                            <label>Department Name</label>
                            <input type="text" name="department_name" value="<?= $department['department_name'] ?>" required class="form-control" placeholder="Enter Department Name Here ...">
                        </div>

                        <button type="submit" name="edit_department" class="btn btn-primary">Update Department</button>
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