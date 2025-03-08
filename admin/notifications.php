<?php
include '../php/utils/db.php';
session_start();
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}
if (isset($_GET['delete_all'])) {
    $stmt = $con->prepare("DELETE FROM `notifications` WHERE 1");

    if ($stmt->execute()) {
        $message = "Notifications Deleted!";
        header("Location: notifications.php?success=$message");
        exit;
    } else {
        $message = "Failed to delete Notifications!";
        header("Location: notifications.php?err=$message");
        exit;
    }
}
if (isset($_GET['delete_single'])) {
    $pid = $_GET['id'];

    $stmt = $con->prepare("DELETE FROM `notifications` WHERE `id` = ?");
    $stmt->bind_param("i", $pid);

    if ($stmt->execute()) {
        $message = "Notification Deleted!";
        header("Location: notifications.php?success=$message");
        exit;
    } else {
        $message = "Failed to delete Notification!";
        header("Location: notifications.php?err=$message");
        exit;
    }
}
if (isset($_GET['read_all'])) {
    $stmt = $con->prepare("UPDATE `notifications` SET `status`='read' WHERE  `status`='unread'");

    if ($stmt->execute()) {
        $message = "Notifications Readed!";
        header("Location: notifications.php?success=$message");
        exit;
    } else {
        $message = "Failed to Readed Notifications!";
        header("Location: notifications.php?err=$message");
        exit;
    }
}
if (isset($_GET['read_single'])) {
    $pid = $_GET['id'];

    $stmt = $con->prepare("UPDATE `notifications` SET `status`='read' WHERE `id`=?");
    $stmt->bind_param("i", $pid);

    if ($stmt->execute()) {
        $message = "Notification Readed!";
        header("Location: notifications.php?success=$message");
        exit;
    } else {
        $message = "Failed to Readed Notification!";
        header("Location: notifications.php?err=$message");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notifications </title>
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
                    <h1 class="h3 mb-2 text-gray-800">Notifications</h1>

                    <?php if (isset($_GET['err'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($_GET['err']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= htmlspecialchars($_GET['success']) ?>
                        </div>
                    <?php endif; ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between">
                            <?php

                            $result = $con->query("SELECT COUNT(*) AS `totalmultiple_images` FROM `notifications`");
                            $run = $result->fetch_assoc();
                            ?>
                            <h6 class="m-0 font-weight-bold text-primary">Total <strong><?= $run['totalmultiple_images'] ?> </strong> Notifications</h6>
                            <div class="actions">

                                <a href="notifications.php?read_all" class="btn btn-sm bg-gradient-primary text-white">
                                    <i class="fas fa-check-double"></i> Read All
                                </a>
                                <a href="notifications.php?delete_all" class="btn btn-sm bg-gradient-danger text-white">
                                    <i class="fas fa-trash"></i> Delete All
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>title</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th colspan="3">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
                                        <?php
                                        $limit = 8;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $start = ($page - 1) * $limit;

                                        $query = "SELECT * FROM `notifications`  ORDER BY `id` DESC LIMIT $start, $limit";
                                        $result = $con->query($query);

                                        if ($result->num_rows > 0) {
                                            while ($data = $result->fetch_assoc()) {
                                                $c_id = $data['id'];

                                        ?>

                                                <tr>

                                                    <td><?= htmlspecialchars($data['message']) ?></td>
                                                    <td><?= htmlspecialchars($data['date']) ?></td>
                                                    <td><?= htmlspecialchars($data['status']) ?></td>
                                                    <td>
                                                        <a href="notifications.php?delete_single&id=<?= $c_id ?>" class="btn btn-danger btn-sm btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="notifications.php?read_single&id=<?= $c_id ?>" class="btn btn-warning btn-sm btn-circle">
                                                            <i class="fas fa-check-double"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= $data['url'] ?>" class="btn btn-primary btn-sm btn-circle">
                                                            <i class="fas fa-link"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php

                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>No New Notification Available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <?php
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total FROM `notifications`");
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
            <?php include 'php/pages/footer.php' ?>