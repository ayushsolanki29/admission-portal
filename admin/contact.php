<?php
include '../php/utils/db.php';
session_start();
// if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
//     header("Location:login.php");
//     exit();
// }


if (isset($_GET['delete_contact'], $_GET['id'])) {
    $id = $_GET['id'];

    $delete_user = "DELETE FROM `contact` WHERE `id` = '$id'";

    if ($con->query($delete_user) === TRUE) {
        header("Location:contact.php?success=Submisson Deleted Successfully");
    } else {
        echo "<script>alert('Error Deleting Submisson');</script>";
    }
}


?>
<!DOCTYPE html>


<html lang="en">

<head>
    <title>Contact</title>
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

                    <h1 class="h3 mb-2 text-gray-800">Contact</h1>

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
                            <?php $run = mysqli_fetch_assoc(mysqli_query($con,  "SELECT COUNT(*) AS `totalProducts` FROM `contact` ORDER BY `id` DESC"));   ?>
                            <h6 class="m-0 font-weight-bold text-primary"><strong><?= $run['totalProducts'] ?> </strong> Submissions Found</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Topic</th>
                                            <th>Message</th>

                                            <th>Date</th>

                                            <th colspan="3" class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
                                        <?php
                                        $limit = 8;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $start = ($page - 1) * $limit;

                                        $query = "SELECT * FROM `contact` ORDER BY `id` DESC LIMIT $start, $limit";

                                        $stmt = mysqli_prepare($con, $query);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);

                                        if (mysqli_stmt_num_rows($stmt) > 0) {
                                            mysqli_stmt_bind_result($stmt, $id, $full_name, $email, $phone, $city, $topic, $other_topic, $message, $created_at);

                                            while (mysqli_stmt_fetch($stmt)) {

                                        ?>

                                                <tr>
                                                    <td><?= htmlspecialchars($full_name) ?></td>
                                                    <td><?= htmlspecialchars($email) ?></td>
                                                    <td><?= htmlspecialchars($phone) ?></td>
                                                    <td><?= htmlspecialchars($city) ?></td>
                                                    <td><?= $topic != "other" ? htmlspecialchars($topic) : htmlspecialchars($other_topic) ?></td>

                                                    <td title="<?= htmlspecialchars($message) ?>">Hover Here</td>

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

                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#deleteModel<?= $id ?>" class="btn btn-danger btn-sm btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#view<?= $id ?>" class="btn btn-info btn-sm btn-circle">
                                                            <i class="fas fa-info"></i>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <a href="mailto:<?= $email ?>" class="btn btn-primary btn-sm btn-circle">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    </td>

                                                </tr>


                                                <div class="modal" id="deleteModel<?= $id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure want to delete <strong> <?= htmlspecialchars($full_name) ?> </strong>'s Submisson </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" onclick="window.location.href = 'contact.php?delete_contact=true&id=<?= $id ?>'" class="btn btn-danger">Delete Now</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal" id="view<?= $id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Query from <strong><?= htmlspecialchars($full_name) ?></strong></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($email) ?></li>
                                                                    <li class="list-group-item"><strong>Phone:</strong> <?= htmlspecialchars($phone) ?> <a href="tel:<?= $phone?>">Make a Call</a></li>
                                                                    <li class="list-group-item"><strong>City:</strong> <?= htmlspecialchars($city) ?></li>
                                                                    <li class="list-group-item"><strong>Topic:</strong> <?= htmlspecialchars($topic) ?></li>
                                                                    <?php if (!empty($other_topic)) : ?>
                                                                        <li class="list-group-item"><strong>Other Topic:</strong> <?= htmlspecialchars($other_topic) ?></li>
                                                                    <?php endif; ?>
                                                                    <li class="list-group-item"><strong>Message:</strong> <?= nl2br(htmlspecialchars($message)) ?></li>
                                                                    <li class="list-group-item"><strong>Submitted:</strong> <?= date("M d, Y h:i A", strtotime($created_at)) ?></li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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