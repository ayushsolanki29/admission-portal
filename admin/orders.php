<?php
include "../php/configs/db.php";
session_start();
if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != 'true') {
    header("Location:login.php");
    exit();
}

if (isset($_GET['delete'])  && isset($_GET['txt_id'])) {
    $id = $_GET['txt_id'];
    $query_d = mysqli_query($con, "DELETE FROM `transition` WHERE `txt_id`='$id'");
    if ($query_d) {
        $message = "Order Deleted!";
        header("location:orders.php?success=$message");
    } else {
        $message = "Failed to delete order!";
        header("location:orders.php?err=$message");
    }
}
if (isset($_GET['paid']) && isset($_GET['txt_id'])) {
    $id = $_GET['txt_id'];
    $query_p = mysqli_query($con, "UPDATE `transition` SET `status` = 'paid' WHERE `txt_id`='$id'");
    if ($query_p) {
        $message = "Order Paid!";
        header("location: orders.php?success=$message");
    } else {
        $message = "Failed to mark order as paid!";
        header("location: orders.php?err=$message");
    }
}
if (isset($_GET['unpaid']) && isset($_GET['txt_id'])) {
    $id = $_GET['txt_id'];
    $query_p = mysqli_query($con, "UPDATE `transition` SET `status` = 'processing' WHERE `txt_id`='$id'");
    if ($query_p) {
        $message = "Order unpaid!";
        header("location: orders.php?success=$message");
    } else {
        $message = "Failed to mark order as unpaid!";
        header("location: orders.php?err=$message");
    }
}
if (isset($_GET['return']) && isset($_GET['txt_id'])) {
    $id = $_GET['txt_id'];
    $query_p = mysqli_query($con, "UPDATE `transition` SET `delivered` = 'no' WHERE `txt_id`='$id'");
    $query_return = mysqli_query($con, "DELETE FROM `delivery` WHERE `txt_id`='$id'");

    if ($query_p && $query_return) {
        $message = "Order Retured!";
        header("location: orders.php?success=$message");
    } else {
        $message = "Failed to Retured!";
        header("location: orders.php?err=$message");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Orders - steam-games.in</title>
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

                    <h1 class="h3 mb-4 text-gray-800">orders</h1>
                    <?php $all_orders = mysqli_fetch_assoc(mysqli_query($con,  "SELECT COUNT(*) AS `all_orders` FROM `transition`")); ?>
                    <h6 class="m-0 font-weight-bold text-primary"><strong><?= $all_orders['all_orders'] ?> </strong> Orders</h6>
                    <?php if (isset($_GET['err'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($_GET['err'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>
                    <br>
                    <form action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="s" value="<?= isset($_GET['s']) ? $_GET['s'] : "" ?>" placeholder="Search by username | email | txt_id | UPI_id | coupon_code | phone " aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <div class="input-group-append">
                                    <?php if (isset($_GET['s'])) { ?>
                                        <button class="btn btn-outline-danger" onclick="window.location.href = 'orders.php'" type="button">Reset</button>
                                    <?php } else { ?>
                                        <button class="btn btn-outline-primary" type="submit">search</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </form>
                    <form action="">
                        <div class="input-group">
                            <select class="custom-select" id="inputGroupSelect04" name="f">
                                <option selected>Choose option for filter</option>
                                <option value="pending">By Pending</option>
                                <option value="UPI">By UPI</option>
                                <option value="card">By Card</option>
                                <option value="price_higher">By Price Higher</option>
                                <option value="price_lower">By Price Lower</option>
                                <option value="delivered">By Delivered</option>
                            </select>
                            <div class="input-group-append">
                                <?php if (isset($_GET['f'])) { ?>
                                    <button class="btn btn-outline-danger" onclick="window.location.href = 'orders.php'" type="button">Reset</button>
                                <?php } else { ?>
                                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div id="accordion">

                        <?php
                        if (isset($_GET['s'])) {
                            $search_value = "%" . $_GET['s'] . "%";
                            $query = "SELECT t.*, u.username, u.email 
                                      FROM `transition` t 
                                      LEFT JOIN `users` u ON t.user_id = u.id 
                                      WHERE t.`txt_id` LIKE '%$search_value%' 
                                      OR t.`contact` LIKE '%$search_value%' 
                                      OR t.`upi` LIKE '%$search_value%' 
                                      OR t.`coupon_code` LIKE '%$search_value%' 
                                      OR u.`username` LIKE '%$search_value%' 
                                      OR u.`email` LIKE '%$search_value%'";
                        } else {
                            $query = "SELECT * FROM `transition`";
                        }

                        // Determine the order based on the selected filter option
                        if (isset($_GET['f'])) {
                            switch ($_GET['f']) {
                                case 'pending':
                                    $query .= " ORDER BY `status` ASC";
                                    break;
                                case 'UPI':
                                    $query .= "WHERE `method` = 'UPI'";
                                    break;
                                case 'card':
                                    $query .= "WHERE `method` = 'card'";
                                    break;
                                case 'price_higher':
                                    $query .= " ORDER BY `amount` DESC";
                                    break;
                                case 'price_lower':
                                    $query .= " ORDER BY `amount` ASC";
                                    break;
                                case 'delivered':
                                    $query .= " ORDER BY `delivery_status` DESC";
                                    break;
                                default:
                                    $query .= " ORDER BY `date` DESC";
                                    break;
                            }
                        } else {

                            $query .= " ORDER BY `id` DESC";
                        }

                        $select_txt_q = mysqli_query($con, $query);

                        if ($select_txt_q && mysqli_num_rows($select_txt_q) > 0) {
                            while ($txt_data = mysqli_fetch_assoc($select_txt_q)) {
                                $user = getUserById($txt_data['user_id']);
                        ?>
                                <div class="card mb-3">
                                    <div class="card-header" id="heading">
                                        <div class="d-flex  justify-content-between align-items-center w-100">

                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <?php
                                                    if ($user['type'] == "google") { ?>
                                                        <img src="<?= $user['profile'] ?>" alt="Logo" class="team-logo rounded-circle" width="50">

                                                    <?php } else { ?>
                                                        <img src="../assets/img/profile/<?= $user['profile'] ?>" alt="Logo" class="team-logo rounded-circle" width="50">

                                                    <?php }
                                                    ?>
                                                </div>
                                                <div style="cursor:pointer;" data-toggle="collapse" data-target="#collapse<?= $txt_data['id'] ?>" aria-expanded="true" aria-controls="collapse">
                                                    <h5 class="mb-0">
                                                        <?= $user['username'] ?>
                                                    </h5>
                                                    <span class="text-muted"> <?php
                                                                                $product_ids = fetchProductIDs($con, $txt_data['user_id'], $txt_data['status'], $txt_data['delivered']);
                                                                                $product_details = fetchProductDetails($con, $product_ids);

                                                                                ?>

                                                        <strong>Games : </strong> <?php foreach ($product_details as $product) : ?> <?= $product['title'] . " | ";  ?> <?php endforeach; ?>

                                                    </span>
                                                </div>
                                            </div>

                                            <div>
                                                <?php if ($txt_data['status'] == "paid") {
                                                    if ($txt_data['delivered'] == "no") { ?>
                                                        <a href="pending_deliveries.php?s=<?= $txt_data['txt_id'] ?>" class="btn btn-info btn-sm text-white text-center ">
                                                            Send Details
                                                        </a>&nbsp;
                                                    <?php } else { ?>
                                                        <a href="delivered.php?s=<?= $txt_data['txt_id'] ?>" class="btn-info text-white btn btn-sm text-center ">
                                                            Details
                                                        </a>&nbsp;
                                                    <?php   }
                                                    ?>

                                                <?php } elseif ($txt_data['status'] == "processing") { ?>
                                                    <a href="orders.php?paid&txt_id=<?= $txt_data['txt_id'] ?>" class="btn btn-success btn-sm">Paid</a>&nbsp;
                                                <?php } else { ?>
                                                <?php } ?>
                                                <a href="orders.php?delete&txt_id=<?= $txt_data['txt_id'] ?>" class="btn btn-danger btn-sm">Delete</a>&nbsp;
                                                <a href="users_list.php?s=<?= $user['email'] ?>" class="btn-warning text-white btn btn-sm text-white text-center ">
                                                    Action
                                                </a> &nbsp;
                                            </div>
                                        </div>
                                    </div>

                                    <div id="collapse<?= $txt_data['id'] ?>" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Payment Details</h4>
                                                    <ul>
                                                        <li>username : <?= $user['username'] ?>
                                                        <li>Date: <?= date('M d, Y h:i A', strtotime($txt_data['date'])) ?></li>
                                                        </li>
                                                        <li>txt id: <?= $txt_data['txt_id'] ?> </li>
                                                        <li>upi_id : <?= $txt_data['upi'] ?> </li>
                                                        <li>coupon code : <?= empty($txt_data['coupon_code']) ? "N/A" :  $txt_data['coupon_code']  ?> </li>
                                                        <li>method : <?= $txt_data['method'] ?> </li>
                                                        <li>status : <span class="badge badge-<?= $txt_data['status'] == "paid" ? "success" : "danger" ?> "> <?= $txt_data['status'] ?> </span></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>Games : </h4>
                                                    <ul>

                                                        <div><strong>Games : </strong> <?php foreach ($product_details as $product) : ?> <a href="<?= $domain . 'game_profile.php?p=' . $product['id'] ?>"><?= $product['title'] . " | ";  ?> </a> <?php endforeach; ?></div>
                                                    </ul>
                                                    <h4>Contact Details</h4>
                                                    <ul>
                                                        <li>Phone : <?= $txt_data['contact'] ?>
                                                            <button class="btn btn-primary btn-sm btn-circle" onclick="window.location.href = 'tel:<?= $txt_data['contact'] ?>'"><i class="fas fa-phone-alt"></i> </button>
                                                            <button class="btn btn-sm btn-circle" onclick="window.location.href = 'https://wa.me/<?= $txt_data['contact'] ?>'" style="background-color: green;color:white;"><i class="fab fa-whatsapp"></i> </button>

                                                        </li>
                                                        <li>Email:
                                                            <?= $user['email'] ?>
                                                            <button class="btn btn-info btn-sm btn-circle"><i class="fas fa-envelope"></i> </button>
                                                        </li>
                                                    </ul>
                                                    <h4>Quick Actions</h4>
                                                    <ul>

                                                        <a href="orders.php?unpaid&txt_id=<?= $txt_data['txt_id'] ?>" class="btn btn-info btn-sm text-white text-center ">
                                                            Unpaid
                                                        </a>&nbsp;
                                                        <a href="orders.php?return&txt_id=<?= $txt_data['txt_id'] ?>" class="btn btn-danger btn-sm text-white text-center ">
                                                            Return Delivery
                                                        </a>&nbsp;
                                                    </ul>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Paymnet Proof</h4>
                                                    <?php if (empty($txt_data['file'])) {
                                                        echo "No file found";
                                                    } else { ?>
                                                        <img src="../assets/img/payment_proof/<?= $txt_data['file'] ?>" alt="Thumbnail" class="img-thumbnail">
                                                    <?php } ?>
                                                    <!-- thumbnail img portrait  -->


                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card text-center bg-<?= $txt_data['status'] == "paid" ? "success" : "danger" ?> text-white">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Amount : <strong>₹ <?= $txt_data['amount'] ?> </strong></h5>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            <?php }
                        } else {
                            echo "No results found.";
                        }

                            ?>


                                </div>
                    </div>
                </div>

                <?php include 'php/pages/footer.php' ?>