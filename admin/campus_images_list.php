<?php
include '../php/utils/db.php';
session_start();
$total_rows = "0";
// if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
//     header("Location:login.php");
//     exit();
// }

if (isset($_GET['delete_product'], $_GET['id'],$_GET['img'])) {
    $id = $_GET['id'];
    $img = $_GET['img'];
    $query = mysqli_query($con, "DELETE FROM `campus_images` WHERE `id` = $id");
    if ($query) {
      unlink("../assets/img/campus_images/$img");
      $message = "Deleted from Campus Image";
      header("location:campus_images_list.php?success=$message");
      exit;
    } else {
      $response = "something went wronge";
      header("location:campus_images_list.php?err=$response");
      exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>College Images</title>
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
                <h1 class="h3 mb-2 text-gray-800">Campus Images</h1>
<p class="mb-4">Manage all campus-related images here. Need to upload more? <a target="_blank" href="campus_images_add.php">Click here to add images.</a></p>

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
                        <div class="card-header py-3">
                            <?php
                            $result = $con->query("SELECT COUNT(*) AS `totalmultiple_images` FROM `campus_images`");
                            $run = $result->fetch_assoc();
                            ?>
                            <h6 class="m-0 font-weight-bold text-primary">We have <strong><?= $run['totalmultiple_images'] ?> </strong> Images</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-secondary text-white text-capitalize">
                                        <tr>
                                            <th>Image</th>
                                            <th>College</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody id="img_List">
                                        <?php
                                        $limit = 8;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $start = ($page - 1) * $limit;

                                        if (isset($_GET['clg_id'])) {
                                            $clg_id = $_GET['clg_id'];
                                            $query = "SELECT `id`, `college_id`, `image` FROM `campus_images` WHERE `college_id` = $clg_id  ORDER BY `id` ASC LIMIT $start, $limit";
                                        } else {
                                            $query = "SELECT `id`, `college_id`, `image` FROM `campus_images` ORDER BY `id` ASC LIMIT $start, $limit";
                                        }
                                        $result = $con->query($query);

                                        if ($result->num_rows > 0) {
                                            while ($data = $result->fetch_assoc()) {
                                                $i_id = $data['id'];
                                                $product_id = $data['college_id'];
                                                $image = $data['image'];

                                                $productQuery = $con->prepare("SELECT `college_name` FROM `colleges` WHERE `id` = ?");
                                                $productQuery->bind_param("i", $product_id);
                                                $productQuery->execute();
                                                $productResult = $productQuery->get_result();
                                                $product = $productResult->fetch_assoc();
                                        ?>

                                                <tr>
                                                    <td onclick="window.location.href = '../assets/img/campus_images/<?= htmlspecialchars($image) ?>'">
                                                        <img src="../assets/img/campus_images/<?= htmlspecialchars($image) ?>" class="img-thumbnail img-fluid" width="80" alt="img">
                                                    </td>
                                                    <td><?= htmlspecialchars($product['college_name']) ?></td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#deleteModel<?= $i_id ?>" class="btn btn-danger btn-sm btn-circle">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <div class="modal" id="deleteModel<?= $i_id ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure you want to delete <?= htmlspecialchars($product['college_name']) ?>?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" onclick="window.location.href = 'campus_images_list.php?delete_product=true&id=<?= $i_id ?>&img=<?= $image ?>'" class="btn btn-danger">Delete Now</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php
                                                $productQuery->close();
                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>No Images Available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <?php
                    $result = mysqli_query($con, "SELECT COUNT(id) AS total FROM `campus_images`");
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