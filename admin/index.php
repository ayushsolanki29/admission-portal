<?php
include '../php/utils/db.php';
session_start();

// if (!isset($_SESSION['is_admin'])) {
//     header("Location:login.php");
//     exit();
// }

// Fetch required data
$today_date = date('Y-m-d');
$month_start = date('Y-m-01');
$month_end = date('Y-m-t');

$queries = [
    "site_visits" => "SELECT `data1` AS count FROM `settings` WHERE `id` = '1'",
    "today_leads" => "SELECT COUNT(*) AS count FROM `inquire` WHERE DATE(`created_at`) = '$today_date'",
    "monthly_leads" => "SELECT COUNT(*) AS count FROM `inquire` WHERE DATE(`created_at`) BETWEEN '$month_start' AND '$month_end'",
    "total_leads" => "SELECT COUNT(*) AS count FROM `inquire`",
    "total_users" => "SELECT COUNT(*) AS count FROM `users`",
    "total_contacts" => "SELECT COUNT(*) AS count FROM `contact`",

    "total_colleges" => "SELECT COUNT(*) AS count FROM  `colleges`",
    "total_courses" => "SELECT COUNT(*) AS count FROM  `courses`",
    "total_department" => "SELECT COUNT(*) AS count FROM  `department`",
    "total_campus_images" => "SELECT COUNT(*) AS count FROM  `campus_images`",

];

$data = [];
foreach ($queries as $key => $query) {
    $result = mysqli_fetch_assoc(mysqli_query($con, $query));
    $data[$key] = (int) $result['count'];
}

// Format Site Visits
function formatViews($number)
{
    if ($number >= 100000) return round($number / 100000, 1) . ' Lakh';
    if ($number >= 10000) return round($number / 1000, 0) . 'K';
    if ($number >= 1000) return round($number / 1000, 1) . 'K';
    return $number;
}
$data['site_visits'] = formatViews($data['site_visits']);

// Dashboard Items
$dashboard_items = [
    ["title" => "Site Visits", "value" => $data['site_visits'], "color" => "primary", "icon" => "calendar"],
    ["title" => "Leads (Today)", "value" => $data['today_leads'], "color" => "info", "icon" => "user-friends"],
    ["title" => "Leads (Monthly)", "value" => $data['monthly_leads'], "color" => "success", "icon" => "chart-line"],
    ["title" => "Total Leads", "value" => $data['total_leads'], "color" => "danger", "icon" => "database"],
    ["title" => "Users", "value" => $data['total_users'], "color" => "primary", "icon" => "users"],
    ["title" => "Contacts", "value" => $data['total_contacts'], "color" => "info", "icon" => "headset"],

];
// Data Stast
$data_stats = [
    ["title" => "Colleges", "value" => $data['total_colleges'], "color" => "primary", "icon" => "graduation-cap"],
    ["title" => "Courses", "value" => $data['total_courses'], "color" => "info", "icon" => "book"],
    ["title" => "Departments", "value" => $data['total_department'], "color" => "success", "icon" => "building"],
    ["title" => "Campus Images", "value" => $data['total_campus_images'], "color" => "danger", "icon" => "images"]
];


// Function to generate card UI
function renderCard($items)
{
    foreach ($items as $item) {
        echo '<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-' . $item['color'] . ' shadow h-100 py-2">
    <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-' . $item['color'] . ' text-uppercase mb-1">
                    ' . $item['title'] . '
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    ' . $item['value'] . '
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-' . $item['icon'] . ' fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard - steam-games.in</title>

    <?php include 'php/pages/head.php' ?>
</head>

<body id="page-top">

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div id="wrapper">
        <?php include 'php/pages/sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <?php include 'php/pages/nav.php' ?>


                <div class="container-fluid">
                    <!-- Dashboard Section -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="row">
                        <?php renderCard($dashboard_items); ?>
                    </div>

                    <!-- Media Section -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Statistics</h1>
                    </div>
                    <div class="row">
                        <?php renderCard($data_stats); ?>
                    </div>
                </div>




            </div>

            <?php include 'php/pages/footer.php' ?>