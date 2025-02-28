<?php
session_start();
include '../php/utils/db.php';
// if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
//     header("Location:login.php");
//     exit();
// }

if (isset($_POST['upload_images'])) {
    $college_id = $_POST['college_id'];

    if (isset($_FILES['related_images'])) {
        $files = $_FILES['related_images'];
        $valid_extensions = ['png', 'jpg', 'jpeg'];

        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === 0) {
                $filename = $files['name'][$i];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $name = date("YmdHis") . '_' . $i;

                if (in_array(strtolower($file_ext), $valid_extensions)) {
                    $destfile = '../assets/img/campus_images/' . $name . '.' . $file_ext;
                    $new_file = $name . '.' . $file_ext;
                    if (move_uploaded_file($files['tmp_name'][$i], $destfile)) {
                        $query = mysqli_query($con, "INSERT INTO `campus_images`(`college_id`, `image`) VALUES ('$college_id','$new_file')");
                        if (!$query) {
                            $response = "Failed to insert $filename into database.";
                            header("location:campus_images_add.php?err=$response");
                            exit;
                        }
                    } else {
                        $response = "Failed to upload $filename.";
                        header("location:campus_images_add.php?err=$response");
                        exit;
                    }
                } else {
                    $response = "Only supported extensions are JPG, PNG, JPEG.";
                    header("location:campus_images_add.php?err=$response");
                    exit;
                }
            } else {
                $response = "Error uploading file $filename.";
                header("location:campus_images_add.php?err=$response");
                exit;
            }
        }

        $message = "Images added to database successfully.";
        header("location:campus_images_add.php?success=$message");
        exit;
    } else {
        $response = "No files were uploaded.";
        header("location:campus_images_add.php?err=$response");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Upload Campus Images</title>
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

                    <h1 class="h3 mb-4 text-gray-800">Upload Campus Images</h1>
                    <?php
                    if (isset($_GET['err'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['err'] ?>
                        </div>
                    <?php }
                    if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_GET['success'] ?>
                        </div>
                    <?php }
                    ?>
                    <form method="post" enctype="multipart/form-data">


                        <div class="form-group">
                            <label for="college_id">Select College Name </label>
                            <select class="form-control " name="college_id" required>
                                <option disabled selected>Select College</option>
                                <?php
                                $select_college = "SELECT `id`,`college_name` FROM `colleges` ORDER BY `id` DESC";
                                $college_result = $con->query($select_college);
                                if ($college_result->num_rows > 0) {
                                    while ($row = $college_result->fetch_assoc()) {
                                        echo '<option value="' . $row['id'] . '">' . $row['college_name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="0">No College Found</option>';
                                }

                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Campus Images</label>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" multiple class="custom-file-input" name="related_images[]" id="inputGroupFile04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose Multiple Images</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="upload_images" class="btn btn-primary">Upload Campus Images</button>
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