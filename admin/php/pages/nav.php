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
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto ">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>

                <!-- Counter - Alerts -->
                <?php
                // Fetch the total count of unread notifications from the database
                $total_noty_result = mysqli_query($con, "SELECT COUNT(*) AS `total_notification` FROM `notifications` WHERE `status` = 'unread'");
                $total_noty = mysqli_fetch_assoc($total_noty_result);

                // Get the number of unread notifications, default to 0 if not set
                $total_notification = isset($total_noty['total_notification']) ? (int)$total_noty['total_notification'] : 0;
                ?>

                <?php if ($total_notification > 0) : ?>
                    <span class="badge badge-danger badge-counter"><?= $total_notification ?></span>
                <?php endif; ?> </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <?php
                function timeAgo($datetime)
                {
                    $timestamp = strtotime($datetime);
                    $timeDiff = time() - $timestamp;

                    if ($timeDiff < 3600) { // Less than 1 hour
                        return floor($timeDiff / 60) . " minutes ago";
                    } elseif ($timeDiff < 86400) { // Less than 1 day
                        return floor($timeDiff / 3600) . " hours ago";
                    } elseif ($timeDiff < 604800) { // Less than 1 week
                        return floor($timeDiff / 86400) . " days ago";
                    } else { // More than 1 week
                        return date("M d, Y", $timestamp);
                    }
                }
                ?>
                <?php $noti_query = mysqli_query($con, "SELECT * FROM `notifications`  WHERE `status` = 'unread' ORDER BY `notifications`.`id` DESC LIMIT 10");
                if (mysqli_num_rows($noti_query) > 0) {
                    while ($noty = mysqli_fetch_array($noti_query)) { ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?= $noty['url'] ?>">
                            <div>


                                <div class="small text-gray-500"><?= timeAgo($noty['date']) ?></div>

                                <span class="font-weight-bold"><?= $noty['message'] ?></span>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <a class="dropdown-item d-flex align-items-center" href="notifications.php">
                        <div>
                            <div class="small text-gray-500"></div>
                            <span class="font-weight-bold">No new Notifications</span>
                        </div>
                    </a>
                <?php }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="notifications.php">Show All Alerts</a>
            </div>
        </li>




        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                $admin_profile = mysqli_query($con, "SELECT `data1`,`data2` FROM `settings` WHERE `id` = 2");
                $a_profile = mysqli_fetch_array($admin_profile);
                ?>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $a_profile['data1'] ?></span>

            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="settings.php#profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="settings.php">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="../index.php">
                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                    Go To Website
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item bg-danger text-light" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>
</nav>