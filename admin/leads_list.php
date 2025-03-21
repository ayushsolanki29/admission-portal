<?php
include '../php/utils/db.php';
session_start();
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}

if (isset($_GET['delete_department'])) {
    $pid = $_GET['id'];

    $query_d = mysqli_query($con, "DELETE FROM `department` WHERE `id`='$pid'");
    if ($query_d) {
        $message = "Department Deleted!";
        header("location:department_list.php?success=$message");
        exit;
    } else {
        $message = "Faild to Delete!";
        header("location:department_list.php?err=$message");
        exit;
    }
}

?>
<!DOCTYPE html>


<html lang="en">

<head>
    <title>Leads List</title>
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

                    <h1 class="h3 mb-2 text-gray-800">Manage Leads</h1>


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
                            <?php $run = mysqli_fetch_assoc(mysqli_query($con,  "SELECT COUNT(*) AS `totalProducts` FROM `inquire` ORDER BY `id` DESC"));   ?>
                            <h6 class="m-0 font-weight-bold text-primary"><strong><?= $run['totalProducts'] ?> </strong> Department</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>College Name</th>
                                            <th>Date</th>
                                            <th colspan="3" class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
                                        <?php
                                        $limit = 8;
                                        $no_ = 0;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $start = ($page - 1) * $limit;

                                        $query = "
        SELECT i.id, i.user_id, i.course_id, i.college_id, i.created_at, 
               u.username, u.id AS user_id, u.phone_number,
               c.college_name, c.id AS college_id 
        FROM `inquire` i
        LEFT JOIN `users` u ON i.user_id = u.id
        LEFT JOIN `colleges` c ON i.college_id = c.id
        ORDER BY i.id DESC
        LIMIT ?, ?";

                                        $stmt = mysqli_prepare($con, $query);
                                        mysqli_stmt_bind_param($stmt, "ii", $start, $limit);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);

                                        if (mysqli_stmt_num_rows($stmt) > 0) {
                                            mysqli_stmt_bind_result($stmt, $id, $user_id, $course_id, $college_id, $date, $username, $user_id,$phone_number, $college_name, $college_id);

                                            while (mysqli_stmt_fetch($stmt)) {
                                                $no_++;
                                        ?>

                                                <tr>


                                                    <td><?= htmlspecialchars($no_) ?></td>

                                                    <td><?= htmlspecialchars($username ) ?></td>
                                                    <td><?= htmlspecialchars($college_name) ?></td>
                                                    <td title="<?= $date ?>"><?= timeAgo($date) ?></td>

                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#deleteModel<?= $id ?>" class="btn btn-danger btn-sm btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <a target="_blank" href="https://wa.me/<?= $phone_number ?>" class="btn btn-sm btn-circle text-white" style="background-color: #25d366;">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a target="_blank" href="tel:<?= $phone_number ?>" class="btn btn-primary btn-sm btn-circle">
                                                            <i class="fas fa-phone-volume"></i>
                                                        </a>
                                                    </td>


                                                </tr>


                                                <div class="modal" id="deleteModel<?= $id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure want to delete <strong> <?= htmlspecialchars($college_id) ?> </strong> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" onclick="window.location.href = 'department_list.php?delete_department=true&id=<?= $id ?>'" class="btn btn-danger">Delete Now</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>No Messages Available</td></tr>";
                                        }


                                        ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>

                    <?php
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total FROM `department`");
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