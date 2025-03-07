<?php
include '../php/utils/db.php';
session_start();
// if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
//     header("Location:login.php");
//     exit();
// }

if (isset($_GET['delete_user'], $_GET['id'])) {
    $id = $_GET['id'];

    $delete_user = "DELETE FROM `users` WHERE `id` = '$id'";

    if ($con->query($delete_user) === TRUE) {
        header("Location:users_list.php?success=User Deleted Successfully");
    } else {
        echo "<script>alert('Error Deleting User');</script>";
    }
}
if (isset($_GET['activate_user'], $_GET['id'])) {
    $user_id = $_GET['id'];
    $run = mysqli_query($con, "UPDATE `users` SET `acc_status` = 'active',`verification_code`='' WHERE `id`='$user_id'");
    if ($run) {
        header("Location: users_list.php?success=User activated!");
    } else {
        header("Location: users_list.php?err=failed to active User");
    }
}
?>
<!DOCTYPE html>


<html lang="en">

<head>
    <title>Users List</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Manage Users</h1>
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
                            <?php $run = mysqli_fetch_assoc(mysqli_query($con,  "SELECT COUNT(*) AS `totalProducts` FROM `users` ORDER BY `id` DESC"));   ?>
                            <h6 class="m-0 font-weight-bold text-primary"><strong><?= $run['totalProducts'] ?> </strong> Users</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>username</th>
                                            <th>email</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Department</th>
                                            <th>City</th>
                                            <th>status</th>
                                            <th>Created </th>


                                            <th colspan="4" class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
                                        <?php
                                        $limit = 8;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $start = ($page - 1) * $limit;

                                        $query = "SELECT `id`, `username`, `email`, `phone_number`, `gender`, `department`, `acc_status`, `created_at`, `city`   FROM `users` ORDER BY `id` DESC LIMIT $start, $limit";

                                        $stmt = mysqli_prepare($con, $query);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);

                                        if (mysqli_stmt_num_rows($stmt) > 0) {
                                            mysqli_stmt_bind_result($stmt, $id, $username, $email, $phone_number, $gender, $department, $acc_status, $created_at, $city);

                                            while (mysqli_stmt_fetch($stmt)) {

                                        ?>

                                                <tr>

                                                    <td><?= htmlspecialchars($username) ?></td>
                                                    <td><?= htmlspecialchars($email) ?></td>
                                                    <td><?= htmlspecialchars($phone_number) ?></td>
                                                    <td> <?= htmlspecialchars($gender) ?></td>
                                                    <td><?= htmlspecialchars($department) ?></td>
                                                    <td><?= htmlspecialchars($city) ?></td>
                                                    <td class="bg-<?= $acc_status == 'active' ? "success" : "danger" ?> text-white"><?= htmlspecialchars($acc_status) ?></td>
                                                    <td>
                                                        <p title="<?php echo $created_at ?>">

                                                            <?php $ratingDate = strtotime($created_at);
                                                            $currentDate = time();
                                                            $differenceInSeconds = $currentDate - $ratingDate;
                                                            $differenceInDays = floor($differenceInSeconds / (60 * 60 * 24));
                                                            if ($differenceInDays == 0) {
                                                                echo 'Today';
                                                            } elseif ($differenceInDays == 1) {
                                                                echo 'Yesterday';
                                                            } elseif ($differenceInDays <= 60) {
                                                                echo $differenceInDays . ' days ago';
                                                            } else {
                                                                $differenceInWeeks = ceil($differenceInDays / 7);
                                                                echo $differenceInWeeks . ' weeks ago';
                                                            } ?>
                                                        </p>
                                                    </td>

                                                    <?php

                                                    if ($acc_status != "active") { ?>
                                                        <td class="d-flex align-items-center mx-2 text-center">
                                                            <a href="#" data-toggle="modal" data-target="#deleteModel<?= $id ?>" class="btn btn-danger btn-sm btn-circle">
                                                                <i class="fas fa-trash"></i>
                                                            </a>

                                                            <a href="users_list.php?activate_user&id=<?= $id ?>" class="btn btn-success btn-sm btn-circle mt-1">
                                                                <i class="fas fa-check-circle"></i>
                                                            </a>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>

                                                            <a href="leads_list.php?s=<?= $id ?>" class="btn btn-success btn-sm btn-circle mt-1">
                                                                <i class="fas fa-headset"></i>
                                                            </a>
                                                        </td>

                                                    <?php                                   } ?>
                                                    
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
                                                    <td>
                                                        <a target="_blank" href="mailto:<?= $email ?>" class="btn btn-secondary  btn-sm btn-circle">
                                                            <i class="fas fa-envelope"></i>
                                                        </a>
                                                    </td>

                                                </tr>


                                                <div class="modal" id="deleteModel<?= $id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure want to delete <strong> <?= htmlspecialchars($username) ?> </strong>'s Account </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" onclick="window.location.href = 'users_list.php?delete_user&id=<?= $id ?>'" class="btn btn-danger">Delete Now</button>
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
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total FROM`users` ORDER BY `id` DESC");
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