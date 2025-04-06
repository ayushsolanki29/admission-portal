<?php
include '../php/utils/db.php';
session_start();
if (!isset($_SESSION['is_admin'])) {
    header("Location:login.php");
    exit();
}

if (isset($_POST['update_insta'])) {
    $update_insta = $_POST['insta_id'];

    $run = mysqli_query($con, "UPDATE `settings` SET `data1`='$update_insta' WHERE `id`='5'");
    if ($run) {
        header("Location: settings.php?success=Instagram ID updated!");
    } else {
        header("Location: settings.php?err=failed to update");
    }
}
if (isset($_POST['update_Taxes_data'])) {
    $tax_value = $_POST['tax_value'];

    $run = mysqli_query($con, "UPDATE `settings` SET `data1`='$tax_value' WHERE `id`='3'");
    if ($run) {
        header("Location: settings.php?success=Mobile Number updated!");
    } else {
        header("Location: settings.php?err=failed to update");
    }
}

if (isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $run = mysqli_query($con, "UPDATE `settings` SET `data1`='$username',`data2`='$password' WHERE `id`='2'");
    if ($run) {
        header("Location: settings.php?success=Profile updated!");
    } else {
        header("Location: settings.php?err=failed to update");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>settings </title>
    <?php include 'php/pages/head.php'; ?>
</head>

<body id="page-top">

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div id="wrapper">
        <?php include 'php/pages/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <?php include 'php/pages/nav.php'; ?>
                <div class="container-fluid">

                    <h1 class="h3 mb-4 text-gray-800">Settings</h1>

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
                    <div class="form-group" id="profile">
                        <label for="couponSelect">Admin Profile</label>
                        <?php
                        $Profile = mysqli_query($con, "SELECT * FROM `settings` WHERE `id` = 2");
                        $Profile_data = mysqli_fetch_array($Profile);
                        ?>
                        <div class="d-flex gap-2 align-items-center">
                            <form class="form-inline" method="post">

                                <input type="text" class="form-control mr-2" name="username" placeholder="Username" value="<?= $Profile_data['data1'] ?>">

                                <input type="Passowrd" class="form-control mr-2" name="password" placeholder="Passowrd" value="<?= $Profile_data['data2'] ?>">
                                <button type="submit" name="update_profile" class="btn btn-primary btn-md">Update Profile</button>
                            </form>
                        </div>

                    </div>



                    <hr>
                    <div class="form-group">
                        <label for="couponSelect">Whatsapp Number</label>
                        <?php
                        $Taxes_q = mysqli_query($con, "SELECT `id`,`data1` FROM `settings` WHERE `id` = 3");
                        $Taxes_data = mysqli_fetch_array($Taxes_q);
                        ?>
                        <div class="d-flex gap-2 align-items-center">
                            <form class="form-inline" method="post">
                                <div class="input-group mb-2 mr-sm-2">

                                    <input type="text" class="form-control  mr-2" placeholder="Enter Tax" name="tax_value" value="<?= $Taxes_data['data1'] ?>">
                                </div>
                                <button type="submit" name="update_Taxes_data" class="btn btn-primary btn-md">Update Number</button>
                            </form>
                        </div>
                        <small>This Number Used in All Actions. </small>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="couponSelect">Instagram</label>
                        <?php
                        $insta_q = mysqli_query($con, "SELECT `id`,`data1` FROM `settings` WHERE `id` = 5");
                        $insta_data = mysqli_fetch_array($insta_q);
                        ?>
                        <div class="d-flex align-items-center">
                            <form class="form-inline" method="post">
                                <div class="input-group mb-2 mr-sm-2">

                                    <input type="text" class="form-control  mr-2" placeholder="Enter Instagram" name="insta_id" value="<?= $insta_data['data1'] ?>">
                                </div>
                                <button type="submit" name="update_insta" class="btn btn-primary btn-md">Update Instagram</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <?php include 'php/pages/footer.php' ?>