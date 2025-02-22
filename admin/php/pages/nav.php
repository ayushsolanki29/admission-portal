
<script>
    document.querySelector("body").insertAdjacentHTML(
        "beforeend",
        `
    <div class="loader_box">
        <img src='../assets/img/f.gif' ;/>
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

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>

              

               
                    <span class="badge badge-danger badge-counter">0</span>
  
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
         
                    <a class="dropdown-item d-flex align-items-center" href="notifications.php">
                        <div>
                            <div class="small text-gray-500"></div>
                            <span class="font-weight-bold">No new Notifications</span>
                        </div>
                    </a>
              
                <a class="dropdown-item text-center small text-gray-500" href="notifications.php">Show All Alerts</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-comments"></i>
           

            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6>
               
                 
                    <a class="dropdown-item d-flex align-items-center" href="">
                        <div class="font-weight-bold">
                            <div class="text-truncate">NO NEW MESSAGES </div>

                        </div>
                    </a>
           

                <a class="dropdown-item text-center small text-gray-500" href="chat.php">Read More Messages</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             
                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $a_profile['data2'] ?></span>
                <img class="img-profile rounded-circle" src="../assets/img/profile/<?= $a_profile['data3'] ?>"> -->
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