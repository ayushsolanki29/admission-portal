<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();

if (isset($_SESSION['Auth'])) {
    header("Location: index.php");
}

if (!isset($_SESSION['verification_done'])) {
    header("Location: forget-password.php");
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <?php
    $meta_title = "Reset Your Password - CollegeNew.com";
    $meta_dec = "Easily reset your CollegeNew.com account password and regain access to your account for a seamless college admission experience.";
    $meta_keywords = "CollegeNew forgot password, reset password, student login help, account recovery, education portal, secure access";
    $meta_img = $domain . "/assets/img/og-image.png";
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
    <link rel="canonical" href="<?= $domain ?>/forget-password.php">
</head>

<body>


    <?php include 'php/pages/header.php' ?>


    <main>

        <section class="contact-form-area pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-form-wrapper gradient-bg p-4 rounded text-center mb-30">
                            <h2 class="mb-45">Change Passowrd</h2>


                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger text-start">
                                    <?= $_GET['error'] ?>
                                </div>

                            <?php endif; ?>

                            <form action="php/utils/actions.php?change-password=true&api" method="post" class="row gx-3 comments-form contact-form">
                                <?= showError('password') ?>
                                <div class="col-lg-12 mb-30 position-relative">
                                    <input type="password" class="form-control" placeholder="Enter New Password" name="password" id="password">
                                    <span id="togglePassword" class="position-absolute"
                                        style="right: 25px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>

                                </div>
                                <input type="hidden" name="email" value="<?= $_SESSION['verification_done'] ?>">
                                <!-- Submit Button -->
                                <button class="theme_btn message_btn mt-20" type="submit">Change Password</button>
                                <br>

                                <!-- Register Link -->
                                <p class="mt-4">
                                    Changed your mind? You can keep your current password.
                                    <a href="login.php" class="theme-color">Return to Login</a>
                                </p>

                                <input type="hidden" name="cb" value="<?= isset($_GET['cb']) ?  $_GET['cb'] : "" ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <?php include 'php/pages/footer.php' ?>
    <script>
        $(document).ready(function() {
            $("#togglePassword").click(function() {
                let input = $("#password");
                let icon = $(this).find("i");

                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['formdata']);
?>