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
</head>

<body>


    <?php include 'php/pages/header.php' ?>


    <main>

        <section class="contact-form-area pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-form-wrapper gradient-bg p-4 rounded text-center mb-30">
                            <h2 class="mb-45">Login</h2>

                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-<?= $_SESSION['error']['type'] ?> text-start">
                                    <?= $_SESSION['error']['msg'] ?>
                                </div>

                            <?php endif; ?>
                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger text-start">
                                    <?= $_GET['error'] ?>
                                </div>

                            <?php endif; ?>

                            <form action="php/utils/actions.php?login=true&api" method="post" class="row gx-3 comments-form contact-form">

                                <!-- Email Field -->
                                <div class="col-lg-12 mb-30">
                                    <input type="text" placeholder="Email" name="email" value="<?= showFormData('email') ?>">

                                </div>

                                <!-- Password Field -->
                                <div class="col-lg-12 mb-30">
                                    <input type="password" placeholder="Password" name="password">

                                </div>



                                <!-- Submit Button -->
                                <button class="theme_btn message_btn mt-20" type="submit">Login</button>
                                <br>

                                <!-- Register Link -->
                                <p class="mt-4">
                                    Don't have an account?
                                    <a href="register.php" class="theme-color">Register</a>
                                </p>
                                <!-- Register Link -->
                                <p class="mt-4">
                                    Forget Your Password ?
                                    <a href="forget-password.php" class="theme-color">Click Here</a>
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