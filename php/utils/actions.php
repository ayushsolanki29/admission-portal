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
    $cb = $_POST['cb'];
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

        if (!empty($cb)) {
            header("Location: ../../$cb");
            exit();
        } else {
            header("Location: ../../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = $response;
        $_SESSION['formdata'] = $_POST;
        header("Location: ../../login.php");
        exit();
    }
}



if (isset($_GET['create_new_lead'], $_GET['lead_source'], $_GET['id'])) {
    if (!isset($_SESSION['Auth'])) {
        header("Location: ../../login.php?error=Please Login First&cb=profile.php");
        exit();
    }

    $user_id = $_SESSION['Auth'];
    $leadSource = $_GET['lead_source'];
    $id = $_GET['id'];

    if (in_array($leadSource, ['course', 'college'])) {
        // Fetch college name
        $college_name = "Unknown College";
        $query = "SELECT `college_name` FROM `colleges` WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $college_name);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Check if the inquiry already exists
        $query = "SELECT id FROM inquire WHERE user_id = ? AND college_id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ss", $user_id, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 0) { // No existing inquiry, insert new
            $query = "INSERT INTO `inquire`(`user_id`, `course_id`, `college_id`, `created_at`) 
                      VALUES (?, ?, ?, NOW())";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sss", $user_id, $course_id, $id);
            $inserted = mysqli_stmt_execute($stmt);
        } else {
            $inserted = true; // Already exists, just proceed to WhatsApp
        }
        mysqli_stmt_close($stmt);

        if ($inserted) {
            $user = getUserData($user_id);
            $phone = "+919723054735";

            $message = "Hello, I would like to get Admission.\n";
            $message .= "----- *College Details* -----\n";
            $message .= "- College Name : $college_name\n";
            $message .= "- Department : {$user['department']}\n";
            $message .= "------- *My Profile* ------------\n";
            $message .= "- Username : {$user['username']}\n";
            $message .= "- Email : {$user['email']}\n";
            $message .= "- Phone : {$user['phone_number']}\n";
            $message .= "Could you please provide more information about this? Thank you. 🙌";

            $whatsappURL = "https://wa.me/$phone?text=" . urlencode($message);
            header("Location: $whatsappURL");
            exit();
        }
    }
}

if (isset($_GET['live_chat'])) {
    session_start();
    
    $user_id = isset($_SESSION['Auth']) ? $_SESSION['Auth'] : null;
    $user = $user_id ? getUserData($user_id) : null;
    $phone = "+919723054735";

    if ($user) {
        // Structured message for logged-in users
        $message = "📌 *Admission Inquiry*\n\n";
        $message .= "Hey, my name is *{$user['username']}* 👋\n";
        $message .= "I'm interested in admission and need some details.\n\n";
        $message .= "📌 *My Profile*:\n";
        $message .= "- Username: *{$user['username']}*\n";
        $message .= "- Email: *{$user['email']}*\n";
        $message .= "- Phone: *{$user['phone_number']}*\n";
        $message .= "- Department: *" . (!empty($user['department']) ? $user['department'] : "Not specified") . "*\n\n";
        $message .= "Can you please provide more information regarding the admission process? Thanks! 🙌";
    } else {
        // Casual message for guests (not logged in)
        $message = "Hey there! 👋\n\n";
        $message .= "I'm currently visiting your website and I have some queries about admissions.\n\n";
        $message .= "Could you please help me out with some details? 😊\n\n";
        $message .= "Looking forward to your response. Thanks! 🙌";
    }

    // Redirect to WhatsApp
    $whatsappURL = "https://wa.me/$phone?text=" . urlencode($message);
    header("Location: $whatsappURL");
    exit();
}
