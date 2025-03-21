<?php
include '../php/utils/db.php';
session_start();

if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}
if (isset($_GET['delete_college'])) {
    $id = $_GET['id'];
    $college_logo = $_GET['college_logo'];
    $college_brochure = $_GET['college_brochure'];
    $college_campus = $_GET['college_campus'];
    $delete_college = "DELETE FROM `colleges` WHERE `id` = '$id'";
    $delete_campus_images = "DELETE FROM `campus_images` WHERE `college_id` = '$id'";

    if ($con->query($delete_college) === TRUE &&  $con->query($delete_campus_images) === TRUE) {

        unlink("../assets/img/college/" . $college_logo);
        unlink("../assets/brochure/" . $college_brochure);
        unlink("../assets/img/campus_images/" . $college_campus);
        echo "<script>alert('College Deleted Successfully');</script>";
        header("Location:college_list.php?success=College Deleted Successfully");
    } else {
        echo "<script>alert('Error Deleting College');</script>";
    }
}

?>
<!DOCTYPE html>


<html lang="en">

<head>
    <title>college Lists </title>
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

                    <h1 class="h3 mb-2 text-gray-800">Manage Colleges</h1>
                    <p class="mb-4">View and manage the list of colleges. Need to add a new one? <a target="_blank" href="college_add.php">Click here to add a college.</a></p>

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

                    <br>
                    <div id="accordion">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <?php
                                $run = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS `colleges_count` FROM `colleges`"));
                                ?>
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <strong><?= $run['colleges_count'] ?> </strong> Colleges Available
                                </h6>
                            </div>

                            <?php
                            $select_colleges = mysqli_query($con, "
SELECT 
    c.*, 
    (SELECT GROUP_CONCAT(short_form SEPARATOR ', ') FROM courses WHERE FIND_IN_SET(id, c.courseId)) AS course_short_names,
    (SELECT COUNT(*) FROM campus_images ci WHERE ci.college_id = c.id) AS total_campus_images
FROM colleges c;

");
                            while ($clg_data = mysqli_fetch_assoc($select_colleges)) {
                            ?>
                                <div class="card mb-3">
                                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center"
                                        id="heading<?= $clg_data['id'] ?>"
                                        data-toggle="collapse"
                                        data-target="#collapse<?= $clg_data['id'] ?>"
                                        aria-expanded="true"
                                        aria-controls="collapse<?= $clg_data['id'] ?>"
                                        style="cursor:pointer;">

                                        <div class="d-flex align-items-center">
                                            <img src="../assets/img/college/<?= $clg_data['college_logo'] ?>"
                                                alt="Logo"
                                                class="rounded-circle border"
                                                width="50"
                                                height="50">

                                            <div class="ml-3">
                                                <h5 class="mb-0 text-dark" style="font-size: 1.2rem;">
                                                    <?= $clg_data['college_name'] ?>
                                                </h5>
                                                <span class="text-muted small">
                                                    <strong><?= $clg_data['city_name'] ?></strong> (<?= $clg_data['district_name'] ?>)
                                                </span>
                                                <span>
                                                    Total Views : <strong><?= $clg_data['views'] ?></strong>
                                                </span>
                                            </div>
                                        </div>


                                    </div>

                                    <div id="collapse<?= $clg_data['id'] ?>" class="collapse" data-parent="#accordion">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Admission Type:</strong> <?= $clg_data['admission_type'] ?></p>
                                                    <p><strong>University:</strong> <?= $clg_data['university_name'] ?></p>
                                                    <p><strong>Finance Type:</strong> <?= $clg_data['finance_type'] ?></p>
                                                    <p><strong>Courses:</strong> <?= $clg_data['course_short_names'] ?></p>
                                                    <p><strong>Campus Image : </strong>
                                                        <img src="../assets/img/campus_images/<?= $clg_data['college_campus'] ?>" alt="Thumbnail" class="img-thumbnail img-fluid" width="100">
                                                    </p>
                                                    <p><strong>Campus Images:</strong>
                                                        <span class="badge <?= $clg_data['total_campus_images'] > 0 ? 'badge-success' : 'badge-danger' ?>">
                                                            <?= $clg_data['total_campus_images'] > 0 ? $clg_data['total_campus_images'] . " Images Available" : "No Image" ?>
                                                        </span>
                                                        <?php if ($clg_data['total_campus_images'] == 0) { ?>
                                                            <a href="campus_images_add.php" class="btn btn-warning btn-sm">Upload Images</a>
                                                        <?php } ?>
                                                    </p>
                                                </div>

                                                <div class="col-md-6">
                                                    <p><strong>Total Students:</strong> <?= $clg_data['total_Students'] ?></p>
                                                    <p><strong>Online Students:</strong> <?= $clg_data['online_Students'] ?></p>
                                                    <p><strong>Offline Students:</strong> <?= $clg_data['ofline_Students'] ?></p>
                                                    <p><strong>Median Salary:</strong> <?= $clg_data['median_salary'] ?></p>
                                                    <p><strong>Average Package:</strong> <?= $clg_data['avarage_package'] ?></p>
                                                    <p><strong>Highest Package:</strong> <?= $clg_data['highest_package'] ?></p>
                                                    <p><strong>College Views :</strong> <?= $clg_data['views'] ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <p title="<?= $clg_data['desciption_of_college'] ?>"><strong>College Description:</strong>
                                                <?= (strlen($clg_data['desciption_of_college']) > 150) ? substr($clg_data['desciption_of_college'], 0, 150) . '...' : $clg_data['desciption_of_college']; ?>
                                            </p>
                                            <p title="<?= $clg_data['university_details'] ?>"><strong>University Details:</strong>
                                                <?= (strlen($clg_data['university_details']) > 150) ? substr($clg_data['university_details'], 0, 150) . '...' : $clg_data['university_details']; ?>
                                            </p>
                                            <p title="<?= $clg_data['admission_process'] ?>"> <strong>Admission Process:</strong>
                                                <?= (strlen($clg_data['admission_process']) > 150) ? substr($clg_data['admission_process'], 0, 150) . '...' : $clg_data['admission_process']; ?>
                                            </p>
                                            <p title="<?= $clg_data['placement_details'] ?>"><strong>Placement Details:</strong>
                                                <?= (strlen($clg_data['placement_details']) > 150) ? substr($clg_data['placement_details'], 0, 150) . '...' : $clg_data['placement_details']; ?>
                                            </p>

                                            <div class="text-center mt-3">
                                                <a href="college_edit.php?edit&id=<?= $clg_data['id'] ?>" target="_blank" class="btn btn-info btn-sm">Edit</a>
                                                <a href="../assets/brochure/<?= $clg_data['college_brochure'] ?>" class="btn btn-warning btn-sm" target="_blank">Check Brochure</a>
                                                <a href="../college-details.php?u=<?= $clg_data['tag_id'] ?>" class="btn btn-success btn-sm">Check Live</a>
                                                <a href="campus_images_list.php?clg_id=<?= $clg_data['id'] ?>" class="btn btn-secondary btn-sm">Check Campus Images</a>
                                                <a href="#" data-toggle="modal" data-target="#deleteModel<?= $clg_data['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $college_name = $clg_data['college_name'];
                                $college_logo = $clg_data['college_logo'];
                                $college_campus = $clg_data['college_campus'];
                                $college_brochure = $clg_data['college_brochure'];
                                $college_id = $clg_data['id']; ?>
                                <div class="modal" id="deleteModel<?= $college_id ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Are you sure want to delete <strong> <?= htmlspecialchars($college_name) ?> </strong> </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="window.location.href = 'college_list.php?delete_college=true&id=<?= $college_id ?>&college_logo=<?= $college_logo ?>&college_brochure=<?= $college_brochure ?>&college_campus=<?= $college_campus ?>'" class="btn btn-danger">Delete Now</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>


                    </div>
                </div>
            </div>
            <div id="modals-container"></div>

            <?php include 'php/pages/footer.php' ?>