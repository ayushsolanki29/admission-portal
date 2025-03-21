<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();

if (isset($_POST['otp_verify'])) {
    if (isset($_GET['email'])) {
        $email = mysqli_real_escape_string($con, $_GET['email']);
        $otp = mysqli_real_escape_string($con, $_POST['otp']);

        // Fetch user where email and verification_code match
        $query = "SELECT * FROM users WHERE email = '$email' AND verification_code = '$otp'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();

            $update_query = "UPDATE users SET acc_status='active',  verification_code = NULL WHERE email = '$email'";
            if (mysqli_query($con, $update_query)) {
                $user_id =   $row['id'];

                $token = bin2hex(random_bytes(32));
                $expiration = date('Y-m-d H:i:s', strtotime('+30 days'));

                if (!createCookieToken($user_id, $token, $expiration)) {
                    echo "<script>alert('Error while saving login session, please try again.');</script>";
                }
                $_SESSION['Auth'] = $row['id'];
                header("location:index.php");
            } else {
                header("location:otpverify-email.php?err=Error updating verification status!&email=$email");
            }
        } else {
            header("location:otpverify-email.php?err=Invalid OTP. Please try again!&email=$email");
        }
    } else {
        header("location:otpverify-email.php?err=Email parameter is missing!!&email=$email");
    }
}


?>
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
            <?php if (isset($_GET['err'])) { ?>

                <div class="alert alert-danger text-start">
                    <p>
                        <?= $_GET['err'] ?>
                    </p>
                </div>

            <?php   } ?>
            <?php if (isset($_GET['success'])) { ?>

                <div class="alert alert-success text-start">
                    <p>
                        <?= $_GET['success'] ?>
                    </p>
                </div>

            <?php   } ?>

            <p class="text-muted text-start">We've sent 4 Digit OTP to <strong><?php echo $_GET['email'] ?></strong> for activate your account.</p>
            <form method="post" class="row gx-3 comments-form contact-form mt-2">

                <!-- Email Field -->
                <div class="col-lg-12 mb-30">
                    <input type="tel" placeholder="Enter 4 Digit OTP" name="otp" required
                        pattern="\d{4}" maxlength="4" oninput="this.value = this.value.replace(/\D/g, '')">
                </div>

                <button class="theme_btn message_btn" name="otp_verify" type="submit">Verify OTP</button>

            </form>
            <p class="text-muted text-start mt-4">If you don't see the email, check other places it might be, like your junk, spam, social, or other folders.</p>

        </div>
    </main>



    <?php include 'php/pages/footer.php' ?>
</body>

</html>