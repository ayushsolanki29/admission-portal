<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
</head>

<body>

    <?php include 'php/pages/header.php' ?>
    <main class="container">
        <div class="card shadow-lg text-center p-4 border-0" style="max-width: 600px; margin: auto;">
            <img src="assets/img/icon/gmail.gif" alt="Gmail Icon" class="mx-auto mb-3" style="width: 80px; height: 80px; animation: bounce 1.5s infinite;">
            <h2 class="fs-4 fw-bold text-dark mb-4">Verify Your Email</h2>
            <p class="text-muted text-start">We've sent an email to <strong><?php echo $_GET['email'] ?></strong> with a link to activate your account.</p>
            <p class="text-muted text-start">If you don't see the email, check other places it might be, like your junk, spam, social, or other folders.</p>
            <a href="login.php" class="theme_btn free_btn mt-3">Login Page</a>
        </div>
    </main>



    <?php include 'php/pages/footer.php' ?>
</body>

</html>