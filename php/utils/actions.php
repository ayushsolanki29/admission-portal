<?php
session_start();
require_once 'functions.php';
require_once 'send_code.php';

// signup manages 
if (isset($_GET['register'])) {
    $response = validateRegisterForm($_POST);

    if ($response['status']) {
        if ($code = createUser($_POST)) {
            // Generate activation link
            $activation_link = "$domain/activate.php?verification=TXT&phase=5&code=" . urlencode($code);

            // Send activation email
            $codesended = send_activation_LINK($_POST['email'], "Account Activation",    $activation_link, $_POST['username'], date("Y-m-d H:i:s"));

            if ($codesended) {
                header('Location: ../../check-email.php?email=' . $_POST['email']);
            } else {
                header('Location: ../../register.php?error=Faild to send Verification Link to Your email box.');
            }
            exit();
        } else {
            // Handle database error
            error_log("Database error: " . mysqli_error($con));
            header('Location: ../../register.php?error=something went wrong!');
            exit();
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("Location: ../../register.php");
        exit();
    }
}

if (isset($_GET['login'])) {
    $response = validateLoginForm($_POST);

    if ($response['status']) {
        $_SESSION['Auth'] = $response['user']['id'];

        // Handle "Remember Me" functionality

        $user_id = $response['user']['id'];
        $token = bin2hex(random_bytes(32));
        $expiration = date('Y-m-d H:i:s', strtotime('+30 days'));

        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($con, "INSERT INTO rememberme_tokens (user_id, token, expiration) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $token, $expiration);

        if (mysqli_stmt_execute($stmt)) {
            setcookie(
                "rememberme",
                $token,
                [
                    'expires' => time() + (30 * 24 * 60 * 60), // 30 days
                    'path' => '/',
                    'secure' => true,  // Ensures HTTPS-only transmission
                    'httponly' => true // Prevents JavaScript access
                ]
            );
        } else {
            echo "<script>alert('Error while saving login session, please try again.');</script>";
        }
        mysqli_stmt_close($stmt);


        header("Location: ../../index.php");
        exit();
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("Location: ../../login.php");
        exit();
    }
}
