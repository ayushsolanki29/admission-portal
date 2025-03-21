<?php
include '../php/utils/db.php';
session_start();
$total_rows = "0";

if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM fees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: fees_list.php?success=Successfully Deleted");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fees Strutre</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Fees Strusture Manage</h1>
                    <p class="mb-4">This is where you can manage the fees structure of the colleges<a target="_blank" href="fees_add.php">Click here to New Fees.</a>.</p>


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

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>Course</th>
                                            <th>College</th>
                                            <th>Fees</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
    <?php
    $limit = 8;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    // Optimized Query without merging courses
    $query = "
        SELECT f.id, f.college_id, f.course_id, f.fees, 
               c.college_name, cr.course_name
        FROM fees f
        JOIN colleges c ON f.college_id = c.id
        JOIN courses cr ON f.course_id = cr.id
        ORDER BY f.id DESC
        LIMIT ?, ?
    ";

    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $start, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {
    ?>
            <tr>
                <td><?= htmlspecialchars($data['course_name']) ?></td>
                <td><?= htmlspecialchars($data['college_name']) ?></td>
                <td>₹<?= htmlspecialchars($data['fees']) ?></td>
                <td>
                    <a href="fees_list.php?delete=true&id=<?=$data['id']?>" class="btn btn-danger btn-sm btn-circle">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='4'>No Course Available</td></tr>";
    }

    $stmt->close();
    ?>
</tbody>


                                </table>

                            </div>
                        </div>
                    </div>
                    <?php
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total FROM `fees`");
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