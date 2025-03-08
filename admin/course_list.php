<?php
include '../php/utils/db.php';
session_start();
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}

if (isset($_GET['delete_course'], $_GET['id'], $_GET['course_thumbnail'])) {
    $id = $_GET['id'];
    $course_thumbnail = $_GET['course_thumbnail'];

    $delete_course = "DELETE FROM `courses` WHERE `id` = '$id'";

    if ($con->query($delete_course) === TRUE) {
        unlink("../assets/img/course/" . $course_thumbnail);
        header("Location:course_list.php?success=course Deleted Successfully");
    } else {
        echo "<script>alert('Error Deleting course');</script>";
    }
}

?>
<!DOCTYPE html>


<html lang="en">

<head>
    <title>Course List</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Manage Courses</h1>
                    <p class="mb-4">View and manage all available courses here. Need to add a new course? <a target="_blank" href="course_add.php">Click here.</a></p>

                    <br>
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php $run = mysqli_fetch_assoc(mysqli_query($con,  "SELECT COUNT(*) AS `totalProducts` FROM `courses` ORDER BY `id` DESC"));   ?>
                            <h6 class="m-0 font-weight-bold text-primary"><strong><?= $run['totalProducts'] ?> </strong> Courses</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>Image</th>
                                            <th>Full Name</th>
                                            <th>Short Name</th>
                                            <th>Fees</th>
                                            <th>Duration</th>
                                            <th>Study mode</th>
                                            <th>Enterance Exam</th>
                                            <th>Eligibility</th>
                                            <th>Department</th>

                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
                                        <?php
                                        $limit = 8;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $start = ($page - 1) * $limit;

                                        $query = "SELECT * FROM `courses` ORDER BY `id` ASC LIMIT $start, $limit";

                                        $stmt = mysqli_prepare($con, $query);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);

                                        if (mysqli_stmt_num_rows($stmt) > 0) {
                                            mysqli_stmt_bind_result($stmt, $id, $course_name, $short_form, $fees, $duration_of_Course, $study_mode, $enterance_exam, $eligibility, $department, $course_thumbnail);

                                            while (mysqli_stmt_fetch($stmt)) {

                                        ?>

                                                <tr>
                                                    <td>
                                                        <img src="../assets/img/course/<?= $course_thumbnail ?>" alt="Thumbnail" class="img-thumbnail img-fluid" width="100">
                                                    </td>
                                                    <td><?= htmlspecialchars($course_name) ?></td>
                                                    <td><?= htmlspecialchars($short_form) ?></td>
                                                    <td>₹<?= htmlspecialchars($fees) ?></td>
                                                    <td> <?= htmlspecialchars($duration_of_Course) ?></td>
                                                    <td><?= htmlspecialchars($study_mode) ?></td>
                                                    <td><?= htmlspecialchars($enterance_exam) ?></td>
                                                    <td><?= htmlspecialchars($eligibility) ?></td>
                                                    <td><?= htmlspecialchars($department) ?></td>

                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#deleteModel<?= $id ?>" class="btn btn-danger btn-sm btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="course_edit.php?edit&id=<?= $id ?>" class="btn btn-primary btn-sm btn-circle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>

                                                </tr>


                                                <div class="modal" id="deleteModel<?= $id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure want to delete <strong> <?= htmlspecialchars($short_form) ?> </strong> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" onclick="window.location.href = 'course_list.php?delete_course=true&id=<?= $id ?>&course_thumbnail=<?= $course_thumbnail ?>'" class="btn btn-danger">Delete Now</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>No Courses Available</td></tr>";
                                        }


                                        ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total FROM `courses`");
                    $total_rows = mysqli_fetch_assoc($result)['total'];
                    $total_pages = ceil($total_rows / $limit);
                    ?>

                    <nav class="text-center d-flex justify-content-center align-items-center">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <div id="modals-container"></div>

            <?php include 'php/pages/footer.php' ?>