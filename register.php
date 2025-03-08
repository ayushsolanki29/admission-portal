<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
if (isset($_SESSION['Auth'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <?php
    $meta_title = "Register Now - Join CollegeNew.com for Easy Admissions";
    $meta_dec = "Create your free CollegeNew.com account to explore top colleges, compare courses, and get expert admission guidance. Sign up now and start your journey!";
    $meta_keywords = "register CollegeNew, student signup, create account, college admissions, education portal, career guidance, course comparison, admission help";
    $meta_img = $domain . "assets/img/og-img.png";
?>

    <title><?= $meta_title ?></title>
    <meta name="title" content="<?= $meta_title ?>">
    <meta name="description" content=<?= $meta_dec ?>>
    <meta name="keywords" content=<?= $meta_keywords ?>>

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $domain ?>">
    <meta property="og:title" content="<?= $meta_title ?>">
    <meta property="og:description" content="<?= $meta_dec ?>">
    <meta property="og:image" content="<?= $meta_img ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $domain ?>">
    <meta property="twitter:title" content="<?= $meta_title ?>">
    <meta property="twitter:description" content=<?= $meta_dec ?>>
    <meta property="twitter:image" content="<?= $meta_img ?>">
    <link rel="canonical" href="<?= $domain ?>/register.php">
</head>

<body>


    <?php include 'php/pages/header.php' ?>
    <style>
        .nice-select .list {
            width: 100% !important;
        }

        .nice-select {
            width: 100% !important;
        }
    </style>

    <main>
        <!--contact-form-area start-->
        <section class="contact-form-area pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
            <div class="container ">
                <div class="row justify-content-center  align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-form-wrapper gradient-bg p-4 rounded   text-center mb-30">
                            <h2 class="mb-45">Register</h2>

                            <form action="php/utils/actions.php?register=true&api" method="post" class="row gx-3 comments-form contact-form">
                                <div class="col-lg-12 mb-30">
                                    <input type="text" placeholder="Username" value="<?= showFormData('username') ?>" name="username">
                                    <?= showError('username') ?>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <input type="text" placeholder="Email" name="email" value="<?= showFormData('email') ?>">
                                    <?= showError('email') ?>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <input type="tel" placeholder="Phone Number" name="phone_number" value="<?= showFormData('phone_number') ?>">
                                    <?= showError('phone_number') ?>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <input type="tel" placeholder="City" name="city" value="<?= showFormData('city') ?>">
                                    <?= showError('city') ?>
                                </div>
                                <div class="col-lg-12 mb-30">

                                    <div class="col-lg-12 mb-30">
                                        <select name="gender" id="gender">
                                            <option value="" disabled>Select a Gender</option>
                                            <option <?= showFormData('gender') == "male" ? 'selected' : '' ?> value="male">Male</option>
                                            <option <?= showFormData('gender') == "female" ? 'selected' : '' ?> value="female">Female</option>
                                            <option <?= showFormData('gender') == "other" ? 'selected' : '' ?> value="other">Other</option>
                                        </select>

                                        <?= showError('gender') ?>
                                    </div>

                                </div>

                                <div class="col-lg-12 mb-30">
                                    <select name="department" id="select" class="nice-select">
                                        <option value="" selected disabled>Select a Department</option>
                                        <?php
                                        $select_department = "SELECT `department_name` FROM `department` ORDER BY `id` DESC";
                                        $department_result = $con->query($select_department);

                                        if ($department_result->num_rows > 0) {
                                            while ($row = $department_result->fetch_assoc()) {
                                                $selected = (showFormData('department') == $row['department_name']) ? 'selected' : '';
                                                echo '<option value="' . htmlspecialchars($row['department_name']) . '" ' . $selected . '>' . htmlspecialchars($row['department_name']) . '</option>';
                                            }
                                        } else {
                                            echo '<option value="0">No Department Found</option>';
                                        }
                                        ?>
                                    </select>

                                    <?= showError('department') ?>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <input type="password" placeholder="password" name="password">
                                    <?= showError('password') ?>
                                </div>




                                <p class="text-start ">
                                    By clicking the <strong>Register Now</strong>, you agree to our <a href="#" class="theme-color">Terms & Conditions</a> and <a href="#" class="theme-color">Privacy Policy</a>
                                </p>
                                <button class="theme_btn message_btn mt-20" type="submit">Register Now</button>
                                <br>
                                <p class=" mt-4">
                                    Already have an account? <a href="login.php" class="theme-color ">Login</a>
                                </p>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!--contact-form-area end-->
    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>
<?php

unset($_SESSION['error']);
unset($_SESSION['formdata']); ?>