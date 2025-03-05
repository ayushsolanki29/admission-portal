<?php include 'php/utils/db.php';
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $sql = "SELECT * FROM `users` WHERE `verification_code` = '$code'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $sql = "UPDATE `users` SET `acc_status` = 'active',`verification_code`= '' WHERE email = '$email'";
        if ($con->query($sql)) {
            header('Location: activate.php?success');
        } else {
            header('Location: activate.php?error');
        }
    } else {
        header('Location: activate.php?error');
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
    <?php
    if (isset($_GET['success'])) {
    ?>
        <main class="container">
            <div class="card shadow-lg text-center p-5 border-0" style="max-width: 600px; margin: auto;">
                <img src="assets/img/icon/verified.gif" alt="Verified Icon" class="mx-auto mb-3" style="width: 80px; height: 80px; animation: bounce 1.5s infinite;">
                <h2 class="fs-4 fw-bold text-dark mb-3">Email Verified Successfully</h2>
                <a href="login.php" class="btn btn-success mt-4 px-4 py-2">Proceed to continue</a>
            </div>
        </main>
    <?php
    } else if (isset($_GET['error'])) { ?>
        <main class="container">
            <div class="card shadow-lg text-center p-5 border-0" style="max-width: 600px; margin: auto;">
                <img src="assets/img/icon/wrong.svg" alt="Verified Icon" class="mx-auto mb-3" style="width: 80px; height: 80px; animation: bounce 1.5s infinite;">
                <h2 class="fs-4 fw-bold text-dark mb-3">Invaild Email</h2>
                <a href="register.php" class="btn btn-danger mt-4 px-4 py-2">Try Again With New Email</a>
            </div>
        </main>
    <?php
    }
    ?>


    <style>
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>
    </main>
    <?php include 'php/pages/footer.php' ?>
</body>

</html>