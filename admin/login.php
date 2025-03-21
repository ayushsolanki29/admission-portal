<?php
include '../php/utils/db.php';
session_start();

$remember_token_name = "6oxM5UA2E65";
$max_attempts = 3;
$lockout_time = 15 * 60;
$session_duration = 90 * 24 * 60 * 60; // 90 days

// If already logged in, redirect to the admin panel
if (isset($_SESSION['is_admin'])) {
    header("Location: index.php");
    exit();
}

// Handle Remember Me token
if (isset($_COOKIE[$remember_token_name])) {
    $token = mysqli_real_escape_string($con, $_COOKIE[$remember_token_name]);
    $query = "SELECT user_id FROM rememberme_tokens WHERE token = ? AND expiration > NOW()";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $_SESSION['attempt'] = 0;
        $_SESSION['is_admin'] = true;
        header("Location: index.php");
        exit();
    } else {
        // Cookie expired or invalid - force logout
        setcookie($remember_token_name, "", time() - 3600, "/");
        $_SESSION['err'] = "Login session expired. Please log in again.";
        header("Location: login.php");
        exit();
    }
}

// Initialize login attempt tracking
if (!isset($_SESSION['attempt'])) {
    $_SESSION['attempt'] = 0;
}
if (isset($_COOKIE['login_attempt_faild'])) {
    $_SESSION['attempt'] = $max_attempts;
}

// Handle lockout
if (isset($_SESSION['last_attempt_time']) && (time() - $_SESSION['last_attempt_time']) < $lockout_time) {
    $remaining_time = $lockout_time - (time() - $_SESSION['last_attempt_time']);
    echo json_encode(['error' => 'Too many login attempts. Try again in ' . ceil($remaining_time / 60) . ' minutes.']);
    exit();
}
if ($_SESSION['attempt'] >= $max_attempts) {
    setcookie("login_attempt_faild", time(), time() + (86400 * 30), "/", "", false, true);
}

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_admin'])) {
    if ($_SESSION['attempt'] >= $max_attempts) {
        $_SESSION['last_attempt_time'] = time();
        echo json_encode(['error' => 'Too many login attempts. Try again later.']);
        exit();
    }

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $stmt = $con->prepare("SELECT `data2`, `data1` FROM `settings` WHERE `id` = ?");
    $id = 2;
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        if ($data['data1'] === $username && password_verify($password, $data['data2'])) {
            // Generate new token for Remember Me
            $user_id = 2;
            $token = bin2hex(random_bytes(64)); // More secure random token
            $expiration = date('Y-m-d H:i:s', strtotime("+$session_duration seconds"));

            // Store the new token in the database
            $stmt = $con->prepare("INSERT INTO rememberme_tokens (user_id, token, expiration) VALUES (?, ?, ?)
                                   ON DUPLICATE KEY UPDATE token = VALUES(token), expiration = VALUES(expiration)");
            $stmt->bind_param("iss", $user_id, $token, $expiration);
            $stmt->execute();

            // Set long-term cookie (secure, HTTP-only, same-site)
            setcookie($remember_token_name, $token, time() + $session_duration, "/", "", false, true);

            $_SESSION['attempt'] = 0;
            $_SESSION['is_admin'] = true;
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['attempt']++;
            $_SESSION['err'] = "Invalid Credentials";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['attempt']++;
        $_SESSION['err'] = "Invalid Credentials";
        header("Location: login.php");
        exit();
    }
}

// CSRF Protection Token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Login - collegenew.com</title>
    <?php include 'php/pages/head.php' ?>
    <style>
        .bg-login-image {
            background: url('img/collegenew.com.png') no-repeat center center;
            background-size: cover;

        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <script>
        document.querySelector("body").insertAdjacentHTML(
            "beforeend",
            `
    <div class="loader_box">
        <img src='../assets/img/logo/header_logo_one.png' ;/>
    </div>
    `
        );
        window.addEventListener("load", function() {
            const loader = document.querySelector(".loader_box");
            if (loader) {
                loader.remove();
            }
        });
    </script>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Access Only!</h1>
                                    </div>
                                    <?php if (isset($_SESSION['err'])) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= htmlspecialchars($_SESSION['err']);
                                            unset($_SESSION['err']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($_SESSION["attempt"] < $max_attempts) { ?>
                                        <form class="user" method="POST">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" placeholder="Enter Username" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" name="login_admin" class="btn btn-primary btn-user btn-block">
                                                Login as Admin
                                            </button>
                                            <hr>
                                        </form>
                                        <div class="text-start bg-danger text-white p-3 rounded" onclick="window.location.href = '../index.php'" style="cursor: pointer; margin: 10px 0; border: 2px solid #ff0000; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <p class="small mb-0"><strong>Warning:</strong> This is the Admin Panel of this website. Please go back to the home page. Using this page may affect your device health. Click here to go back.</p>
                                        </div>
                                    <?php } else { ?>
                                        <div class="text-start bg-danger text-white p-3 rounded" style="margin: 10px 0; border: 2px solid #ff0000; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            <p class="small mb-0">
                                                <strong>⚠ Warning:</strong> You are blocked by the server for too many login attempts. Maybe you will never be able to use this form again.
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
<?php unset($_SESSION['err']) ?>