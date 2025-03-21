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
    $meta_title = "Reset Your Password - CollegeNew.com";
    $meta_dec = "Easily reset your CollegeNew.com account password and regain access to your account for a seamless college admission experience.";
    $meta_keywords = "CollegeNew forgot password, reset password, student login help, account recovery, education portal, secure access";
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
                            <h2 class="mb-45">Forget Password</h2>

                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger text-start">
                                    <?= $_SESSION['error']['msg'] ?>
                                </div>

                            <?php endif; ?>
                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger text-start">
                                    <?= $_GET['error'] ?>
                                </div>

                            <?php endif; ?>

                            <form action="php/utils/actions.php?forget-password=true&api" method="post" class="row gx-3 comments-form contact-form">

                                <!-- Email Field -->
                                <div class="col-lg-12 mb-30">
                                    <input type="text" required placeholder="Email" name="email" value="<?= showFormData('email') ?>">
                                </div>

                                <!-- Submit Button -->
                                <button class="theme_btn message_btn mt-20" type="submit">Send OTP</button>
                                <br>


                                <p class="mt-4">
                                    Ahh, I remember my password!
                                    <a href="login.php" class="theme-color">Back to login?</a>
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
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['formdata']);
?>