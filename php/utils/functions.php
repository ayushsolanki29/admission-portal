<?php
require_once 'db.php';

// For validating the Signup Form
function validateRegisterForm($form_data)
{
    $response = array();
    $response['status'] = true;

    // Check password
    if (!$form_data['password'] || strlen($form_data['password']) < 6) {
        $response['msg'] = "Password should be at least 6 characters long!";
        $response['status'] = false;
        $response['field'] = "password";
    }

    // Check department
    if (!isset($form_data['department']) || empty($form_data['department'])) {
        $response['msg'] = "Department is required!";
        $response['status'] = false;
        $response['field'] = "department";
    }


    // Check department
    if (!$form_data['city']) {
        $response['msg'] = "City is not given!";
        $response['status'] = false;
        $response['field'] = "city";
    }
    // Check phone number ony in digits and 10 digits long
    if (!preg_match("/^[0-9]{10}$/", $form_data['phone_number'])) {
        $response['msg'] = "Phone number should be 10 digits long!";
        $response['status'] = false;
        $response['field'] = "phone_number";
    }
    // Check email check formate
    if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $response['msg'] = "Email is not valid!";
        $response['status'] = false;
        $response['field'] = "email";
    }

    // Check username length
    if (!$form_data['username'] || strlen($form_data['username']) < 2 || strlen($form_data['username']) > 15) {
        $response['msg'] = "Username should be between 2 and 15 characters!";
        $response['status'] = false;
        $response['field'] = "username";
    }

    // Check if email is already registered
    if (isEmailRegistered($form_data['email'])) {
        $response['msg'] = "Email ID is already in use! want to Login ?";
        $response['status'] = false;
        $response['field'] = "email";
    }

    // Check if username is already taken
    if (isUserRegistered($form_data['username'])) {
        $response['msg'] = "Username is already taken!";
        $response['status'] = false;
        $response['field'] = "username";
    }

    return $response;
}
function isEmailRegistered($email)
{
    global $con;
    $query = "SELECT COUNT(*) AS `row` FROM `users` WHERE `email`='$email'";
    $run = mysqli_query($con, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
function isUserRegistered($username)
{
    global $con;
    $query = "SELECT COUNT(*) AS `row` FROM `users` WHERE `username`='$username'";
    $run = mysqli_query($con, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}
// Creating new user
function createUser($data)
{
    global $con;

    $query = "INSERT INTO `users` (`city`, `phone_number`, `department`, `gender`, `email`, `username`, `password`, `verification_code`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $query);
    if (!$stmt) {
        error_log("SQL Prepare failed: " . mysqli_error($con));
        return false;
    }

    $verify_code = createRandomCode(62);
    $hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssss",
        $data['city'],
        $data['phone_number'],
        $data['department'],
        $data['gender'],
        $data['email'],
        $data['username'],
        $hashed_password,
        $verify_code
    );

    if (mysqli_stmt_execute($stmt)) {
        return $verify_code;
    } else {
        error_log("Database Insert Error: " . mysqli_stmt_error($stmt));
        return false;
    }
}
//create a random code for email verification 
function createRandomCode($length)
{
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length);
}
//show prev form data
function showFormData($field)
{
    if (isset($_SESSION['formdata'])) {
        $formdata = $_SESSION['formdata'];
        return $formdata[$field];
    }
}
function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
?>
            <div class="alert alert-danger my-2" role="alert">
                <?= $error['msg'] ?>
            </div>
<?php
        }
    }
}
// For validating the Login Form
function validateLoginForm($form_data)
{
    $response = [
        'status' => true,
        'msg' => '',
        'field' => '',
        'type' => ''
    ];

    // Trim input to remove unnecessary spaces
    $email = trim($form_data['email'] ?? '');
    $password = trim($form_data['password'] ?? '');

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'status' => false,
            'msg' => "Invalid email format!",
            'field' => "email",
            'type' => "danger" // Red - Invalid email
        ];
    }

    // Check password length
    if (strlen($password) < 6) {
        return [
            'status' => false,
            'msg' => "Password must be at least 6 characters long!",
            'field' => "password",
            'type' => "danger" // Red - Password too short
        ];
    }

    // Validate user login
    $userData = checkUser($form_data);

    if (!$userData['status']) {
        return [
            'status' => false,
            'msg' => $userData['msg'], // Uses message from checkUser()
            'field' => "checkuser",
            'type' => $userData['type'] // Matches error type (danger, warning, info)
        ];
    }

    // Successful login
    return [
        'status' => true,
        'user' => $userData['user']
    ];
}

// for checking login user
function checkUser($login_data)
{
    global $con;

    if (!$con) {
        return ['error' => 'Database connection error.'];
    }

    $email = trim($login_data['email']);
    $password = trim($login_data['password']);

    // Prepared statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);

    if (!$stmt) {
        return ['error' => 'SQL prepare error: ' . mysqli_error($con)];
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        return [
            'status' => false,
            'msg' => "The provided email is not registered. Please sign up first.",
            'type' => "info" // Blue - Info message
        ];
    }

    // Verify password using password_hash()
    if (!password_verify($password, $user['password'])) {
        return [
            'status' => false,
            'msg' => "Incorrect password. Please try again.",
            'type' => "danger" // Red - Danger message
        ];
    }

    // Check account activation status
    if ($user['acc_status'] !== "active") {
        return [
            'status' => false,
            'msg' => "Your account is not activated. Please check your email for the activation link.",
            'type' => "warning" // Yellow - Warning message
        ];
    }

    // Successful login
    return [
        'status' => true,
        'user' => $user
    ];
}
function getUserData($user_id)
{
    global $con;

    // Prevent SQL Injection
    $user_id = mysqli_real_escape_string($con, $user_id);

    // Execute the query
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($con, $query);

    // Check for query execution errors
    if (!$result) {
        return ['error' => 'Database query failed: ' . mysqli_error($con)];
    }

    return mysqli_fetch_assoc($result);
}
function getFilePath($folder, $file)
{
    return "assets/{$folder}/" . htmlspecialchars($file, ENT_QUOTES, 'UTF-8');
}

// Function to process comma-separated values
function parseCSV($string)
{
    return array_filter(array_map('trim', explode(' | ', $string)));
}



function createNotification($message, $url)
{
    global $con;
    $query = mysqli_query($con, "INSERT INTO `notifications`(`message`, `url`) VALUES ('$message','$url')");
    if ($query) {
        return true;
    } else {
        return false;
    }
}

function getWhatsAppNumber()
{
    global $con;
    $number = mysqli_fetch_assoc(mysqli_query($con,  "SELECT `data1` FROM `settings` WHERE `id` = '3'"));
    return $number['data1'];
}
