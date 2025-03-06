<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
if (isset($_SESSION['Auth'])) {
    $user_id = $_SESSION['Auth'];
} else {
    header('Location: login.php?error=Please Login First For Checking Profile');
    exit();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main>

        <section class="instructor-details-area  pb-110 pt-md-95 pb-md-60 pt-xs-95 pb-xs-60">
            <div class="container">
                <?php
                if (isset($_GET['success'])) {
                ?>
                    <div class="alert alert-success text-start">
                        <?= $_GET['success'] ?>
                    </div>
                <?php
                }
                ?>

                <div class="row">

                    <div class="col-xl-6 col-lg-12">
                        <div class="instructor-profile">
                            <h2>User Profile</h2>
                            <ul class="profile-list mb-50">
                                <li>Username : <span class="font-weight-bold"><?= $user['username'] ?></span></li>
                                <li>Mobile : <span class="font-weight-bold"><?= $user['phone_number'] ?></span></li>
                                <li>Email : <span class="font-weight-bold"><?= $user['email'] ?></span></li>
                                <li>Gender : <span class="font-weight-bold"><?= $user['gender'] ?></span></li>
                                <li >Department : <span class="font-weight-bold"><?= $user['department'] ?></span></li>

                            </ul>

                        </div>
                    </div>
                    <div class="col">
                        <div class="instructor-profile">
                            <h2>Applied Colleges</h2>
                            <div class="grid row">
                                <?php
                                $applied_query = "SELECT * FROM `inquire` WHERE `user_id` = $user_id";
                                $applied_result = mysqli_query($con, $applied_query);
                                if (mysqli_num_rows($applied_result) > 0) {
                                    while ($applied = mysqli_fetch_assoc($applied_result)) {
                                        $applied['college_id'];
                                        $college_query = "SELECT `college_name`,`tag_id`,`college_campus` FROM `colleges` WHERE `id` = " . $applied['college_id'];
                                        $college_result = mysqli_query($con, $college_query);
                                        while ($college_data = mysqli_fetch_assoc($college_result)) {

                                ?>
                                            <div class="col grid-item">
                                                <div class="z-gallery mb-30">
                                                    <div class="z-gallery__thumb mb-20">
                                                        <a href="college_details.php?u=<?= $college_data['tag_id'] ?>"><img class="img-fluid" src="assets/img/campus_images/<?= $college_data['college_campus'] ?>" alt=""></a>

                                                    </div>
                                                    <div class="z-gallery__content">

                                                        <h4 class="sub-title mb-20"><a href="college_details.php?u=<?= $college_data['tag_id'] ?>"><?= $college_data['college_name'] ?></a></h4>

                                                    </div>
                                                </div>
                                            </div>
                                <?php }
                                    }
                                } else {
                                    echo "No Applied Colleges Yet";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>